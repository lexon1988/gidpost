<?php

$club=$_GET['club'];

$fp = fopen("temp/black_list.txt", "a"); // ��������� ���� � ������ ������ 
$mytext = $club."\r\n"; // �������� ������
$test = fwrite($fp, $mytext); // ������ � ����
fclose($fp); //�������� �����



header("Location: ../index.php");
?>