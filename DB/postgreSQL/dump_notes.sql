/*
CREATE TABLE IF NOT EXISTS "notes" (
-- CREATE TABLE "notes" (
	"id" SERIAL,
	"author" character(20) NOT NULL,
	"title" character(255),
	"text_message" text,
	"client_date" date,
	"server_date" date,
	"ip" character(20),
	CONSTRAINT "notes_pkey" PRIMARY KEY (id)
) WITHOUT OIDS;
*/

-- INSERT INTO notes VALUES (DEFAULT,'anonymous','linux, date, установить системную дату/время                                                                                                                         ','
-- date -s &amp;quot;2015-05-27 14:53:00&amp;quot;','2020-03-31','2020-03-31','10.16.194.154');



INSERT INTO notes VALUES (1,'anonymous','linux, mount','[code]
nofail 	
Используется в случае, если в fstab прописаны некоторые другие жёсткие диски, кроме основого (с системой, которая загружается), 
но в данный момент они физически не подключены к ПК. 
Чтобы при загрузке не выдавалась ошибка, приводящая 
к невозможности загрузки (система ищет по fstab 
отключенные диски, но не находит их), 
в строчках fstab-а с этими дисками и следует 
установить такой флаг - тогда эти диски будут проигнорированы 
при загрузке (до их подключения к ПК). 
При применении этого флага к подключенным дискам, 
никакого эффекта не наступает, флаг игнорируется. 
https://ru.wikipedia.org/wiki/Fstab
[/code]','2020-04-03','2020-04-03','10.123.254.53');

INSERT INTO notes VALUES (2,'anonymous','linux, date, установить системную дату/время','date -s &amp;quot;2015-05-27 14:53:00&amp;quot;','2020-03-31','2020-03-31','10.16.194.154');
INSERT INTO notes VALUES (3,'anonymous','grep','grep -r --include=*.php &amp;quot;search string&amp;quot; /path/to/dir','2020-03-12','2020-03-12','10.9.216.41');
INSERT INTO notes VALUES (4,'nodejs, update','обновить nodejs','[code]
First update npm,
npm install -g npm stable

Then update node,
npm install -g node or npm install -g n

check after version installation,
node --version or node -v
https://stackoverflow.com/questions/8191459/how-do-i-update-node-js
[/code]','2020-02-09','2020-02-09','10.79.206.66');

INSERT INTO notes VALUES (5,'anonymous','lxde, autostart','test[br]
/home/roman/.config/lxsession/LXDE/autostart[br]
[br]
@lxpanel --profile LXDE[br]
@pcmanfm --desktop --profile LXDE[br]
@xscreensaver -no-splash[br]
[br]
setxkbmap -layout us,ru -option grp:ctrl_shift_toggle,grp_led:caps,ctrl:nocaps','2019-12-11','2019-12-11','10.186.239.155');

INSERT INTO notes VALUES (6,'anonymous','links collection','[url]http://kbyte.ru/ru/Programming/Sources.aspx?id=1044&amp;mode=show   |   Как изменить COLLATE у базы данных?[/url]
[br]
[url]https://it3xl.wordpress.com/2011/02/17/windows-xp-failed-to-access-iis-metabase-hostingenvironmentexception-%D1%81%D0%B1%D0%BE%D0%B9-%D0%BF%D1%80%D0%B8-%D0%BF%D0%BE%D0%BF%D1%8B%D1%82%D0%BA%D0%B5-%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF/   |   Windows XP – Failed to access IIS metabase. HostingEnvironmentException. Сбой при попытке доступа к метабазе IIS. [/url]
[br]
[url]http://www.cyberforum.ru/ado-net/thread251180.html   |   Развертывание программы с SQLite-ом на других компьютерах - C#[/url]','2019-05-29','2019-05-29','10.63.250.242');

INSERT INTO notes VALUES (7,'anonymous','301 редирект, .htaccess','[url]http://ru.wikibooks.org/wiki/%D0%94%D0%B8%D1%80%D0%B5%D0%BA%D1%82%D0%B8%D0%B2%D1%8B_.htaccess  |  Директивы_.htaccess[/url]
[code]
Как сделать 301 редирект
Файл .htaccess
301 редирект – корректная переадресация через htaccess и php header
.htaccess: , вывод ошибок PHP

Redirect /index.php http://example.com/index.php
Redirect /data http://www.example.com/data 
=================================
[/code]','2019-05-29','2019-05-29','10.30.222.9');

INSERT INTO notes VALUES (8,'anonymous','Debian 7, wheezy, list repo','#/etc/apt/sources.list[br]
deb http://archive.debian.org/debian/ wheezy main[br]
deb-src http://archive.debian.org/debian/ wheezy main[br]
deb http://security.debian.org/ wheezy/updates main contrib[br]
deb-src http://security.debian.org/ wheezy/updates main contrib[br]','2019-05-28','2019-05-27','37.193.108.45');

INSERT INTO notes VALUES (9,'anonymous','PostgreSQL','#http://hutpu4.net/linux-open-source/postgresql-phppgadmin-for-debian-ubuntu.html
[br]
apt-get install postgresql[br]
apt-get install postgresql-contrib[br]
apt-get install php5-pgsql[br]','2019-05-28','2019-05-27','37.193.108.45');

INSERT INTO notes VALUES (10,'anonymous','nslookup, узнать IP-адрес интернет-ресурса                                                                                                                           ','
узнать IP-адрес интернет-ресурса можно введя в ту же командную строку команду nslookup Book-Science.ru','2019-05-28','2019-05-28','10.69.190.141');

INSERT INTO notes VALUES (11,'anonymous','eng/rus books','[url]http://readli.net/chitat-online/?b=102432&amp;pg=1    |    Роберт Энсон Хайнлайн.Гражданин Галактики [/url]
[br][br]
[url]https://royallib.com/read/Heinlein_Robert/Citizen_of_the_Galaxy.html#0   |   Robert A. Heinlein.Citizen of the Galaxy [/url]
[br]
[url] http://samlib.ru/g/gvozdika/beauty.shtml        |        Фицджеральд Ф.С. Последняя красавица Юга!!![/url]
[br]
[url] https://ebooks.adelaide.edu.au/f/fitzgerald/f_scott/short/chapter23.html      |      Short Stories, by F. Scott Fitzgerald. The Last of the Belles [/url]','2019-05-06','2019-05-06','37.193.108.45');

INSERT INTO notes VALUES (12,'anonymous','GIT','[url] http://evtuhovich.ru/blog/2009/04/03/git-reset/ | Отмена последнего коммита в git [/url] 
[code]
git reset --hard HEAD^
[/code]

=================
[url] https://webhamster.ru/mytetrashare/index/mtb0/1413010541hzh3175lej   |  Git - Как исправить HEAD detached from [/url]

[code]
При работе с Git может возникнуть такая ситуация: команда git push не заливает изменения на сервер, а команда git status показывает:

$ git status
HEAD detached from 87dc87b

Это может означать, что вы делали какую-то навигацию по истории коммитов, и неправильно вернулись к последнему коммиту.

Исправить эту проблему можно 4-мя командами:

git branch temp
git checkout temp
git branch -f master temp
git checkout master
И, опционально,
git branch -d temp

Еще один вариант, короткий !!!!!!!!!!
git checkout имяВеткиГдеВыНаходитесь

- эта команда переключит проект в последний коммит текущей ветки. Точнее, в состоянии detached head, проект не находится ни в какой ветке. git checkout branchname просто переключит проект на последний коммит той ветки, которая указана. Это значит, что до появления ошибки нужно знать, в какой ветке ты находишься. Для того чтобы посмотреть, где находился, можно воспользовтьася командой:

git reflog

Самый правильный вариант
git checkout HEAD@{1}
[/code]

[code]
-------------
GIT, create a new repository on the command line
echo &quot;# lib&quot; &gt;&gt; README.md 
git init 
git add README.md 
git commit -m &quot;first commit&quot; 
git remote add origin https://github.com/romanlaptev/lib.git 
git push -u origin master  
#push an existing repository from the command line 
git remote add origin https://github.com/romanlaptev/lib.gitgit push -u origin master
[/code]','2018-12-27','2018-12-27','37.193.108.45');

INSERT INTO notes VALUES (13,'anonymous','windows FAQ, GPT','[url]https://getpocket.com/a/read/2116352733 | В чем разница между GPT и MBR разделами диска[/url]','2018-03-20','2018-03-20','37.193.108.45');
INSERT INTO notes VALUES (14,'anonymous','art,  Francesco Bergamini','Francesco Bergamini (Italian, 1815–1883)[br]
[url] http://www.artnet.com/artists/francesco-bergamini/ | www.artnet.com[/url]','2018-03-20','2018-03-20','37.193.108.45');
INSERT INTO notes VALUES (15,'anonymous','javascript, regExp','убрать из разметки все комментарии
[code]
var value = xmlNodes[n][&quot;html_code&quot;]
.replace(/&lt;!--([\\\\s\\\\S]*?)--&gt;/mig,&quot;&quot;)//remove comments
.replace(/\\\\t/g,&quot;&quot;)
.replace(/\\\\n/g,&quot;&quot;); 
[/code]','2018-02-14','2018-02-14','37.193.108.45');

INSERT INTO notes VALUES (16,'anonymous','Вызов jsp из Servlet','[url]https://toster.ru/q/284566 | Вызов jsp из Servlet/ JAVA[/url]
[code]
Сервлет

@WebServlet(urlPatterns = &quot;/&quot;) // javax.servlet-api 3.0
public class HomeServlet extends HttpServlet {

  @Override
  protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {

    List&lt;String&gt; users = Arrays.asList(&quot;Vaya&quot;, &quot;Petya&quot;, &quot;Fedya&quot;);

    req.setAttribute(&quot;users&quot;, users); // с помощью атрибутов передаются данные между сервлетами

    req.getRequestDispatcher(&quot;/home.jsp&quot;).forward(req,resp);
  }
}
============
JSP /home.jsp

&lt;%@ taglib uri=&quot;http://java.sun.com/jsp/jstl/core&quot; prefix=&quot;c&quot; %&gt;
&lt;html&gt;
&lt;body&gt;
&lt;h2&gt;Hello World!&lt;/h2&gt;

&lt;c:forEach items=&quot;${users}&quot; var=&quot;usr&quot;&gt; 
    &lt;p&gt;${usr}&lt;/p&gt;
&lt;/c:forEach&gt;

&lt;/body&gt;
&lt;/html&gt;

[/code]','2017-10-02','2017-10-02','37.193.108.45');

INSERT INTO notes VALUES (17,'anonymous','cmd, get filename from args','[url]http://www.cyberforum.ru/cmd-bat/thread55211.html   |   FAQ по файлам BAT/CMD - Batch (CMD/BAT) - CyberForum.ru [/url]
[code]
 при использовании нумерованных переменных %0-%9 можно использовать некоторые модификаторы:

        %~1         - разворачивает %1, удаляя кавычки (&quot;)
        %~f1        - разворачивает %1 в полный квалифицированный путь
        %~d1        - разворачивает %1 в букву диска
        %~p1        - разворачивает %1 в путь
        %~n1        - разворачивает %1 в имя файла
        %~x1        - разворачивает %1 в расширение файла
        %~s1        - развернутый путь будет содержать только короткие имена
        %~a1        - разворачивает %1 в атрибуты файла
        %~t1        - разворачивает %1 в дату/время создания файла
        %~z1        - разворачивает %1 в размер файла
        %~$PATH:1   - Ищет в каталогах, перечисленных в переменной среды PATH,
                       и разворачивает %1 в полное квалифицированное имя 
                       первого совпадения. Если имя перменной среды
                       не определено, или если файл не найден, этот 
                       модификатор вернет пустую строку
[/code]

-------- Java compile, file *.class locate to temp
[br]
compile.cmd Add.java
[code]
javac %1 -d c:\\\\temppause
java -cp c:\\\\temp %~n1

[/code]','2017-09-28','2017-09-28','37.193.108.45');

INSERT INTO notes VALUES (18,'anonymous','opera 12, config','[code]
 Opera cache 

Рассмотрим настройки по кэшу, а так же выставим значения влияющие на производительность и снижающие потребление памяти. Данные параметры рассчитаны на безлимитный интернет, не ниже 1 мб\\\\с. Сейчас технологии шагнули далеко и порой легче скачать что то с интернета, чем заставлять старенький компьютер судорожно шерстить по фрагментированному винчестеру в поисках данных в кэше.

Итак, в адресной строке набираем opera:config и меняем значения: 
Редактор настроек opera:config

[BitTorrent] – Enable — Отключаем встроенный клиент BitTorrent. Для скачивания используем внешнее приложение – 0
[Cache] — Cache Docs – Сохранять документы в кэш—памяти – Отключаем если оперативной памяти мало.
[Cache] — Cache Figs – Сохранять изображения в кэш—памяти – Отключаем. Аналогично.
[Cache] — Cache HTTPS After Sessions — Сохранять HTTPS страницы в кэше при закрытии Opera – Отключаем
[Cache] — Check Expiry History — Проверять окончание срока хранения при доступе к страницам из истории. – 2
[Cache] — Check Expiry Load — Проверять срок хранения при загрузке страницы – 2
[Cache] — Document — Размер кэша документов, КБ – 0
[Cache] — Figure — Размер кэша изображений, КБ – 0
[Cache] — SVG Cache Size — Размер кэша векторных изображений SVG , КБ – 10240

[Disk Cache] — Cache Docs – Кэшировать документы — 0
[Disk Cache] — Cache Figs — Кэшировать изображения 0 
[Disk Cache] — Cache Other — Кэшировать другое содержимое страниц – 0
[Disk Cache] — Docs Modification — Проверять, обновились ли на сервере документы, сохранённые в кэш – 0
[Disk Cache] — Enabled — Включить дисковый кэш. – 1
[Disk Cache] — Figs Modification — Проверять, обновились ли на сервере изображения, сохранённые в кэш – 0
[Disk Cache] — Media Cache Size — Размер кэша мультимедийных данных, КБ – тут нужно экспериментировать и выставить значения 5120 или 51200. Этот параметр позволяет не расходовать оперативку и скидывать загружаемый медиа—файл на диск. Если вы часто смотрите фильмы, то чтобы опера не расходовала много ОП, укажите большее значение.
[Disk Cache] — Multimedia Stream Always — Постоянный мультимедийный поток (тег audio/video), расходует пропускную способность, но экономит дисковое пространство. — 1
[Disk Cache] — Multimedia Stream Size — Размер буфера мультимедийного потока, КБ – 2048. Здесь размер можно указать побольше, чтобы потоковое видео не подтормаживало при онлайн—трансляции.
[Disk Cache] — Multimedia Stream in RAM — Мультимедийный поток в оперативной памяти. – 1
[Disk Cache] — Other Modification — Проверять изменения другого содержимого страниц на сервере: — 0
[Disk Cache] — Size — Размер дискового кэша, КБ – 5120

[Extensions] – EcmaScriptJIT — Включает формирование машинного кода для ECMAScript. – 1
[Geolocation] — Enable geolocation — Включить/отключить геолокацию. – 0
[Geolocation] — Google2011 Location Provider Access Token — Маркер доступа, используемый для поставщика местоположения – оставляем пустым
[Geolocation] — Location Provider URL — URL для поставщика данных о положении, основанных на точках доступа Wi—Fi, информации сотового телефона и т.д. – оставляем пустым
[Geolocation] — Send location request only on change — Посылать запрос местоположения, только если некоторые из поставщиков данных (Wi—Fi, сота и т.д.) на самом деле изменились – 0

[Network] — Check Local HostName — Искать компьютеры в локальной сети перед попыткой автозавершения. – 0
[Network] — DNS Prefetching — Предварительный запрос DNS—сервера при наведении указателя мыши на ссылку. – 0
[Network] — Enable Do Not Track Header — Включить передачу заголовка Do_not_track, чтобы веб—сайты третьих сторон (например, рекламные сети) не отслеживали ваши личные данные между веб—сайтами. – 1
[Network] — Enable HostName Expansion — Включить автозавершение имени сервера. – 0
[Network] — Enable NTLM — Включить поддержку NTLM. Только в Windows. – 0
[Network] — Use Spdy2 – Использовать протокол SPDY 2 — 0
[Network] — Use Spdy2 — Использовать протокол SPDY 3 — 0 

[Opera Sync] — Sync Bookmarks — Синхронизировать закладки. – 0
[Opera Sync] — Sync Extensions — Синхронизировать Расширения. – 0
[Opera Sync] — Sync Notes — Синхронизировать Заметки. – 0
[Opera Sync] — Sync Personalbar — Синхронизировать Панель закладок. — 0
[Opera Sync] — Sync Searches — Синхронизировать Службы поиска. — 0
[Opera Sync] — Sync Speed Dial — Синхронизировать Экспресс—панель. — 0
[Opera Sync] — Sync Typed History — Синхронизировать Введённые адреса. — 0
[Opera Sync] — Sync URL Filter — Синхронизировать Правила блокировки содержимого. – 0

[Performance] — Extra Idle Connections — Открывать дополнительные простаивающие соединения с текущим сервером. – 1
[Performance] — Max Connections Server — Разрешённое число одновременных подключений к серверу. – 16
[Performance] — Max Connections Total — Общее разрешённое число одновременных подключений. – 64
[Performance] — Max Persistent Connections Server — Разрешённое число постоянных подключений к серверу. – 8
[Performance] — Network Buffer Size — Размер сетевого буфера, КБ. — 512
[Performance] — Non—Compliant Server 100 Continue — Упрощать запросы к нестандартным серверам. — 1

[Proxy] — Enable Proxy – Использовать прокси для всех серверов, кроме перечисленных – 0
[Sounds] – Enabled — Включить звуковые уведомления в Opera. – 0

[User Prefs] — Automatic RAM Cache — Выбирать размер кэша в памяти автоматически. – 0
[User Prefs] — Enable Service Discovery Notifications — Показать/скрыть оповещения об обнаружении локально размещенных приложений Unite. – 0
[User Prefs] — Enable Trust Rating — Включить защиту от мошенничества и вредоносного ПО. – 0
[User Prefs] — Enable UI Animations — Включить анимацию пользовательского интерфейса. – 0
[User Prefs] — Enable Unite — Включить службы Opera Unite. – 0
[User Prefs] — Enable Usage Statistics — Включить сбор статистики использования функций Opera, отправляемой в Opera Software. – 0
[User Prefs] — Enable Webfonts — Включить использование внедряемых шрифтов (веб—шрифтов). – 0
[User Prefs] — First Update Delay — Задержка перерисовки страницы в миллисекундах. – 500
[User Prefs] — Opera Turbo Mode — Режим Opera Turbo: — 2
[User Prefs] — Show Network Speed Notification — Показывать уведомления о скорости соединения. — 0
[User Prefs] — Spellcheck enabled by default — Включение проверки орфографии. – 0
[User Prefs] — Visited Pages — Помнить содержимое посещённых страниц. – 0

[Web Server] – Enable — Включить. – 0
[Web Server] – Listen To All Networks — Прослушивать все сети. – 0
[Web Server] – UPnP Enabled — Разрешить Opera Unite использовать переадресацию портов UPnP. – 0
[Web Server] – UPnP Service Discovery Enabled — Разрешить Opera Unite использовать службу обнаружения UPnP. – 0
[Web Server] – Use Opera Account — Использовать учётную запись Opera. — 0
[Web Server] – Webserver Always On — Веб—сервер всегда включён. — 0
[Web Server] – Webserver Used — Веб—сервер используется. – 0
[Web Server] – robots.txt Enabled — Включает создание стандартного файла robots.txt, запрещающего поисковым роботам сканирование вашего персонального сервера Opera Unite. – 1

Как видно из описания настроек opera:config список параметров влияющих на производительность достаточно внушительный. Данный перечень рассматривался на версии Opera 12.17


soft-tuning.ru © 2013-2017
[/code]','2017-09-24','2017-09-24','37.192.115.96');

INSERT INTO notes VALUES (19,'anonymous','config, windows server','Как отключить Ctrl-Alt-Del при входе в Windows Server 2003
[code]
Запускаем Редактор локальной групповой политики: Пуск – Выполнить – вводим gpedit.msc.

Далее в открывшимся окне:

    Конфигурация компьютера -&gt; Конфигурация Windows –&gt; Параметры безопасности –&gt; Локальные политики -&gt; Параметры безопасности -&gt; Интерактивный вход: не требовать нажатия сочетания клавиш CTRL+ALT+DEL –&gt; Отключен

В нерусифицированной версии винды:

    Computer Configuration –&gt; Windows Settings –&gt; Security Settings –&gt; Local Policies –&gt; Security Options –&gt; Interactive logon: Do not require CTRL+ALT+DEL — Enabled
[/code]

Как отключить Event Tracker?
[code]
Пуск – Выполнить – вводим gpedit.msc.

Далее в открывшимся окне:

    Конфигурация компьютера –&gt; Административные шаблоны –&gt; Система –&gt; Отображать диалог слежения за завершением работы –&gt; Отключен

В нерусифицированной версии винды:

    Computer Configuration –&gt; Administrative Templates –&gt; System –&gt; Display Shutdown Event Tracker –&gt; Disabled
[/code]
[url]http://did5.ru/it/windows/kak-otklyuchit-ctrl-alt-del-pri-vxode-v-windows-server-2003.html  |  Блог did5.ru[/url]
[br]
Как выключить Windows Server без залогинивания
[code]
Для того чтобы так сделать вам нужно изменить локальную политику безопасности.
Для этого откройте:

&quot;Редактор локальной групповой политики&quot; командой gpedit.msc и найдите ветку &quot;Конфигурация компьютера -&gt; Конфигурация Windows -&gt; Параметры безопасности -&gt; Локальные политики -&gt; Параметры безопасности&quot;.
Найдите политику:

&quot;Завершение работы: разрешить завершение работы системы без выполнения входа в систему&quot;
и измените её статус на Включен.
[/code]','2017-09-22','2017-09-22','192.168.56.1');

INSERT INTO notes VALUES (20,'anonymous','config, linux, xrandr','[code]
.... монитор при подключении к VGA неправильно выдает список поддерживаемых разрешений. Поэтому в стандартной утилите настройки дисплея я могу поставить разрешение не больше 1024x768. Я же хотел поставить разрешение 1600x900. Это делается так: 
 
1. Открываем консоль. Узнаем список видеовыходов и поддерживаемых разрешений для каждого выхода командой 
 
Код: [Выделить] 
xrandrУ меня выходы назывались LVDS1 (монитор ноутбука) и VGA1 (внешний монитор). 
 
2. Создаем Modeline для нужного режима: 
 
Код: [Выделить] 
cvt 1600 900 60Первые два числа — разрешение, третье — частота обновления экрана (можно не задавать, по умолчанию будет 60). Команда выдаст примерно следующее: 
 
Код: [Выделить] 
Modeline &quot;1600x900_60.00&quot;  118.25  1600 1696 1856 2112  900 903 908 934 -hsync +vsync 
3. Создаем режим: 
 
Код: [Выделить] 
xrandr  --newmode &quot;1600x900_60.00&quot;  118.25  1600 1696 1856 2112  900 903 908 934 -hsync +vsync(после --newmode вставляем вывод команды cvt без слова Modeline). 
 
4. Добавляем новый режим к нужному выходу: 
 
Код: [Выделить] 
xrandr --addmode VGA1 1600x900_60.00 
 
5. Вводим xrandr и видим, что режим добавился. Теперь можно запустить стандартную утилиту (Система &gt; Параметры &gt; Экран) и поставить всё, что нужно. Из консоли поменять разрешение монитора можно так: 
 
Код: [Выделить] 
xrandr --output VGA1 --mode 1600x900_60.00 
(Положительный эффект не гарантирую. У меня мой способ работает на одной видеокарточке, но не работает на другой (с тем же монитором), ругается на 4-м пункте. При этом под виндой в обоих можно выставить правильное разрешение.)
[/code]','2017-09-14','2017-09-14','37.193.108.45');

INSERT INTO notes VALUES (21,'anonymous','js code','[code]
//пример конструктора
function Point(x, y){
  this.x = x;
  this.y = y;
}

var topLeft = new Point(0, 0);
var topRight = new Point(100, 0);
var bottomLeft = new Point(0, 100);
var bottomRight = new Point(100, 100);

console.log(&quot;topLeft x = &quot; + topLeft.x);
console.log(&quot;topRight x = &quot; + topRight.x);
console.log(&quot;bottomLeft x = &quot; + bottomLeft.x);
console.log(&quot;bottomRight x = &quot; + bottomRight.x);

//замыкание
(function(){
	var ZList = ZList || function(options){

		//обязательный элемент здесь будет автоматически хранится версия
		// из version control
		var _repositoryRevision = &quot;$Rev$&quot;; 

		// private variables and functions
		var _init = function(){
		};

		var _build = function(target){
			return target + &quot; is building!&quot;;
		};
		
		// public interfaces
		return{
			revision:_repositoryRevision,
			build:	function(target){ 
				return _build(target); 
			}
		};
	};
	window.ZList = ZList;	
})();
---------------
использование в main.js
	var a = ZList(&quot;some options&quot;);
console.log(&quot;a.revision = &quot; + a.revision);

	var result_build = a.build(&quot;table1&quot;);
console.log(&quot;result_build = &quot; + result_build);
[/code]','2017-09-14','2017-09-14','37.193.108.45');
INSERT INTO notes VALUES (22,'anonymous','apache + mod_python','[code]
https://www.howtoforge.com/embedding-python-in-apache2-with-mod_python-debian-etch
https://wiki.archlinux.org/index.php/Mod_python_(%D0%A0%D1%83%D1%81%D1%81%D0%BA%D0%B8%D0%B9)
http://adw0rd.com/2009/08/28/modpython/
https://www.stableit.ru/2009/12/apache-modpython-centos-54.html

apt-get install libapache2-mod-python
yum install -y httpd mod_python

vi /etc/apache2/sites-available/default

        &lt;Directory /var/www/&gt;
...
		AddHandler mod_python .py
                PythonHandler mod_python.publisher
                PythonDebug On
        &lt;/Directory&gt;

vi /var/www/test_mod_python.py

def index(req):
	# req.content_type = &#39;text/plain&#39;
	req.content_type = &#39;text/html&#39;
	html = &quot;&lt;h1&gt;Test Apache2 + mod_python&lt;/h1&gt;&quot;
	req.write( html )
	test = 2+3
	return test;


------------- Python Server Pages

vi /etc/apache2/sites-available/default
        &lt;Directory /var/www/&gt;
....
                AddHandler mod_python .psp
                PythonHandler mod_python.psp
                PythonDebug On
        &lt;/Directory&gt;

PSP test script:

vi /var/www/test_mod_python.psp

&lt;html&gt;
&lt;body&gt;
&lt;%
for n1 in range(0,10):
    req.write(&quot;&lt;h1&gt;Hello Python world!&lt;/h1&gt;&quot;)
    print &quot;&lt;br&gt;&quot;
%&gt;
&lt;/body&gt;
&lt;/html&gt;
[/code]','2017-08-30','2017-08-30','37.193.108.45');

INSERT INTO notes VALUES (23,'anonymous','windows faq','[url] http://answers.microsoft.com/ru-ru/windows/forum/windows_7-files/windows-7-%D0%BA%D0%B0%D0%BA/45b99053-120e-4779-a684-7008420b83ed | url,answers.microsoft.com[/url]
[br]
[code]
Как штатными средствами вывести список файлов
1. выделить группу файлов
2. Нажать Shift (левый или правый)
3. Удерживая Shift, вызвать контекстное меню
4. Там будет команда &quot;копировать как путь&quot;. Ее и использовать.
Далее можно вставлять полные пути всех файлов в блокнот, excel, куда 
угодно.

-------------------------
Настройка отображения меню в Проводнике
«Упорядочить» ? «Представление»  - пункт «Строка меню»
[/code]','2017-08-28','2017-08-28','37.193.108.45');

INSERT INTO notes VALUES (24,'','test filter','[url]https://ruseller.com/lessons.php?rub=37&amp;id=1381 | PDO против MySQLi. Что выбрать?[/url][br]
[url]https://habrahabr.ru/post/141127/ |MySQLi раскладываем все по полочкам [/url][br]
[url]http://php.net/manual/ru/book.pdo.php | Объекты данных PHP[/url][br]','2017-08-24','2017-08-24','');

INSERT INTO notes VALUES (25,'anonymous','javascript, test Modernizr','[code]
&lt;!DOCTYPE html&gt;
&lt;!--[if lt IE 7]&gt;      &lt;html class=&#39;no-js lt-ie9 lt-ie8 lt-ie7&#39;&gt;
&lt;![endif]--&gt;
&lt;!--[if IE 7]&gt;         &lt;html class=&#39;no-js lt-ie9 lt-ie8&#39;&gt; &lt;![endif]--&gt;
&lt;!--[if IE 8]&gt;         &lt;html class=&#39;no-js lt-ie9&#39;&gt; &lt;![endif]--&gt;
&lt;!--[if gt IE 8]&gt;&lt;!--&gt; &lt;html class=&#39;no-js&#39;&gt; &lt;!--&lt;![endif]--&gt;
&lt;head&gt;
&lt;meta charset=&#39;utf-8&#39;&gt;
&lt;title&gt;test Modernizr&lt;/title&gt;
&lt;script
src=&#39;http://yastatic.net/modernizr/2.7.1/modernizr.min.js&#39;&gt;&lt;/script&gt;
&lt;/head&gt;

&lt;h1&gt;test Modernizr&lt;/h1&gt;

&lt;/html&gt;
[/code]','2017-08-24','2017-08-24','');
