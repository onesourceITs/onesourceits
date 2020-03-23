<?php
/*
    ** primary class for OneSource IT Home website**
*/
require_once '/var/www/html/server.php';
require_once 'class_emailHTML.php';

class OneSourceits extends ConnectMe
{

    // ========================
    // Do the Requested Action.
    // ========================

    public function doAction()
    {
        $action = (isset($_GET["action"])) ? filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING) : "";

        // Process the Action.
        if (strpos($action, ".") === false) {
            $method = $action;
            if (method_exists(__CLASS__, $method)) {
                $this->$method();
            }
        } else {
            $actionParts = explode(".", $action);
            $class = (isset($actionParts[0]) ? $actionParts[0] : "");
            $method = (isset($actionParts[1]) ? $actionParts[1] : "");

            if (method_exists($class, $method)) {
                $class = new $class();
                $class->$method();
                $class = null;
            }
        }
    }

    /*
        ** public method to insert into db **
        */

    public function Insert()
    {
        $conn = $this->connection();
        $email = (isset($_POST["email"])) ? filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING) : die();
        $subject = (isset($_POST["subject"])) ? filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING) : die();
        $message = (isset($_POST["message"])) ? filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING) : die();
        $date = Date('m-d-Y');

        try {
            $emailObj = new EmailHtml("info@onesourceits.com", "New OneSourceIT Contact Form Submitted", ["from" => $email, "subject" => $subject, "message" => $message]);
            if ($emailObj->SendEmail() === FALSE) {
                echo json_encode(["msg" => "badEmail"]);
                return false;
            }
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("INSERT INTO contacts(email, subject, message, date)
            VALUES(:email, :subject, :message, :date)");
            $sql->bindParam(':email', $email);
            $sql->bindParam(':subject', $subject);
            $sql->bindParam(':message', $message);
            $sql->bindParam(':date', $date);
            $sql->execute();

            echo json_encode(["msg" => "true"]);
        } catch (PDOException $e) {
            echo json_encode(["msg" => "Error Inserting data:" . $e->getMessage()]);
        }
    }
}
