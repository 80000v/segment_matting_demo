<?php
    $host = "https://aliapi.aisegment.com";
    $path = "/segment/matting";
    $method = "POST";
    $appcode = "5f6a636fe8204bc790a9e4b19f180b4e";//这块需要更换自己的appcode
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    //根据API的要求，定义相对应的Content-Type
    array_push($headers, "Content-Type".":"."application/json; charset=UTF-8");
    $querys = "";
    // $img = file_get_contents("upload/".$_GET['imgurl']);
    // $img = base64_encode($img);
    $img=$_POST['imgdata'];
    $bodys = "{\"type\":\"jpg\",\"photo\":\"".$img."\"}";
    $url = $host . $path;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
    $res=json_decode(curl_exec($curl));
    // var_dump($res->data ->result);
    // var_dump($bodys);
    //exit("<img src='{$res->data ->result}' />");
    $tmp=json_encode(array ('imgurl'=>$res->data ->result));  
    $callback = $_GET['callback'];  
    echo $callback.'('.$tmp.')';  
?>