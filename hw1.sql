-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 07, 2025 alle 13:15
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hw1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `corsi`
--

CREATE TABLE `corsi` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `facolta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `corsi`
--

INSERT INTO `corsi` (`id`, `nome`, `facolta_id`) VALUES
(1, 'ALGEBRA LINEARE E GEOMETRIA', 74),
(2, 'ANALISI MATEMATICA I', 74),
(3, 'ANALISI MATEMATICA II', 74),
(4, 'AUTOMATICA - CONTROLLI AUTOMATICI', 74),
(5, 'AUTOMATICA - TEORIA DEI SISTEMI', 74),
(6, 'CALCOLATORI ELETTRONICI', 74),
(7, 'COMUNICAZIONI DIGITALI', 74),
(8, 'DATABASE', 74),
(9, 'DATABASES AND WEB PROGRAMMING - DATA-BASE', 74),
(10, 'DATABASES AND WEB PROGRAMMING - WEB PROGRAMMING', 74),
(11, 'ECONOMIA APPLICATA ALL\'INGEGNERIA', 74),
(12, 'ELETTRONICA', 74),
(13, 'ELETTROTECNICA', 74),
(14, 'FISICA I', 74),
(15, 'FISICA II', 74),
(16, 'FONDAMENTI DI PROGRAMMAZIONE - PROGRAMMAZIONE I', 74),
(17, 'FONDAMENTI DI PROGRAMMAZIONE - PROGRAMMAZIONE II', 74),
(18, 'INTERNET E SICUREZZA', 74),
(19, 'IOT SYSTEMS AND TECHNOLOGIES', 74),
(20, 'MACHINE LEARNING', 74),
(21, 'PROGRAMMAZIONE ORIENTATA AGLI OGGETTI', 74),
(22, 'SISTEMI OPERATIVI', 74),
(23, 'TEORIA DEI SEGNALI - SEGNALI DETERMINATI E ALEATORI', 74),
(24, 'ADVANCED COMPUTER ARCHITECTURES', 75),
(25, 'ADVANCED PROGRAMMING LANGUAGES', 75),
(26, 'ALGORITMI', 75),
(27, 'ARCHITETTURE E TECNOLOGIE DEI SISTEMI DI TELECOMUNICAZIONI', 75),
(28, 'COGNITIVE COMPUTING AND ARTIFICIAL INTELLIGENCE', 75),
(29, 'DEEP LEARNING', 75),
(30, 'DISTRIBUTED SYSTEMS AND BIG DATA', 75),
(31, 'INDUSTRIAL AND AUTOMOTIVE REAL-TIME NETWORKS', 75),
(32, 'INDUSTRIAL INFORMATICS', 75),
(33, 'INGEGNERIA DEL SOFTWARE', 75),
(34, 'INTERNET OF THINGS BASED SMART SYSTEMS', 75),
(35, 'SICUREZZA DEI SISTEMI INFORMATIVI', 75),
(36, 'TECNOLOGIA DEI SISTEMI DI CONTROLLO', 75),
(37, 'ALGEBRA LINEARE E GEOMETRIA', 71),
(38, 'ANALISI MATEMATICA I', 71),
(39, 'CHIMICA', 71),
(40, 'ECONOMIA APPLICATA ALL\'INGEGNERIA', 71),
(41, 'FISICA I', 71),
(42, 'FONDAMENTI DI INFORMATICA', 71),
(43, 'ALGEBRA LINEARE E GEOMETRIA', 70),
(44, 'ANALISI MATEMATICA I', 70),
(45, 'CHIMICA', 70),
(46, 'ECONOMIA APPLICATA ALL\'INGEGNERIA', 70),
(47, 'FISICA I', 70),
(48, 'FONDAMENTI DI INFORMATICA', 70),
(49, 'ANALISI MATEMATICA II', 70),
(50, 'DISPOSITIVI ELETTRONICI', 70),
(51, 'ELETTROTECNICA', 70),
(52, 'FISICA II', 70),
(53, 'TEORIA DEI SEGNALI', 70),
(54, 'TEORIA DEI SISTEMI', 70),
(55, 'ANALISI MATEMATICA III', 70),
(56, 'CALCOLATORI ELETTRONICI', 70),
(57, 'CONTROLLI AUTOMATICI', 70),
(58, 'ELECTRONIC MEASUREMENTS', 70),
(59, 'ELETTRONICA', 70),
(60, 'FONDAMENTI DI TELECOMUNICAZIONI', 70),
(61, 'ALGEBRA LINEARE E GEOMETRIA', 73),
(62, 'ANALISI MATEMATICA I', 73),
(63, 'CHIMICA', 73),
(64, 'ECONOMIA APPLICATA ALL\'INGEGNERIA', 73),
(65, 'FISICA I', 73),
(66, 'FONDAMENTI DI INFORMATICA', 73),
(67, 'ANALISI MATEMATICA II', 73),
(68, 'DISEGNO TECNICO INDUSTRIALE', 73),
(69, 'ELETTROTECNICA', 73),
(70, 'FISICA II', 73),
(71, 'FISICA MATEMATICA', 73),
(72, 'FISICA TECNICA', 73),
(73, 'CONTROLLI AUTOMATICI', 73),
(74, 'DISPOSITIVI ELETTRICI INDUSTRIALI', 73),
(75, 'ELETTRONICA', 73),
(76, 'GESTIONE DEI SISTEMI INDUSTRIALI E LOGISTICI', 73),
(77, 'IMPIANTI INDUSTRIALI', 73),
(78, 'MACCHINE A FLUIDO', 73),
(79, 'MACCHINE E IMPIANTI ELETTRICI', 73),
(80, 'MECCANICA APPLICATA ALLE MACCHINE', 73),
(81, 'MISURE ELETTRICHE', 73),
(82, 'PROGETTAZIONE INTEGRATA CAD/CAE', 73),
(83, 'SCIENZA DELLE COSTRUZIONI', 73),
(84, 'SISTEMI DI CONTROLLO E GESTIONE', 73),
(85, 'SISTEMI ENERGETICI', 73),
(86, 'TECNOLOGIA E SISTEMI DI PRODUZIONE', 73),
(87, 'BIO-ELECTRICITY IN HUMAN BODY: SYSTEMS AND CONTROL', 66),
(88, 'BIOENGINEERING AND SYNTHETIC BIOLOGY', 66),
(89, 'DEEP LEARNING', 66),
(90, 'LABORATORY of SENSORS and SENSING SYSTEMS', 66),
(91, 'MODELING AND CONTROL OF ELECTROMECHANICAL SYSTEMS', 66),
(92, 'MODELING AND SIMULATION OF MECHANICAL SYSTEMS', 66),
(93, 'Nonlinear Systems Control', 66),
(94, 'ROBUST CONTROL', 66),
(95, 'SENSORS AND ADVANCED MEASUREMENT STRATEGIES', 66),
(96, 'BIOTECHNOLOGY AND LAB-ON-A CHIP', 66),
(97, 'COMPLEX ADAPTIVE SYSTEMS AND BIOROBOTICS', 66),
(98, 'INDUSTRIAL AUTOMATION', 66),
(99, 'POLYMERIC MATERIALS AND MANUFACTURING IN MEDICINE', 66),
(100, 'PROCESS MODELING AND CONTROL', 66),
(101, 'ROBOTICS', 66),
(102, 'Advances in Telecommunication Networks', 67),
(103, 'COGNITIVE COMPUTING AND ARTIFICIAL INTELLIGENCE', 67),
(104, 'Communication theory and systems', 67),
(105, 'Communication theory, systems and technologies', 67),
(106, 'DESIGN OF COMMUNICATION NETWORKS AND SYSTEMS', 67),
(107, 'Electronics for Telecommunications systems', 67),
(108, 'Internet', 67),
(109, 'NETWORK INTELLIGENCE', 67),
(110, 'PROGRAMMING TECHNIQUES FOR DISTRIBUTED SYSTEMS', 67),
(111, 'RADAR IMAGING AND REMOTE SENSING', 67),
(112, 'Sensors and advanced measurement systems: theory and laboratory sessions', 67),
(113, 'Transmission Lines and Antennas', 67),
(114, 'Biometrics and Multimedia Forensics', 67),
(115, 'INTERNET SECURITY', 67),
(116, 'IoT and Big Data Sensing Compression and Communication', 67),
(117, 'MICROWAVE ENGINEERING', 67),
(118, 'Mobile Radio Networks', 67),
(119, 'Sensor and advanced measurement strategies', 67),
(120, 'SIGNAL PROCESSING for MULTIMEDIA APPLICATION', 67),
(121, 'Signal processing for multimedia applications', 67),
(122, 'ADVANCED CIRCUIT ANALYSIS AND DESIGN', 68),
(123, 'ELECTRIC POWER UTILIZATION AND SAFETY', 68),
(124, 'FUNDAMENTAL OF POWER ELECTRONICS', 68),
(125, 'INDUSTRIAL AUTOMATION', 68),
(126, 'MEASUREMENTS FOR AUTOMATION AND INDUSTRIAL PRODUCTION', 68),
(127, 'NUMERICAL METHODS FOR ELECTROMAGNETIC FIELDS AND CIRCUITS', 68),
(128, 'RENEWABLE/CONVENTIONAL POWER GENERATION, TRANSMISSION AND HVDC/FACTS', 68),
(129, 'ADVANCED POWER CONVERTERS AND CONTROL', 68),
(130, 'CLIMATE CHANGE IMPACTS ON ENERGY GENERATION AND DEMAND', 68),
(131, 'DYNAMICS OF ELECTRICAL MACHINES', 68),
(132, 'ELECTRICAL DRIVES FOR E-MOBILITY AND ENERGY EFFICIENCY', 68),
(133, 'ELECTRICITY MARKETS AND ECONOMICS OF RENEWABLE GENERATIONS', 68),
(134, 'INDUSTRIAL ELECTROMAGNETIC COMPATIBILITY', 68),
(135, 'SMART GRIDS and ADVANCED POWER DISTRIBUTION', 68),
(136, 'SYSTEMS AND TRANSDUCERS FOR ENERGY HARVESTING FROM RENEWABLES', 68),
(137, 'ANALOG ELECTRONICS', 69),
(138, 'ANTENNAS AND RADIOPROPAGATION', 69),
(139, 'DIGITAL ELECTRONICS', 69),
(140, 'ELECTRONIC POWER CONVERTERS', 69),
(141, 'ELECTRONICS FOR TELECOMMUNICATIONS', 69),
(142, 'MICRO AND NANO SENSORS', 69),
(143, 'CIRCUIT THEORY', 69),
(144, 'ELECTRONIC SYSTEMS MOD.A', 69),
(145, 'ELECTRONIC SYSTEMS MOD.B', 69),
(146, 'INDUSTRIAL INFORMATICS', 69),
(147, 'INTEGRATED POWER ELECTRONICS', 69),
(148, 'MICROELECTRONICS', 69),
(149, 'MICROWAVE ENGINEERING', 69),
(150, 'RADAR IMAGING AND REMOTE SENSING', 69),
(151, 'SIGNAL PROCESSING FOR MULTIMEDIA APPLICATIONS', 69),
(152, 'TECNOLOGIES OF QUANTUM INFORMATION', 69),
(153, 'BASICS OF COMPUTING', 76),
(154, 'BIG DATA ANALYTICS', 76),
(155, 'DATA BASE', 76),
(156, 'DATA PROTECTION LAW', 76),
(157, 'DIGITAL INNOVATION AND TRANSFORMATION MANAGEMENT', 76),
(158, 'OPTIMIZATION', 76),
(159, 'STATISTICAL LABORATORY', 76),
(160, 'STATISTICAL LEARNING SUPERVISED LEARNING', 76),
(161, 'STATISTICAL LEARNING UNSUPERVISED LEARNING', 76),
(162, 'BIG DATA SENSING, COMPRESSION AND COMMUNICATION', 76),
(163, 'CLOUD COMPUTING AND BIG DATA', 76),
(164, 'COMPUTER SECURITY AND DATA PROTECTION', 76),
(165, 'DATA ANALYSIS FOR PUBLIC HEALTH', 76),
(166, 'DATA SCIENCE IN THE FACTORY OF THE FUTURE', 76),
(167, 'DEEP LEARNING ADVANCED', 76),
(168, 'DEEP LEARNING BASIC', 76),
(169, 'HIGH TECH MARKETS, INDUSTRIAL ORGANIZATION AND GROWTH', 76),
(170, 'IOT-BASED APPLICATIONS FOR INTELLIGENT SYSTEMS', 76),
(171, 'MODELLING OF COMPLEX SYSTEMS AND TIME SERIES', 76),
(172, 'MULTIMEDIA DATA MODELLING', 76),
(173, 'POLITICAL SCIENCE RESEARCH DESIGN AND METHODS', 76),
(174, 'SURVEY DESIGN AND QUESTIONNAIRE DATA ANALYSIS', 76);

-- --------------------------------------------------------

--
-- Struttura della tabella `dipartimenti`
--

CREATE TABLE `dipartimenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `abbreviazione` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `dipartimenti`
--

INSERT INTO `dipartimenti` (`id`, `nome`, `abbreviazione`) VALUES
(1, 'Alta Scuola di Formazione degli Insegnanti', 'ASFI'),
(2, 'CHIRURGIA GENERALE E SPECIALITà MEDICO-CHIRURGICHE', 'CHIRMED'),
(3, 'ECONOMIA E IMPRESA', 'DEI'),
(4, 'FISICA ED ASTRONOMIA Ettore Majorana', 'DFA'),
(5, 'Giurisprudenza', 'GIURISPRUDENZA'),
(6, 'AGRICOLTURA,ALIMENTAZIONE E AMBIENTE', 'di3a'),
(7, 'INGEGNERIA CIVILE E ARCHITETTURA', 'DICAR'),
(8, 'INGEGNERIA ELETTRICA, ELETTRONICA E INFORMATICA', 'DIEEI'),
(9, 'MATEMATICA E INFORMATICA', 'DMI'),
(10, 'medicina clinica e sperimentale', 'MEDCLIN'),
(11, 'scienze biologiche, geologiche e ambientali', 'DSBGA'),
(12, 'scienze biomediche e biotecnologiche', 'BIOMETEC'),
(13, 'scienze chimiche', 'DSC'),
(14, 'scienze del farmaco e della salute', 'dsfs'),
(15, 'scienze della formazione', 'DISFOR'),
(16, 'scienze mediche,chirurgiche e tecnologie avanzate G.F.INGRASSIA', 'DGFI G.F.INGRASSIA'),
(17, 'SCIENZE POLITICHE E SOCIALI', 'dsps'),
(18, 'scienze umanistiche', 'disum'),
(19, 'struttura didattica speciale di architettura, sede decentrata di siracusa', 'ARCHITETTURA');

-- --------------------------------------------------------

--
-- Struttura della tabella `facolta`
--

CREATE TABLE `facolta` (
  `id` int(11) NOT NULL,
  `codice_facolta` varchar(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `dipartimento_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `facolta`
--

INSERT INTO `facolta` (`id`, `codice_facolta`, `nome`, `dipartimento_id`) VALUES
(1, 'LM-69', 'Agricultural science and technology', 6),
(2, 'LM-7', 'Biotecnologie agrarie', 6),
(3, 'L-25', 'Gestione dei sistemi produttivi agrari mediterranei', 6),
(4, 'L-21', 'Pianificazione e sostenibilità ambientale del territorio e del paesaggio', 6),
(5, 'LM-75', 'Salvaguardia del territorio, dell\'ambiente e del paesaggio', 6),
(6, 'L-25', 'Scienze e tecnologie agrarie', 6),
(7, 'LM-69', 'Scienze e tecnologie agrarie', 6),
(8, 'L-26', 'Scienze e tecnologie alimentari', 6),
(9, 'LM-70', 'Scienze e tecnologie alimentari', 6),
(10, 'L-26', 'Scienze e tecnologie per la ristorazione e distribuzione degli alimenti mediterranei', 6),
(11, 'DPCM60_30_', 'A011_Discipline letterarie e Latino', 1),
(12, 'DPCM60_30_', 'A013_Discipline letterarie, Latino e Greco', 1),
(13, 'DPCM60_30_', 'A018_Filosofia e Scienze Umane', 1),
(14, 'DPCM60_30_', 'A019_Filosofia e Storia', 1),
(15, 'DPCM60_30_', 'A020_Fisica', 1),
(16, 'DPCM60_30_', 'A022_Italiano, Storia, Geografia nella Scuola secondaria di I grado', 1),
(17, 'DPCM60_30_', 'A026_Matematica', 1),
(18, 'DPCM60_30_', 'A027_Matematica e Fisica', 1),
(19, 'DPCM60_30_', 'A028_Matematica e Scienze', 1),
(20, 'DPCM60_30_', 'A031_Scienze degli alimenti', 1),
(21, 'DPCM60_30_', 'A034_Scienze e Tecnologie chimiche', 1),
(22, 'DPCM60_30_', 'A040_Tecnologie elettriche elettroniche', 1),
(23, 'DPCM60_30_', 'A041_Scienze e Tecnologie informatiche', 1),
(24, 'DPCM60_30_', 'A045_Scienze economico-aziendali', 1),
(25, 'DPCM60_30_', 'A047_Scienze Matematiche applicate', 1),
(26, 'DPCM60_30_', 'A050_Scienze naturali, chimiche e biologiche', 1),
(27, 'DPCM60_30_', 'A051_Scienze, Tecnologie e Tecniche agrarie', 1),
(28, 'DPCM60_30_', 'A054_Storia dell\'Arte', 1),
(29, 'DPCM60_30_', 'A060_Tecnologia nella Scuola secondaria di I grado', 1),
(30, 'DPCM60_30_', 'AA24_Lingua e cultura straniera (Francese)', 1),
(31, 'DPCM60_30_', 'AA25_Lingua inglese e seconda lingua comunitaria nella Scuola secondaria di I grado (Francese)', 1),
(32, 'DPCM60_30_', 'AB24_Lingua e cultura straniera (Inglese)', 1),
(33, 'DPCM60_30_', 'AB25_Lingua inglese e seconda lingua comunitaria nella Scuola secondaria di I grado (Inglese)', 1),
(34, 'DPCM60_30_', 'AC24_Lingua e cultura straniera (Spagnolo)', 1),
(35, 'DPCM60_30_', 'AC25_Lingua inglese e seconda lingua comunitaria nella Scuola secondaria di I grado (Spagnolo)', 1),
(36, 'DPCM60_30_', 'AD24_Lingua e cultura straniera (Tedesco)', 1),
(37, 'DPCM60_30_', 'Bando A040 - Tecnologie elettriche elettroniche', 1),
(38, 'DPCM60_30_', 'BB02_Conversazione Lingua straniera (Inglese)', 1),
(39, 'DPCM60_30_', 'Discipline letterarie e Latino', 1),
(40, 'LM-41', 'Medicina e chirurgia', 2),
(41, 'LM-41', 'Medicine and Surgery', 2),
(42, 'LM-46', 'Odontoiatria e protesi dentaria', 2),
(43, 'SAS-5513', 'Ortognatodonzia', 2),
(44, 'L/SNT1', 'Ostetricia (abilitante alla professione sanitaria di Ostetrica/o)', 2),
(45, 'L/SNT6', 'Tecniche di fisiopatologia cardiocircolatoria e perfusione cardiovascolare', 2),
(46, 'LM-77', 'Direzione aziendale', 3),
(47, 'L-18', 'Economia Aziendale', 3),
(48, 'LM-56', 'Economia e politiche pubbliche', 3),
(49, 'L-33', 'Economia', 3),
(50, 'LM-77', 'Finanza Aziendale', 3),
(51, 'L-18', 'Management delle imprese per l’economia sostenibile', 3),
(52, 'L-30', 'Fisica', 4),
(53, 'LM-17', 'Physics', 4),
(54, 'LMG/01', 'Giurisprudenza', 5),
(55, 'SSPL', 'Scuola di Specializzazione per le Professioni Legali', 5),
(56, 'LM-22', 'Chemical engineering for industrial sustainability', 7),
(57, 'LM-26', 'Construction Management and Safety', 7),
(58, 'LM-23', 'Ingegneria civile delle acque e dei trasporti', 7),
(59, 'LM-23', 'Ingegneria Civile Strutturale e Geotecnica', 7),
(60, 'L-7', 'Ingegneria Civile, Ambientale e Gestionale', 7),
(61, 'LM-4', 'Ingegneria edile-architettura', 7),
(62, 'LM-31', 'Ingegneria gestionale', 7),
(63, 'LM-33', 'Ingegneria meccanica', 7),
(64, 'LM-35', 'Ingegneria per l\'ambiente e il territorio', 7),
(65, 'L-9', 'Ingegneria per la Transizione Ecologica', 7),
(66, 'LM-25', 'Automation Engineering and Control of Complex Systems', 8),
(67, 'LM-27', 'Communications Engineering', 8),
(68, 'LM-28', 'Electrical Engineering for Sustainable Green Energy Transition', 8),
(69, 'LM-29', 'Electronic Engineering', 8),
(70, 'L-8', 'Ingegneria elettronica', 8),
(71, 'L-9', 'Ingegneria gestionale', 8),
(72, 'L-9', 'Ingegneria gestionale', 8),
(73, 'L-9', 'Ingegneria industriale', 8),
(74, 'L-8', 'Ingegneria informatica', 8),
(75, 'LM-32', 'Ingegneria informatica', 8),
(76, 'LM-Data', 'Data Science', 9),
(77, 'L-31', 'Informatica', 9),
(78, 'LM-18', 'Informatica', 9),
(79, 'L-35', 'Matematica', 9),
(80, 'LM-40', 'Matematica', 9),
(81, 'L/SNT3', 'Dietistica', 10),
(82, 'LM/SNT1', 'Scienze infermieristiche e ostetriche', 10),
(83, 'L/SNT2', 'Tecnica della riabilitazione psichiatrica', 10),
(84, 'L/SNT4', 'Tecniche della prevenzione nell\'ambiente e nei luoghi di lavoro', 10),
(85, 'L/SNT5', 'Tecniche di radiologia medica, per immagini e radioterapia', 10),
(86, 'LM-6', 'Biologia ambientale', 11),
(87, 'LM-6', 'Biologia Sperimentale e Applicata', 11),
(88, 'LM-74', 'Geologia e Geofisica', 11),
(89, 'L-32', 'Scienze Ambientali e Naturali', 11),
(90, 'L-13', 'Scienze biologiche', 11),
(91, 'L-34', 'Scienze Geologiche', 11),
(92, 'L-2', 'Biotecnologie', 12),
(93, 'LM-9', 'Biotecnologie Mediche', 12),
(94, 'L/SNT2', 'Fisioterapia (abilitante alla professione sanitaria di Fisioterapista)', 12),
(95, 'LM-61', 'Scienze della Nutrizione Umana', 12),
(96, 'LM-67', 'Scienze e tecniche delle attività motorie preventive e adattate', 12),
(97, 'L-22', 'Scienze motorie', 12),
(98, 'L/SNT2', 'Terapia occupazionale (abilitante alla professione sanitaria di Terapista occupazionale)', 12),
(99, 'L-27', 'Chimica Industriale', 13),
(100, 'L-27', 'Chimica', 13),
(101, 'LM-54', 'Scienze chimiche', 13),
(102, 'LM-13', 'Chimica e tecnologia farmaceutiche', 14),
(103, 'LM-13', 'Farmacia', 14),
(104, 'SAS-5515', 'Farmacia ospedaliera', 14),
(105, 'L-29', 'Scienze farmaceutiche applicate', 14),
(106, 'LM-49', 'Progettazione del turismo sostenibile culturale e naturalistico', 15),
(107, 'SAP-5601', 'Psicologia clinica', 15),
(108, 'LM-51', 'Psicologia', 15),
(109, 'L-15', 'Scienze del turismo', 15),
(110, 'L-19', 'Scienze dell\'educazione e della formazione', 15),
(111, 'LM-85', 'Scienze della formazione primaria', 15),
(112, 'L-24', 'Scienze e tecniche psicologiche', 15),
(113, 'LM-85', 'Scienze Pedagogiche e Progettazione Educativa', 15),
(114, 'SAS-5516', 'Fisica Medica', 16),
(115, 'L/SNT1', 'Infermieristica', 16),
(116, 'L/SNT7', 'Logopedia (abilitante alla professione sanitaria di Logopedista)', 16),
(117, 'LM/SNT2', 'Scienze riabilitative delle professioni sanitarie', 16),
(118, 'L/SNT8', 'Tecniche audioprotesiche', 16),
(119, 'LM-62', 'Global Politics and Euro-Mediterranean Relations', 17),
(120, 'LM-52', 'Internazionalizzazione delle relazioni commerciali', 17),
(121, 'LM-63', 'Management della Pubblica Amministrazione', 17),
(122, 'LM-87', 'Politiche e Servizi Sociali', 17),
(123, 'L-16', 'Scienze dell\'amministrazione e dell\'organizzazione', 17),
(124, 'LM-88', 'Sociologia delle reti, dell\' informazione e dell\' innovazione', 17),
(125, 'L-40', 'Sociologia e servizio sociale', 17),
(126, 'LM-84', 'Storia e cultura dei paesi mediterranei', 17),
(127, 'L-36', 'Storia, politica e relazioni internazionali', 17),
(128, 'LM-2', 'Archeologia', 18),
(129, 'SAB-5201', 'Bando per l\'ammissione alla scuola di specializzazione in Beni archeologici', 18),
(130, 'SAB-5201', 'Beni Archeologici', 18),
(131, 'L-1', 'Beni culturali', 18),
(132, 'LM-65', 'Comunicazione della cultura e dello spettacolo', 18),
(133, 'LM-15', 'Filologia classica', 18),
(134, 'LM-14', 'Filologia moderna', 18),
(135, 'L-5', 'Filosofia', 18),
(136, 'L-10', 'Lettere', 18),
(137, 'L-11', 'Lingue e culture europee euroamericane ed orientali', 18),
(138, 'LM-37', 'Lingue e letterature comparate', 18),
(139, 'LM-38', 'Lingue per la cooperazione internazionale', 18),
(140, 'L-12', 'Mediazione linguistica e interculturale', 18),
(141, 'L-15', 'Progettazione e gestione del turismo culturale', 18),
(142, 'LM-43', 'Scienze del testo per le professioni digitali', 18),
(143, 'L-20', 'Scienze e lingue per la comunicazione', 18),
(144, 'LM-78', 'Scienze filosofiche', 18),
(145, 'LM-39', 'Scienze Linguistiche per l\'intercultura e la formazione', 18),
(146, 'LM-89', 'Storia dell\'arte e beni culturali', 18),
(147, 'LM-4', 'Architettura', 19);

-- --------------------------------------------------------

--
-- Struttura della tabella `libro_preferito`
--

CREATE TABLE `libro_preferito` (
  `titolo` varchar(255) DEFAULT NULL,
  `autore` varchar(255) DEFAULT NULL,
  `utente` int(11) NOT NULL,
  `cover` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `libro_preferito`
--

INSERT INTO `libro_preferito` (`titolo`, `autore`, `utente`, `cover`) VALUES
('Autobiography', 'Benjamin Franklin', 16, 'https://covers.openlibrary.org/b/id/5647361-L.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `preferenze_corsi`
--

CREATE TABLE `preferenze_corsi` (
  `id` int(11) NOT NULL,
  `utente_id` int(11) NOT NULL,
  `corso_id` int(11) NOT NULL,
  `anno_accademico` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `preferenze_corsi`
--

INSERT INTO `preferenze_corsi` (`id`, `utente_id`, `corso_id`, `anno_accademico`) VALUES
(41, 10, 26, '2025'),
(42, 10, 28, '2025'),
(43, 10, 30, '2025'),
(45, 10, 26, '2024'),
(49, 10, 27, '2025'),
(54, 10, 30, '2024'),
(60, 10, 1, '2024'),
(61, 10, 2, '2024'),
(67, 16, 29, '2025'),
(68, 16, 28, '2025'),
(75, 16, 16, '2025'),
(76, 16, 14, '2025'),
(77, 16, 15, '2025'),
(80, 16, 13, '2025'),
(83, 16, 7, '2025'),
(86, 16, 2, '2025'),
(88, 16, 3, '2025'),
(89, 16, 18, '2025'),
(90, 16, 17, '2025'),
(91, 16, 19, '2025'),
(92, 16, 20, '2025'),
(93, 16, 21, '2025'),
(95, 16, 22, '2025');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cognome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `genere` char(1) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `nome`, `cognome`, `email`, `tipo`, `genere`, `pass`, `profile_pic`) VALUES
(7, 'tiza', 'Tiziano', 'Viglianisi', 'tviglianii@gmail.com', 'studente', 'M', '$2y$10$sawPQpVLKTTzwt2cK4wSBONz1g7UXIv93RDNiogVcz2mn6.IE4y3K', NULL),
(8, 'tokzo', 'Tiziano', 'Viglianisi', 'tviglianiasi@gmail.com', 'studente', 'M', '$2y$10$5M.2.cCHV/z64m3OypOxYOjz51m/EMIgDiQs.zSK2vS.cZf/8TJHy', NULL),
(9, 'tizaijdf', 'Tiziano', 'Viglianisi', 'tviglianasdisi@gmail.com', 'studente', 'M', '$2y$10$.Ii1NLbHs5dyyUUYKwpA8e0EL8Nv3UgaUWQ5648JtiGfNuBEEjav2', NULL),
(10, 'simome', 'Simone', 'Messina', 'simo@example.com', 'professore', 'F', '$2y$10$dN9TyzevCd5Xw.ucfkop6eAPdJ7JT/Vv1WdbFuxhAinZqs5XRgLRC', '6837511b80b35.png'),
(13, 't', 'Tiziano', 'Viglianisi', 'tviglianisi@gmail.com', 'studente', 'M', '$2y$10$ylul58TG/zyIqZ35s8h35uC6AgNhQIjzFIkcDovsuN437HBAhRPoi', '683735588af4b.png'),
(14, 'ty', 'Tiziano', 'Viglianisi', 'tviglyianisi@gmail.com', 'studente', 'M', '$2y$10$hSe.vM.M99muUsWk1b0uqeXsBDy7xVXOwOD7iYjhMaxYwPUlQ4muK', '683736064b260.png'),
(15, 'sad', 'Tiziano', 'Viglianisi', 'tviglianisi@gmadail.com', 'studente', 'M', '$2y$10$NxW8M5ySQFDOIk.cBwhI2.0VahUoxbyR3DQPl07GX3QpoWAPPO3w2', ''),
(16, 'tiz', 'Tiziano', 'Viglianisi', 'tiz@example.com', 'professore', 'A', '$2y$10$kjvwteQ8YJ.LXkjH9o94Suf8CnA/iS7S3pvWSoqOL423Rkt8n97WG', '683ece4a54cf4.png'),
(17, 'sd', 'Tiziano', 'Viglianisi', 'asdi@gmail.com', 'studente', 'M', '$2y$10$/HDE/vCbmGdAew4Jnjo7tuNCQCnTbn4uIT1GJlTp3Z8d3Q9B7d31i', '683753acb9cc7.jpg'),
(18, 'pollo', 'Tiziano', 'Viglianisi', 't@example.com', 'professore', 'F', '$2y$10$Oy5cAipxoD6Ij9cD2wjXG..22Hjb8T0jgXQv.veYI26MW.yRp7CP6', '683aa882efcdf.png');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `corsi`
--
ALTER TABLE `corsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dipartimento_id` (`facolta_id`) USING BTREE;

--
-- Indici per le tabelle `dipartimenti`
--
ALTER TABLE `dipartimenti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `facolta`
--
ALTER TABLE `facolta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dipartimento_id` (`dipartimento_id`);

--
-- Indici per le tabelle `libro_preferito`
--
ALTER TABLE `libro_preferito`
  ADD PRIMARY KEY (`utente`),
  ADD KEY `utente` (`utente`);

--
-- Indici per le tabelle `preferenze_corsi`
--
ALTER TABLE `preferenze_corsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente_id` (`utente_id`),
  ADD KEY `corso_id` (`corso_id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `corsi`
--
ALTER TABLE `corsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT per la tabella `dipartimenti`
--
ALTER TABLE `dipartimenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `facolta`
--
ALTER TABLE `facolta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT per la tabella `preferenze_corsi`
--
ALTER TABLE `preferenze_corsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `corsi`
--
ALTER TABLE `corsi`
  ADD CONSTRAINT `FK_corsi_facolta` FOREIGN KEY (`facolta_id`) REFERENCES `facolta` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `facolta`
--
ALTER TABLE `facolta`
  ADD CONSTRAINT `facolta_ibfk_1` FOREIGN KEY (`dipartimento_id`) REFERENCES `dipartimenti` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `libro_preferito`
--
ALTER TABLE `libro_preferito`
  ADD CONSTRAINT `FK__utenti` FOREIGN KEY (`utente`) REFERENCES `utenti` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `preferenze_corsi`
--
ALTER TABLE `preferenze_corsi`
  ADD CONSTRAINT `preferenze_corsi_ibfk_1` FOREIGN KEY (`utente_id`) REFERENCES `utenti` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `preferenze_corsi_ibfk_2` FOREIGN KEY (`corso_id`) REFERENCES `corsi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
