<?php
require_once 'C:\composer\vendor\autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    ->setUsername('christianaustria167@gmail.com')
    ->setPassword('ichannijonah16');

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($userEmail, $token)
{
    global $mailer;
    $body = '<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Test mail</title>
      <link rel="stylesheet" href="trytry.css">
      <style>
        .wrapper {
          padding: 20px;
          color: #444;
          font-size: 1.3em;
        }
        a {
          background: #592f80;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: #fff;
        }
      </style>
    </head>

    <body>
      <div class="container">
          <div class="wrapper">
              <img src="Icon/bulsu.png"/>
              <p>Thank you for signing up on our site. Please click on the link below to verify your account:.</p>
              <a href="http://localhost/ORJ/verify_email.php?token=' . $token . '">Verify Email!</a>
          </div>
      </div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message('Verify your email'))
        ->setFrom('christianaustria167@gmail.com')
        ->setTo($userEmail)
        ->setBody($body, 'text/html');


    // Send the message
    $result = $mailer->send($message);

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}
function sendVerificationEmailAdmin($userEmail, $token){
    global $mailer;
    $body = '<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Test mail</title>
      <link rel="stylesheet" href="trytry.css">
      <style>
        .wrapper {
          padding: 20px;
          color: #444;
          font-size: 1.3em;
        }
        a {
          background: #592f80;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: #fff;
        }
      </style>
    </head>

    <body>
      <div class="container">
          <div class="wrapper">
              <img src="Icon/bulsu.png"/>
              <p>Thank you for signing up on our site. Please click on the link below to verify your account:.</p>
              <a href="http://localhost/Nov.27,2019(1stpresentation)/testing/verify_emailadmin.php?token=' . $token . '">Verify Email!</a>
          </div>
      </div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message('Verify your email'))
        ->setFrom('christianaustria167@gmail.com')
        ->setTo($userEmail)
        ->setBody($body, 'text/html');


    // Send the message
    $result = $mailer->send($message);

    if ($result > 0) {
        return true;
    } else {
        return false;
    } 
}
function sendTokenForgotPassword($userEmail, $token){

    global $mailer;
    $body ='<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Test mail</title>
      <link rel="stylesheet" href="trytry.css">
      <style>
        .wrapper {
          padding: 20px;
          color: #444;
          font-size: 1.3em;
        }
        a {
          background: #592f80;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: #fff;
        }
      </style>
    </head>

    <body>
      <div class="container">
          <div class="wrapper">
              <img src="Icon/bulsu.png"/>
              <p>This is your Verification Code</p>
              <h3> '.$token.' </h3>
          </div>
      </div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message('Verification Code'))
        ->setFrom('christianaustria167@gmail.com')
        ->setTo($userEmail)
        ->setBody($body, 'text/html');


    // Send the message
    $result = $mailer->send($message);

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}
function sendTokenForgotPasswordAdmin($userEmail, $token){

    global $mailer;
    $body ='<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Test mail</title>
      <link rel="stylesheet" href="trytry.css">
      <style>
        .wrapper {
          padding: 20px;
          color: #444;
          font-size: 1.3em;
        }
        a {
          background: #592f80;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: #fff;
        }
      </style>
    </head>

    <body>
      <div class="container">
          <div class="wrapper">
              <img src="Icon/bulsu.png"/>
              <p>This is your Verification Code</p>
              <h3> '.$token.' </h3>
          </div>
      </div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message('Verification Code'))
        ->setFrom('christianaustria167@gmail.com')
        ->setTo($userEmail)
        ->setBody($body, 'text/html');


    // Send the message
    $result = $mailer->send($message);

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}