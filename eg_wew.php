<?php
if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, 'mydb');
	$polaczenie->query("SET CHARSET utf8");
    $polaczenie->query ("SET NAMES `utf8` COLLATE `utf8_polish_ci`");

	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{

		$zapytanie = @$polaczenie->query("SELECT * FROM KLIENCI");

echo '<table> <tr>	<th>Lp.</th> <th>Imię</th>  <th>Nazwisko</th>  <th>Nr telefonu</th> <th>Typ</th><th>Obecności</th><th>Wyjeżdżone godziny</th><th>Data urodzenia</th><th>Ulica</th><th>Kod pocztowy</th><th>Nr domu</th><th>Miejscowość</th><th>E-mail</th><th>Płeć</th><th>Status kursu</th></tr>';
		// zapisujemy wynik zapytania do tablicy asocjacyjnej 
		while ($r = $zapytanie->fetch_array()) {
echo "<tr><td>$r[0]</td> <td>$r[1]</td> <td>$r[2]</td> <td>$r[3]</td> <td>$r[4]</td><td>$r[5]</td><td>$r[6]</td><td>$r[7]</td><td>$r[8]</td><td>$r[9]</td><td>$r[10]</td><td>$r[11]</td><td>$r[12]</td><td>$r[13]</td><td>$r[14]</td></tr> ";
		} 
echo "</table>";
		$zapytanie->free_result();
	}
}else {
	echo "dostęp tylko dla upoważnionych, Zaloguj się. ";
}

?>