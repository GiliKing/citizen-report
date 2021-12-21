

<?php

require 'vendor/autoload.php';

// create the transport

$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))

    ->setUsername("YOUR EMAIL")
    ->setPassword("YOUR PASSWORD");


// create the mailer

$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($email, $token) {

    global $mailer;
    $body = '
    <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>Text Mail</title>

                <style>
                    .container {
                        padding: 20px;
                        color: #444;
                        font-size: 1.3em;
                    }
                    a {
                        background: #592f80;
                        text-decoration: none;
                        padding: 8px 15px;
                        border-radius: 5px;
                        color: white;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                   <p>Thank You for signing up on our site. Please click on the link below to verify your account:</p>
                   <a href="http://localhost/php-project/simple-ecommerce/verifyEmail.php?token=' . $token . '">Verify Email</a>
                </div>
            </body>
        </html>
    ';

    $message = (new Swift_Message('Verify Your Email'))
            ->setFrom(["YOUR EMAIL" => "YOUR NAME"])
            ->setTo($email)
            ->setBody($body, 'text/html');

    $result = $mailer->send($message);

    if($result > 0) {
        return true;
    } else {
        return false;
    }
}

?>
