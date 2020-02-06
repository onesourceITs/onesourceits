<?php

/*
                ** main class for OneSourceIT
*/
require_once 'class_contact.php';

class OneSource
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
}
