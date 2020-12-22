SELECT * FROM master.sys.databases where name='db1';
USE db1; 
IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='notes') 
BEGIN
CREATE TABLE "notes" (
 id int IDENTITY(1,1) PRIMARY KEY NOT NULL,
 author  varchar(20) COLLATE Cyrillic_General_CI_AS NOT NULL,
 title   varchar(255) COLLATE Cyrillic_General_CI_AS NOT NULL,
 text_message  text COLLATE Cyrillic_General_CI_AS NOT NULL ,
 client_date datetime NOT NULL,
 server_date datetime NOT NULL,
 ip varchar(20)
);
END;

