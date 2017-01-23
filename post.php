<?php

$auth=trim($_COOKIE['auth']);


$comment= trim(urlencode($_POST['comment']));
$to_id=trim($_POST['to_id']);
$wall_id=trim($_POST['wall_id']);



$captcha_key=trim($_POST['captcha_key']);
$captcha_sid=trim($_POST['captcha_sid']);


$api= "https://api.vk.com/method/wall.createComment?owner_id=".$to_id."&post_id=".$wall_id."&message=".$comment."&captcha_key=".$captcha_key."&captcha_sid=".$captcha_sid."&access_token=".$auth;


$api_arr=json_decode(file_get_contents($api));

if($error_code=$api_arr->error->error_code<>""){
echo "<meta charset='utf-8'>";
echo "<small>";
print_r($api_arr);
echo "</small>";
echo "<hr>";

$error_code=$api_arr->error->error_code;
$captcha_img=$api_arr->error->captcha_img;
$captcha_sid=$api_arr->error->captcha_sid;


echo "
<div style='width:200px; margin:0 auto;'>

<img src='".$captcha_img."'>

<br>
<form action='post.php' method='post'>


<input type='hidden'  name='comment' value='".$comment."'>
<input type='hidden'  name='to_id' value='".$to_id."'>
<input type='hidden'  name='wall_id' value='".$wall_id."'>
<input type='hidden'  name='captcha_sid' value='".$captcha_sid."'>
<input type='text' size='25' name='captcha_key'>

<br><br>
<input type='submit' value='Отправить'>
</form>


</div>
";

}else{
	
	
	header("Location: temp/forward.php");
	
}









?>