<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ProjectExceptions\SendingMessageError;
use App\Http\Controllers\Controller;
use CodersStudio\SmsRu\Facades\SmsRu;
use Exception;
use Illuminate\Support\Facades\Mail;

class SendCodeController extends Controller
{
    public function sendEmailCode($toEmail, $code)
    {
        try {
            $html = "Здравствуйте, подтвердите Ваш адрес электронной почты для приложения NikahTime с помощью кода проверки из данного сообщения
            <strong> $code </strong>,
            <p>Если Вы не запрашивали код подтверждения для выполнения операции в NikahTime, проигнорируйте данное сообщение.</p>";
            Mail::send([], [], function ($message) use ($toEmail, $html) {
                $message->from('nikah.time@yandex.ru', 'NikahTime');
                $message->to($toEmail);
                $message->subject('Подтверждение электронной почты');
                $message->setBody($html, 'text/html');
            });
            return 'ok';
        } catch (Exception $e) {
            throw new SendingMessageError($toEmail);
        }
    }
    public function sendPhoneCode($toPhone, $code){
            $isSent = SmsRu::send($toPhone, 'Ваш код подтверждения в NikahTime: '.$code.'. Если Вы не запрашивали код подтверждения, проигнорируйте данное сообщение.');
            if(!$isSent){
                throw new SendingMessageError($toPhone);
            }else {
                return 'ok';
            }
    }

}
