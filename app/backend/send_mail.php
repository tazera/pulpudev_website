<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/config.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/components/functions.php");

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 1. Check that the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

// 2. Check referrer to ensure the form was submitted from your website
$allowed_referrers = [
    'https://pulpudev.com/',
    'https://www.pulpudev.com/',
    'http://localhost/', // For development
];

$referrer = $_SERVER['HTTP_REFERER'] ?? '';
$valid_referrer = false;

foreach ($allowed_referrers as $allowed) {
    if (strpos($referrer, $allowed) === 0) {
        $valid_referrer = true;
        break;
    }
}

if (!$valid_referrer) {
    error_log("Invalid referrer: $referrer");
    header('Location: /?contact=failed&reason=security');
    exit;
}

// 3. Add a honeypot field check
// Note: Make sure to add this field to your form: <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">
if (!empty($_POST['website'])) {
    // If the hidden field was filled, it's likely a bot
    // Log the attempt but don't tell the bot it was detected
    error_log("Honeypot field filled - potential bot submission");
    // Pretend to process but redirect
    header('Location: /?contact=success'); // Fake success to confuse bots
    exit;
}

// 4. Rate limiting (simple version)
// Store the last submission time in the session
$current_time = time();
$min_time_between_submissions = 60; // seconds

if (
    isset($_SESSION['last_form_submission']) && 
    ($current_time - $_SESSION['last_form_submission']) < $min_time_between_submissions
) {
    header('Location: /?contact=failed&reason=rate');
    exit;
}

$_SESSION['last_form_submission'] = $current_time;

// Check CSRF token
if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
    // Invalid token, log the attempt and redirect
    error_log("CSRF token validation failed for form submission");
    header('Location: /?contact=failed&reason=security');
    exit;
}

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
    // Generate a new token for next time
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    header('Location: /?contact=success');
} else {
    header('Location: /?contact=failed');
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
