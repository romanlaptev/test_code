-- =========== DB book_history_engraving
-- книга очерки истории и техники гравюры
-- получить страницы подшивки с прикрепленным изображением 
SELECT 
node.nid, 
-- @node_nid:='%'+node.nid+'%', 
-- @node_nid:='%161%', 
node.type, 
node.title, 
node.status, 
node.created, 
node.changed, 
--
-- основная часть
field_data_body.body_value, 
-- ==============================================================
-- -- поле изображения
-- field_data_field_img1_book.field_img1_book_fid, 
-- field_data_field_img1_book.field_img1_book_alt, 
-- field_data_field_img1_book.field_img1_book_title, 
-- ==============================================================
-- -- поле картинки large
-- field_data_field_large_img.field_large_img_value, 
--
-- -- поле картинки medium
-- field_data_field_medium_img.field_medium_img_value, 
--
-- -- поле картинки original
-- field_data_field_original_img.field_original_img_value, 
--
-- -- поле картинки preview
-- field_data_field_preview_gallery_img.field_preview_gallery_img_value, 
--
-- -- поле картинки small
-- field_data_field_small_img.field_small_img_value, 
-- ==============================================================
-- -- fid прикрепленных файлы  
-- -- file_usage.fid 
-- -- 
-- -- параметры прикрепленных файлы  
-- file_managed.filename, 
-- file_managed.uri, 
-- file_managed.filemime, 
-- file_managed.filesize, 
-- ==============================================================
-- -- tid термина словаря
-- -- field_data_field_notebook.field_notebook_tid 
-- -- имя и описание термина словаря
-- -- taxonomy_term_data.vid
taxonomy_term_data.name, 
-- taxonomy_term_data.description, 
-- taxonomy_term_data.weight
-- ==============================================================
-- заголовок HTML-страницы
-- page_title.type
page_title.page_title 
--
-- url страницы
-- url_alias.pid
-- url_alias.alias 
-- ==============================================================
FROM node 
LEFT JOIN field_data_body ON field_data_body.entity_id=node.nid -- основная часть
-- LEFT JOIN field_data_field_img1_book ON field_data_field_img1_book.entity_id=node.nid -- поле изображения
-- LEFT JOIN field_data_field_large_img ON field_data_field_large_img.entity_id=node.nid -- поле картинки large
-- LEFT JOIN field_data_field_medium_img ON field_data_field_medium_img.entity_id=node.nid -- поле картинки medium
-- LEFT JOIN field_data_field_original_img ON field_data_field_original_img.entity_id=node.nid -- поле картинки original
-- LEFT JOIN field_data_field_preview_gallery_img ON field_data_field_preview_gallery_img.entity_id=node.nid -- поле картинки preview
-- LEFT JOIN field_data_field_small_img ON field_data_field_small_img.entity_id=node.nid -- поле картинки small
-- LEFT JOIN file_usage ON file_usage.id=node.nid -- fid прикрепленных файлы  
-- LEFT JOIN file_managed ON file_managed.fid=file_usage.fid -- параметры прикрепленных файлы  
LEFT JOIN field_data_field_notebook ON field_data_field_notebook.entity_id=node.nid -- tid термина словаря
LEFT JOIN taxonomy_term_data ON taxonomy_term_data.tid=field_data_field_notebook.field_notebook_tid
LEFT JOIN page_title ON page_title.id=node.nid -- заголовок страницы
-- LEFT JOIN url_alias ON url_alias.source LIKE @node_nid -- url страницы
WHERE node.type='book';

-- ================================================================================
taxonomy_term_data.tid
taxonomy_term_data.vid
taxonomy_term_data.description
taxonomy_term_data.weight

taxonomy_vocabulary.vid
taxonomy_vocabulary.name
taxonomy_vocabulary.machine_name

-- =====================================================
book.nid=node.nid
book.mlid

menu_links.mlid=book.mlid
menu_links.plid
-- menu_links.menu_name
menu_links.link_title
menu_links.weight
menu_links.depth 

-- книга очерки истории и техники гравюры
-- получить страницы подшивки с учетом структуры
-- верхний уровень списка книг 
SELECT *
FROM menu_links
WHERE 
menu_links.module='book' AND menu_links.depth=1;

-- 2 уровень списка книг (содержание)
SELECT *
FROM menu_links
WHERE 
menu_links.plid=349;

-- ============================================
-- верхний уровень списка книг 
SELECT * FROM menu_links WHERE menu_links.module='book' AND menu_links.depth=1
UNION
SELECT * FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
(SELECT menu_links.mlid FROM menu_links WHERE menu_links.module='book' AND menu_links.depth=1);
-----------------------------------

SELECT * FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
(SELECT menu_links.mlid FROM menu_links WHERE menu_links.plid=349);

SELECT * FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
(SELECT menu_links.mlid FROM menu_links WHERE menu_links.plid IN -- ВЛОЖЕННЫЙ ЗАПРОС
(SELECT menu_links.mlid FROM menu_links WHERE menu_links.module='book' AND menu_links.depth=1));
------------------------

-- ===========================================

-- 3 уровень списка книг (страницы)
SELECT *
FROM menu_links
WHERE 
menu_links.plid=370;

-- ============================================
-- 1
-- получить nid, соответствующий странице
SELECT nid
FROM book
WHERE 
book.mlid=378;

-- 2
SELECT
node.nid, 
-- node.type, 
node.title, 
node.status, 
node.created, 
node.changed, 
field_data_body.body_value, 
-- =============================== поле расположение картинк по размерам
field_data_field_large_img.field_large_img_value, 
field_data_field_medium_img.field_medium_img_value, 
field_data_field_original_img.field_original_img_value, 
field_data_field_preview_gallery_img.field_preview_gallery_img_value, 
field_data_field_small_img.field_small_img_value, 
-- ====================================================== термин словаря
field_data_field_notebook.field_notebook_tid, 
taxonomy_term_data.name, 
-- ============================================== заголовок HTML-страницы
-- page_title.type
page_title.page_title, 
-- url страницы
-- url_alias.pid
url_alias.alias 
-- ======================================================================
FROM node
LEFT JOIN book ON book.mlid=378
LEFT JOIN field_data_body ON field_data_body.entity_id=node.nid -- основная часть
LEFT JOIN field_data_field_large_img ON field_data_field_large_img.entity_id=node.nid -- поле картинки large
LEFT JOIN field_data_field_medium_img ON field_data_field_medium_img.entity_id=node.nid -- поле картинки medium
LEFT JOIN field_data_field_original_img ON field_data_field_original_img.entity_id=node.nid -- поле картинки original
LEFT JOIN field_data_field_preview_gallery_img ON field_data_field_preview_gallery_img.entity_id=node.nid -- поле картинки preview
LEFT JOIN field_data_field_small_img ON field_data_field_small_img.entity_id=node.nid -- поле картинки small
LEFT JOIN field_data_field_notebook ON field_data_field_notebook.entity_id=node.nid -- tid термина словаря
LEFT JOIN taxonomy_term_data ON taxonomy_term_data.tid=field_data_field_notebook.field_notebook_tid
LEFT JOIN page_title ON page_title.id=node.nid -- заголовок страницы
LEFT JOIN url_alias ON url_alias.source='node/161' -- url страницы
WHERE 
node.nid=book.nid;

-- LEFT JOIN field_data_field_img1_book ON field_data_field_img1_book.entity_id=node.nid -- поле изображения
-- LEFT JOIN file_usage ON file_usage.id=node.nid -- fid прикрепленных файлы  
-- LEFT JOIN file_managed ON file_managed.fid=file_usage.fid -- параметры прикрепленных файлы  
WHERE node.type='book';

-- ============================================
-- получить параметры прикрепленных файлов
SELECT
file_managed.filename, 
file_managed.uri, 
file_managed.filemime, 
file_managed.filesize, 
file_managed.timestamp
FROM file_managed
LEFT JOIN node ON node.nid='152' -- nid страницы
LEFT JOIN file_usage ON file_usage.id=node.nid -- fid прикрепленных файлы  
WHERE file_managed.fid=file_usage.fid;
-- ==============================================================
