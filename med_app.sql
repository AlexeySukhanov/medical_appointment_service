CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `visit_date` date NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `symptoms` text,
  `application_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;