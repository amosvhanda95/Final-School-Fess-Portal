/* ----------------------------

    CustomValidation prototype

    - Keeps track of the list of invalidity messages for this input
    - Keeps track of what validity checks need to be performed for this input
    - Performs the validity checks and sends feedback to the front end

---------------------------- */

function CustomValidation(input) {
    this.invalidities = [];
    this.validityChecks = [];

    // add reference to the input node
    this.inputNode = input;

    // trigger method to attach the listener
    this.registerListener();
}

CustomValidation.prototype = {
    addInvalidity: function (message) {
        this.invalidities.push(message);
    },
    getInvalidities: function () {
        return this.invalidities.join('. \n');
    },
    checkValidity: function (input) {
        for (var i = 0; i < this.validityChecks.length; i++) {
            var isInvalid = this.validityChecks[i].isInvalid(input);
            if (isInvalid) {
                this.addInvalidity(this.validityChecks[i].invalidityMessage);
            }

            var requirementElement = this.validityChecks[i].element;

            if (requirementElement) {
                if (isInvalid) {
                    requirementElement.classList.add('invalid');
                    requirementElement.classList.remove('valid');
                } else {
                    requirementElement.classList.remove('invalid');
                    requirementElement.classList.add('valid');
                }
            } // end if requirementElement
        } // end for
    },
    checkInput: function () {
        // checkInput now encapsulated
        this.inputNode.CustomValidation.invalidities = [];
        this.checkValidity(this.inputNode);

        if (this.inputNode.CustomValidation.invalidities.length === 0 && this.inputNode.value !== '') {
            this.inputNode.setCustomValidity('');
        } else {
            var message = this.inputNode.CustomValidation.getInvalidities();
            this.inputNode.setCustomValidity(message);
        }
    },
    registerListener: function () {
        // register the listener here
        var CustomValidation = this;

        this.inputNode.addEventListener('keyup', function () {
            CustomValidation.checkInput();
        });
    },
};

/* ----------------------------

    IBAN Validation Checks

---------------------------- */

var ibanValidityChecks = [
    {
        isInvalid: function (input) {
            return !input.value.match(/^CH[0-9]{19}$/);
        },
        invalidityMessage: 'Invalid IBAN. It should start with "CH" followed by 19 digits.',
        element: document.querySelector('label[for="iban"] .input-requirements li:nth-child(1)'),
    },
];

/* ----------------------------

    Setup CustomValidation for IBAN

---------------------------- */

var ibanInput = document.getElementById('iban');
ibanInput.CustomValidation = new CustomValidation(ibanInput);
ibanInput.CustomValidation.validityChecks = ibanValidityChecks;

/* ----------------------------

    Event Listeners

---------------------------- */

var inputs = document.querySelectorAll('input:not([type="submit"])');
var submit = document.querySelector('input[type="submit"]');
var form = document.getElementById('registration');

function validate() {
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].CustomValidation.checkInput();
    }
}

submit.addEventListener('click', validate);
form.addEventListener('submit', validate);
