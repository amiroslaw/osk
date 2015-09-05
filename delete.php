<?php

include('connect.php');
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
if(isset($_GET['id']))
{
$id=$_GET['id'];

echo $_SERVER['HTTP_REFERER']; 
$poprzedniaStrona= $_SERVER['HTTP_REFERER']; 
$tabTemp=explode("=", $poprzedniaStrona); 
$nazwaTabeli= $tabTemp[1];		// tabeli z bd
//dodana instrukcja switch aby nie trzeba było dodawać kilku plików delete dla każdej tabeli
switch ($nazwaTabeli) {
case 'instruktorzy':
$query1="delete from $nazwaTabeli where idINSTRUKTORZY='$id'";
	break;
case 'wykladowcy':
$query1="delete from $nazwaTabeli where idWykladowcy='$id'";
	break;
default:
	echo "wystąpił jakiś błąd"; 
	break;
}
if(mysqli_query($polaczenie,$query1))
{
// header('Location: index.php?page=instruktorzy');

mysqli_close($polaczenie);
// powrot do poprzedniej strony
header('Location: ' . $_SERVER['HTTP_REFERER']);
}else {
	echo "nie udało się usunąć"; 
}
}
?>
