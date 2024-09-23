<?php

namespace App\Traits;

use App\Mail\SendMailNotification;
use App\Models\EmailLog;
use Illuminate\Support\Facades\Mail;

trait SendEmailTrait
{
    use ErrorLogHandlerTrait;

    public function getEmialObj(): array
    {
        return [
            'to' => [],
            'cc' => [],
            'bcc' => [],
            'subject' => null,
            'contents' => null,
            'attachments' => [],
            'schedule_date_time' => date('Y-m-d H:i:s'),
            'is_send' => 1,
        ];
    }

    public function saveEmailLog($emialObj)
    {
        try {

            $email = new EmailLog;
            $email->to = json_encode($emialObj['to']);
            $email->cc = json_encode($emialObj['cc']);
            $email->bcc = json_encode($emialObj['bcc']);
            $email->subject = $emialObj['subject'];
            $email->contents = $emialObj['contents'];
            $email->attachments = json_encode($emialObj['attachments']);
            $email->schedule_date_time = $emialObj['schedule_date_time'];
            $email->is_send = $emialObj['is_send'];
            $email->save();

            if ($emialObj['is_send'] == 1) {

                $this->sendEmail($email);
            }
            return true;
        } catch (\Throwable $th) {
            $this->saveErrorLog($th);
        }
    }
    public function sendEmail($email)
    {
        try {

            $to = json_decode($email->to);
            $subject = $email->subject;
            $contents = $email->contents;
            $cc = json_decode($email->cc);
            $bcc = json_decode($email->bcc);
            $attachments = json_decode($email->attachments);

            try {

                Mail::to($to)
                    ->send(
                        new SendMailNotification(
                            $contents,
                            $subject,
                            $cc,
                            $bcc,
                            $attachments
                        )
                    );

            } catch (\Throwable $th) {
                $this->saveErrorLog($th);
            }
        } catch (\Throwable $th) {
            $this->saveErrorLog($th);
        }
    }
}
