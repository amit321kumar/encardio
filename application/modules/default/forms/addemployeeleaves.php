<?php

class Default_Form_addemployeeleaves extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->setAttrib('id', 'formid');
		$this->setAttrib('name', 'addempleaves');

        $id = new Zend_Form_Element_Hidden('id');
        $id_val = Zend_Controller_Front::getInstance()->getRequest()->getParam('id',null);
        
        $emp_leave_limit = new Zend_Form_Element_Text('leave_limit');
		$emp_leave_limit->setLabel("Allot Leave Limit");
        $emp_leave_limit->setAttrib('maxLength', 3);
        $emp_leave_limit->addFilter(new Zend_Filter_StringTrim());
        
		if($id_val == '') {
	        $businessunit_id = new Zend_Form_Element_Multiselect("businessunit_id");
	        $businessunit_id->setLabel("Business Units");
	        $businessunit_id->setRegisterInArrayValidator(false);
	        $businessunit_id->setRequired(true);
	        $businessunit_id->addValidator('NotEmpty', false, array('messages' => 'Please select business unit.'));
	        

	       


	        $department_id = new Zend_Form_Element_Multiselect("department_id");
	        $department_id->setLabel("Departments");  
	        $department_id->setRegisterInArrayValidator(false);      
	        $department_id->setRequired(true);
	        $department_id->addValidator('NotEmpty', false, array('messages' => 'Please select department.'));

	        
	        
	        $user_id = new Zend_Form_Element_Multiselect("user_id");
	        $user_id->setLabel("Employees");  
	        $user_id->setRegisterInArrayValidator(false);      
	        $user_id->setRequired(true);
	        $user_id->addValidator('NotEmpty', false, array('messages' => 'Please select employees.'));
		} else {
			$businessunit_id = new Zend_Form_Element_Hidden('businessunit_id');
			$department_id = new Zend_Form_Element_Hidden('department_id');
			$leave_type= new Zend_Form_Element_Hidden('leave_type');
			$user_id = new Zend_Form_Element_Hidden('user_id');
			$emp_leave_limit->setRequired(true);
        	$emp_leave_limit->addValidator('NotEmpty', false, array('messages' => 'Please enter leave limit for current year.'));
		}
		
		
		$emp_leave_limit->addValidator("regex",true,array(
                
						   'pattern'=>'/^(\-?[1-9]|\-?[1-9][0-9])$/',
                
                           'messages'=>array(
                               'regexNotMatch'=>'Leave limit must be in the range of 0 to 100.'
                           )
        	));	

		$alloted_year = new Zend_Form_Element_Text('alloted_year');
		$alloted_year->setLabel("Year");
        $alloted_year->setAttrib('maxLength', 4);
		$alloted_year->setAttrib('disabled', 'disabled');
		$alloted_year->setAttrib('onfocus', 'this.blur()');
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		$submit->setLabel('Save');
		
		$submitbutton = new Zend_Form_Element_Button('submitbutton');
		$submitbutton->setAttrib('id', 'submitbuttons');
		$submitbutton->setAttrib('onclick', 'validateEmployeLeaves()');
		$submitbutton->setLabel('Save');

		$this->addElements(array($id,$user_id,$businessunit_id,$department_id,$leave_type,$emp_leave_limit,$alloted_year,$submit,$submitbutton));
    	$this->setElementDecorators(array('ViewHelper')); 
	}
}