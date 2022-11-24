<?php
namespace AppEHR\Drivers\SenderSms;
class KavehNegar
{
    public function send($detail , $message)
    {
        echo 'The '.$message.' Sent to'. $detail ;
    }
}