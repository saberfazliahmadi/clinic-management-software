<?php
namespace AppEHR\src;
use AppEHR\Drivers\SenderEmail\Gmail;
use AppEHR\Drivers\SenderEmail\Mailtrap;
use AppEHR\Drivers\SenderSms\KavehNegar;
use AppEHR\Drivers\SenderSocialMessengerBot\Bale;
use Illuminate\Support\Manager;

class MessageSender extends Manager
{
    public function getDefaultDriver()
    {
        return new Gmail() ;
    }

    public function createGmailDriver()
    {
        return new Gmail() ;
    }

    public function createMailtrapDriver()
    {
        return new Mailtrap() ;
    }

    public function createSmsSenderKavehNegarDriver()
    {
        return new KavehNegar() ;
    }

    public function createBaleBotDriver()
    {
        return new Bale() ;
    }
}