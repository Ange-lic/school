-- MariaDB dump 10.19  Distrib 10.8.3-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: sms6
-- ------------------------------------------------------
-- Server version	10.8.3-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_tb`
--

DROP TABLE IF EXISTS `admin_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_tb` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `adminname` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_phone` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `username` (`username`),
  CONSTRAINT `admin_tb_ibfk_1` FOREIGN KEY (`username`) REFERENCES `login_tb` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_tb`
--

LOCK TABLES `admin_tb` WRITE;
/*!40000 ALTER TABLE `admin_tb` DISABLE KEYS */;
INSERT INTO `admin_tb` VALUES
(10,'admin','ad@mail.com','0921487','admin','1234');
/*!40000 ALTER TABLE `admin_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance_tb`
--

DROP TABLE IF EXISTS `attendance_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance_tb` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`attendance_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_tb`
--

LOCK TABLES `attendance_tb` WRITE;
/*!40000 ALTER TABLE `attendance_tb` DISABLE KEYS */;
INSERT INTO `attendance_tb` VALUES
(51,59,'2019-11-30','Absent'),
(52,59,'2019-12-01','Leave'),
(53,69,'2019-12-02','Present'),
(55,68,'2019-11-30','Leave'),
(58,59,'2019-12-27','Present'),
(59,68,'2019-12-27','Absent'),
(60,84,'2019-12-30','Present'),
(61,85,'2019-12-30','Absent'),
(62,86,'2019-12-30','Present');
/*!40000 ALTER TABLE `attendance_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_tb`
--

DROP TABLE IF EXISTS `class_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_tb` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(50) NOT NULL,
  `class_price` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_tb`
--

LOCK TABLES `class_tb` WRITE;
/*!40000 ALTER TABLE `class_tb` DISABLE KEYS */;
INSERT INTO `class_tb` VALUES
(1,'One','400'),
(2,'Two','600'),
(3,'Three','700'),
(4,'Four','800'),
(5,'Five','800'),
(6,'Six','850'),
(7,'Seven','900'),
(8,'Eight','950'),
(9,'Nine','1100'),
(10,'Ten','1300');
/*!40000 ALTER TABLE `class_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diary_tb`
--

DROP TABLE IF EXISTS `diary_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diary_tb` (
  `diary_id` int(11) NOT NULL AUTO_INCREMENT,
  `diary` varchar(10000) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`diary_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diary_tb`
--

LOCK TABLES `diary_tb` WRITE;
/*!40000 ALTER TABLE `diary_tb` DISABLE KEYS */;
INSERT INTO `diary_tb` VALUES
(88,'<p>Date 31 diary to students</p>',10,0,'2019-12-31',9),
(89,'<p>English : Rem Q:no 2 full</p>',12,2,'2019-12-30',15);
/*!40000 ALTER TABLE `diary_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fee_tb`
--

DROP TABLE IF EXISTS `fee_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fee_tb` (
  `fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `amount` varchar(1000) NOT NULL,
  `status` varchar(50) NOT NULL,
  `month` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY (`fee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fee_tb`
--

LOCK TABLES `fee_tb` WRITE;
/*!40000 ALTER TABLE `fee_tb` DISABLE KEYS */;
INSERT INTO `fee_tb` VALUES
(15,58,10,0,'2000','UnPaid','December','2019-11-10'),
(16,59,10,0,'2000','Paid','December','2019-11-30'),
(17,73,10,0,'5000','Paid','December','2019-10-25');
/*!40000 ALTER TABLE `fee_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_tb`
--

DROP TABLE IF EXISTS `login_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_tb`
--

LOCK TABLES `login_tb` WRITE;
/*!40000 ALTER TABLE `login_tb` DISABLE KEYS */;
INSERT INTO `login_tb` VALUES
(1,'admin','1234'),
(90,'lewaqegyg','Cherokee Mcintyre'),
(91,'lewaqegygp','Cherokee Mcintyre'),
(93,'nirajp','niraj'),
(104,'nirajxyz','1234'),
(105,'nirajxyzp','1234'),
(106,'qicuvup','Kimberly Cook'),
(107,'qicuvupp','Kimberly Cook'),
(108,'ramey','1234'),
(109,'bibek','1234'),
(110,'shyam','1234'),
(111,'niraj','1234'),
(112,'unknown','1234'),
(113,'guwomagija','1234'),
(114,'guwomagijap','1234'),
(115,'qovyfu','1234'),
(116,'qovyfup','1234'),
(117,'zynaqecyf','1234'),
(118,'zynaqecyfp','1234'),
(119,'nigikogo','1234'),
(120,'nigikogop','1234'),
(121,'mowig','1234'),
(122,'mowigp','1234'),
(123,'cymypo','1234'),
(124,'cymypop','1234'),
(125,'xiqitoc','1234'),
(126,'xiqitocp','1234'),
(127,'vujez','1234'),
(128,'vujezp','1234'),
(129,'futejyky','1234'),
(130,'futejykyp','1234'),
(131,'zoxokif','1234'),
(132,'zoxokifp','1234'),
(133,'zidyjureja','1234'),
(134,'zidyjurejap','1234'),
(135,'cosycu','1234'),
(136,'cosycup','1234'),
(137,'ridogumis','1234'),
(138,'ridogumisp','1234'),
(141,'nymeq','1234'),
(142,'nymeqp','1234'),
(143,'pivugika','1234'),
(144,'pivugikap','1234'),
(147,'velizosid','1234'),
(148,'velizosidp','1234'),
(149,'lurek','1234'),
(150,'lurekp','1234'),
(151,'qeberip','1234'),
(152,'qeberipp','1234');
/*!40000 ALTER TABLE `login_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marking`
--

DROP TABLE IF EXISTS `marking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marking` (
  `student_id` int(11) NOT NULL,
  `subject` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marks` int(11) NOT NULL,
  `exam` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marking`
--

LOCK TABLES `marking` WRITE;
/*!40000 ALTER TABLE `marking` DISABLE KEYS */;
INSERT INTO `marking` VALUES
(4,'6',20,'First Term'),
(4,'6',90,'Mid Term'),
(4,'6',20,'Final Term'),
(1,'2',50,'Mid Term');
/*!40000 ALTER TABLE `marking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marks_table`
--

DROP TABLE IF EXISTS `marks_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marks_table` (
  `mark_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `exam_name` varchar(50) NOT NULL,
  `marks` varchar(50) NOT NULL,
  PRIMARY KEY (`mark_id`),
  KEY `student_id` (`student_id`),
  KEY `subject_id` (`subject_id`),
  KEY `class_id` (`class_id`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marks_table`
--

LOCK TABLES `marks_table` WRITE;
/*!40000 ALTER TABLE `marks_table` DISABLE KEYS */;
INSERT INTO `marks_table` VALUES
(1,4,9,1,6,'First Term','20'),
(2,4,9,1,6,'Mid Term','90'),
(3,4,9,1,6,'Final Term','20'),
(4,1,10,2,2,'Mid Term','50');
/*!40000 ALTER TABLE `marks_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messaege_weak`
--

DROP TABLE IF EXISTS `messaege_weak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messaege_weak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msgT` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_msgT` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_msgT` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messaege_weak`
--

LOCK TABLES `messaege_weak` WRITE;
/*!40000 ALTER TABLE `messaege_weak` DISABLE KEYS */;
/*!40000 ALTER TABLE `messaege_weak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_tb`
--

DROP TABLE IF EXISTS `message_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(10000) NOT NULL,
  `to` varchar(50) NOT NULL,
  `from_msg` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_tb`
--

LOCK TABLES `message_tb` WRITE;
/*!40000 ALTER TABLE `message_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messageteacher_tb`
--

DROP TABLE IF EXISTS `messageteacher_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messageteacher_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msgT` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_msgT` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_msgT` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messageteacher_tb`
--

LOCK TABLES `messageteacher_tb` WRITE;
/*!40000 ALTER TABLE `messageteacher_tb` DISABLE KEYS */;
INSERT INTO `messageteacher_tb` VALUES
(1,'<p>ramrosi&nbsp; padh</p>','weak','1');
/*!40000 ALTER TABLE `messageteacher_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news` varchar(10000) NOT NULL,
  `to_aud` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES
(14,'<p>Annocement of the week</p>','students','2019-11-28'),
(15,'<p>Teacher news to admin</p>','teachers','2019-11-28'),
(17,'<p>Hello To Alll</p>','students','2019-12-01'),
(20,'<p>Happy New Year</p>','students','2020-01-31');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parent_tb`
--

DROP TABLE IF EXISTS `parent_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parent_tb` (
  `parent_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`parent_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parent_tb`
--

LOCK TABLES `parent_tb` WRITE;
/*!40000 ALTER TABLE `parent_tb` DISABLE KEYS */;
INSERT INTO `parent_tb` VALUES
(17,'Anastasia Todd','Ivy Burke','hyxeqah@mailinator.com','ridogumisp','1234'),
(52,'Kelsey Brock','Barbara Albert','suzaranuj@mailinator.com','lurekp','1234'),
(54,'Quynn Vaughn','Jared Cox','bydocida@mailinator.com','cosycup','1234'),
(63,'Serina Shaw','Bruno Newman','tasyp@mailinator.com','pivugikap','1234'),
(79,'Shelly Floyd','Summer Hess','piry@mailinator.com','nymeqp','1234'),
(83,'Ryan Camacho','Cameron Paul','ginici@mailinator.com','qeberipp','1234'),
(100,'Keefe Ballard','Janna Dudley','mumygyrac@mailinator.com','velizosidp','1234');
/*!40000 ALTER TABLE `parent_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `remarking`
--

DROP TABLE IF EXISTS `remarking`;
/*!50001 DROP VIEW IF EXISTS `remarking`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `remarking` (
  `student_id` tinyint NOT NULL,
  `subject` tinyint NOT NULL,
  `marks` tinyint NOT NULL,
  `exam` tinyint NOT NULL,
  `remarks` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `remarks`
--

DROP TABLE IF EXISTS `remarks`;
/*!50001 DROP VIEW IF EXISTS `remarks`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `remarks` (
  `student_id` tinyint NOT NULL,
  `subject` tinyint NOT NULL,
  `marks` tinyint NOT NULL,
  `exam` tinyint NOT NULL,
  `abc` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `schedule_tb`
--

DROP TABLE IF EXISTS `schedule_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule_tb` (
  `sc_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `day` varchar(50) NOT NULL,
  `slot` varchar(50) NOT NULL,
  PRIMARY KEY (`sc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_tb`
--

LOCK TABLES `schedule_tb` WRITE;
/*!40000 ALTER TABLE `schedule_tb` DISABLE KEYS */;
INSERT INTO `schedule_tb` VALUES
(65,10,0,19,'Monday','8-9'),
(66,10,0,19,'Monday','9-10'),
(67,10,0,19,'Monday','10-11'),
(68,10,0,19,'Tuesday','8-9'),
(69,11,1,20,'Monday','8-9');
/*!40000 ALTER TABLE `schedule_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `section` (
  `section_id` int(100) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`section_id`),
  KEY `class_id` (`class_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section`
--

LOCK TABLES `section` WRITE;
/*!40000 ALTER TABLE `section` DISABLE KEYS */;
INSERT INTO `section` VALUES
(0,'A',1,3),
(1,'B',9,5),
(2,'C',10,2),
(3,'D',7,4),
(4,'E',4,1),
(6,'G',10,3);
/*!40000 ALTER TABLE `section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_tb`
--

DROP TABLE IF EXISTS `student_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_tb` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `parent_name` varchar(50) NOT NULL,
  `parent_phone` varchar(50) NOT NULL,
  `parent_email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `class_id` (`class_id`),
  KEY `parent_id` (`parent_id`),
  KEY `username` (`username`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_tb`
--

LOCK TABLES `student_tb` WRITE;
/*!40000 ALTER TABLE `student_tb` DISABLE KEYS */;
INSERT INTO `student_tb` VALUES
(1,'Flavia Rojas','Male','Jeremy Long',10,2,54,'Quynn Vaughn','Jared Cox','bydocida@mailinator.com','cosycu','1234'),
(2,'Lucy Jackson','Female','Rhea Watson',10,6,17,'Anastasia Todd','Ivy Burke','hyxeqah@mailinator.com','ridogumis','1234'),
(4,'Rebekah Hewitt','Female','Chase Mcleod',9,1,79,'Shelly Floyd','Summer Hess','piry@mailinator.com','nymeq','1234'),
(5,'Knox Macdonald','Male','Sawyer Cline',7,3,63,'Serina Shaw','Bruno Newman','tasyp@mailinator.com','pivugika','1234'),
(7,'Alec Fry','Male','Lavinia Henson',1,0,100,'Keefe Ballard','Janna Dudley','mumygyrac@mailinator.com','velizosid','1234'),
(8,'Akeem Hawkins','Male','Jorden Holden',4,4,52,'Kelsey Brock','Barbara Albert','suzaranuj@mailinator.com','lurek','1234'),
(9,'McKenzie Pena','Male','Carolyn Gibbs',7,3,83,'Ryan Camacho','Cameron Paul','ginici@mailinator.com','qeberip','1234');
/*!40000 ALTER TABLE `student_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject_tb`
--

DROP TABLE IF EXISTS `subject_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject_tb` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`subject_id`),
  KEY `class_id` (`class_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject_tb`
--

LOCK TABLES `subject_tb` WRITE;
/*!40000 ALTER TABLE `subject_tb` DISABLE KEYS */;
INSERT INTO `subject_tb` VALUES
(1,'Nepali',1,4),
(2,'English',10,2),
(3,'Math',10,2),
(4,'EPH',9,3),
(5,'Social',9,5),
(6,'Science',9,1),
(7,'Geography',9,5);
/*!40000 ALTER TABLE `subject_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher_tb`
--

DROP TABLE IF EXISTS `teacher_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher_tb` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`teacher_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher_tb`
--

LOCK TABLES `teacher_tb` WRITE;
/*!40000 ALTER TABLE `teacher_tb` DISABLE KEYS */;
INSERT INTO `teacher_tb` VALUES
(1,'Ram Bahadur','ramey@gmail.com','98000000000','ramey','1234'),
(2,'Bibek ','bibek@gmail.com','+98282828282','bibek','1234'),
(3,'Shyam Sharma','shyamey@gmail.com','23344422111','shyam','1234'),
(4,'Niraj Ghimire','niraj@gmail.com','000000000','niraj','1234'),
(5,'Dahlia Valenzuela','gihy@mailinator.com','+93279367282','unknown','1234');
/*!40000 ALTER TABLE `teacher_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `remarking`
--

/*!50001 DROP TABLE IF EXISTS `remarking`*/;
/*!50001 DROP VIEW IF EXISTS `remarking`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb3 */;
/*!50001 SET character_set_results     = utf8mb3 */;
/*!50001 SET collation_connection      = utf8mb3_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `remarking` AS select `marking`.`student_id` AS `student_id`,`marking`.`subject` AS `subject`,`marking`.`marks` AS `marks`,`marking`.`exam` AS `exam`,if(`marking`.`marks` >= 80,'Distinction',if(`marking`.`marks` <= 20,'Weak',if(`marking`.`marks` < 60,'Average',if(`marking`.`marks` < 80,'Good','None')))) AS `remarks` from `marking` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `remarks`
--

/*!50001 DROP TABLE IF EXISTS `remarks`*/;
/*!50001 DROP VIEW IF EXISTS `remarks`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb3 */;
/*!50001 SET character_set_results     = utf8mb3 */;
/*!50001 SET collation_connection      = utf8mb3_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `remarks` AS select `marking`.`student_id` AS `student_id`,`marking`.`subject` AS `subject`,`marking`.`marks` AS `marks`,`marking`.`exam` AS `exam`,`marking`.`student_id` AS `abc` from `marking` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-01 22:42:25
