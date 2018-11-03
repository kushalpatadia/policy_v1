"use strict";

var bChartReady = false;

var chartBarPayment;
var chartBarTotalPaid;
var chartBarLoanAmountInterest;
var chartLineBalance;
var chartLinePrincipal;
var chartLineCumulativePrincipal;
var chartLineInterest;
var chartLineCumulativeInterest;
var chartTableChart1;
var chartTableChart2;

var optionsBar = {
   height: 260,
   isStacked: false,
   legend: { position: "bottom" },
   chartArea: {width: '80%', height: '65%'},
   vAxis: {minValue:0, format: 'currency'},
};

var optionsBarStacked = {
   height: 260,
   isStacked: true,
   legend: { position: "bottom" },
   chartArea: {width: '80%', height: '65%'},
   vAxis: {minValue:0, format: 'currency'},
};

var optionsLinePrincipal = {
   height: 400,
   legend: { position: "bottom" },
   chartArea: {width: '70%', height: '70%'},
   pointSize: 0,
   hAxis: {minValue:0, title:"Time (Month)"},
   vAxis: {minValue:0, format: 'currency', title:"Principal (£)"},
};        

var optionsLineBalance = {
   height: 400,
   legend: { position: "bottom" },
   chartArea: {width: '70%', height: '70%'},
   pointSize: 0,
   hAxis: {minValue:0, title:"Time (Month)"},
   vAxis: {minValue:0, format: 'currency', title:"Balance (£)"},
};        

var optionsLineInterest = {
   height: 400,
   legend: { position: "bottom" },
   chartArea: {width: '70%', height: '70%'},
   pointSize: 0,
   hAxis: {minValue:0, title:"Time (Month)"},
   vAxis: {minValue:0, format: 'currency', title:"Interest (£)"},
};        

var optionsAmortization = {
   height: 300,
   width: '100%'
};        


var myTimeout;

updateCalculation();

$('input[type="number"]').change(function(){combineCalculationEvents();});
$('input[type="number"]').click(function(){combineCalculationEvents();});
$( window ).resize(function(){updateCalculation();});
$('input[type="number"]').keyup (function(){combineCalculationEvents();});

google.charts.load("current", {packages:['corechart', 'table']});
google.charts.setOnLoadCallback(appInit);

function combineCalculationEvents() {
    if(myTimeout){
        clearTimeout(myTimeout);
    }
    myTimeout = setTimeout(function(){updateCalculation();},25);
}

function appInit() {
       
    chartBarPayment              = new google.visualization.ColumnChart(document.getElementById("BarChartPayment"));
    chartBarTotalPaid            = new google.visualization.ColumnChart(document.getElementById("BarChartTotalPaid"));
    chartBarLoanAmountInterest   = new google.visualization.ColumnChart(document.getElementById("MyChart"));
    chartLineBalance             = new google.visualization.LineChart(document.getElementById("LineChartBalance"));
    chartLinePrincipal           = new google.visualization.LineChart(document.getElementById("LineChartPrincipal"));
    chartLineCumulativePrincipal = new google.visualization.LineChart(document.getElementById("LineChartCumulativePrincipal"));
    chartLineInterest            = new google.visualization.LineChart(document.getElementById("LineChartInterest"));
    chartLineCumulativeInterest  = new google.visualization.LineChart(document.getElementById("LineChartCumulativeInterest"));
    chartTableChart1             = new google.visualization.Table(document.getElementById("TableChart1"));
    chartTableChart2             = new google.visualization.Table(document.getElementById("TableChart2"));
    
    bChartReady = true;
    
    updateCalculation();
}

function loanMonthlyPayment(amount, rate, years)
{
    var months       = 12.0 * years;
    var rate_decimal = rate / 100.0 / 12.0;
    var result       = 0.0;
      
    if (rate == 0)
    {
      	result = amount / months;
    }
    else
    {
		  result = rate_decimal + rate_decimal / (Math.pow(1.0 + rate_decimal, months) - 1.0);
		  result = result * amount;
    }

	return result;
}

// Closure
(function() {
  /**
   * Decimal adjustment of a number.
   *
   * @param {String}  type  The type of adjustment.
   * @param {Number}  value The number.
   * @param {Integer} exp   The exponent (the 10 logarithm of the adjustment base).
   * @returns {Number} The adjusted value.
   */
  function decimalAdjust(type, value, exp) {
    // If the exp is undefined or zero...
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // If the value is not a number or the exp is not an integer...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return NaN;
    }
    // If the value is negative...
    if (value < 0) {
      return -decimalAdjust(type, -value, exp);
    }
    // Shift
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
  }

  // Decimal round
  if (!Math.round10) {
    Math.round10 = function(value, exp) {
      return decimalAdjust('round', value, exp);
    };
  }
  // Decimal floor
  if (!Math.floor10) {
    Math.floor10 = function(value, exp) {
      return decimalAdjust('floor', value, exp);
    };
  }
  // Decimal ceil
  if (!Math.ceil10) {
    Math.ceil10 = function(value, exp) {
      return decimalAdjust('ceil', value, exp);
    };
  }
})();

function round2(value) {
    return Math.round10(value, -2);
}

function toUSD(value) {
    return "£" + value.toFixed(2);
}

function updateCalculation(){

    var i = 0;

    var data;
    
	var nLoanAmount_1    = 0.0; 
	var nInterestRate_1  = 0.0; 
	var nTermYear_1      = 0.0;
	var nTermMonth_1     = 0.0;
		
	var nMonthlyPayment_1  = 0.0;
	var nTotalPayment_1    = 0.0;
	var nTotalInterest_1   = 0.0;

	var aMonthlyInterest_1   = [];
	var aMonthlyPrincipal_1  = [];
	var aLoanBalance_1       = [];
    var cumulativeInt_1      = [];
    var cumulativePri_1      = [];
            
	var nLoanAmount_2    = 0.0; 
	var nInterestRate_2  = 0.0; 
	var nTermYear_2      = 0.0;
	var nTermMonth_2     = 0.0;
		
	var nMonthlyPayment_2  = 0.0;
	var nTotalPayment_2    = 0.0;
	var nTotalInterest_2   = 0.0;

	var aMonthlyInterest_2   = [];
	var aMonthlyPrincipal_2  = [];
	var aLoanBalance_2       = [];
    var cumulativeInt_2      = [];
    var cumulativePri_2      = [];

	var aSolution            = [];
	var aGraph               = [];
	var aGraph2              = [];
	var aAmortizationTable   = [];
	var aAmortizationTable_2 = [];
    
	//loan 1 solution calculations-------------------------------------------
	//get the user inputs
	nLoanAmount_1   =  Number($("#tiLoanAmount_1")[0].value);
	nInterestRate_1 =  Number($("#tiInterestRate_1")[0].value);
	nTermYear_1     =  Number($("#nsTerm_1")[0].value);

	nTermMonth_1 =  12.0 * nTermYear_1; 

	// calculate the result
	nMonthlyPayment_1 = loanMonthlyPayment(nLoanAmount_1, nInterestRate_1, nTermYear_1);
	nTotalPayment_1   = nMonthlyPayment_1 * nTermMonth_1;
	nTotalInterest_1  = nTotalPayment_1 - nLoanAmount_1;
		
	//loan 2 solution calculations-------------------------------------------
	//get the user inputs
	nLoanAmount_2   =  Number($("#tiLoanAmount_2")[0].value);
	nInterestRate_2 =  Number($("#tiInterestRate_2")[0].value);
	nTermYear_2     =  Number($("#nsTerm_2")[0].value);

	nTermMonth_2 =  12.0 * nTermYear_2; 

	//calculate the result
	nMonthlyPayment_2 = loanMonthlyPayment(nLoanAmount_2, nInterestRate_2, nTermYear_2);
	nTotalPayment_2   = nMonthlyPayment_2 * nTermMonth_2;
	nTotalInterest_2  = nTotalPayment_2 - nLoanAmount_2;  
    
	//update solution array--------------------------------------------------
    $("#sTerm1").html(nTermMonth_1 + " months"); 
    $("#sTerm2").html(nTermMonth_2 + " months"); 
    if (nTermMonth_1  < nTermMonth_2){
		$("#sTerm12").html("Loan 1 shorter by " + Math.abs(nTermMonth_1 - nTermMonth_2) + " months");
    }
    else if (nTermMonth_1  > nTermMonth_2){
		$("#sTerm12").html("Loan 1 longer by " + Math.abs(nTermMonth_1 - nTermMonth_2) + " months");
    }
    else{
		$("#sTerm12").html("no difference");
    }    

    $("#sMP1").html("£" + nMonthlyPayment_1.toFixed(2));
    $("#sMP2").html("£" + nMonthlyPayment_2.toFixed(2));
    if (nMonthlyPayment_1 < nMonthlyPayment_2){
        $("#sMP12").html("Loan 1 lower by £" + (Math.abs(nMonthlyPayment_1 - nMonthlyPayment_2)).toFixed(2) + " per month");
    }
    else if (nMonthlyPayment_1 > nMonthlyPayment_2){
        $("#sMP12").html("Loan 1 higher by £" + (Math.abs(nMonthlyPayment_1 - nMonthlyPayment_2)).toFixed(2) + " per month");
    }
    else{
        $("#sMP12").html("no difference");
    }
    
    $("#sLoanAmount1").html("£" + nLoanAmount_1.toFixed(2));
    $("#sLoanAmount2").html("£" + nLoanAmount_2.toFixed(2));
    if (nLoanAmount_1 < nLoanAmount_2){
        $("#sLoanAmount12").html("Loan 1 lower by £" + Math.abs(nLoanAmount_1 - nLoanAmount_2).toFixed(2));
    }
    else if (nLoanAmount_1 > nLoanAmount_2){
        $("#sLoanAmount12").html("Loan 1 higher by £" + Math.abs(nLoanAmount_1 - nLoanAmount_2).toFixed(2));
    }
    else{
        $("#sLoanAmount12").html("no difference");
    }
    
    $("#sInterestPaid1").html("£" + nTotalInterest_1.toFixed(2));
    $("#sInterestPaid2").html("£" + nTotalInterest_2.toFixed(2));
    if (nTotalInterest_1 < nTotalInterest_2){
        $("#sInterestPaid12").html("Loan 1 lower by £" + Math.abs(nTotalInterest_1 - nTotalInterest_2).toFixed(2));
    }
    else if (nTotalInterest_1 > nTotalInterest_2){
        $("#sInterestPaid12").html("Loan 1 higher by £" + Math.abs(nTotalInterest_1 - nTotalInterest_2).toFixed(2));
    }
    else{
        $("#sInterestPaid12").html("no difference");
    }
    
    $("#sTotalPaid1").html("£" + nTotalPayment_1.toFixed(2));
    $("#sTotalPaid2").html("£" + nTotalPayment_2.toFixed(2));
    if (nTotalPayment_1 < nTotalPayment_2){
        $("#sTotalPaid12").html("Loan 1 lower by £" + Math.abs(nTotalPayment_1 - nTotalPayment_2).toFixed(2));
    }
    else if (nTotalPayment_1 > nTotalPayment_2){
        $("#sTotalPaid12").html("Loan 1 higher by £" + Math.abs(nTotalPayment_1 - nTotalPayment_2).toFixed(2));
    }
    else{
        $("#sTotalPaid12").html("no difference");
    }
    
    $("#sInterestRate1").html(nInterestRate_1 + "%");
    $("#sInterestRate2").html(nInterestRate_2 + "%");
    if (nInterestRate_1 < nInterestRate_2){
        $("#sInterestRate12").html("Loan 1 lower by " + Math.abs(nInterestRate_1 - nInterestRate_2) + "%");
    }
    else if (nInterestRate_1 > nInterestRate_2){
        $("#sInterestRate12").html("Loan 1 higher by " + Math.abs(nInterestRate_1 - nInterestRate_2) + "%");
    }
    else{
        $("#sInterestRate12").html("no difference");
    }
    
    if(bChartReady){

		//update graph for loan 1------------------------------------------------
		aLoanBalance_1[0]  = nLoanAmount_1;
        cumulativeInt_1[0] = 0;
        cumulativePri_1[0] = 0;

        aAmortizationTable[0] = {month : 0, monthlyPayment : "-----", monthlyInterest : "-----", monthlyPrincipal : "-----", loanBalance : "£" + nLoanAmount_1.toFixed(2)};

       	aGraph[0] = {month            : 0, 
       	             monthlyPayment   : null, 
       	             monthlyInterest  : null, 
       	             monthlyPrincipal : null, 
       	             loanBalance      : nLoanAmount_1,
                     cumulativeInt    : 0,
                     cumulativePri    : 0
                    };        

        for(i = 1; i <= nTermMonth_1; i++){		
        	aMonthlyInterest_1[i]  = nInterestRate_1 / 100.0 / 12.0 * aLoanBalance_1[i-1];
        	aMonthlyPrincipal_1[i] = nMonthlyPayment_1 - aMonthlyInterest_1[i];
        	aLoanBalance_1[i]      = aLoanBalance_1[i-1] - aMonthlyPrincipal_1[i]; 
            cumulativeInt_1[i]     = cumulativeInt_1[i-1] + aMonthlyInterest_1[i];
            cumulativePri_1[i]     = cumulativePri_1[i-1] + aMonthlyPrincipal_1[i];

        	if (aLoanBalance_1[i] < 0){
        		aLoanBalance_1[i] = 0;
        	}

            //formatted data for the table
        	aAmortizationTable[i] = {month            : i, 
        	                         monthlyPayment   : toUSD(nMonthlyPayment_1), 
        	                         monthlyInterest  : toUSD(aMonthlyInterest_1[i]), 
        	                         monthlyPrincipal : toUSD(aMonthlyPrincipal_1[i]), 
        	                         loanBalance      : toUSD(aLoanBalance_1[i])};

            //unformatted data for the graphs
        	aGraph[i] = {month            : i, 
        	             monthlyPayment   : nMonthlyPayment_1, 
        	             monthlyInterest  : aMonthlyInterest_1[i], 
        	             monthlyPrincipal : aMonthlyPrincipal_1[i], 
        	             loanBalance      : aLoanBalance_1[i],
                         cumulativeInt    : cumulativeInt_1[i],
                         cumulativePri    : cumulativePri_1[i]
                        };
        }

		//update graph for loan 2------------------------------------------------
		aLoanBalance_2[0]  = nLoanAmount_2;
        cumulativeInt_2[0] = 0;
        cumulativePri_2[0] = 0;

        aAmortizationTable_2[0] = {month : 0, monthlyPayment : "-----", monthlyInterest : "-----", monthlyPrincipal : "-----", loanBalance : "£" + nLoanAmount_2.toFixed(2)};

        aGraph2[0] = {month            : 0, 
       	              monthlyPayment   : null, 
       	              monthlyInterest  : null, 
       	              monthlyPrincipal : null, 
       	              loanBalance      : nLoanAmount_2,
                      cumulativeInt    : 0,
                      cumulativePri    : 0
                     };                

        for(i = 1; i <= nTermMonth_2; i++){ 		
        	aMonthlyInterest_2[i]  = nInterestRate_2 / 100.0 / 12.0 * aLoanBalance_2[i-1];
        	aMonthlyPrincipal_2[i] = nMonthlyPayment_2 - aMonthlyInterest_2[i];
        	aLoanBalance_2[i]      = aLoanBalance_2[i-1] - aMonthlyPrincipal_2[i]; 
            cumulativeInt_2[i]     = cumulativeInt_2[i-1] + aMonthlyInterest_2[i];
            cumulativePri_2[i]     = cumulativePri_2[i-1] + aMonthlyPrincipal_2[i];

        	if (aLoanBalance_2[i] < 0){
                aLoanBalance_2[i] = 0;
        	}

        	aAmortizationTable_2[i] = {month            : i, 
        	                           monthlyPayment   : toUSD(nMonthlyPayment_2), 
        	                           monthlyInterest  : toUSD(aMonthlyInterest_2[i]), 
        	                           monthlyPrincipal : toUSD(aMonthlyPrincipal_2[i]), 
        	                           loanBalance      : toUSD(aLoanBalance_2[i])};

        	aGraph2[i] = {month            : i, 
        	              monthlyPayment   : nMonthlyPayment_2, 
        	              monthlyInterest  : aMonthlyInterest_2[i], 
        	              monthlyPrincipal : aMonthlyPrincipal_2[i], 
        	              loanBalance      : aLoanBalance_2[i],
                          cumulativeInt    : cumulativeInt_2[i],
                          cumulativePri    : cumulativePri_2[i]
                         };
        }

        ////////Mothly Payment
        data = null;
        data = google.visualization.arrayToDataTable([
            ['Type'  , 'Monthly Payment', {role: 'annotation'}          ],
            ['Loan 1', round2(nMonthlyPayment_1), "£" + nMonthlyPayment_1.toFixed(2)],
            ['Loan 2', round2(nMonthlyPayment_2), "£" + nMonthlyPayment_2.toFixed(2)],
        ]);
        
        chartBarPayment.draw(data, optionsBar);
        
        ////////Total Paid
        data = null;
        data = google.visualization.arrayToDataTable([
            ['Type'  , 'Total Paid', {role: 'annotation'}          ],
            ['Loan 1', round2(nTotalPayment_1), "£" + nTotalPayment_1.toFixed(2)],
            ['Loan 2', round2(nTotalPayment_2), "£" + nTotalPayment_2.toFixed(2)],
        ]);
        
        chartBarTotalPaid.draw(data, optionsBar);

        ////////Total split principal interest
        data = null;
        data = google.visualization.arrayToDataTable([
            ['Type'  , 'Loan Amount', {role: 'annotation'}          , 'Total Interest', {role: 'annotation'}             ],
            ['Loan 1', round2(nLoanAmount_1), "£" + nLoanAmount_1.toFixed(2), round2(nTotalInterest_1), "£" + nTotalInterest_1.toFixed(2)],
            ['Loan 2', round2(nLoanAmount_2), "£" + nLoanAmount_2.toFixed(2), round2(nTotalInterest_2), "£" + nTotalInterest_2.toFixed(2)],
        ]);
        
        chartBarLoanAmountInterest.draw(data, optionsBarStacked);
        
        ////////Line Balance
        data = null;
        data = google.visualization.arrayToDataTable([[ 
            {label: 'Month', type: 'number'},
            {label: 'Loan 1', type: 'number'},
            {label: 'Loan 2', type: 'number'} 
        ]]);
        
        for (i=0; i<aGraph.length && i<aGraph2.length; i++){
            data.addRow([aGraph[i].month, round2(aGraph[i].loanBalance), round2(aGraph2[i].loanBalance)]);
        }
        while(i<aGraph.length){
            data.addRow([aGraph[i].month, round2(aGraph[i].loanBalance), null]);
            i++;
        }
        while(i<aGraph2.length){
            data.addRow([aGraph2[i].month, null, round2(aGraph2[i].loanBalance)]);
            i++;
        }

        chartLineBalance.draw(data, optionsLineBalance);

        ////////Line Principal
        data = null;
        data = google.visualization.arrayToDataTable([[ 
            {label: 'Month', type: 'number'},
            {label: 'Loan 1', type: 'number'},
            {label: 'Loan 2', type: 'number'} 
        ]]);
        
        for (i=1; i<aGraph.length && i<aGraph2.length; i++){
            data.addRow([aGraph[i].month, round2(aGraph[i].monthlyPrincipal), round2(aGraph2[i].monthlyPrincipal)]);
        }
        while(i<aGraph.length){
            data.addRow([aGraph[i].month, round2(aGraph[i].monthlyPrincipal), null]);
            i++;
        }
        while(i<aGraph2.length){
            data.addRow([aGraph2[i].month, null, round2(aGraph2[i].monthlyPrincipal)]);
            i++;
        }

        chartLinePrincipal.draw(data, optionsLinePrincipal);

        ////////Line Cumulative Principal
        data = null;
        data = google.visualization.arrayToDataTable([[ 
            {label: 'Month', type: 'number'},
            {label: 'Loan 1', type: 'number'},
            {label: 'Loan 2', type: 'number'} 
        ]]);
        
        for (i=1; i<aGraph.length && i<aGraph2.length; i++){
            data.addRow([aGraph[i].month, round2(aGraph[i].cumulativePri), round2(aGraph2[i].cumulativePri)]);
        }
        while(i<aGraph.length){
            data.addRow([aGraph[i].month, round2(aGraph[i].cumulativePri), null]);
            i++;
        }
        while(i<aGraph2.length){
            data.addRow([aGraph2[i].month, null, round2(aGraph2[i].cumulativePri)]);
            i++;
        }

        chartLineCumulativePrincipal.draw(data, optionsLinePrincipal);

        ////////Line Interest
        data = null;
        data = google.visualization.arrayToDataTable([[ 
            {label: 'Month', type: 'number'},
            {label: 'Loan 1', type: 'number'},
            {label: 'Loan 2', type: 'number'} 
        ]]);
        
        for (i=1; i<aGraph.length && i<aGraph2.length; i++){
            data.addRow([aGraph[i].month, round2(aGraph[i].monthlyInterest), round2(aGraph2[i].monthlyInterest)]);
        }
        while(i<aGraph.length){
            data.addRow([aGraph[i].month, round2(aGraph[i].monthlyInterest), null]);
            i++;
        }
        while(i<aGraph2.length){
            data.addRow([aGraph2[i].month, null, round2(aGraph2[i].monthlyInterest)]);
            i++;
        }

        chartLineInterest.draw(data, optionsLineInterest);

        ////////Line Cumulative Interest
        data = null;
        data = google.visualization.arrayToDataTable([[ 
            {label: 'Month', type: 'number'},
            {label: 'Loan 1', type: 'number'},
            {label: 'Loan 2', type: 'number'} 
        ]]);
        
        for (i=1; i<aGraph.length && i<aGraph2.length; i++){
            data.addRow([aGraph[i].month, round2(aGraph[i].cumulativeInt), round2(aGraph2[i].cumulativeInt)]);
        }
        while(i<aGraph.length){
            data.addRow([aGraph[i].month, round2(aGraph[i].cumulativeInt), null]);
            i++;
        }
        while(i<aGraph2.length){
            data.addRow([aGraph2[i].month, null, round2(aGraph2[i].cumulativeInt)]);
            i++;
        }

        chartLineCumulativeInterest.draw(data, optionsLineInterest);

        ////////Table Loan 1
        data = null;
        data = google.visualization.arrayToDataTable([[ 
            {label: 'Month', type: 'number'},
            {label: 'Payment', type: 'string'},
            {label: 'Interest', type: 'string'},
            {label: 'Principal', type: 'string'},
            {label: 'Balance', type: 'string'} 
        ]]);
        
        for (i=0; i<aAmortizationTable.length; i++){
            data.addRow([aAmortizationTable[i].month, 
                         aAmortizationTable[i].monthlyPayment, 
                         aAmortizationTable[i].monthlyInterest,
                         aAmortizationTable[i].monthlyPrincipal,
                         aAmortizationTable[i].loanBalance
                        ]);
        }

        chartTableChart1.draw(data, optionsAmortization);
        
        ////////Table Loan 2
        data = null;
        data = google.visualization.arrayToDataTable([[ 
            {label: 'Month', type: 'number'},
            {label: 'Payment', type: 'string'},
            {label: 'Interest', type: 'string'},
            {label: 'Principal', type: 'string'},
            {label: 'Balance', type: 'string'} 
        ]]);
        
        for (i=0; i<aAmortizationTable_2.length; i++){
            data.addRow([aAmortizationTable_2[i].month, 
                         aAmortizationTable_2[i].monthlyPayment, 
                         aAmortizationTable_2[i].monthlyInterest,
                         aAmortizationTable_2[i].monthlyPrincipal,
                         aAmortizationTable_2[i].loanBalance
                        ]);
        }

        chartTableChart2.draw(data, optionsAmortization);
        
    }
    
    
}


if(window.innerWidth > 1300){
    var el2 = document.createElement("script");
    el2.src = "//s7.addthis.com/js/300/addthis_widget.js#pubid=jeraymon";
    el2.async = true;
    document.body.appendChild(el2);
}
