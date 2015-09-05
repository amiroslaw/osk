
<?php 
// session_start();

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

		$zapytanie = @$polaczenie->query("SELECT * FROM instruktorzy");

echo '<table> <tr>	<th>Nr.</th> <th>Imię</th>  <th>Nazwisko</th><th>Nr. uprawnienia</th>  <th>Nr. telefonu</th> </tr>';
		// zapisujemy wynik zapytania do tablicy asocjacyjnej 
		while ($r = $zapytanie->fetch_array()) {
echo "<tr> <td>$r[0]</td> <td>$r[1]</td> <td>$r[2]</td> <td>$r[3]</td>  <td>$r[4]</td>  <td><a href='edytuj_instruktorzy.php?id=$r[0]'>Edytuj</a></td>    <td><a href='delete.php?id=$r[0]'>x</a></td> </tr> ";
		} 
echo "</table>";
		$zapytanie->free_result();


	}
}else {
	echo "dostęp tylko dla upoważnionych, Zaloguj się. ";
}
@$first_name = mysqli_real_escape_string($polaczenie, $_POST['firstname']); 
@$last_name = mysqli_real_escape_string($polaczenie, $_POST['lastname']); 
@$tel_wyk = mysqli_real_escape_string($polaczenie, $_POST['tel_wyk']);

 
// if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['tel_wyk']) )
if(!empty($tel_wyk) && !empty($first_name) && !empty($last_name))
{
$sql = "INSERT INTO WYKLADOWCY ( imie, nazwisko, nr_telefonu) VALUES ('$first_name', '$last_name', '$tel_wyk')";

if(mysqli_query($polaczenie, $sql)){

    echo "Records added successfully.";
header('refresh: 1;');
} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($polaczenie);

}}

// usuwanie rekordu z bazy danych 

@$id= $_POST['id']; 
if(!empty($id)){
$sqldel = "DELETE FROM wykladowcy  WHERE idWykladowcy='$id'";

if(mysqli_query($polaczenie, $sqldel)){

    echo "Records were deleted successfully.";
header('refresh: 1;');

} else{

    echo "ERROR: Could not able to execute $sqldel. " . mysqli_error($polaczenie);

}
}
	@	$polaczenie->close();
?>
</h1>
<!-- formularz dodawania rekordu -->
<form action="<?php $_PHP_SELF ?>" method="post"> 
    <p> 
        <label for="firstName">Imię:</label> 
        <input type="text" name="firstname" id="firstName"> 
    </p> 
    <p> 
        <label for="lastName">Nazwisko:</label> 
        <input type="text" name="lastname" id="lastName"> 
    </p> 
    <p> 
        <label for="emailAddress">Numer telefonu:</label> 
        <input type="text" name="tel_wyk" id="telwyk"> 
    </p> 
    <input type="submit" value="Dodaj wykladowcę"> 
</form>


<!-- formularz usuwania rekordu -->

<form action="<?php $_PHP_SELF ?>" method="post"> 
    <p> 
        <label for="id">Usuń rekord o id:</label> 
        <input type="text" name="id" id="id"> 
    </p> 
    <input type="submit" value="Usuń wykladowcę"> 
</form>

