-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2021 at 10:14 AM
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
(9, 'SS-1', 'Cohort-020/2021', '2021-04-20 00:26:38', NULL, NULL, NULL, '78896544'),
(10, 'SS-5', 'Cohort-05/2021', '2021-04-29 16:09:34', NULL, NULL, NULL, '28582027'),
(11, 'SS-3', 'Cohort-024/2021', '2021-05-04 09:40:04', NULL, NULL, NULL, '789654123'),
(12, 'SS-13', 'Cohort-025/2021', '2021-05-04 21:32:39', NULL, NULL, NULL, '2456987'),
(13, 'SS-1', 'Cohort-013/2021', '2021-05-04 21:47:52', NULL, NULL, NULL, '789654123'),
(14, 'SS-4', 'Cohort-017/2021', '2021-05-05 10:11:49', NULL, NULL, NULL, '28582027'),
(15, 'SS-7', 'Cohort-012/2021', '2021-05-05 11:04:00', NULL, NULL, NULL, '789654123');

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
(3, 'SS-3', 'Cohort-03/2021', '04:52', 'Online', 'cancelled'),
(5, 'SS-5', 'Cohort-05/2021', '14:02', 'Online', 'done'),
(6, 'SS-2', 'Cohort-06/2021', '11:31', 'online', 'scheduled'),
(7, 'SS-3', 'Cohort-07/2021', '11:33', 'Online ', 'cancelled'),
(10, 'SS-9', 'Cohort-010/2021', '16:14', 'Online', 'inProgress'),
(11, 'SS-6', 'Cohort-011/2021', '12:08', 'Online', 'done'),
(12, 'SS-7', 'Cohort-012/2021', '00:13', 'Online', 'scheduled'),
(15, 'SS-1', 'Cohort-013/2021', '15:00', 'online', 'cancelled'),
(16, 'SS-10', 'Cohort-016/2021', '16:30', 'conference ', 'scheduled'),
(17, 'SS-4', 'Cohort-017/2021', '02:28', '8998898', 'inProgress'),
(18, 'SS-9', 'Cohort-018/2021', '21:00', 'Virtual Conference', 'inProgress'),
(19, 'SS-4', 'Cohort-019/2021', '16:55', 'Online', 'inProgress'),
(22, 'SS-1', 'Cohort-020/2021', '00:22', 'LLLLLL', 'cancelled'),
(23, 'SS-13', 'Cohort-023/2021', '07:07', 'Online', 'done'),
(24, 'SS-3', 'Cohort-024/2021', '07:07', 'D-hall', 'cancelled'),
(25, 'SS-13', 'Cohort-025/2021', '19:08', 'oooooojujjoo', 'done');

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
(13, 'Life Skills', 'SS-13', '4', '3', '0', 'Martin Waweru');

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
  `designation` varchar(200) DEFAULT NULL,
  `passport` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `city` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `bio` varchar(500) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facilitators`
--

INSERT INTO `facilitators` (`id`, `fullname`, `username`, `email`, `company`, `designation`, `passport`, `phone`, `city`, `address`, `state`, `bio`, `avatar`) VALUES
(26, 'dfddf', 'fdfdfd', 'dfdfdf@gmail', 'kiwi johnson', NULL, '28546982', '7896541223', NULL, NULL, NULL, NULL, NULL),
(28, 'mama mamito', 'mama', 'mma@gmail.com', 'mamam sita ltd', 'Software develeper', '28582027', '0713498554', NULL, NULL, NULL, NULL, NULL),
(29, 'normal user', 'user', 'user@gmail.com', 'sharp technology', 'software engineer', '28582027', '0713498554', 'Donholm', '10306', 'Donholm', 'lslls', 'lslslsl'),
(30, 'peter wambua', 'Peter', 'peter@gmail.com', 'honeywell', 'Hr Admin', '456987523', '0789563214', 'Utawala', '1236', 'Kenya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `company` varchar(200) NOT NULL,
  `designation` varchar(200) DEFAULT NULL,
  `passport` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `city` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `bio` varchar(200) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `fullname`, `username`, `email`, `company`, `designation`, `passport`, `phone`, `city`, `address`, `state`, `bio`, `avatar`) VALUES
(1, 'Administrator', 'admin', 'admin@gmail.com', 'tms', 'IT Instructor', '28582027', '0713498554', 'Donholm', 'vumilia', 'Donholm', '', NULL);

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
(3, 'john doe', 'warui@gmail.com', '2858202778', '285202', 'llll', 'llll', 'fail', 'completed', '78', 'Cohort-05/2021'),
(4, 'henry warui', 'henry@gmail.com', '0745698745', '28596378', 'sharp technology', 'software  ', 'pass', 'completed', 'SS-3', 'Cohort-03/2021'),
(5, 'Kamenya', 'Kamenya@gmail.com', '0745698745', '845698712', 'point housing ', 'engineer', 'pass', 'completed', 'SS-5', 'Cohort-05/2021'),
(6, 'venessa Dee', 'dee@gmail.com', '0714896542', '28528024', 'penipila', 'accountant', 'fail', 'completed', 'SS-1', 'Cohort-013/2021'),
(7, 'kdkdk', 'kkkk@fg', '12364789365', '2857200012', 'favour technology', 'kskksks', NULL, 'incomplete', 'SS-9', 'Cohort-010/2021'),
(8, 'kdkdk', 'kkkk@fg', '12364789365', '2857200012', 'favour technology', 'kskksks', 'pass', 'completed', 'SS-7', 'Cohort-012/2021'),
(9, 'henry warui', 'henry@gmail.com', '02123654789', '2136548', 'Insect Technologies', 'COO', 'pass', 'completed', 'SS-3', 'Cohort-03/2021'),
(10, 'daisy simiyu', 'simiyu@gmail.com', '0745986321', '123654', 'tena solutions', 'cleaner', 'pass', 'completed', 'SS-3', 'Cohort-03/2021'),
(11, 'ffggga', 'FIGA@gmail.com', '7896541223', '2385496545', 'riga js', 'ppppfp', 'pass', 'completed', 'SS-4', 'Cohort-017/2021'),
(12, 'ffggga', 'FIGA@gmail.com', '7896541223', '2385496545', 'riga js', 'ppppfp', 'fail', 'completed', 'SS-4', 'Cohort-017/2021'),
(13, 'henry warui', 'warui.henry@gmail.com', '0713498554', '28582027', 'sharp technology', 'software engineer', 'pass', 'completed', 'SS-5', 'Cohort-05/2021'),
(14, 'kdkdkk', 'kkkk@gmailcom', '0713498555', '2858200', 'kkkk', 'kkkk', 'fail', 'completed', 'SS-3', 'Cohort-03/2021'),
(15, 'llslll', 'james@gmail.com', '07145698796', '555555', 'lowan joy', 'manager', 'fail', 'completed', 'SS-3', 'Cohort-03/2021'),
(16, 'llslll', 'llll@gmail.com', '5555555555', '555555', 'kskksk', 'kkkk', 'fail', 'completed', 'SS-3', 'Cohort-03/2021'),
(17, 'ldll', 'lll@ll', '54545455555', '555555', '5555', '55555', 'fail', 'completed', 'SS-4', 'Cohort-017/2021'),
(18, 'ksksksk', 'kkkdk@kdkkd', '78965412366', '28582027', 'kskkksksksk', 'kksksks', 'fail', 'completed', 'SS-4', 'Cohort-017/2021'),
(19, 'JQJJWJ', 'JJJJ@jjjj', '788999999999', '999999', '9ppppp', 'pppp', 'fail', 'completed', 'SS-1', 'Cohort-020/2021'),
(20, 'ppppppppppp', 'pppp@pppppp', '04569875647', '78896544', '8llsllslLLLllllllllllllllllllll', '8899887', 'pass', 'completed', 'SS-1', 'Cohort-020/2021'),
(21, 'llll', 'kkkk@mail.com', '0748569845', '28582027', 'kenya airports authority', 'software engineer', 'fail', 'completed', 'SS-5', 'Cohort-05/2021'),
(22, 'james wakama ', 'wakama@gmail.com', '07896542189', '789654123', 'sharp technology', 'cleaner', 'pass', 'completed', 'SS-3', 'Cohort-024/2021'),
(23, 'iiiiiiiiiiiiii', 'oooooo@gmmmil', '07134985455', '2456987', 'ooooo', 'oooo', NULL, 'completed', 'SS-13', 'Cohort-025/2021'),
(24, 'ppppp', 'oooooo@gmmmil', '0745698745', '789654123', 'ooooo', 'ppppfp', NULL, 'incomplete', 'SS-1', 'Cohort-013/2021'),
(25, 'kimotho', 'warui.henry@gmail.com', '0745698745', '28582027', 'sharp technology', 'llllll', 'pass', 'completed', 'SS-4', 'Cohort-017/2021'),
(26, 'mercy wambui', 'wambui@gmail.com', '0789654123', '789654123', 'honeywell', 'cashier', NULL, 'incomplete', 'SS-7', 'Cohort-012/2021');

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
(2, 'poweruser', 'superuser admin', '9f643ae7f7d8c52af499b9d334498bd584eaf9f0', 2, 1, '2021-03-09 12:10:07'),
(3, 'user', 'normal user', '12dea96fec20593566ab75692c9949596833adc9', 2, 1, '2021-03-17 23:28:04'),
(4, 'henry', 'henry warui', 'd318f44739dced66793b1a603028133a76ae680e', 1, 1, '2021-04-01 14:09:28'),
(5, 'admin', 'Administrator', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 1, '2021-04-07 09:01:37'),
(6, 'kinyua', 'henry kinyua', '3725e117dc7b4ecbedea71c00c217a15f9734a1a', 2, 1, '2021-04-07 09:05:57'),
(8, 'kinyua4596', 'warui', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-07 09:51:11'),
(10, 'warui', 'kkkkk', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-10 18:59:03'),
(12, 'tttttttttt', 'tttttttt', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 18:08:20'),
(13, 'lslsll', 'llll', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-14 18:18:20'),
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
(27, 'pppppp', 'ppppp', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-15 17:54:57'),
(28, 'mama', 'mama mamito', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-04-23 00:23:13'),
(29, 'Peter', 'peter wambua', 'd318f44739dced66793b1a603028133a76ae680e', 2, 1, '2021-05-05 11:00:50');

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
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`,`passport`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cohorts`
--
ALTER TABLE `cohorts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `facilitators`
--
ALTER TABLE `facilitators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
