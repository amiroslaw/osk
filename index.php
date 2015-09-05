	

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

 	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
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
	if(isset($_GET['page'])){
		$page=$_GET['page'];
		$filename=$page.'.php';
		if(file_exists($filename)){
			include $filename;		
	}else{
		echo "nie istnieje podstrona";
}
}
?>
</article>
</section>

<footer>
</footer>
      </main>
</body>
</html>

