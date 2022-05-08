<?php

use Illuminate\Support\Facades\Auth;

function encrypt_decrypt($action, $string )
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = Auth::user()->created_at ;
    $secret_iv = Auth::user()->id ;
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function find_admin_id_from_users_table()
{
    // If the user has a parent_id so user_type='user' and we use Auth::user()->parent_id
    if( strlen(Auth::user()->parent_id) > 0 )
    {
        return $admin_id_from_users_table = Auth::user()->parent_id ;
    }
    // If the user DOES NOT have parent_id so user_type='admin' and we use Auth::user()->id
    return $admin_id_from_users_table = Auth::user()->id ;
}
