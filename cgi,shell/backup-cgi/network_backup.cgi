#!/bin/bash
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
		<h1>create backup (network share)</h1>
	</header>"
echo "<a href='/cgi-bin/backup-cgi/index.cgi'>index</a>"

echo "<pre>"
ping -c 3 192.168.56.1
#echo $?
if [ $? -ne "0" ]; then
	echo "error!, ping failed"
	exit 1
else
	echo "continue backup"
fi

mount /mnt/net
#ls /mnt/net
echo "</pre>"
#**************** FUNCTIONS ****************
backup_db()
{
	db_name=$1
	echo "<h2>-- dump database $db_name</h2>"
	
	mv ${backup_dir}/${db_name}.sql.gz ${backup_dir}/1.${db_name}.sql.gz
	mysqldump --user=${user_db} --password=${password} --database ${db_name} | gzip > "${backup_dir}/DUMP_${db_name}.sql.gz"
	
	#mysqldump --user=${user_db} --password=${password} --database ${db_name} > "${backup_dir}/${db_name}.sql"
	#cd ${backup_dir}
	#zip "${db_name}_${DATE}.sql.zip" "${db_name}.sql"
	#rm "${backup_dir}/${db_name}_${DATE}.sql"

#upload_file ${backup_dir} ${site_name}_files.zip ${db_name}.sql.gz
	#mysqldump --user=${user_db} --password=${password} --all-databases | bzip2 > "${backup_dir}/dump.sql.bz2"
}
#end func

backup_files()
{
	location=$1
	arc_filename=$2

	echo "<h2>-- backup $location files</h2>"
	mv ${backup_dir}/${arc_filename} ${backup_dir}/1.${arc_filename}
	cd $location
	zip -r ${backup_dir}/${arc_filename} ./
}
#end func

#**************** MAIN ****************
#CONFIG
backup_dir="/mnt/net"
echo "<p><b>backup_dir:</b>" ${backup_dir} "</p>"

backup_dir_alias="backup_net"
echo "<p><b>backup_dir_alias:</b>" ${backup_dir_alias} "</p>"

db_dir="/home/db"
user_db="root"
password="master"

echo "<p><b>MySQL db_dir:</b>" ${db_dir} "</p>"
echo "<pre>"
mysqlshow --host=localhost --user=${user_db} --password=${password} --verbose
echo "</pre>"

DATE=`date "+%F-%H-%M"`


#=========================================== BACKUP DB
#backup_db mydb
	backup_db art
#echo "<a href='/${backup_dir_alias}/art.sql.gz'>download art.sql.gz</a>"

# #backup_db gravura
	backup_db photoalbum
# #backup_db lib
# #backup_db video
#	backup_db music
# #backup_db modx
# backup_db webpad
# backup_db wp


#========================================== BACKUP FILES
echo "<pre>"

location=/home/www/cgi-bin
arc_filename=cgi-bin_files.zip
backup_files $location $arc_filename

location=/home/www/sites
arc_filename=sites_files.zip
backup_files $location $arc_filename

location=/home/www/php
arc_filename=php_code.zip
backup_files $location $arc_filename

#	location=/home/www/Rails
#	arc_filename=rails_code.zip
#	mv ${backup_dir}/${arc_filename} ${backup_dir}/1.${arc_filename}
#	cd $location
#	zip -r ${backup_dir}/${arc_filename} ./


echo "</pre>"

echo "<h2>All done...</h2>"
echo "***********" >> ${backup_dir}/report.txt
echo "Run backup " >> ${backup_dir}/report.txt
date >> ${backup_dir}/report.txt
echo "***********" >> ${backup_dir}/report.txt

#LIST
echo '<iframe width="100%" height="300" 
src="/cgi-bin/backup-cgi/list.cgi?backup_dir='${backup_dir}'&backup_dir_alias='${backup_dir_alias}'"></iframe>'

echo "
</div><!-- end container -->
</body>
</html>"
