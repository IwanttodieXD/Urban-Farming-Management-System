-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 04:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qcu-cuai`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `AttendanceID` int(11) NOT NULL,
  `EmployeeID` varchar(20) NOT NULL,
  `AttendanceDate` date NOT NULL,
  `TimeIn` time NOT NULL,
  `TimeOut` time NOT NULL,
  `Status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`AttendanceID`, `EmployeeID`, `AttendanceDate`, `TimeIn`, `TimeOut`, `Status`) VALUES
(26, '03', '2024-12-13', '13:18:38', '16:00:27', 'Out'),
(27, '03', '2024-12-13', '13:18:42', '16:00:27', 'Out'),
(28, '03', '2024-12-13', '13:32:56', '16:00:27', 'Out'),
(29, '02', '2024-12-13', '14:35:33', '16:10:00', 'Out'),
(30, '03', '2024-12-13', '14:50:18', '16:00:27', 'Out'),
(31, '03', '2024-12-13', '16:00:21', '16:00:27', 'Out'),
(32, '02', '2024-12-13', '16:08:21', '16:10:00', 'Out'),
(33, '02', '2024-12-13', '16:09:56', '16:10:00', 'Out');

-- --------------------------------------------------------

--
-- Table structure for table `employee_tb`
--

CREATE TABLE `employee_tb` (
  `EmployeeID` varchar(20) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Mname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Bdate` date NOT NULL,
  `Sex` varchar(15) NOT NULL,
  `Contact` varchar(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Address` text NOT NULL,
  `HireDate` date NOT NULL,
  `Position` varchar(50) NOT NULL,
  `UserType` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Image` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_tb`
--

INSERT INTO `employee_tb` (`EmployeeID`, `Fname`, `Mname`, `Lname`, `Bdate`, `Sex`, `Contact`, `Email`, `Address`, `HireDate`, `Position`, `UserType`, `Password`, `Image`) VALUES
('02', 'asd', 'sad', 'asd', '2024-12-05', 'female', '879897', 'a@a', 'asdsad', '2024-12-05', 'deds', 'Employee', '1', ''),
('03', 'sad', 'sad', 'sad', '2024-12-05', 'male', '213', 'b@b', 'asd', '2024-12-05', 'asd', 'admin', '123', ''),
('04', 'sad', 'asd', 'sad', '2024-12-14', 'male', '213', '1@1', '123', '2024-12-13', 'sad', 'employee', '1', 'emp_img/57467888_10156952117778930_240528910718704'),
('06', 'asd', 'asd', 'sad', '2024-12-13', 'male', '01234567894', '1@3', '123', '2024-12-13', '123', 'employee', '1', 'emp_img/57467888_10156952117778930_2405289107187040256_n.jpg'),
('23-2024', 'vince', 'gonzales', 'vargas', '2333-03-12', 'male', '123', 'vincevargas90@gmail.com', '123', '2333-12-23', 'HR', 'admin', 'qwerty', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `AttendanceLink` varchar(100) NOT NULL,
  `FeedbackLink` varchar(100) NOT NULL,
  `Image` varchar(100) NOT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `Title`, `Description`, `Date`, `Time`, `AttendanceLink`, `FeedbackLink`, `Image`, `Location`) VALUES
(1, 'Car', 'Cool Car', '0012-03-12', '12:03:00', 'https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg', 'https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg', 'https://gratisography.com/wp-content/uploads/2024/10/gratisography-cool-cat-800x525.jpg', 'At my car'),
(3, 'Idk', 'Idk', '2024-12-13', '18:19:00', 'https://i.ytimg.com/vi/XI2fvvuzH2o/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJ', 'https://i.ytimg.com/vi/XI2fvvuzH2o/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJ', 'https://i.ytimg.com/vi/XI2fvvuzH2o/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJ', 'Sa puso mo');

-- --------------------------------------------------------

--
-- Table structure for table `harvestingrecords`
--

CREATE TABLE `harvestingrecords` (
  `PlantName` varchar(100) NOT NULL,
  `PlantType` varchar(10) NOT NULL,
  `PBatchNum` int(10) NOT NULL,
  `HBatchNum` int(11) NOT NULL,
  `DateOfHarvest` date NOT NULL,
  `NoPlantsHarvested` int(10) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Remarks` text NOT NULL,
  `EmployeeID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harvestingrecords`
--

INSERT INTO `harvestingrecords` (`PlantName`, `PlantType`, `PBatchNum`, `HBatchNum`, `DateOfHarvest`, `NoPlantsHarvested`, `Quantity`, `Remarks`, `EmployeeID`) VALUES
('', '', 0, 1, '2025-01-04', 123, 123, 'asdsadasd', '2'),
('', '', 0, 2, '2025-01-10', 1233, 5555, 'sad', '2'),
('', '', 0, 3, '2025-01-10', 123, 123, 'sadsaddsa', '2'),
('Ampalaya', '', 1, 4, '2025-01-11', 123, 213, 'asdsadsadsa', '2'),
('Ampalaya', '', 25, 5, '2024-12-22', 50, 100, 'sadsad', '2'),
('Ampalaya', '', 25, 6, '2025-01-04', 213, 213, 'sadsad', '2'),
('Ampalaya', 'Fruit', 28, 7, '2024-12-13', 6, 50, 'GREW BEEEEG', '4'),
('Cassava', 'Root Crops', 31, 8, '2024-12-27', 12, 20, 'Very Nice', '4'),
('Chocolate basil', 'Herbs', 32, 9, '2024-12-13', 12, 1132, '5', '3'),
('Ampalaya', 'Fruit', 33, 10, '2024-12-27', 6, 20, 'VERY BEEG', '2'),
('Ampalaya', 'Fruit', 34, 11, '2024-12-27', 6, 10000, 'VERY BEEEG', '2'),
('Cassava', 'Root Crops', 35, 12, '2024-12-27', 6, 688989, 'yaw ko na', '2'),
('Chocolate basil', 'Herbs', 36, 13, '2024-12-27', 6, 123123213, 'AAAAAAAAAAAAAAAAAAAAAAA', '2'),
('Ampalaya', 'Fruit', 37, 14, '2024-12-27', 6, 12213123, 'VERY BEEEG', '2'),
('Kamote', 'Root Crops', 38, 15, '2024-12-27', 6, 1232131231, 'AAAAAAAAAAAAAAA', '2'),
('Chocolate basil', 'Herbs', 39, 16, '2024-12-27', 12, 2147483647, 'sadsaasdsadsadsad', '2'),
('Ampalaya', 'Fruit', 40, 17, '2024-12-20', 12, 12321123, 'sadasdsad', '2'),
('Cassava', 'Root Crops', 41, 18, '2024-12-27', 12, 12, 'sad', '2'),
('Sad', 'Herbs', 42, 19, '2024-12-27', 12, 12, 'sadsadsad', '2');

-- --------------------------------------------------------

--
-- Table structure for table `leaveapplication`
--

CREATE TABLE `leaveapplication` (
  `LeaveID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `TypeofLeave` varchar(50) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `TotalDays` int(5) NOT NULL,
  `DateFiled` date NOT NULL,
  `Reason` text NOT NULL,
  `Status` varchar(20) NOT NULL,
  `EmployeeID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaveapplication`
--

INSERT INTO `leaveapplication` (`LeaveID`, `Name`, `TypeofLeave`, `StartDate`, `EndDate`, `TotalDays`, `DateFiled`, `Reason`, `Status`, `EmployeeID`) VALUES
(14, 'C', 'sad', '2024-12-13', '2024-12-20', 8, '2024-12-13', 'ded', 'Rejected', '03'),
(15, 'C', 'Sick', '2024-12-20', '2024-12-27', 8, '2024-12-13', 'imded', 'Rejected', '03'),
(16, 'Jamarykus', 'Sick', '2024-12-13', '2024-12-20', 8, '2024-12-13', 'IM DYING', 'Rejected', '03'),
(17, 'Jamarykus', 'sadiji', '2024-12-20', '2024-12-27', 8, '2024-12-13', 'fgdgfdgfd', 'Approved', '03'),
(18, 'Jamarykus', 'Sick', '2024-12-13', '2024-12-20', 8, '2024-12-13', 'ded', 'Rejected', '02'),
(19, 'Markus DUrant da first', 'Sick', '2024-12-20', '2024-12-27', 8, '2024-12-13', 'Me go ded', 'Waiting For Approval', '02'),
(20, 'Markus Durant DA SECOND', 'Sick', '2024-12-20', '2024-12-27', 8, '2024-12-13', 'ME DYING', 'Waiting For Approval', '02'),
(21, 'Jamarykus', 'sad', '2024-12-13', '2024-12-20', 8, '2024-12-13', 'asd', 'Waiting For Approval', '03'),
(22, 'Jamarykus', 'sad', '2024-12-13', '2024-12-20', 8, '2024-12-13', 'sad', 'Waiting For Approval', '02'),
(23, 'Jamarykus', 'Sick', '2024-12-20', '2024-12-27', 8, '2024-12-13', 'and dying', 'Approved', '02'),
(24, 'Jamarykus', 'Sick', '2024-12-20', '2024-12-27', 8, '2024-12-13', 'pls end me', 'Rejected', '02');

-- --------------------------------------------------------

--
-- Table structure for table `plantingrecords`
--

CREATE TABLE `plantingrecords` (
  `PlantType` varchar(20) NOT NULL,
  `PlantName` varchar(100) NOT NULL,
  `BatchNum` int(11) NOT NULL,
  `NoSeedsPlanted` int(5) NOT NULL,
  `PlantingDate` date NOT NULL,
  `PlantingNote` text NOT NULL,
  `NoSeedsTransplanted` int(5) NOT NULL,
  `DateTransplanted` date NOT NULL,
  `TransplantingNote` text NOT NULL,
  `PotMixUsed` varchar(50) NOT NULL,
  `EmployeeID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plantingrecords`
--

INSERT INTO `plantingrecords` (`PlantType`, `PlantName`, `BatchNum`, `NoSeedsPlanted`, `PlantingDate`, `PlantingNote`, `NoSeedsTransplanted`, `DateTransplanted`, `TransplantingNote`, `PotMixUsed`, `EmployeeID`) VALUES
('Fruit', 'chocolate basil', 22, 132, '2024-12-06', 'dsa', 0, '0000-00-00', '', '', '02'),
('Fruit', 'dill', 23, 123, '2025-01-10', 'dsa', 0, '0000-00-00', '', '', '02'),
('Fruit', 'ampalaya', 24, 21, '2025-01-10', 'sad', 123, '2025-01-10', 'sadsadsad', 'Manure', '02'),
('Fruit', 'ampalaya', 25, 213, '2024-12-08', 'asd', 50, '2024-12-15', 'sadsad', 'Vermicast', '02'),
('', 'cassava', 26, 100, '2024-12-09', 'sadasd', 0, '0000-00-00', '', '', '02'),
('', 'sad', 27, 123, '2024-12-15', 'sad', 213, '2025-01-05', 'sad', 'Vermicast', '02'),
('Fruit', 'ampalaya', 28, 12, '2024-12-13', 'Grow Beeg', 6, '2024-12-13', 'GROEWING BEGE', 'Coco Peat', '04'),
('Fruit', 'ampalaya', 29, 12, '2024-12-13', '1', 0, '0000-00-00', '', '', '04'),
('Fruit', 'ampalaya', 30, 12, '2024-12-13', 'sad', 0, '0000-00-00', '', '', '04'),
('Root Crops', 'cassava', 31, 12, '2024-12-14', '12', 6, '2024-12-20', 'sad', 'Top Soil', '04'),
('Herbs', 'chocolate basil', 32, 12, '2024-12-13', '132', 6, '2024-12-13', 'sad', 'Top Soil', '03'),
('Fruit', 'ampalaya', 33, 12, '2024-12-13', 'Gonna g o beg', 6, '2024-12-20', 'Gud shi', 'Rice Hull', '02'),
('Fruit', 'ampalaya', 34, 12, '2024-12-13', 'BEG', 6, '2024-12-20', 'BEEG', 'Top Soil', '02'),
('Root Crops', 'cassava', 35, 12, '2024-12-13', 'sad', 6, '2024-12-20', 'sad', 'Top Soil', '02'),
('Herbs', 'chocolate basil', 36, 12, '2024-12-13', 'sad', 6, '2024-12-20', 'sad', 'Top Soil', '02'),
('Fruit', 'ampalaya', 37, 12, '2024-12-13', 'beg', 6, '2024-12-20', 'GROW BEEG', 'Rice Hull', '02'),
('Root Crops', 'kamote', 38, 12, '2024-12-13', 'ayokjo', 6, '2024-12-20', 'pls', 'Manure', '02'),
('Herbs', 'chocolate basil', 39, 12, '2024-12-13', '21', 12, '2024-12-20', 'waewaewae', 'Coco Coir', '02'),
('Fruit', 'ampalaya', 40, 23, '2024-12-13', 'beg', 12, '2024-12-20', 'sad', 'Top Soil', '02'),
('Root Crops', 'cassava', 41, 12, '2024-12-13', 'sadsad', 12, '2024-12-20', 'sadsad', 'Rice Hull', '02'),
('Herbs', 'sad', 42, 12, '2024-12-13', '123213', 12, '2024-12-20', 'sadsad', 'Carbonized Rice Hull', '02');

-- --------------------------------------------------------

--
-- Table structure for table `potmix`
--

CREATE TABLE `potmix` (
  `MixID` int(11) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `Stock` int(10) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `potmix`
--

INSERT INTO `potmix` (`MixID`, `ItemName`, `Stock`, `Status`) VALUES
(1, 'Top Soil', 2, ''),
(6, 'Manure', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `potmixusage`
--

CREATE TABLE `potmixusage` (
  `UsageID` int(11) NOT NULL,
  `ItemName` varchar(20) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `UsageDate` date NOT NULL,
  `EmployeeID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `potmixusage`
--

INSERT INTO `potmixusage` (`UsageID`, `ItemName`, `Quantity`, `UsageDate`, `EmployeeID`) VALUES
(1, 'Top Soil', 2, '2024-12-13', '3'),
(2, 'Top Soil', 4, '2024-12-13', '3'),
(3, 'Top Soil', 5, '2024-12-13', '2'),
(4, 'Top Soil', 4, '2024-12-13', '2'),
(5, 'Top Soil', 2, '2024-12-13', '2'),
(6, 'Manure', 2, '2024-12-13', '2'),
(7, 'Manure', 2, '2024-12-13', '2'),
(8, 'Top Soil', 3, '2024-12-13', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `ToolID` int(11) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `Count` int(10) NOT NULL,
  `PurchaseAmount` decimal(8,2) NOT NULL,
  `Remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`ToolID`, `ItemName`, `Count`, `PurchaseAmount`, `Remarks`) VALUES
(1, 'Shovel', 10, 100.00, 'Good AF'),
(3, 'Rack', 5, 100.00, 'GYAT BADDIE'),
(4, 'Hoe', 10, 69420.00, 'DAYUM');

-- --------------------------------------------------------

--
-- Table structure for table `toolsusage`
--

CREATE TABLE `toolsusage` (
  `UsageID` int(11) NOT NULL,
  `EmployeeID` varchar(20) NOT NULL,
  `Student_Id` varchar(7) NOT NULL,
  `Baffil` varchar(50) NOT NULL,
  `ToolName` varchar(50) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Bname` varchar(50) NOT NULL,
  `Bcontact` int(12) NOT NULL,
  `UsageDate` date NOT NULL,
  `Bstatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `toolsusage`
--

INSERT INTO `toolsusage` (`UsageID`, `EmployeeID`, `Student_Id`, `Baffil`, `ToolName`, `Quantity`, `Bname`, `Bcontact`, `UsageDate`, `Bstatus`) VALUES
(3, '123', '', 'staff', 'Shovel', 5, 'sadsad', 123, '2024-12-12', 'Returned'),
(4, '124', '', 'staff', 'Shovel', 5, 'sad', 123, '2024-12-12', 'Returned'),
(5, '', '23-2444', 'staff', 'Shovel', 5, 'sadsad', 132, '2024-12-12', 'Returned'),
(6, 'sad', '', 'staff', 'Shovel', 5, 'sadsad', 132, '2024-12-12', 'Returned'),
(7, '132', '', 'staff', 'Top Soil', 5, '9', 321321, '2024-12-12', 'Returned'),
(8, '02', '', 'staff', 'Shovel', 3, 'sadsad', 123, '2024-12-13', 'Returned'),
(9, '04', '', 'staff', 'Shovel', 0, 'sadsad', 123, '2024-12-13', 'Returned'),
(10, '04', '', 'staff', 'Shovel', 2, 'sadsad', 123, '2024-12-13', 'Returned'),
(11, 'sad', '', 'staff', 'Shovel', 5, 'sadsad', 213, '2024-12-13', 'Returned'),
(12, '', '23-2333', 'student', 'Hoe', 5, 'jamarcus', 213, '2024-12-13', 'Returned'),
(13, '', '23-2005', 'student', 'Hoe', 5, 'jamarcus', 1234567894, '2024-12-13', 'Returned'),
(14, '', '23-2333', 'student', 'Hoe', 5, 'jamarcus', 321321, '2024-12-13', 'Returned'),
(15, 'sad', '', 'staff', 'Hoe', 4, 'sadsad', 1234567894, '2024-12-13', 'Returned'),
(16, 'sad', '', 'staff', 'Rack', 2, 'jamarcus', 1234567894, '2024-12-13', 'Returned'),
(17, '123', '', 'staff', 'Hoe', 2, 'sadsad', 123, '2024-12-13', 'Returned'),
(18, 'sad', '', 'staff', 'Rack', 2, 'sadsad', 213, '2024-12-13', 'Returned'),
(19, '', '23-2333', 'student', 'Rack', 2, 'jamarcus', 1234567894, '2024-12-13', 'Returned'),
(20, '', '23-2333', 'student', 'Hoe', 2, 'jamarcus', 1234567894, '2024-12-13', 'Returned'),
(21, '', '23-2333', 'student', 'Shovel', 2, 'jamarcus', 1234567894, '2024-12-13', 'Returned'),
(22, '02', '', 'staff', 'Rack', 2, 'Markus', 1234567894, '2024-12-13', 'Returned'),
(23, '04', '', 'staff', 'Shovel', 2, 'sadsad', 1234567894, '2024-12-13', 'Returned'),
(24, '02', '', 'staff', 'Shovel', 2, 'jamarcus', 1234567894, '2024-12-13', 'Returned'),
(25, '02', '', 'staff', 'Rack', 2, 'jamarcus', 1234567894, '2024-12-13', 'Returned');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`AttendanceID`,`EmployeeID`);

--
-- Indexes for table `employee_tb`
--
ALTER TABLE `employee_tb`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `harvestingrecords`
--
ALTER TABLE `harvestingrecords`
  ADD PRIMARY KEY (`HBatchNum`,`EmployeeID`);

--
-- Indexes for table `leaveapplication`
--
ALTER TABLE `leaveapplication`
  ADD PRIMARY KEY (`LeaveID`,`EmployeeID`);

--
-- Indexes for table `plantingrecords`
--
ALTER TABLE `plantingrecords`
  ADD PRIMARY KEY (`BatchNum`,`EmployeeID`);

--
-- Indexes for table `potmix`
--
ALTER TABLE `potmix`
  ADD PRIMARY KEY (`MixID`);

--
-- Indexes for table `potmixusage`
--
ALTER TABLE `potmixusage`
  ADD PRIMARY KEY (`UsageID`,`EmployeeID`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`ToolID`);

--
-- Indexes for table `toolsusage`
--
ALTER TABLE `toolsusage`
  ADD PRIMARY KEY (`UsageID`,`EmployeeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `harvestingrecords`
--
ALTER TABLE `harvestingrecords`
  MODIFY `HBatchNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `leaveapplication`
--
ALTER TABLE `leaveapplication`
  MODIFY `LeaveID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `plantingrecords`
--
ALTER TABLE `plantingrecords`
  MODIFY `BatchNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `potmix`
--
ALTER TABLE `potmix`
  MODIFY `MixID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `potmixusage`
--
ALTER TABLE `potmixusage`
  MODIFY `UsageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `ToolID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `toolsusage`
--
ALTER TABLE `toolsusage`
  MODIFY `UsageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
