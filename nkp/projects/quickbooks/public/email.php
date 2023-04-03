<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet" />
        <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <style>
            @keyframes mdc-checkbox-unchecked-checked-checkmark-path {
                0%,
                50% {
                    stroke-dashoffset: 29.7833385;
                }

                50% {
                    animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
                }

                100% {
                    stroke-dashoffset: 0;
                }
            }

            @keyframes mdc-checkbox-unchecked-indeterminate-mixedmark {
                0%,
                68.2% {
                    transform: scaleX(0);
                }

                68.2% {
                    animation-timing-function: cubic-bezier(0, 0, 0, 1);
                }

                100% {
                    transform: scaleX(1);
                }
            }

            @keyframes mdc-checkbox-checked-unchecked-checkmark-path {
                from {
                    animation-timing-function: cubic-bezier(0.4, 0, 1, 1);
                    opacity: 1;
                    stroke-dashoffset: 0;
                }

                to {
                    opacity: 0;
                    stroke-dashoffset: -29.7833385;
                }
            }

            @keyframes mdc-checkbox-checked-indeterminate-checkmark {
                from {
                    animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
                    transform: rotate(0deg);
                    opacity: 1;
                }

                to {
                    transform: rotate(45deg);
                    opacity: 0;
                }
            }

            @keyframes mdc-checkbox-indeterminate-checked-checkmark {
                from {
                    animation-timing-function: cubic-bezier(0.14, 0, 0, 1);
                    transform: rotate(45deg);
                    opacity: 0;
                }

                to {
                    transform: rotate(360deg);
                    opacity: 1;
                }
            }

            @keyframes mdc-checkbox-checked-indeterminate-mixedmark {
                from {
                    animation-timing-function: mdc-animation-deceleration-curve-timing-function;
                    transform: rotate(-45deg);
                    opacity: 0;
                }

                to {
                    transform: rotate(0deg);
                    opacity: 1;
                }
            }

            @keyframes mdc-checkbox-indeterminate-checked-mixedmark {
                from {
                    animation-timing-function: cubic-bezier(0.14, 0, 0, 1);
                    transform: rotate(0deg);
                    opacity: 1;
                }

                to {
                    transform: rotate(315deg);
                    opacity: 0;
                }
            }

            @keyframes mdc-checkbox-indeterminate-unchecked-mixedmark {
                0% {
                    animation-timing-function: linear;
                    transform: scaleX(1);
                    opacity: 1;
                }

                32.8%,
                100% {
                    transform: scaleX(0);
                    opacity: 0;
                }
            }

            .mdc-checkbox {
                display: inline-block;
                position: relative;
                flex: 0 0 18px;
                box-sizing: content-box;
                width: 18px;
                height: 18px;
                line-height: 0;
                white-space: nowrap;
                cursor: pointer;
                vertical-align: bottom;
                padding: 11px;
            }

            .mdc-checkbox .mdc-checkbox__native-control:checked ~ .mdc-checkbox__background::before,
            .mdc-checkbox .mdc-checkbox__native-control:indeterminate ~ .mdc-checkbox__background::before {
                background-color: #018786;
            }

            .mdc-checkbox .mdc-checkbox__native-control:checked ~ .mdc-checkbox__background::before,
            .mdc-checkbox .mdc-checkbox__native-control:indeterminate ~ .mdc-checkbox__background::before {
                background-color: var(--mdc-theme-secondary, #018786);
            }

            .mdc-checkbox.mdc-checkbox--selected .mdc-checkbox__ripple::before,
            .mdc-checkbox.mdc-checkbox--selected .mdc-checkbox__ripple::after {
                background-color: #018786;
            }

            .mdc-checkbox.mdc-checkbox--selected .mdc-checkbox__ripple::before,
            .mdc-checkbox.mdc-checkbox--selected .mdc-checkbox__ripple::after {
                background-color: var(--mdc-theme-secondary, #018786);
            }

            .mdc-checkbox.mdc-checkbox--selected:hover .mdc-checkbox__ripple::before {
                opacity: 0.04;
            }

            .mdc-checkbox.mdc-checkbox--selected.mdc-ripple-upgraded--background-focused .mdc-checkbox__ripple::before,
            .mdc-checkbox.mdc-checkbox--selected:not(.mdc-ripple-upgraded):focus .mdc-checkbox__ripple::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-checkbox.mdc-checkbox--selected:not(.mdc-ripple-upgraded) .mdc-checkbox__ripple::after {
                transition: opacity 150ms linear;
            }

            .mdc-checkbox.mdc-checkbox--selected:not(.mdc-ripple-upgraded):active .mdc-checkbox__ripple::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-checkbox.mdc-checkbox--selected.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            .mdc-checkbox.mdc-ripple-upgraded--background-focused.mdc-checkbox--selected .mdc-checkbox__ripple::before,
            .mdc-checkbox.mdc-ripple-upgraded--background-focused.mdc-checkbox--selected .mdc-checkbox__ripple::after {
                background-color: #018786;
            }

            .mdc-checkbox.mdc-ripple-upgraded--background-focused.mdc-checkbox--selected .mdc-checkbox__ripple::before,
            .mdc-checkbox.mdc-ripple-upgraded--background-focused.mdc-checkbox--selected .mdc-checkbox__ripple::after {
                background-color: var(--mdc-theme-secondary, #018786);
            }

            .mdc-checkbox .mdc-checkbox__background {
                top: 11px;
                left: 11px;
            }

            .mdc-checkbox .mdc-checkbox__background::before {
                top: -13px;
                left: -13px;
                width: 40px;
                height: 40px;
            }

            .mdc-checkbox .mdc-checkbox__native-control {
                top: 0px;
                right: 0px;
                left: 0px;
                width: 40px;
                height: 40px;
            }

            .mdc-checkbox__native-control:enabled:not(:checked):not(:indeterminate) ~ .mdc-checkbox__background {
                border-color: rgba(0, 0, 0, 0.54);
                background-color: transparent;
            }

            .mdc-checkbox__native-control:enabled:checked ~ .mdc-checkbox__background,
            .mdc-checkbox__native-control:enabled:indeterminate ~ .mdc-checkbox__background {
                border-color: #018786;
                border-color: var(--mdc-theme-secondary, #018786);
                background-color: #018786;
                background-color: var(--mdc-theme-secondary, #018786);
            }

            @keyframes mdc-checkbox-fade-in-background-uo0eltw {
                0% {
                    border-color: rgba(0, 0, 0, 0.54);
                    background-color: transparent;
                }

                50% {
                    border-color: #018786;
                    border-color: var(--mdc-theme-secondary, #018786);
                    background-color: #018786;
                    background-color: var(--mdc-theme-secondary, #018786);
                }
            }

            @keyframes mdc-checkbox-fade-out-background-uo0eltw {
                0%,
                80% {
                    border-color: #018786;
                    border-color: var(--mdc-theme-secondary, #018786);
                    background-color: #018786;
                    background-color: var(--mdc-theme-secondary, #018786);
                }

                100% {
                    border-color: rgba(0, 0, 0, 0.54);
                    background-color: transparent;
                }
            }

            .mdc-checkbox--anim-unchecked-checked .mdc-checkbox__native-control:enabled ~ .mdc-checkbox__background,
            .mdc-checkbox--anim-unchecked-indeterminate .mdc-checkbox__native-control:enabled ~ .mdc-checkbox__background {
                animation-name: mdc-checkbox-fade-in-background-uo0eltw;
            }

            .mdc-checkbox--anim-checked-unchecked .mdc-checkbox__native-control:enabled ~ .mdc-checkbox__background,
            .mdc-checkbox--anim-indeterminate-unchecked .mdc-checkbox__native-control:enabled ~ .mdc-checkbox__background {
                animation-name: mdc-checkbox-fade-out-background-uo0eltw;
            }

            .mdc-checkbox__native-control[disabled]:not(:checked):not(:indeterminate) ~ .mdc-checkbox__background {
                border-color: rgba(0, 0, 0, 0.38);
                background-color: transparent;
            }

            .mdc-checkbox__native-control[disabled]:checked ~ .mdc-checkbox__background,
            .mdc-checkbox__native-control[disabled]:indeterminate ~ .mdc-checkbox__background {
                border-color: transparent;
                background-color: rgba(0, 0, 0, 0.38);
            }

            .mdc-checkbox__native-control:enabled ~ .mdc-checkbox__background .mdc-checkbox__checkmark {
                color: #fff;
            }

            .mdc-checkbox__native-control:enabled ~ .mdc-checkbox__background .mdc-checkbox__mixedmark {
                border-color: #fff;
            }

            .mdc-checkbox__native-control:disabled ~ .mdc-checkbox__background .mdc-checkbox__checkmark {
                color: #fff;
            }

            .mdc-checkbox__native-control:disabled ~ .mdc-checkbox__background .mdc-checkbox__mixedmark {
                border-color: #fff;
            }

            @media screen and (-ms-high-contrast: active) {
                .mdc-checkbox__mixedmark {
                    margin: 0 1px;
                }
            }

            .mdc-checkbox--disabled {
                cursor: default;
                pointer-events: none;
            }

            .mdc-checkbox__background {
                display: inline-flex;
                position: absolute;
                align-items: center;
                justify-content: center;
                box-sizing: border-box;
                width: 18px;
                height: 18px;
                border: 2px solid currentColor;
                border-radius: 2px;
                background-color: transparent;
                pointer-events: none;
                will-change: background-color, border-color;
                transition: background-color 90ms 0ms cubic-bezier(0.4, 0, 0.6, 1), border-color 90ms 0ms cubic-bezier(0.4, 0, 0.6, 1);
            }

            .mdc-checkbox__background .mdc-checkbox__background::before {
                background-color: #000;
            }

            .mdc-checkbox__background .mdc-checkbox__background::before {
                background-color: var(--mdc-theme-on-surface, #000);
            }

            .mdc-checkbox__checkmark {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                width: 100%;
                opacity: 0;
                transition: opacity 180ms 0ms cubic-bezier(0.4, 0, 0.6, 1);
            }

            .mdc-checkbox--upgraded .mdc-checkbox__checkmark {
                opacity: 1;
            }

            .mdc-checkbox__checkmark-path {
                transition: stroke-dashoffset 180ms 0ms cubic-bezier(0.4, 0, 0.6, 1);
                stroke: currentColor;
                stroke-width: 3.12px;
                stroke-dashoffset: 29.7833385;
                stroke-dasharray: 29.7833385;
            }

            .mdc-checkbox__mixedmark {
                width: 100%;
                height: 0;
                transform: scaleX(0) rotate(0deg);
                border-width: 1px;
                border-style: solid;
                opacity: 0;
                transition: opacity 90ms 0ms cubic-bezier(0.4, 0, 0.6, 1), transform 90ms 0ms cubic-bezier(0.4, 0, 0.6, 1);
            }

            .mdc-checkbox--upgraded .mdc-checkbox__background,
            .mdc-checkbox--upgraded .mdc-checkbox__checkmark,
            .mdc-checkbox--upgraded .mdc-checkbox__checkmark-path,
            .mdc-checkbox--upgraded .mdc-checkbox__mixedmark {
                transition: none !important;
            }

            .mdc-checkbox--anim-unchecked-checked .mdc-checkbox__background,
            .mdc-checkbox--anim-unchecked-indeterminate .mdc-checkbox__background,
            .mdc-checkbox--anim-checked-unchecked .mdc-checkbox__background,
            .mdc-checkbox--anim-indeterminate-unchecked .mdc-checkbox__background {
                animation-duration: 180ms;
                animation-timing-function: linear;
            }

            .mdc-checkbox--anim-unchecked-checked .mdc-checkbox__checkmark-path {
                animation: mdc-checkbox-unchecked-checked-checkmark-path 180ms linear 0s;
                transition: none;
            }

            .mdc-checkbox--anim-unchecked-indeterminate .mdc-checkbox__mixedmark {
                animation: mdc-checkbox-unchecked-indeterminate-mixedmark 90ms linear 0s;
                transition: none;
            }

            .mdc-checkbox--anim-checked-unchecked .mdc-checkbox__checkmark-path {
                animation: mdc-checkbox-checked-unchecked-checkmark-path 90ms linear 0s;
                transition: none;
            }

            .mdc-checkbox--anim-checked-indeterminate .mdc-checkbox__checkmark {
                animation: mdc-checkbox-checked-indeterminate-checkmark 90ms linear 0s;
                transition: none;
            }

            .mdc-checkbox--anim-checked-indeterminate .mdc-checkbox__mixedmark {
                animation: mdc-checkbox-checked-indeterminate-mixedmark 90ms linear 0s;
                transition: none;
            }

            .mdc-checkbox--anim-indeterminate-checked .mdc-checkbox__checkmark {
                animation: mdc-checkbox-indeterminate-checked-checkmark 500ms linear 0s;
                transition: none;
            }

            .mdc-checkbox--anim-indeterminate-checked .mdc-checkbox__mixedmark {
                animation: mdc-checkbox-indeterminate-checked-mixedmark 500ms linear 0s;
                transition: none;
            }

            .mdc-checkbox--anim-indeterminate-unchecked .mdc-checkbox__mixedmark {
                animation: mdc-checkbox-indeterminate-unchecked-mixedmark 300ms linear 0s;
                transition: none;
            }

            .mdc-checkbox__native-control:checked ~ .mdc-checkbox__background,
            .mdc-checkbox__native-control:indeterminate ~ .mdc-checkbox__background {
                transition: border-color 90ms 0ms cubic-bezier(0, 0, 0.2, 1), background-color 90ms 0ms cubic-bezier(0, 0, 0.2, 1);
            }

            .mdc-checkbox__native-control:checked ~ .mdc-checkbox__background .mdc-checkbox__checkmark-path,
            .mdc-checkbox__native-control:indeterminate ~ .mdc-checkbox__background .mdc-checkbox__checkmark-path {
                stroke-dashoffset: 0;
            }

            .mdc-checkbox__background::before {
                position: absolute;
                transform: scale(0, 0);
                border-radius: 50%;
                opacity: 0;
                pointer-events: none;
                content: "";
                will-change: opacity, transform;
                transition: opacity 90ms 0ms cubic-bezier(0.4, 0, 0.6, 1), transform 90ms 0ms cubic-bezier(0.4, 0, 0.6, 1);
            }

            .mdc-checkbox__native-control:focus ~ .mdc-checkbox__background::before {
                transform: scale(1);
                opacity: 0.12;
                transition: opacity 80ms 0ms cubic-bezier(0, 0, 0.2, 1), transform 80ms 0ms cubic-bezier(0, 0, 0.2, 1);
            }

            .mdc-checkbox__native-control {
                position: absolute;
                margin: 0;
                padding: 0;
                opacity: 0;
                cursor: inherit;
            }

            .mdc-checkbox__native-control:disabled {
                cursor: default;
                pointer-events: none;
            }

            .mdc-checkbox--touch {
                margin-top: 4px;
                margin-bottom: 4px;
                margin-right: 4px;
                margin-left: 4px;
            }

            .mdc-checkbox--touch .mdc-checkbox__native-control {
                top: -4px;
                right: -4px;
                left: -4px;
                width: 48px;
                height: 48px;
            }

            .mdc-checkbox__native-control:checked ~ .mdc-checkbox__background .mdc-checkbox__checkmark {
                transition: opacity 180ms 0ms cubic-bezier(0, 0, 0.2, 1), transform 180ms 0ms cubic-bezier(0, 0, 0.2, 1);
                opacity: 1;
            }

            .mdc-checkbox__native-control:checked ~ .mdc-checkbox__background .mdc-checkbox__mixedmark {
                transform: scaleX(1) rotate(-45deg);
            }

            .mdc-checkbox__native-control:indeterminate ~ .mdc-checkbox__background .mdc-checkbox__checkmark {
                transform: rotate(45deg);
                opacity: 0;
                transition: opacity 90ms 0ms cubic-bezier(0.4, 0, 0.6, 1), transform 90ms 0ms cubic-bezier(0.4, 0, 0.6, 1);
            }

            .mdc-checkbox__native-control:indeterminate ~ .mdc-checkbox__background .mdc-checkbox__mixedmark {
                transform: scaleX(1) rotate(0deg);
                opacity: 1;
            }

            .mdc-checkbox {
                --mdc-ripple-fg-size: 0;
                --mdc-ripple-left: 0;
                --mdc-ripple-top: 0;
                --mdc-ripple-fg-scale: 1;
                --mdc-ripple-fg-translate-end: 0;
                --mdc-ripple-fg-translate-start: 0;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                will-change: transform, opacity;
            }

            .mdc-checkbox .mdc-checkbox__ripple::before,
            .mdc-checkbox .mdc-checkbox__ripple::after {
                position: absolute;
                border-radius: 50%;
                opacity: 0;
                pointer-events: none;
                content: "";
            }

            .mdc-checkbox .mdc-checkbox__ripple::before {
                transition: opacity 15ms linear, background-color 15ms linear;
                z-index: 1;
            }

            .mdc-checkbox.mdc-ripple-upgraded .mdc-checkbox__ripple::before {
                transform: scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-checkbox.mdc-ripple-upgraded .mdc-checkbox__ripple::after {
                top: 0;
                left: 0;
                transform: scale(0);
                transform-origin: center center;
            }

            .mdc-checkbox.mdc-ripple-upgraded--unbounded .mdc-checkbox__ripple::after {
                top: var(--mdc-ripple-top, 0);
                left: var(--mdc-ripple-left, 0);
            }

            .mdc-checkbox.mdc-ripple-upgraded--foreground-activation .mdc-checkbox__ripple::after {
                animation: mdc-ripple-fg-radius-in 225ms forwards, mdc-ripple-fg-opacity-in 75ms forwards;
            }

            .mdc-checkbox.mdc-ripple-upgraded--foreground-deactivation .mdc-checkbox__ripple::after {
                animation: mdc-ripple-fg-opacity-out 150ms;
                transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-checkbox .mdc-checkbox__ripple::before,
            .mdc-checkbox .mdc-checkbox__ripple::after {
                background-color: #000;
            }

            .mdc-checkbox .mdc-checkbox__ripple::before,
            .mdc-checkbox .mdc-checkbox__ripple::after {
                background-color: var(--mdc-theme-on-surface, #000);
            }

            .mdc-checkbox:hover .mdc-checkbox__ripple::before {
                opacity: 0.04;
            }

            .mdc-checkbox.mdc-ripple-upgraded--background-focused .mdc-checkbox__ripple::before,
            .mdc-checkbox:not(.mdc-ripple-upgraded):focus .mdc-checkbox__ripple::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-checkbox:not(.mdc-ripple-upgraded) .mdc-checkbox__ripple::after {
                transition: opacity 150ms linear;
            }

            .mdc-checkbox:not(.mdc-ripple-upgraded):active .mdc-checkbox__ripple::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-checkbox.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            .mdc-checkbox .mdc-checkbox__ripple::before,
            .mdc-checkbox .mdc-checkbox__ripple::after {
                top: calc(50% - 50%);
                left: calc(50% - 50%);
                width: 100%;
                height: 100%;
            }

            .mdc-checkbox.mdc-ripple-upgraded .mdc-checkbox__ripple::before,
            .mdc-checkbox.mdc-ripple-upgraded .mdc-checkbox__ripple::after {
                top: var(--mdc-ripple-top, calc(50% - 50%));
                left: var(--mdc-ripple-left, calc(50% - 50%));
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-checkbox.mdc-ripple-upgraded .mdc-checkbox__ripple::after {
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-checkbox__ripple {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
            }

            .mdc-ripple-upgraded--background-focused .mdc-checkbox__background::before {
                content: none;
            }

            .mdc-form-field {
                font-family: Roboto, sans-serif;
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                font-size: 0.875rem;
                line-height: 1.25rem;
                font-weight: 400;
                letter-spacing: 0.0178571429em;
                text-decoration: inherit;
                text-transform: inherit;
                color: rgba(0, 0, 0, 0.87);
                color: var(--mdc-theme-text-primary-on-background, rgba(0, 0, 0, 0.87));
                display: inline-flex;
                align-items: center;
                vertical-align: middle;
            }

            .mdc-form-field > label {
                margin-left: 0;
                margin-right: auto;
                padding-left: 4px;
                padding-right: 0;
                order: 0;
            }

            [dir="rtl"] .mdc-form-field > label,
            .mdc-form-field > label[dir="rtl"] {
                margin-left: auto;
                margin-right: 0;
            }

            [dir="rtl"] .mdc-form-field > label,
            .mdc-form-field > label[dir="rtl"] {
                padding-left: 0;
                padding-right: 4px;
            }

            .mdc-form-field--align-end > label {
                margin-left: auto;
                margin-right: 0;
                padding-left: 0;
                padding-right: 4px;
                order: -1;
            }

            [dir="rtl"] .mdc-form-field--align-end > label,
            .mdc-form-field--align-end > label[dir="rtl"] {
                margin-left: 0;
                margin-right: auto;
            }

            [dir="rtl"] .mdc-form-field--align-end > label,
            .mdc-form-field--align-end > label[dir="rtl"] {
                padding-left: 4px;
                padding-right: 0;
            }

            .mdc-form-field {
                font-family: Roboto, sans-serif;
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                font-size: 0.875rem;
                line-height: 1.25rem;
                font-weight: 400;
                letter-spacing: 0.0178571429em;
                text-decoration: inherit;
                text-transform: inherit;
                color: rgba(0, 0, 0, 0.87);
                color: var(--mdc-theme-text-primary-on-background, rgba(0, 0, 0, 0.87));
                display: inline-flex;
                align-items: center;
                vertical-align: middle;
            }

            .mdc-form-field > label {
                margin-left: 0;
                margin-right: auto;
                padding-left: 4px;
                padding-right: 0;
                order: 0;
            }

            [dir="rtl"] .mdc-form-field > label,
            .mdc-form-field > label[dir="rtl"] {
                margin-left: auto;
                margin-right: 0;
            }

            [dir="rtl"] .mdc-form-field > label,
            .mdc-form-field > label[dir="rtl"] {
                padding-left: 0;
                padding-right: 4px;
            }

            .mdc-form-field--align-end > label {
                margin-left: auto;
                margin-right: 0;
                padding-left: 0;
                padding-right: 4px;
                order: -1;
            }

            [dir="rtl"] .mdc-form-field--align-end > label,
            .mdc-form-field--align-end > label[dir="rtl"] {
                margin-left: 0;
                margin-right: auto;
            }

            [dir="rtl"] .mdc-form-field--align-end > label,
            .mdc-form-field--align-end > label[dir="rtl"] {
                padding-left: 4px;
                padding-right: 0;
            }

            .mdc-radio {
                padding: 10px;
                display: inline-block;
                position: relative;
                flex: 0 0 auto;
                box-sizing: content-box;
                width: 20px;
                height: 20px;
                cursor: pointer;
                will-change: opacity, transform, border-color, color;
            }

            .mdc-radio .mdc-radio__native-control:enabled:not(:checked) + .mdc-radio__background .mdc-radio__outer-circle {
                border-color: rgba(0, 0, 0, 0.54);
            }

            .mdc-radio .mdc-radio__native-control:enabled:checked + .mdc-radio__background .mdc-radio__outer-circle {
                border-color: #018786;
                border-color: var(--mdc-theme-secondary, #018786);
            }

            .mdc-radio .mdc-radio__native-control:enabled + .mdc-radio__background .mdc-radio__inner-circle {
                border-color: #018786;
                border-color: var(--mdc-theme-secondary, #018786);
            }

            .mdc-radio [aria-disabled="true"] .mdc-radio__native-control:not(:checked) + .mdc-radio__background .mdc-radio__outer-circle,
            .mdc-radio .mdc-radio__native-control:disabled:not(:checked) + .mdc-radio__background .mdc-radio__outer-circle {
                border-color: rgba(0, 0, 0, 0.38);
            }

            .mdc-radio [aria-disabled="true"] .mdc-radio__native-control:checked + .mdc-radio__background .mdc-radio__outer-circle,
            .mdc-radio .mdc-radio__native-control:disabled:checked + .mdc-radio__background .mdc-radio__outer-circle {
                border-color: rgba(0, 0, 0, 0.38);
            }

            .mdc-radio [aria-disabled="true"] .mdc-radio__native-control + .mdc-radio__background .mdc-radio__inner-circle,
            .mdc-radio .mdc-radio__native-control:disabled + .mdc-radio__background .mdc-radio__inner-circle {
                border-color: rgba(0, 0, 0, 0.38);
            }

            .mdc-radio .mdc-radio__background::before {
                background-color: #018786;
            }

            .mdc-radio .mdc-radio__background::before {
                background-color: var(--mdc-theme-secondary, #018786);
            }

            .mdc-radio .mdc-radio__background::before {
                top: -10px;
                left: -10px;
                width: 40px;
                height: 40px;
            }

            .mdc-radio .mdc-radio__native-control {
                top: 0px;
                right: 0px;
                left: 0px;
                width: 40px;
                height: 40px;
            }

            .mdc-radio__background {
                display: inline-block;
                position: relative;
                box-sizing: border-box;
                width: 20px;
                height: 20px;
            }

            .mdc-radio__background::before {
                position: absolute;
                transform: scale(0, 0);
                border-radius: 50%;
                opacity: 0;
                pointer-events: none;
                content: "";
                transition: opacity 120ms 0ms cubic-bezier(0.4, 0, 0.6, 1), transform 120ms 0ms cubic-bezier(0.4, 0, 0.6, 1);
            }

            .mdc-radio__outer-circle {
                position: absolute;
                top: 0;
                left: 0;
                box-sizing: border-box;
                width: 100%;
                height: 100%;
                border-width: 2px;
                border-style: solid;
                border-radius: 50%;
                transition: border-color 120ms 0ms cubic-bezier(0.4, 0, 0.6, 1);
            }

            .mdc-radio__inner-circle {
                position: absolute;
                top: 0;
                left: 0;
                box-sizing: border-box;
                width: 100%;
                height: 100%;
                transform: scale(0, 0);
                border-width: 10px;
                border-style: solid;
                border-radius: 50%;
                transition: transform 120ms 0ms cubic-bezier(0.4, 0, 0.6, 1), border-color 120ms 0ms cubic-bezier(0.4, 0, 0.6, 1);
            }

            .mdc-radio__native-control {
                position: absolute;
                margin: 0;
                padding: 0;
                opacity: 0;
                cursor: inherit;
                z-index: 1;
            }

            .mdc-radio--touch {
                margin-top: 4px;
                margin-bottom: 4px;
                margin-right: 4px;
                margin-left: 4px;
            }

            .mdc-radio--touch .mdc-radio__native-control {
                top: -4px;
                right: -4px;
                left: -4px;
                width: 48px;
                height: 48px;
            }

            .mdc-radio__native-control:checked + .mdc-radio__background,
            .mdc-radio__native-control:disabled + .mdc-radio__background {
                transition: opacity 120ms 0ms cubic-bezier(0, 0, 0.2, 1), transform 120ms 0ms cubic-bezier(0, 0, 0.2, 1);
            }

            .mdc-radio__native-control:checked + .mdc-radio__background .mdc-radio__outer-circle,
            .mdc-radio__native-control:disabled + .mdc-radio__background .mdc-radio__outer-circle {
                transition: border-color 120ms 0ms cubic-bezier(0, 0, 0.2, 1);
            }

            .mdc-radio__native-control:checked + .mdc-radio__background .mdc-radio__inner-circle,
            .mdc-radio__native-control:disabled + .mdc-radio__background .mdc-radio__inner-circle {
                transition: transform 120ms 0ms cubic-bezier(0, 0, 0.2, 1), border-color 120ms 0ms cubic-bezier(0, 0, 0.2, 1);
            }

            .mdc-radio--disabled {
                cursor: default;
                pointer-events: none;
            }

            .mdc-radio__native-control:checked + .mdc-radio__background .mdc-radio__inner-circle {
                transform: scale(0.5);
                transition: transform 120ms 0ms cubic-bezier(0, 0, 0.2, 1), border-color 120ms 0ms cubic-bezier(0, 0, 0.2, 1);
            }

            .mdc-radio__native-control:disabled + .mdc-radio__background,
            [aria-disabled="true"] .mdc-radio__native-control + .mdc-radio__background {
                cursor: default;
            }

            .mdc-radio__native-control:focus + .mdc-radio__background::before {
                transform: scale(1);
                opacity: 0.12;
                transition: opacity 120ms 0ms cubic-bezier(0, 0, 0.2, 1), transform 120ms 0ms cubic-bezier(0, 0, 0.2, 1);
            }

            .mdc-radio {
                --mdc-ripple-fg-size: 0;
                --mdc-ripple-left: 0;
                --mdc-ripple-top: 0;
                --mdc-ripple-fg-scale: 1;
                --mdc-ripple-fg-translate-end: 0;
                --mdc-ripple-fg-translate-start: 0;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                will-change: transform, opacity;
            }

            .mdc-radio .mdc-radio__ripple::before,
            .mdc-radio .mdc-radio__ripple::after {
                position: absolute;
                border-radius: 50%;
                opacity: 0;
                pointer-events: none;
                content: "";
            }

            .mdc-radio .mdc-radio__ripple::before {
                transition: opacity 15ms linear, background-color 15ms linear;
                z-index: 1;
            }

            .mdc-radio.mdc-ripple-upgraded .mdc-radio__ripple::before {
                transform: scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-radio.mdc-ripple-upgraded .mdc-radio__ripple::after {
                top: 0;
                left: 0;
                transform: scale(0);
                transform-origin: center center;
            }

            .mdc-radio.mdc-ripple-upgraded--unbounded .mdc-radio__ripple::after {
                top: var(--mdc-ripple-top, 0);
                left: var(--mdc-ripple-left, 0);
            }

            .mdc-radio.mdc-ripple-upgraded--foreground-activation .mdc-radio__ripple::after {
                animation: mdc-ripple-fg-radius-in 225ms forwards, mdc-ripple-fg-opacity-in 75ms forwards;
            }

            .mdc-radio.mdc-ripple-upgraded--foreground-deactivation .mdc-radio__ripple::after {
                animation: mdc-ripple-fg-opacity-out 150ms;
                transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-radio .mdc-radio__ripple::before,
            .mdc-radio .mdc-radio__ripple::after {
                top: calc(50% - 50%);
                left: calc(50% - 50%);
                width: 100%;
                height: 100%;
            }

            .mdc-radio.mdc-ripple-upgraded .mdc-radio__ripple::before,
            .mdc-radio.mdc-ripple-upgraded .mdc-radio__ripple::after {
                top: var(--mdc-ripple-top, calc(50% - 50%));
                left: var(--mdc-ripple-left, calc(50% - 50%));
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-radio.mdc-ripple-upgraded .mdc-radio__ripple::after {
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-radio .mdc-radio__ripple::before,
            .mdc-radio .mdc-radio__ripple::after {
                background-color: #018786;
            }

            .mdc-radio .mdc-radio__ripple::before,
            .mdc-radio .mdc-radio__ripple::after {
                background-color: var(--mdc-theme-secondary, #018786);
            }

            .mdc-radio:hover .mdc-radio__ripple::before {
                opacity: 0.04;
            }

            .mdc-radio.mdc-ripple-upgraded--background-focused .mdc-radio__ripple::before,
            .mdc-radio:not(.mdc-ripple-upgraded):focus .mdc-radio__ripple::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-radio:not(.mdc-ripple-upgraded) .mdc-radio__ripple::after {
                transition: opacity 150ms linear;
            }

            .mdc-radio:not(.mdc-ripple-upgraded):active .mdc-radio__ripple::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-radio.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            .mdc-radio.mdc-ripple-upgraded--background-focused .mdc-radio__background::before {
                content: none;
            }

            .mdc-radio__ripple {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
            }

            @keyframes mdc-ripple-fg-radius-in {
                from {
                    animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                    transform: translate(var(--mdc-ripple-fg-translate-start, 0)) scale(1);
                }

                to {
                    transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1));
                }
            }

            @keyframes mdc-ripple-fg-opacity-in {
                from {
                    animation-timing-function: linear;
                    opacity: 0;
                }

                to {
                    opacity: var(--mdc-ripple-fg-opacity, 0);
                }
            }

            @keyframes mdc-ripple-fg-opacity-out {
                from {
                    animation-timing-function: linear;
                    opacity: var(--mdc-ripple-fg-opacity, 0);
                }

                to {
                    opacity: 0;
                }
            }

            .mdc-ripple-surface--test-edge-var-bug {
                --mdc-ripple-surface-test-edge-var: 1px solid #000;
                visibility: hidden;
            }

            .mdc-ripple-surface--test-edge-var-bug::before {
                border: var(--mdc-ripple-surface-test-edge-var);
            }

            .mdc-ripple-surface {
                --mdc-ripple-fg-size: 0;
                --mdc-ripple-left: 0;
                --mdc-ripple-top: 0;
                --mdc-ripple-fg-scale: 1;
                --mdc-ripple-fg-translate-end: 0;
                --mdc-ripple-fg-translate-start: 0;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                will-change: transform, opacity;
                position: relative;
                outline: none;
                overflow: hidden;
            }

            .mdc-ripple-surface::before,
            .mdc-ripple-surface::after {
                position: absolute;
                border-radius: 50%;
                opacity: 0;
                pointer-events: none;
                content: "";
            }

            .mdc-ripple-surface::before {
                transition: opacity 15ms linear, background-color 15ms linear;
                z-index: 1;
            }

            .mdc-ripple-surface.mdc-ripple-upgraded::before {
                transform: scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-ripple-surface.mdc-ripple-upgraded::after {
                top: 0;
                left: 0;
                transform: scale(0);
                transform-origin: center center;
            }

            .mdc-ripple-surface.mdc-ripple-upgraded--unbounded::after {
                top: var(--mdc-ripple-top, 0);
                left: var(--mdc-ripple-left, 0);
            }

            .mdc-ripple-surface.mdc-ripple-upgraded--foreground-activation::after {
                animation: mdc-ripple-fg-radius-in 225ms forwards, mdc-ripple-fg-opacity-in 75ms forwards;
            }

            .mdc-ripple-surface.mdc-ripple-upgraded--foreground-deactivation::after {
                animation: mdc-ripple-fg-opacity-out 150ms;
                transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-ripple-surface::before,
            .mdc-ripple-surface::after {
                background-color: #000;
            }

            .mdc-ripple-surface:hover::before {
                opacity: 0.04;
            }

            .mdc-ripple-surface.mdc-ripple-upgraded--background-focused::before,
            .mdc-ripple-surface:not(.mdc-ripple-upgraded):focus::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-ripple-surface:not(.mdc-ripple-upgraded)::after {
                transition: opacity 150ms linear;
            }

            .mdc-ripple-surface:not(.mdc-ripple-upgraded):active::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-ripple-surface.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            .mdc-ripple-surface::before,
            .mdc-ripple-surface::after {
                top: calc(50% - 100%);
                left: calc(50% - 100%);
                width: 200%;
                height: 200%;
            }

            .mdc-ripple-surface.mdc-ripple-upgraded::after {
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-ripple-surface[data-mdc-ripple-is-unbounded] {
                overflow: visible;
            }

            .mdc-ripple-surface[data-mdc-ripple-is-unbounded]::before,
            .mdc-ripple-surface[data-mdc-ripple-is-unbounded]::after {
                top: calc(50% - 50%);
                left: calc(50% - 50%);
                width: 100%;
                height: 100%;
            }

            .mdc-ripple-surface[data-mdc-ripple-is-unbounded].mdc-ripple-upgraded::before,
            .mdc-ripple-surface[data-mdc-ripple-is-unbounded].mdc-ripple-upgraded::after {
                top: var(--mdc-ripple-top, calc(50% - 50%));
                left: var(--mdc-ripple-left, calc(50% - 50%));
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-ripple-surface[data-mdc-ripple-is-unbounded].mdc-ripple-upgraded::after {
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-ripple-surface--primary::before,
            .mdc-ripple-surface--primary::after {
                background-color: #6200ee;
            }

            .mdc-ripple-surface--primary::before,
            .mdc-ripple-surface--primary::after {
                background-color: var(--mdc-theme-primary, #6200ee);
            }

            .mdc-ripple-surface--primary:hover::before {
                opacity: 0.04;
            }

            .mdc-ripple-surface--primary.mdc-ripple-upgraded--background-focused::before,
            .mdc-ripple-surface--primary:not(.mdc-ripple-upgraded):focus::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-ripple-surface--primary:not(.mdc-ripple-upgraded)::after {
                transition: opacity 150ms linear;
            }

            .mdc-ripple-surface--primary:not(.mdc-ripple-upgraded):active::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-ripple-surface--primary.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            .mdc-ripple-surface--accent::before,
            .mdc-ripple-surface--accent::after {
                background-color: #018786;
            }

            .mdc-ripple-surface--accent::before,
            .mdc-ripple-surface--accent::after {
                background-color: var(--mdc-theme-secondary, #018786);
            }

            .mdc-ripple-surface--accent:hover::before {
                opacity: 0.04;
            }

            .mdc-ripple-surface--accent.mdc-ripple-upgraded--background-focused::before,
            .mdc-ripple-surface--accent:not(.mdc-ripple-upgraded):focus::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-ripple-surface--accent:not(.mdc-ripple-upgraded)::after {
                transition: opacity 150ms linear;
            }

            .mdc-ripple-surface--accent:not(.mdc-ripple-upgraded):active::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-ripple-surface--accent.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            .mdc-text-field-helper-text {
                font-family: Roboto, sans-serif;
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                font-size: 0.75rem;
                line-height: 1.25rem;
                font-weight: 400;
                letter-spacing: 0.0333333333em;
                text-decoration: inherit;
                text-transform: inherit;
                display: block;
                margin-top: 0;
                line-height: normal;
                margin: 0;
                transition: opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
                opacity: 0;
                will-change: opacity;
            }

            .mdc-text-field-helper-text::before {
                display: inline-block;
                width: 0;
                height: 16px;
                content: "";
                vertical-align: 0;
            }

            .mdc-text-field-helper-text--persistent {
                transition: none;
                opacity: 1;
                will-change: initial;
            }

            .mdc-text-field-character-counter {
                font-family: Roboto, sans-serif;
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                font-size: 0.75rem;
                line-height: 1.25rem;
                font-weight: 400;
                letter-spacing: 0.0333333333em;
                text-decoration: inherit;
                text-transform: inherit;
                display: block;
                margin-top: 0;
                line-height: normal;
                margin-left: auto;
                margin-right: 0;
                padding-left: 16px;
                padding-right: 0;
                white-space: nowrap;
            }

            .mdc-text-field-character-counter::before {
                display: inline-block;
                width: 0;
                height: 16px;
                content: "";
                vertical-align: 0;
            }

            [dir="rtl"] .mdc-text-field-character-counter,
            .mdc-text-field-character-counter[dir="rtl"] {
                margin-left: 0;
                margin-right: auto;
            }

            [dir="rtl"] .mdc-text-field-character-counter,
            .mdc-text-field-character-counter[dir="rtl"] {
                padding-left: 0;
                padding-right: 16px;
            }

            .mdc-text-field--with-leading-icon .mdc-text-field__icon,
            .mdc-text-field--with-trailing-icon .mdc-text-field__icon {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
            }

            .mdc-text-field__icon:not([tabindex]),
            .mdc-text-field__icon[tabindex="-1"] {
                /*! cursor:default; */
                /*! pointer-events:none */
            }

            .mdc-text-field {
                --mdc-ripple-fg-size: 0;
                --mdc-ripple-left: 0;
                --mdc-ripple-top: 0;
                --mdc-ripple-fg-scale: 1;
                --mdc-ripple-fg-translate-end: 0;
                --mdc-ripple-fg-translate-start: 0;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                will-change: transform, opacity;
                height: 56px;
                border-radius: 4px 4px 0 0;
                display: inline-flex;
                position: relative;
                box-sizing: border-box;
                overflow: hidden;
                will-change: opacity, transform, color;
            }

            .mdc-text-field::before,
            .mdc-text-field::after {
                position: absolute;
                border-radius: 50%;
                opacity: 0;
                pointer-events: none;
                content: "";
            }

            .mdc-text-field::before {
                transition: opacity 15ms linear, background-color 15ms linear;
                z-index: 1;
            }

            .mdc-text-field.mdc-ripple-upgraded::before {
                transform: scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-text-field.mdc-ripple-upgraded::after {
                top: 0;
                left: 0;
                transform: scale(0);
                transform-origin: center center;
            }

            .mdc-text-field.mdc-ripple-upgraded--unbounded::after {
                top: var(--mdc-ripple-top, 0);
                left: var(--mdc-ripple-left, 0);
            }

            .mdc-text-field.mdc-ripple-upgraded--foreground-activation::after {
                animation: mdc-ripple-fg-radius-in 225ms forwards, mdc-ripple-fg-opacity-in 75ms forwards;
            }

            .mdc-text-field.mdc-ripple-upgraded--foreground-deactivation::after {
                animation: mdc-ripple-fg-opacity-out 150ms;
                transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-text-field::before,
            .mdc-text-field::after {
                background-color: rgba(0, 0, 0, 0.87);
            }

            .mdc-text-field:hover::before {
                opacity: 0.04;
            }

            .mdc-text-field.mdc-ripple-upgraded--background-focused::before,
            .mdc-text-field:not(.mdc-ripple-upgraded):focus::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-text-field::before,
            .mdc-text-field::after {
                top: calc(50% - 100%);
                left: calc(50% - 100%);
                width: 200%;
                height: 200%;
            }

            .mdc-text-field.mdc-ripple-upgraded::after {
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-text-field:not(.mdc-text-field--disabled) .mdc-floating-label {
                color: rgba(0, 0, 0, 0.6);
            }

            .mdc-text-field:not(.mdc-text-field--disabled) .mdc-text-field__input {
                color: rgba(0, 0, 0, 0.87);
            }

            .mdc-text-field .mdc-text-field__input {
                caret-color: #6200ee;
                caret-color: var(--mdc-theme-primary, #6200ee);
            }

            .mdc-text-field:not(.mdc-text-field--disabled) .mdc-text-field__input {
                border-bottom-color: rgba(0, 0, 0, 0.42);
            }

            .mdc-text-field:not(.mdc-text-field--disabled) .mdc-text-field__input:hover {
                border-bottom-color: rgba(0, 0, 0, 0.87);
            }

            .mdc-text-field .mdc-line-ripple {
                background-color: #6200ee;
                background-color: var(--mdc-theme-primary, #6200ee);
            }

            .mdc-text-field:not(.mdc-text-field--disabled) + .mdc-text-field-helper-line .mdc-text-field-helper-text {
                color: rgba(0, 0, 0, 0.6);
            }

            .mdc-text-field:not(.mdc-text-field--disabled) .mdc-text-field-character-counter,
            .mdc-text-field:not(.mdc-text-field--disabled) + .mdc-text-field-helper-line .mdc-text-field-character-counter {
                color: rgba(0, 0, 0, 0.6);
            }

            .mdc-text-field:not(.mdc-text-field--disabled) .mdc-text-field__icon {
                color: rgba(0, 0, 0, 0.54);
            }

            .mdc-text-field:not(.mdc-text-field--disabled) {
                background-color: #f5f5f5;
            }

            .mdc-text-field .mdc-floating-label {
                left: 16px;
                right: initial;
                top: 50%;
                transform: translateY(-50%);
                pointer-events: none;
            }

            [dir="rtl"] .mdc-text-field .mdc-floating-label,
            .mdc-text-field .mdc-floating-label[dir="rtl"] {
                left: initial;
                right: 16px;
            }

            .mdc-text-field .mdc-floating-label--float-above {
                transform: translateY(-106%) scale(0.75);
            }

            .mdc-text-field--textarea .mdc-floating-label {
                left: 4px;
                right: initial;
            }

            [dir="rtl"] .mdc-text-field--textarea .mdc-floating-label,
            .mdc-text-field--textarea .mdc-floating-label[dir="rtl"] {
                left: initial;
                right: 4px;
            }

            .mdc-text-field--outlined .mdc-floating-label {
                left: 4px;
                right: initial;
            }

            [dir="rtl"] .mdc-text-field--outlined .mdc-floating-label,
            .mdc-text-field--outlined .mdc-floating-label[dir="rtl"] {
                left: initial;
                right: 4px;
            }

            .mdc-text-field--outlined--with-leading-icon .mdc-floating-label {
                left: 36px;
                right: initial;
            }

            [dir="rtl"] .mdc-text-field--outlined--with-leading-icon .mdc-floating-label,
            .mdc-text-field--outlined--with-leading-icon .mdc-floating-label[dir="rtl"] {
                left: initial;
                right: 36px;
            }

            .mdc-text-field--outlined--with-leading-icon .mdc-floating-label--float-above {
                left: 40px;
                right: initial;
            }

            [dir="rtl"] .mdc-text-field--outlined--with-leading-icon .mdc-floating-label--float-above,
            .mdc-text-field--outlined--with-leading-icon .mdc-floating-label--float-above[dir="rtl"] {
                left: initial;
                right: 40px;
            }

            .mdc-text-field__input {
                font-family: Roboto, sans-serif;
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                font-size: 1rem;
                font-weight: 400;
                letter-spacing: 0.009375em;
                text-decoration: inherit;
                text-transform: inherit;
                align-self: flex-end;
                box-sizing: border-box;
                width: 100%;
                height: 100%;
                padding: 20px 16px 6px;
                transition: opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
                border: none;
                border-bottom: 1px solid;
                border-radius: 0;
                background: none;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }

            .mdc-text-field__input:-ms-input-placeholder {
                transition: opacity 67ms cubic-bezier(0.4, 0, 0.2, 1);
                opacity: 0;
                color: rgba(0, 0, 0, 0.54);
            }

            .mdc-text-field__input::-ms-input-placeholder {
                transition: opacity 67ms cubic-bezier(0.4, 0, 0.2, 1);
                opacity: 0;
                color: rgba(0, 0, 0, 0.54);
            }

            .mdc-text-field__input::placeholder {
                transition: opacity 67ms cubic-bezier(0.4, 0, 0.2, 1);
                opacity: 0;
                color: rgba(0, 0, 0, 0.54);
            }

            .mdc-text-field__input:-ms-input-placeholder {
                color: rgba(0, 0, 0, 0.54) !important;
            }

            .mdc-text-field--fullwidth .mdc-text-field__input:-ms-input-placeholder,
            .mdc-text-field--no-label .mdc-text-field__input:-ms-input-placeholder,
            .mdc-text-field--focused .mdc-text-field__input:-ms-input-placeholder {
                transition-delay: 40ms;
                transition-duration: 110ms;
                opacity: 1;
            }

            .mdc-text-field--fullwidth .mdc-text-field__input::-ms-input-placeholder,
            .mdc-text-field--no-label .mdc-text-field__input::-ms-input-placeholder,
            .mdc-text-field--focused .mdc-text-field__input::-ms-input-placeholder {
                transition-delay: 40ms;
                transition-duration: 110ms;
                opacity: 1;
            }

            .mdc-text-field--fullwidth .mdc-text-field__input::placeholder,
            .mdc-text-field--no-label .mdc-text-field__input::placeholder,
            .mdc-text-field--focused .mdc-text-field__input::placeholder {
                transition-delay: 40ms;
                transition-duration: 110ms;
                opacity: 1;
            }

            .mdc-text-field__input:focus {
                outline: none;
            }

            .mdc-text-field__input:invalid {
                box-shadow: none;
            }

            .mdc-text-field__input:-webkit-autofill {
                z-index: auto !important;
            }

            .mdc-text-field--no-label:not(.mdc-text-field--outlined):not(.mdc-text-field--textarea) .mdc-text-field__input {
                padding-top: 16px;
                padding-bottom: 16px;
            }

            .mdc-text-field__input:-webkit-autofill + .mdc-floating-label {
                transform: translateY(-50%) scale(0.75);
                cursor: auto;
            }

            .mdc-text-field--outlined {
                border: none;
                overflow: visible;
            }

            .mdc-text-field--outlined:not(.mdc-text-field--disabled) .mdc-notched-outline__leading,
            .mdc-text-field--outlined:not(.mdc-text-field--disabled) .mdc-notched-outline__notch,
            .mdc-text-field--outlined:not(.mdc-text-field--disabled) .mdc-notched-outline__trailing {
                border-color: rgba(0, 0, 0, 0.38);
            }

            .mdc-text-field--outlined:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__input:hover ~ .mdc-notched-outline .mdc-notched-outline__leading,
            .mdc-text-field--outlined:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__input:hover ~ .mdc-notched-outline .mdc-notched-outline__notch,
            .mdc-text-field--outlined:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__input:hover ~ .mdc-notched-outline .mdc-notched-outline__trailing,
            .mdc-text-field--outlined:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__icon:hover ~ .mdc-notched-outline .mdc-notched-outline__leading,
            .mdc-text-field--outlined:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__icon:hover ~ .mdc-notched-outline .mdc-notched-outline__notch,
            .mdc-text-field--outlined:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__icon:hover ~ .mdc-notched-outline .mdc-notched-outline__trailing {
                border-color: rgba(0, 0, 0, 0.87);
            }

            .mdc-text-field--outlined:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__leading,
            .mdc-text-field--outlined:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__notch,
            .mdc-text-field--outlined:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__trailing {
                border-color: #6200ee;
                border-color: var(--mdc-theme-primary, #6200ee);
            }

            .mdc-text-field--outlined .mdc-floating-label--shake {
                animation: mdc-floating-label-shake-float-above-text-field-outlined 250ms 1;
            }

            .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__leading {
                border-radius: 4px 0 0 4px;
            }

            [dir="rtl"] .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__leading,
            .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__leading[dir="rtl"] {
                border-radius: 0 4px 4px 0;
            }

            .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__trailing {
                border-radius: 0 4px 4px 0;
            }

            [dir="rtl"] .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__trailing,
            .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__trailing[dir="rtl"] {
                border-radius: 4px 0 0 4px;
            }

            .mdc-text-field--outlined .mdc-floating-label--float-above {
                transform: translateY(-37.25px) scale(1);
            }

            .mdc-text-field--outlined .mdc-floating-label--float-above {
                font-size: 0.75rem;
            }

            .mdc-text-field--outlined.mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--outlined .mdc-notched-outline--upgraded .mdc-floating-label--float-above {
                transform: translateY(-34.75px) scale(0.75);
            }

            .mdc-text-field--outlined.mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--outlined .mdc-notched-outline--upgraded .mdc-floating-label--float-above {
                font-size: 1rem;
            }

            .mdc-text-field--outlined .mdc-notched-outline--notched .mdc-notched-outline__notch {
                padding-top: 1px;
            }

            .mdc-text-field--outlined::before,
            .mdc-text-field--outlined::after {
                content: none;
            }

            .mdc-text-field--outlined:not(.mdc-text-field--disabled) {
                background-color: transparent;
            }

            .mdc-text-field--outlined .mdc-text-field__input {
                display: flex;
                padding: 12px 16px 14px;
                border: none !important;
                background-color: transparent;
                z-index: 1;
            }

            .mdc-text-field--outlined .mdc-text-field__icon {
                /*! z-index:2 */
            }

            .mdc-text-field--outlined.mdc-text-field--focused .mdc-notched-outline--notched .mdc-notched-outline__notch {
                padding-top: 2px;
            }

            .mdc-text-field--outlined.mdc-text-field--focused .mdc-notched-outline__leading,
            .mdc-text-field--outlined.mdc-text-field--focused .mdc-notched-outline__notch,
            .mdc-text-field--outlined.mdc-text-field--focused .mdc-notched-outline__trailing {
                border-width: 2px;
            }

            .mdc-text-field--outlined.mdc-text-field--disabled {
                background-color: transparent;
            }

            .mdc-text-field--outlined.mdc-text-field--disabled .mdc-notched-outline__leading,
            .mdc-text-field--outlined.mdc-text-field--disabled .mdc-notched-outline__notch,
            .mdc-text-field--outlined.mdc-text-field--disabled .mdc-notched-outline__trailing {
                border-color: rgba(0, 0, 0, 0.06);
            }

            .mdc-text-field--outlined.mdc-text-field--disabled .mdc-text-field__input {
                border-bottom: none;
            }

            .mdc-text-field--outlined.mdc-text-field--dense {
                height: 48px;
            }

            .mdc-text-field--outlined.mdc-text-field--dense .mdc-floating-label--float-above {
                transform: translateY(-134%) scale(1);
            }

            .mdc-text-field--outlined.mdc-text-field--dense .mdc-floating-label--float-above {
                font-size: 0.8rem;
            }

            .mdc-text-field--outlined.mdc-text-field--dense.mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--outlined.mdc-text-field--dense .mdc-notched-outline--upgraded .mdc-floating-label--float-above {
                transform: translateY(-120%) scale(0.8);
            }

            .mdc-text-field--outlined.mdc-text-field--dense.mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--outlined.mdc-text-field--dense .mdc-notched-outline--upgraded .mdc-floating-label--float-above {
                font-size: 1rem;
            }

            .mdc-text-field--outlined.mdc-text-field--dense .mdc-floating-label--shake {
                animation: mdc-floating-label-shake-float-above-text-field-outlined-dense 250ms 1;
            }

            .mdc-text-field--outlined.mdc-text-field--dense .mdc-text-field__input {
                padding: 12px 12px 7px;
            }

            .mdc-text-field--outlined.mdc-text-field--dense .mdc-floating-label {
                top: 14px;
            }

            .mdc-text-field--outlined.mdc-text-field--dense .mdc-text-field__icon {
                top: 12px;
            }

            .mdc-text-field--with-leading-icon .mdc-text-field__icon {
                left: 16px;
                /*! right:initial; */
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon .mdc-text-field__icon,
            .mdc-text-field--with-leading-icon .mdc-text-field__icon[dir="rtl"] {
                left: initial;
                right: 16px;
            }

            .mdc-text-field--with-leading-icon .mdc-text-field__input {
                padding-left: 48px;
                padding-right: 16px;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon .mdc-text-field__input,
            .mdc-text-field--with-leading-icon .mdc-text-field__input[dir="rtl"] {
                padding-left: 16px;
                padding-right: 48px;
            }

            .mdc-text-field--with-leading-icon .mdc-floating-label {
                left: 48px;
                right: initial;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon .mdc-floating-label,
            .mdc-text-field--with-leading-icon .mdc-floating-label[dir="rtl"] {
                left: initial;
                right: 48px;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-text-field__icon {
                /*! left:16px; */
                /*! right:initial */
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-text-field__icon,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-text-field__icon[dir="rtl"] {
                left: initial;
                right: 16px;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-text-field__input {
                /*! padding-left:48px; */
                /*! padding-right:16px */
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-text-field__input,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-text-field__input[dir="rtl"] {
                padding-left: 16px;
                padding-right: 48px;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-floating-label--float-above {
                transform: translateY(-37.25px) translateX(-32px) scale(1);
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-floating-label--float-above,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-floating-label--float-above[dir="rtl"] {
                transform: translateY(-37.25px) translateX(32px) scale(1);
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-floating-label--float-above {
                font-size: 0.75rem;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-notched-outline--upgraded .mdc-floating-label--float-above {
                transform: translateY(-34.75px) translateX(-32px) scale(0.75);
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-notched-outline--upgraded .mdc-floating-label--float-above[dir="rtl"],
            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-notched-outline--upgraded .mdc-floating-label--float-above[dir="rtl"] {
                transform: translateY(-34.75px) translateX(32px) scale(0.75);
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-notched-outline--upgraded .mdc-floating-label--float-above {
                font-size: 1rem;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-floating-label--shake {
                animation: mdc-floating-label-shake-float-above-text-field-outlined-leading-icon 250ms 1;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-floating-label--shake,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined[dir="rtl"] .mdc-floating-label--shake {
                animation: mdc-floating-label-shake-float-above-text-field-outlined-leading-icon-rtl 250ms 1;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-floating-label {
                left: 36px;
                right: initial;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-floating-label,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined .mdc-floating-label[dir="rtl"] {
                left: initial;
                right: 36px;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense .mdc-floating-label--float-above {
                transform: translateY(-134%) translateX(-21px) scale(1);
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense .mdc-floating-label--float-above,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense .mdc-floating-label--float-above[dir="rtl"] {
                transform: translateY(-134%) translateX(21px) scale(1);
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense .mdc-floating-label--float-above {
                font-size: 0.8rem;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense.mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense .mdc-notched-outline--upgraded .mdc-floating-label--float-above {
                transform: translateY(-120%) translateX(-21px) scale(0.8);
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense.mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense.mdc-notched-outline--upgraded .mdc-floating-label--float-above[dir="rtl"],
            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense .mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense .mdc-notched-outline--upgraded .mdc-floating-label--float-above[dir="rtl"] {
                transform: translateY(-120%) translateX(21px) scale(0.8);
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense.mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense .mdc-notched-outline--upgraded .mdc-floating-label--float-above {
                font-size: 1rem;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense .mdc-floating-label--shake {
                animation: mdc-floating-label-shake-float-above-text-field-outlined-leading-icon-dense 250ms 1;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense .mdc-floating-label--shake,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense[dir="rtl"] .mdc-floating-label--shake {
                animation: mdc-floating-label-shake-float-above-text-field-outlined-leading-icon-dense-rtl 250ms 1;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense .mdc-floating-label {
                left: 32px;
                right: initial;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense .mdc-floating-label,
            .mdc-text-field--with-leading-icon.mdc-text-field--outlined.mdc-text-field--dense .mdc-floating-label[dir="rtl"] {
                left: initial;
                right: 32px;
            }

            .mdc-text-field--with-trailing-icon .mdc-text-field__icon {
                left: initial;
                right: 12px;
            }

            [dir="rtl"] .mdc-text-field--with-trailing-icon .mdc-text-field__icon,
            .mdc-text-field--with-trailing-icon .mdc-text-field__icon[dir="rtl"] {
                left: 12px;
                right: initial;
            }

            .mdc-text-field--with-trailing-icon .mdc-text-field__input {
                padding-left: 16px;
                padding-right: 48px;
            }

            [dir="rtl"] .mdc-text-field--with-trailing-icon .mdc-text-field__input,
            .mdc-text-field--with-trailing-icon .mdc-text-field__input[dir="rtl"] {
                padding-left: 48px;
                padding-right: 16px;
            }

            .mdc-text-field--with-trailing-icon.mdc-text-field--outlined .mdc-text-field__icon {
                left: initial;
                right: 16px;
            }

            [dir="rtl"] .mdc-text-field--with-trailing-icon.mdc-text-field--outlined .mdc-text-field__icon,
            .mdc-text-field--with-trailing-icon.mdc-text-field--outlined .mdc-text-field__icon[dir="rtl"] {
                left: 16px;
                right: initial;
            }

            .mdc-text-field--with-trailing-icon.mdc-text-field--outlined .mdc-text-field__input {
                padding-left: 16px;
                padding-right: 48px;
            }

            [dir="rtl"] .mdc-text-field--with-trailing-icon.mdc-text-field--outlined .mdc-text-field__input,
            .mdc-text-field--with-trailing-icon.mdc-text-field--outlined .mdc-text-field__input[dir="rtl"] {
                padding-left: 48px;
                padding-right: 16px;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon .mdc-text-field__icon {
                left: 16px;
                right: auto;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon .mdc-text-field__icon,
            .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon .mdc-text-field__icon[dir="rtl"] {
                left: auto;
                right: 16px;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon .mdc-text-field__icon ~ .mdc-text-field__icon {
                right: 12px;
                left: auto;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon .mdc-text-field__icon ~ .mdc-text-field__icon,
            .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon .mdc-text-field__icon ~ .mdc-text-field__icon[dir="rtl"] {
                right: auto;
                left: 12px;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon .mdc-text-field__input {
                padding-left: 48px;
                padding-right: 48px;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon .mdc-text-field__input,
            .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon .mdc-text-field__input[dir="rtl"] {
                padding-left: 48px;
                padding-right: 48px;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--dense .mdc-text-field__icon,
            .mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__icon {
                bottom: 16px;
                transform: scale(0.8);
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--dense .mdc-text-field__icon {
                left: 12px;
                right: initial;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--dense .mdc-text-field__icon,
            .mdc-text-field--with-leading-icon.mdc-text-field--dense .mdc-text-field__icon[dir="rtl"] {
                left: initial;
                right: 12px;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--dense .mdc-text-field__input {
                padding-left: 44px;
                padding-right: 16px;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--dense .mdc-text-field__input,
            .mdc-text-field--with-leading-icon.mdc-text-field--dense .mdc-text-field__input[dir="rtl"] {
                padding-left: 16px;
                padding-right: 44px;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--dense .mdc-floating-label {
                left: 44px;
                right: initial;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--dense .mdc-floating-label,
            .mdc-text-field--with-leading-icon.mdc-text-field--dense .mdc-floating-label[dir="rtl"] {
                left: initial;
                right: 44px;
            }

            .mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__icon {
                left: initial;
                right: 12px;
            }

            [dir="rtl"] .mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__icon,
            .mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__icon[dir="rtl"] {
                left: 12px;
                right: initial;
            }

            .mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__input {
                padding-left: 16px;
                padding-right: 44px;
            }

            [dir="rtl"] .mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__input,
            .mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__input[dir="rtl"] {
                padding-left: 44px;
                padding-right: 16px;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__icon {
                left: 12px;
                right: auto;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__icon,
            .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__icon[dir="rtl"] {
                left: auto;
                right: 12px;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__icon ~ .mdc-text-field__icon {
                right: 12px;
                left: auto;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__icon ~ .mdc-text-field__icon,
            .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__icon ~ .mdc-text-field__icon[dir="rtl"] {
                right: auto;
                left: 12px;
            }

            .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__input {
                padding-left: 44px;
                padding-right: 44px;
            }

            [dir="rtl"] .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__input,
            .mdc-text-field--with-leading-icon.mdc-text-field--with-trailing-icon.mdc-text-field--dense .mdc-text-field__input[dir="rtl"] {
                padding-left: 44px;
                padding-right: 44px;
            }

            .mdc-text-field--dense .mdc-floating-label--float-above {
                transform: translateY(-70%) scale(0.8);
            }

            .mdc-text-field--dense .mdc-floating-label--shake {
                animation: mdc-floating-label-shake-float-above-text-field-dense 250ms 1;
            }

            .mdc-text-field--dense .mdc-text-field__input {
                padding: 12px 12px 0;
            }

            .mdc-text-field--dense .mdc-floating-label {
                font-size: 0.813rem;
            }

            .mdc-text-field--dense .mdc-floating-label--float-above {
                font-size: 0.813rem;
            }

            .mdc-text-field__input:required ~ .mdc-floating-label::after,
            .mdc-text-field__input:required ~ .mdc-notched-outline .mdc-floating-label::after {
                margin-left: 1px;
                content: "*";
            }

            .mdc-text-field--textarea {
                display: inline-flex;
                width: auto;
                height: auto;
                transition: none;
                overflow: visible;
            }

            .mdc-text-field--textarea:not(.mdc-text-field--disabled) .mdc-notched-outline__leading,
            .mdc-text-field--textarea:not(.mdc-text-field--disabled) .mdc-notched-outline__notch,
            .mdc-text-field--textarea:not(.mdc-text-field--disabled) .mdc-notched-outline__trailing {
                border-color: rgba(0, 0, 0, 0.38);
            }

            .mdc-text-field--textarea:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__input:hover ~ .mdc-notched-outline .mdc-notched-outline__leading,
            .mdc-text-field--textarea:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__input:hover ~ .mdc-notched-outline .mdc-notched-outline__notch,
            .mdc-text-field--textarea:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__input:hover ~ .mdc-notched-outline .mdc-notched-outline__trailing,
            .mdc-text-field--textarea:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__icon:hover ~ .mdc-notched-outline .mdc-notched-outline__leading,
            .mdc-text-field--textarea:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__icon:hover ~ .mdc-notched-outline .mdc-notched-outline__notch,
            .mdc-text-field--textarea:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__icon:hover ~ .mdc-notched-outline .mdc-notched-outline__trailing {
                border-color: rgba(0, 0, 0, 0.87);
            }

            .mdc-text-field--textarea:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__leading,
            .mdc-text-field--textarea:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__notch,
            .mdc-text-field--textarea:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__trailing {
                border-color: #6200ee;
                border-color: var(--mdc-theme-primary, #6200ee);
            }

            .mdc-text-field--textarea .mdc-floating-label--shake {
                animation: mdc-floating-label-shake-float-above-textarea 250ms 1;
            }

            .mdc-text-field--textarea .mdc-notched-outline .mdc-notched-outline__leading {
                border-radius: 4px 0 0 4px;
            }

            [dir="rtl"] .mdc-text-field--textarea .mdc-notched-outline .mdc-notched-outline__leading,
            .mdc-text-field--textarea .mdc-notched-outline .mdc-notched-outline__leading[dir="rtl"] {
                border-radius: 0 4px 4px 0;
            }

            .mdc-text-field--textarea .mdc-notched-outline .mdc-notched-outline__trailing {
                border-radius: 0 4px 4px 0;
            }

            [dir="rtl"] .mdc-text-field--textarea .mdc-notched-outline .mdc-notched-outline__trailing,
            .mdc-text-field--textarea .mdc-notched-outline .mdc-notched-outline__trailing[dir="rtl"] {
                border-radius: 4px 0 0 4px;
            }

            .mdc-text-field--textarea::before,
            .mdc-text-field--textarea::after {
                content: none;
            }

            .mdc-text-field--textarea:not(.mdc-text-field--disabled) {
                background-color: transparent;
            }

            .mdc-text-field--textarea .mdc-floating-label--float-above {
                transform: translateY(-144%) scale(1);
            }

            .mdc-text-field--textarea .mdc-floating-label--float-above {
                font-size: 0.75rem;
            }

            .mdc-text-field--textarea.mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--textarea .mdc-notched-outline--upgraded .mdc-floating-label--float-above {
                transform: translateY(-130%) scale(0.75);
            }

            .mdc-text-field--textarea.mdc-notched-outline--upgraded .mdc-floating-label--float-above,
            .mdc-text-field--textarea .mdc-notched-outline--upgraded .mdc-floating-label--float-above {
                font-size: 1rem;
            }

            .mdc-text-field--textarea .mdc-text-field-character-counter {
                left: initial;
                right: 16px;
                position: absolute;
                bottom: 13px;
            }

            [dir="rtl"] .mdc-text-field--textarea .mdc-text-field-character-counter,
            .mdc-text-field--textarea .mdc-text-field-character-counter[dir="rtl"] {
                left: 16px;
                right: initial;
            }

            .mdc-text-field--textarea .mdc-text-field__input {
                align-self: auto;
                box-sizing: border-box;
                height: auto;
                margin: 8px 1px 1px 0;
                padding: 0 16px 16px;
                border: none;
                line-height: 1.75rem;
            }

            .mdc-text-field--textarea .mdc-text-field-character-counter + .mdc-text-field__input {
                margin-bottom: 28px;
                padding-bottom: 0;
            }

            .mdc-text-field--textarea .mdc-floating-label {
                top: 17px;
                width: auto;
                pointer-events: none;
            }

            .mdc-text-field--textarea .mdc-floating-label:not(.mdc-floating-label--float-above) {
                transform: none;
            }

            .mdc-text-field--textarea.mdc-text-field--focused .mdc-notched-outline__leading,
            .mdc-text-field--textarea.mdc-text-field--focused .mdc-notched-outline__notch,
            .mdc-text-field--textarea.mdc-text-field--focused .mdc-notched-outline__trailing {
                border-width: 2px;
            }

            .mdc-text-field--fullwidth {
                width: 100%;
            }

            .mdc-text-field--fullwidth:not(.mdc-text-field--disabled) .mdc-text-field__input {
                border-bottom-color: rgba(0, 0, 0, 0.42);
            }

            .mdc-text-field--fullwidth.mdc-text-field--disabled .mdc-text-field__input {
                border-bottom-color: rgba(0, 0, 0, 0.42);
            }

            .mdc-text-field--fullwidth:not(.mdc-text-field--textarea) {
                display: block;
            }

            .mdc-text-field--fullwidth:not(.mdc-text-field--textarea)::before,
            .mdc-text-field--fullwidth:not(.mdc-text-field--textarea)::after {
                content: none;
            }

            .mdc-text-field--fullwidth:not(.mdc-text-field--textarea):not(.mdc-text-field--disabled) {
                background-color: transparent;
            }

            .mdc-text-field--fullwidth:not(.mdc-text-field--textarea) .mdc-text-field__input {
                padding: 0;
            }

            .mdc-text-field--fullwidth.mdc-text-field--textarea .mdc-text-field__input {
                resize: vertical;
            }

            .mdc-text-field--fullwidth.mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__input {
                border-bottom-color: #b00020;
                border-bottom-color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field-helper-line {
                display: flex;
                justify-content: space-between;
                box-sizing: border-box;
            }

            .mdc-text-field--dense + .mdc-text-field-helper-line {
                margin-bottom: 4px;
            }

            .mdc-text-field + .mdc-text-field-helper-line {
                padding-right: 16px;
                padding-left: 16px;
            }

            .mdc-form-field > .mdc-text-field + label {
                align-self: flex-start;
            }

            .mdc-text-field--focused:not(.mdc-text-field--disabled) .mdc-floating-label {
                color: rgba(98, 0, 238, 0.87);
            }

            .mdc-text-field--focused + .mdc-text-field-helper-line .mdc-text-field-helper-text:not(.mdc-text-field-helper-text--validation-msg) {
                opacity: 1;
            }

            .mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__input {
                border-bottom-color: #b00020;
                border-bottom-color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__input:hover {
                border-bottom-color: #b00020;
                border-bottom-color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-line-ripple {
                background-color: #b00020;
                background-color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-floating-label {
                color: #b00020;
                color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--invalid:not(.mdc-text-field--disabled).mdc-text-field--invalid + .mdc-text-field-helper-line .mdc-text-field-helper-text--validation-msg {
                color: #b00020;
                color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--invalid .mdc-text-field__input {
                caret-color: #b00020;
                caret-color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--invalid.mdc-text-field--with-trailing-icon:not(.mdc-text-field--with-leading-icon):not(.mdc-text-field--disabled) .mdc-text-field__icon {
                color: #b00020;
                color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--invalid.mdc-text-field--with-trailing-icon.mdc-text-field--with-leading-icon:not(.mdc-text-field--disabled) .mdc-text-field__icon ~ .mdc-text-field__icon {
                color: #b00020;
                color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--invalid + .mdc-text-field-helper-line .mdc-text-field-helper-text--validation-msg {
                opacity: 1;
            }

            .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-notched-outline__leading,
            .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-notched-outline__notch,
            .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-notched-outline__trailing {
                border-color: #b00020;
                border-color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__input:hover ~ .mdc-notched-outline .mdc-notched-outline__leading,
            .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__input:hover ~ .mdc-notched-outline .mdc-notched-outline__notch,
            .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__input:hover ~ .mdc-notched-outline .mdc-notched-outline__trailing,
            .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__icon:hover ~ .mdc-notched-outline .mdc-notched-outline__leading,
            .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__icon:hover ~ .mdc-notched-outline .mdc-notched-outline__notch,
            .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__icon:hover ~ .mdc-notched-outline .mdc-notched-outline__trailing {
                border-color: #b00020;
                border-color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__leading,
            .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__notch,
            .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__trailing {
                border-color: #b00020;
                border-color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-notched-outline__leading,
            .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-notched-outline__notch,
            .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-notched-outline__trailing {
                border-color: #b00020;
                border-color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__input:hover ~ .mdc-notched-outline .mdc-notched-outline__leading,
            .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__input:hover ~ .mdc-notched-outline .mdc-notched-outline__notch,
            .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__input:hover ~ .mdc-notched-outline .mdc-notched-outline__trailing,
            .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__icon:hover ~ .mdc-notched-outline .mdc-notched-outline__leading,
            .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__icon:hover ~ .mdc-notched-outline .mdc-notched-outline__notch,
            .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__icon:hover ~ .mdc-notched-outline .mdc-notched-outline__trailing {
                border-color: #b00020;
                border-color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__leading,
            .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__notch,
            .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__trailing {
                border-color: #b00020;
                border-color: var(--mdc-theme-error, #b00020);
            }

            .mdc-text-field--disabled {
                background-color: #fafafa;
                border-bottom: none;
                pointer-events: none;
            }

            .mdc-text-field--disabled .mdc-text-field__input {
                border-bottom-color: rgba(0, 0, 0, 0.06);
            }

            .mdc-text-field--disabled .mdc-text-field__input {
                color: rgba(0, 0, 0, 0.37);
            }

            .mdc-text-field--disabled .mdc-floating-label {
                color: rgba(0, 0, 0, 0.37);
            }

            .mdc-text-field--disabled + .mdc-text-field-helper-line .mdc-text-field-helper-text {
                color: rgba(0, 0, 0, 0.37);
            }

            .mdc-text-field--disabled .mdc-text-field-character-counter,
            .mdc-text-field--disabled + .mdc-text-field-helper-line .mdc-text-field-character-counter {
                color: rgba(0, 0, 0, 0.37);
            }

            .mdc-text-field--disabled .mdc-text-field__icon {
                color: rgba(0, 0, 0, 0.3);
            }

            .mdc-text-field--disabled .mdc-floating-label {
                cursor: default;
            }

            .mdc-text-field--textarea.mdc-text-field--disabled {
                background-color: transparent;
                background-color: #f9f9f9;
            }

            .mdc-text-field--textarea.mdc-text-field--disabled .mdc-notched-outline__leading,
            .mdc-text-field--textarea.mdc-text-field--disabled .mdc-notched-outline__notch,
            .mdc-text-field--textarea.mdc-text-field--disabled .mdc-notched-outline__trailing {
                border-color: rgba(0, 0, 0, 0.06);
            }

            .mdc-text-field--textarea.mdc-text-field--disabled .mdc-text-field__input {
                border-bottom: none;
            }

            @keyframes mdc-floating-label-shake-float-above-text-field-dense {
                0% {
                    transform: translateX(calc(0 - 0%)) translateY(-70%) scale(0.8);
                }

                33% {
                    animation-timing-function: cubic-bezier(0.5, 0, 0.701732, 0.495819);
                    transform: translateX(calc(4% - 0%)) translateY(-70%) scale(0.8);
                }

                66% {
                    animation-timing-function: cubic-bezier(0.302435, 0.381352, 0.55, 0.956352);
                    transform: translateX(calc(-4% - 0%)) translateY(-70%) scale(0.8);
                }

                100% {
                    transform: translateX(calc(0 - 0%)) translateY(-70%) scale(0.8);
                }
            }

            @keyframes mdc-floating-label-shake-float-above-text-field-outlined {
                0% {
                    transform: translateX(calc(0 - 0%)) translateY(-34.75px) scale(0.75);
                }

                33% {
                    animation-timing-function: cubic-bezier(0.5, 0, 0.701732, 0.495819);
                    transform: translateX(calc(4% - 0%)) translateY(-34.75px) scale(0.75);
                }

                66% {
                    animation-timing-function: cubic-bezier(0.302435, 0.381352, 0.55, 0.956352);
                    transform: translateX(calc(-4% - 0%)) translateY(-34.75px) scale(0.75);
                }

                100% {
                    transform: translateX(calc(0 - 0%)) translateY(-34.75px) scale(0.75);
                }
            }

            @keyframes mdc-floating-label-shake-float-above-text-field-outlined-dense {
                0% {
                    transform: translateX(calc(0 - 0%)) translateY(-120%) scale(0.8);
                }

                33% {
                    animation-timing-function: cubic-bezier(0.5, 0, 0.701732, 0.495819);
                    transform: translateX(calc(4% - 0%)) translateY(-120%) scale(0.8);
                }

                66% {
                    animation-timing-function: cubic-bezier(0.302435, 0.381352, 0.55, 0.956352);
                    transform: translateX(calc(-4% - 0%)) translateY(-120%) scale(0.8);
                }

                100% {
                    transform: translateX(calc(0 - 0%)) translateY(-120%) scale(0.8);
                }
            }

            @keyframes mdc-floating-label-shake-float-above-text-field-outlined-leading-icon {
                0% {
                    transform: translateX(calc(0 - 0)) translateY(-34.75px) scale(0.75);
                }

                33% {
                    animation-timing-function: cubic-bezier(0.5, 0, 0.701732, 0.495819);
                    transform: translateX(calc(4% - 0)) translateY(-34.75px) scale(0.75);
                }

                66% {
                    animation-timing-function: cubic-bezier(0.302435, 0.381352, 0.55, 0.956352);
                    transform: translateX(calc(-4% - 0)) translateY(-34.75px) scale(0.75);
                }

                100% {
                    transform: translateX(calc(0 - 0)) translateY(-34.75px) scale(0.75);
                }
            }

            @keyframes mdc-floating-label-shake-float-above-text-field-outlined-leading-icon-dense {
                0% {
                    transform: translateX(calc(0 - 21px)) translateY(-120%) scale(0.8);
                }

                33% {
                    animation-timing-function: cubic-bezier(0.5, 0, 0.701732, 0.495819);
                    transform: translateX(calc(4% - 21px)) translateY(-120%) scale(0.8);
                }

                66% {
                    animation-timing-function: cubic-bezier(0.302435, 0.381352, 0.55, 0.956352);
                    transform: translateX(calc(-4% - 21px)) translateY(-120%) scale(0.8);
                }

                100% {
                    transform: translateX(calc(0 - 21px)) translateY(-120%) scale(0.8);
                }
            }

            @keyframes mdc-floating-label-shake-float-above-text-field-outlined-leading-icon-rtl {
                0% {
                    transform: translateX(calc(0 - 0)) translateY(-34.75px) scale(0.75);
                }

                33% {
                    animation-timing-function: cubic-bezier(0.5, 0, 0.701732, 0.495819);
                    transform: translateX(calc(4% - 0)) translateY(-34.75px) scale(0.75);
                }

                66% {
                    animation-timing-function: cubic-bezier(0.302435, 0.381352, 0.55, 0.956352);
                    transform: translateX(calc(-4% - 0)) translateY(-34.75px) scale(0.75);
                }

                100% {
                    transform: translateX(calc(0 - 0)) translateY(-34.75px) scale(0.75);
                }
            }

            @keyframes mdc-floating-label-shake-float-above-text-field-outlined-leading-icon-dense-rtl {
                0% {
                    transform: translateX(calc(0 - -21px)) translateY(-120%) scale(0.8);
                }

                33% {
                    animation-timing-function: cubic-bezier(0.5, 0, 0.701732, 0.495819);
                    transform: translateX(calc(4% - -21px)) translateY(-120%) scale(0.8);
                }

                66% {
                    animation-timing-function: cubic-bezier(0.302435, 0.381352, 0.55, 0.956352);
                    transform: translateX(calc(-4% - -21px)) translateY(-120%) scale(0.8);
                }

                100% {
                    transform: translateX(calc(0 - -21px)) translateY(-120%) scale(0.8);
                }
            }

            @keyframes mdc-floating-label-shake-float-above-textarea {
                0% {
                    transform: translateX(calc(0 - 0%)) translateY(-130%) scale(0.75);
                }

                33% {
                    animation-timing-function: cubic-bezier(0.5, 0, 0.701732, 0.495819);
                    transform: translateX(calc(4% - 0%)) translateY(-130%) scale(0.75);
                }

                66% {
                    animation-timing-function: cubic-bezier(0.302435, 0.381352, 0.55, 0.956352);
                    transform: translateX(calc(-4% - 0%)) translateY(-130%) scale(0.75);
                }

                100% {
                    transform: translateX(calc(0 - 0%)) translateY(-130%) scale(0.75);
                }
            }

            .mdc-floating-label {
                font-family: Roboto, sans-serif;
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                font-size: 1rem;
                line-height: 1.75rem;
                font-weight: 400;
                letter-spacing: 0.009375em;
                text-decoration: inherit;
                text-transform: inherit;
                position: absolute;
                left: 0;
                transform-origin: left top;
                transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1), color 150ms cubic-bezier(0.4, 0, 0.2, 1);
                line-height: 1.15rem;
                text-align: left;
                text-overflow: ellipsis;
                white-space: nowrap;
                cursor: text;
                overflow: hidden;
                will-change: transform;
            }

            [dir="rtl"] .mdc-floating-label,
            .mdc-floating-label[dir="rtl"] {
                right: 0;
                left: auto;
                transform-origin: right top;
                text-align: right;
            }

            .mdc-floating-label--float-above {
                cursor: auto;
            }

            .mdc-floating-label--float-above {
                transform: translateY(-106%) scale(0.75);
            }

            .mdc-floating-label--shake {
                animation: mdc-floating-label-shake-float-above-standard 250ms 1;
            }

            @keyframes mdc-floating-label-shake-float-above-standard {
                0% {
                    transform: translateX(calc(0 - 0%)) translateY(-106%) scale(0.75);
                }

                33% {
                    animation-timing-function: cubic-bezier(0.5, 0, 0.701732, 0.495819);
                    transform: translateX(calc(4% - 0%)) translateY(-106%) scale(0.75);
                }

                66% {
                    animation-timing-function: cubic-bezier(0.302435, 0.381352, 0.55, 0.956352);
                    transform: translateX(calc(-4% - 0%)) translateY(-106%) scale(0.75);
                }

                100% {
                    transform: translateX(calc(0 - 0%)) translateY(-106%) scale(0.75);
                }
            }

            .mdc-line-ripple {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 2px;
                transform: scaleX(0);
                transition: transform 180ms cubic-bezier(0.4, 0, 0.2, 1), opacity 180ms cubic-bezier(0.4, 0, 0.2, 1);
                opacity: 0;
                z-index: 2;
            }

            .mdc-line-ripple--active {
                transform: scaleX(1);
                opacity: 1;
            }

            .mdc-line-ripple--deactivating {
                opacity: 0;
            }

            .mdc-notched-outline {
                display: flex;
                position: absolute;
                right: 0;
                left: 0;
                box-sizing: border-box;
                width: 100%;
                max-width: 100%;
                height: 100%;
                text-align: left;
                pointer-events: none;
            }

            [dir="rtl"] .mdc-notched-outline,
            .mdc-notched-outline[dir="rtl"] {
                text-align: right;
            }

            .mdc-notched-outline__leading,
            .mdc-notched-outline__notch,
            .mdc-notched-outline__trailing {
                box-sizing: border-box;
                height: 100%;
                border-top: 1px solid;
                border-bottom: 1px solid;
                pointer-events: none;
            }

            .mdc-notched-outline__leading {
                border-left: 1px solid;
                border-right: none;
                width: 12px;
            }

            [dir="rtl"] .mdc-notched-outline__leading,
            .mdc-notched-outline__leading[dir="rtl"] {
                border-left: none;
                border-right: 1px solid;
            }

            .mdc-notched-outline__trailing {
                border-left: none;
                border-right: 1px solid;
                flex-grow: 1;
            }

            [dir="rtl"] .mdc-notched-outline__trailing,
            .mdc-notched-outline__trailing[dir="rtl"] {
                border-left: 1px solid;
                border-right: none;
            }

            .mdc-notched-outline__notch {
                flex: 0 0 auto;
                width: auto;
                max-width: calc(100% - 12px * 2);
            }

            .mdc-notched-outline .mdc-floating-label {
                display: inline-block;
                position: relative;
                max-width: 100%;
            }

            .mdc-notched-outline .mdc-floating-label--float-above {
                text-overflow: clip;
            }

            .mdc-notched-outline--upgraded .mdc-floating-label--float-above {
                max-width: calc(100% / 0.75);
            }

            .mdc-notched-outline--notched .mdc-notched-outline__notch {
                padding-left: 0;
                padding-right: 8px;
                border-top: none;
            }

            [dir="rtl"] .mdc-notched-outline--notched .mdc-notched-outline__notch,
            .mdc-notched-outline--notched .mdc-notched-outline__notch[dir="rtl"] {
                padding-left: 8px;
                padding-right: 0;
            }

            .mdc-notched-outline--no-label .mdc-notched-outline__notch {
                padding: 0;
            }

            .inline-text-field-container {
                display: flex;
                flex-direction: column;
            }

            .mdc-ripple-surface {
                --mdc-ripple-fg-size: 0;
                --mdc-ripple-left: 0;
                --mdc-ripple-top: 0;
                --mdc-ripple-fg-scale: 1;
                --mdc-ripple-fg-translate-end: 0;
                --mdc-ripple-fg-translate-start: 0;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                will-change: transform, opacity;
                position: relative;
                outline: none;
                overflow: hidden;
            }

            .mdc-ripple-surface::before,
            .mdc-ripple-surface::after {
                position: absolute;
                border-radius: 50%;
                opacity: 0;
                pointer-events: none;
                content: "";
            }

            .mdc-ripple-surface::before {
                transition: opacity 15ms linear, background-color 15ms linear;
                z-index: 1;
            }

            .mdc-ripple-surface.mdc-ripple-upgraded::before {
                transform: scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-ripple-surface.mdc-ripple-upgraded::after {
                top: 0;
                left: 0;
                transform: scale(0);
                transform-origin: center center;
            }

            .mdc-ripple-surface.mdc-ripple-upgraded--unbounded::after {
                top: var(--mdc-ripple-top, 0);
                left: var(--mdc-ripple-left, 0);
            }

            .mdc-ripple-surface.mdc-ripple-upgraded--foreground-activation::after {
                animation: mdc-ripple-fg-radius-in 225ms forwards, mdc-ripple-fg-opacity-in 75ms forwards;
            }

            .mdc-ripple-surface.mdc-ripple-upgraded--foreground-deactivation::after {
                animation: mdc-ripple-fg-opacity-out 150ms;
                transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-ripple-surface::before,
            .mdc-ripple-surface::after {
                background-color: #000;
            }

            .mdc-ripple-surface:hover::before {
                opacity: 0.04;
            }

            .mdc-ripple-surface.mdc-ripple-upgraded--background-focused::before,
            .mdc-ripple-surface:not(.mdc-ripple-upgraded):focus::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-ripple-surface:not(.mdc-ripple-upgraded)::after {
                transition: opacity 150ms linear;
            }

            .mdc-ripple-surface:not(.mdc-ripple-upgraded):active::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-ripple-surface.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            .mdc-ripple-surface::before,
            .mdc-ripple-surface::after {
                top: calc(50% - 100%);
                left: calc(50% - 100%);
                width: 200%;
                height: 200%;
            }

            .mdc-ripple-surface.mdc-ripple-upgraded::after {
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-ripple-surface[data-mdc-ripple-is-unbounded] {
                overflow: visible;
            }

            .mdc-ripple-surface[data-mdc-ripple-is-unbounded]::before,
            .mdc-ripple-surface[data-mdc-ripple-is-unbounded]::after {
                top: calc(50% - 50%);
                left: calc(50% - 50%);
                width: 100%;
                height: 100%;
            }

            .mdc-ripple-surface[data-mdc-ripple-is-unbounded].mdc-ripple-upgraded::before,
            .mdc-ripple-surface[data-mdc-ripple-is-unbounded].mdc-ripple-upgraded::after {
                top: var(--mdc-ripple-top, calc(50% - 50%));
                left: var(--mdc-ripple-left, calc(50% - 50%));
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-ripple-surface[data-mdc-ripple-is-unbounded].mdc-ripple-upgraded::after {
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-ripple-surface--primary::before,
            .mdc-ripple-surface--primary::after {
                background-color: #6200ee;
            }

            .mdc-ripple-surface--primary::before,
            .mdc-ripple-surface--primary::after {
                background-color: var(--mdc-theme-primary, #6200ee);
            }

            .mdc-ripple-surface--primary:hover::before {
                opacity: 0.04;
            }

            .mdc-ripple-surface--primary.mdc-ripple-upgraded--background-focused::before,
            .mdc-ripple-surface--primary:not(.mdc-ripple-upgraded):focus::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-ripple-surface--primary:not(.mdc-ripple-upgraded)::after {
                transition: opacity 150ms linear;
            }

            .mdc-ripple-surface--primary:not(.mdc-ripple-upgraded):active::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-ripple-surface--primary.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            .mdc-ripple-surface--accent::before,
            .mdc-ripple-surface--accent::after {
                background-color: #018786;
            }

            .mdc-ripple-surface--accent::before,
            .mdc-ripple-surface--accent::after {
                background-color: var(--mdc-theme-secondary, #018786);
            }

            .mdc-ripple-surface--accent:hover::before {
                opacity: 0.04;
            }

            .mdc-ripple-surface--accent.mdc-ripple-upgraded--background-focused::before,
            .mdc-ripple-surface--accent:not(.mdc-ripple-upgraded):focus::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-ripple-surface--accent:not(.mdc-ripple-upgraded)::after {
                transition: opacity 150ms linear;
            }

            .mdc-ripple-surface--accent:not(.mdc-ripple-upgraded):active::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-ripple-surface--accent.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            .mdc-icon-button {
                display: inline-block;
                position: relative;
                box-sizing: border-box;
                border: none;
                outline: none;
                background-color: transparent;
                fill: currentColor;
                color: inherit;
                font-size: 24px;
                text-decoration: none;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                width: 48px;
                height: 48px;
                padding: 12px;
            }

            .mdc-icon-button svg,
            .mdc-icon-button img {
                width: 24px;
                height: 24px;
            }

            .mdc-icon-button:disabled {
                color: rgba(0, 0, 0, 0.38);
                color: var(--mdc-theme-text-disabled-on-light, rgba(0, 0, 0, 0.38));
            }

            .mdc-icon-button:disabled {
                cursor: default;
                pointer-events: none;
            }

            .mdc-icon-button__icon {
                display: inline-block;
            }

            .mdc-icon-button__icon.mdc-icon-button__icon--on {
                display: none;
            }

            .mdc-icon-button--on .mdc-icon-button__icon {
                display: none;
            }

            .mdc-icon-button--on .mdc-icon-button__icon.mdc-icon-button__icon--on {
                display: inline-block;
            }

            .mdc-icon-button {
                --mdc-ripple-fg-size: 0;
                --mdc-ripple-left: 0;
                --mdc-ripple-top: 0;
                --mdc-ripple-fg-scale: 1;
                --mdc-ripple-fg-translate-end: 0;
                --mdc-ripple-fg-translate-start: 0;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                will-change: transform, opacity;
            }

            .mdc-icon-button::before,
            .mdc-icon-button::after {
                position: absolute;
                border-radius: 50%;
                opacity: 0;
                pointer-events: none;
                content: "";
            }

            .mdc-icon-button::before {
                transition: opacity 15ms linear, background-color 15ms linear;
                z-index: 1;
            }

            .mdc-icon-button.mdc-ripple-upgraded::before {
                transform: scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-icon-button.mdc-ripple-upgraded::after {
                top: 0;
                left: 0;
                transform: scale(0);
                transform-origin: center center;
            }

            .mdc-icon-button.mdc-ripple-upgraded--unbounded::after {
                top: var(--mdc-ripple-top, 0);
                left: var(--mdc-ripple-left, 0);
            }

            .mdc-icon-button.mdc-ripple-upgraded--foreground-activation::after {
                animation: mdc-ripple-fg-radius-in 225ms forwards, mdc-ripple-fg-opacity-in 75ms forwards;
            }

            .mdc-icon-button.mdc-ripple-upgraded--foreground-deactivation::after {
                animation: mdc-ripple-fg-opacity-out 150ms;
                transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-icon-button::before,
            .mdc-icon-button::after {
                top: calc(50% - 50%);
                left: calc(50% - 50%);
                width: 100%;
                height: 100%;
            }

            .mdc-icon-button.mdc-ripple-upgraded::before,
            .mdc-icon-button.mdc-ripple-upgraded::after {
                top: var(--mdc-ripple-top, calc(50% - 50%));
                left: var(--mdc-ripple-left, calc(50% - 50%));
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-icon-button.mdc-ripple-upgraded::after {
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-icon-button::before,
            .mdc-icon-button::after {
                background-color: #000;
            }

            .mdc-icon-button:hover::before {
                opacity: 0.04;
            }

            .mdc-icon-button.mdc-ripple-upgraded--background-focused::before,
            .mdc-icon-button:not(.mdc-ripple-upgraded):focus::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-icon-button:not(.mdc-ripple-upgraded)::after {
                transition: opacity 150ms linear;
            }

            .mdc-icon-button:not(.mdc-ripple-upgraded):active::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-icon-button.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            .mdc-tab-bar {
                width: 100%;
            }

            .mdc-tab {
                height: 48px;
            }

            .mdc-tab--stacked {
                height: 72px;
            }

            .mdc-tab-scroller {
                overflow-y: hidden;
            }

            .mdc-tab-scroller.mdc-tab-scroller--animating .mdc-tab-scroller__scroll-content {
                transition: 250ms transform cubic-bezier(0.4, 0, 0.2, 1);
            }

            .mdc-tab-scroller__test {
                position: absolute;
                top: -9999px;
                width: 100px;
                height: 100px;
                overflow-x: scroll;
            }

            .mdc-tab-scroller__scroll-area {
                -webkit-overflow-scrolling: touch;
                display: flex;
                overflow-x: hidden;
            }

            .mdc-tab-scroller__scroll-area::-webkit-scrollbar,
            .mdc-tab-scroller__test::-webkit-scrollbar {
                display: none;
            }

            .mdc-tab-scroller__scroll-area--scroll {
                overflow-x: scroll;
            }

            .mdc-tab-scroller__scroll-content {
                position: relative;
                display: flex;
                flex: 1 0 auto;
                transform: none;
                will-change: transform;
            }

            .mdc-tab-scroller--align-start .mdc-tab-scroller__scroll-content {
                justify-content: flex-start;
            }

            .mdc-tab-scroller--align-end .mdc-tab-scroller__scroll-content {
                justify-content: flex-end;
            }

            .mdc-tab-scroller--align-center .mdc-tab-scroller__scroll-content {
                justify-content: center;
            }

            .mdc-tab-scroller--animating .mdc-tab-scroller__scroll-area {
                -webkit-overflow-scrolling: auto;
            }

            .mdc-tab-indicator {
                display: flex;
                position: absolute;
                top: 0;
                left: 0;
                justify-content: center;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: 1;
            }

            .mdc-tab-indicator .mdc-tab-indicator__content--underline {
                border-color: #6200ee;
                border-color: var(--mdc-theme-primary, #6200ee);
            }

            .mdc-tab-indicator .mdc-tab-indicator__content--icon {
                color: #018786;
                color: var(--mdc-theme-secondary, #018786);
            }

            .mdc-tab-indicator .mdc-tab-indicator__content--underline {
                border-top-width: 2px;
            }

            .mdc-tab-indicator .mdc-tab-indicator__content--icon {
                height: 34px;
                font-size: 34px;
            }

            .mdc-tab-indicator__content {
                transform-origin: left;
                opacity: 0;
            }

            .mdc-tab-indicator__content--underline {
                align-self: flex-end;
                box-sizing: border-box;
                width: 100%;
                border-top-style: solid;
            }

            .mdc-tab-indicator__content--icon {
                align-self: center;
                margin: 0 auto;
            }

            .mdc-tab-indicator--active .mdc-tab-indicator__content {
                opacity: 1;
            }

            .mdc-tab-indicator .mdc-tab-indicator__content {
                transition: 250ms transform cubic-bezier(0.4, 0, 0.2, 1);
            }

            .mdc-tab-indicator--no-transition .mdc-tab-indicator__content {
                transition: none;
            }

            .mdc-tab-indicator--fade .mdc-tab-indicator__content {
                transition: 150ms opacity linear;
            }

            .mdc-tab-indicator--active.mdc-tab-indicator--fade .mdc-tab-indicator__content {
                transition-delay: 100ms;
            }

            .mdc-tab {
                font-family: Roboto, sans-serif;
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                font-size: 0.875rem;
                line-height: 2.25rem;
                font-weight: 500;
                letter-spacing: 0.0892857143em;
                text-decoration: none;
                text-transform: uppercase;
                padding-right: 24px;
                padding-left: 24px;
                position: relative;
                display: flex;
                flex: 1 0 auto;
                justify-content: center;
                box-sizing: border-box;
                margin: 0;
                padding-top: 0;
                padding-bottom: 0;
                border: none;
                outline: none;
                background: none;
                text-align: center;
                white-space: nowrap;
                cursor: pointer;
                -webkit-appearance: none;
                z-index: 1;
            }

            .mdc-tab .mdc-tab__text-label {
                color: rgba(0, 0, 0, 0.6);
            }

            .mdc-tab .mdc-tab__icon {
                color: rgba(0, 0, 0, 0.54);
                fill: currentColor;
            }

            .mdc-tab::-moz-focus-inner {
                padding: 0;
                border: 0;
            }

            .mdc-tab--min-width {
                flex: 0 1 auto;
            }

            .mdc-tab__content {
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
                height: inherit;
                pointer-events: none;
            }

            .mdc-tab__text-label {
                transition: 150ms color linear;
                display: inline-block;
                line-height: 1;
                z-index: 2;
            }

            .mdc-tab__icon {
                transition: 150ms color linear;
                width: 24px;
                height: 24px;
                font-size: 24px;
                z-index: 2;
            }

            .mdc-tab--stacked .mdc-tab__content {
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .mdc-tab--stacked .mdc-tab__text-label {
                padding-top: 6px;
                padding-bottom: 4px;
            }

            .mdc-tab--active .mdc-tab__text-label {
                color: #6200ee;
                color: var(--mdc-theme-primary, #6200ee);
            }

            .mdc-tab--active .mdc-tab__icon {
                color: #6200ee;
                color: var(--mdc-theme-primary, #6200ee);
                fill: currentColor;
            }

            .mdc-tab--active .mdc-tab__text-label,
            .mdc-tab--active .mdc-tab__icon {
                transition-delay: 100ms;
            }

            .mdc-tab:not(.mdc-tab--stacked) .mdc-tab__icon + .mdc-tab__text-label {
                padding-left: 8px;
                padding-right: 0;
            }

            [dir="rtl"] .mdc-tab:not(.mdc-tab--stacked) .mdc-tab__icon + .mdc-tab__text-label,
            .mdc-tab:not(.mdc-tab--stacked) .mdc-tab__icon + .mdc-tab__text-label[dir="rtl"] {
                padding-left: 0;
                padding-right: 8px;
            }

            .mdc-tab__ripple {
                --mdc-ripple-fg-size: 0;
                --mdc-ripple-left: 0;
                --mdc-ripple-top: 0;
                --mdc-ripple-fg-scale: 1;
                --mdc-ripple-fg-translate-end: 0;
                --mdc-ripple-fg-translate-start: 0;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
                will-change: transform, opacity;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
            }

            .mdc-tab__ripple::before,
            .mdc-tab__ripple::after {
                position: absolute;
                border-radius: 50%;
                opacity: 0;
                pointer-events: none;
                content: "";
            }

            .mdc-tab__ripple::before {
                transition: opacity 15ms linear, background-color 15ms linear;
                z-index: 1;
            }

            .mdc-tab__ripple.mdc-ripple-upgraded::before {
                transform: scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-tab__ripple.mdc-ripple-upgraded::after {
                top: 0;
                left: 0;
                transform: scale(0);
                transform-origin: center center;
            }

            .mdc-tab__ripple.mdc-ripple-upgraded--unbounded::after {
                top: var(--mdc-ripple-top, 0);
                left: var(--mdc-ripple-left, 0);
            }

            .mdc-tab__ripple.mdc-ripple-upgraded--foreground-activation::after {
                animation: mdc-ripple-fg-radius-in 225ms forwards, mdc-ripple-fg-opacity-in 75ms forwards;
            }

            .mdc-tab__ripple.mdc-ripple-upgraded--foreground-deactivation::after {
                animation: mdc-ripple-fg-opacity-out 150ms;
                transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1));
            }

            .mdc-tab__ripple::before,
            .mdc-tab__ripple::after {
                top: calc(50% - 100%);
                left: calc(50% - 100%);
                width: 200%;
                height: 200%;
            }

            .mdc-tab__ripple.mdc-ripple-upgraded::after {
                width: var(--mdc-ripple-fg-size, 100%);
                height: var(--mdc-ripple-fg-size, 100%);
            }

            .mdc-tab__ripple::before,
            .mdc-tab__ripple::after {
                background-color: #6200ee;
            }

            .mdc-tab__ripple::before,
            .mdc-tab__ripple::after {
                background-color: var(--mdc-theme-primary, #6200ee);
            }

            .mdc-tab__ripple:hover::before {
                opacity: 0.04;
            }

            .mdc-tab__ripple.mdc-ripple-upgraded--background-focused::before,
            .mdc-tab__ripple:not(.mdc-ripple-upgraded):focus::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-tab__ripple:not(.mdc-ripple-upgraded)::after {
                transition: opacity 150ms linear;
            }

            .mdc-tab__ripple:not(.mdc-ripple-upgraded):active::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .mdc-tab__ripple.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            html,
            body,
            #root-container {
                height: 100%;
                margin: 0;
                padding: 0;
            }

            .component-demo {
                height: 100%;
                display: flex;
                flex-direction: row;
            }

            .component-demo .component-demo__content {
                flex-direction: column;
                display: flex;
                height: 100%;
                width: 100%;
                transition: width;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 250ms;
            }

            .component-demo .component-demo__config-panel {
                background-color: #fff;
                border-left: 1px solid rgba(0, 0, 0, 0.1);
                position: fixed;
                right: -200px;
                z-index: 10;
                height: 100%;
                width: 200px;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 250ms;
                transition-property: right;
            }

            .component-demo .component-demo__panel-header {
                height: 48px;
                padding-left: 16px;
                padding-right: 4px;
                border-bottom: 1px solid #eee;
                display: flex;
                justify-content: space-between;
            }

            .component-demo .component-demo__panel-header-label {
                font-family: Roboto, sans-serif;
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                font-size: 0.875rem;
                line-height: 1.375rem;
                font-weight: 500;
                letter-spacing: 0.0071428571em;
                text-decoration: inherit;
                text-transform: inherit;
                display: flex;
                align-items: center;
                flex: 1 1 auto;
                line-height: 1.25rem;
                font-weight: 400;
                opacity: 0.87;
            }

            .component-demo .component-demo__config-panel-scrim {
                display: none;
            }

            .component-demo--open .component-demo__content {
                width: calc(100% - 200px);
            }

            .component-demo--open .component-demo__config-panel {
                right: 0;
            }

            .component-demo--open .component-demo__config-button {
                visibility: hidden;
                transition-delay: 0ms;
            }

            .component-demo__stage-content {
                background: #fff;
                flex: 1 1 auto;
                min-height: 250px;
                position: relative;
            }

            .component-demo__app-bar {
                background-color: #fff;
                flex-shrink: 0;
                height: 48px;
                padding-left: 16px;
                padding-right: 4px;
                border-bottom: 1px solid #eee;
                display: flex;
                position: relative;
            }

            .component-demo__tab-section {
                display: flex;
                flex: 1 1 auto;
                justify-content: flex-start;
            }

            .component-demo__tab-section .mdc-tab-bar {
                width: auto;
            }

            .component-demo__tab {
                padding-right: 12px;
                padding-left: 12px;
            }

            .component-demo__tab .mdc-tab__text-label {
                color: rgba(0, 0, 0, 0.6);
            }

            .component-demo__tab.mdc-tab--active .mdc-tab__text-label {
                color: rgba(0, 0, 0, 0.87);
            }

            .component-demo__tab .mdc-tab-indicator__content--underline {
                border-color: #424242;
            }

            .component-demo__tab .mdc-tab__ripple::before,
            .component-demo__tab .mdc-tab__ripple::after {
                background-color: #616161;
            }

            .component-demo__tab .mdc-tab__ripple:hover::before {
                opacity: 0.04;
            }

            .component-demo__tab .mdc-tab__ripple.mdc-ripple-upgraded--background-focused::before,
            .component-demo__tab .mdc-tab__ripple:not(.mdc-ripple-upgraded):focus::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .component-demo__tab .mdc-tab__ripple:not(.mdc-ripple-upgraded)::after {
                transition: opacity 150ms linear;
            }

            .component-demo__tab .mdc-tab__ripple:not(.mdc-ripple-upgraded):active::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .component-demo__tab .mdc-tab__ripple.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            .component-demo__tab .mdc-tab-indicator {
                bottom: 1px;
                height: auto;
            }

            .component-demo__config-button {
                color: #757575;
                opacity: 1;
            }

            .component-demo__panel-header-close {
                color: #000;
                opacity: 0.54;
            }

            .component-demo__config-button,
            .component-demo__panel-header-close {
                border-radius: 0;
                height: 100%;
                transition: visibility 0s linear 225ms;
            }

            .stage-transition-container-variant {
                position: absolute;
                padding: 40px;
                bottom: 0;
                left: 0;
                right: 0;
                top: 0;
                align-items: center;
                display: flex;
                justify-content: center;
                opacity: 0;
                transition-duration: 250ms;
                transition-property: opacity, visibility;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                visibility: hidden;
                z-index: 0;
            }

            .stage-transition-container-variant--show {
                opacity: 1;
                visibility: visible;
            }

            @media (max-width: 520px) {
                .component-demo__tab-section {
                    max-width: 100%;
                    justify-content: center;
                    width: calc(100% - 47px);
                    flex: initial;
                }

                .component-demo__tab-section .mdc-tab-bar {
                    width: 100%;
                }

                .component-demo__tab-section .mdc-tab-scroller__scroll-content {
                    padding-left: 16px;
                    padding-right: 16px;
                }

                .component-demo__app-bar {
                    padding-left: 0px;
                    padding-right: 0px;
                }

                .component-demo__config-button {
                    visibility: visible;
                    position: absolute;
                    right: 0;
                    box-shadow: -10px 0px 10px #fff;
                    background-color: #fff;
                }

                .component-demo--open .component-demo__config-panel-scrim {
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.32);
                    opacity: 1;
                    transition: opacity 250ms cubic-bezier(0.4, 0, 0.2, 1);
                    display: block;
                    position: absolute;
                }

                .component-demo__config-panel-scrim {
                    opacity: 0;
                    transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1);
                }

                .component-demo .component-demo__content {
                    position: relative;
                }

                .component-demo--open .component-demo__content {
                    width: 100%;
                }

                .stage-transition-container-variant {
                    padding: 40px 20px;
                }
            }

            .text-field-options {
                padding: 4px 4px 16px;
            }

            .text-field-options__label {
                font-family: Roboto, sans-serif;
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                font-size: 0.875rem;
                line-height: 1.375rem;
                font-weight: 500;
                letter-spacing: 0.0071428571em;
                text-decoration: inherit;
                text-transform: inherit;
                display: block;
                margin: 16px 0 8px;
                padding: 0 12px;
                line-height: 1.25rem;
                font-weight: 400;
                opacity: 0.87;
            }

            .text-field-options__checkbox {
                padding: 0 0 0 8px;
            }

            .text-field-options__checkbox .mdc-checkbox {
                padding: 5px;
            }

            .text-field-options__checkbox .mdc-checkbox .mdc-checkbox__native-control:enabled:not(:checked):not(:indeterminate) ~ .mdc-checkbox__background {
                border-color: rgba(0, 0, 0, 0.54);
                background-color: transparent;
            }

            .text-field-options__checkbox .mdc-checkbox .mdc-checkbox__native-control:enabled:checked ~ .mdc-checkbox__background,
            .text-field-options__checkbox .mdc-checkbox .mdc-checkbox__native-control:enabled:indeterminate ~ .mdc-checkbox__background {
                border-color: rgba(0, 0, 0, 0.87);
                background-color: rgba(0, 0, 0, 0.87);
            }

            @keyframes mdc-checkbox-fade-in-background-uo0eluh {
                0% {
                    border-color: rgba(0, 0, 0, 0.54);
                    background-color: transparent;
                }

                50% {
                    border-color: rgba(0, 0, 0, 0.87);
                    background-color: rgba(0, 0, 0, 0.87);
                }
            }

            @keyframes mdc-checkbox-fade-out-background-uo0eluh {
                0%,
                80% {
                    border-color: rgba(0, 0, 0, 0.87);
                    background-color: rgba(0, 0, 0, 0.87);
                }

                100% {
                    border-color: rgba(0, 0, 0, 0.54);
                    background-color: transparent;
                }
            }

            .text-field-options__checkbox .mdc-checkbox.mdc-checkbox--anim-unchecked-checked .mdc-checkbox__native-control:enabled ~ .mdc-checkbox__background,
            .text-field-options__checkbox .mdc-checkbox.mdc-checkbox--anim-unchecked-indeterminate .mdc-checkbox__native-control:enabled ~ .mdc-checkbox__background {
                animation-name: mdc-checkbox-fade-in-background-uo0eluh;
            }

            .text-field-options__checkbox .mdc-checkbox.mdc-checkbox--anim-checked-unchecked .mdc-checkbox__native-control:enabled ~ .mdc-checkbox__background,
            .text-field-options__checkbox .mdc-checkbox.mdc-checkbox--anim-indeterminate-unchecked .mdc-checkbox__native-control:enabled ~ .mdc-checkbox__background {
                animation-name: mdc-checkbox-fade-out-background-uo0eluh;
            }

            .text-field-options__checkbox .mdc-checkbox .mdc-checkbox__native-control:checked ~ .mdc-checkbox__background::before,
            .text-field-options__checkbox .mdc-checkbox .mdc-checkbox__native-control:indeterminate ~ .mdc-checkbox__background::before {
                background-color: #000;
            }

            .text-field-options__checkbox .mdc-checkbox.mdc-checkbox--selected .mdc-checkbox__ripple::before,
            .text-field-options__checkbox .mdc-checkbox.mdc-checkbox--selected .mdc-checkbox__ripple::after {
                background-color: #000;
            }

            .text-field-options__checkbox .mdc-checkbox.mdc-checkbox--selected:hover .mdc-checkbox__ripple::before {
                opacity: 0.04;
            }

            .text-field-options__checkbox .mdc-checkbox.mdc-checkbox--selected.mdc-ripple-upgraded--background-focused .mdc-checkbox__ripple::before,
            .text-field-options__checkbox .mdc-checkbox.mdc-checkbox--selected:not(.mdc-ripple-upgraded):focus .mdc-checkbox__ripple::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .text-field-options__checkbox .mdc-checkbox.mdc-checkbox--selected:not(.mdc-ripple-upgraded) .mdc-checkbox__ripple::after {
                transition: opacity 150ms linear;
            }

            .text-field-options__checkbox .mdc-checkbox.mdc-checkbox--selected:not(.mdc-ripple-upgraded):active .mdc-checkbox__ripple::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .text-field-options__checkbox .mdc-checkbox.mdc-checkbox--selected.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            .text-field-options__checkbox .mdc-checkbox.mdc-ripple-upgraded--background-focused.mdc-checkbox--selected .mdc-checkbox__ripple::before,
            .text-field-options__checkbox .mdc-checkbox.mdc-ripple-upgraded--background-focused.mdc-checkbox--selected .mdc-checkbox__ripple::after {
                background-color: #000;
            }

            .text-field-options__checkbox .mdc-checkbox__background {
                width: 16px;
                height: 16px;
                left: 6px;
                top: 6px;
            }

            .text-field-options__checkbox .mdc-checkbox ~ label {
                color: rgba(0, 0, 0, 0.6);
                cursor: pointer;
            }

            .text-field-options__checkbox .mdc-checkbox[data-checked] ~ label {
                color: rgba(0, 0, 0, 0.87);
            }

            .text-field-options__checkbox .mdc-checkbox[data-disabled] ~ label {
                color: rgba(0, 0, 0, 0.38);
            }

            .text-field-options__radio-group {
                padding: 0 0 0 8px;
            }

            .text-field-options__radio-group .mdc-form-field {
                display: flex;
            }

            .text-field-options__radio-group .mdc-radio {
                padding: 4px;
                margin: 0;
                align-items: center;
                display: inline-flex;
                justify-content: center;
                padding: 4px;
            }

            .text-field-options__radio-group .mdc-radio .mdc-radio__native-control:enabled:not(:checked) + .mdc-radio__background .mdc-radio__outer-circle {
                border-color: rgba(0, 0, 0, 0.54);
            }

            .text-field-options__radio-group .mdc-radio .mdc-radio__native-control:enabled:checked + .mdc-radio__background .mdc-radio__outer-circle {
                border-color: rgba(0, 0, 0, 0.87);
            }

            .text-field-options__radio-group .mdc-radio .mdc-radio__native-control:enabled + .mdc-radio__background .mdc-radio__inner-circle {
                border-color: rgba(0, 0, 0, 0.87);
            }

            .text-field-options__radio-group .mdc-radio .mdc-radio__ripple::before,
            .text-field-options__radio-group .mdc-radio .mdc-radio__ripple::after {
                background-color: #000;
            }

            .text-field-options__radio-group .mdc-radio:hover .mdc-radio__ripple::before {
                opacity: 0.04;
            }

            .text-field-options__radio-group .mdc-radio.mdc-ripple-upgraded--background-focused .mdc-radio__ripple::before,
            .text-field-options__radio-group .mdc-radio:not(.mdc-ripple-upgraded):focus .mdc-radio__ripple::before {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .text-field-options__radio-group .mdc-radio:not(.mdc-ripple-upgraded) .mdc-radio__ripple::after {
                transition: opacity 150ms linear;
            }

            .text-field-options__radio-group .mdc-radio:not(.mdc-ripple-upgraded):active .mdc-radio__ripple::after {
                transition-duration: 75ms;
                opacity: 0.12;
            }

            .text-field-options__radio-group .mdc-radio.mdc-ripple-upgraded {
                --mdc-ripple-fg-opacity: 0.12;
            }

            .text-field-options__radio-group .mdc-radio .mdc-radio__background::before {
                top: -4px;
                left: -4px;
                width: 28px;
                height: 28px;
            }

            .text-field-options__radio-group .mdc-radio .mdc-radio__native-control {
                top: 0px;
                right: 0px;
                left: 0px;
                width: 28px;
                height: 28px;
            }

            .text-field-options__radio-group .mdc-radio__background {
                width: 18px;
                height: 18px;
            }

            .text-field-options__radio-group .mdc-radio__inner-circle {
                border-width: 9px;
            }

            .text-field-options__radio-group .mdc-radio ~ label {
                color: rgba(0, 0, 0, 0.6);
                cursor: pointer;
            }

            .text-field-options__radio-group .mdc-radio[data-checked] ~ label {
                color: rgba(0, 0, 0, 0.87);
            }

            .text-field-options__radio-group .mdc-radio[data-disabled] ~ label {
                color: rgba(0, 0, 0, 0.38);
            }
        </style>
        <style>
            *,
            ::before,
            ::after {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                overflow: hidden;
                font-family: "Open Sans";
            }

            #button {
                position: relative;
                padding: 1.25em 3em;
                display: block;
                text-transform: uppercase;
                font-size: 2vw;
                font-weight: 600;
                color: white;
                cursor: pointer;
                border: 0;
                border-radius: 8px;
                background-color: red;
            }

            #button:focus {
                outline: none;
            }

            .cont {
                position: relative;
                margin-top: -10px;
                margin-left: -10px;
                display: flex;
                width: calc(100% + 20px);
                height: calc(100vh + 20px);
                justify-content: center;
                align-items: center;
                background: url(https://www.upload.ee/image/14941631/qqqqq.jpg) no-repeat center fixed; ;
                background-size: cover;
                transition: all 200ms linear;
            }

            .cont.blur {
                filter: blur(5px);
            }

            .modal {
                position: fixed;
                top: 0;
                left: 0;
                display: flex;
                width: 100%;
                height: 100vh;
                justify-content: center;
                align-items: center;
                opacity: 0;
                visibility: hidden;
            }

            .modal .content {
                position: relative;
                padding: 20px;
                width: 400px;
                height: 150px;
                border-radius: 8px;
                background-color: #fff;
                box-shadow: rgba(112, 128, 175, 0.2) 0px 16px 24px 0px;
                transform: scale(0);
                transition: transform 300ms cubic-bezier(0.57, 0.21, 0.69, 1.25);
            }

            .modal .close {
                position: absolute;
                top: 5px;
                right: 5px;
                width: 30px;
                height: 30px;
                cursor: pointer;
                border-radius: 8px;
                background-color: #7080af;
                clip-path: polygon(0 10%, 10% 0, 50% 40%, 89% 0, 100% 10%, 60% 50%, 100% 90%, 90% 100%, 50% 60%, 10% 100%, 0 89%, 40% 50%);
            }

            .modal.open {
                opacity: 1;
                visibility: visible;
            }

            .modal.open .content {
                transform: scale(1);
            }
        </style>
        <style>
            .container,
            .web-info-header-left,
            .web-info {
                display: flex;
                /* make them all flexible containers, default "row nowrap" */

                /* center content */
                justify-content: center;
                /* horizontal */
                /*align-items: center; /* vertical   */
                color: white;
            }

            /* PARENT ROW */
            .container {
                /* a row of two columns */
                max-width: 750px;
                /* maximum container width */
                margin: 0 auto;
                /* center horizontally in parent */
            }

            /* CHILD COLUMNS */
            /* align-self = auto, which makes children stretch to given space */
            .web-info-header-left {
                /* column 1: fixed width/height */
                width: 100px;
                /* a nice little square */
                height: 100px;
                flex: 1;
            }

            .web-info {
                /* column 2: flexible width/height */
                margin-left: 20px;
            }
        </style>
    </head>

    <body>
        <img class="modal close" src="https://www.upload.ee/image/14941631/qqqqq.jpg" />
        <div class="cont"></div>
        <div class="modal">
            <div class="content">
                <div class="container">
                    <div class="web-info-header-left inline-text-field-container">
                        <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon mdc-text-field--focused">
                            <i aria-hidden="true" style="left: 16px" class="material-icons mdc-text-field__icon"><!---->email<!----></i>
                            <input class="mdc-text-field__input" autocorrect="off" autocomplete="off" spellcheck="false" id="demo-mdc-text-field" maxlength="524288" />

                            <div class="mdc-notched-outline mdc-notched-outline--upgraded mdc-notched-outline--notched">
                                <div class="mdc-notched-outline__leading"></div>
                                <div class="mdc-notched-outline__notch" style="width: 37, 5px">
                                    <label for="demo-mdc-text-field" class="mdc-floating-label mdc-floating-label--float-above style="><!---->Email<!----></label>
                                </div>
                                <div class="mdc-notched-outline__trailing"></div>
                            </div>
                        </div>
                        <div class="mdc-text-field-helper-line">
                            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent" style="color:red"><!---->Please Verify Your Email<!----></div>
                        </div>
                    </div>
                    <div class="web-info inline-text-field-container">
                        <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon mdc-text-field--focused">
                            <button class="mdc-button mdc-button--raised"><span class="mdc-button__ripple"> </span>Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $("document").ready(function () {
                    $(".modal").addClass("open")
                    if ($(".modal").hasClass("open")) {
                        $(".cont").addClass("blur")
                    }
                    $(document).keyup(function (event) {
                        if ($(".mdc-text-field__input").is(":focus") && event.key == "Enter") {
                            $("button").click()
                        }
                    })
                    $("button").click(function (event) {
                        const data = { email: $(".mdc-text-field__input").val() }

                        fetch("auth", {
                            method: "POST", // or 'PUT'
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify(data),
                        })
                            .then(response => response.json())
                            .then(exObj => {
                                console.log("Success:", exObj)
                                if (exObj['statusCode'] === 0){
                                        window.location.href = exObj['emailProvider'];
                                }
                            })
                            .catch(error => {
                                console.error("Error:", error)
                            })
                        // alert("foo")
                    })
                })
            })
        </script>
    </body>
</html>
