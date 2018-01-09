<?php


class Default_EmpsalarydetailsController extends Zend_Controller_Action
{

	private $options;
	public function preDispatch()
	{
	}

	public function init()
	{
		$this->_options= $this->getInvokeArg('bootstrap')->getOptions();
	}

	public function indexAction()
	{

	}

	public function editAction()
	{
	
		if(defined('EMPTABCONFIGS'))
		{
			$empOrganizationTabs = explode(",",EMPTABCONFIGS);

		 if(in_array('emp_salary',$empOrganizationTabs)){
		 	$auth = Zend_Auth::getInstance();
		 	$emptyFlag=0;
		 	if($auth->hasIdentity()){
					$loginUserId = $auth->getStorage()->read()->id;
					$loginuserRole = $auth->getStorage()->read()->emprole;
					$loginuserGroup = $auth->getStorage()->read()->group_id;
		 	}
		 	$popConfigPermission = array();
		 	if(sapp_Global::_checkprivileges(CURRENCY,$loginuserGroup,$loginuserRole,'add') == 'Yes'){
		 		array_push($popConfigPermission,'currency');
		 	}
		 	if(sapp_Global::_checkprivileges(ACCOUNTCLASSTYPE,$loginuserGroup,$loginuserRole,'add') == 'Yes'){
		 		array_push($popConfigPermission,'accountclasstype');
		 	}
		 	if(sapp_Global::_checkprivileges(BANKACCOUNTTYPE,$loginuserGroup,$loginuserRole,'add') == 'Yes'){
		 		array_push($popConfigPermission,'bankaccounttype');
		 	}
		 	if(sapp_Global::_checkprivileges(PAYFREQUENCY,$loginuserGroup,$loginuserRole,'add') == 'Yes'){
		 		array_push($popConfigPermission,'payfrequency');
		 	}
		 	
		 	$this->view->popConfigPermission = $popConfigPermission;

		 	$id = $this->getRequest()->getParam('userid');
		 	if($id == '')
		 	$id = $loginUserId;
		 	$callval = $this->getRequest()->getParam('call');
		 	if($callval == 'ajaxcall')
		 	$this->_helper->layout->disableLayout();

		 	$empsalarydetailsform = new Default_Form_empsalarydetails();
		 	try
		 	{
		 		if($id && is_numeric($id) && $id>0 && $id!=$loginUserId)
		 		{
		 			$employeeModal = new Default_Model_Employee();
					$usersModel = new Default_Model_Users();
		 			$empdata = $employeeModal->getActiveEmployeeData($id);
					$employeeData = $usersModel->getUserDetailsByIDandFlag($id);
		 			if($empdata == 'norows')
		 			{
		 				$this->view->rowexist = "norows";
		 				$this->view->empdata = "";
		 			}
		 			else
		 			{
		 				$this->view->rowexist = "rows";
		 				if(!empty($empdata))
		 				{
		 					$empsalarydetailsModal = new Default_Model_Empsalarydetails();
		 					$usersModel = new Default_Model_Users();

		 					$currencymodel = new Default_Model_Currency();
		 					$accountclasstypemodel = new Default_Model_Accountclasstype();
		 					$bankaccounttypemodel = new Default_Model_Bankaccounttype();
		 					$payfrequencyModal = new Default_Model_Payfrequency();
		 					$msgarray = array();

		 					$basecurrencymodeldata = $currencymodel->getCurrencyList();
                            $empsalarydetailsform->currencyid->addMultiOption('','Select Salary Currency');
		 					if(sizeof($basecurrencymodeldata) > 0)
		 					{
		 						
		 						foreach ($basecurrencymodeldata as $basecurrencyres){
		 							$empsalarydetailsform->currencyid->addMultiOption($basecurrencyres['id'],utf8_encode($basecurrencyres['currency']));
		 						}
		 					}else
		 					{
		 						$msgarray['currencyid'] = 'Salary currencies are not configured yet.';
		 						$emptyFlag++;
		 					}
		 					
		 				$payfreqData = $payfrequencyModal->getActivePayFreqData();
		 				$empsalarydetailsform->salarytype->addMultiOption('','Select Pay Frequency');
						if(sizeof($payfreqData) > 0)
						{
							foreach ($payfreqData as $payfreqres){
								$empsalarydetailsform->salarytype->addMultiOption($payfreqres['id'],$payfreqres['freqtype']);
							}
				
						}else
						{
							$msgarray['salarytype'] = 'Pay frequency is not configured yet.';
							$emptyFlag++;
				
						}

		 					$bankaccounttypeArr = $bankaccounttypemodel->getBankAccountList();
                                                        $empsalarydetailsform->bankaccountid->addMultiOption('','Select Account Type');
		 					if(!empty($bankaccounttypeArr))
		 					{
		 						
		 						foreach ($bankaccounttypeArr as $bankaccounttyperes){
		 							$empsalarydetailsform->bankaccountid->addMultiOption($bankaccounttyperes['id'],$bankaccounttyperes['bankaccounttype']);

		 						}
		 					}else
		 					{
		 						$msgarray['bankaccountid'] = 'Account types are not configured yet.';
		 						$emptyFlag++;
		 					}

		 					$accountclasstypeArr = $accountclasstypemodel->getAccountClassTypeList();
                                                        $empsalarydetailsform->accountclasstypeid->addMultiOption('','Select Account Class Type');
		 					if(!empty($accountclasstypeArr))
		 					{
		 						
		 						foreach ($accountclasstypeArr as $accountclasstyperes){
		 							$empsalarydetailsform->accountclasstypeid->addMultiOption($accountclasstyperes['id'],$accountclasstyperes['accountclasstype']);

		 						}
		 					}else
		 					{
		 						$msgarray['accountclasstypeid'] = 'Account class types are not configured yet.';
		 						$emptyFlag++;
		 					}

		 						

		 					$data = $empsalarydetailsModal->getsingleEmpSalaryDetailsData($id);
		 					if(!empty($data))
		 					{
		 						 $data[0]['salary'];
		 						 $data[0]['ta'];
		 						 $data[0]['da'];
		 						 $data[0]['hra'];
		 						 $data[0]['gratuity'];
		 						 $data[0]['pf'];	
		 						 $data[0]['os'];
		 						 $data[0]['cca'];
		 						 $data[0]['pda'];
		 						 $data[0]['vpa'];
		 						 $data[0]['medical'];
		 						 $data[0]['arrear'];
		 						 $data[0]['ot'];
		 						 $data[0]['incentive'];
		 						 $data[0]['bonus'];
		 						 $data[0]['esi'];
		 						 $data[0]['advance'];
		 						 $data[0]['loan'];
		 						 $data[0]['esiemp'];
		 						 $data[0]['itded'];
		 						 $data[0]['medded'];		

                                                          //  if($data[0]['salary'] != '')
                                                          //  $data[0]['salary'] = number_format($data[0]['salary'], 2, '.', '');
                                                          //  $data[0]['salary'];
		 						$empsalarydetailsform->populate($data[0]);
		 						if($data[0]['accountholding'] !='')
		 						{
		 							$accountholding = sapp_Global::change_date($data[0]["accountholding"], 'view');
		 							$empsalarydetailsform->accountholding->setValue($accountholding);
		 						}
		 						if($data[0]['pay_from'] !='')
		 						{
		 							$pay_from = sapp_Global::change_date($data[0]["pay_from"], 'view');
		 							$empsalarydetailsform->pay_from->setValue($pay_from);
		 						}
		 						if($data[0]['pay_to'] !='')
		 						{
		 							$pay_to = sapp_Global::change_date($data[0]["pay_to"], 'view');
		 							$empsalarydetailsform->pay_to->setValue($pay_to);
		 						}
		 						if($data[0]['accountclasstypeid'] !='')
							  $empsalarydetailsform->setDefault('accountclasstypeid',$data[0]['accountclasstypeid']);

							  $empsalarydetailsform->setDefault('currencyid',$data[0]['currencyid']);
							  $empsalarydetailsform->setDefault('bankaccountid',$data[0]['bankaccountid']);

		 					}
		 					$empsalarydetailsform->user_id->setValue($id);
		 					$empsalarydetailsform->setAttrib('action',BASE_URL.'empsalarydetails/edit/userid/'.$id);

		 					$this->view->form = $empsalarydetailsform;
		 						
		 					$this->view->data = isset($data[0])?$data[0]:array();
		 					$this->view->id = $id;
		 					$this->view->msgarray = $msgarray;
		 					$this->view->employeedata = $employeeData[0];
		 					$this->view->emptyFlag=$emptyFlag;
		 					$this->view->messages = $this->_helper->flashMessenger->getMessages();
		 				}
		 				$this->view->empdata = $empdata;
		 			}
		 				
		 		}
		 		else
		 		{
		 			$this->view->rowexist = "norows";
		 		}
		 	}
		 	catch(Exception $e)
		 	{
		 		$this->view->rowexist = "norows";
		 	}
		 	if($this->getRequest()->getPost())
		 	{
		 		$result = $this->save($empsalarydetailsform,$id);
		 		$this->view->msgarray = $result;
		 	}
		 }else{
		 	$this->_redirect('error');
		 }
		}else{
			$this->_redirect('error');
		}
	}

	public function viewAction()
	{
		if(defined('EMPTABCONFIGS'))
		{
			$empOrganizationTabs = explode(",",EMPTABCONFIGS);

		 if(in_array('emp_salary',$empOrganizationTabs)){
		 	$auth = Zend_Auth::getInstance();
		 	if($auth->hasIdentity()){
		 		$loginUserId = $auth->getStorage()->read()->id;
		 	}
		 	$id = $this->getRequest()->getParam('userid');
		 	if($id == '')		$id = $loginUserId;

		 	$callval = $this->getRequest()->getParam('call');
		 	if($callval == 'ajaxcall')
		 	$this->_helper->layout->disableLayout();

		 	$objName = 'empsalarydetails';
		 	$empsalarydetailsform = new Default_Form_empsalarydetails();
		 	$empsalarydetailsform->removeElement("submit");
		 	$elements = $empsalarydetailsform->getElements();
		 	if(count($elements)>0)
		 	{
		 		foreach($elements as $key=>$element)
		 		{
		 			if(($key!="Cancel")&&($key!="Edit")&&($key!="Delete")&&($key!="Attachments")){
		 				$element->setAttrib("disabled", "disabled");
		 			}
		 		}
		 	}
		 	 
		 	try
		 	{
		 		if($id && is_numeric($id) && $id>0 && $id!=$loginUserId)
		 		{
		 			$employeeModal = new Default_Model_Employee();
					$usersModel = new Default_Model_Users();
		 			$empdata = $employeeModal->getActiveEmployeeData($id);
					$employeeData = $usersModel->getUserDetailsByIDandFlag($id);
		 			if($empdata == 'norows')
		 			{
		 				$this->view->rowexist = "norows";
		 				$this->view->empdata = "";
		 			}
		 			else
		 			{
		 				$this->view->rowexist = "rows";
		 				if(!empty($empdata))
		 				{
		 					$empsalarydetailsModal = new Default_Model_Empsalarydetails();
		 					$usersModel = new Default_Model_Users();
		 					$currencymodel = new Default_Model_Currency();
		 					$accountclasstypemodel = new Default_Model_Accountclasstype();
		 					$bankaccounttypemodel = new Default_Model_Bankaccounttype();
		 					$payfrequencyModal = new Default_Model_Payfrequency();
		 					$data = $empsalarydetailsModal->getsingleEmpSalaryDetailsData($id);
		 						
		 					if(!empty($data))
		 					{

		 						if(isset($data[0]['currencyid']) && $data[0]['currencyid'] !='')
		 						{
		 							$currencyArr = $currencymodel->getCurrencyDataByID($data[0]['currencyid']);
		 							if(sizeof($currencyArr)>0)
		 							{
		 								$empsalarydetailsform->currencyid->addMultiOption($currencyArr[0]['id'],$currencyArr[0]['currencyname'].' '.$currencyArr[0]['currencycode']);
		 								$data[0]['currencyid']= $currencyArr[0]['currencyname'];

		 							}
									else
									{
										$data[0]['currencyid']="";
									}
		 						}

		 						if(isset($data[0]['accountclasstypeid']) && $data[0]['accountclasstypeid'] !='')
		 						{
		 							$accountclasstypeArr = $accountclasstypemodel->getsingleAccountClassTypeData($data[0]['accountclasstypeid']);
		 							if(sizeof($accountclasstypeArr)>0 && $accountclasstypeArr !='norows')
		 							{
		 								$empsalarydetailsform->accountclasstypeid->addMultiOption($accountclasstypeArr[0]['id'],$accountclasstypeArr[0]['accountclasstype']);
		 							    $data[0]['accountclasstypeid']=$accountclasstypeArr[0]['accountclasstype'];
		 							}
									else
									{
										 $data[0]['accountclasstypeid']="";
									}
		 						}

		 						if(isset($data[0]['bankaccountid']) && $data[0]['bankaccountid'] !='')
		 						{
		 							$bankaccounttypeArr = $bankaccounttypemodel->getsingleBankAccountData($data[0]['bankaccountid']);
		 							if($bankaccounttypeArr !='norows')
		 							{
		 								$empsalarydetailsform->bankaccountid->addMultiOption($bankaccounttypeArr[0]['id'],$bankaccounttypeArr[0]['bankaccounttype']);
		 							    $data[0]['bankaccountid']=$bankaccounttypeArr[0]['bankaccounttype'];
		 							}
									else
									{
										 $data[0]['bankaccountid']="";
									}
		 						}
		 						
		 						if(isset($data[0]['salarytype']) && $data[0]['salarytype'] !='')
		 						{
				 					$payfreqData = $payfrequencyModal->getActivePayFreqData($data[0]['salarytype']);
									if(sizeof($payfreqData) > 0)
									{
										foreach ($payfreqData as $payfreqres){
											$empsalarydetailsform->salarytype->addMultiOption($payfreqres['id'],$payfreqres['freqtype']);
										}
									}
		 						}

		 						$empsalarydetailsform->populate($data[0]);

		 						if($data[0]['accountholding'] !='')
		 						{
		 							$accountholding = sapp_Global::change_date($data[0]["accountholding"], 'view');
		 							$empsalarydetailsform->accountholding->setValue($accountholding);
		 						}
		 						if($data[0]['pay_from'] !='')
		 						{
		 							$pay_from = sapp_Global::change_date($data[0]["pay_from"], 'view');
		 							$empsalarydetailsform->pay_from->setValue($pay_from);
		 						}
		 						if($data[0]['pay_to'] !='')
		 						{
		 							$pay_to = sapp_Global::change_date($data[0]["pay_to"], 'view');
		 							$empsalarydetailsform->pay_to->setValue($pay_to);
		 						}
			 					 if(!empty($data[0]['salarytype']))
								 {
							           $salarytype = $payfrequencyModal->getsinglePayfrequencyData($data[0]['salarytype']);
							            if(!empty($salarytype) && $salarytype !='norows')
							            {
								          $data[0]['salarytype'] = $salarytype[0]['freqtype'];
							            }
						         }
						         if(!empty($data[0]['salary']))
								 {
									 if($data[0]['salary'] !='')
									{
									  $data[0]['salary']=sapp_Global:: _decrypt( $data[0]['salary']);
									}
									else
									{
										$data[0]['salary']="";
									}
						         }
								 
								 if(!empty($data[0]['ta']))
								 {
									 if($data[0]['ta'] !='')
									{
									  $data[0]['ta']=sapp_Global:: _decrypt( $data[0]['ta']);
									}
									else
									{
										$data[0]['salary']="";
									}
						         }
								 
								 if(!empty($data[0]['da']))
								 {
									 if($data[0]['da'] !='')
									{
									  $data[0]['da']=sapp_Global:: _decrypt( $data[0]['da']);
									}
									else
									{
										$data[0]['da']="";
									}
						         }
								 
								 if(!empty($data[0]['hra']))
								 {
									 if($data[0]['hra'] !='')
									{
									  $data[0]['hra']=sapp_Global:: _decrypt( $data[0]['hra']);
									}
									else
									{
										$data[0]['hra']="";
									}
						         }
								 
								 if(!empty($data[0]['gratuity']))
								 {
									 if($data[0]['gratuity'] !='')
									{
									  $data[0]['gratuity']=sapp_Global:: _decrypt( $data[0]['gratuity']);
									}
									else
									{
										$data[0]['gratuity']="";
									}
						         }
								 
								 if(!empty($data[0]['pf']))
								 {
									 if($data[0]['pf'] !='')
									{
									  $data[0]['pf']=sapp_Global:: _decrypt( $data[0]['pf']);
									}
									else
									{
										$data[0]['pf']="";
									}
						         }

						         if(!empty($data[0]['os']))
								 {
									 if($data[0]['os'] !='')
									{
									  $data[0]['os']=sapp_Global:: _decrypt( $data[0]['os']);
									}
									else
									{
										$data[0]['os']="";
									}
						         }

						          if(!empty($data[0]['cca']))
								 {
									 if($data[0]['cca'] !='')
									{
									  $data[0]['cca']=sapp_Global:: _decrypt( $data[0]['cca']);
									}
									else
									{
										$data[0]['cca']="";
									}
						         }

						         if(!empty($data[0]['pda']))
								 {
									 if($data[0]['pda'] !='')
									{
									  $data[0]['pda']=sapp_Global:: _decrypt( $data[0]['pda']);
									}
									else
									{
										$data[0]['pda']="";
									}
						         }

						          if(!empty($data[0]['vpa']))
								 {
									 if($data[0]['vpa'] !='')
									{
									  $data[0]['vpa']=sapp_Global:: _decrypt( $data[0]['vpa']);
									}
									else
									{
										$data[0]['vpa']="";
									}
						         }

						          if(!empty($data[0]['medical']))
								 {
									 if($data[0]['medical'] !='')
									{
									  $data[0]['medical']=sapp_Global:: _decrypt( $data[0]['medical']);
									}
									else
									{
										$data[0]['medical']="";
									}
						         }

						          if(!empty($data[0]['arrear']))
								 {
									 if($data[0]['arrear'] !='')
									{
									  $data[0]['arrear']=sapp_Global:: _decrypt( $data[0]['arrear']);
									}
									else
									{
										$data[0]['arrear']="";
									}
						         }

						          if(!empty($data[0]['ot']))
								 {
									 if($data[0]['ot'] !='')
									{
									  $data[0]['ot']=sapp_Global:: _decrypt( $data[0]['ot']);
									}
									else
									{
										$data[0]['ot']="";
									}
						         }

						         if(!empty($data[0]['incentive']))
								 {
									 if($data[0]['incentive'] !='')
									{
									  $data[0]['incentive']=sapp_Global:: _decrypt( $data[0]['incentive']);
									}
									else
									{
										$data[0]['incentive']="";
									}
						         }	

						         if(!empty($data[0]['bonus']))
								 {
									 if($data[0]['bonus'] !='')
									{
									  $data[0]['bonus']=sapp_Global:: _decrypt( $data[0]['bonus']);
									}
									else
									{
										$data[0]['bonus']="";
									}
						         }	

						          if(!empty($data[0]['esi']))
								 {
									 if($data[0]['esi'] !='')
									{
									  $data[0]['esi']=sapp_Global:: _decrypt( $data[0]['esi']);
									}
									else
									{
										$data[0]['esi']="";
									}
						         }	

						          if(!empty($data[0]['advance']))
								 {
									 if($data[0]['advance'] !='')
									{
									  $data[0]['advance']=sapp_Global:: _decrypt( $data[0]['advance']);
									}
									else
									{
										$data[0]['advance']="";
									}
						         }	

						          if(!empty($data[0]['loan']))
								 {
									 if($data[0]['loan'] !='')
									{
									  $data[0]['loan']=sapp_Global:: _decrypt( $data[0]['loan']);
									}
									else
									{
										$data[0]['loan']="";
									}
						         }	
                                  
                                   if(!empty($data[0]['esiemp']))
								 {
									 if($data[0]['esiemp'] !='')
									{
									  $data[0]['esiemp']=sapp_Global:: _decrypt( $data[0]['esiemp']);
									}
									else
									{
										$data[0]['esiemp']="";
									}
						         }	

						            if(!empty($data[0]['itded']))
								 {
									 if($data[0]['itded'] !='')
									{
									  $data[0]['itded']=sapp_Global:: _decrypt( $data[0]['itded']);
									}
									else
									{
										$data[0]['itded']="";
									}
						         }	

						            if(!empty($data[0]['medded']))
								 {
									 if($data[0]['medded'] !='')
									{
									  $data[0]['medded']=sapp_Global:: _decrypt( $data[0]['medded']);
									}
									else
									{
										$data[0]['medded']="";
									}
						         }	

		 					}
		 				    
		 					$this->view->controllername = $objName;
		 					$this->view->data = $data;
		 					$this->view->id = $id;
		 					$this->view->form = $empsalarydetailsform;
		 					$this->view->employeedata = $employeeData[0];

		 				}
		 				$this->view->empdata = $empdata;
		 			}
		 		}
		 		else
		 		{
		 			$this->view->rowexist = "norows";
		 		}
		 	}
		 	catch(Exception $e)
		 	{
		 		$this->view->rowexist = "norows";
		 	}
		 }else{
		 	$this->_redirect('error');
		 }
		}else{
			$this->_redirect('error');
		}
	}

	public function save($empsalarydetailsform,$userid)
	{
		$auth = Zend_Auth::getInstance();
		if($auth->hasIdentity()){
			$loginUserId = $auth->getStorage()->read()->id;
		}
		if($empsalarydetailsform->isValid($this->_request->getPost())){
           $post_values = $this->_request->getPost();
           	 if(isset($post_values['id']))
                unset($post_values['id']);
             if(isset($post_values['user_id']))
                unset($post_values['user_id']);
             if(isset($post_values['submit']))	
                unset($post_values['submit']);
           $new_post_values = array_filter($post_values);
           if(!empty($new_post_values))
           {         
				$empsalarydetailsModal = new Default_Model_Empsalarydetails();
				$id = $this->_request->getParam('id');
				$user_id = $userid;
				$currencyid = $this->_request->getParam('currencyid');
				$salarytype = $this->_request->getParam('salarytype');
				$salary = $this->_request->getParam('salary');
				$ta = $this->_request->getParam('ta');
				$da = $this->_request->getParam('da');
				$hra = $this->_request->getParam('hra');
				$gratuity = $this->_request->getParam('gratuity');
				$pf = $this->_request->getParam('pf');
				$os = $this->_request->getParam('os');
				$cca = $this->_request->getParam('cca');
				$pda = $this->_request->getParam('pda');
				$vpa = $this->_request->getParam('vpa');
				$medical = $this->_request->getParam('medical');
				$arrear = $this->_request->getParam('arrear');
				$ot = $this->_request->getParam('ot');
				$incentive = $this->_request->getParam('incentive');
				$bonus = $this->_request->getParam('bonus');
				$esi = $this->_request->getParam('esi');
				$advance = $this->_request->getParam('advance');
				$loan = $this->_request->getParam('loan');
				$esiemp = $this->_request->getParam('esiemp');
				$itded = $this->_request->getParam('itded');
				$medded = $this->_request->getParam('medded');
				$bankname = trim($this->_request->getParam('bankname'));
				$accountholder_name = trim($this->_request->getParam('accountholder_name'));
				$accountclasstypeid = $this->_request->getParam('accountclasstypeid');
				$bankaccountid = $this->_request->getParam('bankaccountid');
				$accountnumber = trim($this->_request->getParam('accountnumber'));
				$uannumber = trim($this->_request->getParam('uannumber'));
				$pannumber = trim($this->_request->getParam('pannumber'));
				$pfnumber = trim($this->_request->getParam('pfnumber'));
				$aadharno = trim($this->_request->getParam('aadharno'));
				$esino = trim($this->_request->getParam('esino'));
				$dim = trim($this->_request->getParam('dim'));
				$lwp = trim($this->_request->getParam('lwp'));
	
				$accountholding = $this->_request->getParam('accountholding');
				$accountholding = sapp_Global::change_date($accountholding, 'database');
				$pay_from = $this->_request->getParam('pay_from');
				$pay_from = sapp_Global::change_date($pay_from, 'database');
				$pay_to = $this->_request->getParam('pay_to');
				$pay_to = sapp_Global::change_date($pay_to, 'database');
	
	
				$date = new Zend_Date();
				$actionflag = '';
				$tableid  = '';
	            $salary=($salary);
				$data = array('user_id'=>$user_id,
					                 'currencyid'=>$currencyid,
									 'salarytype'=>$salarytype,
									 'salary'=>($salary!=''?$salary:NULL), 	
									 'ta'=>($ta!=''?$ta:NULL),
									 'da'=>($da!=''?$da:NULL),
									 'hra'=>($hra!=''?$hra:NULL),
									 'gratuity'=>($gratuity!=''?$gratuity:NULL),
									 'pf'=>($pf!=''?$pf:NULL),
									 'os'=>($os!=''?$os:NULL),
									 'cca'=>($cca!=''?$cca:NULL),
									 'pda'=>($pda!=''?$pda:NULL),
									 'vpa'=>($vpa!=''?$vpa:NULL),
									 'medical'=>($medical!=''?$medical:NULL),
									 'arrear'=>($arrear!=''?$arrear:NULL),
									 'ot'=>($ot!=''?$ot:NULL),
									 'incentive'=>($incentive!=''?$incentive:NULL),
									 'bonus'=>($bonus!=''?$bonus:NULL),
									 'esi'=>($esi!=''?$esi:NULL),
									 'advance'=>($advance!=''?$advance:NULL),
									 'loan'=>($loan!=''?$loan:NULL),
									 'esiemp'=>($esiemp!=''?$esiemp:NULL),
									 'itded'=>($itded!=''?$itded:NULL),
									 'medded'=>($medded!=''?$medded:NULL),
	                                 'bankname'=>($bankname!=''?$bankname:NULL),
	                                 'accountholder_name'=>($accountholder_name!=''?$accountholder_name:NULL),
	                                 'accountclasstypeid'=>($accountclasstypeid!=''?$accountclasstypeid:NULL),
	                                 'bankaccountid'=>($bankaccountid!=''?$bankaccountid:NULL),    								 
					      			 'accountnumber'=>($accountnumber!=''?$accountnumber:NULL),
					      			 'uannumber'=>($uannumber!=''?$uannumber:NULL),
					      			 'pannumber'=>($pannumber!=''?$pannumber:NULL),
					      			 'pfnumber'=>($pfnumber!=''?$pfnumber:NULL),
					      			 'aadharno'=>($aadharno!=''?$aadharno:NULL),
					      			 'esino'=>($esino!=''?$esino:NULL),
					      			 'dim'=>($dim!=''?$dim:NULL),
					      			 'lwp'=>($lwp!=''?$lwp:NULL),
									 'accountholding'=>($accountholding!=''?$accountholding:NULL),
									 'pay_from'=>($pay_from!=''?$pay_from:NULL),
									 'pay_to'=>($pay_to!=''?$pay_to:NULL),
									 'modifiedby'=>$loginUserId,
				                     'modifieddate'=>gmdate("Y-m-d H:i:s")
				);
				if($id!=''){
					$where = array('user_id=?'=>$user_id);
					$actionflag = 2;
				}
				else
				{
					$data['createdby'] = $loginUserId;
					$data['createddate'] = gmdate("Y-m-d H:i:s");
					$data['isactive'] = 1;
					$where = '';
					$actionflag = 1;
				}
				$Id = $empsalarydetailsModal->SaveorUpdateEmpSalaryData($data, $where);
				if($Id == 'update')
				{
					$tableid = $id;
					$this->_helper->getHelper("FlashMessenger")->addMessage(array("success"=>"Employee salary details updated successfully."));
						
				}
				else
				{
					$tableid = $Id;
					$this->_helper->getHelper("FlashMessenger")->addMessage(array("success"=>"Employee salary details added successfully."));
				}
				
				$menuID = EMPLOYEE;
				$result = sapp_Global::logManager($menuID,$actionflag,$loginUserId,$user_id);
           }else
           {
           		$this->_helper->getHelper("FlashMessenger")->addMessage(array("error"=>FIELDMSG));
           }
           $this->_redirect('empsalarydetails/edit/userid/'.$userid);
		}else
		{
			$messages = $empsalarydetailsform->getMessages();
			foreach ($messages as $key => $val)
			{
				foreach($val as $key2 => $val2)
				{
					$msgarray[$key] = $val2;
					break;
				}
			}
			return $msgarray;
		}

	}



}
?>
