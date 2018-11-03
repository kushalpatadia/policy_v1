/**
 * Stamp duty calculator
 * /stamp-duty-calculator/
 */

jQuery(document).ready(function ($) {

    if ($("#stampduty-calculate").length) {
        var stampduty = {
            calculate: function (propertyvalue) {
                var stampduty = 0;
                propertyvalue -= 125000; // first £125,000 is tax-free
                if (propertyvalue < 0) {
                    propertyvalue = 0
                }

                stampduty += Math.min(125000, propertyvalue) * 0.02; // 2% duty on properties costing between £125,001 and £250,000, i.e. the next £125,000

                propertyvalue -= 125000;
                if (propertyvalue < 0) {
                    propertyvalue = 0
                }

                stampduty += Math.min(675000, propertyvalue) * 0.05; // 5% duty on properties costing between £250,000 and £925,000, i.e. the next £675,000

                propertyvalue -= 675000;
                if (propertyvalue < 0) {
                    propertyvalue = 0
                }

                stampduty += Math.min(575000, propertyvalue) * 0.10; // 10% duty on properties costing between £250,000 and £925,000, i.e. the next £575,000

                propertyvalue -= 575000;
                if (propertyvalue < 0) {
                    propertyvalue = 0
                }

                stampduty += propertyvalue * 0.12; // 12% duty on the rest

                return stampduty;
            },
            calculate_oldsystem: function (propertyvalue) {
                var stampduty = 0;
                if (propertyvalue < 0) {
                    propertyvalue = 0
                }

                if (propertyvalue > 125000 && propertyvalue <= 250000) stampduty = propertyvalue * 0.01;
                else if (propertyvalue > 250000 && propertyvalue <= 500000) stampduty = propertyvalue * 0.03;
                else if (propertyvalue > 500000 && propertyvalue <= 1000000) stampduty = propertyvalue * 0.04;
                else if (propertyvalue > 1000000 && propertyvalue <= 2000000) stampduty = propertyvalue * 0.05;
                else if (propertyvalue > 2000000) stampduty = propertyvalue * 0.07;

                return stampduty;
            },
            calculate_first: function (propertyvalue) {
                var stampduty = 0;
                propertyvalue -= 300000; // first £300,000 is tax-free
                if (propertyvalue < 0) {
                    propertyvalue = 0
                }

                stampduty += Math.min(200000, propertyvalue) * 0.05; // 2% duty on properties costing between £300,001 and £500,000, i.e. the next £125,000

                return stampduty;
            }
        };

        $("#stampduty-calculate").click(function (e) {
            e.preventDefault();

            var propertyvalue, result, _group;
            propertyvalue = $("#stampduty-propertyvalue").val().replace(/,/g, '');
            propertyvalue = parseInt(propertyvalue);

            $('.form-group').removeClass('has-error');

            var type = $("#stampduty-type").val();

            var valid = true;
            if (isNaN(propertyvalue)) {
                _group = $('#stampduty-propertyvalue').closest('.form-group');
                _group.find('.help-block').html("Please enter the property value in pounds.");
                _group.addClass('has-error');
                valid = false;
            }

            if (!type.length) {
                _group = $('#stampduty-type').closest('.form-group');
                _group.find('.help-block').html("Please select a value.");
                _group.addClass('has-error');
                valid = false;
            }

            if (valid === true) {

                /** is first time buyer? **/
                if (type === 'first' && propertyvalue < 500000) {
                    result = stampduty.calculate_first(propertyvalue);
                } else {
                    result = stampduty.calculate(propertyvalue);
                }

                result = result.toFixed(2);

                // regex from https://stackoverflow.com/a/2901298
                result = result.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var _result = $('.stampduty-result');
                _result.find('strong').html(result);
                _result.slideDown();
                $("#stampduty-calculate").html('Recalculate');

               /* $('html, body').animate({
                    scrollTop: $("#calculator-results").offset().top - 50
                }, 1000);*/
            }
            else {
                $('.stampduty-result').hide();
            }
        });
    }
});
/* END stamp duty calculator*/

/**
 * Buy to let stamp duty calculator
 * /buy-to-let-stamp-duty-calculator/
 */
jQuery(document).ready(function ($) {

    if ($(".stampduty-btl-calculate").length) {
        var stampduty_btl = {
            calculate: function (propertyvalue) {
                var stampduty = 0;
                propertyvalue -= 125000; // first £125,000 is tax-free
                if (propertyvalue < 0) {
                    propertyvalue = 0
                }

                stampduty += Math.min(125000, propertyvalue) * 0.02; // 2% duty on properties costing between £125,001 and £250,000, i.e. the next £125,000

                propertyvalue -= 125000;
                if (propertyvalue < 0) {
                    propertyvalue = 0
                }

                stampduty += Math.min(675000, propertyvalue) * 0.05; // 5% duty on properties costing between £250,000 and £925,000, i.e. the next £675,000

                propertyvalue -= 675000;
                if (propertyvalue < 0) {
                    propertyvalue = 0
                }

                stampduty += Math.min(575000, propertyvalue) * 0.10; // 10% duty on properties costing between £250,000 and £925,000, i.e. the next £575,000

                propertyvalue -= 575000;
                if (propertyvalue < 0) {
                    propertyvalue = 0
                }

                stampduty += propertyvalue * 0.12; // 12% duty on the rest

                return stampduty;
            },
            calculate_newsystem: function (propertyvalue) {
                var stampduty = 0;
                if (propertyvalue < 40000) {
                    return stampduty;
                }

                stampduty += Math.min(125000, propertyvalue) * 0.03; // 3% duty on properties costing between £40.000 and £125,000

                propertyvalue -= 125000;
                if (propertyvalue < 0) {
                    propertyvalue = 0;
                }

                stampduty += Math.min(125000, propertyvalue) * 0.05; // 5% duty on properties costing between £125,001 and £250,000, i.e. the next £125,000

                propertyvalue -= 125000;
                if (propertyvalue < 0) {
                    propertyvalue = 0;
                }

                stampduty += Math.min(675000, propertyvalue) * 0.08; // 8% duty on properties costing between £250,000 and £925,000, i.e. the next £675,000

                propertyvalue -= 675000;
                if (propertyvalue < 0) {
                    propertyvalue = 0;
                }

                stampduty += Math.min(575000, propertyvalue) * 0.13; // 13% duty on properties costing between £250,000 and £925,000, i.e. the next £575,000

                propertyvalue -= 575000;
                if (propertyvalue < 0) {
                    propertyvalue = 0;
                }

                stampduty += propertyvalue * 0.15; // 15% duty on the rest

                return stampduty;
            }
        };

        $(".stampduty-btl-calculate").click(function (e) {
            e.preventDefault();

            var _parent = $(this).closest('.widget-section');

            var propertyvalue, result_newsystem, _group;
            propertyvalue = _parent.find(".stampduty-propertyvalue").val().replace(/,/g, '');
            propertyvalue = parseInt(propertyvalue);

            $('.form-group').removeClass('has-error');
            var valid = true;

            if (isNaN(propertyvalue)) {
                _group = _parent.find(".stampduty-propertyvalue").closest('.form-group');
                _group.find('.help-block').html("Please enter the property value in pounds.");
                _group.addClass('has-error');
                valid = false;
            }

            if (valid === true) {
                if ($(this).hasClass('single')) {
                    result_newsystem = propertyvalue * 0.0075;
                } else {
                    result_newsystem = stampduty_btl.calculate_newsystem(propertyvalue);
                }
                result_newsystem = result_newsystem.toFixed(2);

                // regex from https://stackoverflow.com/a/2901298
                result_newsystem = result_newsystem.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                var _result = _parent.find('.stampduty-result');
                _result.find('strong').html(result_newsystem);
                _result.slideDown();
                _parent.find('.stampduty-btl-calculate').html('Recalculate');

                /*$('html, body').animate({
                    scrollTop: _parent.find(".calculator-results").offset().top - 50
                }, 1000);*/
            }
            else {
                $('.stampduty-result').hide();
            }
        });
    }
});

/* END buy to let stamp duty calculator*/

/**
 * Other calculators
 * /buy-to-let-calculator/
 * /how-much-can-i-borrow-calculator/
 * /mortgage-calculators/mortgage-repayment-calculator/
 */

function Calculators() {
    this.e_label1 = '';
    this.e_label2 = '';
    this.e_label3 = '';
    this.repaymentCalculatorError = false;
}

Calculators.prototype.validateCurrency = function (data, optional) {
    if (data !== '' || data === 0 || optional === 1) {
        if (data.match(/^(£)?(\d{1,3}(,\d{3})*|(\d+))(\.\d{2})?$/gi)) {
            data = data.replace(/,/gi, '').replace(/£/gi, '');
            data = data.replace(/(\.\d{2})/gi, '');
            return data;
        } else {
            return 'invalid';
        }
    }
    return '0';
};

Calculators.prototype.validateInterest = function (data) {
    data = data + '';
    if (data !== '') {
        if ((/^\d{1,2}(\.\d*)?(%)?$/gi).test(data)) {
            data = data.replace(/%/gi, '');
            if (data === '0' || parseFloat(data, 10) === 0) {
                return 'invalid';
            }
            return data;
        } else {
            return 'invalid';
        }
    }
    return 'invalid';
};

Calculators.prototype.validateYears = function (data) {
    if (data !== '') {
        if ((/^\d{1,2}$/gi).test(data)) {
            if (data === '0' || parseFloat(data, 10) === 0) {
                return 'invalid';
            }
            return data;
        } else {
            return 'invalid';
        }
    }
    return 'invalid';
};

Calculators.prototype.formatCurrency = function (data) {
    var decim = String(data).split('.'),
        chars = decim[0].split('').reverse(),
        newstr = '',
        count = 0;

    for (var x in chars) {
        count += 1;
        if (count % 3 === 1 && count !== 1) {
            newstr = chars[x] + ',' + newstr;
        } else {
            newstr = chars[x] + newstr;
        }
    }

    if (typeof decim[1] !== 'undefined') {
        newstr += '.' + decim[1];
    }

    return newstr;
};

Calculators.prototype.appendAdditionalApplicant = function (calculatorType, theForm) {
    jQuery(theForm).find('.data2').closest('.second-applicant').before('<a class="additional-applicant button button-alt">Add applicant</a>');
    jQuery(theForm).find('.additional-applicant').click(function (e) {
        e.preventDefault();
        jQuery(this).remove();
        jQuery(theForm).find('.second-applicant').show();
    });
};

Calculators.prototype.setupErrorLabels = function (calculatorType) {

    switch (calculatorType) {
        case 'how_much':
            this.e_label1 = 'Please enter a valid salary';
            this.e_label2 = 'Please enter a valid salary or leave blank';
            break;
        case 'buy_to_let_mortgage':
            this.e_label1 = 'Please enter a valid monthly rental income';
            this.e_label2 = 'Please enter a valid property value or leave blank';
            break;
        case 'REPAYMENT':
            this.e_label1 = 'Please enter a valid mortgage amount';
            this.e_label2 = 'Please enter a valid interest rate';
            this.e_label3 = 'Please enter a valid number of years';
            break;
    }
};

Calculators.prototype.calculateRepayments = function (years, ir, amount) {
    var numberOfInvalidFields = 0;
    jQuery('.calculator-container.sliders input').each(function (index, item) {
        if (jQuery(item).val() === '') {
            numberOfInvalidFields += 1;
        }
    });
    if (numberOfInvalidFields > 0) {
        return {
            monthlyRep: '',
            interestOnly: ''
        };
    }

    years = +years;
    ir = +ir;
    amount = +amount;

    var n = years * 12;
    var a = 1 / (1 + ir / 1200);

    var interestOnly = (amount * ir) / 1200;
    var monthlyRep = interestOnly * (1 / (1 - (Math.pow(a, n))));

    return {
        monthlyRep: (Math.round(monthlyRep * 100) / 100),
        interestOnly: (Math.round(interestOnly * 100) / 100)
    };
};

Calculators.prototype.calculateMortgage = function (calculatorType, theForm) {
    this.setupErrorLabels(calculatorType);
    var data1 = theForm.find('.data1').val();
    var data2 = theForm.find('.data2').val();
    var data3 = '';
    if (theForm.find('.data3')) {
        data3 = theForm.find('.data3').val();
    }
    var e_data1 = false,
        e_data2 = false,
        e_data3 = false;
    var message;

    //clear the error messages
    theForm.find('.form-group').removeClass('has-error');

    data1 = this.validateCurrency(data1, 0);

    if (data1 === '0' || data1 === 'invalid') {
        e_data1 = true;
        theForm.find('.data1').closest('.form-group').addClass('has-error');
        theForm.find('.data1').closest('.form-group').find('.help-block').html(this.e_label1);
    } else {
        data1 = parseInt(data1, 10);
    }

    if (calculatorType === 'how_much') {

        if (theForm.find('.data2').is(':visible')) {
            if (data2 === '0' || data2 === 'invalid' || data2 === '') {
                e_data2 = true;
                theForm.find('.data2').closest('.form-group').addClass('has-error');
                theForm.find('.data2').closest('.form-group').find('.help-block').html(this.e_label1);
            } else {
                data2 = this.validateCurrency(data2, 1);
                if (data2 === 'invalid') {
                    e_data2 = true;
                    theForm.find('.data2').closest('.form-group').addClass('has-error');
                    theForm.find('.data2').closest('.form-group').find('.help-block').html(this.e_label2);
                }
            }
        } else {
            data2 = '0';
        }
    }
    if (calculatorType === 'buy_to_let_mortgage') {
        if (data2 !== '') {
            data2 = this.validateCurrency(data2, 1);
            if (data2 === 'invalid') {
                e_data2 = true;
                theForm.find('.data2').closest('.form-group').addClass('has-error');
                theForm.find('.data2').closest('.form-group').find('.help-block').html(this.e_label2);
            }
        } else {
            data2 = '0';
        }
    }
    if (calculatorType === 'REPAYMENT') {
        data2 = this.validateInterest(data2);
        if (data2 === 'invalid' || data2 === '') {
            e_data2 = true;
            alert(this.e_label2);
            theForm.find('.data-2-label').addClass('form-error');
        }
        data3 = this.validateInterest(data3);
        if (data3 === 'invalid' || data3 === '') {
            e_data3 = true;
            alert(this.e_label3);
            theForm.find('.data-3-label').addClass('form-error');
        }
    }


    if (e_data1 !== true && e_data2 !== true && e_data3 !== true) {
        if (calculatorType === 'how_much') {
            if (!jQuery('.additional-applicant').length > 0) {
                data2 = parseInt(data2, 10);
                data1 += data2;
            }
            data2 = data1 * 5;
            data1 *= 3;
            message = 'You are likely to be able to borrow between &pound;' + this.formatCurrency(data1) + ' and &pound;' + this.formatCurrency(data2);
            fbq('track', 'Lead');
        } else if (calculatorType === 'buy_to_let_mortgage') {
            data2 = parseInt(data2, 10);

            data1 *= 192; // 192 = 24000/125
            if (data2 > 0) {
                data2 *= 0.75; // 0.75 = 3/4
                if (data1 > data2) {
                    data1 = data2;
                }
            }
            message = 'You are likely to be able to borrow approximately &pound;' + this.formatCurrency(data1);

        } else if (calculatorType === 'REPAYMENT') {
            data2 = parseFloat(data2, 10);
            data3 = parseFloat(data3, 10);

            var n = data3 * 12;
            var a = 1 / (1 + data2 / 1200);

            var interestOnly = (data1 * data2) / 1200;
            var monthlyRep = interestOnly * (1 / (1 - (Math.pow(a, n))));

            message = '<div class="calculator-results-wrapper"><p class="calculator-output">Your monthly repayments will be approximately &pound;' + this.formatCurrency(monthlyRep) + ' if you opt for a repayment mortgage, or &pound;' + this.formatCurrency(interestOnly) + ' a month if you have an interest-only mortgage.</p>';
        }

        var _arrow = theForm.find('#calculate i');
        theForm.find('#calculate').html('Recalculate').append(_arrow);
        theForm.find('#calculator-results h4').html(message);
        theForm.find('#calculator-results').slideDown();

       /* if ($('#calcModal').length == 0) {
            jQuery('html, body').animate({
                scrollTop: jQuery("#calculator-results").offset().top - 50
            }, 1000);
        }*/
    }
};

Calculators.prototype.initRepayments = function () {
    var that = this;

    this.repaymentLimits = {
        years: {
            min: 2,
            max: 40,
            start: 25
        },
        amount: {
            min: 0,
            max: 1000000,
            start: 100000
        },
        ir: {
            min: 0.1,
            max: 12,
            start: 3.2
        }
    };

    //Initialize error messaging
    jQuery('.slider-wrapper').each(function (index, item) {
        var label = jQuery(this).find('input[type="text"]').attr('id').split('-')[1];
        jQuery(this).find('.help-block .min').html(that.formatCurrency(that.repaymentLimits[label].min));
        jQuery(this).find('.help-block .max').html(that.formatCurrency(that.repaymentLimits[label].max));
    });


    //Slider stuff for mortagage calculators
    jQuery('#mrc-years-slider').noUiSlider({
        range: [that.repaymentLimits.years.min, that.repaymentLimits.years.max],
        step: 1,
        start: that.repaymentLimits.years.start,
        handles: 1,
        slide: function () {
            var years = jQuery(this).val();

            jQuery(this).parents('.slider-wrapper').removeClass('has-error');

            jQuery('#mrc-years').val(years);
            that.checkRepaymentValidity();
            that.dispayRepaymentResults();
        }
    });

    jQuery('#mrc-amount-slider').noUiSlider({
        range: [that.repaymentLimits.amount.min, that.repaymentLimits.amount.max],
        step: 1000,
        start: that.repaymentLimits.amount.start,
        handles: 1,
        slide: function () {
            var amount = jQuery(this).val(),
                formattedAmount = that.formatCurrency(amount);

            jQuery(this).parents('.slider-wrapper').removeClass('has-error');

            jQuery('#mrc-amount').val(formattedAmount);

            that.checkRepaymentValidity();
            that.dispayRepaymentResults();
        }
    });

    jQuery('#mrc-ir-slider').noUiSlider({
        range: [that.repaymentLimits.ir.min, that.repaymentLimits.ir.max],
        step: 0.01,
        start: that.repaymentLimits.ir.start,
        handles: 1,
        slide: function () {
            var ir = jQuery(this).val();

            jQuery(this).parents('.slider-wrapper').removeClass('has-error');
            jQuery('#mrc-ir').val(ir);

            that.checkRepaymentValidity();
            that.dispayRepaymentResults();
        }
    });

    that.dispayRepaymentResults();

    jQuery('.slider-wrapper input').bind('focus', function () {
        jQuery(this).val(that.convertToNumber(jQuery(this).val()));
    });

    jQuery('.slider-wrapper input').bind('blur', function () {
        jQuery(this).val(that.formatCurrency(jQuery(this).val()));
    });


    jQuery('.slider-wrapper input[type="text"]').bind('keydown', function (ev) {
        if (ev.keyCode === 38 || ev.keyCode === 40) {
            ev.preventDefault();
        }
        if (ev.keyCode < 90 && ev.keyCode > 65) {
            ev.preventDefault();
            return false;
        }

        if (jQuery(this).attr('id') !== 'mrc-ir' && ev.keyCode === 190) {
            ev.preventDefault();
            return false;
        }

        if (jQuery(this).attr('id') === 'mrc-ir' && ev.keyCode === 190) {
            if (jQuery(this).val().indexOf('.') > -1) {
                ev.preventDefault();
            }
        }
    });

    jQuery('.slider-wrapper input[type="text"]').bind('keyup', function (ev) {
        var amountVal,
            keyOffset;

        switch (jQuery(this).attr('id')) {
            case 'mrc-amount':
                keyOffset = 100;
                break;
            case 'mrc-ir':
                keyOffset = 0.1;
                break;
            default:
                keyOffset = 1;
                break;
        }

        if (ev.keyCode === 38) {
            ev.preventDefault();
            amountVal = that.convertToNumber(jQuery(this).val(), this) + keyOffset;
            jQuery(this).val(that.convertToNumber(String(amountVal)));
        }

        if (ev.keyCode === 40) {
            ev.preventDefault();
            amountVal = that.convertToNumber(jQuery(this).val(), this) - keyOffset;
            jQuery(this).val(that.convertToNumber(String(amountVal)));
        }


        if (!/^\d+(\.(\d+)?)?$/.test(jQuery(this).val()) || /0\d+/.test(jQuery(this).val())) {
            amountVal = that.convertToNumber(jQuery(this).val(), this);
            jQuery(this).val(amountVal);
        } else {
            amountVal = jQuery(this).val();
        }

        jQuery(this).parents('.slider-wrapper').find('.noUiSlider').val(+amountVal);

        jQuery(this).parents('.slider-wrapper').removeClass('has-error');

        that.checkRepaymentValidity();

        that.dispayRepaymentResults();
    });
};

Calculators.prototype.checkRepaymentValidity = function () {
    var that = this;
    this.repaymentCalculatorError = false;

    jQuery('.slider-wrapper input[type="text"]').each(function (index, item) {
        var label = jQuery(item).attr('id').split('-')[1],
            am = that.convertToNumber(jQuery(item).val(), item);

        if (+am < that.repaymentLimits[label].min || +am > that.repaymentLimits[label].max) {
            that.repaymentCalculatorError = true;
            jQuery(item).parents('.slider-wrapper').addClass('has-error');
        }
    });
};

Calculators.prototype.dispayRepaymentResults = function () {
    var repayments,
        years = this.convertToNumber(String(jQuery('#mrc-years').val())),
        ir = this.convertToNumber(String(jQuery('#mrc-ir').val())),
        value = this.convertToNumber(String(jQuery('#mrc-amount').val()));

    if (!this.repaymentCalculatorError) {
        repayments = this.calculateRepayments(years, ir, value);
        jQuery('.repayments-results .repayment-monthly-value').html('£' + repayments.monthlyRep);
        jQuery('.repayments-results .interest-monthly-value').html('£' + repayments.interestOnly);
    } else {
        jQuery('.repayments-results .repayment-monthly-value').html('£');
        jQuery('.repayments-results .interest-monthly-value').html('£');
    }
};

Calculators.prototype.convertToNumber = function (str, context) {
    if (str === '') {
        return str;
    }
    var valArray = str.split(''),
        l = valArray.length,
        i,
        numberArray = [],
        num;

    for (i = 0; i < l; i += 1) {
        if (/\d|\./.test(valArray[i])) {
            numberArray.push(valArray[i]);
        }
    }

    if (numberArray[0] === '0' && /\d/.test(numberArray[1])) {
        numberArray.shift();
    }

    num = +numberArray.join('');

    num = Math.round(num * 100) / 100;

    return num;
};

jQuery(document).ready(function ($) {

    $(".calculator-old #calculate").click(function (e) {
        e.preventDefault();
        Calculators.prototype.calculateMortgage($(this).closest('.calculator-old').attr('id'), $(this).closest('.calculator-old'));
    });

    if ($('.calculator-old#how_much').length) {
        Calculators.prototype.appendAdditionalApplicant('how_much', $('.calculator-old'));
    }

    if ($('.calculator-old#repayments').length) {
        Calculators.prototype.initRepayments();
    }
});
/* END other calculators */

/**
 * Base/Interest rate calculator
 * /interest-rate-calculator/
 */
$(document).ready(function () {

    if ($('.calculator-widget#base-rate-calc').length) {
        calculate($('.calculator-widget#base-rate-calc'));

        $('.calculator-widget#base-rate-calc input').on('keyup', function (e) {
            validateNumber(e);
            calculate($('.calculator-widget#base-rate-calc'));
        });
    }
});

/**
 * Method to calculate result
 * @param $form
 */
function calculate($form) {

    /* variables - values */
    var early = $form.find('#br-repayment-charge').val();
    var months_left = $form.find('#br-months-left-on-fix').val();
    var mortgage_required = $form.find('#br-mortgage-required').val();
    var amount_interest = $form.find('#br-amount-on-interest').val();
    var term_years = $form.find('#br-term-years').val();
    var term_months = $form.find('#br-term-months').val();
    var current_rate = $form.find('#br-current-rate').val();

    /* results placeholders */
    var amount_repayment = $form.find('#br-amount-on-repayment');
    var current_rate_number = $form.find('#br-current-rate-number');
    var current_payment = $form.find('#br-current-payment');
    var monthly_saving = $form.find('#br-monthly-saving');
    var new_monthly_payment = $form.find('#br-new-monthly-payment');
    var maximum_rate = $form.find('#br-maximum-rate');

    var amount_repayment_result = mortgage_required - amount_interest;
    amount_repayment.html('&pound;' + amount_repayment_result);

    var current_rate_number_result = parseInt(term_years * 12) + parseInt(term_months);
    current_rate_number.val(current_rate_number_result);

    var pmt = PMT(current_rate / 100 / 12, current_rate_number_result, mortgage_required);
    current_payment.val(Math.round(pmt * 100) / 100);

    var monthly_saving_result = early / months_left;
    monthly_saving.val(Math.round(monthly_saving_result * 100) / 100);

    var new_monthly_payment_result = pmt - monthly_saving_result;
    new_monthly_payment.val(Math.round(new_monthly_payment_result * 100) / 100);

    var maximum_rate_result = RATE(current_rate_number_result, -new_monthly_payment_result, mortgage_required) * 12 * 100;
    maximum_rate.html((Math.round(maximum_rate_result * 100) / 100) + '%')
}

function validateNumber(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        // Allow: Ctrl+A, Command+A
        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: home, end, left, right, down, up
        (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}

/**
 * Copy of Excel's PMT function.
 * Credit: http://thoughts-of-laszlo.blogspot.nl/2012/08/complete-formula-behind-excels-pmt.html
 *
 * @param $interest        The interest rate for the loan.
 * @param $num_of_payments The total number of payments for the loan in months.
 * @param $PV              The present value, or the total amount that a series of future payments is worth now;
 *                         Also known as the principal.
 * @param $FV              The future value, or a cash balance you want to attain after the last payment is made.
 *                         If fv is omitted, it is assumed to be 0 (zero), that is, the future value of a loan is 0.
 * @param $Type            Optional, defaults to 0. The number 0 (zero) or 1 and indicates when payments are due.
 *                         0 = At the end of period
 *                         1 = At the beginning of the period
 *
 * @return {number}
 */
function PMT($interest, $num_of_payments, $PV) {
    var $FV = 0.00;
    var $Type = 0;

    var $xp = Math.pow((1 + $interest), $num_of_payments);

    return ($PV * $interest * $xp / ($xp - 1) + $interest / ($xp - 1) * $FV) * ($Type === 0 ? 1 : 1 / ($interest + 1));
}

/**
 * @return {number}
 */
function RATE(nper, pmt, pv, fv, type, guess) {
    // Sets default values for missing parameters
    fv = typeof fv !== 'undefined' ? fv : 0;
    type = typeof type !== 'undefined' ? type : 0;
    guess = typeof guess !== 'undefined' ? guess : 0.1;

    // Sets the limits for possible guesses to any
    // number between 0% and 100%
    var lowLimit = 0;
    var highLimit = 1;

    // Defines a tolerance of up to +/- 0.00005% of pmt, to accept
    // the solution as valid.
    var tolerance = Math.abs(0.00000005 * pmt);

    // Tries at most 40 times to find a solution within the tolerance.
    for (var i = 0; i < 40; i++) {
        // Resets the balance to the original pv.
        var balance = pv;

        // Calculates the balance at the end of the loan, based
        // on loan conditions.
        for (var j = 0; j < nper; j++) {
            if (type === 0) {
                // Interests applied before payment
                balance = balance * (1 + guess) + pmt;
            } else {
                // Payments applied before insterests
                balance = (balance + pmt) * (1 + guess);
            }
        }

        // Returns the guess if balance is within tolerance.  If not, adjusts
        // the limits and starts with a new guess.
        if (Math.abs(balance + fv) < tolerance) {
            return guess;
        } else if (balance + fv > 0) {
            // Sets a new highLimit knowing that
            // the current guess was too big.
            highLimit = guess;
        } else {
            // Sets a new lowLimit knowing that
            // the current guess was too small.
            lowLimit = guess;
        }

        // Calculates the new guess.
        guess = (highLimit + lowLimit) / 2;
    }

    // Returns null if no acceptable result was found after 40 tries.
    return null;
}

/* END interest calculator */


function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}