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

		$zapytanie = @$polaczenie->query("SELECT * FROM uzytkownicy");

		echo '<table> <tr>	<th>Nr.</th> <th>Imię</th>  <th>Nazwisko</th>  <th>Email</th> </tr>';
		// zapisujemy wynik zapytania do tablicy asocjacyjnej 
		while ($r = $zapytanie->fetch_array()) {
			echo "<tr> <td>$r[0]</td> <td>$r[1]</td> <td>$r[2]</td> <td>$r[4]</td>  <td><a href='delete.php?id=$r[0]'>x</a></td> </tr> ";
		} 
		echo "</table>";
		$zapytanie->free_result();


	}
}else {
	echo "dostęp tylko dla upoważnionych, Zaloguj się. ";
}
@$first_name = mysqli_real_escape_string($polaczenie, $_POST['firstname']); 
@$last_name = mysqli_real_escape_string($polaczenie, $_POST['lastname']); 

//sprawdzanie poprawności emailu 
if (isset($_POST['email'])) { 
	$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	if($email){
		@$email_address = mysqli_real_escape_string($polaczenie, $_POST['email']);
	}else{
	echo	"<span style='color:red; display:block; text-align:left;'> niepoprawna wartość email</span> ";
	}        
}

	// if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) )
	if(!empty($email_address) && !empty($first_name) && !empty($last_name))
	{
		// dodawanie rekordu do bazy danych 

		// $sql_row= mysqli_query($polaczenie ,"SELECT id FROM uzytkownicy"); 
		// $num_row=(int)mysqli_num_rows($sql_row)+1;
		//$sql = "INSERT INTO uzytkownicy (id, user, nazwisko,pass, email) VALUES ('$num_row','$first_name', '$last_name','hasło', '$email_address')";
		$sql = "INSERT INTO uzytkownicy VALUES (DEFAULT,'$first_name', '$last_name','hasło', '$email_address')";

		if(mysqli_query($polaczenie, $sql)){

			echo "Records added successfully.";
			header('refresh: 1;');
		} else{

			echo "ERROR: Could not able to execute $sql. " . mysqli_error($polaczenie);

		}}

	@	$polaczenie->close();
	?>

		<form action="<?php $_PHP_SELF ?>" method="post"> 
		<p> 
		<label for="firstName">Imię:</label> 
		<input type="text" name="firstname" id="firstName" required> 
		</p> 
		<p> 
		<label for="lastName">Nazwisko:</label> 
		<input type="text" name="lastname" id="lastName" required> 
		</p> 
		<p> 
		<label for="emailAddress">Adres Email:</label> 
		<input type="email" name="email" id="emailAddress" required> 
		</p> 
		<input type="submit" value="Dodaj pracownika"> 
		</form>

