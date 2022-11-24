<?php
namespace AppEHR\Drivers\SenderEmail;

use App\LogTypes\LogTypes;
use App\Mail\EHRDetialsSent;
use Illuminate\Support\Facades\Mail;

// To check Emails were sent, check your account on https://mailtrap.io
// Remember your Mailtrap account details should change in .env file
/**
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=161f1680ccf42d
MAIL_PASSWORD=de169407c0ae94
MAIL_ENCRYPTION=tls
 */
class Mailtrap
{
    public function send( $detail , $message )
    {
        Mail::to('saberfazliahmadi@gmail.com')->send(new EHRDetialsSent($detail , $message));

        if (Mail::failures())
        {
            LogTypes::runNormalLog('The Mailtrap Email was not sent') ;
        }
        else
        {
            LogTypes::runNormalLog('The Mailtrap Email was Successfully sent') ;
        }
    }
}