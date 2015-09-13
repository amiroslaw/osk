-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 13 Wrz 2015, 14:16
-- Wersja serwera: 5.6.20
-- Wersja PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `mydb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `egzamin`
--

CREATE TABLE IF NOT EXISTS `egzamin` (
`idEGZAMIN` int(11) NOT NULL,
  `termin` date DEFAULT NULL,
  `punkty` int(11) DEFAULT NULL,
  `KLIENCI_idKLIENT` int(11) NOT NULL,
  `WYKLAD_idWyklad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `instruktorzy`
--

CREATE TABLE IF NOT EXISTS `instruktorzy` (
`idINSTRUKTORZY` int(11) NOT NULL,
  `imie` varchar(45) DEFAULT NULL,
  `nazwisko` varchar(45) DEFAULT NULL,
  `numer_uprawnienia` int(11) DEFAULT NULL,
  `nr_telefonu` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Zrzut danych tabeli `instruktorzy`
--

INSERT INTO `instruktorzy` (`idINSTRUKTORZY`, `imie`, `nazwisko`, `numer_uprawnienia`, `nr_telefonu`) VALUES
(11, 'Jarosław', 'żąć', 3333, 242),
(17, 'arek', 'ciaojij', 11, 333),
(19, 'Jaros', 'ciaojij', 11, 154646),
(20, 'arek', 'ciaojij', 48546, 333),
(22, 'Jaros', 'ciaojij', 1112, 333),
(26, 'Jaros', 'mirek', 1112, 3333),
(27, 'Jaros', 'mirek', 1112, 3333),
(28, 'Jaros', 'D', 111, 154646),
(29, 'Jaros', 'D', 111, 154646),
(30, 'Jaros', 'D', 111, 154646),
(31, 'Jaros', 'D', 111, 154646),
(32, 'Barbara', 'ciaojij', 1112, 154646);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `jazdy`
--

CREATE TABLE IF NOT EXISTS `jazdy` (
`idJAZDY` int(11) NOT NULL,
  `idPojazdy` int(11) NOT NULL,
  `idINSTRUKTORZY` int(11) NOT NULL,
  `KLIENCI_idKLIENT` int(11) NOT NULL,
  `termin_rozpoczecia` date DEFAULT NULL,
  `termin_zakonczenia` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE IF NOT EXISTS `kategorie` (
`idKategorie` int(11) NOT NULL,
  `ile_godzin_trwa_kurs` int(11) DEFAULT NULL,
  `od_jakiego_wieku` varchar(45) DEFAULT NULL,
  `kategoria` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`idKategorie`, `ile_godzin_trwa_kurs`, `od_jakiego_wieku`, `kategoria`) VALUES
(1, 20, '18', 'A'),
(2, 20, '18', 'A');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE IF NOT EXISTS `klienci` (
`idKLIENT` int(11) NOT NULL COMMENT '	',
  `imie` varchar(45) COLLATE utf8_polish_ci DEFAULT NULL,
  `nazwisko` varchar(45) COLLATE utf8_polish_ci DEFAULT NULL,
  `data_urodzenia` date DEFAULT NULL,
  `plec` varchar(45) COLLATE utf8_polish_ci DEFAULT NULL,
  `ulica` varchar(45) COLLATE utf8_polish_ci DEFAULT NULL,
  `nr_mieszkania` int(11) DEFAULT NULL,
  `miejscowosc` varchar(45) COLLATE utf8_polish_ci DEFAULT NULL,
  `kod_pocztowy` int(11) DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_polish_ci DEFAULT NULL,
  `nr_telefonu` int(11) DEFAULT NULL,
  `typ` int(11) DEFAULT NULL COMMENT 'czy kursant czy na doszkalanie',
  `liczba_obecnosci_wyklady` int(11) DEFAULT NULL,
  `wyjezdzone_godziny` int(11) DEFAULT NULL,
  `status_kursu` varchar(45) COLLATE utf8_polish_ci DEFAULT NULL,
  `KATEGORIE_idKategorie` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=12 ;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`idKLIENT`, `imie`, `nazwisko`, `data_urodzenia`, `plec`, `ulica`, `nr_mieszkania`, `miejscowosc`, `kod_pocztowy`, `email`, `nr_telefonu`, `typ`, `liczba_obecnosci_wyklady`, `wyjezdzone_godziny`, `status_kursu`, `KATEGORIE_idKategorie`) VALUES
(1, '$imie', '$nazwisko', '0000-00-00', '$plec', '$ulica', 0, '$miejscowosc', 0, '$email', 0, 0, 0, 0, '$status_kursu', NULL),
(2, 'Bartłomiej', 'Bartkowski', '1990-01-01', 'M', 'Słomkowa', 2, 'Lublin', 22111, 'bartek@poczta.pl', 333555555, 123, 1, 24, 'nowy', NULL),
(3, 'Wojciech', 'Wojciechowski', '1954-03-10', 'M', 'Tęczowa', 3, 'Kutno', 44555, 'wojtek@wp.pl', 123456777, 123, 6, 28, 'obecny', NULL),
(4, 'Anna', 'Nowik', '1992-02-03', 'K', 'Fiołkowa', 4, 'Jastrząbki', 18265, 'ania@poczta.pl', 876543234, 0, 5, 10, 'nowy', NULL),
(5, 'edytuj', 'Kolka', '0000-00-00', 'ela@wp.plK', '1998-03-03', 22456, '4', 0, 'Krosno', 0, 123, 1, 0, 'nowy', NULL),
(7, 'Kolka', 'Lolkowska', '1998-03-03', 'M', 'Lolkowa', 4, 'Krosno', 22456, 'julian@wp.pl', 123, 0, 4, 12, 'nowy', NULL),
(8, 'Julian', 'KrÃ³l', '1996-06-06', 'M', 'ZÅ‚ota', 19, 'Janki', 12333, 'krol@wp.pl', 999888111, 0, 0, 0, 'nowy', NULL),
(9, 'ElÅ¼bieta', 'JuliaÅ„ska', '1998-03-03', 'K', 'Pogodna', 23, 'Wyskoki', 90, 'elka@poczta.pl', 900, 1, 11, 0, 'obency', NULL),
(10, 'Anna', 'BuÅ‚ka', '1957-02-02', 'K', 'Chlebowa', 5, 'BaranÃ³w', 12999, 'abulka@poczta.pl', 345, 1, 343, 4656, 'nowy', NULL),
(11, 'edytuj', 'Arkadiusz ‚aw', '0000-00-00', 'm', 'gospodarcza', 11, 'Lublin', 4568, 'fff6@o2.pl', 78787, 1, 21, 11, 'nieaktywny', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient_na_wykladzie`
--

CREATE TABLE IF NOT EXISTS `klient_na_wykladzie` (
`klientnawykladzie` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `KLIENCI_idKLIENT` int(11) NOT NULL,
  `WYKLAD_idWyklad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `platnosci`
--

CREATE TABLE IF NOT EXISTS `platnosci` (
`idPLATNOSCI` int(11) NOT NULL,
  `idKLIENT` int(11) NOT NULL,
  `rodzaj_platnosci` varchar(11) DEFAULT NULL,
  `nr_raty` int(11) DEFAULT NULL,
  `kwota` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `platnosci`
--

INSERT INTO `platnosci` (`idPLATNOSCI`, `idKLIENT`, `rodzaj_platnosci`, `nr_raty`, `kwota`) VALUES
(3, 2, 'rata', 2, 230),
(4, 4, 'gotówka', 4, 1000);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `srodki_transportu`
--

CREATE TABLE IF NOT EXISTS `srodki_transportu` (
`idPojazdy` int(11) NOT NULL,
  `marka` varchar(45) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `rodzaj` int(11) DEFAULT NULL COMMENT 'samochów czy motor itp.',
  `data_przegladu` date DEFAULT NULL,
  `stan_techniczny` int(11) DEFAULT NULL COMMENT 'czy samochód jest sprawny',
  `nr_rejestracyjny` varchar(45) DEFAULT NULL,
  `nr_ubezpieczenia` varchar(45) DEFAULT NULL,
  `data_ubezpieczenia` date DEFAULT NULL,
  `dostępnosc` tinyint(1) DEFAULT NULL,
  `KATEGORIE_idKategorie` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Zrzut danych tabeli `srodki_transportu`
--

INSERT INTO `srodki_transportu` (`idPojazdy`, `marka`, `model`, `rodzaj`, `data_przegladu`, `stan_techniczny`, `nr_rejestracyjny`, `nr_ubezpieczenia`, `data_ubezpieczenia`, `dostępnosc`, `KATEGORIE_idKategorie`) VALUES
(3, 'bmw', 'ciagnik', 1, '2015-09-10', 1, 'fjdis32', 'ubez434', '2015-09-18', 1, 1),
(5, 'bmw', 'ciągnik', 3, '2015-12-12', 1, 'fjsi324', 'fjdsi3243', '2015-11-30', 1, 1),
(9, '$marka', '$model', 0, '0000-00-00', 1, '$rejestr', '$ubezp', '0000-00-00', 1, 1),
(10, 'Volvo', 'S60', 1, '2015-10-23', 1, 'LB32WE', '1564648694', '2015-10-21', 1, 1),
(11, 'bmw', 'S60', 1, '2015-10-22', 1, 'fjsi324', '1564648694', '2015-10-21', 1, 1),
(12, 'Volvo', 'S60', 1, '2015-10-22', 1, 'LB32WE', '1564648694', '2015-10-21', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
`id` int(11) NOT NULL,
  `user` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `nazwisko` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `pass` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `nazwisko`, `pass`, `email`) VALUES
(1, 'adam', 'Nowak', 'qw', 'adam@gmail.com'),
(2, 'marek', 'Kowalski', 'asd', 'marek@gmail.com'),
(3, 'anna', 'WiSniewski', 'zxcvb', 'anna@gmail.com'),
(5, 'justyna', 'Lewandowski', 'yuiop', 'justyna@gmail.com'),
(6, 'kasia', 'Wójcik', 'hjkkl', 'kasia@gmail.com'),
(7, 'dg', 'dfg', 'hasło', 'dfg'),
(9, 'ghjg', 'dfg', 'hasło', 'elka@poczta.pl'),
(10, 'Jaros', 'ciaojij', 'hasło', 'bbbbbbbbb'),
(11, 'Jaros', 'ciaojij', 'hasło', 'fff6@o2.pl'),
(12, 'Jaros', 'ciaojij', 'hasło', 'fff6@o2.pl'),
(13, 'Jaros', 'W', 'hasło', 'fff6@o2.pl'),
(14, 'Jaros', 'ciaojij', 'hasło', 'fff6@o2.pl'),
(15, 'Jaros', 'mirek', 'hasło', 'fff6@o2.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyklad`
--

CREATE TABLE IF NOT EXISTS `wyklad` (
`idWyklad` int(11) NOT NULL,
  `termin` date DEFAULT NULL,
  `idKategorie` int(11) NOT NULL,
  `idWykladowcy` int(11) NOT NULL,
  `nazwa_grupy` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wykladowcy`
--

CREATE TABLE IF NOT EXISTS `wykladowcy` (
`idWykladowcy` int(11) NOT NULL,
  `imie` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT '		',
  `nazwisko` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `nr_telefonu` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `wykladowcy`
--

INSERT INTO `wykladowcy` (`idWykladowcy`, `imie`, `nazwisko`, `nr_telefonu`) VALUES
(1, 'Marek', 'Lol', 2147483647),
(2, 'Agata', 'Kanat', 2147483647),
(4, 'Waldemar', 'Gębal', 83647),
(5, 'Czarek', 'KuSmir', 2147483647),
(6, 'Darek', 'Lewandowski', 21474),
(7, 'Adam', 'Dąbrowska', 1545),
(8, 'Darek', 'Lewandowski', 2147483647);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `egzamin`
--
ALTER TABLE `egzamin`
 ADD PRIMARY KEY (`idEGZAMIN`), ADD KEY `fk_EGZAMIN_KLIENCI1_idx` (`KLIENCI_idKLIENT`), ADD KEY `fk_EGZAMIN_WYKLAD1_idx` (`WYKLAD_idWyklad`);

--
-- Indexes for table `instruktorzy`
--
ALTER TABLE `instruktorzy`
 ADD PRIMARY KEY (`idINSTRUKTORZY`);

--
-- Indexes for table `jazdy`
--
ALTER TABLE `jazdy`
 ADD PRIMARY KEY (`idJAZDY`), ADD KEY `fk_JAZDY_SRODKI TRANSPORTU_idx` (`idPojazdy`), ADD KEY `fk_JAZDY_INSTRUKTORZY1_idx` (`idINSTRUKTORZY`), ADD KEY `fk_JAZDY_KLIENCI1_idx` (`KLIENCI_idKLIENT`);

--
-- Indexes for table `kategorie`
--
ALTER TABLE `kategorie`
 ADD PRIMARY KEY (`idKategorie`);

--
-- Indexes for table `klienci`
--
ALTER TABLE `klienci`
 ADD PRIMARY KEY (`idKLIENT`), ADD KEY `KATEGORIE_idKategorie` (`KATEGORIE_idKategorie`);

--
-- Indexes for table `klient_na_wykladzie`
--
ALTER TABLE `klient_na_wykladzie`
 ADD PRIMARY KEY (`klientnawykladzie`), ADD KEY `fk_KLIENT_NA_WYKLADZIE_KLIENCI1_idx` (`KLIENCI_idKLIENT`), ADD KEY `fk_KLIENT_NA_WYKLADZIE_WYKLAD1_idx` (`WYKLAD_idWyklad`);

--
-- Indexes for table `platnosci`
--
ALTER TABLE `platnosci`
 ADD PRIMARY KEY (`idPLATNOSCI`), ADD KEY `fk_PLATNOSCI_KLIENCI1_idx` (`idKLIENT`);

--
-- Indexes for table `srodki_transportu`
--
ALTER TABLE `srodki_transportu`
 ADD PRIMARY KEY (`idPojazdy`), ADD KEY `fk_SRODKI TRANSPORTU_KATEGORIE1_idx` (`KATEGORIE_idKategorie`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wyklad`
--
ALTER TABLE `wyklad`
 ADD PRIMARY KEY (`idWyklad`), ADD KEY `fk_WYKLAD_KATEGORIE1_idx` (`idKategorie`), ADD KEY `fk_WYKLAD_WYKLADOWCY1_idx` (`idWykladowcy`);

--
-- Indexes for table `wykladowcy`
--
ALTER TABLE `wykladowcy`
 ADD PRIMARY KEY (`idWykladowcy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `egzamin`
--
ALTER TABLE `egzamin`
MODIFY `idEGZAMIN` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `instruktorzy`
--
ALTER TABLE `instruktorzy`
MODIFY `idINSTRUKTORZY` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT dla tabeli `jazdy`
--
ALTER TABLE `jazdy`
MODIFY `idJAZDY` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
MODIFY `idKategorie` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
MODIFY `idKLIENT` int(11) NOT NULL AUTO_INCREMENT COMMENT '	',AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT dla tabeli `klient_na_wykladzie`
--
ALTER TABLE `klient_na_wykladzie`
MODIFY `klientnawykladzie` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `platnosci`
--
ALTER TABLE `platnosci`
MODIFY `idPLATNOSCI` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `srodki_transportu`
--
ALTER TABLE `srodki_transportu`
MODIFY `idPojazdy` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT dla tabeli `wyklad`
--
ALTER TABLE `wyklad`
MODIFY `idWyklad` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `wykladowcy`
--
ALTER TABLE `wykladowcy`
MODIFY `idWykladowcy` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `egzamin`
--
ALTER TABLE `egzamin`
ADD CONSTRAINT `fk_EGZAMIN_KLIENCI1` FOREIGN KEY (`KLIENCI_idKLIENT`) REFERENCES `klienci` (`idKLIENT`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_EGZAMIN_WYKLAD1` FOREIGN KEY (`WYKLAD_idWyklad`) REFERENCES `wyklad` (`idWyklad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `jazdy`
--
ALTER TABLE `jazdy`
ADD CONSTRAINT `fk_JAZDY_INSTRUKTORZY1` FOREIGN KEY (`idINSTRUKTORZY`) REFERENCES `instruktorzy` (`idINSTRUKTORZY`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_JAZDY_KLIENCI1` FOREIGN KEY (`KLIENCI_idKLIENT`) REFERENCES `klienci` (`idKLIENT`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_JAZDY_SRODKI?TRANSPORTU` FOREIGN KEY (`idPojazdy`) REFERENCES `srodki_transportu` (`idPojazdy`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `klienci`
--
ALTER TABLE `klienci`
ADD CONSTRAINT `fk_KLIENCI_KATEGORIE` FOREIGN KEY (`KATEGORIE_idKategorie`) REFERENCES `kategorie` (`idKategorie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `klient_na_wykladzie`
--
ALTER TABLE `klient_na_wykladzie`
ADD CONSTRAINT `fk_KLIENT_NA_WYKLADZIE_KLIENCI1` FOREIGN KEY (`KLIENCI_idKLIENT`) REFERENCES `klienci` (`idKLIENT`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_KLIENT_NA_WYKLADZIE_WYKLAD1` FOREIGN KEY (`WYKLAD_idWyklad`) REFERENCES `wyklad` (`idWyklad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `platnosci`
--
ALTER TABLE `platnosci`
ADD CONSTRAINT `fk_PLATNOSCI_KLIENCI1` FOREIGN KEY (`idKLIENT`) REFERENCES `klienci` (`idKLIENT`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `srodki_transportu`
--
ALTER TABLE `srodki_transportu`
ADD CONSTRAINT `fk_SRODKI?TRANSPORTU_KATEGORIE1` FOREIGN KEY (`KATEGORIE_idKategorie`) REFERENCES `kategorie` (`idKategorie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `wyklad`
--
ALTER TABLE `wyklad`
ADD CONSTRAINT `fk_WYKLAD_KATEGORIE1` FOREIGN KEY (`idKategorie`) REFERENCES `kategorie` (`idKategorie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_WYKLAD_WYKLADOWCY1` FOREIGN KEY (`idWykladowcy`) REFERENCES `wykladowcy` (`idWykladowcy`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
