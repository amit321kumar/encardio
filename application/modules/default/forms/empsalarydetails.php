<?php

class Default_Form_empsalarydetails extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		
		$this->setAttrib('id', 'formid');
		$this->setAttrib('name', 'empsalarydetails');
		
		$id = new Zend_Form_Element_Hidden('id');
				
		$userid = new Zend_Form_Element_Hidden('user_id');
				
		$currencyid = new Zend_Form_Element_Select('currencyid');
		$currencyid->setLabel('Salary Currency');
    	$currencyid->setRegisterInArrayValidator(false);
		
		$salarytype = new Zend_Form_Element_Select('salarytype');
		$salarytype->setLabel("Pay Frequency");
		$salarytype->setAttrib('id', 'jobpayfrequency');
		//$salarytype->setAttrib('onchange', 'changesalarytext(this)');
        $salarytype->setRegisterInArrayValidator(false);
        /*$salarytype->setMultiOptions(array(	
        					'' => 'Select Salary Type',						
							'1'=>'Yearly' ,
							'2'=>'Hourly',
							));*/
		
		$salary = new Zend_Form_Element_Text('salary');
		$salary->setLabel("Basic Salary");
        $salary->setAttrib('maxLength', 8);
	    $salary->addFilter(new Zend_Filter_StringTrim());
		
		$salary->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));
		
		$ta = new Zend_Form_Element_Text('ta');
		$ta->setLabel("TA");
        $ta->setAttrib('maxLength', 8);
	    $ta->addFilter(new Zend_Filter_StringTrim());
		
		$ta->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));
					 
		$da = new Zend_Form_Element_Text('da');
		$da->setLabel("DA");
        $da->setAttrib('maxLength', 8);
	    $da->addFilter(new Zend_Filter_StringTrim());
		
		$da->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));
					 
		$hra = new Zend_Form_Element_Text('hra');
		$hra->setLabel("HRA");
        $hra->setAttrib('maxLength', 8);
	    $hra->addFilter(new Zend_Filter_StringTrim());
		
		$hra->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));
					 
		$gratuity = new Zend_Form_Element_Text('gratuity');
		$gratuity->setLabel("Gratuity");
        $gratuity->setAttrib('maxLength', 8);
	    $gratuity->addFilter(new Zend_Filter_StringTrim());
		
		$gratuity->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));
					 
	    $pf = new Zend_Form_Element_Text('pf');
		$pf->setLabel("PF");
        $pf->setAttrib('maxLength', 8);
	    $pf->addFilter(new Zend_Filter_StringTrim());
		
		$pf->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));

	    $os = new Zend_Form_Element_Text('os');
		$os->setLabel("OS");
        $os->setAttrib('maxLength', 8);
	    $os->addFilter(new Zend_Filter_StringTrim());
		
		$os->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));
					 
	    $cca = new Zend_Form_Element_Text('cca');
		$cca->setLabel("CCA");
        $cca->setAttrib('maxLength', 8);
	    $cca->addFilter(new Zend_Filter_StringTrim());
		
		$cca->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));

	    $pda = new Zend_Form_Element_Text('pda');
		$pda->setLabel("PDA");
        $pda->setAttrib('maxLength', 8);
	    $pda->addFilter(new Zend_Filter_StringTrim());
		
		$pda->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));		

	    $vpa = new Zend_Form_Element_Text('vpa');
		$vpa->setLabel("VPA");
        $vpa->setAttrib('maxLength', 8);
	    $vpa->addFilter(new Zend_Filter_StringTrim());
		
		$vpa->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));

	    $medical = new Zend_Form_Element_Text('medical');
		$medical->setLabel("Medical");
        $medical->setAttrib('maxLength', 8);
	    $medical->addFilter(new Zend_Filter_StringTrim());
		
		$medical->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));		

	    $arrear = new Zend_Form_Element_Text('arrear');
		$arrear->setLabel("Arrear");
        $arrear->setAttrib('maxLength', 8);
	    $arrear->addFilter(new Zend_Filter_StringTrim());
		
		$arrear->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));

	    $ot = new Zend_Form_Element_Text('ot');
		$ot->setLabel("OT");
        $ot->setAttrib('maxLength', 8);
	    $ot->addFilter(new Zend_Filter_StringTrim());
		
		$ot->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));

	    $incentive = new Zend_Form_Element_Text('incentive');
		$incentive->setLabel("Incentive");
        $incentive->setAttrib('maxLength', 8);
	    $incentive->addFilter(new Zend_Filter_StringTrim());
		
		$incentive->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));


	    $bonus = new Zend_Form_Element_Text('bonus');
		$bonus->setLabel("Bonus");
        $bonus->setAttrib('maxLength', 8);
	    $bonus->addFilter(new Zend_Filter_StringTrim());
		
		$bonus->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));

	    $esi = new Zend_Form_Element_Text('esi');
		$esi->setLabel("ESI");
        $esi->setAttrib('maxLength', 8);
	    $esi->addFilter(new Zend_Filter_StringTrim());
		
		$esi->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));

	    $advance = new Zend_Form_Element_Text('advance');
		$advance->setLabel("Advance");
        $advance->setAttrib('maxLength', 8);
	    $advance->addFilter(new Zend_Filter_StringTrim());
		
		$advance->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));

	    $loan = new Zend_Form_Element_Text('loan');
		$loan->setLabel("Loan");
        $loan->setAttrib('maxLength', 8);
	    $loan->addFilter(new Zend_Filter_StringTrim());
		
		$loan->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));

		$esiemp = new Zend_Form_Element_Text('esiemp');
		$esiemp->setLabel("ESI Employer");
        $esiemp->setAttrib('maxLength', 8);
	    $esiemp->addFilter(new Zend_Filter_StringTrim());
		
		$esiemp->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));

		$itded = new Zend_Form_Element_Text('itded');
		$itded->setLabel("IT Deductions");
        $itded->setAttrib('maxLength', 8);
	    $itded->addFilter(new Zend_Filter_StringTrim());
		
		$itded->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));

		$medded = new Zend_Form_Element_Text('medded');
		$medded->setLabel("Medical Deductions");
        $medded->setAttrib('maxLength', 8);
	    $medded->addFilter(new Zend_Filter_StringTrim());
		
		$medded->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));

		$bankname = new Zend_Form_Element_Text('bankname');
		$bankname->setAttrib('maxlength',40);
		$bankname->setLabel('Bank Name');
		$bankname->addFilters(array('StringTrim'));
		$bankname->addValidator("regex",true,array(
                            'pattern'=>'/^[a-zA-Z][a-zA-Z0-9\-\. ]*$/', 
                           
                           'messages'=>array(
                               'regexNotMatch'=>'Please enter valid bank name.'
                           )
        	));
			

		$accountholder_name = new Zend_Form_Element_Text('accountholder_name');
		$accountholder_name->setAttrib('maxlength',40);
		$accountholder_name->setLabel('Account Holder Name');
		$accountholder_name->addFilters(array('StringTrim'));
		$accountholder_name->addValidators(array(
			         array(
			             'validator'   => 'Regex',
			             'breakChainOnFailure' => true,
			             'options'     => array( 
			             'pattern' =>'/^[a-zA-Z\s]+$/i',
			                 'messages' => array(
			                         'regexNotMatch'=>'Please enter only alphabets.'
			                 )
			             )
			         )
			     ));

        $accountholding = new ZendX_JQuery_Form_Element_DatePicker('accountholding');
		$accountholding->setLabel('Account Holding Since');
		$accountholding->setAttrib('readonly', 'true');
		$accountholding->setAttrib('onfocus', 'this.blur()');
		$accountholding->setOptions(array('class' => 'brdr_none'));	

		$pay_from = new ZendX_JQuery_Form_Element_DatePicker('pay_from');
		$pay_from->setLabel('Pay From');
		$pay_from->setAttrib('readonly', 'true');
		$pay_from->setAttrib('onfocus', 'this.blur()');
		$pay_from->setOptions(array('class' => 'brdr_none'));

		$pay_to = new ZendX_JQuery_Form_Element_DatePicker('pay_to');
		$pay_to->setLabel('Pay To');
		$pay_to->setAttrib('readonly', 'true');
		$pay_to->setAttrib('onfocus', 'this.blur()');
		$pay_to->setOptions(array('class' => 'brdr_none'));
		
		$accountclasstypeid = new Zend_Form_Element_Select('accountclasstypeid');
		$accountclasstypeid->setLabel('Account Class Type');
    	$accountclasstypeid->setRegisterInArrayValidator(false);
		
		$bankaccountid = new Zend_Form_Element_Select('bankaccountid');
		$bankaccountid->setLabel('Account Type');
    	$bankaccountid->setRegisterInArrayValidator(false);
		
		$accountnumber = new Zend_Form_Element_Text('accountnumber');
		$accountnumber->setAttrib('maxlength',20);
		$accountnumber->setLabel('Account Number');
		$accountnumber->addFilters(array('StringTrim'));
		$accountnumber->addValidator("regex",true,array(
                            'pattern'=>'/^[a-zA-Z0-9 ]*$/', 
                           
                           'messages'=>array(
                               'regexNotMatch'=>'Please enter only alphanumeric characters.'
                           )
        	));
          
        $pannumber = new Zend_Form_Element_Text('pannumber');
		$pannumber->setAttrib('maxlength',20);
		$pannumber->setLabel('PAN Number');
		$pannumber->addFilters(array('StringTrim'));
		$pannumber->addValidator("regex",true,array(
                            'pattern'=>'/^[a-zA-Z0-9 ]*$/', 
                           
                           'messages'=>array(
                               'regexNotMatch'=>'Please enter only alphanumeric characters.'
                           )
        	)); 
        
        $pfnumber = new Zend_Form_Element_Text('pfnumber');
		$pfnumber->setAttrib('maxlength',20);
		$pfnumber->setLabel('PF Number');
		$pfnumber->addFilters(array('StringTrim'));
		$pfnumber->addValidator("regex",true,array(
                            'pattern'=>'/^[a-zA-Z0-9 ]*$/', 
                           
                           'messages'=>array(
                               'regexNotMatch'=>'Please enter only alphanumeric characters.'
                           )
        	));

		$aadharno = new Zend_Form_Element_Text('aadharno');
		$aadharno->setAttrib('maxlength',20);
		$aadharno->setLabel('Aadhar Number');
		$aadharno->addFilters(array('StringTrim'));
		$aadharno->addValidator("regex",true,array(
                            'pattern'=>'/^[a-zA-Z0-9 ]*$/', 
                           
                           'messages'=>array(
                               'regexNotMatch'=>'Please enter only alphanumeric characters.'
                           )
        	));

		$esino = new Zend_Form_Element_Text('esino');
		$esino->setAttrib('maxlength',20);
		$esino->setLabel('ESI Number');
		$esino->addFilters(array('StringTrim'));
		$esino->addValidator("regex",true,array(
                            'pattern'=>'/^[a-zA-Z0-9 ]*$/', 
                           
                           'messages'=>array(
                               'regexNotMatch'=>'Please enter only alphanumeric characters.'
                           )
        	));

		$uannumber = new Zend_Form_Element_Text('uannumber');
		$uannumber->setAttrib('maxlength',20);
		$uannumber->setLabel('UAN Number');
		$uannumber->addFilters(array('StringTrim'));
		$uannumber->addValidator("regex",true,array(
                            'pattern'=>'/^[a-zA-Z0-9 ]*$/', 
                           
                           'messages'=>array(
                               'regexNotMatch'=>'Please enter only alphanumeric characters.'
                           )
        	));

		$dim = new Zend_Form_Element_Text('dim');
		$dim->setLabel("Days in Month");
        $dim->setAttrib('maxLength', 8);
	    $dim->addFilter(new Zend_Filter_StringTrim());
		
		$dim->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));

		$lwp = new Zend_Form_Element_Text('lwp');
		$lwp->setLabel("LWP in Month");
        $lwp->setAttrib('maxLength', 8);
	    $lwp->addFilter(new Zend_Filter_StringTrim());
		
		$lwp->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 
							 'pattern'=>'/^[0-9\.]*$/', 
							  'messages' => array('regexNotMatch'=>'Please enter only numbers.'
								 )
							 )
						 )
					 ));
    	
				
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		$submit->setLabel('Save');
		
		$this->addElements(array($id,$userid,$currencyid,$salarytype,$salary,$ta,$da,$hra,$gratuity,$pf,$os,$cca,$pda,$vpa,$medical,$arrear,$ot,$incentive,$bonus,$esi,$advance,$loan,$esiemp,$itded,$medded,$bankname,$accountholder_name,$accountholding,$pay_from,$pay_to,$accountclasstypeid,$bankaccountid,$accountnumber,$pannumber,$pfnumber,$aadharno,$esino,$uannumber,$dim,$lwp,$submit));
        $this->setElementDecorators(array('ViewHelper')); 
 		 $this->setElementDecorators(array(
                    'UiWidgetElement',
        ),array('accountholding','pay_from','pay_to')); 
	}
}