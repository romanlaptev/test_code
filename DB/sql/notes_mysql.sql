CREATE TABLE IF NOT EXISTS `notes` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`author` varchar(20) NOT NULL,
`title` varchar(255) default "no title",
`text_message` text NOT NULL default "",
`client_date` DATETIME NULL,
`server_date` DATETIME NULL,
`ip` varchar( 20 ) default "",
PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

