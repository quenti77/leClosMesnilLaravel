import intlTelInput from 'intl-tel-input'

if ('isAlreadyLoaded' in window) {
    window.intlTelInputGlobals.windowLoaded = true
}

const translateCountries = {
    'en': 'gb'
}

function selectLang () {
    const selectLang = document.querySelector('html').lang || 'fr'
    return (selectLang in translateCountries) ? translateCountries[selectLang] : selectLang
}

export const TelInputOptions = {
    allowExtensions: false,
    autoPlaceholder: 'aggressive',
    initialCountry: selectLang(),
    nationalMode: false,
    numberType: "MOBILE",
    preferredCountries: [ 'fr', 'gb', 'es' ],
    separateDialCode: true,
    hiddenInput: "full_phone",
    utilsScript: "/js/intlTelInputUtils.js"
}

export class PhoneNumberUtils {
    static isLoaded () {
        return (
            'intlTelInputUtils' in window &&
            'formatNumber' in window.intlTelInputUtils
        )
    }

    static assertUtilsLoaded () {
        if (!PhoneNumberUtils.isLoaded()) {
            throw Error('ITI Utils not loaded')
        }
    }

    static getFormat (format) {
        PhoneNumberUtils.assertUtilsLoaded()
        return window.intlTelInputUtils.numberFormat[format]
    }

    static format (phone, country, format) {
        PhoneNumberUtils.assertUtilsLoaded()

        // noinspection JSUnresolvedFunction
        return window.intlTelInputUtils.formatNumber(phone, country, format)
    }

    static forceLoad () {
        return new Promise((res) => {
            const input = document.createElement('input')
            input.class = "not-showable"
            document.body.appendChild(input)

            const instance = new PhoneNumberInput(input, () => {
                const removed = input.parentNode
                removed.parentNode.removeChild(removed)
                res()
            })
        })
    }
}

export class PhoneNumberInput {
    constructor (input, handlerLoaded) {
        const that = this
        this.instanceITI = intlTelInput(input, TelInputOptions)
        this.instanceITI.promise.then(function () {
            handlerLoaded(that)
        })
    }

    isValid () {
        return this.instanceITI.isValidNumber()
    }

    isMobile () {
        PhoneNumberUtils.assertUtilsLoaded()

        const acceptedTypes = [
            window.intlTelInputUtils.numberType.MOBILE,
            window.intlTelInputUtils.numberType.FIXED_LINE_OR_MOBILE
        ]

        return this.isValid() && acceptedTypes.indexOf(this.instanceITI.getNumberType()) !== -1
    }

    getNational () {
        return this.isValid() ? this.instanceITI.getNumber(PhoneNumberUtils.getFormat('NATIONAL')) : ''
    }

    getE164 () {
        return this.isValid() ? this.instanceITI.getNumber(PhoneNumberUtils.getFormat('E164')) : ''
    }
}

window.intlTelInput = intlTelInput

function intlTelinputLoaded(input, instance) {
    console.log(input, instance)
}

window.addEventListener('load', () => {
    const input = document.querySelector('#phone')
    const instanceITI = new PhoneNumberInput(input, (instance) => {
        intlTelinputLoaded(input, instance)
    })
})

