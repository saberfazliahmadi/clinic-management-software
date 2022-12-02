<?php
use Illuminate\Support\Facades\Auth;

if (!function_exists('encryptDecrypt'))
{
    function encryptDecrypt($action, $string)
    {
        $output         = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key     = findAdminIdFromUsersTable();
        $secret_iv      = findAdminIdFromUsersTable();
        // hash
        $key            = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv             = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action === 'encrypt')
        {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        elseif ($action === 'decrypt')
        {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output ;
    }
}

if (!function_exists('findAdminIdFromUsersTable'))
{
    function findAdminIdFromUsersTable()
    {
        if(Auth::user() !== null)
        {
            // If the user has a parent_id so user_level = 'global.user_level' OR user_level = 'global.admin_level' ,So we return Auth::user()->parent_id
            if (strlen(Auth::user()->parent_id) > 0)
            {
                return Auth::user()->parent_id;
            }
            // If the user DOES NOT have parent_id so user_level='global.super_admin_level' , So we return Auth::id()
            return Auth::id();
        }
    }
}