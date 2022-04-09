<?php

// Add your custom css files here. (will located in header)
$extra_links_header = '
<!-- MD.BootstrapPersianDateTimePicker css -->
<link href="'.url('back/vendors/MD.BootstrapPersianDateTimePicker/Content/MdBootstrapPersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.css').'" rel="stylesheet">' ;

// Add your custom js files here. (will located in footer)
// <script src="'.url('back/vendors/MD.BootstrapPersianDateTimePicker/Scripts/MdBootstrapPersianDateTimePicker/jalaali.js').'"></script>
$extra_links_footer = '
<!-- MD.BootstrapPersianDateTimePicker js -->
<script src="'.url('back/vendors/MD.BootstrapPersianDateTimePicker/Scripts/MdBootstrapPersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js').'"></script>
' ;

// Call the header include.
include 'layout/header.php' ;

echo '
<!-- page content -->
<div class="right_col" role="main" >
    
    <div style="width: 100%;height: 80px;padding: 10px 0;" >
	  <center>
		 <h3 style="text-align:center;">
			 '.$title_of_page.'
			 <br>
		 </h3>
	  </center>
	</div>
    
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">  
        <div class="clearfix"></div>
        
        <div class="clearfix"></div>
	
		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12" >
			
			  <hr style="width:1px;">
			  <div class="form-group col-md-12 col-sm-12 col-xs-12" >
				
				<form method="post" action="'.route('store_show_submit_financial_transaction_form').'" >
                    <input type="hidden" name="_token" value="'.csrf_token().'" >
                    
					 <div class="col-md-12" >

						<center>
							
							<label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;font-size:19px;font-weight:normal;" >
								Please fill out the below * Required fields and finally click on
								<br>
								"Submit This Financial Transaction" at the end of this page
							</label>
							<label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;font-size:19px;font-weight:normal;margin-top:20px;margin-bottom:10px;" >
							
							     <span data-toggle="collapse" data-target="#more_details" class="btn-primary btn-lg" type="button" style="cursor:pointer;color:gray;background-color:white;border:1px solid #bfbdbd;" >
                                     <span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:#ccc;margin-left:5px;" ></span>
                                     Example 
                                 </span>
								<br>
								<br>
								<br>
								<div id="more_details" class="collapse col-md-12 col-sm-12 col-xs-12">
								<center>
									<div class="well col-md-12" align="center" style="float:none;" >
                                        Financial Transaction Type : 									
									    <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
									     Receive Money
									    <br>
									    Medical Document Number : 1
									    <br>
										Title of Transaction : payment of visit patient
										<br>
										Amount of Transaction : 5000
										<br>
										Date of Transaction : 16_12_2021
										<br>
										Time of Transaction : 13:30
										<br>
										Transaction Related to : Dr Alex
									</div>
								</center>
								</div>
								
							</label>
							
							<label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;margin-bottom:0px;font-size:19px;font-weight:normal;" >
							
							    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;" >
                                    <div style="float:left;" > * Required: Amount of Transaction (JUST TYPE NUMBERS): </div>
                                    <div > <input type="text" name="amount_of_payment" min="1" max="25" value="'.old('amount_of_payment').'" title="Amount of transaction * Required Field"  placeholder="Amount of transaction :" data-requiredmsg="Enter Title of transaction :" required="required" class="col-md-4 form-control" autocomplete="off" autocomplete="false" style="height:50px;" > </div>
                                </div>
                                    
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;" >
                                    <div style="float:left;" > * Required: Choose Date of Transaction </div>
                                </div>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;" >
                                    <div class="input-group date" style="float:left;" >
                                        <input type="text" name="financial_transaction_date" value="'.old('financial_transaction_date').'" class="form-control col-md-7 col-xs-12" id="dateMiladi" placeholder="Choose a Date" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#dateMiladi" data-enabletimepicker="false"
    data-placement="bottom" data-disablebeforetoday="false" data-isgregorian="true" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar" style="opacity: 0.5;" ></span>
                                        </span>
                                    </div>
                                </div>
                                    
                            </label>
							
							<label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;font-size:19px;font-weight:normal;margin-top:20px;" >
								 <div class="col-md-12 col-sm-12 col-xs-12" style="float:none;" align="center" >
                                    
                                    
                                       <div style="float:left;margin-bottom:7px;" >
                                            * Required: Financial Transaction Type: 
                                       </div>
                                       <div class="col-md-12 col-sm-12 col-xs-12">
                                          <div id="financial_transaction_type" class="btn-group btn-group-justified" data-toggle="buttons">
                                          
                                            <label class="btn btn-default " data-toggle-class="btn-primary" style="font-size:22px;" >
                                              <input type="radio" name="financial_transaction_type" value="+" > Receive Money
                                            </label>
                                            
                                            <label class="btn btn-default " data-toggle-class="btn-primary" style="font-size:22px;" >
                                              <input type="radio" name="financial_transaction_type" value="-"  > Pay Money
                                            </label>
                                            
                                          </div>
                                       </div>
                                   
                                    
                                    <br>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:30px;" >
                                       <div style="float:left;"  > * Required: Title of Transaction: </div>
                                       <div style="margin-top:10px;margin-bottom:30px;margin-top:30px;" class="col-md-12 col-sm-12 col-xs-12" >' ;

                                            // Explode and make array type variable
                                            $appointment_service_type = explode(",", Auth::user()->financial_management) ;
                                            // Estimate how many index exist in this variable
                                            $appointment_service_type_number = count($appointment_service_type);
                                            // Make end number for loop
                                            $end = $appointment_service_type_number ;
                                            for( $start ='0' ; $start < $end ; $start++ )
                                            {
                                                if( strlen($appointment_service_type[$start]) > 0 )
                                                {
                                                    echo '
                                                    <label class="btn btn-default well" data-toggle-class="btn-primary" style="font-size:20px;background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                                                        <input type="radio" name="title_of_payment" value="' . $appointment_service_type[$start] . '" required="required"  > ' . $appointment_service_type[$start] . '
                                                    </label>';
                                                }
                                            }

                                       echo '
                                       </div>
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12" >
                                       <div style="float:left;" > Patient Number of This Transaction (Optional): </div>
                                       <div> <input type="text" name="medical_document_number" min="1" max="11" value="'.old('medical_document_number').'" title="Patient Number of This Transaction (Optional)" placeholder="Medical Document Number :"  data-requiredmsg="Enter Medical Document Number :" class="col-md-4 form-control" autocomplete="off" autocomplete="false" style="height:50px;" > </div>
                                    </div>
                                    
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:0px;font-size:19px;font-weight:normal;margin-top:20px;" >
                                         <div class="col-md-12 col-sm-12 col-xs-12" style="float:none;" align="center" >
                                            <div class="col-md-12 col-sm-12 col-xs-12" >
                                               <div style="float:left;" > Transaction Related to (Optional): </div>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12" >' ;

                                    if( strlen(Auth::user()->clinic_doctors_name) > 0 )
                                    {
                                        /// Explode and make array type variable
                                        $common_cilinic_dr_1 = explode(",", Auth::user()->clinic_doctors_name);
                                        // Estimate how many index exist in this variable
                                        $common_cilinic_dr_number = count($common_cilinic_dr_1);
                                        // Make end number for loop
                                        $end = $common_cilinic_dr_number;
                                        for ($start = '0'; $start < $end; $start++)
                                        {
                                            if (strlen($common_cilinic_dr_1[$start]) > '0')
                                            {
                                                echo '
                                                <label class="btn btn-default well" data-toggle-class="btn-primary" style="font-size:20px;background-color:white;border: 1px solid #ccc;border-radius: 4px!important;" >
                                                    <input type="radio" name="financial_transaction_child_dr_related_name" value="' . $common_cilinic_dr_1[$start] . '"  > ' . $common_cilinic_dr_1[$start] . '
                                                </label>' ;
                                            }
                                        }
                                    }

                                    echo '	
                                    </div>
                                    
                                    
                                </div>
							</label>
							
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-top:0px;margin-bottom:5px;font-size:19px;font-weight:normal;" >
                                <div class="col-md-12 col-sm-12 col-xs-12" style="float:none;" align="center" >
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;" >
                                        <div style="float:left;" > Time of Transaction (Optional): </div>
                                        <div > <input type="text" name="financial_transaction_time"  min="1" value="'.old('financial_transaction_time').'" title="Time of transaction"  placeholder="Time of transaction :" data-requiredmsg="Enter Time of transaction :" class="col-md-4 form-control" autocomplete="off" autocomplete="false" style="height:50px;" > </div>
                                    </div>
                                    
                                </div>
                            </label>
                            																				
						</center>

						<button type="submit" name="setting_status" value="true" class="btn btn-success btn-group-justified" style="font-size:27px;position: fixed;bottom: 0px;right: 0px;z-index: 1;" >
							Submit This Financial Transaction
						</button>	

					  </div>
			
					</div>

				</form>
				
                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;margin-bottom:75px;" >
                    <div class="x_panel">
                        <font size="+2" class="col-md-12 col-sm-12 col-xs-12 text-center" style="direction:rtl!important;margin-top:0px;" > 
                            The Last 10 Financial Transactions
                        </font>
    
                        <hr style="width:1px;">
    
                        <div class="col-md-12 col-sm-12 col-xs-12 well" >
                            <div class="col-md-12" style="border-bottom: 1px solid #e3e3e3;padding-bottom:10px;" >
                                
                                <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:15px;" >
                                    ID of Transaction
                                    <br>
                                    Related Appointment 
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:15px;" >
                                    Patient Document Number
                                    <br>
                                    Patient Name & Family
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:15px;" >
                                    Transaction Related to name of Doctor
                                    <br>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:15px;">
                                    Amount of Transaction
                                    <br>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:15px;" >
                                    Title of Transaction
                                    <br>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:15px;">
                                    Date and Time of Transaction
                                    <br>
                                </div>
                            </div>
                            <br>';

                            if( $count_of_result_fetch_last_10_transaction > 0)
                            {
                                foreach ( $result_fetch_last_10_transaction as $key_10_transaction )
                                {
                                    echo '
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px;border-bottom:1px solid gray;" >
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                            '.$key_10_transaction->financial_transaction_id.'
                                            <br>' ;
                                            if(strlen($key_10_transaction->financial_appointment_related_id) > 0)
                                            {
                                              echo '<a href="'.$key_10_transaction->financial_appointment_related_id.'" style="font-weight:bolder;font-size:22px;" ><span class="glyphicon glyphicon-file" aria-hidden="true"></span></a>' ;
                                            }
                                            echo '
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                            '.$key_10_transaction->financial_patient_related_id.'
                                            <br>
                                            '.$key_10_transaction->patient_first_name.' '.$key_10_transaction->patient_last_name.'
                                            <br>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                            '.$key_10_transaction->financial_transaction_child_dr_related_name.'
                                            <br>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                             '.$key_10_transaction->financial_transaction_type.' '.$key_10_transaction->financial_transaction_amount.'
                                            <br>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                            '.$key_10_transaction->financial_transaction_title.'
                                            <br>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                            <center>
                                                ' . $key_10_transaction->financial_transaction_date . ' - ' . $key_10_transaction->financial_transaction_time . '
                                                <br>
                                                <a href="'.route('delete_this_financial_transaction' , $key_10_transaction->financial_transaction_id ).'" style="margin-top:10px;float:none!important;color: white; font-size: 13px; float: left;background-color:#5A738E;border:1px solid #5A738E; " class="btn btn-success" onclick="return confirm(\'Are you sure to delete this appointment?\') " title="Delete This Financial Transaction">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    Delete
                                                </a>
                                            </center>
                                        </div>
                                    </div>' ;
                                }

                                echo '
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:25px;" >
                                    <center>
                                        <h1>'
                                            .$result_fetch_last_10_transaction->links().
                                        '</h1>
                                    </center>
                                </div>';
                            }
                            else
                            {
                                echo '
                                <center>
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center" align="center" style="float:none;" >
                                        <h3 align="center" style="float:none;" >
                                            No Financial Transaction Were Found
                                        </h3>
                                    </div>
                                </center>' ;
                            }
                        echo '
                        </div>
                    </div>
                </div>
                
			  </div>
		  </div>
		</div>
    </div>
</div>      
<!-- /page content -->' ;

// Call the footer include.
include 'layout/footer.php' ;
?>

