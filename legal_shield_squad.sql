-- -- create table admin

-- CREATE TABLE `admin` (
--   `SRN` int(11) NOT NULL AUTO_INCREMENT,
--   `name` varchar(256) NOT NULL,
--   `adminid` varchar(256) NOT NULL,
--   `password` varchar(256) NOT NULL,
--   PRIMARY KEY (`SRN`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- insert data into admin

-- INSERT INTO `admin` (`SRN`, `name`, `adminid`, `password`) VALUES (NULL, 'Yashpal Puri', 'yash@ss', '$2y$10$jARdZ1RpL2XhX8dobRkcIu4CO21iHAtSZWJVbSpYB2eCVwT7ZknJG');
-- INSERT INTO `admin` (`SRN`, `name`, `adminid`, `password`) VALUES (NULL, 'Vikram', 'vikram@ss', '$2y$10$xvyOpRU5R16P0phoN6fcJ.yF/A1q2kmQAZlguJtODSvbSNi1RfEOe');

-- -- create table complaint

-- CREATE TABLE `complaint` (
--   `c_id` int(11) NOT NULL AUTO_INCREMENT,
--   `uid` varchar(256) NOT NULL,
--   `name` varchar(256) NOT NULL,
--   `a_no` bigint(12) NOT NULL,
--   `location` varchar(50) NOT NULL,
--   `type_crime` varchar(50) NOT NULL,
--   `d_o_c` date NOT NULL,
--   `description` varchar(7000) NOT NULL,
--   `status` varchar(256) NOT NULL DEFAULT 'PENDING',
--   PRIMARY KEY (`c_id`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- -- create table user

-- CREATE TABLE `user` (
--   `u_name` varchar(50) NOT NULL,
--   `u_id` varchar(50) NOT NULL,
--   `u_pass` varchar(100) NOT NULL,
--   `u_addr` varchar(100) NOT NULL,
--   `a_no` bigint(12) NOT NULL,
--   `gen` varchar(15) NOT NULL,
--   `mob` bigint(10) NOT NULL,
--   PRIMARY KEY (`a_no`),
--   UNIQUE KEY `u_id` (`u_id`),
--   UNIQUE KEY `mob` (`mob`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



CREATE TABLE `admin` (
  `SRN` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `adminid` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `admin` (`SRN`, `name`, `adminid`, `password`) VALUES
(1, 'Yashpal Puri', 'yash@ss', '$2y$10$jARdZ1RpL2XhX8dobRkcIu4CO21iHAtSZWJVbSpYB2eCVwT7ZknJG'),
(2, 'Vikram', 'vikram@ss', '$2y$10$xvyOpRU5R16P0phoN6fcJ.yF/A1q2kmQAZlguJtODSvbSNi1RfEOe');



CREATE TABLE `complaint` (
  `c_id` int(11) NOT NULL,
  `uid` varchar(256) NOT NULL,
  `u_adhar` bigint(12) NOT NULL,
  `u_name` varchar(256) NOT NULL,
  `cpl_name` varchar(256) NOT NULL,
  `cpl_number` bigint(10) NOT NULL,
  `time_stamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `location_state` varchar(50) NOT NULL,
  `location_district` varchar(50) NOT NULL,
  `type_crime` varchar(50) NOT NULL,
  `d_o_c` date NOT NULL,
  `description` varchar(50000) NOT NULL,
  `status` varchar(256) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



CREATE TABLE `fir` (
  `fid` int(10) NOT NULL,
  `uid` varchar(256) NOT NULL,
  `cid` int(10) NOT NULL,
  `fir_data` mediumtext NOT NULL DEFAULT 'PENDING',
  `ipc_sections` varchar(1000) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `user` (
  `u_name` varchar(50) NOT NULL,
  `u_id` varchar(50) NOT NULL,
  `u_pass` varchar(100) NOT NULL,
  `u_addr` varchar(100) NOT NULL,
  `a_no` bigint(12) NOT NULL,
  `gen` varchar(15) NOT NULL,
  `mob` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



INSERT INTO `user` (`u_name`, `u_id`, `u_pass`, `u_addr`, `a_no`, `gen`, `mob`) VALUES
('Ram', 'ram@gmail.com', '$2y$10$ToBU/AowEUUpdPoX9mF1/.t1cc8IW73SzVZMR82rbNr3HzE770X76', 'Faridkot', 121212121212, 'Male', 9876767546);


ALTER TABLE `admin`
  ADD PRIMARY KEY (`SRN`);


ALTER TABLE `complaint`
  ADD PRIMARY KEY (`c_id`);

ALTER TABLE `fir`
  ADD PRIMARY KEY (`fid`);


ALTER TABLE `user`
  ADD PRIMARY KEY (`a_no`),
  ADD UNIQUE KEY `u_id` (`u_id`),
  ADD UNIQUE KEY `mob` (`mob`);


ALTER TABLE `admin`
  MODIFY `SRN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;


ALTER TABLE `complaint`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;



ALTER TABLE `fir`
  MODIFY `fid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;
COMMIT;


