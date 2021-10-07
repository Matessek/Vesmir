<?php

$to_email = "matesssek@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Vaše rezervace byla úspěšně vytvořena";
$headers = "From: sender\'s email";
/*
if (mail($to_email, $subject, $body, $headers))
{
    echo "Email successfully sent to $to_email...";
}
else
{
    echo "Email sending failed...";
}
