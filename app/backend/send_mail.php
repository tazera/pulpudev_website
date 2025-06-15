<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/config.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/components/functions.php");

// Import necessary PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Make sure autoload is included
require_once("{$_SERVER['DOCUMENT_ROOT']}/vendor/autoload.php");

// Collect form data
$fullName = $_POST['fullName'] ?? '';
$companyName = $_POST['companyName'] ?? '';
$workEmail = $_POST['workEmail'] ?? '';
$phoneNumber = $_POST['phoneNumber'] ?? '';
$serviceInterest = $_POST['serviceInterest'] ?? '';
$otherService = isset($_POST['otherService']) && !empty($_POST['otherService']) ? "(" . $_POST['otherService'] . ")" : '';
$message = $_POST['message'] ?? '';
$referralSource = $_POST['referralSource'] ?? '';
$otherReferral = isset($_POST['otherReferral']) && !empty($_POST['otherReferral']) ? "(" . $_POST['otherReferral'] . ")" : '';

// Compose email body
$email_body = "
    <h2>New Contact Form Submission</h2>
    <p><strong>Name:</strong> {$fullName}</p>
    <p><strong>Company:</strong> {$companyName}</p>
    <p><strong>Email:</strong> {$workEmail}</p>
    <p><strong>Phone:</strong> {$phoneNumber}</p>
    <p><strong>Service Interest:</strong> {$serviceInterest} {$otherService}</p>
    <p><strong>Message:</strong><br>{$message}</p>
    <p><strong>Referral Source:</strong> {$referralSource} {$otherReferral}</p>
";

// Send to both recipients
$recipients = [
    'sales@pulpudev.com',
    'pulpudev@gmail.com'
];

$success = true;
foreach ($recipients as $recipient) {
    $result = send_mail(
        $smtp_server,
        $sender_email,
        $password,
        $sender_name,
        $recipient,
        'PulpuDEV Sales',
        'New Contact Form Submission from ' . $fullName,
        $email_body,
        $_FILES['attachments'] ?? null
    );
    if ($result !== 'success') {
        $success = false;
    }
}

if ($success) {
    header('Location: /pages/home/home.php?contact=success');
} else {
    header('Location: /pages/home/home.php?contact=failed');
}
exit;


function send_mail($smtp_server, $sender_email, $password, $sender_name, $recipient_email, $recipient_name, $email_title, $email_body, $attachments = null)
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        /*$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output*/
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = $smtp_server; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = $sender_email; //SMTP username
        $mail->Password = $password; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($sender_email, $sender_name);
        $mail->addAddress($recipient_email, $recipient_name); //Add a recipient

        // Add reply-to with the sender's email
        $mail->addReplyTo($workEmail ?? $sender_email, $fullName ?? $sender_name);

        //Attachments
        if ($attachments && !empty($attachments['name'][0])) {
            $file_count = count($attachments['name']);

            for ($i = 0; $i < $file_count; $i++) {
                // Skip if there was an error with the upload
                if ($attachments['error'][$i] !== UPLOAD_ERR_OK) {
                    continue;
                }

                // Check file size (limit to 10MB)
                if ($attachments['size'][$i] > 10 * 1024 * 1024) {
                    continue;
                }

                $mail->addAttachment(
                    $attachments['tmp_name'][$i],
                    $attachments['name'][$i]
                );
            }
        }

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = $email_title;
        $mail->Body = $email_body;
        $mail->AltBody = strip_tags(str_replace(['<br>', '<br/>', '<br />'], "\n", $email_body));

        $mail->send();
        return 'success';
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return 'failed';
    }
}
