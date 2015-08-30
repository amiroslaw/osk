-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 30 Sie 2015, 15:10
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
-- Struktura tabeli dla tabeli `EGZAMIN`
--

CREATE TABLE IF NOT EXISTS `EGZAMIN` (
`idEGZAMIN` int(11) NOT NULL,
  `termin` date DEFAULT NULL,
  `punkty` int(11) DEFAULT NULL,
  `KLIENCI_idKLIENT` int(11) NOT NULL,
  `WYKLAD_idWyklad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `INSTRUKTORZY`
--

CREATE TABLE IF NOT EXISTS `INSTRUKTORZY` (
`idINSTRUKTORZY` int(11) NOT NULL,
  `imie` varchar(45) DEFAULT NULL,
  `nazwisko` varchar(45) DEFAULT NULL,
  `numer_uprawnienia` int(11) DEFAULT NULL,
  `nr_telefonu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `JAZDY`
--

CREATE TABLE IF NOT EXISTS `JAZDY` (
`idJAZDY` int(11) NOT NULL,
  `idPojazdy` int(11) NOT NULL,
  `idINSTRUKTORZY` int(11) NOT NULL,
  `KLIENCI_idKLIENT` int(11) NOT NULL,
  `termin_rozpoczecia` date DEFAULT NULL,
  `termin_zakonczenia` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `KATEGORIE`
--

CREATE TABLE IF NOT EXISTS `KATEGORIE` (
`idKategorie` int(11) NOT NULL,
  `ile_godzin_trwa_kurs` int(11) DEFAULT NULL,
  `od_jakiego_wieku` varchar(45) DEFAULT NULL,
  `KLIENCI_idKLIENT` int(11) DEFAULT NULL,
  `kategoria` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `KATEGORIE`
--

INSERT INTO `KATEGORIE` (`idKategorie`, `ile_godzin_trwa_kurs`, `od_jakiego_wieku`, `KLIENCI_idKLIENT`, `kategoria`) VALUES
(1, 20, '18', NULL, 'b');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `KLIENCI`
--

CREATE TABLE IF NOT EXISTS `KLIENCI` (
`idKLIENT` int(11) NOT NULL COMMENT '	',
  `imie` varchar(45) DEFAULT NULL,
  `nazwisko` varchar(45) DEFAULT NULL,
  `nr_telefonu` int(11) DEFAULT NULL,
  `typ` int(11) DEFAULT NULL COMMENT 'czy kursant czy na doszkalanie',
  `liczba_obecnosci_wyklady` int(11) DEFAULT NULL,
  `wyjezdzone_godziny` int(11) DEFAULT NULL,
  `data_urodzenia` int(11) DEFAULT NULL,
  `ulica` varchar(45) DEFAULT NULL,
  `kod_pocztowy` int(11) DEFAULT NULL,
  `nr_mieszkania` int(11) DEFAULT NULL,
  `miejscowosc` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `plec` varchar(45) DEFAULT NULL,
  `status_kursu` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `KLIENCI`
--

INSERT INTO `KLIENCI` (`idKLIENT`, `imie`, `nazwisko`, `nr_telefonu`, `typ`, `liczba_obecnosci_wyklady`, `wyjezdzone_godziny`, `data_urodzenia`, `ulica`, `kod_pocztowy`, `nr_mieszkania`, `miejscowosc`, `email`, `plec`, `status_kursu`) VALUES
(1, 'Jarosław', 'Wawrzyn', 454545, 1, 15, 10, 4545, 'Mleczna', 21100, 10, '11', 'arejijifda', 'M', 'fafda'),
(2, 'Adam', 'Małsowki', 1545, 2, 12, 10, 4854, 'Krakusa', 21210, 10, 'Lubartów', 'amaslowski', 'm', 'aktywny'),
(3, 'Jarosław', 'Wawrzyn', 454545, 1, 15, 10, 4545, 'Mleczna', 21100, 10, '11', 'arejijifda', 'M', 'fafda'),
(4, 'Adam', 'Małsowki', 1545, 2, 12, 10, 4854, 'Krakusa', 21210, 10, 'Lubartów', 'amaslowski', 'm', 'aktywny');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `KLIENT_NA_WYKLADZIE`
--

CREATE TABLE IF NOT EXISTS `KLIENT_NA_WYKLADZIE` (
`klientnawykladzie` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `KLIENCI_idKLIENT` int(11) NOT NULL,
  `WYKLAD_idWyklad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `PLATNOSCI`
--

CREATE TABLE IF NOT EXISTS `PLATNOSCI` (
`idPLATNOSCI` int(11) NOT NULL,
  `idKLIENT` int(11) NOT NULL,
  `rodzaj_platnosci` int(11) DEFAULT NULL,
  `nr_raty` int(11) DEFAULT NULL,
  `rodzaj_wplaty` varchar(45) DEFAULT NULL,
  `kwota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `SRODKI_TRANSPORTU`
--

CREATE TABLE IF NOT EXISTS `SRODKI_TRANSPORTU` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `SRODKI_TRANSPORTU`
--

INSERT INTO `SRODKI_TRANSPORTU` (`idPojazdy`, `marka`, `model`, `rodzaj`, `data_przegladu`, `stan_techniczny`, `nr_rejestracyjny`, `nr_ubezpieczenia`, `data_ubezpieczenia`, `dostępnosc`, `KATEGORIE_idKategorie`) VALUES
(1, 'SKODA', 'FABIA', 1, '2015-07-15', 1, '12323', '33', '2015-07-14', 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `nazwisko`, `pass`, `email`) VALUES
(1, 'adam', 'Nowak', 'qw', 'adam@gmail.com'),
(2, 'marek', 'Kowalski', 'asd', 'marek@gmail.com'),
(3, 'anna', 'WiSniewski', 'zxcvb', 'anna@gmail.com'),
(5, 'justyna', 'Lewandowski', 'yuiop', 'justyna@gmail.com'),
(6, 'kasia', 'Wójcik', 'hjkkl', 'kasia@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `WYKLAD`
--

CREATE TABLE IF NOT EXISTS `WYKLAD` (
`idWyklad` int(11) NOT NULL,
  `termin` date DEFAULT NULL,
  `idKategorie` int(11) NOT NULL,
  `idWykladowcy` int(11) NOT NULL,
  `nazwa_grupy` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `WYKLAD`
--

INSERT INTO `WYKLAD` (`idWyklad`, `termin`, `idKategorie`, `idWykladowcy`, `nazwa_grupy`) VALUES
(1, '2015-07-24', 1, 3, 'lipiec'),
(2, '2015-07-19', 1, 3, 'grupa b');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `WYKLADOWCY`
--

CREATE TABLE IF NOT EXISTS `WYKLADOWCY` (
`idWykladowcy` int(11) NOT NULL,
  `imie` varchar(45) DEFAULT NULL COMMENT '		',
  `nazwisko` varchar(45) DEFAULT NULL,
  `nr_telefonu` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `WYKLADOWCY`
--

INSERT INTO `WYKLADOWCY` (`idWykladowcy`, `imie`, `nazwisko`, `nr_telefonu`) VALUES
(1, 'Marek', 'LoS', 2147483647),
(2, 'Agata', 'Kanat', 2147483647),
(3, 'Zbigniew', 'Nowakowski', 2147483647),
(4, 'Waldemar', 'Gębal', 2147483647),
(5, 'Czarek', 'KuSmir', 2147483647);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `EGZAMIN`
--
ALTER TABLE `EGZAMIN`
 ADD PRIMARY KEY (`idEGZAMIN`), ADD KEY `fk_EGZAMIN_KLIENCI1_idx` (`KLIENCI_idKLIENT`), ADD KEY `fk_EGZAMIN_WYKLAD1_idx` (`WYKLAD_idWyklad`);

--
-- Indexes for table `INSTRUKTORZY`
--
ALTER TABLE `INSTRUKTORZY`
 ADD PRIMARY KEY (`idINSTRUKTORZY`);

--
-- Indexes for table `JAZDY`
--
ALTER TABLE `JAZDY`
 ADD PRIMARY KEY (`idJAZDY`), ADD KEY `fk_JAZDY_SRODKI TRANSPORTU_idx` (`idPojazdy`), ADD KEY `fk_JAZDY_INSTRUKTORZY1_idx` (`idINSTRUKTORZY`), ADD KEY `fk_JAZDY_KLIENCI1_idx` (`KLIENCI_idKLIENT`);

--
-- Indexes for table `KATEGORIE`
--
ALTER TABLE `KATEGORIE`
 ADD PRIMARY KEY (`idKategorie`), ADD KEY `fk_KATEGORIE_KLIENCI1_idx` (`KLIENCI_idKLIENT`);

--
-- Indexes for table `KLIENCI`
--
ALTER TABLE `KLIENCI`
 ADD PRIMARY KEY (`idKLIENT`);

--
-- Indexes for table `KLIENT_NA_WYKLADZIE`
--
ALTER TABLE `KLIENT_NA_WYKLADZIE`
 ADD PRIMARY KEY (`klientnawykladzie`), ADD KEY `fk_KLIENT_NA_WYKLADZIE_KLIENCI1_idx` (`KLIENCI_idKLIENT`), ADD KEY `fk_KLIENT_NA_WYKLADZIE_WYKLAD1_idx` (`WYKLAD_idWyklad`);

--
-- Indexes for table `PLATNOSCI`
--
ALTER TABLE `PLATNOSCI`
 ADD PRIMARY KEY (`idPLATNOSCI`), ADD KEY `fk_PLATNOSCI_KLIENCI1_idx` (`idKLIENT`);

--
-- Indexes for table `SRODKI_TRANSPORTU`
--
ALTER TABLE `SRODKI_TRANSPORTU`
 ADD PRIMARY KEY (`idPojazdy`), ADD KEY `fk_SRODKI TRANSPORTU_KATEGORIE1_idx` (`KATEGORIE_idKategorie`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `WYKLAD`
--
ALTER TABLE `WYKLAD`
 ADD PRIMARY KEY (`idWyklad`), ADD KEY `fk_WYKLAD_KATEGORIE1_idx` (`idKategorie`), ADD KEY `fk_WYKLAD_WYKLADOWCY1_idx` (`idWykladowcy`);

--
-- Indexes for table `WYKLADOWCY`
--
ALTER TABLE `WYKLADOWCY`
 ADD PRIMARY KEY (`idWykladowcy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `EGZAMIN`
--
ALTER TABLE `EGZAMIN`
MODIFY `idEGZAMIN` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `INSTRUKTORZY`
--
ALTER TABLE `INSTRUKTORZY`
MODIFY `idINSTRUKTORZY` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `JAZDY`
--
ALTER TABLE `JAZDY`
MODIFY `idJAZDY` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `KATEGORIE`
--
ALTER TABLE `KATEGORIE`
MODIFY `idKategorie` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `KLIENCI`
--
ALTER TABLE `KLIENCI`
MODIFY `idKLIENT` int(11) NOT NULL AUTO_INCREMENT COMMENT '	',AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `KLIENT_NA_WYKLADZIE`
--
ALTER TABLE `KLIENT_NA_WYKLADZIE`
MODIFY `klientnawykladzie` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `PLATNOSCI`
--
ALTER TABLE `PLATNOSCI`
MODIFY `idPLATNOSCI` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `SRODKI_TRANSPORTU`
--
ALTER TABLE `SRODKI_TRANSPORTU`
MODIFY `idPojazdy` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `WYKLAD`
--
ALTER TABLE `WYKLAD`
MODIFY `idWyklad` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `WYKLADOWCY`
--
ALTER TABLE `WYKLADOWCY`
MODIFY `idWykladowcy` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `EGZAMIN`
--
ALTER TABLE `EGZAMIN`
ADD CONSTRAINT `fk_EGZAMIN_KLIENCI1` FOREIGN KEY (`KLIENCI_idKLIENT`) REFERENCES `KLIENCI` (`idKLIENT`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_EGZAMIN_WYKLAD1` FOREIGN KEY (`WYKLAD_idWyklad`) REFERENCES `WYKLAD` (`idWyklad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `JAZDY`
--
ALTER TABLE `JAZDY`
ADD CONSTRAINT `fk_JAZDY_INSTRUKTORZY1` FOREIGN KEY (`idINSTRUKTORZY`) REFERENCES `INSTRUKTORZY` (`idINSTRUKTORZY`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_JAZDY_KLIENCI1` FOREIGN KEY (`KLIENCI_idKLIENT`) REFERENCES `KLIENCI` (`idKLIENT`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_JAZDY_SRODKI TRANSPORTU` FOREIGN KEY (`idPojazdy`) REFERENCES `SRODKI_TRANSPORTU` (`idPojazdy`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `KATEGORIE`
--
ALTER TABLE `KATEGORIE`
ADD CONSTRAINT `fk_KATEGORIE_KLIENCI1` FOREIGN KEY (`KLIENCI_idKLIENT`) REFERENCES `KLIENCI` (`idKLIENT`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `KLIENT_NA_WYKLADZIE`
--
ALTER TABLE `KLIENT_NA_WYKLADZIE`
ADD CONSTRAINT `fk_KLIENT_NA_WYKLADZIE_KLIENCI1` FOREIGN KEY (`KLIENCI_idKLIENT`) REFERENCES `KLIENCI` (`idKLIENT`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_KLIENT_NA_WYKLADZIE_WYKLAD1` FOREIGN KEY (`WYKLAD_idWyklad`) REFERENCES `WYKLAD` (`idWyklad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `PLATNOSCI`
--
ALTER TABLE `PLATNOSCI`
ADD CONSTRAINT `fk_PLATNOSCI_KLIENCI1` FOREIGN KEY (`idKLIENT`) REFERENCES `KLIENCI` (`idKLIENT`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `SRODKI_TRANSPORTU`
--
ALTER TABLE `SRODKI_TRANSPORTU`
ADD CONSTRAINT `fk_SRODKI TRANSPORTU_KATEGORIE1` FOREIGN KEY (`KATEGORIE_idKategorie`) REFERENCES `KATEGORIE` (`idKategorie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `WYKLAD`
--
ALTER TABLE `WYKLAD`
ADD CONSTRAINT `fk_WYKLAD_KATEGORIE1` FOREIGN KEY (`idKategorie`) REFERENCES `KATEGORIE` (`idKategorie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_WYKLAD_WYKLADOWCY1` FOREIGN KEY (`idWykladowcy`) REFERENCES `WYKLADOWCY` (`idWykladowcy`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
