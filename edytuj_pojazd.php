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
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	if(isset($_POST['submit']))
	{
// edycja rekordu 
@$data_ubezp = mysqli_real_escape_string($polaczenie, $_POST['data_ubezp']); 
@$przeg = mysqli_real_escape_string($polaczenie, $_POST['przeg']); 
@$dostepnosc = mysqli_real_escape_string($polaczenie, $_POST['dostepnosc']); 
//sprawdzanie poprawności danych
if (isset($_POST['tech']) )  
{ 
$tech = filter_var($_POST['tech'], FILTER_VALIDATE_INT);


	if($tech){
		@$tech = mysqli_real_escape_string($polaczenie, $_POST['tech']);
	}else{
		echo	"<span style='color:red; display:block; text-align:left;'> niepoprawna wartość pola</span> ";
	}        
}


		if(empty($przeg) || empty($data_ubezp)|| empty($tech))
		{
			echo	"<span style='color:red; display:block; text-align:left;'> pusty formularz</span> ";
		} else{
			$query3="update srodki_transportu set data_przegladu='$przeg', stan_techniczny='$tech', data_ubezpieczenia='$data_ubezp', dostępnosc='$dostepnosc' where idPojazdy='$id'";
			if(mysqli_query($polaczenie,$query3))
			{ echo "update";
				header('Location:index.php?page=stanTechniczny');
				mysqli_close($polaczenie);
				// header('Location: ' . $_SERVER['HTTP_REFERER']);
			}else {
				echo "coś poszło nie tak"; 
				echo "Error updating record: " . mysqli_error($polaczenie);
			}
		}
	}
	$q="select * from srodki_transportu where idPojazdy='$id'";
	$zapytanie=mysqli_query($polaczenie, $q) or die(mysqli_error());
	$query2= mysqli_fetch_array($zapytanie);
?>
<!-- formularz dodawania rekordu -->
<form action="<?php $_PHP_SELF ?>" method="post"> 
<p> 
<label for="data_ubezp">Data ubezpieczenia:</label> 
<input type="text" name="data_ubezp" id="data_ubezp"
		value="<?php echo $query2['8']; ?>" />
</p> 
<p> 
<label for="przeg">Data przeglądu:</label> 
<input type="text" name="przeg" id="przeg" 
		value="<?php echo $query2['4']; ?>" />
</p> 
<p> 
<label for="tech">Stan techniczny:</label> 
<input type="text" name="tech" id="tech" 
		value="<?php echo $query2['5']; ?>" />
</p> 
<p> 
<label for="dostepnosc">Dostępność pojazdu:</label> <span>Czy pojazd jest dostępny: 0→ nie; 1→ tak</span> 
<input type="text" name="dostepnosc" id="dostepnosc" 
		value="<?php echo $query2['9']; ?>" />
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

