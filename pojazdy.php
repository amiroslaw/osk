
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
		// $zapytanie = @$polaczenie->query("SELECT * FROM srodki_transportu");
		$zapytanie = @$polaczenie->query("SELECT srodki_transportu.idPojazdy, srodki_transportu.marka, srodki_transportu.model,srodki_transportu.nr_rejestracyjny, srodki_transportu.nr_ubezpieczenia, srodki_transportu.data_ubezpieczenia, kategorie.kategoria, srodki_transportu.stan_techniczny, srodki_transportu.dostępnosc 
 FROM srodki_transportu, kategorie
WHERE srodki_transportu.KATEGORIE_idKategorie=kategorie.idKategorie ");
		echo '<table> <tr>	
<th>Nr.</th>
<th>Marka</th> 
<th>Model</th>
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
			echo "<tr ";  
if ($r[7] < "0" || $r[8]<"0") { echo 'style="color:red;"'; } 
echo "> <td>$r[0]</td> <td>$r[1]</td> <td>$r[2]</td> <td>$r[3]</td>  <td>$r[4]</td>   <td>$r[5]</td> <td>$r[6]</td>";
if ($r[7]<0) {
	echo "<td>zepsuty</td>";
}else {
	echo "<td>sprawny</td>";
}
if ($r[8]<0) {
	echo "<td>niedostępny</td>";
}else {
	echo "<td>dostępny</td>";
}
// <td>$r[7]</td>   <td>$r[8]</td> 
 echo "<td><a href='delete.php?id=$r[0]'>x</a></td> </tr> ";
			
		} 
		echo "</table>";
		$zapytanie->free_result();
	}
}else {
	echo "dostęp tylko dla upoważnionych, Zaloguj się. ";
}

@	$polaczenie->close();
?>
