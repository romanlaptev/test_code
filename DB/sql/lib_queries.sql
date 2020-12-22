================================================================== DB lib
-- получить описание книги, имя файла книги из таблиц поля материала FIELD_BOOK
SELECT field_data_field_field_book.field_field_book_description, file_managed.filename 
FROM field_data_field_field_book 
LEFT JOIN file_managed ON  field_data_field_field_book.field_field_book_fid = file_managed.fid;

-- получить описание книги, имя файла книги из таблиц поля материала FIELD_BOOK (книги по ASP)
SELECT field_data_field_field_book1.field_field_book1_description, file_managed.filename 
FROM field_data_field_field_book1 
LEFT JOIN file_managed ON  field_data_field_field_book1.field_field_book1_fid = file_managed.fid;

-- получить описание книги, имя файла книги из таблиц поля материала FIELD_BOOK_PHP
SELECT field_data_field_field_book_php.field_field_book_php_description, file_managed.filename 
FROM field_data_field_field_book_php 
LEFT JOIN file_managed ON  field_data_field_field_book_php.field_field_book_php_fid = file_managed.fid;

-- получить описание книги, имя файла книги из таблиц поля материала FIELD_BOOK_PYTHON
SELECT field_data_field_field_book_python.field_field_book_python_description, file_managed.filename 
FROM field_data_field_field_book_python 
LEFT JOIN file_managed ON  field_data_field_field_book_python.field_field_book_python_fid = file_managed.fid;


================================================================== DB lib
SELECT *
FROM menu_links
WHERE menu_links.module = 'book'
AND menu_links.depth =1
LIMIT 0 , 30
----------------------------------

SELECT *
FROM menu_links
WHERE menu_links.plid =384 -- библиотека
LIMIT 0 , 30

---------------------------------
SELECT *
FROM menu_links
WHERE menu_links.plid =455 -- графика, искусствоведение, культурология

---------------------------------
SELECT *
FROM menu_links
WHERE menu_links.plid =513 -- модерн

---------------------------------

SELECT *
FROM menu_links
WHERE menu_links.plid =508 -- Шедевры графики. Обри Бердслей

---------------------------------
SELECT *
FROM menu_links
WHERE menu_links.plid =757 -- img_pages
--------------------------------


================================================================== DB lib
1.SELECT mlid FROM menu_links WHERE link_title LIKE 'Шедевры графики. Обри Бердслей';

2.
SELECT * FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'Шедевры графики. Обри Бердслей');

3.
SELECT * FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'img_pages');

4.
SELECT * FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
	(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'img_pages' AND menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
		(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'Шедевры графики. Обри Бердслей')
) ORDER BY weight ASC;

5.
-- получить nid, соответствующий странице
SELECT 
-- book.mlid, 
book.nid FROM book WHERE book.mlid IN
	(SELECT menu_links.mlid FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
		(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'img_pages' AND menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
			(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'Шедевры графики. Обри Бердслей')
));

6.
SELECT node.nid, node.title FROM node WHERE node.nid IN -- ВЛОЖЕННЫЙ ЗАПРОС
(SELECT book.nid FROM book WHERE book.mlid IN -- получить nid, соответствующий странице
	(SELECT menu_links.mlid FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
		(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'img_pages' AND menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
			(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'Шедевры графики. Обри Бердслей')
)));

7.
SELECT 
node.nid, 
node.title, 
-- node.status, 
field_data_body.body_value, 
file_managed.filename, 
-- file_managed.uri, 
file_managed.filemime, 
file_managed.filesize, 
-- file_managed.timestamp, 
-- menu_links.weight
field_data_field_book_img.field_book_img_alt,
field_data_field_book_img.field_book_img_title, 
url_alias.alias, 
page_title.page_title 
FROM node 
LEFT JOIN field_data_body ON field_data_body.entity_id=node.nid -- основная часть
LEFT JOIN file_usage ON file_usage.id=node.nid -- fid прикрепленных файлы  
LEFT JOIN file_managed ON file_managed.fid=file_usage.fid -- получить параметры прикрепленных файлов
LEFT JOIN field_data_field_book_img ON field_book_img_fid=file_usage.fid 
LEFT JOIN url_alias ON url_alias.source=CONCAT('node/',node.nid) -- url страницы
LEFT JOIN page_title ON page_title.id=node.nid -- заголовок страницы
-- LEFT JOIN book ON book.mlid=node.nid 
-- LEFT JOIN menu_links ON menu_links.mlid=book.mlid 
WHERE node.status=1 AND node.nid IN -- ВЛОЖЕННЫЙ ЗАПРОС
(SELECT book.nid FROM book WHERE book.mlid IN -- получить nid, соответствующий странице
	(SELECT menu_links.mlid FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
		(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'img_pages' AND menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
			(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'Шедевры графики. Обри Бердслей')
))) ORDER BY node.title ASC;

================================================================== DB lib
1.
SELECT mlid FROM menu_links WHERE link_title LIKE 'Пахомова В. А. Графика Ганса Гольбейна Младшего';

2.
SELECT * FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'Пахомова В. А. Графика Ганса Гольбейна Младшего')
ORDER BY weight ASC;

SELECT * FROM `menu_links`WHERE `plid` =481 ORDER BY weight ASC;


3.
SELECT * FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
	(SELECT menu_links.mlid FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
		(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'Пахомова В. А. Графика Ганса Гольбейна Младшего')
) ORDER BY weight ASC;

4.
-- получить все страницы книги 2-го уровня
SELECT 
node.nid, 
node.title, 
field_data_body.body_value 
FROM node 
LEFT JOIN field_data_body ON field_data_body.entity_id=node.nid -- основная часть
WHERE node.nid IN -- ВЛОЖЕННЫЙ ЗАПРОС
(SELECT book.nid FROM book WHERE book.mlid IN -- получить nid, соответствующий странице
	(SELECT menu_links.mlid FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
		(SELECT menu_links.mlid FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
			(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'Пахомова В. А. Графика Ганса Гольбейна Младшего')
)));

5.
-- получить все страницы книги 1-го уровня
SELECT 
node.nid, 
node.title, 
field_data_body.body_value 
FROM node 
LEFT JOIN field_data_body ON field_data_body.entity_id=node.nid -- основная часть
LEFT JOIN menu_links ON link_title LIKE 'Пахомова В. А. Графика Ганса Гольбейна Младшего'
WHERE node.nid IN -- ВЛОЖЕННЫЙ ЗАПРОС
(SELECT book.nid FROM book WHERE book.mlid IN -- получить nid, соответствующий странице
		(SELECT menu_links.mlid FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
			(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'Пахомова В. А. Графика Ганса Гольбейна Младшего')
)) ORDER BY menu_links.weight ASC;

6.
-- не работает сортировка по весу
SELECT 
node.nid, 
node.title 
FROM node 
LEFT JOIN menu_links ON link_title LIKE 'Пахомова В. А. Графика Ганса Гольбейна Младшего'
WHERE node.nid IN -- ВЛОЖЕННЫЙ ЗАПРОС
(
SELECT book.nid FROM book WHERE book.mlid IN -- получить nid, соответствующий странице
	(SELECT menu_links.mlid FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
		(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'Пахомова В. А. Графика Ганса Гольбейна Младшего')
	ORDER BY weight ASC)
);

-- отсортировано по весу
SELECT * FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'Пахомова В. А. Графика Ганса Гольбейна Младшего')
ORDER BY weight ASC;

7.
-- получить все страницы книги 2-го уровня
SELECT 
-- book.mlid, 
book.nid, 
node.nid, 
node.title, 
field_data_body.body_value 
FROM book 
LEFT JOIN node ON node.nid=book.nid
LEFT JOIN field_data_body ON field_data_body.entity_id=node.nid -- основная часть
WHERE book.mlid IN
	(SELECT menu_links.mlid FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
		(SELECT menu_links.mlid FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
			(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'Пахомова В. А. Графика Ганса Гольбейна Младшего')
));

-- получить все страницы книги 1-го уровня
SELECT 
-- book.mlid, 
book.nid, 
node.nid, 
node.title, 
field_data_body.body_value 
FROM book 
LEFT JOIN node ON node.nid=book.nid
LEFT JOIN field_data_body ON field_data_body.entity_id=node.nid -- основная часть
WHERE book.mlid IN
		(SELECT menu_links.mlid FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
			(SELECT menu_links.mlid FROM menu_links WHERE link_title LIKE 'Пахомова В. А. Графика Ганса Гольбейна Младшего')
);


