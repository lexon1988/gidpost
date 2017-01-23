<?php

$club=$_GET['club'];

$fp = fopen("temp/black_list.txt", "a"); // Открываем файл в режиме записи 
$mytext = $club."\r\n"; // Исходная строка
$test = fwrite($fp, $mytext); // Запись в файл
fclose($fp); //Закрытие файла



header("Location: ../index.php");
?>