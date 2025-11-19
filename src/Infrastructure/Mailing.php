<?php
/**
 * Created by PhpStorm.
 * User: Dauda Ibrahim
 * Date: 22/10/2023
 * Time: 09:37 PM
 */

namespace App\Infrastructure;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailing extends App
{

    /**
     * @throws Exception
     */
    public function SendMail($params = []): array
    {
        $response = [
            'success' => 0,
            'message' => 'Missing parameter for mailing, try again!'
        ];
        if (!empty($params)) {
            extract($params);
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->Host = SMTP_HOST;
            $mail->Port = 465;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->SMTPSecure = "ssl";
            $mail->setFrom($from, $name_from);
            $mail->addAddress($to, $name_to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $response = [
                'success' => 0,
                'message' => 'Error sending mail, try again!'
            ];
            if ($mail->send()) {
                $response = [
                    'success' => 1,
                    'message' => 'Mail sent successfully!'
                ];
            }
            return $response;
        }
        return $response;
    }
}