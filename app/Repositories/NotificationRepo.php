<?php

namespace App\Repositories;

use App\Notifications\EmailNotification;
use OneSignal;

class NotificationRepo {
    public static function sendEmailToUser($user, $subject, $body){
        try{
            $user->notify(new EmailNotification($subject, $body, $user->full_name));
        }catch(\Exception $e){
            //
        }
        return true;
    }

    public static function sendOneSignal($text, $url = '', $image = null){
        OneSignal::sendNotificationToAll($text, $url, $image);

        return true;
    }
}
