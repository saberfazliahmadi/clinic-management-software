<?php
namespace AppEHR\Drivers\SenderEmail;

use App\LogTypes\LogTypes;
use App\Mail\EHRDetialsSent;
use Illuminate\Support\Facades\Mail;

// To check Emails were sent, check your gmail account
// Remember your Gmail account details should change in .env file
/**
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=www.matabeonline.com@gmail.com
MAIL_PASSWORD=*****
MAIL_ENCRYPTION=tls
 */
class Gmail
{
    public function send( $detail , $message )
    {
        Mail::to('saberfazliahmadi@gmail.com')->send(new EHRDetialsSent($detail , $message));

        if (Mail::failures())
        {
            LogTypes::runNormalLog('The Gmail Email was not sent') ;
        }
        else
        {
            LogTypes::runNormalLog('The Gmail Email was Successfully sent') ;
        }
    }
}