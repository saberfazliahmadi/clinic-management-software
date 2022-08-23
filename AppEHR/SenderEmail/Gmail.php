<?php
namespace AppEHR\SenderEmail;
class Gmail
{
    public function send( $detail , $message )
    {
        echo 'The '.$message.' Sent to'. $detail ;
    }
}