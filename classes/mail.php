<?php

$send = mail('keith.blackwelder@onesourceits.com', 'testing', 'this is a test message');
if ($send === false){
    echo "something went wrong.";
} else {
    echo "everything was true.";
}



?>