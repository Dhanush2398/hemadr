<?php
    $filenameee =  $_FILES['file']['name'];
    $fileName = $_FILES['file']['tmp_name']; 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $usermessage = $_POST['message'];
    $phone = $_POST['phone'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $duration = $_POST['duration'];
    $service = $_POST['service'];
    
    $message ="Name = ". $name . "\r\nPhone = " . $phone .  "\r\nEmail = " . $email . "\r\nSex = " . $sex . "\r\nAge = " . $age . "\r\nDuration = " . $duration . "\r\nService = " . $service . "\r\nPresent Complaints =" . $usermessage; 
    
    $subject ="website Message";
    $fromname ="website Message";
    $fromemail = '';  
    $mailto = 'drhema1988@gmail.com';  

    $content = file_get_contents($fileName);
    $content = chunk_split(base64_encode($content));
   
    $separator = md5(time());
    // carriage return type (RFC)
    $eol = "\r\n";
    // main header (multipart mandatory)
    $headers = "From: ".$fromname." <".$fromemail.">" . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;
    // message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;
    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $filenameee . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";
    //SEND Mail
    if (mail($mailto, $subject, $body, $headers)) {
        header("Location:thankyou.html");
        
        
    } else {
        echo "mail send ... ERROR!";
        print_r( error_get_last() );
    }

    