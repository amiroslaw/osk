
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
<th>Nr. rejestracyjny</th> 
<th>Data przeglądu</th> 
<th>Data ubezpieczenia</th> 
<th>Stan techniczny</th> 
<th>Dostępność</th> 
</tr>';
// nie wiem czy dodać kategorie do jakiej jest pojazd objęty z innej bazy
// czy to przypadkiem nie to samo co rodzaj?
		// zapisujemy wynik zapytania do tablicy asocjacyjnej 
		while ($r = $zapytanie->fetch_array()) {
			echo "<tr ";  
if ($r[5]< "0" || $r[9]<"0") { echo 'style="color:red;"'; } 
			echo "> <td>$r[0]</td> <td>$r[6]</td> <td>$r[4]</td> <td>$r[8]</td>"; 
if ($r[5]<0) {
	echo "<td>zepsuty</td>";
}else {
	echo "<td>sprawny</td>";
}
if ($r[9]<0) {
	echo "<td>niedostępny</td>";
}else {
	echo "<td>dostępny</td>";
}
//  <td>$r[5]</td><td>$r[9]</td> 
echo " <td><a href='edytuj_pojazd.php?id=$r[0]'>Edytuj</a></td> </tr> ";
		} 
		echo "</table>";
		$zapytanie->free_result();
	}
}else {
	echo "dostęp tylko dla upoważnionych, Zaloguj się. ";
}

@	$polaczenie->close();
?>
