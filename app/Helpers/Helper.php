<?php
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Crypt;
//use Illuminate\Contracts\Encryption\DecryptException;
//use App\Responses\Responses;
if (!function_exists('encryptDecrypt'))
{
    function encryptDecrypt($action, $string)
    {
        //try {
        //    if ($action === 'encrypt') {
        //        return Crypt::encryptString($string);
        //    } elseif ($action === 'decrypt') {
        //        return Crypt::decryptString($string);
        //    }
        //    return Responses::Failed('home', '', '<span style="color:blue;">we have an error to encrypt data!</span>');
        //}
        //catch (DecryptException $e)
        //{
        //    return Responses::Failed('home', '', '<span style="color:blue;">we have an error to encrypt data!</span>');
        //}

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
        // If the user has a parent_id so user_level = 'global.user_level' OR user_level = 'global.admin_level' ,So we return Auth::user()->parent_id
        if(strlen(Auth::user()->parent_id) > 0)
        {  return Auth::user()->parent_id ; }
        // If the user DOES NOT have parent_id so user_level='global.super_admin_level' , So we return Auth::id()
        return Auth::id();
    }
}
