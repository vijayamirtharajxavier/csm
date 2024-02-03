
 <!--row -->
                <div class="row">
                           <div class="col-md-3 col-sm-6">
                        <div class="white-box bg-info">
                            <div class="r-icon-stats">
                                <i class="ti-comments bg-info"></i>
                                <div class="bodystate">
                                    <h4 style="color:white" class="pull-right"><?php echo $cb_thrift; ?></h4><br>
                                    <span class="text-muted pull-left"><a href=""  style="color:white">
Total Thrift Deposits </a></span>
                                </div>
                            </div>
                        </div>
                    </div>
					

                    <div class="col-md-3 col-sm-6">
                        <div class="white-box bg-danger">
                            <div class="r-icon-stats">
                               <i class="ti-id-badge bg-danger"></i>
                                <div class="bodystate">
                                    <h4 style="color:white" class="pull-right"><?php echo $cb_share; ?></h4><br>
                                    <span class="text-muted pull-left"><a href="" style="color:white">
Total Share Capitals </a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="white-box bg-purple">
                            <div class="r-icon-stats">
                                <i class="ti-wallet bg-purple"></i>
                                <div class="bodystate">
                                    <h4 style="color:white" class="pull-right"><?php echo $cb_prn; ?></h4><br>
                                    <span class="text-muted pull-left"><a href="" style="color:white">
Loan Outstanding </a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="white-box bg-info">
                            <div class="r-icon-stats">
                                <i class="ti-wallet bg-info"></i>
                                <div class="bodystate">
                                    <h4 style="color:white;text-align: center;">0 <?php //echo $loan_out; ?></h4>
                                    <span class="text-muted"><a href="" style="color:white">
Loan Appln Pending </a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--/row -->


                 <!-- Row -->
    <div class="row">



<div class="col-md-7 col-lg-9 col-sm-12 col-xs-12">
    <div class="card-header"> 
        <h4>LEDGER DETAILS
        <button class="pull-right sm-btn" id="exportpdf"><i style="color:darkred;" class="fa fa-file-pdf-o"></i></button></h4>
<div class="card text-center">
<div class="responsive" style="overflow:auto;">

 <div class="card-body">
<div id="ledger"></div>
</div>
</div>
</div>

</div> 
</div>






        



                     <div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bg-info m-b-15 ">
                                            
                                            <h1 class="bg-purple" style="text-align: center;color: white;">NOTICE BOARD</h1>
                                            

<div class="holder">
  <ul id="ticker01">
    <li><span style="color: white;">NEWS UPDATES</span></li>
    <?php
               foreach ($noticemessage as $key => $value) {
$originalDate = $value['event_date']; // $row->start_date;
$eventDate = date("d-m-Y", strtotime($originalDate));
                   // $option .= '<option value="'.$value['id'].'">'.$value['template_name'].'</option>';  
            echo '<li><span style="color:white;text-align:justify;">' . $eventDate . ' - </span ><a href="#" style="color:white"> ' . $value['event_name'] . '</a></li><li><span></span></li>
<li><span></span></li>
';
                    
                }?>
<li><span></span></li>
<li><span></span></li>
<li><span></span></li>
<li><span></span></li>
<li><span></span></li>
<li><span></span></li>
<li><span></span></li>

<li><span></span></li>
<li><span></span></li>
<li><span></span></li>

<li><span></span></li>
<li><span></span></li>
<li><span></span></li>
                </ul>
</div>       
                             <div class="row weather p-20 ">



                                      <!--  <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 m-t-40">
                                            <h3>&nbsp;</h3>
                                            <h1>73<sup>°F</sup></h1>
                                            <p class="text-white">AHMEDABAD, INDIA</p>
                                        </div>
                                        <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 text-right"> <i class="wi wi-day-cloudy-high"></i>
                                            <br/>
                                            <br/>
                                            <b class="text-white">SUNNEY DAY</b>
                                            <p class="w-title-sub">April 14</p>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="bg-success m-b-15">
                                    <!--<div id="myCarouse2" class="carousel vcarousel slide p-20">
                                        -- Carousel items --
                                        <div class="carousel-inner ">
                                            <div class="active item">
                                                <h3 class="text-white">Please mail us your <span class="font-bold">Feedback</span> to ebecsvellore@gmail.com</h3>
                                                <div class="twi-user"><img src="<?php echo base_url(); ?>optimum/plugins/images/users/hritik.jpg" alt="user" class="img-circle img-responsive pull-left">
                                                    <h4 class="text-white m-b-0">President</h4>
                                                    <p class="text-white">Vellore</p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <h3 class="text-white">Please do not hesitate to contact us <span class="font-bold">our New No.</span> +91-124-24584670</h3>
                                                <div class="twi-user"><img src="<?php echo base_url(); ?>optimum/plugins/images/users/john.jpg" alt="user" class="img-circle img-responsive pull-left">
                                                    <h4 class="text-white m-b-0">Admin Co-ordinator</h4>
                                                    <p class="text-white">Vellore</p>
                                                </div>
                                            </div>
                                            
                                            <div class="item">
                                                <h3 class="text-white">My Acting blown <span class="font-bold">Your Mind</span> and you also laugh at the moment</h3>
                                                <div class="twi-user"><img src="<?php echo base_url(); ?>optimum/plugins/images/users/varun.jpg" alt="user" class="img-circle img-responsive pull-left">
                                                    <h4 class="text-white m-b-0">Govinda</h4>
                                                    <p class="text-white">Actor</p>
                                                </div>
                                            </div> --
                                        </div> -
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>       
    </div>
    <!-- Row -->

<script>
var manageCrLdgerTbl;
$(document).ready(function(){    

getCrLdger();


$("#exportpdf").on('click',function(){
console.log('clicked PDF');
var url = 'fetchcreditledgerSearchPDF';
 $.ajax({
        url: url, //+ 'fetchReceiptSearch',
        //dataType: 'json',
        type: 'get',
        cache:false,
        success: function(data){


var w = window.open(url);


 //+ url+ '?fdate='+ fdate + '&tdate=' + tdate +'&desg=' + desg.trim() + '&cid=' + cid.trim() + '&lid='+ lid.trim());

// If the window opened successfully (e.g: not blocked)
/*if ( w ) {
    w.onload = function() {
        // Do stuff
        console.log('Loadeed successfully');
        w.print();
        //w.close();
    };
}*/


}
});

});



jQuery.fn.liScroll = function(settings) {
    settings = jQuery.extend({
        travelocity: 0.03
        }, settings);       
        return this.each(function(){
                var $strip = jQuery(this);
                $strip.addClass("newsticker")
                var stripHeight = 1;
                $strip.find("li").each(function(i){
                    stripHeight += jQuery(this, i).outerHeight(true); // thanks to Michael Haszprunar and Fabien Volpi
                });
                var $mask = $strip.wrap("<div class='mask'></div>");
                var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");                             
                var containerHeight = $strip.parent().parent().height();    //a.k.a. 'mask' width   
                $strip.height(stripHeight);         
                var totalTravel = stripHeight;
                var defTiming = totalTravel/settings.travelocity;   // thanks to Scott Waye     
                function scrollnews(spazio, tempo){
                $strip.animate({top: '-='+ spazio}, tempo, "linear", function(){$strip.css("top", containerHeight); scrollnews(totalTravel, defTiming);});
                }
                scrollnews(totalTravel, defTiming);             
                $strip.hover(function(){
                  jQuery(this).stop();
                },
                function(){
                  var offset = jQuery(this).offset();
                  var residualSpace = offset.top + stripHeight;
                  var residualTime = residualSpace/settings.travelocity;
                  scrollnews(residualSpace, residualTime);
                });         
        }); 
};

$(function(){
    $("ul#ticker01").liScroll();
});    

});

function getCrLdger()
{
  urlstr = base_url + 'fetchcreditledgerSearch';
 url = urlstr.replace("undefined","");
 var fmDate= $('#fmDate').val();
 var toDate= $('#toDate').val();
   
        console.log('Ledger Account');
 $.ajax({
        url: url, //+'?fdate=' + fmDate + '&tdate=' + toDate + '&selacc=' + selval, //+ 'fetchReceiptSearch',
        dataType: 'json',
        type: 'get',
        cache:false,
        success: function(data){
        var event_data = '';
console.log(data);
var thriftTotal=0.00;
var principleTotal=0.00;
var t_op = 0.00;
var l_op = 0.00;
var prnadj=0.00;
var opshr=0.00;
var shr_tot=0.00;

  $.each(data, function(index) {
//console.log("O/p DATA : "+data);
opshr = data[index].msharecap;
t_op = data[index].thrift_openingbalance;
 acc_id = data[index].id;
 //event_data+= '<div id="printable"><div class="card text-center"><div class="card-header" id="crldgrep"> <h4>CREDIT LEDGER</h4>   </div>  <div class="card-body"> <div class="row"> </div></div></div></div>';

event_data+= '<table style="  width: 30px;white-space: nowrap;" class="table" border="1" id="crldgrep"><tr><th></th><th></th><th colspan="3" style="text-align:center">Thrift Savings</th><th colspan="3" style="text-align:center">Shares</th><th colspan="2" style="text-align:center">Repayment</th><th style="text-align:center">Insurance</th><th colspan="2" style="text-align:center">Loan</th></tr><tr><th style="text-align:center">Date</th><th style="text-align:center;width:500px;">Reference #</th><th style="text-align:center">Receipt</th><th style="text-align:center">Payment</th><th style="text-align:center">Total</th><th style="text-align:center">Receipt</th><th style="text-align:center">Payment</th><th style="text-align:center">Total</th><th style="text-align:center">Principle</th><th style="text-align:center">Interest</th><th></th><th style="text-align:center">Loan Issued</th><th style="text-align:center">Loan Balance</th></tr><tbody>  <tr><td colspan="3"><b>OPENING BALANCE</b></td><td></td><td style="text-align:right"><b>'+ Number(data[index].thrift_openingbalance).toFixed(2) +'</b></td><td></td><td></td><td  style="text-align:right"><b>'+ Number(data[index].msharecap).toFixed(2) +'</b></td><td></td><td></td><td></td><td></td><td style="text-align:right"><b>'+Number(data[index].loan_openingbalance).toFixed(2)+'</b></td></tr>';

//console.log('thrf' + t_op);
      thriftTotal = parseFloat(t_op);
    //  console.log('Tot - : ' + thriftTotal);
              
                var op_bal = Number(data[index].loan_openingbalance);
                principleTotal = op_bal;
                var slen = data[index].ledgerdetails.length;
shr_tot=Number(opshr);                 
                console.log("len :"+slen);
              if(slen>0) {
              //  console.log(slen);
                var rowCount=1;
                var shrrct_col_tot=0;
                var shrpay_col_tot=0;
                var trf_amt=0.00;
                var int_tot=0.00;
                var shr_amt=0.00;
                var accountName='';
                var trfr_tot=0.00;
                var trfp_tot=0.00;
                var ins_tot=0.00;
                var int_amt=0.00;
                var balance=0.00;
                var shr_pay=0.00;
                var shr_rct=0.00;
                var ins_rct=0.00;
                var ins_tot=0.00;
                var prn_amt=0;
                var prn_pay=0;
                var prnp_tot=0;
                var prnr_tot=0;
              var loaniss_tot=0;
              var prnamt_tot=0;                
                for (var i =0; i<slen;  i++) {
                var dbAmt=0.00;
                var crAmt=0.00;
                
               trf_amt=0.00;
               var loaniss_amt=0.00;
               prnadj=0.00;
                var trfRef = data[index].ledgerdetails[i].trans_ref;
                

                   
                
                
//console.log(data[index].ledgerdetails[i].trans_date);
event_data+= '<tr>';
if(Number(data[index].ledgerdetails[i].thrift_r)>0)
{
thfr_amt= Number(data[index].ledgerdetails[i].thrift_r).toFixed(2);
}
else
{
thfr_amt= "";
}

event_data+= '<td>'+data[index].ledgerdetails[i].trans_date+'</td><td style="width:500px;">'+trfRef+'</td>';

event_data+= '<td style="text-align:right">'+ thfr_amt +'</td>';
if(Number(data[index].ledgerdetails[i].thrift_p)>0)
{
thfp_amt= Number(data[index].ledgerdetails[i].thrift_p).toFixed(2);
}
else
{
thfp_amt= "";
}


trf_amt= Number(data[index].ledgerdetails[i].thrift_r);
trf_pay= Number(data[index].ledgerdetails[i].thrift_p);
                event_data+= '<td style="text-align:right">'+ thfp_amt +'</td>';
               
                event_data+='<td style="text-align:right">'+Number(data[index].ledgerdetails[i].tot_thf).toFixed(2)+'</td>';

if(Number(data[index].ledgerdetails[i].share_r)>0)
{
var shrr_amt= Number(data[index].ledgerdetails[i].share_r).toFixed(2);
}
else
{
var shrr_amt= "";
}


if(Number(data[index].ledgerdetails[i].share_p)>0)
{
var shrp_amt= Number(data[index].ledgerdetails[i].share_p).toFixed(2);
}
else
{
var shrp_amt= "";
}


event_data+= '<td style="text-align:right">'+shrr_amt+'</td>';
                event_data+= '<td style="text-align:right">'+shrp_amt+'</td>';
shr_amt= Number(data[index].ledgerdetails[i].share_r);
shr_pay= Number(data[index].ledgerdetails[i].share_p);
              
                event_data+='<td style="text-align:right">'+Number(data[index].ledgerdetails[i].tot_shr).toFixed(2)+'</td>';

if(Number(data[index].ledgerdetails[i].principle_r)>0)
{
prnr_amt= Number(data[index].ledgerdetails[i].principle_r).toFixed(2);
}
else
{
prnr_amt= "";
}

if(Number(data[index].ledgerdetails[i].principle_p)>0)
{
prnp_amt= Number(data[index].ledgerdetails[i].principle_p).toFixed(2);
}
else
{
prnp_amt= "";
}


if(Number(data[index].ledgerdetails[i].interest_r)>0)
{
intr_amt= Number(data[index].ledgerdetails[i].interest_r).toFixed(2);
}
else
{
intr_amt= "";
}


if(Number(data[index].ledgerdetails[i].insurance_r)>0)
{
insr_amt= Number(data[index].ledgerdetails[i].insurance_r).toFixed(2);
}
else
{
insr_amt= "";
}

               event_data+= '<td style="text-align:right">'+prnr_amt+'</td>';
               event_data+= '<td style="text-align:right">'+intr_amt+'</td>';
               event_data+= '<td style="text-align:right">'+insr_amt+'</td>';

                event_data+= '<td style="text-align:right">'+prnp_amt+'</td>';
prn_amt= Number(data[index].ledgerdetails[i].principle_r);
prn_pay= Number(data[index].ledgerdetails[i].principle_p);
                
                event_data+='<td style="text-align:right">'+Number(data[index].ledgerdetails[i].tot_prn).toFixed(2)+'</td>';
loaniss_tot=loaniss_tot+loaniss_amt;
loaniss_amt = Number(data[index].ledgerdetails[i].principle_p);
shrrct_col_tot = shrrct_col_tot + shr_amt;
shrpay_col_tot = shrpay_col_tot + shr_pay;
shr_bal = Number(data[index].ledgerdetails[i].tot_shr);
//shr_tot = shr_amt+ Number(data[index].ledgerdetails[i].thrift_r);
int_tot = int_tot + Number(data[index].ledgerdetails[i].interest_r);
ins_tot = ins_tot + Number(data[index].ledgerdetails[i].insurance_r);

prnr_tot = prnr_tot + prn_amt;
prnp_tot = prnp_tot + prn_pay;

thriftTotal =  Number(data[index].ledgerdetails[i].tot_thf);
trfr_tot = trfr_tot + Number(trf_amt);
trfp_tot = trfp_tot + Number(trf_pay);

prnamt_tot = Number(data[index].ledgerdetails[i].tot_prn);



                event_data+= '</tr></div></div>';

                event_data += '</tr>';
              //  console.log(data[index].closingbal);
                
                           loaniss_amt=0.00;
            }

   trf_amt=0.00;

        }
        balance=0.00;

                event_data += '<tr>';
                event_data += '<td colspan="2"><b>CLOSING BALANCE</b></td>';
                event_data += '<td style="text-align:right;"><b>'+ Number(trfr_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+ Number(trfp_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+ Number(thriftTotal).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+Number(shrrct_col_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+Number(shrpay_col_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+Number(shr_bal).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+ Number(prnr_tot).toFixed(2) +'<td style="text-align:right;"><b>'+ Number(int_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+Number(ins_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+ Number(prnp_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+Number(prnamt_tot).toFixed(2) +'</b></td>';
                event_data += '</tr>';
                event_data += '</tbody>';
                event_data += '</table>';
               // event_data += '</div></div><hr><br><br>';
trf_tot=0;
//console.log(event_data);

});
$('#ledger').html(event_data);


}
});


}

</script>

<script type="text/javascript">
var data = [
      { y: 'APR', a: 50, b: 90, c: 90},
      { y: 'MAY', a: 65,  b: 75, c: 90},
      { y: 'JUN', a: 50,  b: 50, c: 90},
      { y: 'JUL', a: 75,  b: 60, c: 90},
      { y: 'AUG', a: 80,  b: 65, c: 90},
      { y: 'SEP', a: 90,  b: 70, c: 90},
      { y: 'OCT', a: 100, b: 75, c: 90},
      { y: 'NOV', a: 115, b: 75, c: 90},
      { y: 'DEC', a: 120, b: 85, c: 90},
      { y: 'JAN', a: 145, b: 85, c: 90},
      { y: 'FEB', a: 160, b: 95, c: 90},
      { y: 'MAR', a: 160, b: 95, c: 90}
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['a', 'b','c'],
      labels: ['Total Thrift', 'Total Principle','Total Interest'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors:['gray','red']
  };





config.element = 'area-chart';
Morris.Area(config);
config.element = 'line-chart';
Morris.Line(config);
config.element = 'bar-chart';
Morris.Bar(config);
config.element = 'stacked';

config.stacked = true;
Morris.Bar(config);

Morris.Donut({
  element: 'pie-chart',
  data: [
    {label: "Friends", value: 30},
    {label: "Allies", value: 15},
    {label: "Enemies", value: 45},
    {label: "Neutral", value: 10}
  ]
});
</script>




				
    <style type="text/css">
.holder { 
 /* background-color:#ccc;*/
  width:300px;
  height:250px;
  overflow:hidden;
  padding:10px;
  font-family:Helvetica;
}
.holder .mask {
  position: relative;
  left: 0px;
  top: 10px;
  width:300px;
  height:240px;
  overflow: hidden;
}
.holder ul {
  list-style:none;
  margin:0;
  padding:0;
  position: relative;
}
.holder ul li {
  padding:10px 0px;
}
.holder ul li a {
  color:darkred;
  text-decoration:none;
} 

#area-chart{
  min-height: 250px;
}
#line-chart{
  min-height: 250px;
}
#bar-chart{
  min-height: 250px;
}
#stacked{
  min-height: 250px;
}
#pie-chart{
  min-height: 250px;
}
    </style>


<style type="text/css">
#tophead{
  visibility: hidden; 
}  
@media print
{
body * { visibility: hidden; }
#printable * { visibility: visible; }
#printable { position: absolute; top: 40px; left: 30px; 
font-size: 12px;

}
#tophead
{
  font-size: 30px;
  font-weight: bold;
}
#printable table th { border: 1px solid black; padding: 2px; 
font-size: 15px;
font-weight: bold;

}
#printable table td, table th { border: 1px solid black; padding: 2px;

font-size: 15px;
 }
}
</style>



<style type="text/css">
#crldgrep {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  overflow-x: auto;
}

#crldgrep td, #crldgrep th {
  border: 1px solid #ddd;
  padding: 8px;
}

#crldgrep tr:nth-child(even){background-color: #f2f2f2;}

#crldgrep tr:hover {background-color: #ddd;}

#crldgrep th {
  /*padding-top: 12px;
  padding-bottom: 12px; */
  text-align: left;
  background-color: #4CAF50;
  color: white;

  }

tbody {
    

    overflow: auto;
}
.red-color {
color:red;
}

#flashContent {

  position: absolute;
  left: 200px;
  bottom: 200px;
  z-index: 2;

  width:400px; 
  height:400px; 
  background-color:red;
}
</style>

<style>
.left{
    text-align: left;
    margin-left: 5px;
}


.right {
text-align: left;
margin-left: 400px;
float: right;
}

.head {


    display:inline-block

}

#headtable table td{
    border: none;
}

</style>