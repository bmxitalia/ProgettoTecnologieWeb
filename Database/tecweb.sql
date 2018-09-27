-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 12, 2018 alle 09:39
-- Versione del server: 10.1.29-MariaDB
-- Versione PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tecweb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`ID`, `username`, `password`, `mail`) VALUES
(3784, 'admin', 'admin', 'admin@admin.it');

-- --------------------------------------------------------

--
-- Struttura della tabella `alloggi`
--

CREATE TABLE `alloggi` (
  `ID` int(5) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Via` varchar(100) NOT NULL,
  `NumeroCivico` int(5) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Immagine` varchar(255) DEFAULT NULL,
  `Prezzo` decimal(5,2) DEFAULT NULL,
  `Stelle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `alloggi`
--

INSERT INTO `alloggi` (`ID`, `Nome`, `Via`, `NumeroCivico`, `Email`, `Immagine`, `Prezzo`, `Stelle`) VALUES
(1, 'NH Padova', 'Via Niccolo Tommaseo', 61, 'nhpadova@gmail.com', 'nhpadova.png', '86.00', '4 Stelle'),
(2, 'B&B Hotel Padova', 'Via del Pescarotto', 39, 'bbhotel@gmail.com', 'bbhotel.png', '48.00', '3 Stelle'),
(3, 'Four Points by Sheraton', 'Corso Argentina', 5, 'fourpoints@gmail.com', 'fourpoints.png', '69.00', '4 Stelle');

-- --------------------------------------------------------

--
-- Struttura della tabella `articoli`
--

CREATE TABLE `articoli` (
  `ID` int(11) NOT NULL,
  `titolo` varchar(200) CHARACTER SET utf8 NOT NULL,
  `immagine` varchar(50) CHARACTER SET utf8 NOT NULL,
  `alt` varchar(200) CHARACTER SET utf8 NOT NULL,
  `testo` text CHARACTER SET utf8 NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `articoli`
--

INSERT INTO `articoli` (`ID`, `titolo`, `immagine`, `alt`, `testo`, `data`) VALUES
(8, 'La corsa solidale della Padova <span xml:lang=\'en\'>Marathon</span>: più di 30 mila euro in beneficienza', 'immagine1.jpg', 'Nella foto Mauro Bergamasco al traguardo della maratona di Padova 2017', 'Una Padova <span xml:lang=\\\'en\\\'>Marathon</span> dal cuore d’oro. O, meglio: il cuore d’oro è quello di tutti coloro che hanno partecipato all’evento dello scorso 23 aprile impegnandosi in uno dei 18 progetti solidali a esso abbinati. A poco più di un mese di distanza è possibile stilare infatti un primo bilancio. E così emerge che sono stati più di 30 mila gli euro raccolti dal <span xml:lang=\\\'en\\\'>Charity Program</span> 2017.<br/><br/>Le onlus che hanno aderito al progetto hanno ricevuto in totale ben 491 offerte realizzate <span xml:lang=\\\'en\\\'>online</span> su Rete del dono. In un ideale podio, le associazioni che hanno raccolto di più sono state <span xml:lang=\\\'en\\\'>Team For Children</span> (progetto: Vesti insieme a noi la <span xml:lang=\\\'en\\\'>Teen Zone</span>) con oltre 6 mila euro e 127 donazioni <span xml:lang=\\\'en\\\'>online</span>; Piccoli Punti Onlus (Una cura più efficace per il melanoma!) con 4.500 euro, frutto di 72 donazioni <span xml:lang=\\\'en\\\'>online</span>, e <span xml:lang=\\\'en\\\'>Lifeline</span> (La storia di <span xml:lang=\\\'ru\\\'>Diyego</span>) con quasi 3.000 euro e 62 donazioni <span xml:lang=\\\'en\\\'>online</span>. Va precisato che alle offerte raccolte attraverso Rete del Dono si aggiunge quanto ottenuto con la vendita diretta dei pettorali e che diversi fra i progetti lanciati alla Padova <span xml:lang=\\\'en\\\'>Marathon</span> sono ancora attivi. <br/><br/>&quot;Questo risultato dimostra quanto il principio del <span xml:lang=\\\'en\\\'>fundraising</span> sia è efficace. Padova <span xml:lang=\\\'en\\\'>Marathon</span>, d’altra parte, ha creduto sin dalla nascita nei progetti solidal&quot; afferma <strong>Leopoldo Destro</strong>, presidente di Assindustria Sport, società che organizza l’evento. &quot;Per noi la maratona non è &quot;soltanto&quot; un grande appuntamento sportivo, ma un punto di riferimento per la città e la provincia, nonché una prestigiosa vetrina per le migliori eccellenze del territorio. E l’esempio più fulgido a riguardo è proprio quello delle <span xml:lang=\\\'en\\\'>charities</span>. Oggi sono convinto che sia ancora possibile crescere e migliorare: sono sicuro che già dalla prossima edizione, fissata per il 22 aprile 2018, il percorso che abbiamo avviato potrà offrire frutti ancora più rilevanti&quot;. <br/><br/>A correre nelle prove agonistiche e nelle Stracittadine tantissime persone comuni, ma anche figure molto conosciute che si sono spese in prima persona come testimonial. Tra loro l’imprenditore <strong>Federico Pettenon</strong>, Ceo di Pettenon <span xml:lang=\\\'en\\\'>Cosmetics</span> (&quot;Ho deciso di correre con Gruppo Polis per sostenere Casa Viola, il servizio dedicato alle donne vittime di violenza e ai loro figli, per dar loro la possibilità di ricostruire il proprio futuro&quot;) e il campione azzurro di <span xml:lang=\\\'en\\\'>rugby</span> <strong>Mauro Bergamasco</strong>, che ha dichiarato: &quot;Ho capito che aiutare qualcuno è un grande dono, la vita cambia per chi viene aiutato ma anche per chi aiuta. Per questo ho voluto investire la mia energia nel mettermi a disposizione e aiutare attivamente e più efficacemente i bambini che sono impegnati in una &quot;corsa&quot; ben più dura contro il cancro, verso un traguardo unico: la vita!&quot;.', '2017-05-25'),
(9, 'Una maratona targata Zero <span xml:lang=\'en\'>Impact</span>', 'immagine2.jpg', 'L’immagine mostra un’attività che coinvolge dei bambini con animatori', 'Anche quest’anno, grazie al sostegno di <span title=\\\'nome di società\\\'>AcegasApsAmga</span> la Padova <span xml:lang=\\\'en\\\'>Marathon</span> sarà interamente marchiata <span xml:lang=\\\'en\\\'>Zero Impact Event by</span> <span title=\\\'nome di società\\\'>AcegasApsAmga</span>, per valorizzare le importanti azioni realizzate dalla <span xml:lang=\\\'en\\\'>multiutility</span> che ha concepito un livello di servizio in grado di ridurre a zero l’impatto ambientale dell’evento. Esempi concreti di questo costante impegno di <span title=\\\'nome di società\\\'>AcegasApsAmga</span> nei confronti dell’ambiente sono la promozione dell’acqua di rete, risorsa di altissima qualità e sottoposta a innumerevoli controlli, che consente di diminuire gli impatti generati dal consumo di acqua in bottiglia, e un servizio di raccolta differenziata ampiamente rafforzato. <br/><br/><span title=\\\'nome di società\\\'>AcegasApsAmga</span>, curatrice della pulizia dell’area interessata dalla manifestazione, infatti, potenzierà i servizi di raccolta differenziata, posizionando lungo tutto il percorso di gara e in Prato della Valle (in prossimità dei punti di ristoro e al traguardo) batterie di contenitori aggiuntivi dedicati alla raccolta differenziata. Al fine di garantire il decoro dell’area, Prato della Valle sarà attentamente presidiato da operatori aziendali specializzati. <br/> <br/><span title=\\\'nome di società\\\'>AcegasApsAmga</span> pensa anche ai più piccoli. Con l’intento di promuovere lo sviluppo di una cultura ambientale e una sensibilità verso il territorio, dalle 10 alle 18 di domenica 23 aprile, saranno disponibili numerose attività di <span xml:lang=\\\'en\\\'>education</span> e di intrattenimento gratuiti. Grazie all’animazione di operatori qualificati, i bambini, potranno partecipare a un gioco dell’oca a grandezza naturale, in cui, muovendosi fra le caselle, impareranno attivamente i comportamenti sani nel rispetto dell’ambiente. <br/> <br/>E ancora, laboratori di riciclo creativo, per divertirsi a creare opere d’arte dando così una nuova vita ai materiali poveri (come carta, cartone, plastica), attività di giocoleria, letture animate e <span xml:lang=\\\'en\\\'>body percussion</span>.', '2017-04-14'),
(10, 'Una Padova <span xml:lang=\'en\'>Marathon</span> a prova di metro', 'immagine3.jpg', 'Operai disegnano il tracciato della maratona sulla strada', 'Sveglia prima dell’alba, per non incappare nel traffico, e maniche tirate su, perché di strada da fare ce n’era tanta. È iniziata così la giornata di Luca Zampieri, responsabile dello staff operativo della Padova <span xml:lang=\\\'en\\\'>Marathon</span>, e di Giovanni Pastore e Gino Corrocher, al lavoro con lui. Ad accompagnarli, una scorta della Polizia provinciale. <br/><br/>Per l’esattezza i chilometri da coprire erano 42,195, quelli che separano lo Stadio Euganeo da Prato della Valle a Padova, se si passa per Rubano, Selvazzano Dentro, Teolo e Abano Terme, vale a dire per i comuni interessati dalla gara in programma domenica 23 aprile. Già, perché la &quot;missione&quot; che li ha visti all’opera è l’annuale segnatura del percorso, chilometro dopo chilometro, rintracciando i segni lasciati sull’asfalto quando è stata eseguita la misurazione ufficiale dell’<abbr title=\\\'Association of International Marathons and Distance Races\\\'>Aims-Iaaf</abbr> (<span xml:lang=\\\'en\\\'>Association of International Marathons and Distance Races</span>). <br/><br/>&quot;Il percorso è quello che tanto successo ha riscosso nella scorsa edizione, ma abbiamo adottato un miglioramento per quanto riguarda la mezza maratona che scatta da Abano Terme&quot; sottolinea Giampaolo Urlando, responsabile tecnico della gara. &quot;Si partirà sempre da via Previtali, ma abbiamo eliminato la curva che &quot;strozzava&quot; la gara immediatamente alla partenza, facendo in modo che i podisti possano proseguire dritti. La modifica, seppure ridotta, consentirà ai partecipanti di ottenere risultati ancora migliori&quot;. E allora non resta che infilare le scarpe da ginnastica e… correre.', '2017-04-05'),
(11, 'Per la festa delle donne la Padova <span xml:lang=\'en\'>Marathon</span> si fa ancora più rosa!', 'immagine4.png', 'Immagine che raffigura le donne che corrono la maratona', 'Per la Festa della Donna la Padova <span xml:lang=\\\'en\\\'>Marathon</span> si fa ancora più rosa! Non solo le quote femminili sono bloccate fino al 14 aprile sia per la maratona che per la mezza maratona ma per ben tre giorni, il 7, l’8 e il 9 marzo, le nostre <span xml:lang=\\\'en\\\'>runner</span> avranno la possibilità di iscriversi in due al prezzo di una! <br/> <br/>Per avere diritto alla promozione, sarà sufficiente registrarsi e pagare contemporaneamente l’iscrizione alla stessa gara (o due iscrizioni alla maratona o due alla mezza) dal link <a href=\\\'www.mysdam.net/store/data-entry_34616.do\\\'>https://www.mysdam.net/store/data-entry_34616.do</a>.<br/><br/>Sarà possibile iscriversi con la quota promozionale anche martedì 7 marzo alla CorriAmo le Terme e giovedì 9 marzo alla Corri per Padova presso lo <span xml:lang=\\\'en\\\'>stand</span> della Padova <span xml:lang=\\\'en\\\'>Marathon</span>.<br/><br/>Correte a iscrivervi, vi aspettiamo in tante domenica 23 aprile 2017 al traguardo di Prato della Valle!', '2017-03-07'),
(12, 'Con la Padova <span xml:lang=\'en\'>Marathon</span> alla &quot;Corri per Padova&quot;', 'immagine5.jpg', 'Nella foto i podisti della &quot;Corri per Padova&quot; in una precedente tappa', 'Ci sarà anche la Padova <span xml:lang=\\\'en\\\'>Marathon</span>. Da giovedì 2 febbraio a giovedì 6 aprile, per dieci settimane, l’<span xml:lang=\\\'en\\\'>igloo</span> di Padova <span xml:lang=\\\'en\\\'>Marathon</span> sarà presente alla &quot;Corri Per Padova&quot; per informazioni e iscrizioni all’evento in programma domenica 23 aprile. <br/><br/>Chi si iscriverà alla gara in una delle prossime tappe riceverà in omaggio un simpatico <span xml:lang=\\\'en\\\'>gadget</span> sportivo, oltre a poter usufruire dell’offerta riservata in esclusiva ai tesserati della &quot;<abbr title=\\\'Corri per Padova\\\'>CxP</abbr>&quot;, che potranno partecipare alla prova da 42 chilometri o alla mezza maratona versando la quota base.<br/><br/>Due eventi, &quot;Corri per Padova&quot; e Padova <span xml:lang=\\\'en\\\'>Marathon</span>, per forza di cose strettamente collegati: l’una può infatti essere vista come la preparazione dell’altra. E da giovedì questo legame si rafforzerà ulteriormente. Il prossimo appuntamento della &quot;<abbr title=\\\'Corri per Padova\\\'>CxP</abbr>&quot;, l’allenamento podistico itinerante di <span xml:lang=\\\'en\\\'>running</span> e <span xml:lang=\\\'en\\\'>walking</span> collettivo che richiama gli appassionati di podismo del territorio, avrà come punto di partenza la Stazione ferroviaria, in piazzale della Stazione, alle 20.30.', '2017-01-31');

-- --------------------------------------------------------

--
-- Struttura della tabella `iscritti_maratona_donne`
--

CREATE TABLE `iscritti_maratona_donne` (
  `Numero_di_gara` int(11) NOT NULL,
  `Nome` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Cognome` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Data_di_nascita` date NOT NULL,
  `Nazionalita` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `iscritti_maratona_uomini`
--

CREATE TABLE `iscritti_maratona_uomini` (
  `Numero_di_gara` int(11) NOT NULL,
  `Nome` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Cognome` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Data_di_nascita` date NOT NULL,
  `Nazionalita` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `iscritti_maratona_uomini`
--

INSERT INTO `iscritti_maratona_uomini` (`Numero_di_gara`, `Nome`, `Cognome`, `Data_di_nascita`, `Nazionalita`, `Email`) VALUES
(4, 'Franz', 'Schmidt', '1993-05-12', 'German', 'FranzS@outlook.com'),
(5, 'Frodo', 'Beggins', '1987-03-02', 'Irish', 'FrodoBeggins@hobbit.com'),
(6, 'Matthew', 'Hanks', '1983-11-30', 'American', 'Mattks@gmail.com'),
(7, ' Mohamed', 'Farah', '1983-03-23', 'British', 'momo@gmaill.com'),
(8, ' Geoffrey', ' Mutai', '1984-10-12', ' Kenyan', 'Geoffrey.Mutai@kenya.com'),
(10, ' Geoffrey', ' Kirui', '1993-02-16', ' Kenyan', 'Geoffrey.Kirui@kenya.com'),
(11, 'Barry', 'Allen', '1990-01-14', 'American', 'TheFlash@yahoo.com'),
(12, 'Tamirat', 'Tola', '1991-08-11', ' Ethiopian', 'ToloTami@aol.it'),
(13, 'Alphonce', 'Simbu', '1992-02-14', ' Tanzanian', 'AlphaSimbu@gmail.com'),
(14, 'Callum', 'Hawkins', '1992-06-22', 'Britain', 'Callum.hawkins@mail.uk'),
(15, ' Gideon', 'Kipketer', '1992-11-10', 'Kenyan', 'Kipk.gideon@gmail.com'),
(16, 'Yohanes', 'Ghebregergis', '1989-01-01', 'Eritrean', 'yohan89@gmail.com'),
(17, ' Yuki', 'Kawauchi', '1987-03-05', 'Japanese', 'YukiYu@mail.com'),
(18, ' Kentaro', ' Nakamoto', '1982-12-07', ' Japanese', 'KentaroNaka@gmail.com'),
(19, 'uomo', 'mara', '1926-10-14', 'Armenian', 'uomointera@it.it'),
(20, 'uomo', 'intera', '0000-00-00', 'Australian', 'dad@dasd.it'),
(21, 'f', 'f', '0000-00-00', '', 'f@a.ait'),
(22, 'f', 'f', '0000-00-00', 'Andorran', 'ad@da.it'),
(24, 'tom', 'car', '1996-02-29', 'Albanian', 'h@h.it');

-- --------------------------------------------------------

--
-- Struttura della tabella `iscritti_mezza_maratona_donne`
--

CREATE TABLE `iscritti_mezza_maratona_donne` (
  `Numero_di_gara` int(11) NOT NULL,
  `Nome` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Cognome` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Data_di_nascita` date NOT NULL,
  `Nazionalita` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `iscritti_mezza_maratona_uomini`
--

CREATE TABLE `iscritti_mezza_maratona_uomini` (
  `Numero_di_gara` int(11) NOT NULL,
  `Nome` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Cognome` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Data_di_nascita` date NOT NULL,
  `Nazionalita` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `iscritti_mezza_maratona_uomini`
--

INSERT INTO `iscritti_mezza_maratona_uomini` (`Numero_di_gara`, `Nome`, `Cognome`, `Data_di_nascita`, `Nazionalita`, `Email`) VALUES
(1, 'Giovanni', 'Righi', '0000-00-00', 'Italian', 'righiqwe@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi`
--

CREATE TABLE `messaggi` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Cognome` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Messaggio` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `messaggi`
--

INSERT INTO `messaggi` (`ID`, `Nome`, `Cognome`, `Email`, `Messaggio`) VALUES
(2, 'dasd', 'das', 'fd@g.it', 'das'),
(3, 'dasd', 'das', 'fd@g.it', 'das'),
(4, 'dasd', 'das', 'fd@g.it', 'das');

-- --------------------------------------------------------

--
-- Struttura della tabella `nazionalita`
--

CREATE TABLE `nazionalita` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `nazionalita`
--

INSERT INTO `nazionalita` (`Id`, `Nome`) VALUES
(1, 'Afghan'),
(2, 'Albanian'),
(3, 'Algerian'),
(4, 'American'),
(5, 'Andorran'),
(6, 'Angolan'),
(7, 'Antiguans'),
(8, 'Argentinean'),
(9, 'Armenian'),
(10, 'Australian'),
(11, 'Austrian'),
(12, 'Azerbaijani'),
(13, 'Bahamian'),
(14, 'Bahraini'),
(15, 'Bangladeshi'),
(16, 'Barbadian'),
(17, 'Barbudans'),
(18, 'Batswana'),
(19, 'Belarusian'),
(20, 'Belgian'),
(21, 'Belizean'),
(22, 'Beninese'),
(23, 'Bhutanese'),
(24, 'Bolivian'),
(25, 'Bosnian'),
(26, 'Brazilian'),
(27, 'British'),
(28, 'Bruneian'),
(29, 'Bulgarian'),
(30, 'Burkinabe'),
(31, 'Burmese'),
(32, 'Burundian'),
(33, 'Cambodian'),
(34, 'Cameroonian'),
(35, 'Canadian'),
(36, 'Cape Verdean'),
(37, 'Central African'),
(38, 'Chadian'),
(39, 'Chilean'),
(40, 'Chinese'),
(41, 'Colombian'),
(42, 'Comoran'),
(43, 'Congolese'),
(44, 'Congolese'),
(45, 'Costa Rican'),
(46, 'Croatian'),
(47, 'Cuban'),
(48, 'Cypriot'),
(49, 'Czech'),
(50, 'Danish'),
(51, 'Djibouti'),
(52, 'Dominican'),
(53, 'Dominican'),
(54, 'Dutch'),
(55, 'Dutchman'),
(56, 'Dutchwoman'),
(57, 'East Timorese'),
(58, 'Ecuadorean'),
(59, 'Egyptian'),
(60, 'Emirian'),
(61, 'Equatorial Guinean'),
(62, 'Eritrean'),
(63, 'Estonian'),
(64, 'Ethiopian'),
(65, 'Fijian'),
(66, 'Filipino'),
(67, 'Finnish'),
(68, 'French'),
(69, 'Gabonese'),
(70, 'Gambian'),
(71, 'Georgian'),
(72, 'German'),
(73, 'Ghanaian'),
(74, 'Greek'),
(75, 'Grenadian'),
(76, 'Guatemalan'),
(77, 'Guinea-Bissauan'),
(78, 'Guinean'),
(79, 'Guyanese'),
(80, 'Haitian'),
(81, 'Herzegovinian'),
(82, 'Honduran'),
(83, 'Hungarian'),
(84, 'I-Kiribati'),
(85, 'Icelander'),
(86, 'Indian'),
(87, 'Indonesian'),
(88, 'Iranian'),
(89, 'Iraqi'),
(90, 'Irish'),
(91, 'Irish'),
(92, 'Israeli'),
(93, 'Italian'),
(94, 'Ivorian'),
(95, 'Jamaican'),
(96, 'Japanese'),
(97, 'Jordanian'),
(98, 'Kazakhstani'),
(99, 'Kenyan'),
(100, 'Kittian and Nevisian'),
(101, 'Kuwaiti'),
(102, 'Kyrgyz'),
(103, 'Laotian'),
(104, 'Latvian'),
(105, 'Lebanese'),
(106, 'Liberian'),
(107, 'Libyan'),
(108, 'Liechtensteiner'),
(109, 'Lithuanian'),
(110, 'Luxembourger'),
(111, 'Macedonian'),
(112, 'Malagasy'),
(113, 'Malawian'),
(114, 'Malaysian'),
(115, 'Maldivan'),
(116, 'Malian'),
(117, 'Maltese'),
(118, 'Marshallese'),
(119, 'Mauritanian'),
(120, 'Mauritian'),
(121, 'Mexican'),
(122, 'Micronesian'),
(123, 'Moldovan'),
(124, 'Monacan'),
(125, 'Mongolian'),
(126, 'Moroccan'),
(127, 'Mosotho'),
(128, 'Motswana'),
(129, 'Mozambican'),
(130, 'Namibian'),
(131, 'Nauruan'),
(132, 'Nepalese'),
(133, 'Netherlander'),
(134, 'New Zealander'),
(135, 'Ni-Vanuatu'),
(136, 'Nicaraguan'),
(137, 'Nigerian'),
(138, 'Nigerien'),
(139, 'North Korean'),
(140, 'Northern Irish'),
(141, 'Norwegian'),
(142, 'Omani'),
(143, 'Pakistani'),
(144, 'Palauan'),
(145, 'Panamanian'),
(146, 'Papua New Guinean'),
(147, 'Paraguayan'),
(148, 'Peruvian'),
(149, 'Polish'),
(150, 'Portuguese'),
(151, 'Qatari'),
(152, 'Romanian'),
(153, 'Russian'),
(154, 'Rwandan'),
(155, 'Saint Lucian'),
(156, 'Salvadoran'),
(157, 'Samoan'),
(158, 'San Marinese'),
(159, 'Sao Tomean'),
(160, 'Saudi'),
(161, 'Scottish'),
(162, 'Senegalese'),
(163, 'Serbian'),
(164, 'Seychellois'),
(165, 'Sierra Leonean'),
(166, 'Singaporean'),
(167, 'Slovakian'),
(168, 'Slovenian'),
(169, 'Solomon Islander'),
(170, 'Somali'),
(171, 'South African'),
(172, 'South Korean'),
(173, 'Spanish'),
(174, 'Sri Lankan'),
(175, 'Sudanese'),
(176, 'Surinamer'),
(177, 'Swazi'),
(178, 'Swedish'),
(179, 'Swiss'),
(180, 'Syrian'),
(181, 'Taiwanese'),
(182, 'Tajik'),
(183, 'Tanzanian'),
(184, 'Thai'),
(185, 'Togolese'),
(186, 'Tongan'),
(187, 'Trinidadian or Tobagonian'),
(188, 'Tunisian'),
(189, 'Turkish'),
(190, 'Tuvaluan'),
(191, 'Ugandan'),
(192, 'Ukrainian'),
(193, 'Uruguayan'),
(194, 'Uzbekistani'),
(195, 'Venezuelan'),
(196, 'Vietnamese'),
(197, 'Welsh'),
(198, 'Welsh'),
(199, 'Yemenite'),
(200, 'Zambian'),
(201, 'Zimbabwean');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articoli`
--
ALTER TABLE `articoli`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `titolo` (`titolo`);

--
-- Indici per le tabelle `iscritti_maratona_donne`
--
ALTER TABLE `iscritti_maratona_donne`
  ADD PRIMARY KEY (`Numero_di_gara`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indici per le tabelle `iscritti_maratona_uomini`
--
ALTER TABLE `iscritti_maratona_uomini`
  ADD PRIMARY KEY (`Numero_di_gara`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indici per le tabelle `iscritti_mezza_maratona_donne`
--
ALTER TABLE `iscritti_mezza_maratona_donne`
  ADD PRIMARY KEY (`Numero_di_gara`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indici per le tabelle `iscritti_mezza_maratona_uomini`
--
ALTER TABLE `iscritti_mezza_maratona_uomini`
  ADD PRIMARY KEY (`Numero_di_gara`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indici per le tabelle `messaggi`
--
ALTER TABLE `messaggi`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `nazionalita`
--
ALTER TABLE `nazionalita`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articoli`
--
ALTER TABLE `articoli`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `iscritti_maratona_donne`
--
ALTER TABLE `iscritti_maratona_donne`
  MODIFY `Numero_di_gara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `iscritti_maratona_uomini`
--
ALTER TABLE `iscritti_maratona_uomini`
  MODIFY `Numero_di_gara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT per la tabella `iscritti_mezza_maratona_donne`
--
ALTER TABLE `iscritti_mezza_maratona_donne`
  MODIFY `Numero_di_gara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `iscritti_mezza_maratona_uomini`
--
ALTER TABLE `iscritti_mezza_maratona_uomini`
  MODIFY `Numero_di_gara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `messaggi`
--
ALTER TABLE `messaggi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
