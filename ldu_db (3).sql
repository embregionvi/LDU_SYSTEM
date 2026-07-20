-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2026 at 04:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ldu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar_events`
--

CREATE TABLE `calendar_events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `all_day` tinyint(1) NOT NULL DEFAULT 0,
  `color` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `training_id` int(11) DEFAULT NULL,
  `certificate_no` varchar(100) DEFAULT NULL,
  `date_issued` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `document_title` text DEFAULT NULL,
  `date_received_office` date DEFAULT NULL,
  `date_received_ldu` date DEFAULT NULL,
  `received_from` varchar(255) DEFAULT NULL,
  `recent_remarks` text DEFAULT NULL,
  `action_taken` text DEFAULT NULL,
  `date_accomplished` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `date_submitted` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `iis_tracking_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `employee_id`, `document_title`, `date_received_office`, `date_received_ldu`, `received_from`, `recent_remarks`, `action_taken`, `date_accomplished`, `status`, `date_submitted`, `remarks`, `iis_tracking_no`) VALUES
(3, NULL, 'MEMO-2026-13: INVITATION TO NOMINATE CANDIDATES TO THE UNIVERSITY OF THE PHILIPPINES SCHOOL OF ECONOMICS SCHOLARSHIPS AND GRADUATE PROGRAMS FOR THE A.Y. 2026-2027', '2026-01-07', '2026-01-20', 'DENR CO', 'please disseminate', 'Disseminated thru IIS to Division/Section Chiefs.', '2026-01-23', NULL, NULL, '', 'R6-2026-000405'),
(4, NULL, 'Email dtd. Jan. 05,2026 from Records Management Division RE: MEMO-2026-04: INVITATION TO APPLY FOR THE GRADUATE SCHOLARSHIP PROGRAMS OFFERED BY THE UNIVERSITY OF THE PHILIPPINES DILIMAN SCHOOL OF ECONOMICS FOR AY 2026-2027', '2026-01-08', '2026-01-20', 'DENR CO', 'please disseminate', 'Disseminated thru IIS to Division/Section Chiefs.', '2026-01-23', NULL, NULL, '', 'CO-2026-000190'),
(5, NULL, 'SO-2026-37: AUTHORIZING THE CONDUCT OF \"HEART UNDER PRESSURE \"', '2026-02-02', '2026-02-03', 'DENR CO', ' please disseminate', 'Disseminated thru IIS to Division/Section Chiefs.', '2026-02-06', NULL, NULL, '', 'R6-2026-002520'),
(6, NULL, 'Email dtd. Jan. 05,2026 from Records Management Division RE: MEMO-2026-04: INVITATION TO APPLY FOR THE GRADUATE SCHOLARSHIP PROGRAMS OFFERED BY THE UNIVERSITY OF THE PHILIPPINES DILIMAN SCHOOL OF ECONOMICS FOR AY 2026-2027', '2026-01-08', '2026-01-20', 'DENR CO', 'please disseminate', 'Disseminated thru IIS to Division/Section Chiefs.', '2026-01-23', NULL, NULL, '', 'CO-2026-000190');

-- --------------------------------------------------------

--
-- Table structure for table `document_tracking`
--

CREATE TABLE `document_tracking` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `iis_tracking_no` varchar(100) NOT NULL,
  `title_of_document` text NOT NULL,
  `date_received_office` date DEFAULT NULL,
  `received_from` varchar(255) DEFAULT NULL,
  `date_received_ldu` date DEFAULT NULL,
  `recent_remarks` text DEFAULT NULL,
  `action_taken` text DEFAULT NULL,
  `date_accomplished` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_tracking`
--

INSERT INTO `document_tracking` (`id`, `employee_id`, `iis_tracking_no`, `title_of_document`, `date_received_office`, `received_from`, `date_received_ldu`, `recent_remarks`, `action_taken`, `date_accomplished`, `remarks`, `created_at`, `updated_at`) VALUES
(1, NULL, 'R6-2026-001277', 'UNDP Invitation to the Learning Exchange on Mainstreaming Circular Economy in Local Governance and CE Portfolio Updating Workshop, 2-5 February 2026', '2026-01-20', 'UNDP', '2026-01-21', 'Please prepare draft RSO', 'Drafted amended SO forwarded for review and signature', '2026-01-21', '', '2026-04-07 09:47:22', '2026-04-07 09:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `employment_type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `employee_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `position`, `employment_type`, `created_at`, `employee_code`) VALUES
(2, 'Joseph Bance', 'pres', 'Permanent', '2026-03-25 01:43:53', NULL),
(3, 'Joseph bance', 'Chief,Environmental Education and Information Unit', 'Permanent', '2026-04-09 12:09:04', '261-248-23'),
(4, 'Joseph Bance Jr.', 'Chief,Environmental Education and Information Unit II', 'Permanent', '2026-04-17 09:01:59', '261-248-232'),
(5, 'Carla Marie Bance', 'Chief,Environmental Education and Information Unit III', 'COS', '2026-04-17 09:04:12', '261-248-2322');

-- --------------------------------------------------------

--
-- Table structure for table `employee_reports`
--

CREATE TABLE `employee_reports` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `training_id` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `organizer` varchar(255) DEFAULT NULL,
  `total_participants` int(11) DEFAULT NULL,
  `budget` decimal(12,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `event_date` varchar(100) DEFAULT NULL,
  `iis_no` varchar(100) DEFAULT NULL,
  `special_order_no` varchar(100) DEFAULT NULL,
  `conducted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `training_id`, `title`, `date_from`, `date_to`, `venue`, `organizer`, `total_participants`, `budget`, `remarks`, `event_date`, `iis_no`, `special_order_no`, `conducted_by`) VALUES
(1, NULL, 'Learning Exchange on Mainstreaming Circular Economy in Local Governance and CE Portfolio Updating Workshop', NULL, NULL, 'Metro Manila', NULL, NULL, NULL, 'Event Done\r\nILRs to be followed up', 'February 2-5, 2026', 'R6-2026-001277', 'RSO. NO. 6 S. 2026', 'UNDP'),
(2, NULL, 'ORIENTATION AND LEARNING EVENT ON DENR CORE VALUES, POLICIES AND MANDATES FOR NEW HIRES AND CONTRACT OF SERVICE (COS) PERSONNEL', NULL, NULL, 'Sam\'s 21 Hotel', NULL, NULL, NULL, 'Event Done', 'February 5, 2026', 'R6-2026-001829', 'RSO. NO. 10 S. 2026', 'EMB R6 - LDU'),
(4, NULL, 'qdad', NULL, NULL, 'Guimaras', NULL, NULL, NULL, '', '2026-05-05', 'R6-2026-001277', 'RSO. NO. 6 S. 2026', 'sda'),
(5, NULL, 'dfaasf', NULL, NULL, 'Guimaras', NULL, NULL, NULL, 'dasdad', '2026-05-06', 'R6-2026-001277', 'RSO. NO. 6 S. 2026', 'sda');

-- --------------------------------------------------------

--
-- Table structure for table `event_participants`
--

CREATE TABLE `event_participants` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_participants`
--

INSERT INTO `event_participants` (`id`, `event_id`, `employee_id`) VALUES
(19, 1, 3),
(17, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `learning_events_attended`
--

CREATE TABLE `learning_events_attended` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `iis_no` varchar(100) DEFAULT NULL,
  `special_order_no` varchar(100) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `type_learning` varchar(255) DEFAULT NULL,
  `office` varchar(100) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `training_hours` int(11) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `sponsor` varchar(255) DEFAULT NULL,
  `male` int(11) DEFAULT NULL,
  `female` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `travel_expense` varchar(255) DEFAULT NULL,
  `competency` varchar(255) DEFAULT NULL,
  `administrator` varchar(255) DEFAULT NULL,
  `attendance_sheets` varchar(255) DEFAULT NULL,
  `training_report_submission` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learning_events_attended`
--

INSERT INTO `learning_events_attended` (`id`, `employee_id`, `iis_no`, `special_order_no`, `title`, `provider`, `type_learning`, `office`, `date_from`, `date_to`, `cost`, `training_hours`, `venue`, `sponsor`, `male`, `female`, `total`, `remarks`, `travel_expense`, `competency`, `administrator`, `attendance_sheets`, `training_report_submission`) VALUES
(1, NULL, 'R6-2026-001277', 'NSO No. 2026-040', 'CONDUCT OF THE ICT TRAINING WORKSHOP ON THE EMB CLIENT SUPPORT SYSTEM AND REVIEW OF HAZARDOUS WASTE MANAGEMENT SYSTEM (HWMS)', 'EMB CO', 'Information Technology and HWMS', 'EMB-R6', '2026-03-27', '2026-03-28', '900000.00', 25, 'Zoom Platform', '', 4, 0, 4, 'N. Agsaluna, C. Calapa-an, M. Zerrudo, R. Valle', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `learning_events_conducted`
--

CREATE TABLE `learning_events_conducted` (
  `id` int(11) NOT NULL,
  `rso_no` varchar(100) DEFAULT NULL,
  `special_order_no` varchar(100) DEFAULT NULL,
  `title` text NOT NULL,
  `service_provider` varchar(100) DEFAULT NULL,
  `competency` varchar(100) DEFAULT NULL,
  `type_learning` varchar(150) DEFAULT NULL,
  `learning_administrator` varchar(100) DEFAULT NULL,
  `office_organization` varchar(100) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `cost` decimal(12,2) DEFAULT 0.00,
  `training_hours` int(11) DEFAULT 0,
  `venue` varchar(255) DEFAULT NULL,
  `sponsor` varchar(255) DEFAULT NULL,
  `remarks_participants` text DEFAULT NULL,
  `male` int(11) DEFAULT 0,
  `female` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `attendance_sheets` varchar(50) DEFAULT NULL,
  `training_report_submission` varchar(50) DEFAULT NULL,
  `evaluation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learning_events_conducted`
--

INSERT INTO `learning_events_conducted` (`id`, `rso_no`, `special_order_no`, `title`, `service_provider`, `competency`, `type_learning`, `learning_administrator`, `office_organization`, `date_from`, `date_to`, `cost`, `training_hours`, `venue`, `sponsor`, `remarks_participants`, `male`, `female`, `total`, `attendance_sheets`, `training_report_submission`, `evaluation`) VALUES
(1, 'R6-2026-001415', 'RSO. NO. 18 S. 2026', 'STRATEGIC PLANNING AND PROFESSIONAL COMPETENCY ENHANCEMENT OF SWM PERSONNEL AND ENMOS', 'Internal', 'Functional', 'Solid Waste Management', 'N/A', 'EMB', '2026-02-17', '2026-02-18', '0.00', 8, 'Diversion 21 Hotel Mandurriao, Iloilo City', '', '', 0, 0, 0, 'Pending', 'Submitted', 'Pending'),
(2, 'R6-2026-001416', 'RSO. NO. S. 7 2026', 'Aquabest for the best', 'Internal', 'Functional', 'Solid Waste Management', 'N/A', 'EMB', '2026-04-29', '2026-05-01', '1000.00', 10, 'Guimaras', 'EMB EEIU', 'HAHAHAH', 10, 12, 22, 'Pending', 'Submitted', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `learning_event_id` int(11) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `position` varchar(150) DEFAULT NULL,
  `conducted_by` varchar(150) DEFAULT NULL,
  `competency` varchar(150) DEFAULT NULL,
  `ilr_deadline` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `learning_event_id`, `last_name`, `first_name`, `middle_name`, `position`, `conducted_by`, `competency`, `ilr_deadline`, `created_at`) VALUES
(1, 3, 'Quistadio', 'Emman', 'JAMPIL', 'Computer Programmer', 'zxc', 'ZXCZ', '2026-04-27', '2026-04-28 03:11:25'),
(2, 3, 'Doe', 'John', 'skkkrt', 'MIS', 'EMB R6', 'ASDASA', '2026-04-27', '2026-04-28 03:27:00'),
(3, 1, 'Hat', 'dog', 'gg', 'asdop', 'EMB R6', 'zxccc', '2026-04-10', '2026-04-28 07:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `venue` varchar(150) DEFAULT NULL,
  `competency` varchar(150) DEFAULT NULL,
  `ldu_budget` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `special_order` varchar(100) DEFAULT NULL,
  `organizer` varchar(150) DEFAULT NULL,
  `cpd_units` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `employee_id`, `title`, `date_from`, `date_to`, `venue`, `competency`, `ldu_budget`, `created_at`, `special_order`, `organizer`, `cpd_units`) VALUES
(1, 2, 'UNDP Invitation to the Learning Exchange on Mainstreaming Circular Economy in Local Governance and CE Portfolio Updating Workshop, 2-5 February 2026', '2026-04-25', '2026-04-25', 'Metro Manila', 'n/a', '10000.00', '2026-03-25 02:10:54', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `training_ilr`
--

CREATE TABLE `training_ilr` (
  `id` int(11) NOT NULL,
  `training_id` int(11) DEFAULT NULL,
  `participant_id` int(11) NOT NULL,
  `date_submitted` date DEFAULT NULL,
  `transaction_number` varchar(100) DEFAULT NULL,
  `subject_name` varchar(255) DEFAULT NULL,
  `participant_name` varchar(255) DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_participants`
--

CREATE TABLE `training_participants` (
  `id` int(11) NOT NULL,
  `training_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(4, 'admin', '$2y$10$KW09VUJU9l2KkcKdB4d8M.4Euse06HDM98gbPs4DnHug1e2kcIOZi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar_events`
--
ALTER TABLE `calendar_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_id` (`training_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `document_tracking`
--
ALTER TABLE `document_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_reports`
--
ALTER TABLE `employee_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_events_training` (`training_id`);

--
-- Indexes for table `event_participants`
--
ALTER TABLE `event_participants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_event_employee` (`event_id`,`employee_id`),
  ADD KEY `idx_event_participants_event_id` (`event_id`),
  ADD KEY `idx_event_participants_employee_id` (`employee_id`);

--
-- Indexes for table `learning_events_attended`
--
ALTER TABLE `learning_events_attended`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learning_events_conducted`
--
ALTER TABLE `learning_events_conducted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_ilr`
--
ALTER TABLE `training_ilr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_participants`
--
ALTER TABLE `training_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar_events`
--
ALTER TABLE `calendar_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `document_tracking`
--
ALTER TABLE `document_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee_reports`
--
ALTER TABLE `employee_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_participants`
--
ALTER TABLE `event_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `learning_events_attended`
--
ALTER TABLE `learning_events_attended`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `learning_events_conducted`
--
ALTER TABLE `learning_events_conducted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_ilr`
--
ALTER TABLE `training_ilr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_participants`
--
ALTER TABLE `training_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`);

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_training` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `event_participants`
--
ALTER TABLE `event_participants`
  ADD CONSTRAINT `event_participants_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `event_participants_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
