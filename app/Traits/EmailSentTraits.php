<?php
namespace App\Traits;

use App\Mail\EventJoinMail;
use Illuminate\Support\Facades\Mail;

trait EmailSentTraits{

    protected function simpleEmail($subject, $name, $email, $message){
        try{
            Mail::to($email)->send(new EventJoinMail($subject, $name, $message));
        }catch (\Exception $e){
            //
        }
    }

    protected function eventJoinEmail($email=null){
        // Send Mail
        $body = '<p>Thank you for your registration.</p><p>You have successfully registered for our event and we look forward to your attendance!</p>';
        if (auth()->check()){
            try{
                Mail::to(auth()->user()->email, auth()->user()->full_name)->bcc(env('ADMIN_NOTIFY_MAIL'))->send(new EventJoinMail("Event Registration Success", auth()->user()->full_name, $body));
            }catch (\Exception $e){
                //
            }
        }else{
            try{
                Mail::to($email)->bcc(env('ADMIN_NOTIFY_MAIL'))->bcc(env('ADMIN_NOTIFY_MAIL'))->send(new EventJoinMail("Event Registration", "", $body));
            }catch (\Exception $e){
                //
            }
        }

    }
    protected function contributionEmailNotification($amount, $email=null){
        // Send Mail
        $body = '<p>Thank you for your contribution.</p><p>Your contribution payment $'.$amount .' is success!</p>';
        if (auth()->check()){
            try{
                Mail::to(auth()->user()->email)->bcc(env('ADMIN_NOTIFY_MAIL'))->send(new EventJoinMail("New Contribution", auth()->user()->full_name, $body));
            }catch (\Exception $e){
                //
            }
        }else{
            try{
                Mail::to($email)->bcc(env('ADMIN_NOTIFY_MAIL'))->send(new EventJoinMail("New Contribution", "", $body));
            }catch (\Exception $e){
                //
            }
        }

    }

    protected function donationEmailNotification($amount, $email=null){
        // Send Mail
        $body = '<p>Thank you for your donation.</p><p>Your donation payment $'.$amount .' is success!</p>';
        if (auth()->check()){
            try{
                Mail::to(auth()->user()->email)->bcc(env('ADMIN_NOTIFY_MAIL'))->send(new EventJoinMail("Donation Success", auth()->user()->full_name, $body));
            }catch (\Exception $e){
                //
            }
        }else{
            try{
                Mail::to($email)->bcc(env('ADMIN_NOTIFY_MAIL'))->send(new EventJoinMail("Donation Success", "", $body));
            }catch (\Exception $e){
                //
            }
        }

    }
}
