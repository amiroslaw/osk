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
@$rozpoczecie = mysqli_real_escape_string($polaczenie, $_POST['rozpoczecie']); 
@$zakonczenie = mysqli_real_escape_string($polaczenie, $_POST['zakonczenie']); 
@$instruktor = mysqli_real_escape_string($polaczenie, $_POST['instruktor']); 
@$klient = mysqli_real_escape_string($polaczenie, $_POST['klient']); 
@$pojazd = mysqli_real_escape_string($polaczenie, $_POST['pojazd']); 
//sprawdzanie poprawności danych
// if (isset($_POST['tech']) )  
// { 
// $tech = filter_var($_POST['tech'], FILTER_VALIDATE_INT);
//
//
// 	if($tech){
// 		@$tech = mysqli_real_escape_string($polaczenie, $_POST['tech']);
// 	}else{
// 		echo	"<span style='color:red; display:block; text-align:left;'> niepoprawna wartość pola</span> ";
// 	}        
// }


		if(empty($rozpoczecie) || empty($zakonczenie)|| empty($instruktor)|| empty($klient) || empty($pojazd))
		{
			echo	"<span style='color:red; display:block; text-align:left;'> pusty formularz</span> ";
		} else{
			$query3="update jazdy set idPojazdy='$pojazd', idINSTRUKTORZY='$instruktor', KLIENCI_idKLIENT='$klient', termin_rozpoczecia='$rozpoczecie', termin_zakonczenia='$zakonczenie' where idJAZDY='$id'";
			if(mysqli_query($polaczenie,$query3))
			{ echo "update";
				header('Location:index.php?page=jazdy');
				mysqli_close($polaczenie);
				// header('Location: ' . $_SERVER['HTTP_REFERER']);
			}else {
				echo "coś poszło nie tak"; 
				echo "Error updating record: " . mysqli_error($polaczenie);
			}
		}
	}
	$q="select * from jazdy where idJAZDY='$id'";
	$zapytanie=mysqli_query($polaczenie, $q) or die(mysqli_error());
	$query2= mysqli_fetch_array($zapytanie);
?>
<!-- formularz edytowania rekordu -->
<form action="<?php $_PHP_SELF ?>" method="post"> 
<p> 
<label for="rozpoczecie">Data rozpoczęcia:</label>  <span>Data rozpoczęcia jazd </span> 
<input type="text" name="rozpoczecie" id="rozpoczecie" 
		value="<?php echo $query2['4']; ?>" />
</p> 
<p> 
<label for="zakonczenie">Data zakończenia:</label> 
<input type="text" name="zakonczenie" id="zakonczenie" 
		value="<?php echo $query2['5']; ?>" />
</p> 
<p> 
<label for="instruktor">Instruktor:</label> 
<input type="text" name="instruktor" id="instruktor" 
		value="<?php echo $query2['2']; ?>" />
</p> 
<p> 
<label for="klient">Klient:</label> 
<input type="text" name="klient" id="klient" 
		value="<?php echo $query2['3']; ?>" />
</p> 
<p> 
<label for="pojazd">Pojazd:</label> 
<input type="text" name="pojazd" id="pojazd"
		value="<?php echo $query2['1']; ?>" />
</p> 
<!-- <p>  -->
<!-- <label for="rodzaj">Rodzaj:</label> <span>Do jakiej kategorii prawa jazdy pojazd jest przeznaczony</span>  -->
<!-- <input type="text" name="rodzaj" id="rodzaj">  -->
<!-- </p>  -->
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
