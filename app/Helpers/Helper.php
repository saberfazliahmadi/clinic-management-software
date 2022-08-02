<?php
use Illuminate\Support\Facades\Auth;

if (!function_exists('encrypt_decrypt'))
{
    function encrypt_decrypt($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = Auth::user()->created_at;
        $secret_iv  = Auth::user()->id;
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv  = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action === 'encrypt')
        {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        elseif ($action === 'decrypt')
        {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}

if (!function_exists('find_admin_id_from_users_table'))
{
    function find_admin_id_from_users_table()
    {
        // If the user has a parent_id so user_level = 'global.user_level' OR user_level = 'global.admin_level' ,So we return Auth::user()->parent_id
        if (strlen(Auth::user()->parent_id) > 0)
        {
            return Auth::user()->parent_id;
        }
        // If the user DOES NOT have parent_id so user_level='global.super_admin_level' , So we return Auth::user()->id
        return Auth::user()->id;
    }
}
