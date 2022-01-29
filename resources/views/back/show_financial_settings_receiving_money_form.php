<?php

// Add your custom css files here. (will located in header)
$extra_links_header = '
' ;

// Add your custom js files here. (will located in footer)
$extra_links_footer = '
<!-- jQuery Tags Input -->
<script src="'.url('back/vendors/jquery.tagsinput/src/jquery.tagsinput.js').'"></script>
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
				
				<form method="post" action="'.route('store_financial_settings_receiving_money_form').'" >
                    <input type="hidden" name="_token" value="'.csrf_token().'" >
                    
					 <div class="col-md-12" >

						<center>
							
							<label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;font-size:19px;font-weight:normal;" >
								Please enter the name of the service and the cost of the service only in the below format in example,
                                <br>
                                and then press the ENTER key on your keyboard for the next service
                                <br>
                                Finally press "Save Financial Service Types" which located at the end of this page
							</label>
							
							<label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:25px;margin-top:15px;font-size:19px;font-weight:normal;" >
								 <span data-toggle="collapse" data-target="#more_details" class="btn-primary btn-lg" type="button" style="cursor:pointer;color:gray;background-color:white;border:1px solid #bfbdbd;" >
                                     <span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:#ccc;margin-left:5px;" ></span>
                                     Example 
                                 </span>
								
								<div id="more_details" class="collapse col-md-12 col-sm-12 col-xs-12">
								<center>
									<div class="well col-md-12" align="center" style="float:none;" >
                                        <div class="well col-md-6 text-center"  style="float:none;" >
                                            Service name: Amount of your desire money of this service
                                        </div>
                                        <div class="well col-md-4" align="center" style="float:none;" >
                                            Visit Patient : 50000
                                        </div>
                                    </div>
								</center>
								</div>
							</label>
																					
						</center>

						<div class="col-md-12 col-sm-12 col-xs-12" style="font-size:22px!important;"  >
						   <textarea id="tags_0" type="text" name="financial_management" class="tags form-control" >'.Auth::user()->financial_management.'</textarea>
						  <div id="suggestions-container" ></div>
						</div>
						<hr style="width:1px;">
						<hr style="width:1px;">
						<hr style="width:1px;">
						<hr style="width:1px;">
						<hr style="width:1px;">
						<hr style="width:1px;">
						<button type="submit" name="setting_status" value="true" class="btn btn-success btn-group-justified" style="font-size:27px;position: fixed;bottom: 0px;right: 0px;z-index: 1;" >
							Save Financial Service Types
						</button>	

					  </div>
			
					</div>

				</form>

			</div>

		  </div>
		</div>
	
		
    
    </div>
</div>      
<!-- /page content -->' ;

// Call the footer include.
include 'layout/footer.php' ;
?>


<!-- jQuery Tags Input -->
<script>
	  function onAddTag(tag) {
		alert("Add Item: " + tag);
	  }

	  function onRemoveTag(tag) {
		alert("Detele Item: " + tag);
	  }

	  function onChangeTag(input, tag) {
		alert("Change Item: " + tag);
	  }

	  $(document).ready(function() {
		$('#tags_0').tagsInput({
		  width: 'auto' ,
		  height: 'auto'
		});
	  });
	</script>
<!-- /jQuery Tags Input -->

