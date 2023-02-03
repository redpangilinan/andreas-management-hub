
CREATE TABLE `tb_accounts` (
  `account_id` int(10) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(65) NOT NULL,
  `creation_date` date NOT NULL,
  `account_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_accounts` VALUES(1, 'admin', 'P@$$w0rd', 'admin@gmail.com', '2022-12-18', 'Admin');
INSERT INTO `tb_accounts` VALUES(2, 'repulzor', 'password', 'repulzor@gmail.com', '2022-12-20', 'User');
INSERT INTO `tb_accounts` VALUES(3, 'JohnDoe', 'jandoe123', 'johndoe@gmail.com', '2022-12-20', 'User');
INSERT INTO `tb_accounts` VALUES(4, 'Janmak', 'makJan123', 'janmak@gmail.com', '2022-12-20', 'User');
INSERT INTO `tb_accounts` VALUES(5, 'testuser', 'testpass', 'testuser@gmail.com', '2022-12-20', 'User');
