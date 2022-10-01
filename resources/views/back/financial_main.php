<?php
// Add your custom css files here. (will located in header)
$extra_links_header = '' ;
// Add your custom js files here. (will located in footer)
$extra_links_footer = '' ;

// Call the header include.
include_once 'layout/header.php' ;
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
				
				<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:30px;" >
			  		<a href="'.route('financial.create').'" class="btn btn-success btn-group-justified" style="font-size:21px;" >
                        ' . $cms_menu_title_data_from_middleware[21] . '
 					</a>
				</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:30px;" >
			  		<a href="'.route('financial.index').'" class="btn btn-success btn-group-justified" style="font-size:21px;" >
  						' . $cms_menu_title_data_from_middleware[22] . '
					</a>
				</div>
				
			</div>

		  </div>
		</div>
    </div>
    </div>
</div>      
<!-- /page content -->' ;

// Call the footer include.
include_once 'layout/footer.php' ;