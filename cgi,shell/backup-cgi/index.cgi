#!/bin/sh
echo "Content-type: text/html"
echo ""
echo "<html>
<head>
<title>create backup</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
<link href='../../css/bootstrap335.min.css' rel='stylesheet'>
</head>"
echo "<body>
<div class='container'>
	<header  class='page-header'>
		<h1>Backup sites: dump databases and pack files</h1>
	</header>
"
echo "<pre>"
uname -a
lsb_release -a
echo "user: "; whoami;
echo "Disk usage: "; df / -h;
echo "</pre>"

echo "<div class='panel'>"
echo "<ul class='list-unstyled'>"

echo "<div class='panel-body'>"
echo "<li><a class='btn btn-default' href='backup.cgi'>create new backup (local disk)</a></li>"
backup_dir="/home/samba/pub/backup"
backup_dir_alias="backup"
echo '<iframe width="100%" height="300" frameborder="0" vspace="10" hspace="10"
src="/cgi-bin/backup-cgi/list.cgi?backup_dir='${backup_dir}'&backup_dir_alias='${backup_dir_alias}'"></iframe>'
echo "</div>"

echo "<div class='panel-body'>"
echo "<li><a class='btn btn-default' href='network_backup.cgi' target='_balnk'>create new backup (network share)</a></li>"
echo "<pre>need run this terminal commands: <b>cat /etc/fstab</b><br><b>mount /mnt/net</b> </pre>"
backup_dir="/mnt/net"
backup_dir_alias="backup_net"
echo '<iframe width="100%" height="300" frameborder="no" vspace="10" hspace="10"
src="/cgi-bin/backup-cgi/list.cgi?backup_dir='${backup_dir}'&backup_dir_alias='${backup_dir_alias}'"></iframe>'
echo "</div>"

echo "</ul>"

echo "</div><!-- end container -->
</body>
</html>"