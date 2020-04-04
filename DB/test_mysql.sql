-- CREATE DATABASE IF NOT EXISTS `db1`;
-- CREATE DATABASE IF NOT EXISTS `db1` DEFAULT CHARACTER SET latin1;
CREATE DATABASE IF NOT EXISTS `db1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `db1`;

DROP TABLE IF EXISTS `test_tbl`;
CREATE TABLE IF NOT EXISTS `test_tbl` (
	id int(10) not null primary key auto_increment,
	name varchar(255) default null,
	price decimal(9,2) not null default '0.00'
-- ) default charset=utf8 collate=utf8_unicode_ci;
);

insert into test_tbl (name,price) values ('product1','101');
insert into test_tbl (name,price) values ('product2','102');
insert into test_tbl (name,price) values ('product3','100');

-- ===============================
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) COMMENT 'связь с родительской категорией',
  `name` varchar(255)  NOT NULL COMMENT 'Наименование',
  PRIMARY KEY (`category_id`)
);

INSERT INTO `category` (`category_id`, `parent_id`, `name`) VALUES
(1, 0, 'Категория 1'),
(2, 1, 'Категория 2'),
(3, 4, 'Категория 4'),
(4, 2, 'Категория 3'),
(5, 4, 'Категория 5');

-- ===============================
(
select 
id,name,price,'much'as res 
from test_tbl 
where price>100
)
union all
(
select 
id,name,price,'little'as res 
from test_tbl 
where price>100
)

