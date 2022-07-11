-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 11, 2022 alle 21:58
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--
CREATE DATABASE IF NOT EXISTS `e-commerce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `e-commerce`;

-- --------------------------------------------------------

--
-- Struttura della tabella `acquisti`
--

CREATE TABLE `acquisti` (
  `ID_acquisto` int(11) NOT NULL,
  `ID_prodotto` int(11) NOT NULL,
  `ID_utente` int(11) NOT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `acquisti`
--

INSERT INTO `acquisti` (`ID_acquisto`, `ID_prodotto`, `ID_utente`, `data`) VALUES
(103, 5, 1, '2022-05-29 07:59:26'),
(104, 5, 1, '2022-05-29 08:00:24');

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `ID_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`ID_admin`, `username`, `password`) VALUES
(1, 'jeff', 'crovBBRCRaIyc');

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `ID_carrello` int(11) NOT NULL,
  `ID_prodotto` int(11) NOT NULL,
  `ID_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`ID_carrello`, `ID_prodotto`, `ID_utente`) VALUES
(311, 17, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `ID_prodotto` int(11) NOT NULL,
  `nome` varchar(10) NOT NULL,
  `descrizione` varchar(40) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `immagine` varchar(50) NOT NULL,
  `prezzo` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`ID_prodotto`, `nome`, `descrizione`, `categoria`, `immagine`, `prezzo`) VALUES
(1, 'Biro', 'Biro bella bella bella per scrivere.', 'Cancelleria', 'img/matitaStilo.png', '1.75'),
(2, 'Gomma', 'Gomma molto molto bella e versatil.', 'Cancelleria', 'img/gommaCanc.png', '1.50'),
(3, 'TuboAcqua', 'Un grandissimo tubo idraulico.', 'Idraulica', 'img/tuboAcqua.png', '11.99'),
(4, 'Forbice', 'Una forbice veramente tanto tagliente.', 'FaiDaTe', 'img/forbice.png', '4.99'),
(5, 'Palla', 'Una meravigliosa palla da calcio. WOW.', 'Sport', 'img/pallaCalcio.png', '22.50'),
(6, 'Cuffiette', 'Cuffiette assurde per la musica fantasti', 'Elettronica', 'img/cuffiette.png', '77.99'),
(7, 'Rolex', 'Rendera migliore il tuo tempo, rendera m', 'Orologi', 'img/rolex.png', '2345.00'),
(8, 'Cerchione', 'Cerchione stra tamarro ed elegante.', 'Auto', 'img/cerchione.png', '33.77'),
(12, 'Braccioli', 'Braccioli stupendi per non annegare.', 'Mare', 'img/braccioli.png', '9.99'),
(13, 'Racchetta', 'Racchetta resistentissima in carbonio.', 'Sport', 'img/racchetta.png', '44.50'),
(14, 'Casio', 'Orologio casio economico.', 'Orologi', 'img/casio.png', '5.00'),
(15, 'Paletta', 'Paletta da spiaggia per castelloni.', 'Mare', 'img/paletta.png', '7.99'),
(16, 'Telefono', 'Telefono di ultima generazione, bello.', 'Elettronica', 'img/telefono.png', '299.50'),
(17, 'PortaTel', 'Porta telefono per automobili.', 'Auto', 'img/portaTel.png', '25.00'),
(18, 'Colla', 'Colla per fogli di carta, attacco molto.', 'FaiDaTe', 'img/colla.png', '3.99'),
(19, 'Scopino', 'Scopino meraviglioso per il water.', 'Idraulica', 'img/scopino.png', '7.99'),
(20, 'Secchiello', 'Secchiello da mare per la sabbia.', 'Mare', 'img/secchiello.png', '0.50'),
(21, 'Astuccio', 'Astuccio spazioso per bigliettini.', 'Cancelleria', 'img/astuccio.png', '10.50'),
(22, 'T-shirt', 'T-shirt supreme originalissima, new york', 'Abbigliamento', 'img/t-shirt.png', '12.70');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `ID_utente` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `bilancio` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`ID_utente`, `username`, `password`, `indirizzo`, `nome`, `cognome`, `bilancio`) VALUES
(13, 'Ludo', 'crOlLwU4cvjkM', 'Marco Polo, 15', 'Ludovico', 'Aldrovandi', '0.00');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `acquisti`
--
ALTER TABLE `acquisti`
  ADD PRIMARY KEY (`ID_acquisto`);

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_admin`);

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`ID_carrello`);

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`ID_prodotto`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`ID_utente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `acquisti`
--
ALTER TABLE `acquisti`
  MODIFY `ID_acquisto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `ID_carrello` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;

--
-- AUTO_INCREMENT per la tabella `prodotti`
--
ALTER TABLE `prodotti`
  MODIFY `ID_prodotto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `ID_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
