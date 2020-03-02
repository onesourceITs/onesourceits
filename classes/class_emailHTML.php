<?php
/*
    ** Class to send out html email **
*/

class EmailHtml
{
    public $to;
    public $subject;
    public $dataArray;

    function __construct($to, $subject, $dataArray)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->dataArray = $dataArray;
    }

    public function SendEmail()
    {
        $msg = $this->httpMsgBody();

        /* ** LINE BELOW, is what tells the mail client or mail browser to read the email as html  ** */
        $headers["one"] = "Content-type:text/html";

        /* ** the implode function is not nessicary, but is if your passing more than one header, so I left it like this. ** */
        $send = mail($this->to, $this->subject, $msg, implode("\r\n", $headers));
        return $send;
    }

    public function httpMsgBody()
    {
        $msgBody = "
            <!DOCTYPE HTML>
            <html>
            <head>
                <meta charset='UTF-8'>
                <title> New Contact form submission</title>

                <style>
                    body {
                        font-family: 'arial';
                    }


                </style>
            </head>
            <body>
                <div style='border: 1px solid black;'>
                    <h2 style='text-align:center;'> Contact Submission</h2>
                    <p>Contact Email: " . $this->dataArray["from"] . "</p>
                    <p>Contact Subject: " . $this->dataArray["subject"] . "</p>
                    <p>Contact Message: " . $this->dataArray["message"] . "</p>
                    <br/><br/>
                    Thank You!<br/>
                    Web Master<br/>
                </div>
            </body>
        </html>";

        return $msgBody;
    }
}
