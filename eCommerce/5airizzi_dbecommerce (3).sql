-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 12, 2022 alle 08:48
-- Versione del server: 10.4.6-MariaDB
-- Versione PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `5airizzi_dbecommerce`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articolo`
--

CREATE TABLE `articolo` (
  `ID` int(11) NOT NULL,
  `IdCategoria` int(11) DEFAULT NULL,
  `Nome` varchar(20) NOT NULL,
  `Preview` varchar(80) DEFAULT NULL,
  `Descrizione` text DEFAULT NULL,
  `Quantita` int(2) NOT NULL,
  `Prezzo` float NOT NULL,
  `ImgArticolo` varchar(50) NOT NULL,
  `Venditore` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `articolo`
--

INSERT INTO `articolo` (`ID`, `IdCategoria`, `Nome`, `Preview`, `Descrizione`, `Quantita`, `Prezzo`, `ImgArticolo`, `Venditore`) VALUES
(1, 1, 'Mouse', 'un bel mouse compralo', 'descrizione molto lunga di questo mouse per vedere se funzionano i div e la descrizione è affiancata all\'omonima etichetta e quindi sono felice. aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 10, 19.5, '1Mouse', 'me'),
(2, 2, 'Odiessea', 'Davvero un bel libro', NULL, 1, 9999, '2Odiessea', NULL),
(3, 1, 'Tastiera', 'Una bella tasitera per davvero', NULL, 4, 25, '3Tastiera', NULL),
(4, 2, 'Topolino', 'Una bel libro per davvero', NULL, 8, 14, '4Topolino', NULL),
(5, 1, 'Cuffie', 'cuffie garne', NULL, 7, 30, '5Cuffie', NULL),
(6, 2, 'Bob', 'libro garno', NULL, 5, 19, '6Bob', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `carello`
--

CREATE TABLE `carello` (
  `ID` int(11) NOT NULL,
  `IdUtente` int(11) DEFAULT NULL,
  `Data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `carello`
--

INSERT INTO `carello` (`ID`, `IdUtente`, `Data`) VALUES
(27, NULL, '2022-04-06'),
(28, NULL, '2022-04-06'),
(29, NULL, '2022-04-06');

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`ID`, `Nome`) VALUES
(1, 'Tecnologia'),
(2, 'Libri');

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `ID` int(11) NOT NULL,
  `IdArticolo` int(11) DEFAULT NULL,
  `IdUtente` int(11) DEFAULT NULL,
  `Testo` text NOT NULL,
  `DataScrittura` datetime NOT NULL,
  `Approva` int(11) NOT NULL COMMENT 'Lascia un feedback al commento',
  `Disapprova` int(11) NOT NULL COMMENT 'Lascia un feedback negativo al commento'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `contiene`
--

CREATE TABLE `contiene` (
  `ID` int(11) NOT NULL,
  `IdCarello` int(11) DEFAULT NULL,
  `IdArticolo` int(11) DEFAULT NULL,
  `Quantita` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `contiene`
--

INSERT INTO `contiene` (`ID`, `IdCarello`, `IdArticolo`, `Quantita`) VALUES
(1, 28, 1, 0),
(2, 29, 3, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzo`
--

CREATE TABLE `indirizzo` (
  `ID` int(11) NOT NULL,
  `IdUtente` int(11) DEFAULT NULL,
  `Stato` varchar(20) NOT NULL,
  `Regione` varchar(20) DEFAULT NULL,
  `Provincia` varchar(20) NOT NULL,
  `Citta` varchar(20) NOT NULL,
  `Via` varchar(25) NOT NULL,
  `Civico` int(4) NOT NULL,
  `Cap` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `ID` int(11) NOT NULL,
  `IdCarello` int(11) DEFAULT NULL,
  `DataAcquisto` date NOT NULL,
  `OraAcquisto` time NOT NULL,
  `Prezzo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Cognome` varchar(20) NOT NULL,
  `DataNascita` date DEFAULT NULL,
  `Email` varchar(25) DEFAULT NULL,
  `NumTelefono` varchar(15) DEFAULT NULL,
  `Password` varchar(32) NOT NULL,
  `Admin` int(11) DEFAULT NULL,
  `ImgProfilo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID`, `Nome`, `Cognome`, `DataNascita`, `Email`, `NumTelefono`, `Password`, `Admin`, `ImgProfilo`) VALUES
(1, 'Admin', 'Admin', '2019-02-13', 'email@gmail.com', '+39334556790', '21232f297a57a5a743894a0e4a801fc3', 1, NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articolo`
--
ALTER TABLE `articolo`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idCat` (`IdCategoria`);

--
-- Indici per le tabelle `carello`
--
ALTER TABLE `carello`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `contiene`
--
ALTER TABLE `contiene`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idCarello` (`IdCarello`),
  ADD KEY `idArticolo` (`IdArticolo`);

--
-- Indici per le tabelle `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idUtente` (`IdUtente`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articolo`
--
ALTER TABLE `articolo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `carello`
--
ALTER TABLE `carello`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `contiene`
--
ALTER TABLE `contiene`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `articolo`
--
ALTER TABLE `articolo`
  ADD CONSTRAINT `idCat` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `contiene`
--
ALTER TABLE `contiene`
  ADD CONSTRAINT `idArticolo` FOREIGN KEY (`IdArticolo`) REFERENCES `articolo` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `idCarello` FOREIGN KEY (`IdCarello`) REFERENCES `carello` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD CONSTRAINT `idUtente` FOREIGN KEY (`IdUtente`) REFERENCES `utente` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
