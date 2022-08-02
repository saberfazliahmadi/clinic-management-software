<?php
return [
    // The levels if user which will be check on middleware
    'guest_level'        => '0' ,
    '0'        => 'guest level' ,

    'user_level'         => '1' ,
    '1'        => 'user level' ,

    'admin_level'        => '2' ,
    '2'        => 'admin level' ,

    'super_admin_level'  => '3' ,
    '3'        => 'super admin level' ,

    // Class name of button based on user status
    'activated' => 'primary' ,
    'banned'    => 'warning' ,

    // Strings should be saved in database as status of user
    'active'   => 'activated' ,
    'ban'      => 'banned' ,

    // a definition rule of Regex for encrypted id that we have used in route.php
    'regex_rule_of_encrypted_id' => '[0-z--- ]+' ,
    'regex_rule_of_decrypted_id' => '[0-9]+'     ,
    'regex_rule_of_show_date'    => '[0-9--]+'   ,
];