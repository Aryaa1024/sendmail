<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        require base_path("vendor/autoload.php"); // Load PHPMailer

        $mail = new PHPMailer(true); // Enable PHPMailer exception handling

        try {
            // SMTP Configuration from .env
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST', 'smtp.gmail.com'); // SMTP Host
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME'); // Your Email
            $mail->Password = env('MAIL_PASSWORD'); // Your Email App Password
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls'); // Encryption (TLS)
            $mail->Port = env('MAIL_PORT', 587); // SMTP Port

            // Sender Details
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')); // Sender Email & Name
            $mail->addAddress($request->recipient_email); // Recipient Email from Form

            // Email Content
            $mail->isHTML(true);
            $mail->Subject = $request->subject;
            $mail->Body = nl2br($request->message); // Convert newlines to <br> in HTML

            // Attachment Handling
            if ($request->hasFile('attachment')) {
                $mail->addAttachment($request->file('attachment')->getRealPath(), $request->file('attachment')->getClientOriginalName());
            }

            // Send Email
            $mail->send();

            return back()->with("success", "✅ Email sent successfully!");
        } catch (Exception $e) {
            return back()->with("error", "❌ Email could not be sent. Error: {$mail->ErrorInfo}");
        }
    }
}