<?php
namespace AppEHR\Drivers\SenderSocialMessengerBot;
class Bale
{
    public function send( $message , $detail )
    {
        echo 'The message send by Bale bot'.$message.$detail ;

        //// https://iamamir.ir/%d8%b1%d8%a8%d8%a7%d8%aa-%d8%a8%d9%84%d9%87-%d8%a8%d8%a7-php?unapproved=95&moderation-hash=78ee33b2732e57149b42bdded730d548#comment-95
        //// https://github.com/Eleirbag89/TelegramBotPHP
        //include 'Telegram.php';
        //
        //$bot_token = '1457079734:LXSSiDQZ2mZg5ytZOhVFR2rHaeaKsckzairmNZKe';
        //$telegram = new Telegram($bot_token);
        //
        //$admin_chat_id = '1457079734';
        //
        //$text       = $telegram->Text();
        //$username   = $telegram->Username();
        //$name       = $telegram->FirstName();
        //$family     = $telegram->LastName();
        //$message_id = $telegram->MessageID();
        //$user_id    = $telegram->UserID();
        //$chat_id    = $telegram->ChatID();
        //$msgType    = $telegram->getUpdateType();
        //
        //// handle command
        //if($text == '/start'){
        //    $content = array('chat_id' => $chat_id,'reply_to_message_id' => $message_id, 'text' => "سلام رفیق");
        //    $telegram->sendMessage($content);
        //    die();
        //}else if($text == '/help'){
        //    $content = array('chat_id' => $chat_id,'reply_to_message_id' => $message_id, 'text' => 'کمک لازم داره؟');
        //    $telegram->sendMessage($content);
        //    die();
        //}
        //
        ////send message information
        //$content = array('chat_id' => $admin_chat_id, 'text' => "اطلاعات پیام: \n
        //chat id: ".$chat_id."\nfirst name: ".$name."\nusername: @".$username);
        //$telegram->sendMessage($content);
        //
        //// forward message to admin
        //$content = array('chat_id' => $admin_chat_id,'message_id' => $message_id, 'from_chat_id' => $chat_id );
        //$telegram->forwardMessage($content);
        //
        //// say sent success
        //$content = array('chat_id' => $chat_id,'reply_to_message_id' => $message_id, 'text' => 'پیام باموفقیت دریافت شد');
        //$telegram->sendMessage($content);
        //
        ///** مقدار BOT_TOKEN رو به توکن ربات خودتون و YOUR_CHAT_ID رو با چت آیدی خودتون جایگزین کنین.
        //و در آخر webhook تون رو ست کنید:
        // * ست کردن وب ‌هوک ربات بله دقبقا مثل ربات تلگرام هست
        //فقط کافی هست مقدار [BOT_TOKEN] و [YOUR_DOMAIN] با توکن و ادرس خودن عوض کنید!
        // */
        //// https://tapi.bale.ai/bot[BOT_TOKEN]/setwebhook?url=https://[YOUR_DOMAIN]
        //// $response = Http::post("");
    }
}