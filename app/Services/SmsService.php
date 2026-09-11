<?php

namespace App\Services;

use Kavenegar\KavenegarApi;
use Illuminate\Support\Facades\Log;
use Throwable;

class SmsService
{

// send reset password code message
    public function sendForgotPasswordCode(
        string $phoneNumber,
        string $code
    ): bool {
        $message = "کد بازیابی رمز عبور شما: {$code}";

        return $this->send(
            phoneNumber: $phoneNumber,
            message: $message
        );
    }


// send success register message
    public function sendRegistrationSuccess(
        string $phoneNumber,
        string $name
    ): bool {
        $message = "{$name} عزیز، ثبت‌نام شما با موفقیت انجام شد.";

        return $this->send(
            phoneNumber: $phoneNumber,
            message: $message
        );
    }


// send simple message
    private function send(
        string $phoneNumber,
        string $message
    ): bool {
        try {
            $receiver = $this->formatForSms($phoneNumber);

            $apiKey = config('kavenegar.apikey');
            $sender = config('kavenegar.sender');

            if (empty($apiKey)) {
                Log::error('کلید API کاوه‌نگار تنظیم نشده است.');

                return false;
            }

            Log::info('Checking Kavenegar Config', [
                'key' => $apiKey, 
                'sender' => $sender, 
                'receiver' => $receiver
            ]);

            $api = new KavenegarApi($apiKey);

            $api->Send(
                $sender,
                $receiver,
                $message
            );

            return true;
        } catch (Throwable $exception) {
            Log::error('خطا در ارسال پیامک کاوه‌نگار', [
                'phone_number' => $phoneNumber,
                'message'      => $exception->getMessage(),
                'file'         => $exception->getFile(),
                'line'         => $exception->getLine(),
            ]);

            return false;
        }
    }


// convert phone number format 
    private function formatForSms(string $phoneNumber): string
    {
        $phoneNumber = preg_replace('/\D+/', '', $phoneNumber);

        if (str_starts_with($phoneNumber, '98')) {
            return '0' . substr($phoneNumber, 2);
        }

        if (str_starts_with($phoneNumber, '9')) {
            return '0' . $phoneNumber;
        }

        return $phoneNumber;
    }
}
