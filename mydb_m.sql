-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas wygenerowania: 01 Wrz 2015, 09:35
-- Wersja serwera: 5.6.11
-- Wersja PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `mydb`
--
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `mydb`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `egzamin`
--

CREATE TABLE IF NOT EXISTS `egzamin` (
  `idEGZAMIN` int(11) NOT NULL AUTO_INCREMENT,
  `termin` date DEFAULT NULL,
  `punkty` int(11) DEFAULT NULL,
  `KLIENCI_idKLIENT` int(11) NOT NULL,
  `WYKLAD_idWyklad` int(11) NOT NULL,
  PRIMARY KEY (`idEGZAMIN`),
  KEY `fk_EGZAMIN_KLIENCI1_idx` (`KLIENCI_idKLIENT`),
  KEY `fk_EGZAMIN_WYKLAD1_idx` (`WYKLAD_idWyklad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `instruktorzy`
--

CREATE TABLE IF NOT EXISTS `instruktorzy` (
  `idINSTRUKTORZY` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(45) DEFAULT NULL,
  `nazwisko` varchar(45) DEFAULT NULL,
  `numer_uprawnienia` int(11) DEFAULT NULL,
  `nr_telefonu` int(11) DEFAULT NULL,
  PRIMARY KEY (`idINSTRUKTORZY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `jazdy`
--

CREATE TABLE IF NOT EXISTS `jazdy` (
  `idJAZDY` int(11) NOT NULL AUTO_INCREMENT,
  `idPojazdy` int(11) NOT NULL,
  `idINSTRUKTORZY` int(11) NOT NULL,
  `KLIENCI_idKLIENT` int(11) NOT NULL,
  `termin_rozpoczecia` date DEFAULT NULL,
  `termin_zakonczenia` date DEFAULT NULL,
  PRIMARY KEY (`idJAZDY`),
  KEY `fk_JAZDY_SRODKI TRANSPORTU_idx` (`idPojazdy`),
  KEY `fk_JAZDY_INSTRUKTORZY1_idx` (`idINSTRUKTORZY`),
  KEY `fk_JAZDY_KLIENCI1_idx` (`KLIENCI_idKLIENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE IF NOT EXISTS `kategorie` (
  `idKategorie` int(11) NOT NULL AUTO_INCREMENT,
  `ile_godzin_trwa_kurs` int(11) DEFAULT NULL,
  `od_jakiego_wieku` varchar(45) DEFAULT NULL,
  `KLIENCI_idKLIENT` int(11) DEFAULT NULL,
  `kategoria` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idKategorie`),
  KEY `fk_KATEGORIE_KLIENCI1_idx` (`KLIENCI_idKLIENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE IF NOT EXISTS `klienci` (
  `idKLIENT` int(11) NOT NULL AUTO_INCREMENT COMMENT '	',
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
  PRIMARY KEY (`idKLIENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`idKLIENT`, `imie`, `nazwisko`, `data_urodzenia`, `plec`, `ulica`, `nr_mieszkania`, `miejscowosc`, `kod_pocztowy`, `email`, `nr_telefonu`, `typ`, `liczba_obecnosci_wyklady`, `wyjezdzone_godziny`, `status_kursu`) VALUES
(1, 'Karol', 'Karolkowski', '1990-01-01', 'M', 'Karolkowa', 3, 'Karolkowo', 11223, 'karol@poczta.pl', 123456777, NULL, 3, 12, 'nowy'),
(2, 'Bartłomiej', 'Bartkowski', '1990-01-01', 'M', 'Słomkowa', 2, 'Lublin', 22111, 'bartek@poczta.pl', 333555555, 123, 3, 24, 'nowy'),
(3, 'Wojciech', 'Wojciechowski', '1954-03-10', 'M', 'Tęczowa', 3, 'Kutno', 44555, 'wojtek@wp.pl', 123456777, 123, 6, 28, 'obecny'),
(4, 'Anna', 'Nowik', '1992-02-03', 'K', 'Fiołkowa', 4, 'Jastrząbki', 18265, 'ania@poczta.pl', 876543234, 0, 5, 10, 'nowy'),
(5, NULL, 'Kolka', '0000-00-00', 'ela@wp.plK', '1998-03-03', 22456, '4', 0, 'Krosno', 0, 123, 1, 0, 'nowy'),
(6, NULL, 'rt', '0000-00-00', '', '', 0, '', 0, '', 0, 0, 0, 0, ''),
(7, 'Kolka', 'Lolkowska', '1998-03-03', 'M', 'Lolkowa', 4, 'Krosno', 22456, 'julian@wp.pl', 123, 0, 4, 12, 'nowy'),
(8, 'Julian', 'KrÃ³l', '1996-06-06', 'M', 'ZÅ‚ota', 19, 'Janki', 12333, 'krol@wp.pl', 999888111, 0, 0, 0, 'nowy'),
(9, 'ElÅ¼bieta', 'JuliaÅ„ska', '1998-03-03', 'K', 'Pogodna', 23, 'Wyskoki', 90, 'elka@poczta.pl', 900, 1, 11, 0, 'obency'),
(10, 'Anna', 'BuÅ‚ka', '1957-02-02', 'K', 'Chlebowa', 5, 'BaranÃ³w', 12999, 'abulka@poczta.pl', 345, 1, 0, 0, 'nowy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient_na_wykladzie`
--

CREATE TABLE IF NOT EXISTS `klient_na_wykladzie` (
  `klientnawykladzie` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `KLIENCI_idKLIENT` int(11) NOT NULL,
  `WYKLAD_idWyklad` int(11) NOT NULL,
  PRIMARY KEY (`klientnawykladzie`),
  KEY `fk_KLIENT_NA_WYKLADZIE_KLIENCI1_idx` (`KLIENCI_idKLIENT`),
  KEY `fk_KLIENT_NA_WYKLADZIE_WYKLAD1_idx` (`WYKLAD_idWyklad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `platnosci`
--

CREATE TABLE IF NOT EXISTS `platnosci` (
  `idPLATNOSCI` int(11) NOT NULL AUTO_INCREMENT,
  `idKLIENT` int(11) NOT NULL,
  `rodzaj_platnosci` varchar(11) DEFAULT NULL,
  `nr_raty` int(11) DEFAULT NULL,
  `kwota` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPLATNOSCI`),
  KEY `fk_PLATNOSCI_KLIENCI1_idx` (`idKLIENT`)
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
  `idPojazdy` int(11) NOT NULL AUTO_INCREMENT,
  `marka` varchar(45) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `rodzaj` int(11) DEFAULT NULL COMMENT 'samochów czy motor itp.',
  `data_przegladu` date DEFAULT NULL,
  `stan_techniczny` int(11) DEFAULT NULL COMMENT 'czy samochód jest sprawny',
  `nr_rejestracyjny` varchar(45) DEFAULT NULL,
  `nr_ubezpieczenia` varchar(45) DEFAULT NULL,
  `data_ubezpieczenia` date DEFAULT NULL,
  `dostępnosc` tinyint(1) DEFAULT NULL,
  `KATEGORIE_idKategorie` int(11) NOT NULL,
  PRIMARY KEY (`idPojazdy`),
  KEY `fk_SRODKI TRANSPORTU_KATEGORIE1_idx` (`KATEGORIE_idKategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `nazwisko` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `pass` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

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
(9, 'ghjg', 'dfg', 'hasło', 'elka@poczta.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyklad`
--

CREATE TABLE IF NOT EXISTS `wyklad` (
  `idWyklad` int(11) NOT NULL AUTO_INCREMENT,
  `termin` date DEFAULT NULL,
  `idKategorie` int(11) NOT NULL,
  `idWykladowcy` int(11) NOT NULL,
  `nazwa_grupy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idWyklad`),
  KEY `fk_WYKLAD_KATEGORIE1_idx` (`idKategorie`),
  KEY `fk_WYKLAD_WYKLADOWCY1_idx` (`idWykladowcy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wykladowcy`
--

CREATE TABLE IF NOT EXISTS `wykladowcy` (
  `idWykladowcy` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT '		',
  `nazwisko` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `nr_telefonu` int(11) DEFAULT NULL,
  PRIMARY KEY (`idWykladowcy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `wykladowcy`
--

INSERT INTO `wykladowcy` (`idWykladowcy`, `imie`, `nazwisko`, `nr_telefonu`) VALUES
(1, 'Marek', 'LoS', 2147483647),
(2, 'Agata', 'Kanat', 2147483647),
(3, 'Zbigniew', 'Nowakowski', 2147483647),
(4, 'Waldemar', 'Gębal', 2147483647),
(5, 'Czarek', 'KuSmir', 2147483647);

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
-- Ograniczenia dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD CONSTRAINT `fk_KATEGORIE_KLIENCI1` FOREIGN KEY (`KLIENCI_idKLIENT`) REFERENCES `klienci` (`idKLIENT`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
