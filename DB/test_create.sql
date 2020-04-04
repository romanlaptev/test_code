CREATE DATABASE IF NOT EXISTS* `db1` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db1`;

DROP TABLE IF EXISTS `test_actions`;

CREATE TABLE IF NOT EXISTS test_tbl (
	id int(10) not null primary key auto_increment,
	name varchar(255) default null,
	price decimal(9,2) not null default '0.00'
) default charset=utf8 collate=utf8_unicode_ci;


insert into test_tbl (name,price) values ('product1','101');
insert into test_tbl (name,price) values ('product2','102');
insert into test_tbl (name,price) values ('product3','100');

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

