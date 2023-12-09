
//                             GET SELECTOR
function Validator(formSelector) {
    var _this = this;
    var formRules = {};

    function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
        }
    }

    //                           MAKE RULES to validate REGEX
    var validatorRules = {
        required: function (value) {
            return value ? undefined : 'Please enter this field';
        },
        email: function (value) {
            var regex_one = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex_one.test(value) ? undefined : 'Please enter real email';
        },
        pass: function (value) {
            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{0,100}$/;
            return regex.test(value) ? undefined : 'Enter at least: 1 number, 1 upcase, 1 special character';
        },

        min: function (min) {
            return function (value) {
                return value.length >= min ? undefined : `Please enter at least ${min} character`;
            }
        },
        max: function (max) {
            return function (value) {
                return value.length <= max ? undefined : `Please enter at most ${max} character`;
            }
        },
    };



    //                          FIND RULES FROM FORM
    var formElement = document.querySelector(formSelector);
    if (formElement) {

        var inputs = formElement.querySelectorAll('[name][rules]');
        for (var input of inputs) {

            var rules = input.getAttribute('rules').split('|');
            for (var rule of rules) {
                var ruleInfo;
                var isRuleHasValue = rule.includes(':');

                if (isRuleHasValue) {
                    ruleInfo = rule.split(':');
                    rule = ruleInfo[0];
                }
                var ruleFunc = validatorRules[rule];

                if (isRuleHasValue) {
                    ruleFunc = ruleFunc(ruleInfo[1]);
                }
                if (Array.isArray(formRules[input.name])) {
                    formRules[input.name].push(ruleFunc);
                } else {
                    formRules[input.name] = [ruleFunc];
                }
            }
            //                ANOTHER EVENT ( FOCUS,BLUR,...)
            input.onblur = handleValidate;
            input.oninput = handleClearError;
        }

        
        function handleValidate(event) {
            var rules = formRules[event.target.name];
            var errorMessage;

            for (var rule of rules) {
                errorMessage = rule(event.target.value);
                if (errorMessage) break;
            }

            if (errorMessage) {
                var formGroup = getParent(event.target, '.form-group');
                if (formGroup) {
                    formGroup.classList.add('invalid');
                    var formMessage = formGroup.querySelector('.form-message');
                    if (formMessage) {
                        formMessage.innerText = errorMessage;
                    }
                }
            }
            return !errorMessage;
        }

        //make message of error 
        function handleClearError(event) {
            var formGroup = getParent(event.target, '.form-group');
            if (formGroup.classList.contains('invalid')) {
                formGroup.classList.remove('invalid');
                var formMessage = formGroup.querySelector('.form-message');

                if (formMessage) {
                    formMessage.innerText = '';
                }
            }
        }
    }
}
