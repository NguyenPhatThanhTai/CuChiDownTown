<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoloader
require_once get_theme_file_path('service/vendor/autoload.php');

function send_confirmation_email($data) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';         // Use your SMTP provider if not Gmail
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_USERNAME;         // ✅ Your Gmail
        $mail->Password = EMAIL_PASS;             // ✅ Gmail App Password (not your Gmail login)
        $mail->SMTPSecure = 'tls';                         // Or use PHPMailer::ENCRYPTION_SMTPS
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom(EMAIL_USERNAME, 'CuChi');
        $mail->addAddress($data['email']);

        $checkin = $data['check_in'];
        $checkout = $data['check_out'];
        $code = $data['id'];

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Room Booking Confirmation';
        $mail->Body = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #eee;'>
            <img src='https://cuchi-template.vercel.app/img/cuchi-hero.png' alt='CuChi Banner' style='width: 100%; height: auto;' />
            <div style='padding: 20px;'>
                <h2 style='color: #2c3e50;'>Thanks for your booking!</h2>
                <p style='font-size: 16px; color: #555;'>
                    We are pleased to confirm your reservation for your vacation.
                </p>
                <p style='font-size: 16px; color: #555;'>
                    Your reservation code: <strong style='color: #714339;'>$code</strong>
                </p>
                <p style='font-size: 16px; color: #333;'>
                    Stay Dates: <strong>{$checkin}</strong> to <strong>{$checkout}</strong>
                </p>
                <p style='margin-top: 30px; font-size: 14px; color: #999;'>
                    If you have any questions, just reply to this email or contact us anytime.
                </p>
            </div>
            <img src='https://wallpapers.com/images/hd/tent-camping-desktop-7t9zgrtv4ifbk3ch.jpg' alt='CuChi Footer' style='width: 100%; height: auto;' />
        </div>
    ";


        // Send email
        $mail->send();
    } catch (Exception $e) {
        error_log("❌ Mail Error: " . $mail->ErrorInfo);
    }
}
