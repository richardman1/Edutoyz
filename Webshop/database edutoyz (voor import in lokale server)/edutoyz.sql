-- phpMyAdmin SQL Dump
-- version 2.11.9.6
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generatie Tijd: 17 Jan 2014 om 09:28
-- Server versie: 5.1.59
-- PHP Versie: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `edutoyz`
--

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `Bezorgdienst`
--

CREATE TABLE IF NOT EXISTS `Bezorgdienst` (
  `Bezorgdienstnummer` int(11) NOT NULL,
  `Bedrijfsnaam` varchar(45) DEFAULT NULL,
  `Hoofdkantoor_adres` varchar(255) NOT NULL,
  `Hoofdkantoor_postcode` varchar(6) NOT NULL,
  `Hoofdkantoor_plaats` varchar(255) NOT NULL,
  `Telefoonnummer` varchar(20) NOT NULL,
  `E-mailadres` varchar(255) NOT NULL,
  PRIMARY KEY (`Bezorgdienstnummer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `Bezorgdienst`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `Catagorie`
--

CREATE TABLE IF NOT EXISTS `Catagorie` (
  `Catagorienummer` int(11) NOT NULL AUTO_INCREMENT,
  `Catagorienaam` varchar(255) NOT NULL,
  `Catagoriebeschrijving` text,
  PRIMARY KEY (`Catagorienummer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `Catagorie`
--

INSERT INTO `Catagorie` (`Catagorienummer`, `Catagorienaam`, `Catagoriebeschrijving`) VALUES
(1, 'Baby', NULL),
(2, 'Peuter', NULL),
(3, 'Kleuter', NULL),
(4, 'Kind', NULL),
(5, 'Tieners', NULL);

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `Factuur`
--

CREATE TABLE IF NOT EXISTS `Factuur` (
  `Factuurnummer` int(11) NOT NULL AUTO_INCREMENT,
  `Totaalbedrag` decimal(9,2) NOT NULL,
  `Ordernummer` int(11) NOT NULL,
  PRIMARY KEY (`Factuurnummer`),
  KEY `fk_Factuur_Order1_idx` (`Ordernummer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Gegevens worden uitgevoerd voor tabel `Factuur`
--

INSERT INTO `Factuur` (`Factuurnummer`, `Totaalbedrag`, `Ordernummer`) VALUES
(1, 17.99, 3),
(2, 200.00, 14),
(3, 77.96, 18),
(4, 77.96, 19),
(5, 77.96, 20),
(6, 98.97, 21),
(7, 230.93, 22),
(8, 98.97, 23),
(9, 230.93, 30),
(10, 230.93, 31),
(11, 32.99, 32),
(12, 73.97, 33);

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `Klant`
--

CREATE TABLE IF NOT EXISTS `Klant` (
  `Loginnaam` varchar(40) NOT NULL,
  `Wachtwoord` varchar(20) NOT NULL,
  `Klantnummer` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(255) NOT NULL,
  `Adres` varchar(255) NOT NULL,
  `Postcode` varchar(6) NOT NULL,
  `Plaats` varchar(255) NOT NULL,
  `Geboortedatum` date DEFAULT NULL,
  `Telefoonnummer` varchar(20) DEFAULT NULL,
  `E-mailadres` varchar(255) NOT NULL,
  PRIMARY KEY (`Klantnummer`),
  UNIQUE KEY `Loginnaam` (`Loginnaam`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=225 ;

--
-- Gegevens worden uitgevoerd voor tabel `Klant`
--

INSERT INTO `Klant` (`Loginnaam`, `Wachtwoord`, `Klantnummer`, `Naam`, `Adres`, `Postcode`, `Plaats`, `Geboortedatum`, `Telefoonnummer`, `E-mailadres`) VALUES
('', '', 222, 'Test Tester', 'Testerseweg 12', '9999XX', 'Breda', '0000-00-00', '076-1234567', 'test@test.nl'),
('Gregor', 'Test', 1, 'Gregor Hoogstad', 'Reginadonk 173', '4707TW', 'Roorsendaal', '1989-03-17', '0623145575', 'gregorhoogstad@gmail.com'),
('richardman1', 'rambogek1', 223, 'Richard de Jongh', 'Bunschotenstraat 37', '5043BB', 'Tilburg', '1995-06-23', '0642440362', 'richarddejongh@home.nl'),
('Dennis', 'Dennis', 224, 'Dennis van der Meulen', 'Ouwer 8', '4871JK', 'Etten Leur', '0000-00-00', '0642841118', 'd.van.der.meulen@me.com');

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `Lerveringsorder`
--

CREATE TABLE IF NOT EXISTS `Lerveringsorder` (
  `Leveringsordernummer` int(11) NOT NULL,
  `Leveranciersnummer` int(11) NOT NULL,
  `Datum` date NOT NULL,
  PRIMARY KEY (`Leveringsordernummer`),
  KEY `fk_Lerveringsorder_Leverancier1_idx` (`Leveranciersnummer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `Lerveringsorder`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `Leverancier`
--

CREATE TABLE IF NOT EXISTS `Leverancier` (
  `Leveranciersnummer` int(11) NOT NULL,
  `Bedrijfsnaam` varchar(255) NOT NULL,
  `Hoofdkantoor_adres` varchar(255) NOT NULL,
  `Hoofdkantoor_postcode` varchar(6) NOT NULL,
  `Hoofdkantoor_plaats` varchar(255) NOT NULL,
  `Telefoonnummer` varchar(20) NOT NULL,
  `E-mailadres` varchar(255) NOT NULL,
  PRIMARY KEY (`Leveranciersnummer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `Leverancier`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `Leveringsorderregel`
--

CREATE TABLE IF NOT EXISTS `Leveringsorderregel` (
  `Leveringsordernummer` int(11) NOT NULL,
  `Leveringsorderregelnummer` int(11) NOT NULL,
  `Productnummer` int(11) NOT NULL,
  `Aantal` int(11) NOT NULL,
  PRIMARY KEY (`Leveringsordernummer`,`Leveringsorderregelnummer`),
  KEY `fk_Leveringsorderregel_Product1_idx` (`Productnummer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `Leveringsorderregel`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `Order`
--

CREATE TABLE IF NOT EXISTS `Order` (
  `Ordernummer` int(11) NOT NULL AUTO_INCREMENT,
  `Klantnummer` int(11) NOT NULL,
  `Bezorgdienstnummer` int(11) DEFAULT '1',
  `Datum` date NOT NULL,
  PRIMARY KEY (`Ordernummer`),
  KEY `fk_Order_Klant1_idx` (`Klantnummer`),
  KEY `fk_Order_Bezorgdienst1_idx` (`Bezorgdienstnummer`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Gegevens worden uitgevoerd voor tabel `Order`
--

INSERT INTO `Order` (`Ordernummer`, `Klantnummer`, `Bezorgdienstnummer`, `Datum`) VALUES
(3, 222, 1, '2014-01-11'),
(4, 222, 1, '2014-01-11'),
(5, 222, 1, '2014-01-11'),
(6, 222, 1, '2014-01-11'),
(7, 222, 1, '2014-01-11'),
(8, 222, 1, '2014-01-11'),
(9, 222, 1, '2014-01-11'),
(10, 222, 1, '2014-01-11'),
(11, 222, 1, '2014-01-11'),
(12, 222, 1, '2014-01-14'),
(13, 222, 1, '2014-01-14'),
(14, 222, 1, '2014-01-15'),
(15, 222, 1, '2014-01-15'),
(16, 222, 1, '2014-01-15'),
(17, 222, 1, '2014-01-15'),
(18, 222, 1, '2014-01-15'),
(19, 222, 1, '2014-01-15'),
(20, 222, 1, '2014-01-15'),
(21, 1, 1, '2014-01-16'),
(22, 1, 1, '2014-01-16'),
(23, 1, 1, '2014-01-16'),
(24, 1, 1, '2014-01-16'),
(25, 223, 1, '2014-01-16'),
(26, 223, 1, '2014-01-16'),
(27, 1, 1, '2014-01-16'),
(28, 1, 1, '2014-01-16'),
(29, 1, 1, '2014-01-16'),
(30, 1, 1, '2014-01-16'),
(31, 1, 1, '2014-01-16'),
(32, 1, 1, '2014-01-17'),
(33, 224, 1, '2014-01-17');

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `Orderregel`
--

CREATE TABLE IF NOT EXISTS `Orderregel` (
  `Ordernummer` int(11) NOT NULL,
  `Productnummer` varchar(40) NOT NULL,
  `Aantal` int(11) NOT NULL,
  `Prijs` double(11,2) NOT NULL,
  PRIMARY KEY (`Ordernummer`,`Productnummer`),
  KEY `fk_Orderregel_Product1_idx` (`Productnummer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `Orderregel`
--

INSERT INTO `Orderregel` (`Ordernummer`, `Productnummer`, `Aantal`, `Prijs`) VALUES
(3, '2147483647', 2, 7.99),
(4, '2147483647', 2, 7.99),
(5, '2147483647', 3, 7.99),
(6, '2147483647', 3, 7.99),
(7, '2147483647', 3, 7.99),
(8, '2147483647', 3, 7.99),
(9, '8005125663859', 3, 7.99),
(9, '75380020443', 2, 18.74),
(10, '8005125663859', 3, 7.99),
(10, '75380020443', 2, 18.74),
(12, '75380020443', 1, 18.74),
(13, '3417761209233', 2, 30.99),
(14, '8718182370201', 2, 32.99),
(14, '4893669289062', 2, 7.99),
(15, '8718182370201', 3, 32.99),
(15, '75380020443', 2, 18.74),
(16, '8718182370201', 1, 32.99),
(16, '8410446513132', 3, 14.99),
(17, '8718182370201', 1, 32.99),
(17, '8410446513132', 3, 14.99),
(18, '8718182370201', 1, 32.99),
(18, '8410446513132', 3, 14.99),
(19, '8718182370201', 1, 32.99),
(19, '8410446513132', 3, 14.99),
(20, '8718182370201', 1, 32.99),
(20, '8410446513132', 3, 14.99),
(21, '8718182370201', 3, 32.99),
(22, '8718182370201', 7, 32.99),
(23, '8718182370201', 3, 32.99),
(24, '8410446513132', 1, 14.99),
(24, '8718182370201', 5, 32.99),
(25, '8718182370201', 1, 32.99),
(25, '75380020443', 1, 18.74),
(26, '8718182370201', 1, 32.99),
(27, '8005125663859', 4, 7.99),
(28, '8718182370201', 3, 32.99),
(29, '8718182370201', 6, 32.99),
(30, '8718182370201', 7, 32.99),
(31, '8718182370201', 7, 32.99),
(32, '8718182370201', 1, 32.99),
(33, '8718182370201', 2, 32.99),
(33, '8005125663859', 1, 7.99);

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `Product`
--

CREATE TABLE IF NOT EXISTS `Product` (
  `Productnummer` varchar(40) NOT NULL,
  `Naam` varchar(255) NOT NULL,
  `Beschrijving` text,
  `Prijs` decimal(9,2) NOT NULL,
  `Voorraad` int(11) NOT NULL,
  `Korting` int(2) NOT NULL DEFAULT '0' COMMENT 'Korting in %',
  PRIMARY KEY (`Productnummer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `Product`
--

INSERT INTO `Product` (`Productnummer`, `Naam`, `Beschrijving`, `Prijs`, `Voorraad`, `Korting`) VALUES
('3417761176238', 'VTech Mijn Kleine Tamboerijn', 'Alle handjes groot en klein schudden met de tamboerijn! De bewegingssensor activeert vrolijke zinnetjes en tamboerijngeluiden.', 6.99, 23, 0),
('3417761183236', 'VTech Kiekeboe Boerderij', 'Speel kiekeboe met de kip, het schaap en de koe! Op een interactieve manier kennismaken met dieren en kleuren. Beweeg de interactieve klepjes en speel een zoekspelletje met de dieren. Schud de boerderij om de bewegingssensor te activeren en grappige geluiden, 6 melodietjes en een gezongen liedje te horen.', 8.99, 24, 0),
('3417761113523', 'VTech Dierenvriendjes Telefoon', 'Laten we onze vriendjes bellen! Maak kennis met cijfers, vormen, dier- en telefoongeluiden. Druk op de bel-toets om met de dierenvriendjes te bellen. ', 19.99, 5, 0),
('8410446513132', 'Goula houten Kalenderklok', 'Mooie houten kalenderklok waar je kleintje van kan leren. Niet alleen over klokkijken maar ook over de seizoenen, het weer, de maanden, de dagen van de week en de dagen van de maand.', 14.99, 12, 15),
('8436538670118', 'Tech-Too Mijn Eerste Smartphone', 'Jouw eerste smartphone! Deze telefoon bevordert het ontwikkelen van de communicatieve vaardigheden met 21 verschillende activiteiten. Er zijn vijf verschillende spellen beschikbaar, welke cijfers, kleuren, dieren en muziek leren herkennen. Leeftijd vanaf 18 maanden.', 12.99, 13, 0),
('0075380020443', 'Fisher-Price Kassa', 'Kinderen vinden het leuk om deze kassa te bedienen. De bel gaat af wanneer de la openspringt. Wordt geleverd met kleurrijke muntstukken voor het herkennen en vergelijken van vormen. De munten zijn groot zodat kinderen er niet in kunnen stikken. Begin je eigen winkeltje met de kassa van Fisher-Price. ', 18.74, 20, 0),
('3417761209233', 'VTech Cars 2 Laptop', 'Ga samen met Bliksem en zijn vrienden op een spannend en leerzaam avontuur met de VTech Cars 2 Laptop! 30 activiteiten leren o.a. woorden, tellen, lezen, hoofdletters en kleine letters, verkeersborden, vergelijken, logica en nog veel meer. Met originele Bliksem McQueen stem.', 30.99, 10, 15),
('3417761101230', 'VTech Prinsessen Laptop', 'Speel en leer met de prinsessen! Deze notebook bevat 12 activiteiten met Assepoester, Belle, Sneeuwwitje en Doornroosje. Op het lcd-scherm zijn verschillende princessen animaties te zien.', 26.99, 10, 0),
('4022498515350', 'Magneetletters, Groot', 'Magneetletters, groot. Met plezier leren! Spelenderwijs kunnen kinderen leren met letters om te gaan. Stimuleert de creativiteit en bovendien zowel de lichamelijke als geestelijke ontwikkeling van kinderen. In felle kleuren. Inhoud: 48 stuks.', 7.99, 13, 15),
('8718182370201', 'Bblocks in Houten Kist 200 delig', 'Verras je kind met deze 200 bouwplankjes in een stevige houten kist. Ideaal voor beginnende bouwers of als aanvulling op eerder gekochte plankjes. Met stevige metalen hendels. Geschikt voor kinderen vanaf 4 jaar', 32.99, 6, 0),
('4005556005451', 'Ravensburger Tiptoi <br>Het mysterie van het Getalleneiland', 'Ga op schattenjacht met het mysterie van het getalleneiland van Tiptoi! De kinderen lossen rekenopgaven op en verdienen daar waardevolle schatten mee. Door vrolijke minispellen oefenen ze bovendien spelenderwijs het hoofdrekenen en eenvoudige sommen.', 23.99, 16, 0),
('4005556188543', 'Science X Groene Energie - Experimenteerdoos', 'Hoeveel vermogen levert waterkracht? Wat kan windkracht in beweging zetten? Hoe kan zonlicht in warmte omgezet worden? Met de spannende, praktische experimenten in de Science X Groene Energie doos kom je er gauw achter! Je gaat zelf aan de slag en ontdekt de wondere krachten van groene, duurzame energie. Zo ga je zeewater drinkbaar maken, het principe van een waterturbine toepassen of een thermiekcentrale bouwen. 25 experimenten met waterkracht, zonne-energie en biomassa.', 14.99, 11, 0),
('4893669289062', 'Kristallen Groeien - Blauw', 'Kweek nu zelf kristallen, kinderen leren op een simpele, veilige manier hoe ze de gekleurde kristallen laten groeien. Deze set bevat blauwe groeistenen.', 7.99, 25, 15),
('8005125663859', 'Clementoni Maak Zelf Snoep', 'Maak zelf snoep met dit wetenschapsspel van Clementoni. Tover de keuken om in een echt snoeplaboratorium. De doos bevat accessoires, recepten om zelf je snoep te maken! ', 7.99, 15, 0),
('4893338019112', 'Microscoop set compleet in koffer.', 'Ontdek de wereld van de micro organisme. Met behulp van deze microscoop kun je beelden zien die je nooit eerder gezien hebt.', 64.99, 2, 0);

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `ProductCatagorie`
--

CREATE TABLE IF NOT EXISTS `ProductCatagorie` (
  `Productnummer` varchar(255) NOT NULL,
  `Catagorienummer` int(11) NOT NULL,
  PRIMARY KEY (`Productnummer`,`Catagorienummer`),
  KEY `fk_Product_has_Catagorie_Catagorie1_idx` (`Catagorienummer`),
  KEY `fk_Product_has_Catagorie_Product_idx` (`Productnummer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `ProductCatagorie`
--

INSERT INTO `ProductCatagorie` (`Productnummer`, `Catagorienummer`) VALUES
('0075380020443', 2),
('3417761101230', 3),
('3417761113523', 1),
('3417761176238', 1),
('3417761183236', 1),
('3417761209233', 3),
('4005556005451', 4),
('4005556188543', 5),
('4022498515350', 3),
('4893338019112', 5),
('4893669289062', 5),
('8005125663859', 4),
('8410446513132', 2),
('8436538670118', 2),
('8718182370201', 4);

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `Retour`
--

CREATE TABLE IF NOT EXISTS `Retour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Klantnummer` int(11) NOT NULL,
  `Productnummer` varchar(40) NOT NULL,
  `Aantal` int(11) NOT NULL,
  `Datum` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `Retour`
--

