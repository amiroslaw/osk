
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
		$zapytanie = @$polaczenie->query("SELECT * FROM srodki_transportu");
		echo '<table> <tr>	
<th>Nr.</th>
<th>Marka</th> 
<th>Model</th>
<th>Rodzaj</th>  
<th>Nr. rejestracyjny</th> 
<th>Nr. ubezpieczenie</th> 
<th>Data ubezpieczenia</th> 
<th>Kategoria</th> 
<th>Stan techniczny</th> 
<th>Dostępność</th> 
</tr>';
// nie wiem czy dodać kategorie do jakiej jest pojazd objęty z innej bazy
// czy to przypadkiem nie to samo co rodzaj?
		while ($r = $zapytanie->fetch_array()) {
			echo "<tr> <td>$r[0]</td> <td>$r[1]</td> <td>$r[2]</td> <td>$r[3]</td>  <td>$r[6]</td>   <td>$r[7]</td> <td>$r[8]</td> <td>$r[10]</td>   <td>$r[5]</td> <td>$r[9]</td>  <td><a href='delete.php?id=$r[0]'>x</a></td> </tr> ";
		} 
		echo "</table>";
		$zapytanie->free_result();
	}
}else {
	echo "dostęp tylko dla upoważnionych, Zaloguj się. ";
}

@	$polaczenie->close();
?>
