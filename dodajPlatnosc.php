<! DOCTYPE html>
<html>
<head></head>
<body>

<?php 


	// session_start();


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

		$zapytanie = @$polaczenie->query("SELECT * FROM platnosci");

echo '<table> <tr>	<th>Lp.</th> <th>ID klient</th>  <th>Rodzaj płatności</th>  <th>Nr raty</th> <th>Kwota</th></tr>';
		// zapisujemy wynik zapytania do tablicy asocjacyjnej 
		while ($r = $zapytanie->fetch_array()) {
echo "<tr><td>$r[0]</td> <td>$r[1]</td> <td>$r[2]</td> <td>$r[3]</td> <td>$r[4]</td></tr> ";
		} 
echo "</table>";
		$zapytanie->free_result();


	}
}else {
	echo "dostęp tylko dla upoważnionych, Zaloguj się. ";
}
@$idklient = mysqli_real_escape_string($polaczenie, $_POST['idklient']); 
@$rodzaj_platnosci = mysqli_real_escape_string($polaczenie, $_POST['rodzaj_platnosci']); 
@$nr_raty = mysqli_real_escape_string($polaczenie, $_POST['nr_raty']);
@$kwota = mysqli_real_escape_string($polaczenie, $_POST['kwota']); 



 //function xyz(){};
//$action=$_POST['action'];
// if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) )
if(!empty($idklient) && !empty($rodzaj_platnosci) && !empty($nr_raty))
{
// dodawanie rekordu do bazy danych 

$sql = "INSERT INTO platnosci( rodzaj_platnosci, nr_raty,kwota) VALUES ('$rodzaj_platnosci', '$nr_raty', '$kwota')";

if(mysqli_query($polaczenie, $sql)){

    echo "Dodano!";
header('refresh: 1;');
} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($polaczenie);

}}
@$id= $_POST['id'];

// usuwanie rekordu z bazy danych 
//@$id= $_POST['id']; 
/*if(!empty($id)){
$sqldel = "DELETE FROM nowy  WHERE id='$id'";

if(mysql_query($polaczenie, $sqldel)){

    echo "Records were deleted successfully.";
header('refresh: 1;');

} else{

    echo "ERROR: Could not able to execute $sqldel. " . mysqli_error($polaczenie);

}
}*/
	@	$polaczenie->close();
?>

<form action="<?php $_PHP_SELF ?>" method="post"> 
	<!--<p> 
        <label for="idklient">Nr klienta</label> 
        <input type="text" name="idklient" id="idklient"> 
    </p>-->
    <p> 
        <label for="rodzaj_platnosci">Rodzaj płatności:</label> 
        <input type="text" name="rodzaj_platnosci" id="rodzaj_platnosci"> 
    </p> 
    <p> 
        <label for="nr_raty">Nr raty</label> 
        <input type="text" name="nr_raty" id="nr_raty"> 
    </p> 
   
  <p> 
        <label for="kwota">Kwota:</label> 
        <input type="text" name="kwota" id="kwota"> 
    </p> 
	
    <input type="submit" value="Dodaj"> 
</form>

<!--
<form action="<?php $_PHP_SELF ?>" method="post"> 
    <p> 
		
        <label for="id">Usuń rekord o id:</label> 
        <input type="text" name="id" id="id"> 
	
    </p> 
    <input type="submit" value="Usuń"> 
		<label for ="id">Edytuj rekord:</label>
		<input type="text" name="id" id="id">
		<input type="submit" value="Edytuj">
</form>
-->

</body>
</html>