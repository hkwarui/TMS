-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 21, 2021 at 02:12 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_records`
--

CREATE TABLE `class_records` (
  `id` int(11) NOT NULL,
  `courseId` varchar(200) NOT NULL,
  `cohortId` varchar(200) NOT NULL,
  `startDate` varchar(200) NOT NULL DEFAULT current_timestamp(),
  `endDate` varchar(200) DEFAULT NULL,
  `attendance` varchar(200) DEFAULT NULL,
  `result` varchar(200) DEFAULT NULL,
  `stud_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_records`
--

INSERT INTO `class_records` (`id`, `courseId`, `cohortId`, `startDate`, `endDate`, `attendance`, `result`, `stud_id`) VALUES
(1, 'SS-4', 'Cohort-017/2021', '2021-04-15 16:29:17', NULL, NULL, NULL, '2385496545'),
(2, 'SS-5', 'Cohort-05/2021', '2021-04-19 15:54:22', NULL, NULL, NULL, '28582027'),
(3, 'SS-3', 'Cohort-03/2021', '2021-04-19 18:16:40', NULL, NULL, NULL, '2858200'),
(4, 'SS-3', 'Cohort-03/2021', '2021-04-19 18:21:20', NULL, NULL, NULL, '555555'),
(5, 'SS-3', 'Cohort-03/2021', '2021-04-19 18:22:05', NULL, NULL, NULL, '555555'),
(6, 'SS-4', 'Cohort-017/2021', '2021-04-19 18:40:06', NULL, NULL, NULL, '555555'),
(7, 'SS-4', 'Cohort-017/2021', '2021-04-19 23:40:15', NULL, NULL, NULL, '28582027'),
(8, 'SS-1', 'Cohort-020/2021', '2021-04-20 00:23:28', NULL, NULL, NULL, '999999'),
(9, 'SS-1', 'Cohort-020/2021', '2021-04-20 00:26:38', NULL, NULL, NULL, '78896544');

-- --------------------------------------------------------

--
-- Table structure for table `cohorts`
--

CREATE TABLE `cohorts` (
  `id` int(11) NOT NULL,
  `courseId` varchar(200) NOT NULL,
  `cohortId` varchar(200) NOT NULL,
  `startTime` varchar(200) NOT NULL,
  `venue` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'scheduled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cohorts`
--

INSERT INTO `cohorts` (`id`, `courseId`, `cohortId`, `startTime`, `venue`, `status`) VALUES
(1, 'SS-2', 'Cohort-01/2021', '13:40', 'online', 'scheduled'),
(3, 'SS-3', 'Cohort-03/2021', '04:52', 'Online', 'inProgress'),
(5, 'SS-5', 'Cohort-05/2021', '14:02', 'Online', 'cancelled'),
(6, 'SS-2', 'Cohort-06/2021', '11:31', 'online', 'scheduled'),
(7, 'SS-3', 'Cohort-07/2021', '11:33', 'Online ', 'inProgress'),
(10, 'SS-9', 'Cohort-010/2021', '16:14', 'Online', 'scheduled'),
(11, 'SS-6', 'Cohort-011/2021', '12:08', 'Online', 'done'),
(12, 'SS-7', 'Cohort-012/2021', '00:13', 'Online', 'scheduled'),
(15, 'SS-1', 'Cohort-013/2021', '15:00', 'online', 'cancelled'),
(16, 'SS-10', 'Cohort-016/2021', '16:30', 'conference ', 'scheduled'),
(17, 'SS-4', 'Cohort-017/2021', '02:28', '8998898', 'inProgress'),
(18, 'SS-9', 'Cohort-018/2021', '21:00', 'Virtual Conference', 'scheduled'),
(19, 'SS-4', 'Cohort-019/2021', '16:55', 'Online', 'inProgress'),
(22, 'SS-1', 'Cohort-020/2021', '00:22', 'LLLLLL', 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `courseName` varchar(200) NOT NULL,
  `courseId` varchar(200) NOT NULL,
  `validity` varchar(200) NOT NULL,
  `duration` varchar(200) NOT NULL,
  `cost` varchar(200) NOT NULL,
  `instructor` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `courseName`, `courseId`, `validity`, `duration`, `cost`, `instructor`) VALUES
(1, 'Job Onboarding ', 'SS-1', '88', '2', '777', 'James Bond'),
(3, 'Safety Wear Training ', 'SS-3', '8', '20', '0', 'Henry warui'),
(4, 'Permanent  Pass Training', 'SS-4', '3', '5', '1500', 'Henry Warui'),
(5, 'IT Basics Training', 'SS-5', '5', '5', '2000', 'Dan warui'),
(6, 'Fire Training', 'SS-6', '4', '20', '5000', 'Geofrey Bundi'),
(7, 'Hr Manual Training', 'SS-7', '10', '10', '200', 'grace nyabura'),
(8, 'Basic PrograminG', 'SS-8', '3', '10', '500', 'Henry warui'),
(9, 'Music Player', 'SS-9', '5', '3', '0', 'Jesus '),
(12, 'Hdhdh', 'SS-10', '456987', '10', '1025', 'kinyua'),
(13, 'KSKSKSK', 'SS-13', '8', '3', '0', 'LDDLDLLDLDL');

-- --------------------------------------------------------

--
-- Table structure for table `facilitators`
--

CREATE TABLE `facilitators` (
  `id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `company` varchar(200) NOT NULL,
  `passport` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facilitators`
--

INSERT INTO `facilitators` (`id`, `fullname`, `username`, `email`, `company`, `passport`, `phone`) VALUES
(26, 'dfddf', 'fdfdfd', 'dfdfdf@gmail', 'kiwi johnson', '28546982', '7896541223');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `passport` varchar(200) NOT NULL,
  `company` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `perfomance` varchar(200) DEFAULT NULL,
  `completion` varchar(200) NOT NULL DEFAULT 'incomplete',
  `courseId` varchar(200) NOT NULL,
  `cohortId` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `fullname`, `email`, `phone`, `passport`, `company`, `designation`, `perfomance`, `completion`, `courseId`, `cohortId`) VALUES
(1, 'erere', 'fgfgf@gfgf', '77777999999', '55555', 'kkkkk', 'kkkkkk', NULL, 'incomplete', 'pppp', 'ppp'),
(2, 'henry warui', 'warui.gmail@com', '0713498554', '28582027', 'sharp technology', 'software developer', NULL, 'incomplete', 'SS-0002', 'Cohort-01/2021'),
(3, 'john doe', 'warui@gmail.com', '2858202778', '285202', 'llll', 'llll', NULL, 'incomplete', '78', 'Cohort-05/2021'),
(4, 'henry warui', 'henry@gmail.com', '0745698745', '28596378', 'sharp technology', 'software  ', 'pass', 'completed', 'SS-3', 'Cohort-03/2021'),
(5, 'Kamenya', 'Kamenya@gmail.com', '0745698745', '845698712', 'point housing ', 'engineer', NULL, 'incomplete', 'SS-5', 'Cohort-05/2021'),
(6, 'venessa Dee', 'dee@gmail.com', '0714896542', '28528024', 'penipila', 'accountant', NULL, 'completed', 'SS-1', 'Cohort-013/2021'),
(7, 'kdkdk', 'kkkk@fg', '12364789365', '2857200012', 'favour technology', 'kskksks', NULL, 'incomplete', 'SS-9', 'Cohort-010/2021'),
(8, 'kdkdk', 'kkkk@fg', '12364789365', '2857200012', 'favour technology', 'kskksks', 'pass', 'completed', 'SS-7', 'Cohort-012/2021'),
(9, 'henry warui', 'henry@gmail.com', '02123654789', '2136548', 'Insect Technologies', 'COO', 'pass', 'completed', 'SS-3', 'Cohort-03/2021'),
(10, 'daisy simiyu', 'simiyu@gmail.com', '0745986321', '123654', 'tena solutions', 'cleaner', 'pass', 'completed', 'SS-3', 'Cohort-03/2021'),
(11, 'ffggga', 'FIGA@gmail.com', '7896541223', '2385496545', 'riga js', 'ppppfp', 'pass', 'completed', 'SS-4', 'Cohort-017/2021'),
(12, 'ffggga', 'FIGA@gmail.com', '7896541223', '2385496545', 'riga js', 'ppppfp', 'fail', 'completed', 'SS-4', 'Cohort-017/2021'),
(13, 'henry warui', 'warui.henry@gmail.com', '0713498554', '28582027', 'sharp technology', 'software engineer', NULL, 'incomplete', 'SS-5', 'Cohort-05/2021'),
(14, 'kdkdkk', 'kkkk@gmailcom', '0713498555', '2858200', 'kkkk', 'kkkk', 'fail', 'completed', 'SS-3', 'Cohort-03/2021'),
(15, 'llslll', 'james@gmail.com', '07145698796', '555555', 'lowan joy', 'manager', 'fail', 'completed', 'SS-3', 'Cohort-03/2021'),
(16, 'llslll', 'llll@gmail.com', '5555555555', '555555', 'kskksk', 'kkkk', 'fail', 'completed', 'SS-3', 'Cohort-03/2021'),
(17, 'ldll', 'lll@ll', '54545455555', '555555', '5555', '55555', 'fail', 'completed', 'SS-4', 'Cohort-017/2021'),
(18, 'ksksksk', 'kkkdk@kdkkd', '78965412366', '28582027', 'kskkksksksk', 'kksksks', 'fail', 'completed', 'SS-4', 'Cohort-017/2021'),
(19, 'JQJJWJ', 'JJJJ@jjjj', '788999999999', '999999', '9ppppp', 'pppp', 'fail', 'completed', 'SS-1', 'Cohort-020/2021'),
(20, 'ppppppppppp', 'pppp@pppppp', '04569875647', '78896544', '8llsllslLLLllllllllllllllllllll', '8899887', 'pass', 'completed', 'SS-1', 'Cohort-020/2021');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `perm_id` int(11) NOT NULL,
  `perm_mod` varchar(5) NOT NULL,
  `perm_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`perm_id`, `perm_mod`, `perm_desc`) VALUES
(1, 'INV', 'Access Inventory'),
(1, 'USR', 'Access users'),
(2, 'INV', 'Create Inventory'),
(2, 'USR', 'Create new users'),
(3, 'INV', 'Update Inventory'),
(3, 'USR', 'Update users'),
(4, 'INV', 'Delete Inventory'),
(4, 'USR', 'Delete users');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'Power User'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` int(11) NOT NULL,
  `perm_mod` varchar(5) NOT NULL,
  `perm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `perm_mod`, `perm_id`) VALUES
(1, 'USR', 1),
(1, 'USR', 2),
(1, 'USR', 3),
(1, 'USR', 4),
(2, 'INV', 1),
(2, 'INV', 2),
(2, 'INV', 3),
(2, 'INV', 4),
(2, 'PRD', 1),
(2, 'PRD', 2),
(2, 'PRD', 3),
(2, 'PRD', 4),
(2, 'USR', 1),
(2, 'USR', 2),
(2, 'USR', 3),
(2, 'USR', 4),
(3, 'INV', 1),
(3, 'PRD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role_id` tinyint(2) NOT NULL DEFAULT 1,
  `login_status` tinyint(2) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `role_id`, `login_status`, `date_created`) VALUES
(1, 'admin', 'system adminstrator ', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 1, '2021-03-09 10:31:58'),
(2, 'poweruser', 'superuser admin', '9f643ae7f7d8c52af499b9d334498bd584eaf9f0', 2, 1, '2021-03-09 12:10:07'),
(3, 'user', 'normal user', '12dea96fec20593566ab75692c9949596833adc9', 3, 1, '2021-03-17 23:28:04'),
(4, 'henry', 'henry warui', '3eca10f30041813f045165784e24b5a950a6cc7e', 1, 1, '2021-04-01 14:09:28'),
(5, 'llllllll', 'lllll', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-07 09:01:37'),
(6, 'kinyua', 'henry kinyua', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-07 09:05:57'),
(7, 'kinyua45', 'warui', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-07 09:47:32'),
(8, 'kinyua4596', 'warui', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-07 09:51:11'),
(9, 'jumak', 'jkkak', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-07 09:52:03'),
(10, 'kkfkf', 'kkkkk', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-10 18:59:03'),
(11, 'kkk', 'kkk', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-12 11:30:11'),
(12, 'tttttttttt', 'tttttttt', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 18:08:20'),
(13, 'lslsll', 'llll', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 18:18:20'),
(14, 'ppdpp', 'pppp', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 18:19:32'),
(15, 'jjjjjj', 'kkkk', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 18:24:36'),
(16, 'hhdhdhh', 'hdhdh', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 20:24:28'),
(17, 'pppsososooO', 'llldldl', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 20:25:07'),
(18, 'kfkkfkfkk', 'kkkkk', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 20:25:27'),
(19, 'kdkkk', 'kkkkkk', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 20:46:46'),
(20, 'lllsslsll', 'lllll', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 20:48:47'),
(21, 'llllll`', 'pppppppppppl', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 21:17:57'),
(22, 'dldll', 'llll', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 21:18:28'),
(23, 'kdkdkdk', 'kkkk', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 21:25:01'),
(24, 'kskkssk', 'kkkk', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 21:37:38'),
(25, 'kkkkkkk', 'kdkdkk', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 21:43:37'),
(26, 'fdfdfd', 'dfddf', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-15 02:30:36'),
(27, 'pppppp', 'ppppp', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-15 17:54:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_records`
--
ALTER TABLE `class_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cohorts`
--
ALTER TABLE `cohorts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courseName` (`courseName`),
  ADD UNIQUE KEY `courseId` (`courseId`);

--
-- Indexes for table `facilitators`
--
ALTER TABLE `facilitators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`,`passport`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`perm_id`,`perm_mod`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`role_id`,`perm_mod`,`perm_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_records`
--
ALTER TABLE `class_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cohorts`
--
ALTER TABLE `cohorts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `facilitators`
--
ALTER TABLE `facilitators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
