<style type="text/css">
h6, .heading-6 {
  font-size: 18px;
  line-height: 1.5;
  }select{margin-bottom:5px;}
</style>
<section class="section">
  <div class="row row-flex no-gutters">
    <div class="" style="width:100%;">
      <div class="section-lg" style="width:100%; text-align:center;">
        <div class="container-custom">                
          <div class="group-md group-middle social-items"><a class="icon icon-md icon-gray-400 novi-icon mdi mdi-facebook" href="#"></a><a class="icon icon-md icon-gray-400 novi-icon mdi mdi-twitter" href="#"></a><a class="icon icon-md icon-gray-400 novi-icon mdi mdi-instagram" href="#"></a><a class="icon icon-md icon-gray-400 novi-icon mdi mdi-facebook-messenger" href="#"></a><a class="icon icon-md icon-gray-400 novi-icon mdi mdi-linkedin" href="#"></a><a class="icon icon-md icon-gray-400 novi-icon mdi mdi-snapchat" href="#"></a></div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="section section-sm bg-primary-gradient context-dark text-center">             
  <p>THINK CAREFULLY BEFORE SECURING OTHER DEBTS AGAINST YOUR HOME.  <br/>
    YOUR HOME MAY BE REPOSSESSED IF YOU DO NOT KEEP UP REPAYMENTS ON YOUR MORTGAGE OR ANY OTHER DEBT SECURED ON IT<br/><br/>
    We do not charge a fee for residential mortgage advice. We may charge an administrative fee for processing each of your mortgage contracts; our fees only apply when you decide to go ahead with an application, your broker will inform you of the fee before you decide to proceed after the advice stage
  </p>
</div>
<div class="black_overlay" id="backgroundEF" style="display:none;"></div>
<div id="enqiury_form" style="display:none;" class="modal modal-contact in">
 <div class="modal-dialogg">
  <div class="formlogo">
    <img class="brand-logo-dark" src="<?php echo $this->config->item('base_url')?>images/logo.jpg" alt="" width="240" height="66"/>
    <button data-dismiss="modal" class="close modal-close" onClick="closeMWindow()"><span aria-hidden="true" class="text-colour-base">×</span></button>
  </div>

  <div class="model-content bg-primary-gradient">
   <form class="rd-form rd-mailform adisnal" name="frm_contact_us" id="frm_contact_us" data-form-output="form-output-global" data-form-type="adisnal" method="post" action="<?php echo site_url('submitContactus/');?>">
    <div class="eftt">
      <div class="quote-heading">Get a FREE Quote</div>
      <div>Call us on</div>
      <div><strong>01923 927361</strong></div>
      <div>Speak to one of our Experts</div>
      <div>alternatively</div>
      <div>Request a Call Back</div>
    </div>
    <div class="eForm">
      <div class="form-wrap">
        <!-- <input class="form-input" id="adisnal-name" type="text" name="name" data-constraints="@Required"> -->
        <input class="form-input" id="adisnal-name" type="text" name="name" required>
        <label class="form-label" for="adisnal-name">Name</label>
      </div>
      <div class="form-wrap">
        <input class="form-input" id="adisnal-telephone" type="number" name="telephone" data-constraints="@Required">
        <label class="form-label" for="adisnal-telephone">Telephone Number</label>
      </div>
      <div class="form-wrap">
        <input class="form-input" id="adisnal-email" type="email" name="email" data-constraints="@Required">
        <label class="form-label" for="adisnal-email">E-mail</label>
      </div>
      <div class="form-wrap" >
        <label>Choose a time to call</label>
        <select name="call_time" id="adisnal-choosetime" class="form-control" >
         <option value="">Select Option</option>                   
         <option value="Anytime">Anytime</option>
         <option value="Today 09:00 - 12:00">Today 09:00 - 12:00</option>
         <option value="Today 12:00 - 15:00">Today 12:00 - 15:00</option>
         <option value="Today 15:00 - 18:00">Today 15:00 - 18:00</option>
         <option value="Tomorrow 09:00 - 12:00">Tomorrow 09:00 - 12:00</option>
         <option value="Tomorrow 12:00 - 15:00">Tomorrow 12:00 - 15:00</option>
         <option value="Tomorrow 15:00 - 18:00">Tomorrow 15:00 - 18:00</option>
       </select>
     </div><br/>
     <div style="text-align:center;"><input class="button button-primary" type="submit" value="Call Me Back"></div>              
     <p style="margin:10px; text-align:center;">It would help us to be prepared if you could submit the following information also</p>
     <h6 style=" text-decoration:underline;">Additional Details</h6>
     <div class="eForm">

      <div class="form-wrap">
        <label>Enquiry Type</label>
        <select name="etype" id="adisnal-etype" class="form-control" onChange="etypeChnage();" >
         <option value="">Select Option </option>
         <option value="First Time Buyer">First Time Buyer</option>
         <option value="Next Time Buyer">Next Time Buyer</option>
         <option value="Home-mover">Home-mover</option>
         <option value="Help to Buy">Help to Buy</option>
         <option value="Re-mortgage">Re-mortgage</option>
         <option value="Buy To Let">Buy To Let</option>
         <option value="Life Insurance">Life Insurance</option>
         <option value="Mortgage Protection">Mortgage Protection</option>
         <option value="Income Protection">Income Protection</option>
         <option value="RLP">RLP</option>
         <option value="Family Income Benefit">Family Income Benefit</option>
       </select>
     </div>
     <div style="display:none;" id="protectionFields">
       <div class="form-wrap">
        <label>Type of cover</label>
        <select name="covertype" id="adisnal-covertype" class="form-control">
          <option value="">Select Option </option>
          <option value="Level Term">Level Term </option>
          <option value="Increasing">Increasing</option>
          <option value="Decreasing">Decreasing</option>
        </select>
      </div>
      <div class="form-wrap">
        <label>With Critical Illness</label>
        <select name="criticali" id="adisnal-criticali" class="form-control">
          <option value="">Select Option</option>
          <option value="y">Yes</option>
          <option value="n">No</option>
        </select>
      </div>
      <div class="form-wrap">
        <label>Premium</label>
        <select name="premium" id="adisnal-premium" class="form-control">
          <option value="">Select Option</option>
          <option value="Guaranteed">Guaranteed</option>
          <option value="Reviewable">Reviewable</option>
        </select>
      </div>
      <div class="form-wrap">
        <label>Amount of cover required</label>
        <input class="form-input" id="adisnal-coveramount" type="number" name="coveramount" >
        <label class="form-label poundsymbol" for="inputVal">£</label>
      </div>
      <div class="form-wrap">
        <label>number of years</label>
        <input class="form-input" id="adisnal-noofyears" type="number" name="noofyears" >
      </div>
      <div class="form-wrap">
        <label>Budget</label>
        <input class="form-input" id="adisnal-budget" type="number" name="budget" >
        <label class="form-label poundsymbol" for="inputVal">£</label>
      </div>
    </div> 
    <div style="display:none;" id="otherprotectionFields">
      <div class="form-wrap">
        <label>Contract Rate</label>
        <input class="form-input" id="adisnal-crate" type="number" name="crate" >
        <label class="form-label poundsymbol" for="inputVal">£</label>
        <br/>
        <select name="cratetype" id="adisnal-cratetype" class="form-control" >
          <option value="">Select Option</option>
          <option value="Per Day">Per Day</option>
          <option value="Per Hour">Per Hour</option>
        </select>
      </div>  

      <div class="form-wrap">
       <label><strong>Length of Time Contracting</strong></label>
       <select name="clength" id="adisnal-clength" class="form-control">
        <option value="">Select Option</option>                        
        <option value="1 Month">1 Month</option>
        <option value="2 Months">2 Months</option>
        <option value="3 Months">3 Months</option>
        <option value="4 Months">4 Months</option>
        <option value="5 Months">5 Months</option>
        <option value="6 Months">6 Months</option>
        <option value="7 Months">7 Months</option>

        <option value="8 Months">8 Months</option>
        <option value="9 Months">9 Months</option>
        <option value="10 Months">10 Months</option>
        <option value="11 Months">11 Months</option>
        <option value="12 Months">12 Months</option>
        <option value="13 Months">13 Months</option>
        <option value="14 Months">14 Months</option>
        <option value="15 Months">15 Months</option>
        <option value="16 Months">16 Months</option>
        <option value="17 Months">17 Months</option>
        <option value="18 Months">18 Months</option>
        <option value="19 Months">19 Months</option>
        <option value="20 Months">20 Months</option>
        <option value="21 Months">21 Months</option>
        <option value="22 Months">22 Months</option>
        <option value="23 Months">23 Months</option>
        <option value="24 Months">24 Months</option>
        <option value="25 Months">25 Months</option>
        <option value="26 Months">26 Months</option>
        <option value="27 Months">27 Months</option>
        <option value="28 Months">28 Months</option>
        <option value="29 Months">29 Months</option>
        <option value="30 Months">30 Months</option>
        <option value="31 Months">31 Months</option>
        <option value="32 Months">32 Months</option>
        <option value="33 Months">33 Months</option>
        <option value="34 Months">34 Months</option>
        <option value="35 Months">35 Months</option>
        <option value="36 Months">36 Months</option>
        <option value="37 Months">37 Months</option>
        <option value="38 Months">38 Months</option>
        <option value="39 Months">39 Months</option>
        <option value="40 Months">40 Months</option>
        <option value="41 Months">41 Months</option>
        <option value="42 Months">42 Months</option>
        <option value="43 Months">43 Months</option>
        <option value="44 Months">44 Months</option>
        <option value="45 Months">45 Months</option>
        <option value="46 Months">46 Months</option>
        <option value="47 Months">47 Months</option>
        <option value="48 Months">48 Months</option>
        <option value="49 Months">49 Months</option>
        <option value="50 Months">50 Months</option>
        <option value="51 Months">51 Months</option>
        <option value="52 Months">52 Months</option>
        <option value="53 Months">53 Months</option>
        <option value="54 Months">54 Months</option>
        <option value="55 Months">55 Months</option>
        <option value="56 Months">56 Months</option>
        <option value="57 Months">57 Months</option>
        <option value="58 Months">58 Months</option>
        <option value="59 Months">59 Months</option>
        <option value="60 Months">60 Months</option>
        <option value="Longer">Longer</option>
      </select>
    </div>          
    <div class="form-wrap">

      <label><strong>Any Gaps in last 12 months? </strong></label>
      <select name="gapsinOneYear" id="adisnal-gapsinOneYear" class="form-control" onChange="vaCheck('gapsinOneYear');" >
        <option value="">Select Option</option>                    	
        <option value="y">Yes</option>
        <option value="n">No</option>
      </select>
    </div>
    <div id="gapsinOneYear-div" style="display:none;">
     <label>How Long and When</label>
     <input class="form-input" id="adisnal-howlong" type="text" name="howlong" >
   </div>
   <div class="form-wrap">
    <label>Time Left in Current Contract</label>
    <select name="TimeLeft" id="adisnal-TimeLeft" class="form-control">
     <option value="">Select Option</option>   
     <option value="1 Month">1 Month</option>
     <option value="2 Months">2 Months</option>
     <option value="3 Months">3 Months</option>
     <option value="4 Months">4 Months</option>
     <option value="5 Months">5 Months</option>
     <option value="6 Months">6 Months</option>
     <option value="7 Months">7 Months</option>
     <option value="8 Months">8 Months</option>
     <option value="9 Months">9 Months</option>
     <option value="10 Months">10 Months</option>
     <option value="11 Months">11 Months</option>
     <option value="12 Months">12 Months</option>
     <option value="13 Months">13 Months</option>
     <option value="14 Months">14 Months</option>
     <option value="15 Months">15 Months</option>
     <option value="16 Months">16 Months</option>
     <option value="17 Months">17 Months</option>
     <option value="18 Months">18 Months</option>
     <option value="19 Months">19 Months</option>
     <option value="20 Months">20 Months</option>
     <option value="21 Months">21 Months</option>
     <option value="22 Months">22 Months</option>
     <option value="23 Months">23 Months</option>
     <option value="24 Months">24 Months</option>
     <option value="25 Months">25 Months</option>
     <option value="26 Months">26 Months</option>
     <option value="27 Months">27 Months</option>
     <option value="28 Months">28 Months</option>
     <option value="29 Months">29 Months</option>
     <option value="30 Months">30 Months</option>
     <option value="31 Months">31 Months</option>
     <option value="32 Months">32 Months</option>
     <option value="33 Months">33 Months</option>
     <option value="34 Months">34 Months</option>
     <option value="35 Months">35 Months</option>
     <option value="36 Months">36 Months</option>
     <option value="37 Months">37 Months</option>
     <option value="38 Months">38 Months</option>
     <option value="39 Months">39 Months</option>
     <option value="40 Months">40 Months</option>
     <option value="41 Months">41 Months</option>
     <option value="42 Months">42 Months</option>
     <option value="43 Months">43 Months</option>
     <option value="44 Months">44 Months</option>
     <option value="45 Months">45 Months</option>
     <option value="46 Months">46 Months</option>
     <option value="47 Months">47 Months</option>
     <option value="48 Months">48 Months</option>
     <option value="49 Months">49 Months</option>
     <option value="50 Months">50 Months</option>
     <option value="51 Months">51 Months</option>
     <option value="52 Months">52 Months</option>
     <option value="53 Months">53 Months</option>
     <option value="54 Months">54 Months</option>
     <option value="55 Months">55 Months</option>
     <option value="56 Months">56 Months</option>
     <option value="57 Months">57 Months</option>
     <option value="58 Months">58 Months</option>
     <option value="59 Months">59 Months</option>
     <option value="60 Months">60 Months</option>
   </select>
 </div>
 <div class="form-wrap">
   <label>What industry do you work in?</label>
   <input class="form-input" id="adisnal-industryworked" type="text" name="industryworked" >
 </div>
 <div class="form-wrap">
  <label>Contracting through</label>
  <select name="cThrough" id="adisnal-cThrough" class="form-control" >
   <option value="">Select Option</option>
   <option value="Limited Company">Limited Company</option>
   <option value="Umbrella">Umbrella</option>
   <option value="Other">Other</option>
 </select>
</div>
<div class="form-wrap">
 <label id="ppvaltext">Purchase Price</label>
 <input class="form-input" id="adisnal-pprice" type="number" name="pprice" >
 <label class="form-label poundsymbol" for="inputVal">£</label>
</div>

<div class="form-wrap">
 <label>Loan Amount</label>
 <input class="form-input" id="adisnal-loanamount" type="number" name="loanamount" >
 <label class="form-label poundsymbol" for="inputVal">£</label>
</div>
<div id="remorDiv" style="display:none">
  <div class="form-wrap">
   <label>Current Lender</label>
   <input class="form-input" id="adisnal-clender" type="text" name="clender" >
 </div>
 <div class="form-wrap">
   <label>Outstanding Balance</label>
   <input class="form-input" id="adisnal-outsbal" type="number" name="outsbal" >
   <label class="form-label poundsymbol" for="inputVal">£</label>
 </div>
</div>
<div class="form-wrap" id="rentAcble">
 <label>Rent Acheivable</label>
 <input class="form-input" id="adisnal-rentAbl" type="number" name="rentAcble" >
 <label class="form-label poundsymbol" for="inputVal">£</label>
 <label class="form-label poundsymbol" for="inputVal">£</label>
</div>

<div class="form-wrap">
  <label><strong>Term of mortgage you would prefer?</strong></label>
  <select name="term_of_mortage" id="adisnal-hLongIRF" class="form-control" >
   <option value="">Select Option</option>             
   <option value="1">1 Year</option>
   <option value="2">2 Years</option>
   <option value="3">3 Years</option>
   <option value="4">4 Years</option>
   <option value="5">5 Years</option>
   <option value="6">6 Years</option>
   <option value="7">7 Years</option>
   <option value="8">8 Years</option>
   <option value="9">9 Years</option>
   <option value="10">10 Years</option>
   <option value="11">11 Years</option>
   <option value="12">12 Years</option>
   <option value="13">13 Years</option>
   <option value="14">14 Years</option>
   <option value="15">15 Years</option>
   <option value="16">16 Years</option>
   <option value="17">17 Years</option>
   <option value="18">18 Years</option>
   <option value="19">19 Years</option>
   <option value="20">20 Years</option>
   <option value="21">21 Year</option>
   <option value="22">22 Years</option>
   <option value="23">23 Years</option>
   <option value="24">24 Years</option>
   <option value="25">25 Years</option>
   <option value="26">26 Years</option>
   <option value="27">27 Years</option>
   <option value="28">28 Years</option>
   <option value="29">29 Years</option>
   <option value="30">30 Years</option>
   <option value="31">31 Year</option>
   <option value="32">32 Years</option>
   <option value="33">33 Years</option>
   <option value="34">34 Years</option>
   <option value="35">35 Years</option>
   <option value="36">36 Years</option>
   <option value="37">37 Years</option>
   <option value="38">38 Years</option>
   <option value="39">39 Years</option>
   <option value="40">40 Years</option>
 </select>
</div>
<div class="form-wrap">
  <label>Credit Rating</label>
  <select name="credit_rating" id="adisnal-creditHistory" class="form-control" onChange="crCheck();" >
    <option value="">Select Option</option>
    <option value="Excellent">Excellent</option>
    <option value="Good">Good</option>
    <option value="Poor">Poor</option>
  </select>
</div>
<div id="cr-div"  style="display:none;">
 <div class="form-wrap">
  <label>Why Poor Credit?</label>
  <textarea class="form-input" id="adisnal-whyPoor" name="whyPoor"></textarea>
</div>
</div>
<div class="form-wrap">
  <label>Visited another broker?</label>
  <select name="va-broker" id="adisnal-va-broker" class="form-control" onChange="vaCheck('va-broker');" >
    <option value="">Select Option</option>
    <option value="y">Yes</option>
    <option value="n">No</option>
  </select>
</div>
<div id="va-broker-div"  style="display:none;">
 <div class="form-wrap">
   <label>Why did you not proceed?</label>

   <textarea class="form-input" id="adisnal-abReason" name="visited_broker_reason"></textarea>
 </div>
</div>
<div class="form-wrap">
  <label>What are you hoping for from us?</label>
  <textarea class="form-input" id="adisnal-hopingFromUs" name="hopingFromUs"></textarea>
</div>
<div class="form-wrap">
  <label>Would you like a Fixed / Tracker mortgage?</label>
  <select name="mortage_type" id="adisnal-ForTM" class="form-control" >
    <option value="">Select Option</option>
    <option value="Fixed">Fixed</option>
    <option value="Tracker">Tracker</option>
  </select>
</div>
<div class="form-wrap">
  <label>How long do you want the initial rate to be fixed?</label>
  <select name="inirateFixed" id="adisnal-inirateFixed" class="form-control" >
    <option value="">Select Option</option>
    <option value="0">0 Year</option>
    <option value="2">2 Years</option>
    <option value="3">3 Years</option>
    <option value="5">5 Years</option>
    <option value="10">10 Years</option>
  </select>
</div>
<div class="form-wrap">
 <label><strong>What Features are important to you?</strong> </label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="Offset your savings against the Mortgage?" name="impFeatures[]">Offset your savings against the Mortgage?</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="No ERC overhang after the initial period" name="impFeatures[]">No ERC overhang after the initial period</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="No Early Repayment Charge" name="impFeatures[]">No Early Repayment Charge</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="Ability to Overpay" name="impFeatures[]">Ability to Overpay</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="Ability to Underpay" name="impFeatures[]">Ability to Underpay</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="Take repayment holidays" name="impFeatures[]">Take repayment holidays</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="Free legal’s" name="impFeatures[]">Free legal’s</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="Free Valuation" name="impFeatures[]">Free Valuation</label>
</div>
</div>

<div class="form-wrap"> 
  <label>Comments</label>
  <textarea class="form-input" id="adisnal-commentFinal" name="comment"></textarea>
</div>                 
<div class="form-wrap">
  <div class="checkbox">
    <div style="text-align:center; margin-top:10px;"><button class="button button-primary" type="submit">Call Me Back</button></div>
  </div>
</div>
</div></div>
</form> 
</div> 
</div></div>
<footer class="section footer-1">
  <div class="container">
    <p class="rights">
      Authorised and regulated by the Financial Conduct Authority FCA reg. 788950.<br/>
      Contractor Mortgages Direct is a trading name of MortgageTek Limited. Registered in England, No 09261635, Iveco House, Station Road, Watford, WD17 1ET<br/>
      The FCA does not regulate most Buy to Let mortgages.
      <br/><br/>
      <span>&copy;&nbsp; </span><span class="copyright-year"></span><span>&nbsp;</span><span>All rights reserved</span><span>.&nbsp;</span><a href="privacy-policy.html">Privacy Policy</a></p>
    </div>
  </footer>
  <script type="text/javascript">
   function enquiryForm(){ 
    document.getElementById('enqiury_form').style.display="block";	
    document.getElementById('backgroundEF').style.display="block";			 
  }
  function closeMWindow(){
    document.getElementById('enqiury_form').style.display="none";	
    document.getElementById('backgroundEF').style.display="none";			 
  } 
  function etypeChnage(){
   document.getElementById('rentAcble').style.display="none";
   document.getElementById('remorDiv').style.display="none";
   document.getElementById('ppvaltext').innerHTML="Purchase Price";
   var etypeVal= document.getElementById('adisnal-etype').value;
   if(etypeVal == "Life Insurance" || etypeVal == "Mortgage Protection" || etypeVal == "Income Protection" || etypeVal == "RLP" || etypeVal == "Family Income Benefit"){
    document.getElementById('protectionFields').style.display="block";	
    document.getElementById('otherprotectionFields').style.display="none";
  }else if(etypeVal!='Select Option'){
    document.getElementById('otherprotectionFields').style.display="block";
    document.getElementById('protectionFields').style.display="none";
  }else{
    document.getElementById('otherprotectionFields').style.display="none";
    document.getElementById('protectionFields').style.display="none";	
  }
  if(etypeVal == "Buy To Let"){
    document.getElementById('rentAcble').style.display="block";
  }
  if(etypeVal == "Re-mortgage"){
    document.getElementById('remorDiv').style.display="block";
    document.getElementById('ppvaltext').innerHTML="Property Value";
  }
}
function vaCheck(divId){
 var vaBVal= document.getElementById('adisnal-'+divId).value;
 if(vaBVal == "y"){
  document.getElementById(divId+'-div').style.display="block";	
}else{
  document.getElementById(divId+'-div').style.display="none";	
}
}
function checkTime(){
 var timeVal= document.getElementById('adisnal-choosetime').value;
 if(timeVal==""){
  alert("Let us know when is best to call you");
  document.getElementById('adisnal-choosetime').focus();
}else{
  document.getElementById('callmetime').value="Today";
  document.getElementById('adisnal').submit();
}
}
function checkTimea(){
  document.getElementById('callmetime').value="ASAP";
  document.getElementById('adisnal').submit();
}
function checkTimet(){
 var timeVal= document.getElementById('adisnal-choosetime').value;
 if(timeVal==""){
  alert("Let us know when is best to call you");
  document.getElementById('adisnal-choosetime').focus();
}else{
  document.getElementById('callmetime').value="Tomorrow";
  document.getElementById('adisnal').submit();
}
}
function crCheck(){
 var crVal= document.getElementById('adisnal-creditHistory').value;
 document.getElementById('cr-div').style.display="none";
 if(crVal=="Poor"){
  document.getElementById('cr-div').style.display="block";
}
}
</script>
<div class="snackbars" id="form-output-global"></div>
<script src="<?php echo $this->config->item('base_url')?>js/front/core.min.js"></script>
<script src="<?php echo $this->config->item('base_url')?>js/front/script.js"></script>
<script src="<?php echo $this->config->item('base_url')?>js/front/jquery.validate.js"  type="text/javascript"></script> 
<script type="text/javascript" id="cookieinfo" 
src="//cookieinfoscript.com/js/cookieinfo.min.js"
data-bg="#1d0d44"
data-fg="#FFFFFF"
data-link="#FFFFFF"
data-divlinkbg="#5431ac"
data-divlink="#FFFFFF"
data-cookie="CookieInfoScript"
data-text-align="left"
data-message="We use cookies to give you the best service on our site. By continuing to use the site you consent to our"
data-linkmsg="Privacy Policy."
data-moreinfo="http://www.contractormortgagesdirect.co.uk/privacy-policy.html"
data-close-text="I Accept">
</script>

<!-- Form validation -->
<script>
 $(document).ready(function() {

    $.validator.addMethod('alphaspaceonly',function (value, element) { 
      return /^[a-zA-Z_]*$/.test(value); 
    },'Alphabets and Spaces Only'
    );

    $.validator.addMethod("validemail", function(value, element) {
        return this.optional(element) || /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/i.test(value); 
    }, "Please Enter Valid Email.");

    $("#frm_contact_us").validate({        
        ignore:[],
        errorClass: 'help-block',
        errorElement: 'span',
        rules : {
            email : {required :true,email:true,validemail:true},
            name : {required : true,alphaspaceonly : true},
            telephone : {required : true,number:true,minlength:10,maxlength:15},
            call_time : {required : true}
        },
        messages : {
            email : {required : "Please enter your email address.",email_register:"Please enter valid email.",validemail:"Please enter valid email"},
            name:{required:"Please enter name."},
            telephone:{required:"Please enter telephone number"},
            call_time:{required:"Please select time"}
        },
        highlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group').addClass('has-error');
        },            
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorPlacement: function (error, element) { 
            if (element.attr("data-error-container")) { 
                error.appendTo(element.attr("data-error-container"));
            } else {
                error.insertAfter(element);
            }
        }
    });
});
</script>

</body>
</html>