<?
echo "test!";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.cookie.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('ul#my-menu ul').each(function(i) { // Check each submenu:
		if ($.cookie('submenuMark-' + i)) {  // If index of submenu is marked in cookies:
			$(this).show().prev().removeClass('collapsed').addClass('expanded'); // Show it (add apropriate classes)
		}else {
			$(this).hide().prev().removeClass('expanded').addClass('collapsed'); // Hide it
		}
		$(this).prev().addClass('collapsible').click(function() { // Attach an event listener
			var this_i = $('ul#my-menu ul').index($(this).next()); // The index of the submenu of the clicked link
			if ($(this).next().css('display') == 'none') {
				
				// When opening one submenu, we hide all same level submenus:
				$(this).parent('li').parent('ul').find('ul').each(function(j) {
					if (j != this_i) {
						$(this).slideUp(200, function () {
							$(this).prev().removeClass('expanded').addClass('collapsed');
							cookieDel($('ul#my-menu ul').index($(this)));
						});
					}
				});
				// :end
				
				$(this).next().slideDown(200, function () { // Show submenu:
					$(this).prev().removeClass('collapsed').addClass('expanded');
					cookieSet(this_i);
				});
			}else {
				$(this).next().slideUp(200, function () { // Hide submenu:
					$(this).prev().removeClass('expanded').addClass('collapsed');
					cookieDel(this_i);
					$(this).find('ul').each(function() {
						$(this).hide(0, cookieDel($('ul#my-menu ul').index($(this)))).prev().removeClass('expanded').addClass('collapsed');
					});
				});
			}
		return false; // Prohibit the browser to follow the link address
		});
	});
});
function cookieSet(index) {
	$.cookie('submenuMark-' + index, 'opened', {expires: null, path: '/'}); // Set mark to cookie (submenu is shown):
}
function cookieDel(index) {
	$.cookie('submenuMark-' + index, null, {expires: null, path: '/'}); // Delete mark from cookie (submenu is hidden):
}
</script>
<style type="text/css">
	ul.sample-menu { padding:0;margin:10px 15px; }
	ul.sample-menu li { padding:2px 0;margin:0;list-style:none; }
	ul.sample-menu li ul { padding:0;margin:0 0 0 15px; }
	ul#my-menu a { padding-left:8px; }
	ul#my-menu a.collapsed { background:url('collapsed.gif') left 6px no-repeat; }
	ul#my-menu a.expanded { background:url('expanded.gif') left 6px no-repeat; }
</style>
</head>
<body>
<ul id="my-menu" class="sample-menu">
	<li><a href="http://vbox6/temp/exp_menu1/submenu_jquery.php">Главная</a></li>
	<li><a href="http://vbox6/temp/exp_menu1/submenu_jquery.php">О компании</a>
		<ul><li><a href="http://vbox6/temp/exp_menu1/submenu_jquery.php">История</a></li>
			<li><a href="http://vbox6/temp/exp_menu1/submenu_jquery.php">Настоящее</a></li>
			<li><a href="http://vbox6/temp/exp_menu1/submenu_jquery.php">Будущее</a></li></ul></li>
	<li><a href="#0">Контакты</a></li>
	<li><a href="#0">Продукция</a>
		<ul><li><a href="#0">Мясные продукты</a>
				<ul><li><a href="#0">Колбаса</a></li>
					<li><a href="#0">Сосиски и сардельки</a></li>
					<li><a href="#0">Деликатесы</a></li></ul></li>
			<li><a href="#0">Алкоголь</a><ul>
					<li><a href="#0">Вино</a></li>
					<li><a href="#0">Водка</a></li>
					<li><a href="#0">Пиво</a></li></ul></li></ul></li>
</body>
<html>