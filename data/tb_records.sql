
CREATE TABLE `tb_records` (
  `record_id` int(10) NOT NULL,
  `record` varchar(60) NOT NULL,
  `details` varchar(255) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_records` VALUES(4, 'Sample Record', 'This is a sample record named \'Sample\'.', '2022-12-20');
INSERT INTO `tb_records` VALUES(5, 'Historical Record', 'This is a sample record named \'Historical\'.', '2022-12-20');
INSERT INTO `tb_records` VALUES(6, 'Financial Record', 'This is a sample record named \'Financial\'.', '2022-12-20');
INSERT INTO `tb_records` VALUES(7, 'Research Record', 'This is a sample record named \'Research\'.', '2022-12-20');
INSERT INTO `tb_records` VALUES(8, 'Electronic Record', 'This is a sample record named \'Electronic\'.', '2022-12-20');
INSERT INTO `tb_records` VALUES(13, 'Academic Record', 'This is a sample record named \'Academic\'.', '2022-12-20');
