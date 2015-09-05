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
echo "jfidsfo";
	$id=$_GET['id'];
	if(isset($_POST['submit']))
	{
echo "post submit";
		
		$first_name=$_POST['firstname'];
		$last_name=$_POST['lastname'];
		$nr_upr=$_POST['nr_upr'];
		$nr_tel=$_POST['tel_ins'];
		if(empty($first_name) || empty($last_name) || empty($nr_tel) || empty($nr_upr)){
			echo "pusty formularz";
		}
		$query3="update instruktorzy set imie='$first_name', nazwisko='$last_name', numer_uprawnienia='$nr_upr', nr_telefonu='$nr_tel' where idINSTRUKTORZY='$id'";
		if(mysqli_query($polaczenie,$query3))
		{ echo "update";
			header('Location:index.php?page=instruktorzy');
			mysqli_close($polaczenie);
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
		}else {
			echo "coś poszło nie tak"; 
			 echo "Error updating record: " . mysqli_error($polaczenie);
		}
	}
	$q="select * from instruktorzy where idINSTRUKTORZY='$id'";
	$zapytanie=mysqli_query($polaczenie, $q) or die(mysqli_error());
	// $zapytanie=$polaczenie->query("select * from instruktorzy where id='$id'");
	// $query2=$zapytanie->fetch_array();
	$query2= mysqli_fetch_array($zapytanie);
	?>
		<!-- formularz dodawania rekordu -->
		<form action="<?php $_PHP_SELF ?>" method="post"> 
		<p> 
		<label for="firstName">Imię:</label> 
		<input type="text" name="firstname" id="firstName" 
		value="<?php echo $query2['1']; ?>" />
		</p> 
		<p> 
		<label for="lastName">Nazwisko:</label> 
		<input type="text" name="lastname" id="lastName"
		value="<?php echo $query2['2']; ?>" />
		</p> 
		<p> 
		<label for="nr_upr">Numer uprawnienia:</label> 
		<input type="text" name="nr_upr" id="nr_upr"
		value="<?php echo $query2['3']; ?>" />
		</p> 
		<p> 
		<label for="nr_telefonu">Numer telefonu:</label> 
		<input type="text" name="tel_ins" id="nr_telefonu"
		value="<?php echo $query2['4']; ?>" />
		</p> 
		<input type="submit" name="submit" value="Edytuj instruktora"> 
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

