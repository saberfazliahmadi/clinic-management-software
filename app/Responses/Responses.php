<?php
namespace App\Responses;
use App\Responses\HtmlResponses\HtmlResponses;
use App\Responses\JsonResponses\JsonResponses;
use Illuminate\Support\Facades\Facade;

class Responses extends Facade
{
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