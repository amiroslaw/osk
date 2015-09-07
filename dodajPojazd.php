
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
</tr>';
// nie wiem czy dodać kategorie do jakiej jest pojazd objęty z innej bazy
// czy to przypadkiem nie to samo co rodzaj?
		// zapisujemy wynik zapytania do tablicy asocjacyjnej 
		while ($r = $zapytanie->fetch_array()) {
			echo "<tr> <td>$r[0]</td> <td>$r[1]</td> <td>$r[2]</td> <td>$r[3]</td>  <td>$r[6]</td>   <td>$r[7]</td> <td>$r[8]</td> <td>$r[10]</td>    <td><a href='delete.php?id=$r[0]'>x</a></td> </tr> ";
		} 
		echo "</table>";
		$zapytanie->free_result();
	}
}else {
	echo "dostęp tylko dla upoważnionych, Zaloguj się. ";
}
// dodanie rekordu 
@$marka = mysqli_real_escape_string($polaczenie, $_POST['marka']); 
@$model = mysqli_real_escape_string($polaczenie, $_POST['model']); 
@$rejestr = mysqli_real_escape_string($polaczenie, $_POST['rejestr']); 
@$ubezp = mysqli_real_escape_string($polaczenie, $_POST['ubezp']); 
@$data_ubezp = mysqli_real_escape_string($polaczenie, $_POST['data_ubezp']); 
//sprawdzanie poprawności danych
if (isset($_POST['rodzaj']) )  
{ 
	$rodzaj = filter_var($_POST['rodzaj'], FILTER_VALIDATE_INT);
	$kategoria = filter_var($_POST['kategoria'], FILTER_VALIDATE_INT);
	if($rodzaj && $kategoria){
		@$rodzaj = mysqli_real_escape_string($polaczenie, $_POST['rodzaj']);
		@$kategoria = mysqli_real_escape_string($polaczenie, $_POST['kategoria']);
	}else{
		echo	"<span style='color:red; display:block; text-align:left;'> niepoprawna wartość pola</span> ";
	}        
}

if(!empty($marka) && !empty($model) && !empty($rodzaj)&& !empty($rejestr) && !empty($ubezp) && !empty($data_ubezp) && !empty($kategoria))
{
	$sql = "INSERT INTO srodki_transportu ( marka, model,rodzaj, nr_rejestracyjny, nr_ubezpieczenia, data_ubezpieczenia, KATEGORIE_idKategorie) VALUES ('$marka', '$model', '$rodzaj', '$rejestr', '$ubezp', '$data_ubezp', '$kategoria')";

	if(mysqli_query($polaczenie, $sql)){
		echo "Records added successfully.";
		header('refresh: 1;');
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($polaczenie);
	}
}

@	$polaczenie->close();
?>
<!-- formularz dodawania rekordu -->
<form action="<?php $_PHP_SELF ?>" method="post"> 
<p> 
<label for="marka">Marka:</label> 
<input type="text" name="marka" id="marka"> 
</p> 
<p> 
<label for="model">Model:</label> 
<input type="text" name="model" id="model"> 
</p> 
<p> 
<label for="rodzaj">Rodzaj:</label> <span>Do jakiej kategorii prawa jazdy pojazd jest przeznaczony</span> 
<input type="text" name="rodzaj" id="rodzaj"> 
</p> 
<p> 
<label for="rejestr">Numer rejestracyjny:</label> 
<input type="text" name="rejestr" id="rejestr"> 
</p> 
<p> 
<label for="ubezp">Numer ubezpieczenia:</label> 
<input type="text" name="ubezp" id="ubezp"> 
</p> 
<p> 
<label for="data_ubezp">Data ubezpieczenia:</label> 
<input type="text" name="data_ubezp" id="data_ubezp"> 
</p> 
<p> 
<label for="kategoria">Kategoria:</label> 
<input type="text" name="kategoria" id="kategoria"> 
</p> 
<input type="submit" value="Dodaj pojazd"> 
</form>
