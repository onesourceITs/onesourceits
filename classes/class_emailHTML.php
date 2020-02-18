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
        $send = mail("info@onesourceits.com,".$this->to, $this->subject, $msg, implode("\r\n", $headers));
        return $send;
    }

    public function httpMsgBody()
    {
        $msgBody = "
            <!DOCTYPE HTML>
            <html>
            <head>
                <meta charset='UTF-8'>
                <title> Putnam Eats- Sign up for updates! </title>

                <style>
                    body {
                        font-family: 'arial';
                    }


                </style>
            </head>
            <body>
                <div style='border: 1px solid black;'>
                    <h2 style='text-align:center;'> Putnam Eats Updates</h2>
                    <p>Thank You for registering for updates to putnameats.com</p>
                    <p>If we have any major updates, an email will be sent out.  Once the project is complete, you will recieve an email letting you know!</p>
                    <br/><br/>
                    Thank You!<br/>
                    Web Master<br/>
                    OneSourceIT Solutions LLC<br/>
                    putnameats.com<br/>
                    onesourceits.com<br/>
                    <br/><br/>
                    <p><span style='color:red;'>NOTE:</span> To stop recieving emails from us, please click <a href='https://onesourceits.com/cancelemail.html?email=".$this->to."' >here</a></p>

                </div>
            </body>
        </html>";

        return $msgBody;
    }
}
