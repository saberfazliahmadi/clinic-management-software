<?php
namespace AppEHR;
use AppEHR\SenderEmail\Mailtrap;
use AppEHR\SenderEmail\Gmail;
use AppEHR\SenderSms\KavehNegar;
use AppEHR\SenderSocialMessengerBot\Bale;
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