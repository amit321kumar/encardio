<?php
date_default_timezone_set("Asia/Bangkok");
$edit = $_GET['edit'];
include("db_con.php");
$myself_query = mysql_query("SELECT * FROM `main_employees_summary` es INNER JOIN `main_empsalarydetails` mes ON es.`user_id` = mes.`user_id` where mes.`user_id`='$edit'")or die(mysql_error());
if(mysql_num_rows($myself_query)>0)
{
   $m_row = mysql_fetch_object($myself_query);
   $accountholder_name=$m_row->accountholder_name;
   $employeename=$m_row->userfullname;
   $employeeid=$m_row->employeeId;
   $designation=$m_row->jobtitle_name;
   $department=$m_row->department_name;
   $doj=$m_row->date_of_joining;
   $accountnumber=$m_row->accountnumber;
   $pannumber=$m_row->pannumber;
   $pfnumber=$m_row->pfnumber;
   $esino=$m_row->esino;
   $aadharno=$m_row->aadharno;
   $dim=$m_row->dim;
   $lwp=$m_row->lwp;
   $uannumber=$m_row->uannumber;
   $salary=$m_row->salary;
   $ta=$m_row->ta;
   $da=$m_row->da;
   $hra=$m_row->hra;
   $gratuity=$m_row->gratuity;
   $pf=$m_row->pf;
   $medical=$m_row->medical;
   $os=$m_row->os;
   $cca=$m_row->cca;
   $pda=$m_row->pda;
   $vpa=$m_row->vpa;
   $arrear=$m_row->arrear;
   $ot=$m_row->ot;
   $incentive=$m_row->incentive;
   $bonus=$m_row->bonus;
   $esi=$m_row->esi;
   $advance=$m_row->advance;
   $loan=$m_row->loan;
   $esiemp=$m_row->esiemp;
   $itded=$m_row->itded;
   $medded=$m_row->medded;
   $bankname=$m_row->bankname;
   $createddate=$m_row->createddate;
   $pay_from=$m_row->pay_from;
   $pay_to=$m_row->pay_to;
   $date=date("F", strtotime($createddate));
   $pay_from=date("F j, Y " , strtotime($pay_from));
   $pay_to=date("F j, Y " , strtotime($pay_to));
   $total_sal = $m_row->salary + $m_row->ta + $m_row->da + $m_row->hra + $m_row->os + $m_row->cca + $m_row->vpa + $m_row->pda + $m_row->medical;
   $total_ear = $m_row->salary + $m_row->ta + $m_row->da + $m_row->hra + $m_row->os + $m_row->cca + $m_row->vpa + $m_row->pda + $m_row->medical + $m_row->arrear;
   $gross_ded= $m_row->pf + $m_row->esi + $m_row->esiemp + $m_row->itded + $m_row->advance + $m_row->loan + $m_row->medded;
   $netpay= $total_ear - $gross_ded;

   
}
                 

 // INCLUDE THE phpToPDF.php FILE
require("phpToPDF.php"); 

// PUT YOUR HTML IN A VARIABLE
$my_html_header="
<div style=\"display:block; background-color:white; padding:10px;margin-top:2%;border-bottom:0pt solid #cccccc; color:black;\">
  <div style=\"float:left; width:60%; text-align:left;\">
     <b style=\"float:left;font-size:20px;\">Encardio-Rite Electronics Pvt. Ltd.</b><br>
   <span style=\"color:#000;float:left;font-size:11px;\">A-7 Industrial Estate, Talkatora Road, Lucknow, UP-226611 India<br>
   Tel : +91 522 2661041, 2661042<br>
   Email : headhr@encardio.com; Website : http://encardio.com
   </span>
  </div>
  <div style=\"float:left; width:0%; text-align:center;\">
      &nbsp;
  </div>
  <div style=\"float:right; width:40%; text-align:right;\"> 
      <img width='265px' height='40px' src='http://3rdeyeadvisory.com/encardio-rite-hrms/encardio.png'/>
      
  </div>
  <br style=\"clear:left;\"/>
</div>";

$my_html="<HTML>
<head>
</head>
<body>
<br><br>
<table border='1' cellspacing='0' cellpadding='0' width='100%'>
<tr>
<th colspan='4' style='background-color:#f5f5f5;'>Salary Slip for the Month of $date</th>
</tr>
<tr>
<td colspan='2'>Pay Period</td>
<td colspan='2'>$pay_from to $pay_to</td>
</tr>
<tr>
<td colspan='2'>Name</td>
<td colspan='2'>$employeename</td>
</tr>
</table> 
<br><br>
<table border='1' cellspacing='0' cellpadding='0' width='100%'>
<tr>
<td>Employee Code</td>
<td>$employeeid</td>
<td>Bank Name</td>
<td>$bankname</td>
</tr>
<tr>
<td>Designation</td>
<td>$designation</td>
<td>Account No.</td>
<td>$accountnumber</td>
</tr>
<tr>
<td>DOJ</td>
<td>$doj</td>
<td>Department</td>
<td>$department</td>
</tr>
<tr>
<td>PAN No.</td>
<td>$pannumber</td>
<td>Days in Month</td>
<td>$dim</td>
</tr>
<tr>
<td>PF No.</td>
<td>$pfnumber</td>
<td>LWP Current Month</td>
<td>$lwp</td>
</tr>
<tr>
<td>UAN No.</td>
<td>$uannumber</td>
<td>Aadhar No.</td>
<td>$aadharno</td>
</tr>
<tr>
<td>ESI No.</td>
<td>$esino</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table> 
<br><br>
<table border='1' cellspacing='0' cellpadding='0' width='100%'>
<tr style='background-color:#f5f5f5;'>
<td>Standard Monthly Salary</td>
<td>INR</td>
<td>Earnings</td>
<td>INR</td>
<td colspan='2'>Deductions</td>
<td colspan='4'>INR</td>
</tr>
<tr>
<td>Basic Salary</td>
<td>$salary</td>
<td>Basic Salary</td>
<td>$salary</td>
<td colspan='2'>Provident Fund</td>
<td>$pf</td>
</tr>
<tr>
<td>Dearness Allowance</td>
<td>$da</td>
<td>Dearness Allowance</td>
<td>$da</td>
<td colspan='2'>ESI</td>
<td>$esi</td>
</tr>
<tr>
<td>HRA</td>
<td>$hra</td>
<td>HRA</td>
<td>$hra</td>
<td colspan='2'>ESI Employer</td>
<td>$esiemp</td>
</tr>
<tr>
<td>Conveyance</td>
<td>$ta</td>
<td>Conveyance</td>
<td>$ta</td>
<td colspan='2'>IT Ded.</td>
<td>$itded</td>
</tr>
<td>OS Allowance</td>
<td>$os</td>
<td>OS Allowance</td>
<td>$os</td>
<td colspan='2'>Advance Salary</td>
<td>$advance</td>
</tr>
<tr>
<td>CCA</td>
<td>$cca</td>
<td>CCA</td>
<td>$cca</td>
<td colspan='2'>Loan</td>
<td>$loan</td>
</tr>
<tr>
<td>VPA</td>
<td>$vpa</td>
<td>VPA</td>
<td>$vpa</td>
<td colspan='2'>Medical Deductions</td>
<td>$medded</td>
</tr>
<tr>
<td>PDA</td>
<td>$pda</td>
<td>PDA</td>
<td>$pda</td>
<td colspan='2'>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Medical Allowance</td>
<td>$medical</td>
<td>Medical Allowance</td>
<td>$medical</td>
<td colspan='2'>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>Arrear</td>
<td>$arrear</td>
<td colspan='2'>&nbsp;</td>
<td>&nbsp;</td>

</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan='2'>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Gross Salary</td>
<td>$total_sal</td>
<td>Gross Earning</td>
<td>$total_ear</td>
<td colspan='2'>Gross Deductions</td>
<td>$gross_ded</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan='2'>Net Pay</td>
<td>$netpay</td>
</tr>
<tr style='background-color:#f5f5f5;'>
<td colspan='8'>This is computer generated payslip and does not require signature or any company seal.</td>
</tr>
</table> 
</body>
</HTML>";
// SET YOUR PDF OPTIONS -- FOR ALL AVAILABLE OPTIONS, VISIT HERE:  http://phptopdf.com/documentation/
$pdf_options = array(
  "source_type" => 'html',
  "source" => $my_html,
  "action" => 'download',
  "file_name" => $employeename.'.pdf',
  "header" => $my_html_header,
  "footer" => $my_html_footer,
 "margin"=>array("right"=>"16","left"=>'16',"top"=>"50","bottom"=>"50"),
  "page_size" => 'A4');


// CALL THE phpToPDF FUNCTION WITH THE OPTIONS SET ABOVE
phptopdf($pdf_options);

?>