<! DOCTYPE html>
<html>
<head></head>
<body>

<?php 
define ('DB_QUERRY_ERROR', -2);


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
@$imie = mysqli_real_escape_string($polaczenie, $_POST['imie']); 
@$nazwisko = mysqli_real_escape_string($polaczenie, $_POST['nazwisko']); 
@$nr_telefonu = mysqli_real_escape_string($polaczenie, $_POST['nr_telefonu']); 
@$typ = mysqli_real_escape_string($polaczenie, $_POST['typ']); 
@$liczba_obecnosci_wyklady = mysqli_real_escape_string($polaczenie, $_POST['liczba_obecnosci_wyklady']);
@$wyjezdzone_godziny = mysqli_real_escape_string($polaczenie, $_POST['wyjezdzone_godziny']); 
@$data_urodzenia = mysqli_real_escape_string($polaczenie, $_POST['data_urodzenia']); 
@$ulica = mysqli_real_escape_string($polaczenie, $_POST['ulica']);
@$kod_pocztowy = mysqli_real_escape_string($polaczenie, $_POST['kod_pocztowy']); 
@$nr_mieszkania = mysqli_real_escape_string($polaczenie, $_POST['nr_mieszkania']); 
@$miejscowosc = mysqli_real_escape_string($polaczenie, $_POST['miejscowosc']);
@$email = mysqli_real_escape_string($polaczenie, $_POST['email']); 
@$plec = mysqli_real_escape_string($polaczenie, $_POST['plec']); 
@$status_kursu = mysqli_real_escape_string($polaczenie, $_POST['status_kursu']);
@$id= $_POST['id'];

if(!empty($imie) && !empty($nazwisko) && !empty($nr_telefonu)&& !empty($typ))
{
// dodawanie rekordu do bazy danych 

$sql = "INSERT INTO KLIENCI (imie, nazwisko, nr_telefonu, typ, liczba_obecnosci_wyklady, wyjezdzone_godziny, data_urodzenia, ulica, kod_pocztowy, nr_mieszkania, miejscowosc, email, plec, status_kursu) VALUES ( null, '$imie', '$nazwisko','$nr_telefonu','$typ', '$liczba_obecnosci_wyklady', '$wyjezdzone_godziny', '$data_urodzenia','$ulica','$kod_pocztowy','$nr_mieszkania', '$miejscowosc','$email' '$plec', '$status_kursu')";

if(mysqli_query($polaczenie, $sql)){

    echo "Dodano!";
header('refresh: 1;');
} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($polaczenie);

}}
//@$id= $_POST['id'];
 function modUser ( $imie, $nazwisko, $adres, $nr_telefonu){
	$query = "UPDATE KLIENCI SET imie='$imie', nazwisko='$nazwisko','adres='$adres', 'nr_telefonu= '$nr_telefonu' WHERE id=$id";
	
	if (!mysqli_query($query)){
		return DB_QUERRY_ERROR;
	}
	return mysql_affected_rows();
 }
if (!empty($id))
{
	if (isset ($_POST['id'])&&isset ($_POST['imie'])&&
	isset($_POST['nazwisko'])&& isset($_POST['adres'])&&
	isset($_POST['nr_telefonu'])){
		$id=$_POST['id'];
		$imie=$_POST['imie'];
		$nazwisko=$_POST['nazwisko'];
		//$adres=$_POST['adres'];
		$nr_telefonu=$_POST['nr_telefonu'];
		
		$result = modUser( $id,$imie, $nazwisko,$adres,$nr_telefonu);
		
		if($result == DB_QUERRY_ERROR){
			$komunikat = "Bład edycji.";
		} else {
			$komunikat="Edycja ok.";
			$kmunikat="Liczba edycji: $result";
		}
	} else {
		$komunikat="Brak parametrów";
	}
}

	@	$polaczenie->close();
?>

<form action="<?php $_PHP_SELF ?>" method="post"> 
    <p> 
        <label for="imie">Imię:</label> 
        <input type="text" name="imie" id="imie"> 
    </p> 
    <p> 
        <label for="nazwisko">Nazwisko:</label> 
        <input type="text" name="nazwisko" id="nazwisko"> 
    </p> 
     
  <p> 
        <label for="nr_telefonu">Nr telefonu:</label> 
        <input type="text" name="nr_telefonu" id="nr_telefonu"> 
    </p> 
	<p>
		<label for="typ">Typ:</label> 
        <input type="text" name="typ" id="typ"> 
	</p>
    <p> 
        <label for="liczba_obecnosci_wyklady">Obecności:</label> 
        <input type="text" name="liczba_obecnosci_wyklady" id="liczba_obecnosci_wyklady"> 
    </p> 
    <p> 
        <label for="wyjezdzone_godziny">Liczba wyjeżdzonych godzin:</label> 
        <input type="text" name="wyjezdzone_godziny" id="wyjezdzone_godziny"> 
    </p> 
	  <p> 
        <label for="data_urodzenia">Data urodzenia:</label> 
        <input type="text" name="data_urodzenia" id="data_urodzenia"> 
    </p> 
    <p> 
        <label for="ulica">Ulica:</label> 
        <input type="text" name="ulica" id="ulica"> 
    </p> 
    <p> 
        <label for="kod_pocztowy">Kod pocztowy:</label> 
        <input type="text" name="kod_pocztowy" id="kod_pocztowy"> 
    </p> 
	  <p> 
        <label for="nr_mieszkania">Nr domu/mieszkania:</label> 
        <input type="text" name="nr_mieszkania" id="nr_mieszkania"> 
    </p> 
    <p> 
        <label for="miejscowosc">Miejscowość:</label> 
        <input type="text" name="miejscowosc" id="miejscowosc"> 
    </p> 
	
	<p> 
        <label for="email">E-mail:</label> 
        <input type="text" name="email" id="email"> 
    </p> 
    <p> 
        <label for="plec">Płeć:</label> 
        <input type="text" name="plec" id="plec"> 
    </p> 
	<p> 
        <label for="status_kursu">Status kursu:</label> 
        <input type="text" name="status_kursu" id="status_kursu"> 
    </p> 
    <input type="submit" value="Dodaj klienta"> 
</form>


<form action="<?php $_PHP_SELF ?>" method="post"> 
   
		<label for ="id">Edytuj rekord:</label>
		<input type="text" name="id" id="id">
		<input type="submit" value="Edytuj">
</form>


</body>
</html>
