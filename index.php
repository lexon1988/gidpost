
<meta charset='utf-8'>

<style>

td{
	

	width:30%;
	
}

a { 
	
	text-decoration: none; /* Отменяем подчеркивание у ссылки */

} 

</style>

<div style='width:1000px; border:0px solid grey; padding:20px; margin:0 auto;'>

<?php


echo "<table width=100%><tr><td>";


echo "Положение счёткичка: ";
echo $counter=file_get_contents("temp/counter.txt");

//группа
$club_file=file("acc/clubs.txt");
$club=trim($club_file[$counter]);
$club_id=substr($club,1);

echo " <br> Группа: <a href='https://vk.com/club".$club_id."' target='_blank'>vk.com/club".$club_id."</a>  ";

$uid=$_COOKIE['uid'];
$first_name=$_COOKIE['first_name'];
$last_name=$_COOKIE['last_name'];






echo "
</td>
";


echo "<td style='text-align:center;'>

<a href='temp/black_list.php?club=".$club."'>Black list</a>

<h1>
<a href='temp/back.php'><</a>
<a href='temp/forward.php'>></a>
</h1>

</td>";



echo "
<td style='text-align:right;'>

<a href='http://vk.com/id".$uid."'>".$first_name." ".$last_name."</a>
<br>


<form action='auth.php' method='post'>
<input type='text' size='30' name='auth' value=".$_COOKIE['auth'].">
<input type='submit' value='Отправить'>
</form>
</td></tr>
</table>

<hr>

";







echo "<br>";

$api= "http://api.vk.com/method/wall.get?owner_id=".$club."&count=10";
$api_post=file_get_contents($api);
$wall_arr=json_decode($api_post);

/*
print_r($wall_arr->response[2]);
echo "<hr>";
*/


for($i=1;$i<11;$i++){

echo "<div style='padding:10px; ' >";



echo "<table width=100%><tr><td style='vertical-align: top;'>";


if($wall_arr->response[$i]->attachments[0]<>""){

	echo "<img src='".$wall_arr->response[$i]->attachments[0]->photo->src_big."' width=300em>";

}else{
	
		echo "<img src='acc/nofoto.jpg' width=300em>";
	
}

echo "</td><td style='vertical-align: top; width:100%; padding-left:30px;'>";


$comments= $wall_arr->response[$i]->comments->count;
$wall_id= $wall_arr->response[$i]->id;
$to_id=$wall_arr->response[$i]->to_id;

echo "<a href='http://vk.com/wall".$to_id."_".$wall_id."'  target='_blank'>wall".$to_id."_".$wall_id."</a> (comments: ".$comments.")";



echo "<hr>";
echo substr($wall_arr->response[$i]->text,0,350);
echo "<br><br>";



echo "

<form action='post.php' method='post'>

<input type='hidden' value='".$to_id."' name='to_id'>
<input type='hidden' value='".$wall_id."' name='wall_id'>

<textarea cols='50' rows='5' name='comment'></textarea>
<br>
<input type='submit' value='Отправить'>

</form>
";


echo "</td></tr></table>";







echo "</div><hr>";


}
?>






</div>