
<?php 
ob_start();  //przy problemie z nagłówkiem
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	$polaczenie->query("SET CHARSET utf8");
	$polaczenie->query ("SET NAMES `utf8` COLLATE `utf8_polish_ci`");

	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
$zapytanie = @$polaczenie->query("SELECT grupy.idGrupa,grupy.nazwa, kategorie.kategoria, wykladowcy.imie, wykladowcy.nazwisko
 FROM grupy, kategorie, wykladowcy
WHERE grupy.idKategorie=kategorie.idKategorie AND grupy.idWykladowcy=wykladowcy.idWykladowcy
ORDER BY grupy.idGrupa");
		echo '<table> <tr>	
<th>Nr.</th>
<th>Nazwa grupy</th> 
<th>Kategoria</th>
<th>Wykladowca</th> 
</tr>';
		while ($r = $zapytanie->fetch_array()) {
			echo "<tr> <td>$r[0]</td> <td>$r[1]</td> <td>$r[2]</td> <td>$r[3] $r[4]</td> <td><a href='edytuj_grupy.php?id=$r[0]'>Edytuj</a></td> </tr> ";
			
		} 
		echo "</table>";
		$zapytanie->free_result();
	}
}else {
	echo "dostęp tylko dla upoważnionych, Zaloguj się. ";
}

@	$polaczenie->close();
?>
