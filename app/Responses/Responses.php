<?php
namespace App\Responses;
use App\Responses\HtmlResponses\HtmlResponses;
use App\Responses\JsonResponses\JsonResponses;
use Illuminate\Support\Facades\Facade;

class Responses extends Facade
{
    // To be compatible our code with Laravel 9.x we over-write $cached from main Facade file
    protected static $cached = false ;

    // We made this facade method to support responses of HTML or VUE clients
    public static function getFacadeAccessor()
    {
       if( request('client') !== 'json' )
       {
           return HtmlResponses::class ;
       }
        return JsonResponses::class ;
    }
}