CREATE TABLE IF NOT EXISTS `bg` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=9 ;

INSERT INTO `bg` (`id`, `name`) VALUES
(1, 'red'),
(2, 'green'),
(3, 'lightgreen'),
(4, 'blue'),
(5, 'lightblue'),
(6, '#ddddff'),
(7, '#ddffdd'),
(8, 'white');

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=6 ;

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Кафедра биологии'),
(2, 'Деканат'),
(3, 'Ректорат'),
(4, 'Кафедра истории'),
(5, 'Администрация');

CREATE TABLE IF NOT EXISTS `priority` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

INSERT INTO `priority` (`id`, `name`) VALUES
(1, 'Стандартный'),
(2, 'Высокий');


CREATE TABLE IF NOT EXISTS `playtime` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

INSERT INTO `playtime` (`id`, `name`) VALUES
(10, '10 sec.'),
(15, '15 sec.'),
(20, '20 sec.'),
(30, '30 sec.'),
(45, '45 sec.'),
(90, '90 sec.');


CREATE TABLE IF NOT EXISTS `slide` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` TEXT COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `type_id` int(11) unsigned DEFAULT NULL,
  `playtime` int(11) unsigned DEFAULT NULL,
  `public` tinyint(1) DEFAULT NULL,
  `priority_id` int(11) unsigned DEFAULT NULL,
  `department_id` int(11) unsigned DEFAULT NULL,
  `bg_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_slide_user` (`user_id`),
  KEY `index_foreignkey_slide_type` (`type_id`),
  KEY `index_foreignkey_slide_priority` (`priority_id`),
  KEY `index_foreignkey_slide_department` (`department_id`),
  KEY `index_foreignkey_slide_bg` (`bg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=19 ;

INSERT INTO `slide` (`id`, `user_id`, `url`, `text`, `image`, `header`, `starttime`, `endtime`, `type_id`, `public`, `priority_id`, `department_id`, `bg_id`) VALUES
(1, 2, '#', 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'uploads/campus.jpg', 'Caption Animation 8', '2019-05-07 00:00:00', '2019-05-26 00:00:00', 1, 1, 1, 1, 1),
(2, 3, '#', 'Lorem ipsum dolor sit amet consectetur adipisicing elit', NULL, 'Caption Animation 1', '2019-05-01 09:35:00', '2019-05-31 09:35:00', 3, NULL, 1, 3, NULL),
(4, 2, '#', 'Lorem ipsum dolor sit amet consectetur adipisicing elit', NULL, 'Caption Animation 3', '2019-04-18 00:00:00', '2019-05-18 00:00:00', 3, 1, 1, 2, NULL),
(5, 2, 'https://www.youtube.com/embed/OXuIqaeg0SI', NULL, NULL, NULL, '2019-05-03 00:00:00', '2019-05-04 00:00:00', 2, 1, 2, 4, NULL),
(6, 2, '#', 'Lorem ipsum dolor sit amet consectetur adipisicing elit', NULL, 'Caption Animation 4', '2019-05-03 00:00:00', '2019-05-13 00:00:00', 3, 1, 2, 4, NULL),
(7, 4, '#', 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'uploads/conference.jpg', 'Caption Animation 9', '2019-07-12 00:00:00', '2019-07-13 00:00:00', 1, NULL, 1, 4, NULL),
(8, 2, '#', 'Lorem ipsum dolor sit amet consectetur adipisicing elit', NULL, 'Caption Animation 5', '2019-07-12 00:00:00', '2019-07-19 00:00:00', 3, NULL, 1, 4, NULL),
(10, 2, 'https://www.youtube.com/embed/X8Z8okhkjv8', NULL, NULL, NULL, '2019-05-03 00:00:00', '2019-05-13 00:00:00', 2, 1, 1, 4, NULL),
(11, 2, '#', 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'uploads/code.jpg', 'Caption Animation 7', '2019-07-12 00:00:00', '2019-07-19 00:00:00', 1, NULL, 1, 4, NULL),
(13, 5, NULL, 'Текст!!!', NULL, 'Заголовок', '2019-05-03 10:10:00', '2019-06-02 10:10:00', 3, 1, 1, 4, NULL),
(14, 2, NULL, 'Текст!!!', NULL, 'Заголовок', '2019-05-03 00:00:00', '2019-05-31 00:00:00', 3, 1, 1, 5, NULL),
(17, 1, NULL, 'weweeefefwefwef', NULL, 'esscscwecwc', '2019-05-03 00:00:00', '2019-05-31 00:00:00', 3, NULL, 1, 5, 3),
(18, 1, NULL, 'weweeefefwefwef', NULL, 'esscscwecwc', '2019-05-03 00:00:00', '2019-05-31 00:00:00', 3, NULL, 1, 5, 6);

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'image'),
(2, 'video'),
(3, 'text');

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userstatus_id` int(11) unsigned DEFAULT NULL,
  `public` tinyint(1) NOT NULL,
  `department_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_user_userstatus` (`userstatus_id`),
  KEY `index_foreignkey_user_department` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=9 ;

INSERT INTO `user` (`id`, `lastname`, `firstname`, `fname`, `phone`, `password`, `email`, `userstatus_id`, `public`, `department_id`) VALUES
(1, 'Иванов', 'Иван', 'Иванович', '07239428374928', '4dfe6e220d16e7b633cfdd92bcc8050b', 'ivanov@mail.ru', 1, 1, 1),
(2, 'Табуреткин', 'Василий', 'Петрович', '072984723498', 'f3ec2ca4110ebe4b70fd0f35f5fd6f6c', 'taburetkin1@mail.ru', 2, 1, 1),
(3, 'Сидоров', 'Сидор', 'Сидорович', '07438239487', '9cd3acb851a21717cc51c213015eb7a7', 'sidorov@mail.ru', 1, 0, 2),
(4, 'Студентов', 'Студент', 'Студентович', '07824983274', 'cd73502828457d15655bbd7a63fb0bc8', 'student@mail.ru', 2, 0, 2),
(5, 'Сергеев', 'Сергей', 'Сергеевич', '0792837498347', '18943b9c5e88aa35c687cce4a36dfb4e', 'sergeev@mail.ru', 2, 1, 3),
(6, 'Петров', 'Петр', 'Петрович', '0792873498374', 'f396c3b74762b1fee69b10abb875139b', 'petrov@mail.ru', 2, 0, 2),
(8, 'Новый ', 'Пользователь', '', '', 'c2fbbbc536104c20ee59232495259aaf', 'newuser@mail.ru', 2, 0, NULL);

CREATE TABLE IF NOT EXISTS `userstatus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

INSERT INTO `userstatus` (`id`, `name`) VALUES
(1, 'Администратор'),
(2, 'Пользователь');


ALTER TABLE `slide`
  ADD CONSTRAINT `c_fk_slide_bg_id` FOREIGN KEY (`bg_id`) REFERENCES `bg` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `c_fk_slide_department_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `c_fk_slide_priority_id` FOREIGN KEY (`priority_id`) REFERENCES `priority` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `c_fk_slide_type_id` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `c_fk_slide_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

ALTER TABLE `user`
  ADD CONSTRAINT `c_fk_user_department_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `c_fk_user_userstatus_id` FOREIGN KEY (`userstatus_id`) REFERENCES `userstatus` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
