var step = '1';
var maxLTV,
    maxLoanVal,
    minLoanVal;
var interestOnlyAmount = '';
var repaymentAmount = '';

$(document).ready(function () {

    maxLTV = $('#maxLTV').val();
    maxLoanVal = $('#maxLoanVal').val();
    minLoanVal = $('#minLoanVal').val();

    // Google Page Tracking
    if (window._gat) {
        pageTracker._trackPageview('/calculators/buytolet/screen_1');
    }

    pageLoad();
    customCheckBoxes($('#pagewrapper'));
    sectionChangeScripts();
    step1ChangeEvents();
    calcProgress();

});





// ============================================================================== //
//                            Page Load / Helpers                                 //
// ============================================================================== //

function pageLoad() {

    // Label help box toggle
    $(document).on('click', '.helpWrap img', function (e) {
        killclick(e);
        if ($(this).next('.helpMsg').html() != '') {
            var msg = $(this).next('.helpMsg');

            if ($(this).parent().hasClass('active')) {
                $(this).attr('src', '/img/calc/tooltip.png');
            } else {
                $('.helpWrap').removeClass('active').find('img').attr('src', '/img/calc/tooltip.png');
                $('.helpMsg').hide();
                $(this).attr('src', '/img/calc/tooltip-hover.png');
            }
            $(this).parent().toggleClass('active');
            msg.toggle();
        }
    });

    $('label').click(function () { });

    /*////////////////////////
        Desktop help messages
        ////////////////////////*/
    if ($(window).width() > 880) {

        $('.calcWrap').on('mouseenter', '.helpWrap img', function () {
            $(this).attr('src', '/img/calc/tooltip-hover.png');
        }).on('mouseleave', '.helpWrap img', function () {
            if (!$(this).parent().hasClass('active')) {
                $(this).attr('src', '/img/calc/tooltip.png');
            }
        });
    }

    // Hide tooltips if info message is null
    $('.helpMsg').each(function () {
        if ($(this).html() == '') {
            $(this).parent().find('img').hide();
        }
    });

    $('.helpMsg').hide();

    // Hide 0's when textbox clicked
    $('input.numberCheck').focus(function () {
        if ($(this).val() == '0') {
            $(this).val('');
        }
    });
    $('input.numberCheck').blur(function () {
        if ($(this).val() == '') {
            $(this).val('0');
        }
    });

    // Clear error class when value changed
    $('.calcWrap').on('keyup', '.rowError .numberCheck', function () {
      
        $(this).closest('.row').removeClass('rowError');
        $(this).closest('.row').find('.error').hide();
    });
    $('.calcWrap').on('change', '.rowError select', function () {
        if ($(this).find(':selected').index() != 0) {
            $(this).closest('.row').removeClass('rowError');
            $(this).closest('.row').find('.error').hide();
        }
    });


    /*////////////////////////
        Custom select boxes
        ////////////////////////*/
    var selectBox = $('select').selectBoxIt({
        showEffect: 'fadeIn',
        showEffectSpeed: 200,
        hideEffect: 'fadeOut',
        hideEffectSpeed: 200
    });

    // Price input, adds comma
    $('.calcWrap').on('keyup', '.currencyWrap input', function (e) {
        if (e.which >= 37 && e.which <= 40) return;
        $(this).val(function (i, val) {
            return val.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });

    // Summary
    $(document).on('click', '.viewSummary', function () {
        $(this).toggleClass('active');
        $(this).next().stop(true).slideToggle();
    });

    // Hide Validation on Input
    $(document).on('keyup', '.numberCheck', function () {
        if ($(this).val().length > 1) {
            updateValidation($(this));
        }
    });
    $(document).on('change', '.checkbox input, select', function () {
        updateValidation($(this));
    });

    function updateValidation(el) {
        var error = el.closest('.row').find('.error');
        if (error.is(':visible')) {
            error.hide();
        }
    }

}

function customCheckBoxes($element) {

    $element.find('.checkbox').each(function () {
        var el = $(this).find('input'),
            parent = el.next('label'),
            type = el.attr('type'),
            checked = el.is(':checked') ? 'checkActive' : '';

        el.addClass('offset');
        parent.prepend('<span class="customCheck ' + type + '"></span>').addClass('check');
        parent.addClass(checked);

        if (el.is(':disabled')) {
            parent.addClass('disabled');
        }

        el.on('change', function () {
            if (el.not(':disabled')) {
                var checked = this.checked ? 'checkActive' : '';
                if (type == 'radio') {
                    parent.closest('.row').find('.check ').removeClass('checkActive');
                } else {
                    parent.removeClass('checkActive');
                }
                parent.addClass(checked);

                $(this).blur();
            }

        });


    });

}

function sectionChangeScripts() {

    $('.labelWrap').each(function () {
        var wrapH = $(this).height(),
            labelH = $(this).find('> label').height(),
            dif = wrapH - labelH;
        if (dif > 10) {
            $(this).addClass('widow');
        }
    });

}


// Reset tooltips and inputs after AJAX calls
function resetTooltipsAndInputs($div) {

    // Hide tooltips if info message is null
    $div.find('.helpMsg').each(function () {
        if ($(this).html() == '') {
            $(this).parent().find('.information').hide();
        }
    });

    $div.find('.helpMsg').hide();

    // Select boxes
    var selectBox = $div.find('select').selectBoxIt({
        showEffect: 'fadeIn',
        showEffectSpeed: 200,
        hideEffect: 'fadeOut',
        hideEffectSpeed: 200
    });

    // Text boxes
    $div.find('input[type=text].numberCheck, input[type=number].numberCheck').focus(function () {
        if ($(this).val() == '0') {
            $(this).val('');
        }
    });
    $div.find('input[type=text].numberCheck, input[type=number].numberCheck').blur(function () {
        if ($(this).val() == '') {
            $(this).val('0');
        }
    });

}

// Loading animation for Print button
$(document)
  .ajaxStart(function () {
      $('#printWait').css('display', 'inline');
  })
  .ajaxStop(function () {
      $('#printWait').hide();
  });

/* Killclick function */
function killclick(e) {
    if (e.preventDefault) {
        e.preventDefault();
    } else {
        e.returnValue = false;
    }
}

/* SlideFadeToggle */
$.fn.slideFadeToggle = function (speed, easing, callback) {
    return this.animate({
        opacity: 'toggle',
        height: 'toggle'
    }, speed, easing, callback);
};


// ============================================================================== //
//                                Change Events                                   //
// ============================================================================== //

function step1ChangeEvents() {

    // Single or Joint application
    $('#rbApplicationTypeSingle').change(function () {
        applicationType = 'Single';
        applicants = 1;
        $('#pnlApplicationTypeJoint').hide();
       
    });
    $('#rbApplicationTypeJoint').change(function () {
        applicationType = 'Joint';
        applicants = 2;
        $('#pnlApplicationTypeJoint').show();
       
    });



    // Monthly rent
    $('#tbMonthlyRent').blur(function () {

        var monthlyRent = $(this).val().replace(/,/g, '');
        // Update annual rent, adding commas
        $('#pAnnualRent').text('£' + Math.ceil(monthlyRent * 12).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        // Update monthly allowance for rental voids, adding commas
        $('#tbMonthlyAllowanceRentalVoids').val(Math.ceil(monthlyRent / 12).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

    });

    // Application type - Purchase or Remortgage
    $('#rbPurchase').change(function () {
        applicationTypePurchase = 'Purchase';
        remortgageError('hide');

            $('#pnlCurrentBalance').slideUp();
            $('#pnlCurrentBalanceSameOrLess').slideUp();
        $('#pnlPurchaseApplicationPortingInfo').show();
               
    });

    $('#rbRemortgage').change(function () {
        applicationTypePurchase = 'Remortgage';
       // console.log(applicationTypePurchase);

            $('#pnlCurrentBalance').slideDown();
            $('#pnlCurrentBalanceSameOrLess').slideDown();
            $('#pnlPurchaseApplicationPortingInfo').hide();

      
        
    });



    //$('#ddlApplicationType').change(function () {

    //    remortgageError('hide');

    //    if ($('#ddlApplicationType option:selected').val() == "Purchase") {
    //        $('#pnlCurrentBalance').slideUp();
    //        $('#pnlCurrentBalanceSameOrLess').slideUp();
           
    //        $('#pnlPurchaseApplicationPortingInfo').show();
    //    }
    //    else {
    //        $('#pnlCurrentBalance').slideDown();
    //        $('#pnlCurrentBalanceSameOrLess').slideDown();
    //        $('#pnlPurchaseApplicationPortingInfo').hide();

    //        if ($('#ddlApplicationType option:selected').val() == "Remortgage (without capital raising)" &&
    //            $('#rbCurrentBalanceSameOrLessNo').is(':checked')) {
    //            remortgageError('show');
    //        }
    //    }
    //});

  
    // Purchase or Remortgage
    $('#rbCurrentBalanceSameOrLessYes').change(function () {
        if ($('#rbPurchase').val() == "Purchase") {
        remortgageError('hide');
        }
    });
    // Current balance <= 31/12/2016
    $('#pnlCurrentBalanceSameOrLess input[type="radio"]').change(function () {
        if ($('#rbCurrentBalanceSameOrLessYes').is(':checked')) {
            $(this).closest('.row').find('.infoMsg').removeClass('hide');
        } else {
            $(this).closest('.row').find('.infoMsg').addClass('hide');
        }        
    });







    //$('#rbCurrentBalanceSameOrLessNo').change(function () {
        
    //    if ($('#rbRemortgage').val() == "Remortgage") {
    //       remortgageError('show');
           
           
    //    }
    //});

    //$('#rbCurrentBalanceSameOrLessNo').change(function () {
    //    if ($('#ddlApplicationType option:selected').val() == "Remortgage (without capital raising)") {
    //        remortgageError('show');
    //    }
    //});

    // Borrowing on a 5 year fixed rate
    $('#rbBorrowing5YearFixedYes').change(function () {
        if ($('#rbPurchase').is(':checked')) {
            $('#pnlPurchaseApplicationPortingInfo').show();
        }
    });
    $('#rbBorrowing5YearFixedNo').change(function () {
        $('#pnlPurchaseApplicationPortingInfo').hide();
    });

    // Repayment method
    $('#ddlRepaymentMethod').change(function () {
        checkRepaymentMethod();
    });

    // Agent managing property
    $('#rbAgentManagingPropertyYes').change(function () {
        $('#pnlMonthlyAgentsFees').slideDown();
    });
    $('#rbAgentManagingPropertyNo').change(function () {
        $('#pnlMonthlyAgentsFees').slideUp();
    });


    // Check repayment method selection
    function checkRepaymentMethod() {
        if ($('#ddlRepaymentMethod option:selected').val() == "Repayment") {
            $('#pnlInterestOnlyAmount').slideUp();
            $('#pnlRepaymentAmount').slideUp();
            $('#pnlTotalAmount').slideUp();
            $('#pnlTerm').slideDown();
        }
        else if ($('#ddlRepaymentMethod option:selected').val() == "Part and part") {
            $('#pnlInterestOnlyAmount').slideDown();
            $('#pnlRepaymentAmount').slideDown();
            $('#pnlTotalAmount').slideDown();
            $('#pnlTerm').slideDown();
            partAndPartTotal();
        }
        else {
            $('#pnlInterestOnlyAmount').slideUp();
            $('#pnlRepaymentAmount').slideUp();
            $('#pnlTotalAmount').slideUp();
            $('#pnlTerm').slideUp();
        }
    }


    // Remortgage error - show/hide message and relevant panels
    function remortgageError(action) {

        if (action == "show") {
            $('#pnlRemortgageError').show();
            $('#pnlBorrowing5YearFixed').slideUp();
            $('#pnlRepaymentMethod').slideUp();
            $('#pnlInterestOnlyAmount').slideUp();
            $('#pnlRepaymentAmount').slideUp();
            $('#pnlTerm').slideUp();
            $('#pnlMonthlyRunningCosts').slideUp();
            $('#btnContinue').hide();
        }
        else {
            $('#pnlRemortgageError').hide();
            $('#pnlBorrowing5YearFixed').slideDown();
            $('#pnlRepaymentMethod').slideDown();
            checkRepaymentMethod();
            $('#pnlMonthlyRunningCosts').slideDown();
            $('#btnContinue').show();
        }
    }

    // Total Amount Required
    $('#tbInterestOnlyAmount').keyup(partAndPartTotal);

    // Repayment amount Required
    $('#tbRepaymentAmount').keyup(partAndPartTotal);

    function partAndPartTotal() {
        var x = parseInt($('#tbInterestOnlyAmount').val().replace(/,/g, '')),
            x = (x) ? x : 0,
            y = parseInt($('#tbRepaymentAmount').val().replace(/,/g, '')),
            y = (y) ? y : 0,
            total = (x + y).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        $('#pTotalAmountRequired').text('£' + total);
        $('#pTotalAmountRequired').data('total', (x + y).toString());
    }



    var otherCommitmentsInfo1HTML = $('#pnlOtherMonthlyCommitmentsInfo1').html();
    var otherCommitmentsInfo2HTML = $('#pnlOtherMonthlyCommitmentsInfo2').html();

    // Ground rent and service charge
    $('#tbGroundRentServiceCharge, #tbOtherMonthlyCosts').blur(function () {
        
        var otherMonthlyCosts = parseFloat($('#tbOtherMonthlyCosts').val().replace(/,/g, ''));
        var groundRentServiceCharge = parseFloat($('#tbGroundRentServiceCharge').val().replace(/,/g, ''));
        var totalForInfoMessage = (otherMonthlyCosts + groundRentServiceCharge).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
       
        if (otherMonthlyCosts > 0 && groundRentServiceCharge > 0) {
            
            $('#pnlOtherMonthlyCommitmentsInfo1').html(otherCommitmentsInfo1HTML.replace('{otherMonthlyAmount1}', totalForInfoMessage));

            $('#pnlOtherMonthlyCommitmentsInfo1').show();
            $('#pnlOtherMonthlyCommitmentsInfo2').hide();
        }
        else if (otherMonthlyCosts == 0 && groundRentServiceCharge > 0) {

            $('#pnlOtherMonthlyCommitmentsInfo2').html(otherCommitmentsInfo2HTML.replace('{otherMonthlyAmount2}', totalForInfoMessage));

            $('#pnlOtherMonthlyCommitmentsInfo1').hide();
            $('#pnlOtherMonthlyCommitmentsInfo2').show();
        }
        else {
            $('#pnlOtherMonthlyCommitmentsInfo1').hide();
            $('#pnlOtherMonthlyCommitmentsInfo2').hide();
        }

    });

    // Start over button - Google Event Tracking
    $('#btnStartOver').click(function (e) {
        if (window._gaq) {
            _gaq.push(['_trackEvent', 'Buy to Let Button: Start Over', 'Clicked on: Step ' + step, $(this).attr('href')]);
        }
    });

}

function step2ChangeEvents() {

    // Save & Print button
    $('#btnPrint').click(function (e) {

        $('html').addClass('printStyles');
        $('.printStyles *').css('behavior', 'none');
        var pageHTML = $('html')[0].outerHTML;
        $('html').removeClass('printStyles');
        $('.btn, .calcNav .count, label .help').css('behavior', 'url(/css/calc/PIE.htc)');

        // Create PDF
        $.ajax({
            type: 'POST',
            async: true,
            url: 'https://www.santanderforintermediaries.co.uk/umbraco/surface/BuyToLet/CreatePDF',
            contentType: 'application/json;charset=utf-8',
            dataType: 'json',
            data: JSON.stringify({ strPageHTML: pageHTML }),
            success: function (result) {

                if (result.indexOf('.pdf') != -1) {
                    window.location = 'https://www.santanderforintermediaries.co.uk/umbraco/surface/BuyToLet/DownloadPDF?strFilename=' + result;
                    $('#btnPrint').hide();
                    $("#btnDownloadPDF").show();
                }
                else {
                    $('#pnlErrorGeneric').show();
                }

                // Google Event Tracking
                if (window._gaq) {
                    _gaq.push(['_setAccount', analyticsAccount], ['_trackEvent', 'Buy to Let Button: Save and Print', 'Clicked on: Step ' + step, 'Going to: PDF']);
                }

                // Download PDF button
                $('#btnDownloadPDF').click(function (e) {

                    window.location = 'https://www.santanderforintermediaries.co.uk/umbraco/surface/BuyToLet/DownloadPDF?strFilename=' + result;

                    // Google Event Tracking
                    if (window._gaq) {
                        _gaq.push(['_setAccount', analyticsAccount], ['_trackEvent', 'Buy to Let Button: Download PDF', 'Clicked on: Step ' + step, 'Going to: PDF']);
                    }

                    e.preventDefault();
                });

            },
            error: function (request, status, error) {
                // ajax error
                $('#pnlErrorGeneric').show();
            }
        });

        e.preventDefault();
        $(this).unbind('click');
    });

    // Introducer Internet button - Google Event Tracking
    $('#btnIntroducer').click(function () {
        if (window._gaq) {
            _gaq.push(['_trackEvent', 'Buy to Let Button: Introducer Internet', 'Clicked on: Step 2', $(this).attr('href')]);
        }
    });

}


// ============================================================================== //
//                                 Validation                                     //
// ============================================================================== //

function step1Valid() {

    // Reset errors
    $('#pnlStep1').find('.error').each(function () {
        $(this).hide();
    });
    $('#pnlStep1').find('.row').each(function () {
        $(this).removeClass('rowError');
    });

    var valid = true;

    // Required fields
    if (!$('#rbApplicationTypeSingle').is(':checked') && !$('#rbApplicationTypeJoint').is(':checked')) {
        valid = false;
        $('#rbApplicationTypeSingle').closest('.row').find('.error').show();
        $('#rbApplicationTypeSingle').closest('.row').addClass('rowError');
    }

    if ($('#ddlTaxBandRate option:selected').val() == 'select') {
        valid = false;
        $('#ddlTaxBandRate').closest('.row').find('.error').show();
        $('#ddlTaxBandRate').closest('.row').addClass('rowError');
    }

    if ($('#ddlTaxBandRate2 option:selected').val() == 'select' && $('#rbApplicationTypeJoint').is(':checked')) {
        valid = false;
        $('#ddlTaxBandRate2').closest('.row').find('.error').show();
        $('#ddlTaxBandRate2').closest('.row').addClass('rowError');
    }


    if (!$('#rbPurchase').is(':checked') && !$('#rbRemortgage').is(':checked')) {
        valid = false;
        $('#rbPurchase').closest('.row').find('.error').show();
        $('#rbPurchase').closest('.row').addClass('rowError');
    }

    if ($('#rbCurrentBalanceSameOrLessYes').is(':visible') && !$('#rbCurrentBalanceSameOrLessYes').is(':checked') && !$('#rbCurrentBalanceSameOrLessNo').is(':checked')) {
        valid = false;
        $('#rbCurrentBalanceSameOrLessYes').closest('.row').find('.error').show();
        $('#rbCurrentBalanceSameOrLessYes').closest('.row').addClass('rowError');
    }

 

    if ($('#rbBorrowing5YearFixedYes').is(':visible') && !$('#rbBorrowing5YearFixedYes').is(':checked') && !$('#rbBorrowing5YearFixedNo').is(':checked')) {
        valid = false;
        $('#rbBorrowing5YearFixedYes').closest('.row').find('.error').show();
        $('#rbBorrowing5YearFixedYes').closest('.row').addClass('rowError');
    }

    if ($('#ddlRepaymentMethod option:selected').val() == '0') {
        valid = false;
        $('#ddlRepaymentMethod').closest('.row').find('.error').show();
        $('#ddlRepaymentMethod').closest('.row').addClass('rowError');
    }

    if ($('#rbAgentManagingPropertyYes').is(':visible') && !$('#rbAgentManagingPropertyYes').is(':checked') && !$('#rbAgentManagingPropertyNo').is(':checked')) {
        valid = false;
        $('#rbAgentManagingPropertyYes').closest('.row').find('.error').show();
        $('#rbAgentManagingPropertyYes').closest('.row').addClass('rowError');
    }

    // Numeric fields
    $('#pnlStep1 .numberCheck').each(function () {
        if ($(this).is(':visible') && checkNumberRange($(this), $(this).attr('data-min'), $(this).attr('data-max')) == false) {
            valid = false;
        }
    });

    // Current balance checks against LTV and Max loan value
    //if ($('#ddlApplicationType option:selected').val() == "Remortgage (with capital raising)") {
        
    //    var propertyValue = parseFloat($('#tbPropertyValue').val().replace(/,/g, ''));
    //    var currentBalance = parseFloat($('#tbCurrentBalance').val().replace(/,/g, ''));

    //    if ((currentBalance / propertyValue >= maxLTV) || (currentBalance >= maxLoanValue)) {
    //        valid = false;
    //        $('#tbCurrentBalance').closest('.row').find('.error').show();
    //        $('#tbCurrentBalance').closest('.row').addClass('rowError');
    //    }
    //}

    // Part and part amounts and Current balance
    //if ($('#rbRemortgage').is(':checked') && $('#ddlRepaymentMethod option:selected').val() == "Part and part") {

    //    var currentBalance = parseFloat($('#tbCurrentBalance').val().replace(/,/g, ''));
    //    var repaymentInterestOnlyTotal = parseFloat($('#tbInterestOnlyAmount').val().replace(/,/g, '')) + parseFloat($('#tbRepaymentAmount').val().replace(/,/g, ''));

        //if (currentBalance != repaymentInterestOnlyTotal) {
        //    valid = false;
        //    $('#tbInterestOnlyAmount').closest('.row').find('.error').show();
        //    $('#tbInterestOnlyAmount').closest('.row').addClass('rowError');
        //    $('#tbRepaymentAmount').closest('.row').find('.error').show();
        //    $('#tbRepaymentAmount').closest('.row').addClass('rowError');
        //}
    //}

    // Loan term
    if ($('#tbTermYears').is(':visible') && checkLoanTermRange($('#tbTermYears'), $('#tbTermMonths')) == false) {
            valid = false;
    }

    // Total Part and Part 
    if ($('#ddlRepaymentMethod option:selected').val() == "Part and part") {

        var pandpTot = parseInt($('#pTotalAmountRequired').text().replace(/[^0-9\.-]+/g, ""));
        var propVal = parseInt($('#tbPropertyValue').val().replace(/[^0-9\.-]+/g, ""));
        // Get LTV %
        var LTV = (pandpTot / propVal) * 100;
        
        if (pandpTot < minLoanVal | pandpTot > maxLoanVal | LTV > maxLTV) {
        valid = false;
            $('#pTotalAmountRequired').closest('.row').find('.error').show();
            $('#pTotalAmountRequired').closest('.row').addClass('rowError');
        }
    }

    return valid;
}

function checkNumberRange(tb, min, max) {

    var val = tb.val().replace(/,/g, '');
    var value = parseInt(val);
    var $pError = tb.closest('.row').find('.error');

    if (value >= min && value <= max) {
        $pError.hide();
        tb.closest('.row').removeClass('rowError');
        return true;
    }
    else {
        if ($pError.text().length) {
            $pError.show();
        }
        tb.closest('.row').addClass('rowError');
        return false;
    }

}

function checkLoanTermRange(tbYears, tbMonths) {

    var minYears = parseInt(tbYears.attr('data-min')) || 0;
    var maxYears = parseInt(tbYears.attr('data-max')) || 0;
    var minMonths = parseInt(tbMonths.attr('data-min')) || 0;
    var maxMonths = parseInt(tbMonths.attr('data-max')) || 0;
    var $row = tbYears.closest('.row');

    var years = parseInt(tbYears.val().replace(/,/g, '')) || 0;
    var months = parseInt(tbMonths.val().replace(/,/g, '')) || 0;

    var valid = true;

    if ((years == 0 && months == 0) || (years == maxYears && months > 0)) {
        valid = false;
    }
    else {
        if (years >= minYears && years <= maxYears && months >= minMonths && months <= maxMonths) {
            valid = true;
        }
        else {
            valid = false;
        }
    }

    if (valid) {
        $row.find('.error').hide();
        $row.removeClass('rowError');
        return true;
    } else {
        $row.find('.error').show();
        $row.addClass('rowError');
        return false;
    }
}

function createErrorMessage() {

    var errorText = "There are errors on the following questions:<br><br><ul style='margin-bottom: 0;'>";

    $('.rowError').each(function () {

        var title = '';

        if ($(this).hasClass('row')) {
            title = $(this).find('label:visible').first().html();
        }
        else {
            title = $(this).attr('data-title');
        }

        errorText += "<li>" + title + "</li>";
    });

    errorText += "</ul>";

    return errorText;
}


// ============================================================================== //
//                             Calculator Progress                                //
// ============================================================================== //

function calcProgress() {

    $('#btnContinue').click(function (e) {

        $('#pnlError').hide();

        // Hide all help messages when moving to new section
        $('.helpWrap').removeClass('active').find('img').attr('src', '/img/calc/tooltip.png');
        $('.helpMsg').hide();

        if (step == '1') {

            // ==================================== //
            //                Step 1                //
            // ==================================== //
            var purchaseRemortgage = "";
            if (step1Valid()) {
                if ($('#rbPurchase').is(':checked'))
                {
                    purchaseRemortgage = "Purchase";
               
                }
                if ($('#rbRemortgage').is(':checked'))
                {
                    purchaseRemortgage = "Remortgage";
               
                }
                // Create model
                var step1Model = {
                    "MonthlyRent": $('#tbMonthlyRent').val().replace(/,/g, ''),
                    "AnnualRent": $('#pAnnualRent').text().replace('£', '').replace(/,/g, ''),
                    "PropertyValue": $('#tbPropertyValue').val().replace(/,/g, ''),
                    //"ApplicationType": $('#ddlApplicationType option:selected').val(),
                    "ApplicationType": purchaseRemortgage,
                    "CurrentBalance": ($('#tbCurrentBalance').is(':visible') ? $('#tbCurrentBalance').val().replace(/,/g, '') : 0),
                    "CurrentBalanceSameOrLess": $('#rbCurrentBalanceSameOrLessYes').is(':checked'),
                    "Borrowing5YearFixed": $('#rbBorrowing5YearFixedYes').is(':checked'),
                    "RepaymentMethod": $('#ddlRepaymentMethod option:selected').val(),
                    "InterestOnlyAmount": $('#tbInterestOnlyAmount').val().replace(/,/g, ''),
                    "RepaymentAmount": $('#tbRepaymentAmount').val().replace(/,/g, ''),
                    "TotalAmountRequired": $('#pTotalAmountRequired').text().replace('£', '').replace(/,/g,''),
                    "TermYears": ($('#tbTermYears').is(':visible') ? parseInt($('#tbTermYears').val()) : 0),
                    "TermMonths": ($('#tbTermMonths').is(':visible') ? parseInt($('#tbTermMonths').val()) : 0),
                    "AgentManagingProperty": $('#rbAgentManagingPropertyYes').is(':checked'),
                    "MonthlyAgentsFees": ($('#tbMonthlyAgentsFees').is(':visible') ? $('#tbMonthlyAgentsFees').val().replace(/,/g, '') : 0),
                    "MonthlyAllowanceRentalVoids": $('#tbMonthlyAllowanceRentalVoids').val().replace(/,/g, ''),
                    "MonthlyPropertyMaintenance": $('#tbMonthlyPropertyMaintenance').val().replace(/,/g, ''),
                    "OtherMonthlyCosts": $('#tbOtherMonthlyCosts').val().replace(/,/g, ''),
                    "GroundRentServiceCharge": $('#tbGroundRentServiceCharge').val().replace(/,/g, ''),
                    "OtherMonthlyCommitmentsRent": $('#tbOtherMonthlyCommitmentsRent').val().replace(/,/g, ''),
                    "TaxBandRate": $('#ddlTaxBandRate option:selected').val().replace(/%/g,''),
                    "TaxBandRate2": $('#ddlTaxBandRate2 option:selected').val().replace(/%/g, '')
                }

                // Proceed to result
                $.ajax({
                    type: 'POST',
                    url: 'https://www.santanderforintermediaries.co.uk/umbraco/surface/BuyToLet/GetResult',
                    data: step1Model,
                    success: function (result) {

                        // Update progress icons
                        $('.step1').removeClass('active').addClass('complete');
                        $('.step2').addClass('active');

                        // Google Event Tracking
                        if (window._gaq) {
                            _gaq.push(['_setAccount', analyticsAccount], ['_trackEvent', 'Buy to Let Button: Continue', 'Clicked on: Step 1', 'Going to: Step 2']);
                        }

                        // Update view
                        $('#pnlStep2').html(result);
                        $('html, body').animate({ scrollTop: $('.calcNav').offset().top - 40 }, 'slow');
                        $('#pnlStep1').fadeOut();
                        $('#pnlStep2').fadeIn();
                        $('#btnIntroducer').removeClass('hide').show();
                        $('#btnPrint').removeClass('hide').show();
                        $('#btnContinue').hide();
                        $('#btnBack').removeClass('disabled');
                        $('.progress-buttons').removeClass('stageOne');
                        step = '2';
                        if (window.mouseflow) { mouseflow.newPageView('/step_' + step); }

                        //if ($('#ddlRepaymentMethod option:selected').val() == "Part and part")
                        //{
                        //    $('.resultSuccess').hide();
                        //}

                        // Google Page Tracking
                        if (window._gat) {
                            pageTracker._trackPageview('/calculators/buytolet/screen_2');
                        }

                        step2ChangeEvents();
                        resetTooltipsAndInputs($('#pnlStep2'));
                        customCheckBoxes($('#pnlStep2'));
                        sectionChangeScripts();
                    },
                    error: function (request, status, error) {
                        $('#pnlErrorGeneric').show();
                    }
                });
            }
            else {
                // step1Valid == false
                $('#pnlError').show();
                $('#litError').html(createErrorMessage());
            }
        }
        e.preventDefault();
    });

    // ================================================== //
    //                     Back button                    //
    // ================================================== //

    $('#btnBack').click(function (e) {

        if ($(this).hasClass('disabled')) return false;
        $('#pnlError').hide();
        $('#pnlErrorGeneric').hide();

        if (step == '2') {

            // ==================================== //
            //                Step 2                //
            // ==================================== //

            // Go back to step 1
            $('html, body').animate({ scrollTop: $('.calcNav').offset().top - 40 }, 'slow');
            $('#pnlStep2').fadeOut();
            $('#pnlStep1').fadeIn();
            $('#btnBack').addClass('disabled');
            $('.progress-buttons').addClass('stageOne');
            $('#btnIntroducer').hide();
            $('#btnPrint').hide();
            $('#btnDownloadPDF').hide();
            $('#btnContinue').show();
            step = '1';
            if (window.mouseflow) { mouseflow.newPageView('/step_' + step); }

            // Update progress icons
            $('.step2').removeClass('active');
            $('.step1').removeClass('complete').addClass('active');

            // Google Event Tracking
            if (window._gaq) {
                _gaq.push(['_setAccount', analyticsAccount], ['_trackEvent', 'Buy to Let Button: Back', 'Clicked on: Step 2', 'Going to: Step 1']);
            }

        }
        e.preventDefault();
    });

    // ================================================== //
    //                   Progress buttons                 //
    // ================================================== //

    $('.step-1').click(function (e) {

        if ($(this).parent().hasClass('complete')) {

            $('#pnlError').hide();
            $('#pnlErrorGeneric').hide();

            var $btn = $(this);

            // Update active screen

            var $pnlOut, $pnlIn;

            $('.calcStep').each(function () {
                if (step == $(this).attr('data-step')) {
                    $pnlOut = $(this);
                }
                if ($btn.attr('data-step') == $(this).attr('data-step')) {
                    $pnlIn = $(this);
                }
            });

            // Google Event Tracking
            if (window._gaq) {
                var gaTitle = $btn.attr('data-step') + ' - ' + $btn.find('span').html();
                _gaq.push(['_setAccount', analyticsAccount], ['_trackEvent', 'Buy to Let Button: ' + gaTitle, 'Clicked on: Step ' + step, 'Going to: Step ' + $btn.attr('data-step')]);
            }

            $pnlOut.fadeOut();
            $pnlIn.fadeIn();
            step = $btn.attr('data-step');
            if (window.mouseflow) { mouseflow.newPageView('/step_' + step); }

            // Update progress icons

            $btn.parent().removeClass('complete').addClass('active');

            $('.calcNav li').each(function () {

                var numStep = parseFloat(step);
                var numDataStep = parseFloat($(this).find('a').first().attr('data-step'));

                if (numDataStep > numStep) {
                    $(this).removeClass('active').removeClass('complete');
                }

            });

            // Show / hide buttons
            if (step == '1') {
                $('#btnBack').addClass('disabled');
                $('.progress-buttons').addClass('stageOne');
                $('#btnIntroducer').hide();
                $('#btnPrint').hide();
                $('#btnDownloadPDF').hide();
                $('#btnContinue').show();
            }
        }

        e.preventDefault();
    });

}
