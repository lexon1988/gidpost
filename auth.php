<?php

$auth=$_POST['auth'];

$api="https://api.vk.com/method/users.get?&access_token=".$auth;
$api_arr= json_decode(file_get_contents($api));


$uid=$api_arr->response[0]->uid;
$first_name=$api_arr->response[0]->first_name;
$last_name=$api_arr->response[0]->last_name;




setcookie("auth",$auth);
setcookie("uid",$uid);
setcookie("first_name",$first_name);
setcookie("last_name",$last_name);



header("Location: index.php");

?>