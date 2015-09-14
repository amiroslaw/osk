
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
		$zapytanie = @$polaczenie->query("SELECT * FROM jazdy ORDER BY termin_rozpoczecia");
		echo '<table> <tr>	
<th>Data rozpoczęcia</th> 
<th>Data zakończenia</th> 
<th>Instruktor</th> 
<th>Klient</th>
<th>Nr. pojazdu</th>
</tr>';
// czy to przypadkiem nie to samo co rodzaj?
		// zapisujemy wynik zapytania do tablicy asocjacyjnej 
		while ($r = $zapytanie->fetch_array()) {
			echo "<tr> <td>$r[4]</td> <td>$r[5]</td> <td>$r[2]</td> <td>$r[3]</td>  <td>$r[1]</td>  <td><a href='edytuj_jazdy.php?id=$r[0]'>Edytuj</a></td>   <td><a href='delete.php?id=$r[0]'>x</a></td> </tr> ";
		} 
		echo "</table>";
		$zapytanie->free_result();
	}
}else {
	echo "dostęp tylko dla upoważnionych, Zaloguj się. ";
}
// dodanie rekordu 
// $rozpoczecie = mysqli_real_escape_string($polaczenie, $_POST['rozpoczecie']); 
@$rozpoczecie =  $_POST['rozpoczecie']; 
// $data= new DateTime($rozpoczecie);
// $rozpoczecie=date(“Y-m-d H:i:s”);
@$zakonczenie = mysqli_real_escape_string($polaczenie, $_POST['zakonczenie']); 
@$instruktor = mysqli_real_escape_string($polaczenie, $_POST['instruktor']); 
@$pojazd = mysqli_real_escape_string($polaczenie, $_POST['pojazd']); 
@$klient = mysqli_real_escape_string($polaczenie, $_POST['klient']); 
//sprawdzanie poprawności danych
// if (isset($_POST['rodzaj']) )  
// { 
// 	$rodzaj = filter_var($_POST['rodzaj'], FILTER_VALIDATE_INT);
// 	$kategoria = filter_var($_POST['kategoria'], FILTER_VALIDATE_INT);
// 	if($rodzaj && $kategoria){
// 		@$rodzaj = mysqli_real_escape_string($polaczenie, $_POST['rodzaj']);
// 		@$kategoria = mysqli_real_escape_string($polaczenie, $_POST['kategoria']);
// 	}else{
// 		echo	"<span style='color:red; display:block; text-align:left;'> niepoprawna wartość pola</span> ";
// 	}        
// }

if(!empty($rozpoczecie) && !empty($zakonczenie) && !empty($instruktor)&& !empty($pojazd) && !empty($klient) )
// if(!empty($rozpoczecie) && !empty($instruktor)&& !empty($pojazd) && !empty($klient) )
{
	$sql = "INSERT INTO jazdy ( idPojazdy, idINSTRUKTORZY,KLIENCI_idKLIENT, termin_rozpoczecia, termin_zakonczenia) VALUES ('$pojazd', '$instruktor', '$klient', '$rozpoczecie', '$zakonczenie')";
	// $sql = "INSERT INTO jazdy ( idPojazdy, idINSTRUKTORZY,KLIENCI_idKLIENT, termin_rozpoczecia ) VALUES ('$pojazd', '$instruktor', '$klient', '$rozpoczecie')";

	if(mysqli_query($polaczenie, $sql)){
		echo "Records added successfully.";
		header('refresh: 1;');
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($polaczenie);
	}
}else{
echo	"<span style='color:red; display:block; text-align:left;'> pusty formularz</span> ";
}

$zap = @$polaczenie->query("SELECT * FROM instruktorzy ");
while ($array[]=$zap->fetch_object()) ;

	$polaczenie->close();
?>
<!-- formularz dodawania rekordu -->
<form action="<?php $_PHP_SELF ?>" method="post"> 
<p> 
<label for="rozpoczecie">Data rozpoczęcia:</label>  <span>Data rozpoczęcia jazd </span> 
<input type="datetime-local" name="rozpoczecie" id="rozpoczecie" required> 
</p> 
<p> 
<label for="zakonczenie">Data zakończenia:</label> 
<input type="datetime-local" name="zakonczenie" id="zakonczenie" required> 
</p> 
<p> 
<label for="instruktor">Instruktor:</label> 
<select name="instruktor" id="instruktor" required>
<?php
foreach ($array as $option) {
?>
      <option value="<?php echo $option->idINSTRUKTORZY; ?>"> <?php echo $option->imie ?> </option>
<?php
}
?>
</select>
</p> 
<!-- <p>  -->
<!-- <label for="instruktor">Instruktor:</label>  -->
<!-- <input type="text" name="instruktor" id="instruktor"required>  -->
<!-- </p>  -->
<p> 
<label for="klient">Klient:</label> 
<input type="text" name="klient" id="klient"required> 
</p> 
<p> 
<label for="pojazd">Pojazd:</label> 
<input type="text" name="pojazd" id="pojazd"required> 
</p> 
<!-- <p>  -->
<!-- <label for="rodzaj">Rodzaj:</label> <span>Do jakiej kategorii prawa jazdy pojazd jest przeznaczony</span>  -->
<!-- <input type="text" name="rodzaj" id="rodzaj">  -->
<!-- </p>  -->
<input type="submit" value="Dodaj termin jazdy"> 
</form>
