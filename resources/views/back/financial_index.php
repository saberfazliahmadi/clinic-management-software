<?php
// Add your custom css files here (will be located in header)
$extra_links_header = '
<!-- MD.BootstrapPersianDateTimePicker css -->
<link href="'.url('back/vendors/MD.BootstrapPersianDateTimePicker/Content/MdBootstrapPersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.css').'" rel="stylesheet">' ;

// Add your custom js files here (will be located in footer)
// <script src="'.url('back/vendors/MD.BootstrapPersianDateTimePicker/Scripts/MdBootstrapPersianDateTimePicker/jalaali.js').'"></script>
$extra_links_footer = '
<!-- MD.BootstrapPersianDateTimePicker js -->
<script src="'.url('back/vendors/MD.BootstrapPersianDateTimePicker/Scripts/MdBootstrapPersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js').'"></script>

<!-- Chart.js -->
<script src="'.url('back/vendors/Chart.js/dist/Chart.min.js').'"></script>
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
				<form method="get" action="'.route('financial.show').'?#report_result" >
                    <input type="hidden" name="_token" value="'.csrf_token().'" >
                    
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                        <center>
                        
                            <h2 class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-bottom:35px!important;">
                                Choose a period of date to display financial transaction report
                            </h2>
                        
                            <div class="form-group" >
                        
                                <div class="col-md-6 col-sm-6 col-xs-12" >
                                    <label style="font-size:27px;" >From Date</label>
                                    <div class="input-group date" style="float:none;" >
                                        <input type="text" name="financial_report_from_date" value="'.old('financial_report_from_date').'" class="form-control col-md-7 col-xs-12" id="dateMiladi" placeholder="Choose a Date" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#dateMiladi" data-enabletimepicker="false"
        data-placement="bottom" data-disablebeforetoday="false" data-isgregorian="true" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar" style="opacity: 0.5;" ></span>
                                        </span>
                                    </div>
                                </div>
                        
                                <div class="col-md-6 col-sm-6 col-xs-12" >
                                    <label style="font-size:27px;" >To Date</label>
                                    <div class="input-group date" style="float:none;" >
                                        <input type="text" name="financial_report_to_date" value="'.old('financial_report_to_date').'" class="form-control col-md-7 col-xs-12" id="dateMiladi_2" placeholder="Choose a Date" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#dateMiladi_2" data-enabletimepicker="false"
        data-placement="bottom" data-disablebeforetoday="false" data-isgregorian="true" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar" style="opacity: 0.5;" ></span>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;" >
                                  
                                    <h2 class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-bottom:15px!important;">
                                        Select the dr related name of financial transaction
                                    </h2>
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12" >
                                        <input type="hidden" name="financial_transaction_child_dr_related_name" value="" checked="checked"  >' ;
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
                                    
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:30px;margin-bottom:30px;" >
                                  
                                    <h2 class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-bottom:15px!important;">
                                        Select title of financial transaction
                                    </h2>
                                    <input type="hidden" name="financial_transaction_title" value="" checked="checked"  >';

                                    if( strlen(Auth::user()->financial_management) > 0 )
                                    {
                                        // Explode and array these title.
                                        $financial_management_array = explode(",", Auth::user()->financial_management );
                                        // Estimate how many title this text have.
                                        $financial_management_array_number = count($financial_management_array);

                                        // Estimate how many title exist on this text record to use of for loop.
                                        $end = $financial_management_array_number;

                                        // START of make a for loop to update all title a text have.
                                        for ($start = '0'; $start < $end; $start++)
                                        {
                                            if (strlen($financial_management_array[$start]) > '0')
                                            {
                                                echo '
                                                <label class="btn btn-default well" data-toggle-class="btn-primary" style="font-size:20px;background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                                                    <input type="radio" name="financial_transaction_title" value="' . $financial_management_array[$start] . '"  > ' . $financial_management_array[$start] . '
                                                </label>';
                                            }
                                        }
                                    }

                                echo '
                                </div>     
                                    
                            </div>
                                                                            
                        </center>
                        <button type="submit" name="setting_status" value="true" class="btn btn-success btn-group-justified" style="font-size:27px;position: fixed;bottom: 0px;right: 0px;z-index: 1;" >
                            Make a Report of Financial Transactions
                        </button>
                    </div>
				</form>';

                // For situation that user did not choose any date and came to this page for first time
                // These variable should be defined
                // Because they will use in next steps, even there is no financial transaction result
                if( !isset($num_of_pay_transactions , $num_of_receive_transactions) )
                {
                    $num_of_pay_transactions     = '';
                    $num_of_receive_transactions = '';
                    $label_chart_money_receive   = '';
                    $label_chart_money_paid      = '';
                    $data_chart_money_receive    = '';
                    $data_chart_money_paid       = '';
                }

                if( strlen($num_of_pay_transactions) > 0 || strlen($num_of_receive_transactions) > 0 )
                {
                echo '
				<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;margin-bottom:75px;" id="report_result" >
                    <div class="x_panel">
                        <font size="+2" class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top:0px;" > 
                            Report of Financial Transactions 
                            <br>'
                            .$name_of_financial_transaction_child_dr_related_name
                            .$name_of_financial_transaction_title ;

                            if (isset($financial_report_from_date))
                            {
                                echo 'From ' . $financial_report_from_date;
                            }

                            if (isset($financial_report_to_date))
                            {
                                echo ' To ' . $financial_report_to_date;
                            }
                        echo '
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
                                    Transaction Related to
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

                    $sum_of_received_transactions = '0';
                    $label_chart_money_receive = '';
                    $data_chart_money_receive = '';

                    if (isset($num_of_receive_transactions))
                    {
                        if ($num_of_receive_transactions > 0)
                        {
                            echo '
                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:35px;" >
                                <font size="+2" class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top:0px;border:1px solid gray;border-radius:50px;" > 
                                    Report of ' . $num_of_receive_transactions . ' Received Financial Transactions 
                                    <br>
                                </font>
                            </div>';

                            foreach ($result_fetch_receive_transactions_from_date_to_date as $key_receive_transaction) {
                                $sum_of_received_transactions += $key_receive_transaction->financial_transaction_amount;
                                // make label chart string variable to use on charts.
                                $label_chart_money_receive .= '"' . $key_receive_transaction->financial_transaction_date . '" ,';
                                // make data chart string variable to use on charts.
                                $data_chart_money_receive .= $key_receive_transaction->financial_transaction_amount . ' ,';

                                echo '
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom:15px;border-bottom:1px solid gray;" >
                                
                                    <hr style="width:1px;">
                                    <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                        ' . $key_receive_transaction->financial_transaction_id . '
                                        <br>';
                                if (strlen($key_receive_transaction->financial_appointment_related_id) > 0) {
                                    echo '
                                    <a href="' . $key_receive_transaction->financial_appointment_related_id . '" style="font-weight:bolder;font-size:22px;" >
                                        <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                    </a>';
                                }
                                echo '
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                    ' . $key_receive_transaction->financial_patient_related_id . '
                                    <br>
                                    ' . $key_receive_transaction->patient_first_name . ' ' . $key_receive_transaction->patient_last_name . '
                                    <br>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                    ' . $key_receive_transaction->financial_transaction_child_dr_related_name . '
                                    <br>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                     ' . $key_receive_transaction->financial_transaction_type . ' ' . $key_receive_transaction->financial_transaction_amount . '
                                    <br>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                    ' . $key_receive_transaction->financial_transaction_title . '
                                    <br>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                    <center>
                                        ' . $key_receive_transaction->financial_transaction_date . ' - ' . $key_receive_transaction->financial_transaction_time . '
                                        <br>
                                        <a href="' . route('financial.destroy', $key_receive_transaction->financial_transaction_id) . '" style="margin-top:10px;float:none!important;color: white; font-size: 13px; float: left;background-color:#5A738E;border:1px solid #5A738E; " class="btn btn-success" onclick="return confirm(\'Are you sure to delete This Financial Transaction?\') " title="Delete This Financial Transaction">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            Delete
                                        </a>
                                    </center>
                                </div>
                            </div>';
                            }

                            echo '
                            <center>
                                <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;" >
                                    <font size="+2" class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top:35px;border:2px solid green;border-radius:50px;" >
                                        Total of Received Transactions: +' . $sum_of_received_transactions . '
                                    </font>
                                </div>
                            </center>';
                        }
                        else
                        {
                            echo '
                            <center>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:35px;" >
                                    <font size="+2" class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top:0px;border:1px solid gray;border-radius:50px;" >
                                        No Received Financial Transaction Were Found
                                    </font>
                                </div>
                            </center>';
                        }
                    }


                    $sum_of_paid_transactions = '0';
                    $label_chart_money_paid = '';
                    $data_chart_money_paid = '';
                    if (isset($num_of_pay_transactions))
                    {
                        if ($num_of_pay_transactions > 0)
                        {
                            echo '
                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:35px;" >
                                <font size="+2" class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top:0px;border:1px solid gray;border-radius:50px;" > 
                                    Report of ' . $num_of_pay_transactions . ' Paid Financial Transactions 
                                    <br>
                                </font>
                            </div>';

                            foreach ($result_fetch_pay_transactions_from_date_to_date as $key_pay_transaction)
                            {
                                $sum_of_paid_transactions += $key_pay_transaction->financial_transaction_amount;
                                // make label chart string variable to use on charts.
                                $label_chart_money_paid .= '"' . $key_pay_transaction->financial_transaction_date . '" ,';
                                // make data chart string variable to use on charts.
                                $data_chart_money_paid .= $key_pay_transaction->financial_transaction_amount . ' ,';

                                echo '
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom:15px;border-bottom:1px solid gray;" >     
                                    <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                        ' . $key_pay_transaction->financial_transaction_id . '
                                        <br>';
                                        if (strlen($key_pay_transaction->financial_appointment_related_id) > 0) {
                                            echo '
                                            <a href="' . $key_pay_transaction->financial_appointment_related_id . '" style="font-weight:bolder;font-size:22px;" >
                                                <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                            </a>';
                                        }
                                    echo '
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                        ' . $key_pay_transaction->financial_patient_related_id . '
                                        <br>
                                        ' . $key_pay_transaction->patient_first_name . ' ' . $key_pay_transaction->patient_last_name . '
                                        <br>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                        ' . $key_pay_transaction->financial_transaction_child_dr_related_name . '
                                        <br>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                         ' . $key_pay_transaction->financial_transaction_type . ' ' . $key_pay_transaction->financial_transaction_amount . '
                                        <br>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                        ' . $key_pay_transaction->financial_transaction_title . '
                                        <br>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2" style="margin-top:25px;" >
                                        <center>
                                            ' . $key_pay_transaction->financial_transaction_date . ' - ' . $key_pay_transaction->financial_transaction_time . '
                                            <br>
                                            <a href="' . route('financial.destroy', $key_pay_transaction->financial_transaction_id) . '" style="margin-top:10px;float:none!important;color: white; font-size: 13px; float: left;background-color:#5A738E;border:1px solid #5A738E; " class="btn btn-success" onclick="return confirm(\'Are you sure to delete This Financial Transaction?\') " title="Delete This Financial Transaction">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                Delete
                                            </a>
                                        </center>
                                    </div>
                                </div>';
                            }

                            echo '
                            <center>
                                <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;" >
                                    <font size="+2" class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top:35px;border:2px solid red;border-radius:50px;" >
                                        Total of Paid Transactions: -' . $sum_of_paid_transactions . '
                                    </font>
                                </div>
                            </center>';
                        }
                        else
                        {
                            echo '
                            <center>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:35px;" >
                                    <font size="+2" class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top:0px;border:1px solid gray;border-radius:50px;" >
                                        No Paid Financial Transaction Were Found
                                    </font>
                                </div>
                            </center>';
                        }
                    }

                    // Estimate NET INCOME of clinic.
                    $net_income = $sum_of_received_transactions - $sum_of_paid_transactions;

                            echo '
                            <center>
                                <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;" >
                                    <font size="+2" class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top:35px;border:2px solid blue;border-radius:50px;" >
                                        Net Income <br> ';
                                            if (isset($financial_report_from_date))
                                            {
                                                echo 'from ' . $financial_report_from_date;
                                            }

                                            if (isset($financial_report_to_date))
                                            {
                                                echo ' to ' . $financial_report_to_date;
                                            }
                                        echo '
                                        <br>
                                        <font size="+4" style="color:blue" >
                                            ' . $net_income . '
                                        </font>
                                    </font>
                                </div>
                            </center>
                            
                            <hr style="width:1px;">
                            <hr style="width:1px;">
                            <hr style="width:1px;">
                            
                            <div class="col-md-6 col-sm-12 col-xs-12" style="margin-top:40px;" >
                                <center>
                                    <font size="+2" class="text-center" style="float:none;" >
                                        <span> Chart of ' . $num_of_pay_transactions . ' Paid Financial Transactions </span> 
                                    </font>
                                </center>
                                <div class="x_panel">
                                  <div class="x_content">
                                    <canvas id="lineChartpaid"></canvas>
                                  </div>
                                </div>
                            </div>
        
                            <div class="col-md-6 col-sm-12 col-xs-12" style="margin-top:40px;" >
                                <center>
                                    <font size="+2" class="text-center" style="float:none;" >
                                        <span> Chart of ' . $num_of_receive_transactions . ' Received Financial Transactions </span> 
                                    </font>
                                </center>
                                <div class="x_panel">
                                  <div class="x_content">
                                    <canvas id="lineChartreceive"></canvas>
                                  </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>';
                }

              echo '
			  </div>

		  </div>
		</div>
	
    </div>
</div>      
<!-- /page content -->' ;

// Call the footer include.
include 'layout/footer.php' ;
?>

<!-- Chart.js -->
<script>
Chart.defaults.global.legend = {
enabled: false
};

// Line chart receive
var ctx = document.getElementById("lineChartreceive");
var lineChart = new Chart(ctx, {
type: 'line',
data: {
  labels: [<?php echo $label_chart_money_receive ; ?>],
  datasets:
  [
      {
        label: "Received Money",
        backgroundColor: "rgba(38, 185, 154, 0.31)",
        borderColor: "rgba(38, 185, 154, 0.7)",
        pointBorderColor: "rgba(38, 185, 154, 0.7)",
        pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
        pointHoverBackgroundColor: "#fff",
        pointHoverBorderColor: "rgba(220,220,220,1)",
        pointBorderWidth: 1,
        data: [<?php echo $data_chart_money_receive ; ?>]
      }
  ]
},
});


// Line chart paid
var ctx = document.getElementById("lineChartpaid");
var lineChart = new Chart(ctx, {
type: 'line',
data: {
  labels: [<?php echo $label_chart_money_paid ; ?>],
  datasets:
  [
      {
        label: "Paid Money",
        backgroundColor: "rgba(3, 88, 106, 0.3)",
        borderColor: "rgba(3, 88, 106, 0.70)",
        pointBorderColor: "rgba(3, 88, 106, 0.70)",
        pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
        pointHoverBackgroundColor: "#fff",
        pointHoverBorderColor: "rgba(151,187,205,1)",
        pointBorderWidth: 1,
        data: [<?php echo $data_chart_money_paid ; ?>]
      }
  ]
},
});
</script>
<!-- Chart.js -->

