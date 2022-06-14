<?php

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
require '../PHPMailer/src/Exception.php'; 
require '../PHPMailer/src/PHPMailer.php'; 
require '../PHPMailer/src/SMTP.php'; 
$mail = new PHPMailer; 
$mail->isSMTP();                      // Set mailer to use SMTP 
$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;               // Enable SMTP authentication 
$mail->Username = 'tun.realty@gmail.com';   // SMTP username 
$mail->Password = '988adminhayk';   // SMTP password 
$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 587;    
// Sender info 
$mail->setFrom('tun.realty@gmail.com', 'Tun Relty'); 
$mail->addReplyTo('tun.realty@gmail.com', 'Tun Relty');

include "../edb/functions.php";
$db = new EDB("../edb/databases/userinfo.edb", "none", "User Info");

$email = $_POST["email"];
$phone = $_POST["phone"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$pass = $_POST["pass"];
$rePass = $_POST["re-pass"];

if ($name != "") {
    if ($surname != "") {
        if (strlen($pass) >= 6) {
            if ($rePass == $pass) {
                $access= true;
                for ($i = 0; $i < count($db->content); $i++) {
                    $table = $db->content[$i];
                    if ($table[3][1] == $email) {
                        $access = false;
                        if ($table[6][1] == "none") {
                            header("Location: ../login?msg=1");
                        } else {
                            header("Location: ../signin?msg=0");
                        }
                        break;
                    }
                }
                if ($access) {
                    $verification_code = "".random_int(0, 9).random_int(0, 9).random_int(0, 9).random_int(0, 9).random_int(0, 9).random_int(0, 9);
                    $table = [
                        "user" . count($db->content),
                        ["name", $name],
                        ["surname", $surname],
                        ["email", $email],
                        ["phone", [$phone]],
                        ["pass", $pass],
                        ["verification", "none"],
                        ["image", "none"],
                        ["viber", "false"],
                        ["whatsapp", "false"],
                        ["phone_deleted", ["false"]],
                        ["comment", []],
                        ["comment_to", []],
                        ["comment_access", []],
                        ["rate", []],
                        ["rate_to", []],
                        ["rate_access", []],
                        ["deleted", "false"],
                        ["delete_access", "none"],
                        ["verification_code", $verification_code],
                    ];
                    
                    // Add a recipient 
                    $mail->addAddress($email);
                    // Set email format to HTML 
                    $mail->isHTML(true); 
                    // Mail subject 
                    $mail->Subject = 'Tun Realty Verification CODE';
                    // Mail body content 
                    $bodyContent = '
                    <h1 style="text-align: center;">Սեղմեք Հաստատել՝ վերիֆիկացման համար</h1>
                    <h2 style="text-align: center;">(Press Confirm to Verificate)</h2>
                    ';
                    // ========================================================================================
                    // ========================================================================================
                    // ========================================================================================
                    // ========================================================================================
                    // ========================================================================================
                    $bodyContent .= '
                    <a style="transition-duration: 0.15s; display:block; text-decoration: none; border-radius: 12px; margin: 0 auto; box-sizing: border-box; width: min-content; padding: 4px 20px; background-color: #33aaee; color: #ffffff; text-shadow: 0 0 3px #000000;" href="localhost/signin/verification.php?code=' . $verification_code . '&userID=' . $table[0] . '">
                        <p style="font-size: 120%; line-height: 65%;">Հաստատել</p>
                        <p style="font-size: 100%; line-height: 65%; text-align: center">(Confirm)</p>
                    </a>'; 
                    $mail->Body = $bodyContent;
    
                    if(!$mail->send()) { 
                        header("Location: ../signin?msg=3");
                        echo $mail->ErrorInfo;
                    } else { 
                        $db->addinDB($table);
                        header("Location: ../login?msg=1");
                    }
                }
            }
        }
    }
}

// user{code} {
//     "name"
//     "surname"
//     "email"
//     "phone" : ["+3749999999"]
//     "pass"
//     "type" : ["ogtater", "ayl gorcakalutyun", "mer gorcakalutyun", "pre-admin", "admin", "superadmin"]
//     "image" : "none"
//     "viber" : []
//     "whatsapp" : []
//     "payment card"
//     "comment" : []
//     "comment_to" : []
//     "comment_access" : [ true/false ]
//     "rate" : []
//     "rate_to" : []
//     "rate_access" : [ true/false ]
// }

// // passport

// user{code} {
//     "name"
//     "surname"
//     "Patronimyc name"
//     "serial number"
//     "issuing authority"
//     "date of issue"
//     "date of birth"
//     "selfie" : "none"
// // House

