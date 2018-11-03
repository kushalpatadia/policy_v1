<!DOCTYPE html>

<html class="wide wow-animation" lang="en">

<head>
  <title>Specialist Contractor Mortgage Broker | Fee Free Contractor Mortgage Advice</title>

  <meta name="description" content="Contractor Mortgages by name and by nature, we help Contractors secure the best deal for mortgages and protection, with High Street lenders at low interest rates" />
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <link rel="icon" href="<?php echo $this->config->item('base_url')?>images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:100,300,300i,400,700,900">
  <link rel="stylesheet" href="<?=$this->config->item('css_path')?>front/bootstrap.css">
  <link rel="stylesheet" href="<?=$this->config->item('css_path')?>front/fonts.css">
  <link rel="stylesheet" href="<?=$this->config->item('css_path')?>front/style.css" id="main-styles-link">
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="<?php echo $this->config->item('base_url')?>images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
  <![endif]-->
  <style type="text/css">
  .lender-img img{ border:1px solid #1d0d44;width: 327px;    height: 260px;}
  .lender-img{  padding: 0 90px;}
  .limg img{ border:0px solid #1d0d44;width: 150px; margin-right:5px;
    height: auto;
    float: left;}
    .quote-large .quote-meta.limg{width:100% !important;max-width:100% !important; padding-right:0px !important;}
  .row{margin-left:0; margin-right:0;}  .cs article{padding:10px;}</style>
  <script type="text/javascript">
    function loanCalc(){
      var inputVal= document.getElementById('inputVal').value;
      var outputVal=inputVal*5*46*5;
      document.getElementById('outputVal').value=outputVal.toLocaleString();
    }
    function SubscriptFormSubmit(){
      var nameVal= document.getElementById('subscribe-form-0-sname').value;
      if(nameVal==""){
        alert("Please Enter your Name");
        return false;
      }
      var emailVal= document.getElementById('subscribe-form-0-email').value;
      if(emailVal==""){
        alert("Please Enter your Email");
        return false;
      }
      var privacyVal= document.getElementById('subscribe-form-0-privacyp');
      if(privacyVal.checked == false){
        alert("Please accept privacy policy");
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
<header class="section page-header">
  <div class="rd-navbar-wrap rd-navbar-absolute">
    <nav class="rd-navbar rd-navbar-transparent" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="20px" data-xl-stick-up-offset="20px" data-xxl-stick-up-offset="20px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
      <div class="rd-navbar-main-outer">
        <div class="rd-navbar-main">
          <div class="rd-navbar-panel">
            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
            <div class="rd-navbar-brand"><a class="brand" href="<?php echo $this->config->item('base_url')?>"><img class="brand-logo-dark" src="<?php echo $this->config->item('base_url')?>images/logo.jpg" alt="" width="240" height="66"/><img class="brand-logo-light" src="<?php echo $this->config->item('base_url')?>images/logo.jpg" alt="" width="240" height="66"/></a>
            </div>
          </div>
          <div class="rd-navbar-main-element">
            <div class="rd-navbar-nav-wrap">
              <ul class="rd-navbar-nav">
                <li class="rd-nav-item active"><a class="rd-nav-link" href="index.html">Home</a></li>
                <li class="rd-nav-item"><a class="rd-nav-link" href="index.html#aboutPage">About Us</a> </li>
                <li class="rd-nav-item"><a class="rd-nav-link" href="index.html#whyChooseUSPage">Why Choose Us</a> </li>
                <li class="rd-nav-item"><a class="rd-nav-link" href="#">Mortgages For Contractors</a> 
                  <ul class="rd-menu rd-navbar-dropdown">
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="index.html#faqpage">Mortgage FAQ's</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="First-Time-Buyer.html">First Time Buyer</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Next-Time-Buyer.html">Next Time Buyer</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Home-Mover.html">Home Mover</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Re-Mortgage.html">Re-mortgage</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Buy-to-Let.html">Buy to Let</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Help-to-Buy.html">Help to Buy</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Self-Employed-Mortgages.html">Self Employed Mortgages</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Mortgage-Types.html">Mortgage Types</a></li>
                  </ul>
                </li>
                <li class="rd-nav-item"><a class="rd-nav-link" href="#">Calculators</a>
                  <ul class="rd-menu rd-navbar-dropdown">
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="index.html#hmicbPage">How much can I borrow?</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Mortgage-Repayment-Calculator.html">What will my Repayments be?</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Stamp-Duty-Calculator.html">Stamp Duty Calculator</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Buy-To-Let-Calculator.html">Buy to Let Calculator</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Life-Insurance-Calculator.html">Life Insurance Calculator</a></li>
                  </ul>
                </li>
                <li class="rd-nav-item"><a class="rd-nav-link" href="#">Protection</a>
                  <ul class="rd-menu rd-navbar-dropdown">
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Contractor-Protection.html">Do I need Protecton and what is this?</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Life-Insurance.html">Life Insurance for family</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Mortgage-Protection.html">Mortgage Protection</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Income-Protection.html">Income Protection</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Critical-Illness-Insurance.html">Critical Illness Insurance</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Contractor-Relevant-Life-Insurance.html">Contractor Relevant Life Insurance</a></li>
                    <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="Family-Income-Benefit.html">Family Income Benefit</a></li>
                  </ul>
                </li>
                <li class="rd-nav-item"><a class="rd-nav-link" onclick="enquiryForm();" href="javascript:void(0);">Contact Us</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</header>