
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
// zapytania do lis rozwijanych w formularzu
$zapListaKategoria = @$polaczenie->query("SELECT * FROM kategorie");
$zapListaWykladowca = @$polaczenie->query("SELECT * FROM wykladowcy");
// dodanie rekordu 
@$nazwa = mysqli_real_escape_string($polaczenie, $_POST['nazwa']); 
@$wykladowca = mysqli_real_escape_string($polaczenie, $_POST['wykladowca']); 
@$kategoria = mysqli_real_escape_string($polaczenie, $_POST['kategoria']);

if(!empty($nazwa) && !empty($wykladowca) && !empty($kategoria))
{
	$sql = "INSERT INTO Grupy ( nazwa, idKategorie, idWykladowcy) VALUES ('$nazwa','$kategoria','$wykladowca')";
	// $sql = "INSERT INTO Grupy ( idGrupa,nazwa, idKategorie, idWykladowcy) VALUES (NULL,'$nazwa', '$wykladowca',  '$kategoria')";
	if(mysqli_query($polaczenie, $sql)){
		echo "Records added successfully.";
		header('refresh: 1;');
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($polaczenie);
	}
}

	}
}else {
	echo "dostęp tylko dla upoważnionych, Zaloguj się. ";
}

@	$polaczenie->close();
?>
<!-- formularz dodawania rekordu -->
<form action="<?php $_PHP_SELF ?>" method="post"> 
<p> 
<label for="nazwa">Nazwa:</label> 
<input type="text" name="nazwa" id="nazwa"> 
</p> 
<p> 
<label for="kategoria">Kategoria:</label> 
<select name="kategoria" id="kategoria" required>
<?php
while ($wiersz=$zapListaKategoria->fetch_array()) {
?>
      <option value="<?php echo $wiersz[0]; ?>"> <?php echo $wiersz[3]; ?> </option>
<?php
}
?>
</select>
</p> 
<p> 
<label for="wykladowca">Wykladowca:</label> 
<select name="wykladowca" id="wykladowca" required>
<?php
while ($wiersz=$zapListaWykladowca->fetch_array()) {
?>
      <option value="<?php echo $wiersz[0]; ?>"> <?php echo $wiersz[1]." ". $wiersz[2]; ?> </option>
<?php
}
?>
</select>
</p> 
<input type="submit" value="Dodaj grupę"> 
</form>
