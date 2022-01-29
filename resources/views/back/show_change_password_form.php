<?php

// Add your custom css files here. (will located in header)
$extra_links_header = '
' ;

// Add your custom js files here. (will located in footer)
$extra_links_footer = '
' ;

// call the header include.
include 'layout/header.php' ;

echo '
<!-- page content -->
<div class="right_col" role="main">
   
    <div style="width: 100%;height: 80px;padding: 10px 0;margin-bottom:100px;" >
      <center>
         <h3 style="text-align:center;">
             '.$title_of_page.'
             <br>
         </h3>
      </center>
    </div>
    
    <center>
    
    <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;" >
      
        <a href="#more_information_about_site_pass_changer" class="fancybox-buttons" id="various1" >
            <div class="well" >
                <h2 class="text-center" >
                    <span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:#ccc;margin-left:5px;"></span>
                    Guide for changing your password
                    <br>
                    (Must be Read)
                </h2>
            </div>
        </a>
        
        <!-- START of login fancy console panel -->
        <div style="display:none;overflow:hidden;" >
            <br>
            <div id="more_information_about_site_pass_changer" style="font-size:19px;" >
        
                The password must consist of the letters A to Z and the numbers 0 to 9 and must be longer than 4 letters.
                <br>
                Make sure your new password is strong and unpredictable.
                <br>
                Password does not mean your personal email password.
                <br>
                English capital letters &nbsp; : &nbsp; Using uppercase letters in uppercase mode increases the time it takes to crack a password more than you can imagine.
                <br>
                Numbers &nbsp; : &nbsp; Use numbers where it makes sense to use them, because if you do not follow the correct order, it will be difficult to remember them in later uses.
                <br>
                English lowercase letters &nbsp; : &nbsp; In English writing, when we write a name or a country name, the first letter should be uppercase but the next letters should be lowercase. You will be amazed at the effect of this little trick on the strength of your password.
                <br>
                Password length &nbsp; : &nbsp; The strength of the code is more about how long it is, not how complex it is! Instead of an 8 to 10 letter code consisting of meaningless words, use a long code code of several words, with the structure described above.
                <br>
                Use multiple passwords. &nbsp; Assuming all the above points are true, if you use the same password for all your accounts, it means that no matter how strong that password is, breaking it will jeopardize your entire online identity, and not just that. By breaking it, the password of your bank accounts will also fall into the hands of thieves.
                <br>
                Try never to use the same password for different accounts, and if you have trouble migrating from one password to another, at least use this effective trick: a password for social networks,
                A password for bank accounts,
                And a password for email. In this way, by losing one of the passwords, you will not face multiple problems in all three areas at once.
                <br>
                Use words that are not easy to guess. Using longer phrases, combining numbers and letters, as well as combining uppercase and lowercase letters in the password, will increase the security of your password.
                <br>
                Personalize the unit password for each account. Imagine for a second you were transposed into the karmic driven world of Earl
                <br>
                But to increase your security, do a little trick, and that is to add Twitter: to the end of the same password for your Twitter account. Or to the bottom of the Facebok password, Facebook and to the bottom of the Redd: Reddit password. In this case, you still strengthen your passwords while maintaining simplicity.
                <br>
                Note: Most of the intrusions on the Internet into other people\'s user information are due to the low security of their passwords. Use terms such as 123456, abcdef, 111111, zzzzzz, ... as well as use terms that are familiar to others, such as \'. $ OSTAD.\' IDs, email addresses, etc., which are not difficult for an intruder to guess, will increase the likelihood that others will infiltrate your user information. Therefore, by choosing the right password in accordance with the principles mentioned, increase the security factor of your password.
                <br>
                
                <br>
            </div>
        </div>
        <!-- END of login fancy console panel -->
        
        
        <div class="col-md-12" >
            <form method="post" action="'.route('run_change_password_form').'" >
                <input type="hidden" name="_token" value="'.csrf_token().'" >
                <input type="hidden" name="_type" value="post" >
                <h4 style="float:left;" > Please enter your current password | Minimum 8 Characters </h4>
                <input type="password" name="current_password" value="" min="4" max="60" required="required" data-requiredmsg="Please enter your current password" title="Please enter your current password | Minimum 8 Characters"  alt="Please enter your current password" placeholder="Type your Current Password | Minimum 8 Characters" class="form-control col-md-12 col-xs-12" autocomplete="off" aria-expanded="false" style="margin-bottom:20px;" />
                <Br>
                <Br>
                <h4 style="float:left;" > Type New password | Minimum 8 Characters </h4>
                <input type="password" name="new_password" value="" min="4" max="60" required="required" data-requiredmsg="Please type a new password" title="Please type a new password | Minimum 8 Characters" alt="Please type a new password" placeholder="Type New password | Minimum 8 Characters" class="form-control col-md-12 col-xs-12" autocomplete="off" aria-expanded="false" style="margin-bottom:20px;" />
                <Br>
                <Br>
                <h4 style="float:left;" > Type New password | Minimum 8 Characters </h4>
                <input type="password" name="retype_new_password" value="" min="4" max="60" required="required" data-requiredmsg="Please repeat the new password" title="Please Re-type the new password | Minimum 8 Characters" alt="Please Re-type the new password | Minimum 8 Characters" placeholder="Re-type the new password | Minimum 8 Characters" class="form-control col-md-12 col-xs-12" autocomplete="off" aria-expanded="false" style="margin-bottom:20px;" />
                <Br>
                <Br>
                <div class="form-group" style="margin-top:40px;">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
                    
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-success btn-group-justified uiuxtrick" style="margin-bottom:0px;margin-right:0px;font-size:28px;position: fixed;bottom: 0px;right: 0px;z-index: 1;"  >
                                Update Password
                            </button>				
                        </div>
                        
                    </div>
                </div>
                <Br>
            </form>
        </div>
    
    </div>
    <center>
      
</div>
<!-- /page content -->' ;

// Call the footer include.
include 'layout/footer.php' ;
?>

<script>

</script>


