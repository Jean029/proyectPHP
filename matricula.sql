-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for matricula
CREATE DATABASE IF NOT EXISTS `matricula` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `matricula`;

-- Dumping structure for table matricula.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` varchar(8) NOT NULL,
  `title` varchar(255) NOT NULL,
  `credits` int(2) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table matricula.courses: ~4 rows (approximately)
DELETE FROM `courses`;
INSERT INTO `courses` (`course_id`, `title`, `credits`) VALUES
	('CCOM3002', 'Programacion 2', 5),
	('CCOM3010', 'LOGICAL LEVELS', 3),
	('CCOM3025', 'INTRODUCTION TO COMPUTER SYSTEMS', 3),
	('CCOM4115', 'DATABASE DESIGN', 3);

-- Dumping structure for table matricula.enrollment
CREATE TABLE IF NOT EXISTS `enrollment` (
  `student_id` varchar(9) NOT NULL,
  `course_id` varchar(8) NOT NULL,
  `section_id` varchar(3) NOT NULL,
  `credits` int(2) NOT NULL DEFAULT 0,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` char(1) NOT NULL DEFAULT '0',
  KEY `enroll_student` (`student_id`),
  KEY `enroll_course` (`course_id`),
  KEY `enroll_section` (`section_id`),
  CONSTRAINT `enroll_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `enroll_section` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `enroll_student` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table matricula.enrollment: ~2 rows (approximately)
DELETE FROM `enrollment`;
INSERT INTO `enrollment` (`student_id`, `course_id`, `section_id`, `credits`, `time`, `status`) VALUES
	('840194022', 'CCOM3010', 'H20', 3, '2024-02-18 02:40:07', '2'),
	('840194022', 'CCOM4115', 'HME', 3, '2024-02-18 02:40:07', '2');

-- Dumping structure for table matricula.section
CREATE TABLE IF NOT EXISTS `section` (
  `course_id` varchar(8) NOT NULL,
  `section_id` varchar(3) NOT NULL,
  `capacity` int(3) NOT NULL,
  `total_capacity` int(11) NOT NULL,
  KEY `section_courses` (`course_id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `section_courses` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table matricula.section: ~6 rows (approximately)
DELETE FROM `section`;
INSERT INTO `section` (`course_id`, `section_id`, `capacity`, `total_capacity`) VALUES
	('CCOM3010', 'H20', 19, 20),
	('CCOM3010', 'HA0', 15, 15),
	('CCOM4115', 'HME', 14, 15),
	('CCOM3025', 'L30', 15, 15),
	('CCOM4115', 'ME5', 15, 15),
	('CCOM3010', 'VB0', 20, 20),
	('CCOM3002', 'VB0', 20, 20);

-- Dumping structure for table matricula.student
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` varchar(9) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `year_of_study` int(1) NOT NULL,
  `enroll_status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table matricula.student: ~3 rows (approximately)
DELETE FROM `student`;
INSERT INTO `student` (`student_id`, `password`, `user_name`, `year_of_study`, `enroll_status`) VALUES
	('000194022', '$2y$10$D.qzryD.KCASR5BI57LVYuPtQpcvsZO2e9/o0jt6eh8TyD3SBOOOm', 'admin', 0, 1),
	('840194022', '$2y$10$D.qzryD.KCASR5BI57LVYuPtQpcvsZO2e9/o0jt6eh8TyD3SBOOOm', 'Jean Serrano Cruz', 5, 0),
	('840194055', '$2y$10$o/Q984J11fhRFAOpSf5CHOmrTt38VPaZkos/Jts7xpL9yEoj8.PUa', 'Jean C Serrano cruz', 2, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
