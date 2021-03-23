-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2021 at 11:41 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hfyc_apu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `AdminName` varchar(255) NOT NULL,
  `AdminTP` varchar(8) NOT NULL,
  `AdminAddress` varchar(1000) NOT NULL,
  `AdminDescription` varchar(1000) NOT NULL,
  `AdminAge` int(11) NOT NULL,
  `AdminPhoneNumber` varchar(13) NOT NULL,
  `AdminGender` varchar(6) NOT NULL,
  `AdminImgStatus` int(2) NOT NULL,
  `AdminChillBuds` int(2) NOT NULL,
  PRIMARY KEY (`AdminID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `UserID`, `AdminName`, `AdminTP`, `AdminAddress`, `AdminDescription`, `AdminAge`, `AdminPhoneNumber`, `AdminGender`, `AdminImgStatus`, `AdminChillBuds`) VALUES
(1, 9, 'Jason Todd', 'TP055343', 'Jalan', 'Hi, my name is Jason Todd and I am an admin of HFYC. Feel free to message me.', 20, '014-6321806', 'Male', 1, 1),
(2, 27, 'Irfan', 'TP033123', 'Jalan Klang', 'Hi, I am a new admin. Please give me some feedback. Thanks', 20, '011-2938444', 'Male', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chillbuds-user`
--

DROP TABLE IF EXISTS `chillbuds-user`;
CREATE TABLE IF NOT EXISTS `chillbuds-user` (
  `ChillBudsID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `RegisterDate` datetime NOT NULL,
  PRIMARY KEY (`ChillBudsID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `consultation_info`
--

DROP TABLE IF EXISTS `consultation_info`;
CREATE TABLE IF NOT EXISTS `consultation_info` (
  `ConsultID` int(11) NOT NULL AUTO_INCREMENT,
  `ConsultorID` varchar(255) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ConsultType` varchar(255) DEFAULT NULL,
  `ConsultDate` varchar(255) NOT NULL,
  `ConsultStartTime` varchar(255) NOT NULL,
  `ConsultEndTime` varchar(255) NOT NULL,
  `ConsultFeedback` varchar(5000) DEFAULT NULL,
  `ConsultRating` int(11) DEFAULT NULL,
  `ConsultationSessionID` int(11) NOT NULL,
  PRIMARY KEY (`ConsultID`),
  UNIQUE KEY `ConsultationSessionID` (`ConsultationSessionID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consultation_info`
--

INSERT INTO `consultation_info` (`ConsultID`, `ConsultorID`, `UserID`, `ConsultType`, `ConsultDate`, `ConsultStartTime`, `ConsultEndTime`, `ConsultFeedback`, `ConsultRating`, `ConsultationSessionID`) VALUES
(21, 'TP066454', 11, 'Fitness Consultation', '2021-02-26', '3:30 PM', '6:00 PM', 'Nice Consultation, Learnt alot from him', 10, 21),
(22, 'TP066454', 11, 'Fitness Consultation', '2021-02-24', '16:30 PM', '07:30 AM', NULL, NULL, 19),
(23, 'TP066454', 11, 'Fitness Consultation', '2021-02-25', '1:30 PM', '2:30 PM', NULL, NULL, 20),
(24, 'TP02933', 17, 'Career Consultation', '2021-03-12', '09:30 AM', '10:00 AM', NULL, NULL, 22),
(25, 'TP066454', 11, 'Fitness Consultation', '2021-03-31', '4:30 PM', '5:00 PM', 'Nice Consultation', 8, 23),
(26, 'TP066454', 11, 'Fitness Consultation', '2021-03-18', '5:00 PM', '5:30 PM', NULL, NULL, 24),
(27, 'TP066454', 11, 'Fitness Consultation', '2021-03-19', '10:30 AM', '11:00 AM', NULL, NULL, 25);

-- --------------------------------------------------------

--
-- Table structure for table `consultor`
--

DROP TABLE IF EXISTS `consultor`;
CREATE TABLE IF NOT EXISTS `consultor` (
  `ConsultorID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `ConsultorName` varchar(255) NOT NULL,
  `ConsultorTP` varchar(8) NOT NULL,
  `ConsultorAddress` varchar(1000) NOT NULL,
  `ConsultorDescription` varchar(1000) NOT NULL,
  `ConsultorAge` int(11) NOT NULL,
  `ConsultorPhoneNumber` varchar(13) NOT NULL,
  `ConsultorGender` varchar(6) NOT NULL,
  `ConsultorImgStatus` int(2) NOT NULL,
  `ConsultorChillBuds` int(2) NOT NULL,
  `ConsultorService` varchar(100) NOT NULL,
  PRIMARY KEY (`ConsultorID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consultor`
--

INSERT INTO `consultor` (`ConsultorID`, `UserID`, `ConsultorName`, `ConsultorTP`, `ConsultorAddress`, `ConsultorDescription`, `ConsultorAge`, `ConsultorPhoneNumber`, `ConsultorGender`, `ConsultorImgStatus`, `ConsultorChillBuds`, `ConsultorService`) VALUES
(1, 10, 'John Taylor', 'TP066454', 'Jalan Aincrad', 'Hi, My name is John Taylor and I am specialised in Fitness Consultation', 20, '014-6321806', 'Male', 1, 1, 'Fitness Consultation'),
(2, 15, 'Ryan', 'TP055343', 'Jalan', 'Hi, My name is Ryan and I am specialised in Mental Health Consultation', 20, '014-6321806', 'Male', 0, 0, 'Mental Health Consultation'),
(3, 16, 'jeremy_staff', 'TP02933', 'Kuala', 'Hi, My name is Jeremy and I am specialised in Career Consultation', 20, '011-9283744', 'Male', 0, 0, 'Career Consultation'),
(4, 22, 'Sia', 'TP011111', 'Klang', 'Hi, My name is Sia and I am specialised in Academic Consultation', 20, '011-1111111', 'Male', 0, 1, 'Academic Consultation'),
(5, 25, 'James Mason', 'TP017321', 'Jalan Lalai', 'Hi, My name is James and I am specialised in Life Consultation', 30, '011-2039485', 'Male', 0, 0, 'Life Consultation'),
(6, 26, 'Lincoln Abraham', 'TP123098', 'Jalan Ramai', 'Hi, My name is Lincoln and I am specialised in Further Studies Consultation', 40, '0192301928', 'Female', 0, 0, 'Further Studies Consultation');

-- --------------------------------------------------------

--
-- Table structure for table `consultor_consultation`
--

DROP TABLE IF EXISTS `consultor_consultation`;
CREATE TABLE IF NOT EXISTS `consultor_consultation` (
  `Consultation_ID` int(50) NOT NULL AUTO_INCREMENT,
  `Consult_Date` date NOT NULL,
  `Start_Time` varchar(50) COLLATE utf8_bin NOT NULL,
  `End_Time` varchar(50) COLLATE utf8_bin NOT NULL,
  `Consultor_ID` varchar(50) COLLATE utf8_bin NOT NULL,
  `ConsultationVenue` varchar(50) COLLATE utf8_bin NOT NULL,
  `SlotStatus` varchar(12) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Consultation_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `consultor_consultation`
--

INSERT INTO `consultor_consultation` (`Consultation_ID`, `Consult_Date`, `Start_Time`, `End_Time`, `Consultor_ID`, `ConsultationVenue`, `SlotStatus`) VALUES
(19, '2021-02-24', '16:30 PM', '07:30 AM', 'TP066454', 'Microsoft Teams', 'Past'),
(20, '2021-02-25', '1:30 PM', '2:30 PM', 'TP066454', 'Microsoft Teams', 'Past'),
(21, '2021-02-26', '3:30 PM', '6:00 PM', 'TP066454', 'Microsoft Teams', 'Past'),
(22, '2021-03-12', '09:30 AM', '10:00 AM', 'TP02933', 'Microsoft Teams', 'Ongoing'),
(23, '2021-03-31', '4:30 PM', '5:00 PM', 'TP066454', 'Microsoft Teams', 'Past'),
(24, '2021-03-18', '5:00 PM', '5:30 PM', 'TP066454', 'Discord', 'Ongoing'),
(25, '2021-03-19', '10:30 AM', '11:00 AM', 'TP066454', 'Microsoft Teams', 'Ongoing'),
(26, '2021-03-18', '09:30 AM', '10:00 AM', 'TP066454', 'Discord', 'Available'),
(27, '2021-03-13', '11:00 AM', '12:00 PM', 'TP066454', 'Discord', 'Available'),
(28, '2021-03-16', '12:00 PM', '12:30 PM', 'TP066454', 'Microsoft Teams', 'Available'),
(29, '2021-03-19', '09:30 AM', '10:00 AM', 'TP066454', 'Microsoft Teams', 'Available'),
(30, '2021-03-18', '09:30 AM', '10:30 AM', 'TP066454', 'Discord', 'Available'),
(31, '2021-03-18', '09:30 AM', '10:00 AM', 'TP017321', 'Microsoft Teams', 'Available'),
(32, '2021-03-20', '10:00 AM', '10:30 AM', 'TP017321', 'Discord', 'Available'),
(33, '2021-03-23', '10:00 AM', '10:30 AM', 'TP017321', 'Discord', 'Available'),
(34, '2021-03-24', '1:30 PM', '2:00 PM', 'TP017321', 'Discord', 'Available'),
(35, '2021-03-19', '5:00 PM', '5:30 PM', 'TP017321', 'Microsoft Teams', 'Available'),
(36, '2021-04-08', '10:00 AM', '10:30 AM', 'TP017321', 'Microsoft Teams', 'Available'),
(37, '2021-04-15', '10:00 AM', '10:30 AM', 'TP017321', 'Discord', 'Available'),
(38, '2021-04-22', '10:30 AM', '11:00 AM', 'TP017321', 'Microsoft Teams', 'Available'),
(39, '2021-04-08', '09:00 AM', '09:30 AM', 'TP123098', 'Discord', 'Available'),
(40, '2021-04-02', '11:00 AM', '11:30 AM', 'TP123098', 'Discord', 'Available'),
(41, '2021-04-14', '2:00 PM', '2:30 PM', 'TP123098', 'Discord', 'Available'),
(42, '2021-04-01', '09:00 AM', '09:30 AM', 'TP055343', 'Microsoft Teams', 'Available'),
(43, '2021-04-09', '10:30 AM', '11:00 AM', 'TP055343', 'Discord', 'Available'),
(44, '2021-03-25', '11:00 AM', '11:30 AM', 'TP055343', 'Discord', 'Available'),
(45, '2021-04-09', '09:00 AM', '09:30 AM', 'TP02933', 'Discord', 'Available'),
(46, '2021-04-09', '12:00 PM', '12:30 PM', 'TP02933', 'Discord', 'Available'),
(47, '2021-03-26', '12:30 PM', '1:00 PM', 'TP02933', 'Microsoft Teams', 'Available'),
(48, '2021-04-16', '10:00 AM', '11:00 AM', 'TP011111', 'Microsoft Teams', 'Available'),
(49, '2021-04-09', '09:00 AM', '09:30 AM', 'TP011111', 'Microsoft Teams', 'Available'),
(50, '2021-04-17', '2:00 PM', '2:30 PM', 'TP011111', 'Discord', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `latest-news_comments`
--

DROP TABLE IF EXISTS `latest-news_comments`;
CREATE TABLE IF NOT EXISTS `latest-news_comments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Comment` text COLLATE utf8_bin NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `News_ID` int(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `latest-news_comments`
--

INSERT INTO `latest-news_comments` (`ID`, `UserID`, `Comment`, `CreatedOn`, `News_ID`) VALUES
(10, 9, 'No I can\'t go gym now :(', '2021-03-16 17:30:19', 2),
(11, 9, 'Haizz what a sad time to live in :(', '2021-03-16 17:30:40', 1),
(12, 11, 'That\'s a frightening number of how many people are diagnosed with mental diseases. Yikes', '2021-03-16 17:32:57', 1),
(13, 24, 'Time to work out at home then', '2021-03-16 17:34:41', 2),
(14, 24, 'Hope I won\'t develop them during quarantine :(', '2021-03-16 17:35:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `latest-news_replies`
--

DROP TABLE IF EXISTS `latest-news_replies`;
CREATE TABLE IF NOT EXISTS `latest-news_replies` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CommentID` int(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Comment` text COLLATE utf8_bin NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `News_ID` int(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `latest-news_replies_ibfk_1` (`CommentID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `latest-news_replies`
--

INSERT INTO `latest-news_replies` (`ID`, `CommentID`, `UserID`, `Comment`, `CreatedOn`, `News_ID`) VALUES
(26, 11, 11, 'Cheer up bro at least this is controllable. Just communicate more with others and u should be fine', '2021-03-16 17:32:26', 1),
(27, 10, 11, 'Haha same it sucks :(', '2021-03-16 17:33:16', 2);

-- --------------------------------------------------------

--
-- Table structure for table `news_data`
--

DROP TABLE IF EXISTS `news_data`;
CREATE TABLE IF NOT EXISTS `news_data` (
  `NewsID` int(11) NOT NULL AUTO_INCREMENT,
  `AdminID` varchar(255) NOT NULL,
  `NewsDate` varchar(255) NOT NULL,
  `NewsTitle` varchar(255) NOT NULL,
  `NewsContent` longtext NOT NULL,
  PRIMARY KEY (`NewsID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_data`
--

INSERT INTO `news_data` (`NewsID`, `AdminID`, `NewsDate`, `NewsTitle`, `NewsContent`) VALUES
(1, '1', '2021-03-16', 'Addressing direct, indirect Covid-19 impact on mental health', 'THIS year\'s World Mental Health Awareness Month is celebrated this year with a slightly different atmosphere as the Covid-19 challenge has yet to end, coupled with the recent Covid third wave in Malaysia which started in line with the beginning of many programs organized for this month.\r\nThe theme of this year\'s celebration, Mental Health for All is also in line with this epidemic phenomenon that affects almost everyone in diverse circumstances. In addition to the direct impact on physical health, this epidemic also has an indirect impact on human social well-being and mental health.\r\nGlobal statistics have shown an increase in cases of psychological stress, depression, anxiety, acts of self-harm and domestic violence during this period. In addition, a World Health Organization (WHO) study involving 130 countries also reported that more than 60 per cent of psychiatric and mental health services were directly affected by this epidemic.\r\nThese include postponement of appointments and therapies, lack of resources, patient logistics issues, finances and services that cannot meet current needs. This indirectly reminds us of a fact that has long been mentioned, namely about the lack of resources in mental health services that need to be taken seriously. The country\'s ability to cope with the complications of this epidemic in terms of mental health must be enhanced so that it is in line with the needs in the field.\r\nWe are aware of the mental health status of Malaysians that need serious attention. The prevalence of mental problems has tripled from 10.7 percent (1996) to 29.2 percent (2016). Depression and anxiety are among the contributors to the issue of disability here. Not only that, mental health problems in the workplace have a significant economic burden on Malaysia, where as much as RM14.46 billion had to be borne due to the implications of mental problems in the workplace in 2018.\r\nEven so, human resources for this field are still in critical condition. This can be seen from the rate of a psychiatrist per 100,000 Malaysians. To understand this from public health perspective, for example, with a prevalence of 8 per cent of cases of depression, this means that for depression alone, an estimated 1.6 million adult Malaysians suffer from depression - far more than the capacity of existing psychiatrists.\r\nIn addition, we also have a shortage of clinical psychologists and counselors in the public sector. Sadly, the budget specifically for mental health is only RM344.82 million which is only one percent of the overall national health budget.\r\nFor this, we want to highlight a few suggestions for some aspects that need to be given priority. Among them, the issue of adolescent mental health - especially school students. This is important as a preventative measure as 50 percent of cases of mental problems start before the age of 14 years.\r\nThe government should consider creating a one-stop center such as the MENTARI concept for adolescents, collaborating with the Ministry of Education to create emotional management modules for more intensive students, working with the Ministry of Women and Family Development for parenting psychology courses for young families and the Islamic Religious Department through pre-marital courses.\r\nIn addition, mental health issues in the workplace should also be given attention. Among those that can be recommended is the creation of more counsellor positions in government departments such as Federal and State Government agencies to help staff who suffer from stress.\r\nWe also need better mental health networks in the community for the purpose of prevention and treatment in the community as well as rehabilitation to improve patients\' ability to return to society. For example, by increasing the capacity of more Health Clinics to hold a mobile team to provide home-based services to patients.\r\n'),
(2, '1', '2021-03-16', 'Covid-19 hits gyms and fitness centres in KL, Selangor', 'KUALA LUMPUR, Jan 4 â€” More Covid-19 cases have started emerging in gyms and fitness centres around Klang Valley, forcing those affected to close for sanitisation and disinfection.\r\nThe self-disclosures also shone a spotlight on the standard operating procedures for such businesses, which currently do not require masks to be used when visiting the premises.\r\nAmong others, establishments such as Club Aloha, Hustle Lifestyle, Ministry of Burn, Tribe Boxing, Union Strength have reported cases while others like Activ Studio in Bangsar have asked its members not to come if they have gone to these gyms.\r\nâ€œThe management of Activ Studio requests its members who have attended classes at the above venues since Saturday December 26 to refrain from joining classes at ActivStudio and are advised to self-quarantine until January 14.\r\nâ€œPlease also pay extra attention to your well-being and seek medical attention if you are feeling unwell,â€ the post on Facebook read.\r\nAnother gym, Fly Project, reported eight members have been infected since one of its team members tested positive on December 26. It said all team members have been sent for screening.\r\nâ€œOn December 31, a member of our team shared that he tested positive for Covid after attending a dinner on December 26 where a known positive surfaced.\r\nâ€œSubsequently, all direct and indirect contacts with the individual from our team were sent for testing resulting in a further eight team members testing positive. All eight individuals were in close contact with a positive case and some were also at the same dinner,â€ the gym said.\r\nâ€œAs a precautionary measure, we will be closing all FLYPROJECT studios until January 11.â€\r\nAdditionally, KLoe Hotel in the heart of Kuala Lumpur has closed its premises for sanitisation following five cases of Covid-19 at the wellness centre B.est Mind and Body located in the hotel.\r\nâ€œWe regret to announce that KLoe Hotel, Monroe and Lucky Coffee will be closed, effective immediately, for full sanitation procedures in accordance to the Ministry of Healthâ€™s directives.\r\nâ€œWe have been informed by B.est Mind and Body that two of their team members, and three of their students have tested positive for Covid-19,â€ the posting on Instagram read.\r\nâ€œSince we were informed of the above, we have arranged for all of KLoeâ€™s team members, including those who are off-duty, to undergo swab tests.â€\r\nKLoe Hotel later told Malay Mail that all of its staff tested negative for Covid-19..\r\nIn October, the sports ministry said gyms were allowed to be operational from October 17. They would have to follow strict SOPs, limit numbers per session and practice all hygienic processes. \r\nMalaysia reported another 1,741 Covid-19 cases today for a total of 120,818 with 501 deaths to date.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `normal_user`
--

DROP TABLE IF EXISTS `normal_user`;
CREATE TABLE IF NOT EXISTS `normal_user` (
  `NormalUserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `NormalUserName` varchar(255) NOT NULL,
  `NormalUserTP` varchar(8) NOT NULL,
  `NormalUserAddress` varchar(1000) NOT NULL,
  `NormalUserDescription` varchar(1000) NOT NULL,
  `NormalUserAge` int(11) NOT NULL,
  `NormalUserPhoneNumber` varchar(13) NOT NULL,
  `NormalUserGender` varchar(6) NOT NULL,
  `NormalUserImgStatus` int(2) NOT NULL,
  `NormalUserChillBuds` int(2) NOT NULL,
  PRIMARY KEY (`NormalUserID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `normal_user`
--

INSERT INTO `normal_user` (`NormalUserID`, `UserID`, `NormalUserName`, `NormalUserTP`, `NormalUserAddress`, `NormalUserDescription`, `NormalUserAge`, `NormalUserPhoneNumber`, `NormalUserGender`, `NormalUserImgStatus`, `NormalUserChillBuds`) VALUES
(1, 11, 'Ryan Lim Fang Yung', 'TP055343', '8, Jalan Bukit Indah 3/21, Taman Bukit Indah, 68000 Ampang', 'Hello world, I am (echo \"Ryan Lim\")', 19, '014-6321806', 'Male', 1, 1),
(2, 17, 'jeremy_student', 'TP123456', 'Kuala', 'I am APU student Jeremy studying Diploma in ICT SE', 20, '011-92837099', 'Male', 0, 0),
(3, 21, 'Sia', 'TP056392', 'Jalan', 'My name is Sia and I love to watch Korean Drama', 20, '012-2222222', 'Male', 0, 0),
(5, 24, 'Muhammad Abdullah bin Fuad', 'TP010904', 'Jalan Klang', 'Hi, nice to meet you. My name is Muhammad FUad', 20, '014-6321806', 'Male', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reset`
--

DROP TABLE IF EXISTS `reset`;
CREATE TABLE IF NOT EXISTS `reset` (
  `ResetID` int(255) NOT NULL AUTO_INCREMENT,
  `ResetEmail` varchar(255) COLLATE utf8_bin NOT NULL,
  `ResetSelector` varchar(500) COLLATE utf8_bin NOT NULL,
  `ResetToken` varchar(500) COLLATE utf8_bin NOT NULL,
  `ResetExpires` varchar(500) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ResetID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `reset`
--

INSERT INTO `reset` (`ResetID`, `ResetEmail`, `ResetSelector`, `ResetToken`, `ResetExpires`) VALUES
(5, 'ryanlimfangyung@live.com', '8d78c062d950042f', '$2y$10$D4.SmyveJMt1kHoALEcdFurfm7LvaF1K7aEPPeJiFZf/ouk/Pd6py', '1615054713'),
(6, 'ryanlimfangyung@live.com', 'c7076a746478bbb7', '$2y$10$T90NRWLmT98eJQscURxmLu3z5fObXBgVeW05YP5GindwXiZy8ToT6', '1615054815'),
(7, 'tp055343@mail.apu.edu.my', 'c2d67191efced3a3', '$2y$10$Av4DMKJ2Bw/g9RYIDUXsXeLTZEWU8j6sYYvmcVl1kZc13gepIX4d2', '1615277290'),
(8, 'tp055343@mail.apu.edu.my', 'ded08980cf3ac765', '$2y$10$4OjQo098vGs95RLWF0tON.IWzvNjJd50sy3xAss96nQZ2CeRw5GRq', '1615445659'),
(9, 'ryanrlfy33@gmail.com', 'dea211c7e862441e', '$2y$10$fCuXIztocXHNZ0FpFz7sMOi.ye333Yx.7jPP35OiCE6NdzXIX7wBG', '1615624641'),
(10, 'ryanrlfy33@gmail.com', '4c89dbe27d789466', '$2y$10$y1nZmXMfafsErrU3WliS0ungK0IC.VIJfz7r0IVpIGtTP8H.RJotq', '1615624673');

-- --------------------------------------------------------

--
-- Table structure for table `talk-it-out_comments`
--

DROP TABLE IF EXISTS `talk-it-out_comments`;
CREATE TABLE IF NOT EXISTS `talk-it-out_comments` (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Comment` text COLLATE utf8_bin NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `Post_ID` int(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `UserID` (`UserID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `talk-it-out_comments`
--

INSERT INTO `talk-it-out_comments` (`ID`, `UserID`, `Comment`, `CreatedOn`, `Post_ID`) VALUES
(19, 10, 'A majority of Indians in universities like UM and USM tend to be extremely close-minded and tribalistic. If you\'re an Indian freshie, they immediately get to you and start \'ragging\'. Excused as an initiation rite, ragging is simply powerplay and dominance.\n\nIf you\'re not a stereotypical temple-going, tamil-movie-watching, tamil-song-dancing type, they are baffled at your very existence and you are not considered\' indian\'. If you don\'t join the Tamil Cultural Society or Indian Society, you are considered some kind of weird traitor.\n\nWhat\'s baffling is that my aunt faced this scenario 30 years ago as a freshie, and my cousin went through the exact same thing last year. She got harassed so much that the dean had to step in. Shit doesn\'t change.', '2021-03-16 17:36:40', 10),
(20, 22, 'Socially mixing amongst non Malays and Malay in free time is quite rare. Some groups of urban Chinese and Indians in UM and USM will sometimes hang out. For majority of people you tend to spend time with your own race. It will be a culture shock for people from urban areas that would have freely mixed around during school. However everyone is cordial but its usually high-bye kinda thing.\n\nWith course-mates it will be different story, people will befriend you especially after a few courses together. Students of other races / sex will strike up convo with you regularly. You also have to work together to get things done. I been to Malay girls apartments where they are more laid back ( don\'t wear tudung and wear casual ) to finish up group stuff.\n\nI was at USM, cafeteria food sucks except for one canteen which would be crazy packed. But most people just walk outside to Sungai Dua, the food there is very good. Once a friend and I got caught by Pakguard because we used shortcut through broken fence to get to the food. They tried to gertak us making it out like its some big thing. I found it hilarious and just stand our ground during questioning. Its like a power trip which is a common theme in Uni.\n\nLoitering in the cafeterias beyond a certain time was an offense and the patrols would get you. Once we had a bunch of friends from UM staying with us and we were chatting away at cafe when pak-guard came. Outsiders are really not allowed to be there at those times. Tense moment but in that instance the pak-guard was very cool and let us off the hook. So you can imagine hooking up inside is rife with risk. Most couples just go outside.\n\nFirst year nearly everyone stays in dorms but second year its like a privilege to stay in dorm. Of course many students can\'t wait to get out of the dorm and stay with their clique outside. Majority of students will get PTPTN loan, but sometimes its disbursed in 2nd year only and you get a lump sum. So its common to see everyone suddenly with new motorcycle etc.\n\nIf I\'m not mistaken for all Science courses everyone has to publish thesis. The effort required in some courses is not a joke and its common for many to extend due to this. Output wise its like China, they have a very high publication rate but actual value of the research and citation is low. Some good lecturers in certain fields. Student quality might be very misleading as some end up in courses they have no interest in. There was one guy who was doing some HBP ( housing build and planning ) course, think he extended to the limit. He was a \'super senior\'. But he was the go to guy for complicated computer science stuff amongst many students, it was hilarious. He didn\'t graduate with computer science but went on to consult overseas in that field. Overall the high achievers in STPM that maintain their work ethic usually top the classes though.\n\nPenang was a paradise for university life though and common for Scandinavian students to come for student exchange. USM had the best of everything and one of the highlights for many of my friends and I. You will likely make friends for life in uni if you know how to navigate it. Mainly due to shared experiences as you gravitate towards people with the same wavelength. In school you make friends but everyone is just clumped there.', '2021-03-16 17:38:40', 10),
(21, 21, '\"Sometimes the best way to solves your own problems, is to help someone else.\"\n\n-Iroh', '2021-03-16 17:41:09', 11),
(22, 9, '\"That\'s one of the remarkable things about life. It\'s never so bad that it can\'t get worse.\" - Bill Watterson', '2021-03-16 17:41:38', 11),
(23, 11, 'Worrying about things is like sitting in a rocking chair. It gives you something to do for a while but it won\'t get you any where.', '2021-03-16 17:42:14', 11);

-- --------------------------------------------------------

--
-- Table structure for table `talk-it-out_replies`
--

DROP TABLE IF EXISTS `talk-it-out_replies`;
CREATE TABLE IF NOT EXISTS `talk-it-out_replies` (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `CommentID` int(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Comment` text COLLATE utf8_bin NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `Post_ID` int(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `UserID` (`UserID`) USING BTREE,
  KEY `CommentID` (`CommentID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `talk-it-out_replies`
--

INSERT INTO `talk-it-out_replies` (`ID`, `CommentID`, `UserID`, `Comment`, `CreatedOn`, `Post_ID`) VALUES
(41, 16, 11, 'Post #1 Reply #5.1', '2021-03-12 00:13:10', 1),
(43, 19, 24, 'Thanks for the informative answer. I hope you can indulge me by answering a few more.\n\nWould you say the Indians you described, the ones who are closed-minded and tribalistic, were more low-class Indians (I am really loath to describe other people in this manner, but I can\'t think of a better way)? I come from a staunchly middle-class urban Indian family, and all of the Indians I have met in my life who would fit your description tend to come from the lower end of the economic spectrum. However, none of them, in my experience, had or were even interested in higher education. It surprises me that there would be Indians like this in universities.\n\nI\'m thought most of them would be goody-goody, pottu-wearing, temple every Friday kind of people, since they are usually the most studious. I didn\'t think the more crass people would be in uni. What are they like academically? Do they do well in uni?\n\nI\'m sorry about your cousin, it must have been awful to be harassed by your \'own people\', so to speak. Did things get better for her after?', '2021-03-16 17:37:19', 10),
(44, 21, 9, 'Rest in peace wise uncle', '2021-03-16 17:41:46', 11);

-- --------------------------------------------------------

--
-- Table structure for table `talk-it-out_upvotes`
--

DROP TABLE IF EXISTS `talk-it-out_upvotes`;
CREATE TABLE IF NOT EXISTS `talk-it-out_upvotes` (
  `UpvoteID` int(255) NOT NULL AUTO_INCREMENT,
  `PostID` int(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `UpvoteState` int(2) NOT NULL,
  `DownvoteState` int(2) NOT NULL,
  PRIMARY KEY (`UpvoteID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `talk-it-out_upvotes`
--

INSERT INTO `talk-it-out_upvotes` (`UpvoteID`, `PostID`, `UserID`, `UpvoteState`, `DownvoteState`) VALUES
(21, 10, 24, 1, 0),
(22, 10, 10, 0, 0),
(23, 10, 22, 1, 0),
(24, 11, 21, 0, 0),
(25, 11, 9, 0, 0),
(26, 11, 11, 1, 0),
(27, 11, 27, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `talk_it_out_post`
--

DROP TABLE IF EXISTS `talk_it_out_post`;
CREATE TABLE IF NOT EXISTS `talk_it_out_post` (
  `Post_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Post_Title` varchar(50) COLLATE utf8_bin NOT NULL,
  `Post_Content` longtext COLLATE utf8_bin NOT NULL,
  `Post_Date_Time` datetime NOT NULL,
  `UserID` int(20) NOT NULL,
  `Post_Upvote` int(255) NOT NULL,
  PRIMARY KEY (`Post_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `talk_it_out_post`
--

INSERT INTO `talk_it_out_post` (`Post_ID`, `Post_Title`, `Post_Content`, `Post_Date_Time`, `UserID`, `Post_Upvote`) VALUES
(10, 'Student life at universities in Malaysia', 'I recently had a chat with a colleague who attended UM in the the mid-70s. He had some interesting stories about student life there back then, about the professors, the dorms, hook-up culture, the cafeterias, the racial segregation (or rather the lack of it), the quality of education, etc. I found it particularly fascinating because I went to university overseas and have no idea what life is/was like at a Malaysian uni.\r\n\r\nCan anyone shed some light based on their experiences? Which uni and the timeline when you were there would be appreciated.', '2021-03-16 15:36:02', 24, 2),
(11, 'Most useful quotes about life you\'ve heard?', 'What are the most useful quotes that you have heard people said?', '2021-03-16 15:40:47', 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` tinytext NOT NULL,
  `UserPassword` longtext NOT NULL,
  `UserRole` varchar(9) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `UserPassword`, `UserRole`, `UserEmail`) VALUES
(9, 'lim', '$2y$10$3tbu8bi3mey2Mp.0XkTm3ObbN6/yE6wc41S90NLLH/Xp0In4PI1RS', 'admin', 'tp055343@mail.apu.edu.my'),
(10, 'lim_consultor', '$2y$10$7vbd7BaLWx31yELKtoMasOu2jg70AC0Ywh1zXZLz91aVpmvLrtll2', 'consultor', 'johntaylor@mail.com'),
(11, 'lim_student', '$2y$10$cofoySWlzVTO3yOQTFs6z.LbItstcnSRIcn36Ys0z2AlLSO9Kv7QO', 'student', 'ryanlimfangyung@live.com'),
(15, 'lim_consultor2', '$2y$10$ikf18Pvj8hbs3SZG6OHBwuFkyDXRsFNh/eRNHQpjaa2968ueSdR0S', 'consultor', 'tp055343@mail.apu.edu.my'),
(16, 'jeremy_consultor', '$2y$10$OxcRkFs4.UMg1xE5hGso7e/wlky1UPL.Tdi1OVWaMFUssVCpaVNna', 'consultor', 'jeremy@mail.com'),
(17, 'jeremy_user', '$2y$10$LFIQRVAmDXAxZNYBqH6ZG.TfsovXABvGPYmnpBOdx0kZRgvx5JIaq', 'student', 'jeremy@mail.com'),
(21, 'sia', '$2y$10$vtjE66oTgSlR13WDCC1dN.iopQkypfLiFhguzMj95OS1q.OkOnIq6', 'student', 'sia@mail.com'),
(22, 'sia_consultor', '$2y$10$IsaIsXNc/XQgpOJw/a6K/OXaIq33M9yzprzgSlKx9dEG1w54J9OIi', 'consultor', 'admin@mail.com'),
(24, 'fuad', '$2y$10$5xDX7oPDQqzd0fT27HofFOx1h1UiQPBLXKRGaNZ5z2iBciLib8mhm', 'student', 'fuad@live.com'),
(25, 'james', '$2y$10$KgqlMYmwnElvEQtP1IDnWO/6wvI4YQax6OiB1um2NrFpBrk7Qmiv.', 'consultor', 'james@mail.com'),
(26, 'lincoln', '$2y$10$0/BsWebAHSPs.lWD/wQesuDOYwk/Freu.aufWErrKQ9C1Rr0AZaSC', 'consultor', 'lincoln@mail.com'),
(27, 'irfan', '$2y$10$pSsDuErUGypnxrRHxVH54ene1h7FkO6xTKVw4WwLykpsfjl/8JYnS', 'admin', 'irfan@mail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chillbuds-user`
--
ALTER TABLE `chillbuds-user`
  ADD CONSTRAINT `chillbuds-user_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `latest-news_comments`
--
ALTER TABLE `latest-news_comments`
  ADD CONSTRAINT `latest-news_comments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `normal_user`
--
ALTER TABLE `normal_user`
  ADD CONSTRAINT `UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `talk-it-out_comments`
--
ALTER TABLE `talk-it-out_comments`
  ADD CONSTRAINT `talk-it-out_comments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
