<html>
<head>
    <title>Новости</title>
</head>
<body>
<table width="100%" border="1">
<?php
$news = array();        // В этом массиве будут храниться новости,
                        // полученные из XML файла
$currentNews = null;    // Текущая новость. Используется в процессе
                        // импорта данных
$index = null;          // Текущий индекс в массиве новостей.
                        // Используется в процессе импорта данных

// Функции, описанные ниже, являются обработчиками различных типов
// XML-данных и будут вызываться парсером в процессе разбора.

// Функция для обработки начальных тегов XML
// На входе:
//   - указатель на SAX парсер
//   - имя XML тега
//   - массив аттрибутов
function saxStartElement($parser,$name,$attrs)
{
    global $currentNews,$index;

    switch($name)
    {
        case 'newsLine':
// Тег newsLine содержит все новости. Мы должны подготовить
// массив $news для приема новостей из XML файла.
            $news = array();
            break;
        case 'news':
// Каждая новость находится в теге news. Подготавливаем массив
// $currentNews для приема этой новости
            $currentNews = array();
// Если у новости есть дата - сохраняем ее в массиве
            if (in_array('date',array_keys($attrs)))
                $currentNews['date'] = $attrs['date'];
            break;
        default:
// Все остальные теги, которые могут встретиться в XML файле
// находятся внутри тега <news>, поэтому мы просто запоминаем
// их название с тем, чтобы знать, какие именно данные мы
// обрабатываем.
            $index = $name;
            break;
    };
}

// Функция для обработки конечных тегов XML
// На входе:
//   - указатель на SAX парсер
//   - имя XML тега
function saxEndElement($parser,$name)
{
    global $news,$currentNews,$index;

    if ((is_array($currentNews)) && ($name=='news'))
// Если в данный момент у нас есть массив $currentNews (т.е.
// мы обрабатываем содержимое новости) и имя закрывающего
// тега - "news", то это значит, что данные для этой новости
// кончились и мы можем поместить готовую новость в массив
// новостей.
    {
        $news[] = $currentNews;
// Уничтожаем массив текущей новости, чтобы показать, что
// в данный момент мы не занимаемся получением данных для
// новости.
        $currentNews = null;
    };
// В любом случае закрытие тега означает, что символьные
// данные, получаемые парсером не нужно помещать куда-либо.
    $index = null;
}

// Функция для обработки символьных данных
// На входе:
//   - указатель на SAX парсер
//   - символьные данные XML
function saxCharacterData($parser,$data)
{
    global $currentNews,$index;

// Мы принимаем только данные для новостей, помещенные в
// какой-нибудь тег. Все остальные символьные данные
// (как правило это пустое пространство, использованное
// для форматирования) мы опускаем за ненадобностью.
    if ((is_array($currentNews)) && ($index))
        $currentNews[$index] = $data;
}

// Создаем SAX парсер, который будет использоваться для
// обработки XML-данных.
$parser = xml_parser_create();
// Регистрируем функции для обработки различных типов
// XML-данных:
//  - начальный и конечный тэги XML
xml_set_element_handler($parser,'saxStartElement','saxEndElement');
//  - символьные данные
xml_set_character_data_handler($parser,'saxCharacterData');
// Также существуют аналогичные функции для регистрации
// обработчиков других типов XML-данных.
// Убираем case folding, в этом случае имена тэгов будут
// передаваться обработчикам в оригинальном виде. Если case
// folding включен, то все имена тегов будут переведены
// в верхний регистр.
xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,false);

// Получаем содержимое XML-файла с новостями.
$xml = join('',file('data/news2.xml'));

// Производим парсинг (разбор) полученного XML-файла.
// В процессе разбора парсер будет вызывать описанные нами
// функции и в результате мы получим массив $news,
// содержащий новости из XML-файла.
if (!xml_parse($parser,$xml,true))
// Парсер возвращает значение FALSE, если произошла
// какая-либо ошибка. В этом случае мы также прекращаем
// выполнение скрипта и возвращаем ошибку.
    die(sprintf('Ошибка XML: %s в строке %d',
        xml_error_string(xml_get_error_code($parser)),
        xml_get_current_line_number($parser)));
// Уничтожаем парсер, освобождая занятые им ресурсы
xml_parser_free($parser);

print_r($news);

foreach($news as $n)
{
?>
<tr>
    <td width="90%"><b><?php echo $n['title']; ?></b></td>
    <td><?php echo $n['date']; ?></td>
</tr>
<tr>
    <td colspan="2"><?php echo $n['text']; ?><br><br></td>
</tr>
<?php
};
?>
</table>
</body>
</html>