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
		// $zapytanie = @$polaczenie->query("SELECT * FROM jazdy ORDER BY termin_rozpoczecia");
		$zapytanie = @$polaczenie->query("SELECT jazdy.idJAZDY, jazdy.termin_rozpoczecia, jazdy.termin_zakonczenia, instruktorzy.imie, instruktorzy.nazwisko, klienci.imie,klienci.nazwisko, srodki_transportu.nr_rejestracyjny
				FROM jazdy, instruktorzy, klienci, srodki_transportu
				WHERE instruktorzy.idINSTRUKTORZY=jazdy.idINSTRUKTORZY AND jazdy.KLIENCI_idKLIENT=klienci.idKLIENT AND jazdy.idPojazdy=srodki_transportu.idPojazdy
				ORDER BY termin_rozpoczecia");
		// zapytania do lis rozwijanych w formularzu
		$zapListaInstruktorow = @$polaczenie->query("SELECT * FROM instruktorzy");
		$zapListaKlientow = @$polaczenie->query("SELECT * FROM klienci");
		$zapListaPojazdow = @$polaczenie->query("SELECT * FROM srodki_transportu");
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
			// echo "<tr> <td>$r[4]</td> <td>$r[5]</td> <td>$r[2]</td> <td>$r[3]</td>  <td>$r[1]</td>  <td><a href='edytuj_jazdy.php?id=$r[0]'>Edytuj</a></td>   <td><a href='delete.php?id=$r[0]'>x</a></td> </tr> ";
			echo "<tr> <td>$r[1]</td> <td>$r[2]</td>  <td>$r[3] $r[4] </td> <td>$r[5] $r[6]</td>  <td>$r[7]</td>  <td><a href='edytuj_jazdy.php?id=$r[0]'>Edytuj</a></td>   <td><a href='delete.php?id=$r[0]'>x</a></td> </tr> ";
		} 
		echo "</table>";
		$zapytanie->free_result();
	}
}else {
	echo "dostęp tylko dla upoważnionych, Zaloguj się. ";
}
// dodanie rekordu 
@$zakonczenie = mysqli_real_escape_string($polaczenie, $_POST['zakonczenie']); 
@$instruktor = mysqli_real_escape_string($polaczenie, $_POST['instruktor']); 
@$klient = mysqli_real_escape_string($polaczenie, $_POST['klient']); 
// sprawdzanie sprawności pojazdu 
if (isset($_POST['pojazd'])) { 
	$idPojazdu= $_POST['pojazd'];
	$zapMonit = @$polaczenie->query(" SELECT `stan_techniczny`, `dostępnosc` FROM `srodki_transportu` WHERE `idPojazdy`=$idPojazdu");
	$z=$zapMonit->fetch_array();
	if($z[0]>0 && $z[1]>0){
		@$pojazd = mysqli_real_escape_string($polaczenie, $_POST['pojazd']); 
		// @$polaczenie->query(" UPDATE srodki_transportu SET `dostępnosc`=-2 WHERE `idPojazdy`=$idPojazdu");
	}else{
		echo	"<span style='color:red; display:block; text-align:left;'>Pojazd niedostępny </span> ";
	}        
	// sprawdzanie zajętości pojazdu 
	if (isset($_POST['rozpoczecie'])) { 
		@$noweRozpoczecie =  $_POST['rozpoczecie']; 
		@$noweZakonczenie =  $_POST['zakonczenie']; 
//obliczanie rozniczy przy czasie jazdy 
		$dataRozpoczecia= new DateTime($noweRozpoczecie);
		$dataZakonczenia= new DateTime($noweZakonczenie);
		$roznica=$dataRozpoczecia->diff($dataZakonczenia);
		$roznica_min=$roznica->h*60+ $roznica->i;
		// echo "ile czas jazdy  godz ". $roznica->h." minut: ". $roznica->i; 
		echo "ile czas jazdy  min ". $roznica_min; 
		$rezerwacja=0;
		$zapTermin = @$polaczenie->query(" SELECT `termin_rozpoczecia`, `termin_zakonczenia` FROM `jazdy` WHERE `idPojazdy`=$idPojazdu");
		$ileWierszy =$zapTermin->num_rows;
		// if ($ileWierszy==0) {
		// 	$rezerwacja=true;
		// } else{
		// 	$rezerwacja=0;
		// }
		while($z=$zapTermin->fetch_array()){
			if($noweZakonczenie<$z[0] || $noweRozpoczecie> $z[1]){
				$rezerwacja++;
			}
		}
		if($rezerwacja==$ileWierszy){
			@$rozpoczecie = mysqli_real_escape_string($polaczenie, $_POST['rozpoczecie']); 
//dodanie wyjezdzonych minut do tabeli klienci 
		@$polaczenie->query(" UPDATE klienci SET wyjezdzone_min= wyjezdzone_min+ $roznica_min  WHERE `idKLIENT`=$klient");

		}
		else{
			echo	"<span style='color:red; display:block; text-align:left;'>Pojazd niedostępny, wybierz inny termin. </span> ";
		}        
	}
}


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
	// echo	"<span style='color:red; display:block; text-align:left;'> pusty formularz</span> ";
}


$polaczenie->close();
// nie wiem czy zakonczenie polaczenia nie powinno byc jakos na koncu
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
while ($wiersz=$zapListaInstruktorow->fetch_array()) {
?>
      <option value="<?php echo $wiersz[0]; ?>"> <?php echo $wiersz[1]; ?> <?php echo $wiersz[2]; ?> </option>
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
<select name="klient" id="klient" required>
<?php
while ($wiersz=$zapListaKlientow->fetch_array()) {
?>
      <option value="<?php echo $wiersz[0]; ?>"> <?php echo $wiersz[1]; ?> <?php echo $wiersz[2]; ?> </option>
<?php
}
?>
</select>
</p> 
<!-- <p>  -->
<!-- <label for="klient">Klient:</label>  -->
<!-- <input type="text" name="klient" id="klient"required>  -->
<!-- </p>  -->
<p> 
<label for="pojazd">Pojazd:</label> 
<select name="pojazd" id="pojazd" required>
<?php
while ($wiersz=$zapListaPojazdow->fetch_array()) {
?>
      <option value="<?php echo $wiersz[0]; ?>"> <?php echo $wiersz[6]; ?> </option>
<?php
}
?>
</select>
</p> 
<input type="submit" value="Dodaj termin jazdy"> 
</form>
