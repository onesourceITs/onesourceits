<?php

require_once '/home4/onesoux7/config/config.php';

if (isset($_GET["request"])){
    switch ($_GET["request"]){
        case "sendEmail":
        $newObj = new Contact;
        $newObj->sendEmail();
        break;
    }
}

class Contact {
    public function sendEmail(){
        // collect form data
        $from = $_POST["contactFrom"];
        $sbj = $_POST["contactSubject"];
        $message = $_POST["contactMsg"];

        $to = "info@onesourceits.com";
        $subject = "New email from potential client";
        $msgBody = "<!DOCTYPE HTML><html>
    <head>
    <meta charset='UTF-8'>
    <title> Contact form email </title>
    </head>
    <body>
    <div>
    <p>
    <br/>
    Email: ".$from."<br/>
    Subject: ".$sbj."<br/>
    Message: ".$message."<br/>
    <br/>
    </p>
    </div>
        </body>
        </html>";

    $headers ["from"] = "From: contact@onesourceits.com";
    $headers ["one"] = "Content-type:text/html";


    // send email
    $sendOut = mail($to, $subject, $msgBody, implode("\r\n", $headers));
    $text = @mail('3869729107@mms.cricketwireless.net, 3869721102@mms.att.net', '', 'Check Email! A new contact form has been submitted.');

    if ($sendOut === false){
        echo json_encode(["response" => 0]);
    }
    else{

        $add = $this->AddContact($from, $sbj, $message);
        if ($add === false){
            echo json_encode(["response" => 0]);
        } else {
            echo json_encode(["response" => 1]);
        }
    }
    
    }

    public function AddContact($email, $sbj, $msg){
        $connObj = new Connection;
        $conn = $connObj->dbConn();

        // post data
        $email = $email;
        $subject = $sbj;
        $message = $msg;
        $date = Date('m-d-Y');

        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO contacts(email, subject, message, date)
                VALUES(:email, :subject, :message, :date)";

            $stmt = $conn->prepare($sql);
            // bind the params
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':date', $date);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            echo "Error inserting contact data into db:".$e->getMessage();
        }
    }

}



?>