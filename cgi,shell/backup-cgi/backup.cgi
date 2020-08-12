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
		<h1>create backup (local disk)</h1>
	</header>
"
#**************** FUNCTIONS ****************
backup_db()
{
	db_name=$1
	echo "<h2>-- dump database $db_name</h2>"
	
	#mv ${backup_dir}/${db_name}.sql.gz ${backup_dir}/1.${db_name}.sql.gz
	mysqldump --user=${user_db} --password=${password} --database ${db_name} | gzip > "${backup_dir}/${db_name}.sql.gz"
	
	#mysqldump --user=${user_db} --password=${password} --database ${db_name} > "${backup_dir}/${db_name}.sql"
	#cd ${backup_dir}
	#zip "${db_name}_${DATE}.sql.zip" "${db_name}.sql"
	#rm "${backup_dir}/${db_name}_${DATE}.sql"

#upload_file ${backup_dir} ${site_name}_files.zip ${db_name}.sql.gz
	#mysqldump --user=${user_db} --password=${password} --all-databases | bzip2 > "${backup_dir}/dump.sql.bz2"
}
# end func

backup_files()
{
	site_name=$1
	#echo "-- backup $site_name files"
	echo "<h2>-- backup $site_name files</h2>"
	#mv ${backup_dir}/${site_name}_files.zip ${backup_dir}/1.${site_name}_files.zip
	cd $location_sites
	zip -r ${backup_dir}/${site_name}_files.zip ${site_name}
}
# end func

#**************** MAIN ****************
#CONFIG

backup_dir="/home/samba/pub/backup"
echo "<p><b>backup_dir:</b>" ${backup_dir} "</p>"

backup_dir_alias="backup"
echo "<p><b>backup_dir_alias:</b>" ${backup_dir_alias} "</p>"

db_dir="/home/db"
user_db="root"
password="master"

echo "<p><b>MySQL db_dir:</b>" ${db_dir} "</p>"
echo "<pre>"
mysqlshow --host=localhost --user=${user_db} --password=${password} --verbose
echo "</pre>"

DATE=`date "+%F-%H-%M"`

echo "<pre>"
echo "user: "; whoami;
echo "Disk usage: "; df / -h;
echo "</pre>"

echo "<pre>"
mkdir ${backup_dir}

# BACKUP DB
#backup_db mydb
backup_db art
#echo "<a href='/${backup_dir_alias}/art.sql.gz'>download art.sql.gz</a>"

# #backup_db gravura
# backup_db photoalbum
# #backup_db lib
# #backup_db video
# backup_db music
# #backup_db modx
# backup_db webpad
# backup_db wp

# BACKUP FILES
location=/home/www/sites
arc_filename=sites_files.zip
mv ${backup_dir}/${arc_filename} ${backup_dir}/1.${arc_filename}
cd $location
zip -r ${backup_dir}/${arc_filename} ./
#echo "<a href='/${backup_dir_alias}/${arc_filename}'>download ${arc_filename}</a>"

echo "<h2>All done...</h2>"
echo "***********" >> ${backup_dir}/report.txt
echo "Run backup " >> ${backup_dir}/report.txt
date >> ${backup_dir}/report.txt
echo "***********" >> ${backup_dir}/report.txt
chmod -R 777 ${backup_dir}
ls -lh ${backup_dir}

echo "</pre>"

#LIST
echo "Disk usage: "; df / -h;

echo "<p>index of /${backup_dir_alias} <small>(${backup_dir})</small></p>"
echo "<ul>"
for x in ${backup_dir}/*
	do
		if  [ -d  $x ]
			then 
echo "[$x]"
#stat -c "0"%a $x; 
			else 
echo "<li><a href="/${backup_dir_alias}/${x##*/}"><b>${x##*/}</b></a>"; stat -c "0"%a $x;
#stat -f %Sm $x; 
#echo ", ";

#stat -f %z $x; 
#echo " bytes";
echo "<a href=/cgi-bin/backup-cgi/rm.cgi?$x>remove archive</a></li>"
echo "</li>"; 
		fi
	done
echo "</ul>"
echo "<a href='/cgi-bin/backup-cgi/index.cgi'>index</a>"

#echo "<script>location.href='/cgi-bin/backup-cgi/index.cgi'</script>";
echo "</body>"
echo "</html>"