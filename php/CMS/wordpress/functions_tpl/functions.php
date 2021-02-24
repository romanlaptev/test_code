<?php
//	Файл, объединяющий настройки functions.php
//	Версия 1.0.0 от 31.10.2018


//	Файл с общими настройками functions.php
//	====================
include('functions/functions-base.php');
/*	
	- Error reporting
	- Константы
	- Отключение wp-embed.min.js
	- Отключение канонических и коротких ссылок
	- Отключение Windows Live Writer
	- Отключение сам REST API
	- Отключение фильтра REST API
	- Отключение события REST API
	- Отключение Embeds связанные с REST API
	- Отключение dns-prefetch
	- Отключение srcset
	- Отключение версии WordPress со страниц, RSS, скриптов и стилей
	- Отключение смайлов
	- Отключение админ-бар
	- Отключение лого wordpress
	- Скрытие лого wordpress и ссылки "Забыли пароль" на странице входа
	- Удаление "Рубрика: ", "Метка: " и т.д. из заголовка архива
	- Изменение качества картинок JPG
	- Добавление пунктов меню в админке
	- Поиск по произвольным полями
	- Склонение числительных
	- 
	- 
*/

//	Файл с частными настройками functions.php
//	====================
include('functions/functions-custom.php');
/*
	- Обрезка фото по своим размерам
	- Добавление фото своего размера в админку
	- Регистрация областей меню
	- Удаление пунктов меню в админке
	- Переименование пунктов меню в админке
	- Cтраницы настроек с произвольными полями
	- Произвольные типы записей
	- 
	- 
*/

//	Файл с шорткодами functions.php
//	====================
include('functions/functions-shortcode.php');
/*
	- Шорткод кнопки
	- Добавление кнопок html-редактор
	- 
	- 
*/

//	Файл работы setcookie functions.php
//	====================
include('functions/functions-setcookie.php');
/*
	- Подключение кук для UTM меток
	- Извлечение нужных кук UTM меток
	- 
*/