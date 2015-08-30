<?php 
// session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
	echo "zawartość strony Klienci.php";
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

		$zapytanie = @$polaczenie->query("SELECT * FROM uzytkownicy");

echo '<table> <tr>	<th>Nr.</th> <th>Imię</th>  <th>Nazwisko</th>  <th>Email</th> </tr>';
		// zapisujemy wynik zapytania do tablicy asocjacyjnej 
		while ($r = $zapytanie->fetch_array()) {
echo "<tr> <td>$r[0]</td> <td>$r[1]</td> <td>$r[2]</td> <td>$r[4]</td> </tr> ";
		} 
echo "</table>";
		$zapytanie->free_result();
		$polaczenie->close();


	}
}else {
	echo "dostęp tylko dla upoważnionych, Zaloguj się. ";
}
?>


