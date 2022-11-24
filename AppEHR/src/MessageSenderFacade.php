<?php
namespace AppEHR\src;

use Illuminate\Support\Facades\Facade;

class MessageSenderFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return app(MessageSender::class) ;
    }

}