<?php
   /*
   * Collect all Details from Angular HTTP Request.
   */ 
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$items = $request;
    
    //echo 'data = ' + $items;
    
    $message = "<ul>";
    foreach($items as $item) {
      $message .= '<li>'.$item->name."</li>\n";
    }
    $message .= "</ul>";
    
    // echo '<h1>done!</h1>';
    
    $address = "nikitindiz@gmail.com"; // Your mail 

    $sub = "Price Request";

    $mes = $message;

    $send = mail($address,$sub,$mes,"Content-type:text/plain; charset = windows-1251\r\nFrom:$address");
    if ($send == 'true')
    {
    echo "<div>Request has been sent. We will reply you as soon as possible.</div>";
    }
    else 
    {
    echo "<div>Message was NOT sent!</div>";
    }    
    
     //this will go back under "data" of angular call.
    /*
     * You can use $email and $pass for further work. Such as Database calls.
    */    
?>