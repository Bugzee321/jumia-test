-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` int NOT NULL,
  `regex` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `countries` (`id`, `name`, `code`, `regex`) VALUES
(1,	'Cameroon',	237,	'\\(237\\) ?[2368]\\d{7,8}$'),
(2,	'Ethiopia',	251,	'\\(251\\) ?[1-59]\\d{8}$'),
(3,	'Morocco',	212,	'\\(212\\) ?[5-9]\\d{8}$'),
(4,	'Mozambique',	258,	'\\(258\\) ?[28]\\d{7,8}$'),
(5,	'Uganda',	256,	'\\(256\\) ?\\d{9}$');

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `customer` (`id`, `name`, `phone`) VALUES
(1,	'Walid Hammadi',	'(212) 6007989253'),
(2,	'Yosaf Karrouch',	'(212) 698054317'),
(3,	'Younes Boutikyad',	'(212) 6546545369'),
(4,	'Houda Houda',	'(212) 6617344445'),
(5,	'Chouf Malo',	'(212) 691933626'),
(6,	'soufiane fritisse ',	'(212) 633963130'),
(7,	'Nada Sofie',	'(212) 654642448'),
(8,	'Edunildo Gomes Alberto ',	'(258) 847651504'),
(9,	'Walla\'s Singz Junior',	'(258) 846565883'),
(10,	'sevilton sylvestre',	'(258) 849181828'),
(11,	'Tanvi Sachdeva',	'(258) 84330678235'),
(12,	'Florencio Samuel',	'(258) 847602609'),
(13,	'Solo Dolo',	'(258) 042423566'),
(14,	'Pedro B 173',	'(258) 823747618'),
(15,	'Ezequiel Fenias',	'(258) 848826725'),
(16,	'JACKSON NELLY',	'(256) 775069443'),
(17,	'Kiwanuka Budallah',	'(256) 7503O6263'),
(18,	'VINEET SETH',	'(256) 704244430'),
(19,	'Jokkene Richard',	'(256) 7734127498'),
(20,	'Ogwal David',	'(256) 7771031454'),
(21,	'pt shop 0901 Ultimo ',	'(256) 3142345678'),
(22,	'Daniel Makori',	'(256) 714660221'),
(23,	'shop23 sales',	'(251) 9773199405'),
(24,	'Filimon Embaye',	'(251) 914701723'),
(25,	'ABRAHAM NEGASH',	'(251) 911203317'),
(26,	'ZEKARIAS KEBEDE',	'(251) 9119454961'),
(27,	'EPHREM KINFE',	'(251) 914148181'),
(28,	'Karim Niki',	'(251) 966002259'),
(29,	'Frehiwot Teka',	'(251) 988200000'),
(30,	'Fanetahune Abaia',	'(251) 924418461'),
(31,	'Yonatan Tekelay',	'(251) 911168450'),
(32,	'EMILE CHRISTIAN KOUKOU DIKANDA HONORE ',	'(237) 697151594'),
(33,	'MICHAEL MICHAEL',	'(237) 677046616'),
(34,	'ARREYMANYOR ROLAND TABOT',	'(237) 6A0311634'),
(35,	'LOUIS PARFAIT OMBES NTSO',	'(237) 673122155'),
(36,	'JOSEPH FELICIEN NOMO',	'(237) 695539786'),
(37,	'SUGAR STARRK BARRAGAN',	'(237) 6780009592'),
(38,	'WILLIAM KEMFANG',	'(237) 6622284920'),
(39,	'THOMAS WILFRIED LOMO LOMO',	'(237) 696443597'),
(40,	'Dominique mekontchou',	'(237) 691816558'),
(41,	'Nelson Nelson',	'(237) 699209115');

DROP VIEW IF EXISTS `customer_phones`;
CREATE TABLE `customer_phones` (`id` int, `name` varchar(50), `country_name` varchar(50), `country_code` varchar(50), `phone_number` varchar(50), `state` varchar(7));


DROP TABLE IF EXISTS `customer_phones`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `customer_phones` AS select `customer`.`id` AS `id`,`customer`.`name` AS `name`,`countries`.`name` AS `country_name`,substr(`customer`.`phone`,(locate('(',`customer`.`phone`) + 1),((locate(')',`customer`.`phone`) - locate('(',`customer`.`phone`)) - 1)) AS `country_code`,substr(`customer`.`phone`,(locate(')',`customer`.`phone`) + 2),(length(`customer`.`phone`) - 1)) AS `phone_number`,if(regexp_like(`customer`.`phone`,`countries`.`regex`),'Valid','Invalid') AS `state` from (`customer` join `countries` on((`countries`.`code` = substr(`customer`.`phone`,(locate('(',`customer`.`phone`) + 1),((locate(')',`customer`.`phone`) - locate('(',`customer`.`phone`)) - 1)))));

-- 2022-01-08 17:35:39
