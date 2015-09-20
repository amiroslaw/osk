<!DOCTYPE html>
<html lang="pl">
<head>
<title>Ośrodek Szkolenia Kierowców</title>
<link href="styl.css" rel="stylesheet"/>
<meta charset="utf-8"/>
</head>
<body>
<header>
<div id="logowanie">
<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
	echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';

	echo "<p><b>E-mail</b>: ".$_SESSION['email'];

}else {
echo <<<END
		<form action="zaloguj.php" method="post">

		Login: <br /> <input type="text" name="login" /> <br />
		Hasło: <br /> <input type="password" name="haslo" /> <br /><br />
		<input type="submit" value="Zaloguj się" />

		</form>
END;

}

if(isset($_SESSION['blad'])){	
echo $_SESSION['blad'];}
?>

</div>
<img src="img/logo.jpg" alt="logo"/>
</header>
<main role="main">

<nav>
<header>
</header>
<ol>
<li><a href="?page=klienci">Klienci</a>
<ul>
<li><a href="?page=dodajKlienta">Dodaj klienta</a></li>
<li><a href="?page=dodajPlatnosc">Płatność</a></li>
<li><a href="?page=eg_wew">Egzamin wew.</a></li>
<li><a href="?page=jazdy">Terminy jazd</a></li>
</ul>
</li>
<li><a href="?page=pojazdy">Pojazdy</a>
<ul>
<li><a href="?page=dodajPojazd">Dodaj pojazd</a></li>
<li><a href="?page=awaria">Zgłaszanie awarii</a></li>
<li><a href="?page=stanTechniczny">Stan techniczny</a></li>
</ul>
</li>
<li><a href="?page=grupy">Grupy</a>
<ul>
<li><a href="?page=dodajGrupe">Dodaj grupę</a></li>
<li><a href="?page=obecnosci">Lista obecności</a></li>
<li><a href="?page=edycjaGrupy">Edycja grupy</a></li>
</ul>
</li>
<li><a href="#">Kadra</a>
<ul>
<li><a href="?page=pracownicy">Pracownicy</a></li>
<li><a href="?page=wykladowcy">Wykladowcy</a></li>
<li><a href="?page=instruktorzy">Instuktorzy</a></li>
</ul>
</li>
<li><a href="#">O autorach</a></li>
</ol>
<div class="clear"></div>
</nav>
<section>
<article>
<?php
include('connect.php');
$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
$polaczenie->query("SET CHARSET utf8");
$polaczenie->query ("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
if (!$polaczenie) {
	die("Connection failed: " . mysqli_connect_error());
}

// zapytania do lis rozwijanych w formularzu
$zapListaKategoria = @$polaczenie->query("SELECT * FROM kategorie");
$zapListaWykladowca = @$polaczenie->query("SELECT * FROM wykladowcy");
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	if(isset($_POST['submit']))
	{
// edycja rekordu 
@$nazwa = mysqli_real_escape_string($polaczenie, $_POST['nazwa']); 
@$wykladowca = mysqli_real_escape_string($polaczenie, $_POST['wykladowca']); 
@$kategoria = mysqli_real_escape_string($polaczenie, $_POST['kategoria']);

		if(empty($nazwa) || empty($wykladowca)|| empty($kategoria))
		{
			echo	"<span style='color:red; display:block; text-align:left;'> pusty formularz</span> ";
		} else{
			$query3="UPDATE Grupy SET nazwa='$nazwa', idKategorie='$kategoria', idWykladowcy='$wykladowca'
				 WHERE idGrupa='$id'";
			if(mysqli_query($polaczenie,$query3))
			{ echo "update";
				header('Location:index.php?page=grupy');
				mysqli_close($polaczenie);
				// header('Location: ' . $_SERVER['HTTP_REFERER']);
			}else {
				echo "coś poszło nie tak"; 
				echo "Error updating record: " . mysqli_error($polaczenie);
			}
		}
	}
	$q="select * from Grupy where idGrupa='$id'";
	$zapytanie=mysqli_query($polaczenie, $q) or die(mysqli_error());
	$query2= mysqli_fetch_array($zapytanie);
?>
<!-- formularz edytowania rekordu -->
<form action="<?php $_PHP_SELF ?>" method="post"> 
<p> 
<label for="nazwa">Data rozpoczęcia:</label> 
<input type="text" name="nazwa" id="nazwa" 
		value="<?php echo $query2['1']; ?>" required />
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

<input type="submit" name="submit" value="Edytuj dane"> 
</form>
		<?php
}
?>
</article>
</section>

<footer>
</footer>
</main>
</body>
</html>

