<?php
// Add your custom css files here. (will be located in header section)
$extra_links_header = '' ;
$extra_links_footer = '' ;

// Call the header section
include_once 'layout/header.php' ;
?>
<style>
.modal-dialog {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
}

.modal-content {
    height: auto;
    min-height: 100%;
    border-radius: 0;
}
</style>
<?php

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
    
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:50px;">  
        <div class="clearfix"></div>
	
		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12" >
			
			  <hr style="width:1px;">
			  <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                <!-- Button trigger LOG modal -->
                <button type="button" class="col-md-12 col-sm-12 col-xs-12 btn btn-primary" data-toggle="modal" data-target="#log_data" style="margin:5px 5px 5px 5px;font-size:2.5vw;margin-top:20px;" >
                    Log Data 
                </button>
                
                <!-- START LOG Modal -->
                <div class="modal fade" id="log_data" tabindex="-100" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        
                          <div class="modal-header">
                            <div class="col-md-9" style="margin-top:20px;">
                                <h3 class="modal-title" id="exampleModalLabel"  >
                                    <center>
                                        Log Data
                                    </center>
                                </h3>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                    <span aria-hidden="true" style="font-size:74px!important;">&times;</span>
                                </button>
                            </div>
                          </div>
                          
                          <div class="modal-body" style="overflow: auto!important;" >
                            <pre>
                            '.$log_data.'
                            </pre>
                          </div>
                          
                        </div>
                    </div>
                </div>
                <!-- END of LOG Modal -->
                
			  </div>
		  </div>
		</div>
     
    </div>
</div>      
<!-- /page content -->' ;

// Call the footer
include_once 'layout/footer.php' ;
?>
