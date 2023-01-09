-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Pát 25. bře 2022, 09:22
-- Verze serveru: 10.1.48-MariaDB-0ubuntu0.18.04.1
-- Verze PHP: 7.2.24-0ubuntu0.18.04.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `kasalpe18_1`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `adresa`
--

CREATE TABLE `adresa` (
  `id` int(11) NOT NULL,
  `idobjednavky` int(11) NOT NULL,
  `jmeno` varchar(255) NOT NULL,
  `prijmeni` varchar(255) NOT NULL,
  `tel` int(9) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mesto` varchar(255) NOT NULL,
  `ulice` varchar(255) NOT NULL,
  `cp` int(10) NOT NULL,
  `psc` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `adresa`
--

INSERT INTO `adresa` (`id`, `idobjednavky`, `jmeno`, `prijmeni`, `tel`, `mail`, `mesto`, `ulice`, `cp`, `psc`) VALUES
(7, 20, 'Petr', 'Kasal', 123456789, 'petrkasal22@gmail.com', 'Krucemburk', 'Náměstí Jana zrzavého', 15, 58266),
(6, 19, 'Jaroslav', 'Dlouhý', 666666666, 'uzivatel@uzivatel.cz', 'Kocourkov', 'Velká', 13, 58266),
(5, 18, 'Petr', 'Kasal', 608256764, 'petrkasal22@gmail.com', 'Krucemburk', 'náměstí jana zrzavého', 15, 58266);

-- --------------------------------------------------------

--
-- Struktura tabulky `druhy`
--

CREATE TABLE `druhy` (
  `id` int(11) NOT NULL,
  `nazev` varchar(255) NOT NULL,
  `zkratka` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `druhy`
--

INSERT INTO `druhy` (`id`, `nazev`, `zkratka`) VALUES
(1, 'Skotské Whisky', 'skotska'),
(2, 'Irské Whiskey', 'irska'),
(4, 'Americké Whiskey', 'americka'),
(5, 'Japonské Whisky', 'japonska'),
(6, 'České Whisky', 'ceske'),
(7, 'Kanadské Whiskey', 'kanadska');

-- --------------------------------------------------------

--
-- Struktura tabulky `hodnoceniobchodu`
--

CREATE TABLE `hodnoceniobchodu` (
  `id` int(11) NOT NULL,
  `hodnota` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `hodnoceniobchodu`
--

INSERT INTO `hodnoceniobchodu` (`id`, `hodnota`, `mail`) VALUES
(1, 5, 'kokot@mail.cz'),
(2, 5, 'tdosta2@gmail.com'),
(3, 1, 'kvarteto22@seznam.cz'),
(4, 5, 'petrkasal22@gmail.com'),
(5, 5, 'kokot@pica.cz');

-- --------------------------------------------------------

--
-- Struktura tabulky `hodnoceniproduktu`
--

CREATE TABLE `hodnoceniproduktu` (
  `id` int(11) NOT NULL,
  `hodnota` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `idproduktu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `hodnoceniproduktu`
--

INSERT INTO `hodnoceniproduktu` (`id`, `hodnota`, `mail`, `idproduktu`) VALUES
(3, 1, 'kvarteto22@seznam.cz', 27),
(12, 3, 'petrkasal22@gmail.com', 27),
(13, 4, 'petrkasal22@gmail.com', 15),
(14, 5, 'petrkasal22@gmail.com', 24),
(15, 4, 'petrkasal22@gmail.com', 28),
(16, 5, 'petrkasal22@gmail.com', 30),
(17, 5, 'petrkasal22@gmail.com', 31),
(18, 5, 'petrkasal22@gmail.com', 32),
(19, 5, 'petrkasal22@gmail.com', 25),
(20, 5, 'kokot@pica.cz', 32),
(21, 4, 'kvarteto22@seznam.com', 32),
(22, 5, 'admin@admin.cz', 89),
(23, 2, 'admin@admin.cz', 88),
(24, 4, 'uzivatel@uzivatel.cz', 89);

-- --------------------------------------------------------

--
-- Struktura tabulky `komentare`
--

CREATE TABLE `komentare` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `komentar` varchar(1000) NOT NULL,
  `idproduktu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `komentare`
--

INSERT INTO `komentare` (`id`, `mail`, `komentar`, `idproduktu`) VALUES
(28, 'petrkasal22@gmail.com', 'topovka\r\n', 28),
(27, 'petrkasal22@gmail.com', 'skvělé', 15),
(37, 'admin@admin.cz', 'Skvělá whisky', 89),
(30, 'petrkasal22@gmail.com', 'Skvělá whisky', 31),
(33, 'petrkasal22@gmail.com', 'Skvělá dekorace', 30),
(34, 'kvarteto22@seznam.com', 'pěkné', 30),
(36, 'admin@admin.cz', 'Pěkné\r\n', 32),
(38, 'admin@admin.cz', 'Čekal jsem lepší', 88),
(39, 'uzivatel@uzivatel.cz', 'Příjemná chuť', 89);

-- --------------------------------------------------------

--
-- Struktura tabulky `objednavka`
--

CREATE TABLE `objednavka` (
  `id` int(11) NOT NULL,
  `idproduktu` int(11) NOT NULL,
  `pocet` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `objednavka`
--

INSERT INTO `objednavka` (`id`, `idproduktu`, `pocet`) VALUES
(17, 28, 4),
(17, 27, 4),
(17, 29, 3),
(18, 32, 3),
(18, 31, 2),
(18, 30, 2),
(19, 76, 3),
(19, 77, 3),
(20, 89, 1),
(20, 88, 1),
(20, 87, 1),
(20, 86, 1),
(20, 85, 1),
(20, 84, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `oblibene`
--

CREATE TABLE `oblibene` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `idproduktu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `oblibene`
--

INSERT INTO `oblibene` (`id`, `mail`, `idproduktu`) VALUES
(129, 'petrkasal22@gmail.com', 15),
(128, 'petrkasal22@gmail.com', 21),
(127, 'petrkasal22@gmail.com', 25),
(126, 'petrkasal22@gmail.com', 27),
(131, 'kvarteto22@seznam.cz', 15),
(132, 'kvarteto22@seznam.cz', 24),
(133, 'kvarteto22@seznam.cz', 19),
(134, 'kvarteto22@seznam.cz', 18),
(135, 'petrkasal22@gmail.com', 24),
(137, 'petrkasal22@gmail.com', 28),
(138, 'kvarteto22@seznam.cz', 31),
(139, 'petrkasal22@gmail.com', 30),
(140, 'petrkasal22@gmail.com', 31),
(141, 'petrkasal22@gmail.com', 32),
(142, 'kokot@pica.cz', 25),
(145, 'kokot@pica.cz', 21),
(144, 'kokot@pica.cz', 32),
(146, 'kokot@pica.cz', 27),
(147, 'admin@admin.cz', 89),
(148, 'admin@admin.cz', 88),
(149, 'admin@admin.cz', 87),
(150, 'admin@admin.cz', 85),
(151, 'admin@admin.cz', 79),
(152, 'admin@admin.cz', 73),
(153, 'admin@admin.cz', 76),
(154, 'admin@admin.cz', 75),
(155, 'admin@admin.cz', 70);

-- --------------------------------------------------------

--
-- Struktura tabulky `produkt`
--

CREATE TABLE `produkt` (
  `nazev` varchar(255) NOT NULL,
  `cena` int(11) NOT NULL,
  `popis` varchar(1000) NOT NULL,
  `id` int(11) NOT NULL,
  `obrazek` varchar(255) NOT NULL,
  `typ` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `produkt`
--

INSERT INTO `produkt` (`nazev`, `cena`, `popis`, `id`, `obrazek`, `typ`) VALUES
('Isle of Jura 21y', 3600, 'Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 45, '623cd664367cd_62388f9e39930_621cfb39e7bea_thumb_340_380_154937328398998_cosa-nostra_scotch-whisky_700-removebg-preview.png', 'skotska'),
('Ledaig 18y', 7400, 'Po Tobermory je Ledaig druhou značkou whisky vyráběnou v jediné palírně na ostrově Mull, Tobermory Distillery. Ledaig 18 Years Old je dobře postavená, jemná, sladká a ovocná whisky, která zrála v sudech po Cherry. Je zde výrazný zakouřený a rašelinový nádech s mírnou přítomností mořského vánku. Do popředí se dostávají vůně ovoce, sherry, mořských řas, kouře, chilli a dubu. Bohatá chuť s tóny sherry, bylinek, kouře, tabáku, bílého pepře, kávy, pomeranče a mořské soli.', 46, '623cd666cb580_620aa82b21da8_image.png', 'skotska'),
('Glencadam 21y', 9500, ' Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 47, '623cd66904bf5_62310aa1c1c0e_621cf9a4cfc3c_botella-whisky-png-3-Transparent-Images-Free.png', 'skotska'),
('Glenfiddich 12y', 1500, '  Glenfiddich jako skotská single malt whisky si ji ani nemůže dovolit. Whisky Glenfiddich 12 let vévodí mezi všemi svými sestrami, neboť je nejprodávanější single malt whisky na světě. Nespěchá a minimálně celých dvanáct let odpočívá v sudech ze španělského a amerického dubu, což přispívá k její slastné a vyzrálé chuti. Na konci této kúry je z ní zcela zralý a rozvážný jedinec, se kterým stojí za to se seznámit. Díky svému hruškovému parfému doplněnému vanilkou je z něj ideální partner pro přátelské posezení nebo soukromou chvilku pohody a oddechu, dokáže však být i zábavným společníkem, který nemůže chybět na žádné významné párty.', 48, '623cd66b94863_image-removebg-preview.png', 'skotska'),
('Whisky 18y', 900, ' Toto slavností číslo mluví za vše. Zralá a perfektní. Co o sobě whisky Glenfiddich 18y let ještě říká? Jedná se o krásku, která stihla za svůj osmnáctiletý život získat ty nejlepší vlastnosti. Aby ne, také prošla výchovou dubových sudů po sherry oloroso a bourbonu, díky nimž si zachovává neskutečně jemnou a zralou chuť. Glenfiddich 18 let jako dobře vychovaná krasavice je tou nejoceňovanější skotskou whisky všech dob. ', 49, '623cd67d2a7f8_image-removebg-preview (1).png', 'skotska'),
('Whisky 18y', 900, ' Toto slavností číslo mluví za vše. Zralá a perfektní. Co o sobě whisky Glenfiddich 18y let ještě říká? Jedná se o krásku, která stihla za svůj osmnáctiletý život získat ty nejlepší vlastnosti. Aby ne, také prošla výchovou dubových sudů po sherry oloroso a bourbonu, díky nimž si zachovává neskutečně jemnou a zralou chuť. Glenfiddich 18 let jako dobře vychovaná krasavice je tou nejoceňovanější skotskou whisky všech dob. ', 50, '623cd69631dd8_image-removebg-preview (1).png', 'skotska'),
('Isle of Jura 21y', 3600, 'Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 51, '623cd69867fff_62388f9e39930_621cfb39e7bea_thumb_340_380_154937328398998_cosa-nostra_scotch-whisky_700-removebg-preview.png', 'skotska'),
('Ledaig 18y', 7400, 'Po Tobermory je Ledaig druhou značkou whisky vyráběnou v jediné palírně na ostrově Mull, Tobermory Distillery. Ledaig 18 Years Old je dobře postavená, jemná, sladká a ovocná whisky, která zrála v sudech po Cherry. Je zde výrazný zakouřený a rašelinový nádech s mírnou přítomností mořského vánku. Do popředí se dostávají vůně ovoce, sherry, mořských řas, kouře, chilli a dubu. Bohatá chuť s tóny sherry, bylinek, kouře, tabáku, bílého pepře, kávy, pomeranče a mořské soli.', 52, '623cd69d08a40_620aa82b21da8_image.png', 'irska'),
('Glencadam 21y', 9500, ' Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 53, '623cd6a089611_62310aa1c1c0e_621cf9a4cfc3c_botella-whisky-png-3-Transparent-Images-Free.png', 'irska'),
('Glenfiddich 12y', 1500, '  Glenfiddich jako skotská single malt whisky si ji ani nemůže dovolit. Whisky Glenfiddich 12 let vévodí mezi všemi svými sestrami, neboť je nejprodávanější single malt whisky na světě. Nespěchá a minimálně celých dvanáct let odpočívá v sudech ze španělského a amerického dubu, což přispívá k její slastné a vyzrálé chuti. Na konci této kúry je z ní zcela zralý a rozvážný jedinec, se kterým stojí za to se seznámit. Díky svému hruškovému parfému doplněnému vanilkou je z něj ideální partner pro přátelské posezení nebo soukromou chvilku pohody a oddechu, dokáže však být i zábavným společníkem, který nemůže chybět na žádné významné párty.', 54, '623cd6a3e2ccb_image-removebg-preview.png', 'irska'),
('Isle of Jura 21y', 3600, 'Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 55, '623cd6a905703_62388f9e39930_621cfb39e7bea_thumb_340_380_154937328398998_cosa-nostra_scotch-whisky_700-removebg-preview.png', 'irska'),
('Whisky 18y', 900, ' Toto slavností číslo mluví za vše. Zralá a perfektní. Co o sobě whisky Glenfiddich 18y let ještě říká? Jedná se o krásku, která stihla za svůj osmnáctiletý život získat ty nejlepší vlastnosti. Aby ne, také prošla výchovou dubových sudů po sherry oloroso a bourbonu, díky nimž si zachovává neskutečně jemnou a zralou chuť. Glenfiddich 18 let jako dobře vychovaná krasavice je tou nejoceňovanější skotskou whisky všech dob. ', 56, '623cd6ac9ceec_image-removebg-preview (1).png', 'irska'),
('Whisky 18y', 900, ' Toto slavností číslo mluví za vše. Zralá a perfektní. Co o sobě whisky Glenfiddich 18y let ještě říká? Jedná se o krásku, která stihla za svůj osmnáctiletý život získat ty nejlepší vlastnosti. Aby ne, také prošla výchovou dubových sudů po sherry oloroso a bourbonu, díky nimž si zachovává neskutečně jemnou a zralou chuť. Glenfiddich 18 let jako dobře vychovaná krasavice je tou nejoceňovanější skotskou whisky všech dob. ', 57, '623cd71395111_image-removebg-preview (1).png', 'irska'),
('Isle of Jura 21y', 3600, 'Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 58, '623cd7198ae8f_62388f9e39930_621cfb39e7bea_thumb_340_380_154937328398998_cosa-nostra_scotch-whisky_700-removebg-preview.png', 'americka'),
('Ledaig 18y', 7400, 'Po Tobermory je Ledaig druhou značkou whisky vyráběnou v jediné palírně na ostrově Mull, Tobermory Distillery. Ledaig 18 Years Old je dobře postavená, jemná, sladká a ovocná whisky, která zrála v sudech po Cherry. Je zde výrazný zakouřený a rašelinový nádech s mírnou přítomností mořského vánku. Do popředí se dostávají vůně ovoce, sherry, mořských řas, kouře, chilli a dubu. Bohatá chuť s tóny sherry, bylinek, kouře, tabáku, bílého pepře, kávy, pomeranče a mořské soli.', 59, '623cd71cd62e4_620aa82b21da8_image.png', 'americka'),
('Glencadam 21y', 9500, ' Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 60, '623cd7207b905_62310aa1c1c0e_621cf9a4cfc3c_botella-whisky-png-3-Transparent-Images-Free.png', 'americka'),
('Glencadam 21y', 9500, ' Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 61, '623cd7223df4e_62310aa1c1c0e_621cf9a4cfc3c_botella-whisky-png-3-Transparent-Images-Free.png', 'americka'),
('Glenfiddich 12y', 1500, '  Glenfiddich jako skotská single malt whisky si ji ani nemůže dovolit. Whisky Glenfiddich 12 let vévodí mezi všemi svými sestrami, neboť je nejprodávanější single malt whisky na světě. Nespěchá a minimálně celých dvanáct let odpočívá v sudech ze španělského a amerického dubu, což přispívá k její slastné a vyzrálé chuti. Na konci této kúry je z ní zcela zralý a rozvážný jedinec, se kterým stojí za to se seznámit. Díky svému hruškovému parfému doplněnému vanilkou je z něj ideální partner pro přátelské posezení nebo soukromou chvilku pohody a oddechu, dokáže však být i zábavným společníkem, který nemůže chybět na žádné významné párty.', 62, '623cd725bf6a1_image-removebg-preview.png', 'americka'),
('Isle of Jura 21y', 3600, 'Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 63, '623cd728a79f0_62388f9e39930_621cfb39e7bea_thumb_340_380_154937328398998_cosa-nostra_scotch-whisky_700-removebg-preview.png', 'americka'),
('Whisky 18y', 900, ' Toto slavností číslo mluví za vše. Zralá a perfektní. Co o sobě whisky Glenfiddich 18y let ještě říká? Jedná se o krásku, která stihla za svůj osmnáctiletý život získat ty nejlepší vlastnosti. Aby ne, také prošla výchovou dubových sudů po sherry oloroso a bourbonu, díky nimž si zachovává neskutečně jemnou a zralou chuť. Glenfiddich 18 let jako dobře vychovaná krasavice je tou nejoceňovanější skotskou whisky všech dob. ', 64, '623cd72c7b74c_image-removebg-preview (1).png', 'americka'),
('Whisky 18y', 900, ' Toto slavností číslo mluví za vše. Zralá a perfektní. Co o sobě whisky Glenfiddich 18y let ještě říká? Jedná se o krásku, která stihla za svůj osmnáctiletý život získat ty nejlepší vlastnosti. Aby ne, také prošla výchovou dubových sudů po sherry oloroso a bourbonu, díky nimž si zachovává neskutečně jemnou a zralou chuť. Glenfiddich 18 let jako dobře vychovaná krasavice je tou nejoceňovanější skotskou whisky všech dob. ', 65, '623cd73003776_image-removebg-preview (1).png', 'japonska'),
('Isle of Jura 21y', 3600, 'Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 66, '623cd733251bb_62388f9e39930_621cfb39e7bea_thumb_340_380_154937328398998_cosa-nostra_scotch-whisky_700-removebg-preview.png', 'japonska'),
('Ledaig 18y', 7400, 'Po Tobermory je Ledaig druhou značkou whisky vyráběnou v jediné palírně na ostrově Mull, Tobermory Distillery. Ledaig 18 Years Old je dobře postavená, jemná, sladká a ovocná whisky, která zrála v sudech po Cherry. Je zde výrazný zakouřený a rašelinový nádech s mírnou přítomností mořského vánku. Do popředí se dostávají vůně ovoce, sherry, mořských řas, kouře, chilli a dubu. Bohatá chuť s tóny sherry, bylinek, kouře, tabáku, bílého pepře, kávy, pomeranče a mořské soli.', 67, '623cd736a7e09_620aa82b21da8_image.png', 'japonska'),
('Whisky 18y', 900, ' Toto slavností číslo mluví za vše. Zralá a perfektní. Co o sobě whisky Glenfiddich 18y let ještě říká? Jedná se o krásku, která stihla za svůj osmnáctiletý život získat ty nejlepší vlastnosti. Aby ne, také prošla výchovou dubových sudů po sherry oloroso a bourbonu, díky nimž si zachovává neskutečně jemnou a zralou chuť. Glenfiddich 18 let jako dobře vychovaná krasavice je tou nejoceňovanější skotskou whisky všech dob. ', 68, '623cd73929674_image-removebg-preview (1).png', 'japonska'),
('Glencadam 21y', 9500, ' Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 69, '623cd73c45bda_62310aa1c1c0e_621cf9a4cfc3c_botella-whisky-png-3-Transparent-Images-Free.png', 'japonska'),
('Glencadam 21y', 9500, ' Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 70, '623cd73e82729_62310aa1c1c0e_621cf9a4cfc3c_botella-whisky-png-3-Transparent-Images-Free.png', 'japonska'),
('Glenfiddich 12y', 1500, '  Glenfiddich jako skotská single malt whisky si ji ani nemůže dovolit. Whisky Glenfiddich 12 let vévodí mezi všemi svými sestrami, neboť je nejprodávanější single malt whisky na světě. Nespěchá a minimálně celých dvanáct let odpočívá v sudech ze španělského a amerického dubu, což přispívá k její slastné a vyzrálé chuti. Na konci této kúry je z ní zcela zralý a rozvážný jedinec, se kterým stojí za to se seznámit. Díky svému hruškovému parfému doplněnému vanilkou je z něj ideální partner pro přátelské posezení nebo soukromou chvilku pohody a oddechu, dokáže však být i zábavným společníkem, který nemůže chybět na žádné významné párty.', 71, '623cd7421a3d1_image-removebg-preview.png', 'japonska'),
('Glencadam 21y', 9500, ' Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 72, '623cd74601538_62310aa1c1c0e_621cf9a4cfc3c_botella-whisky-png-3-Transparent-Images-Free.png', 'japonska'),
('Whisky 18y', 900, ' Toto slavností číslo mluví za vše. Zralá a perfektní. Co o sobě whisky Glenfiddich 18y let ještě říká? Jedná se o krásku, která stihla za svůj osmnáctiletý život získat ty nejlepší vlastnosti. Aby ne, také prošla výchovou dubových sudů po sherry oloroso a bourbonu, díky nimž si zachovává neskutečně jemnou a zralou chuť. Glenfiddich 18 let jako dobře vychovaná krasavice je tou nejoceňovanější skotskou whisky všech dob. ', 73, '623cd748ac517_image-removebg-preview (1).png', 'japonska'),
('Whisky 18y', 900, ' Toto slavností číslo mluví za vše. Zralá a perfektní. Co o sobě whisky Glenfiddich 18y let ještě říká? Jedná se o krásku, která stihla za svůj osmnáctiletý život získat ty nejlepší vlastnosti. Aby ne, také prošla výchovou dubových sudů po sherry oloroso a bourbonu, díky nimž si zachovává neskutečně jemnou a zralou chuť. Glenfiddich 18 let jako dobře vychovaná krasavice je tou nejoceňovanější skotskou whisky všech dob. ', 74, '623cd74c1e59f_image-removebg-preview (1).png', 'ceske'),
('Isle of Jura 21y', 3600, 'Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 75, '623cd75080cc9_62388f9e39930_621cfb39e7bea_thumb_340_380_154937328398998_cosa-nostra_scotch-whisky_700-removebg-preview.png', 'ceske'),
('Ledaig 18y', 7400, 'Po Tobermory je Ledaig druhou značkou whisky vyráběnou v jediné palírně na ostrově Mull, Tobermory Distillery. Ledaig 18 Years Old je dobře postavená, jemná, sladká a ovocná whisky, která zrála v sudech po Cherry. Je zde výrazný zakouřený a rašelinový nádech s mírnou přítomností mořského vánku. Do popředí se dostávají vůně ovoce, sherry, mořských řas, kouře, chilli a dubu. Bohatá chuť s tóny sherry, bylinek, kouře, tabáku, bílého pepře, kávy, pomeranče a mořské soli.', 76, '623cd753d7efc_620aa82b21da8_image.png', 'ceske'),
('Glencadam 21y', 9500, ' Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 77, '623cd75766a31_62310aa1c1c0e_621cf9a4cfc3c_botella-whisky-png-3-Transparent-Images-Free.png', 'ceske'),
('Glenfiddich 12y', 1500, '  Glenfiddich jako skotská single malt whisky si ji ani nemůže dovolit. Whisky Glenfiddich 12 let vévodí mezi všemi svými sestrami, neboť je nejprodávanější single malt whisky na světě. Nespěchá a minimálně celých dvanáct let odpočívá v sudech ze španělského a amerického dubu, což přispívá k její slastné a vyzrálé chuti. Na konci této kúry je z ní zcela zralý a rozvážný jedinec, se kterým stojí za to se seznámit. Díky svému hruškovému parfému doplněnému vanilkou je z něj ideální partner pro přátelské posezení nebo soukromou chvilku pohody a oddechu, dokáže však být i zábavným společníkem, který nemůže chybět na žádné významné párty.', 78, '623cd75ab7b8d_image-removebg-preview.png', 'ceske'),
('Whisky 18y', 900, ' Toto slavností číslo mluví za vše. Zralá a perfektní. Co o sobě whisky Glenfiddich 18y let ještě říká? Jedná se o krásku, která stihla za svůj osmnáctiletý život získat ty nejlepší vlastnosti. Aby ne, také prošla výchovou dubových sudů po sherry oloroso a bourbonu, díky nimž si zachovává neskutečně jemnou a zralou chuť. Glenfiddich 18 let jako dobře vychovaná krasavice je tou nejoceňovanější skotskou whisky všech dob. ', 79, '623cd78d4cd40_image-removebg-preview (1).png', 'kanadska'),
('Isle of Jura 21y', 3600, 'Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 80, '623cd7922913c_62388f9e39930_621cfb39e7bea_thumb_340_380_154937328398998_cosa-nostra_scotch-whisky_700-removebg-preview.png', 'kanadska'),
('Ledaig 18y', 7400, 'Po Tobermory je Ledaig druhou značkou whisky vyráběnou v jediné palírně na ostrově Mull, Tobermory Distillery. Ledaig 18 Years Old je dobře postavená, jemná, sladká a ovocná whisky, která zrála v sudech po Cherry. Je zde výrazný zakouřený a rašelinový nádech s mírnou přítomností mořského vánku. Do popředí se dostávají vůně ovoce, sherry, mořských řas, kouře, chilli a dubu. Bohatá chuť s tóny sherry, bylinek, kouře, tabáku, bílého pepře, kávy, pomeranče a mořské soli.', 81, '623cd797abf2e_620aa82b21da8_image.png', 'kanadska'),
('Glencadam 21y', 9500, ' Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 82, '623cd79aee7a0_62310aa1c1c0e_621cf9a4cfc3c_botella-whisky-png-3-Transparent-Images-Free.png', 'kanadska'),
('Glenfiddich 12y', 1500, '  Glenfiddich jako skotská single malt whisky si ji ani nemůže dovolit. Whisky Glenfiddich 12 let vévodí mezi všemi svými sestrami, neboť je nejprodávanější single malt whisky na světě. Nespěchá a minimálně celých dvanáct let odpočívá v sudech ze španělského a amerického dubu, což přispívá k její slastné a vyzrálé chuti. Na konci této kúry je z ní zcela zralý a rozvážný jedinec, se kterým stojí za to se seznámit. Díky svému hruškovému parfému doplněnému vanilkou je z něj ideální partner pro přátelské posezení nebo soukromou chvilku pohody a oddechu, dokáže však být i zábavným společníkem, který nemůže chybět na žádné významné párty.', 83, '623cd79e78b96_image-removebg-preview.png', 'kanadska'),
('Glencadam 21y', 9500, ' Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 84, '623cd7a27ea0f_62310aa1c1c0e_621cf9a4cfc3c_botella-whisky-png-3-Transparent-Images-Free.png', 'kanadska'),
('Whisky 18y', 900, ' Toto slavností číslo mluví za vše. Zralá a perfektní. Co o sobě whisky Glenfiddich 18y let ještě říká? Jedná se o krásku, která stihla za svůj osmnáctiletý život získat ty nejlepší vlastnosti. Aby ne, také prošla výchovou dubových sudů po sherry oloroso a bourbonu, díky nimž si zachovává neskutečně jemnou a zralou chuť. Glenfiddich 18 let jako dobře vychovaná krasavice je tou nejoceňovanější skotskou whisky všech dob. ', 85, '623cd7ab26fb3_image-removebg-preview (1).png', 'skotska'),
('Isle of Jura 21y', 3600, 'Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 86, '623cd7aee8eaf_62388f9e39930_621cfb39e7bea_thumb_340_380_154937328398998_cosa-nostra_scotch-whisky_700-removebg-preview.png', 'irska'),
('Ledaig 18y', 7400, 'Po Tobermory je Ledaig druhou značkou whisky vyráběnou v jediné palírně na ostrově Mull, Tobermory Distillery. Ledaig 18 Years Old je dobře postavená, jemná, sladká a ovocná whisky, která zrála v sudech po Cherry. Je zde výrazný zakouřený a rašelinový nádech s mírnou přítomností mořského vánku. Do popředí se dostávají vůně ovoce, sherry, mořských řas, kouře, chilli a dubu. Bohatá chuť s tóny sherry, bylinek, kouře, tabáku, bílého pepře, kávy, pomeranče a mořské soli.', 87, '623cd7b168074_620aa82b21da8_image.png', 'americka'),
('Glencadam 21y', 9500, ' Pojmenována podle ostrova, kde je destilována, již od roku 1810 ve vesnici Craighouse, kde je jedinou výrobnou single malt whisky a chloubou obyvatel ostrova. Po 21 letech tichého zrání je tou správnou whisky k posezení a popíjení, jak si její jemná chuť sedne na vaše patro.', 88, '623cd7b401e6c_62310aa1c1c0e_621cf9a4cfc3c_botella-whisky-png-3-Transparent-Images-Free.png', 'japonska'),
('Glenfiddich 12y', 1500, '  Glenfiddich jako skotská single malt whisky si ji ani nemůže dovolit. Whisky Glenfiddich 12 let vévodí mezi všemi svými sestrami, neboť je nejprodávanější single malt whisky na světě. Nespěchá a minimálně celých dvanáct let odpočívá v sudech ze španělského a amerického dubu, což přispívá k její slastné a vyzrálé chuti. Na konci této kúry je z ní zcela zralý a rozvážný jedinec, se kterým stojí za to se seznámit. Díky svému hruškovému parfému doplněnému vanilkou je z něj ideální partner pro přátelské posezení nebo soukromou chvilku pohody a oddechu, dokáže však být i zábavným společníkem, který nemůže chybět na žádné významné párty.', 89, '623cd7b65f7b8_image-removebg-preview.png', 'ceske');

-- --------------------------------------------------------

--
-- Struktura tabulky `stavy`
--

CREATE TABLE `stavy` (
  `idobjednavky` int(11) NOT NULL,
  `stav` varchar(100) NOT NULL DEFAULT 'sklad'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `stavy`
--

INSERT INTO `stavy` (`idobjednavky`, `stav`) VALUES
(17, 'doruceno'),
(18, 'omluva'),
(19, 'Na skladě'),
(20, 'Na skladě');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel` (
  `mail` varchar(255) NOT NULL,
  `heslo` varchar(255) NOT NULL,
  `admin` int(1) NOT NULL COMMENT '1 = Admin',
  `nazev` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`mail`, `heslo`, `admin`, `nazev`) VALUES
('petrkasal22@gmail.com', '$2y$10$ukvzYifR.GuLKvx9Us.coOQKKLYf0HEDfMWVoVzZ2.XdfhXgWfOyy', 1, 'ADMIN'),
('kvarteto22@seznam.cz', '$2y$10$THTp9TLiaFLPEjIUvhrvvexRmWcAMb/xhNZVHUdxaJY8/HlVbfcCW', 0, 'Hustej_Bouchač'),
('tdosta2@gmail.com', '$2y$10$K4Y2PI4p7MpyZ.WH0l2./OfvDJKCSxFyfVVBOzrn1y4MQEXCGNXm2', 1, 'kokot'),
('admin@admin.cz', '$2y$10$9Bg9rEgaPw3OF165aUkC9uy8U8BaDlFctOMyvDdS3wRKSt4Swf9UK', 1, 'AdminSpseMaturita'),
('uzivatel@uzivatel.cz', '$2y$10$5V58.sPzXA0beyakp.SSqO.hGr7qgvKpikz9M3zLZpfU5JL30nc0O', 0, 'uzivatelSpseMaturita');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `adresa`
--
ALTER TABLE `adresa`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `druhy`
--
ALTER TABLE `druhy`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `hodnoceniobchodu`
--
ALTER TABLE `hodnoceniobchodu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Klíče pro tabulku `hodnoceniproduktu`
--
ALTER TABLE `hodnoceniproduktu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idproduktu` (`idproduktu`,`mail`);

--
-- Klíče pro tabulku `komentare`
--
ALTER TABLE `komentare`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mail` (`mail`),
  ADD KEY `idproduktu` (`idproduktu`);

--
-- Klíče pro tabulku `objednavka`
--
ALTER TABLE `objednavka`
  ADD PRIMARY KEY (`id`,`idproduktu`);

--
-- Klíče pro tabulku `oblibene`
--
ALTER TABLE `oblibene`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `stavy`
--
ALTER TABLE `stavy`
  ADD PRIMARY KEY (`idobjednavky`);

--
-- Klíče pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`mail`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `adresa`
--
ALTER TABLE `adresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `druhy`
--
ALTER TABLE `druhy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `hodnoceniobchodu`
--
ALTER TABLE `hodnoceniobchodu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `hodnoceniproduktu`
--
ALTER TABLE `hodnoceniproduktu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pro tabulku `komentare`
--
ALTER TABLE `komentare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pro tabulku `oblibene`
--
ALTER TABLE `oblibene`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT pro tabulku `produkt`
--
ALTER TABLE `produkt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
