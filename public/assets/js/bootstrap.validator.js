(function ($) {
    $.fn.validate = function (options) {
        const settings = $.extend({
            init: function () {},
            success: function () {},
            fail: function () {}
        }, options);

        const validators = {
            name: /^((?![0-9]).+)/g,
            family: /^((?![0-9]).+)/g,
            number: /^[0-9]+$/g,
            url: /^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}(\/[^\s<>#%"{}\\|^\[\]`]*)?$/i,
            date: /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])\/?\d{4}$/,
            email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
            tel: /^[0-9\-+]{3,25}$/
        };

        return this.each(function () {
            const form = $(this);
            form.attr('novalidate', true);

            const submitButton = form.find('button[type="submit"],.form-button');

            function validateField(field) {
                field.removeClass('is-invalid').nextAll('.invalid-feedback').remove();
                const name = field.attr('name');
                if (!name) return true;
                let value = field.val()?.trim() || '';
                const required = field.is('[required]') || field.is('[data-required]');
                const regexAttr = field.data('regex') || field.attr('pattern');
                const equals = field.data('equals');
                const customMessage = field.data('title');
                const minLength = parseInt(field.attr('minlength')) || null;
                const maxLength = parseInt(field.attr('maxlength')) || null;

                // Equals check
                if (equals) {
                    const eqValue = form.find(`[name="${equals}"]`).val();
                    if (value != eqValue) {
                        insertFeedback(field, customMessage || 'Values do not match');
                        return false;
                    }
                }

                // Required check
                if (required && (!value || (Array.isArray(value) && !value.length))) {
                    insertFeedback(field, customMessage || 'This field is required');
                    return false;
                }

                // Length checks
                if (value) {
                    if (minLength && value.length < minLength) {
                        insertFeedback(field, customMessage || `Minimum ${minLength} characters required`);
                        return false;
                    }
                    if (maxLength && value.length > maxLength) {
                        insertFeedback(field, customMessage || `Maximum ${maxLength} characters allowed`);
                        return false;
                    }
                }

                // Regex/type check
                if (value) {
                    let regex = regexAttr;
                    if (!regex && validators[field.attr('type')]) regex = field.attr('type');

                    if (regex) {
                        const r = validators[regex] || new RegExp(regex);
                        if (!r.test(value)) {
                            insertFeedback(field, customMessage || 'Invalid input');
                            return false;
                        }
                    }
                }

                return true;
            }

            function insertFeedback(field, message) {
                field.addClass('is-invalid');
                const nextLabel = field.next('label');
                const feedback = $('<div class="invalid-feedback d-block"></div>').text(message);
                if (nextLabel.length) feedback.insertAfter(nextLabel);
                else feedback.insertAfter(field);
            }

            function checkFormValidity() {
                let valid = true;
                form.find('input,textarea,select').each(function () {
                    const field = $(this);
                    const type = field.attr('type');
                    if (type === 'submit') return;
                    if (!validateField(field)) valid = false;
                });
                submitButton.prop('disabled', !valid);
                return valid;
            }

            // Real-time validation
            form.find('input,textarea,select').on('input change', function () {
                validateField($(this));
                checkFormValidity();
            });

            // On submit
            form.on('submit', function (e) {
                settings.init.call(form[0]);
                form.find('.invalid-feedback').remove();
                form.find('.is-invalid').removeClass('is-invalid');

                if (!checkFormValidity()) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    // Scroll to first invalid
                    const firstInvalid = form.find('.is-invalid').first();
                    $('html, body').animate({ scrollTop: firstInvalid.offset().top - 100 }, 600);
                    firstInvalid.addClass('highlight-flash');
                    setTimeout(() => firstInvalid.removeClass('highlight-flash'), 800);
                    settings.fail.call(form[0], e);
                    return false;
                }

                settings.success.call(form[0], e);
                e.preventDefault(); // Keep this if using AJAX
            });
        });
    };

    $.fn.bootstrap5Validate = function (success) {
        return this.validate({
            init: function () {
                $(this).find('.is-invalid').removeClass('is-invalid');
                $(this).find('.invalid-feedback').remove();
            },
            success: success,
            fail: function () {}
        });
    };
})(jQuery);
