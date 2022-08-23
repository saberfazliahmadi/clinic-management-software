<?php
namespace AppEHR;
use AppEHR\SenderEmail\Gmail;
use AppEHR\SmsSender\KavehNegar;
use Illuminate\Support\Manager;

class MessageSender extends Manager
{
    public function getDefaultDriver()
    {
        return 'EmailSenderGmail' ;
    }

    public function createEmailSenderGmailDriver()
    {
        return new Gmail() ;
    }

    public function createSmsSenderKavehNegarDriver()
    {
        return new KavehNegar() ;
    }
}