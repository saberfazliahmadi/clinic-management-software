<?php
use Illuminate\Support\Facades\Auth;

echo '
<!-- page content -->
<div class="right_col" role="main">
   <hr>
    <div style="width: 100%;height: 80px;padding: 10px 0;margin-bottom:80px!important;" >
      <center>
         <h3 style="text-align:center;">
             '.Auth::user()->name.'
             <br>
         </h3>
      </center>
    </div>
    
    <div class="col-md-12 col-sm-12 col-xs-12 form_wizard wizard_horizontal" style="font-size:20px!important;" >
     '.Auth::user()->mobile_number.'
     </div>
      
       
    
</div>
<!-- /page content -->';
?>


