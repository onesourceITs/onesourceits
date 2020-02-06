<?php
/*
                ** Handle info collected from contact form
*/

require_once 'config.php';

class Contact
{

    public $dbConn;
    
    public function __construct() {
        
    }
    public function addContact()
    {
        $conn = $this->dbConn();
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

            $sendEmail = $this->SendEmail($email, $subject, $message, $date);

            echo json_encode(["response" => 1]);
        } catch (PDOException $e) {
            echo "Error inserting contact data into db:" . $e->getMessage();
        }
    }

    public function SendEmail($email, $subject, $message, $date)
    {
        $to = "info@onesourceits.com";
        $subject = "New contact Request!";
        $msg = "You have a new form submission from main contact form.";

        $sendVerification = mail($to, $subject, $message);
        return $sendVerification;
    }
}
