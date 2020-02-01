<?php
require_once 'config.php';

if (isset($_GET["request"])){
    switch ($_GET["request"]){
        case "check":
            addContact();
        break;
    }
}


function addContact(){
    $connObj = new Connection;
    $conn = $connObj->dbConn();
    // post data
        $email = $_POST["contactFrom"];
        $subject = $_POST["contactSubject"];
        $message = $_POST["contactMsg"];
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

            echo json_encode(["response" => 1]);
        }
        catch (PDOException $e) {
            echo "Error inserting contact data into db:".$e->getMessage();
        }
    }



?>