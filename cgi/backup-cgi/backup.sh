#!/bin/sh
backup_db()
{
	db_name=$1
	#echo "-- backup database $db_name"
	echo "<h1>backup database $db_name</h1>"
	
	mv ${backup_dir}/${db_name}.sql.gz ${backup_dir}/1.${db_name}.sql.gz
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
	echo "-- backup $site_name files"
	mv ${backup_dir}/${site_name}_files.zip ${backup_dir}/1.${site_name}_files.zip
	cd $location_sites
	zip -r ${backup_dir}/${site_name}_files.zip ${site_name}
}
# end func

#*******************************************************************
# MAIN PROGRAM
#*******************************************************************

# CONFIG
#backup_dir="/mnt/disk2/0_backup"
backup_dir="/home/samba/pub/backup"
#db_dir="/mnt/disk2/documents/0_sites/0_db"
db_dir="/home/db"
user_db="root"
password="master"
DATE=`date "+%F-%H-%M"`

mkdir ${backup_dir}

# BACKUP DB
echo "Backup database"
#backup_db mydb
backup_db art

echo "done..."
ls -lh ${backup_dir}

echo "***********" >> ${backup_dir}/report.txt
date >> ${backup_dir}/report.txt
echo "Run backup " >> ${backup_dir}/report.txt
echo "***********" >> ${backup_dir}/report.txt

chmod -R 777 ${backup_dir}
#*******************************************************************
exit

# BACKUP FILES
echo "Backup sites directory"
location=/home/www/sites
	arc_filename=sites_files.zip
	mv ${backup_dir}/${arc_filename} ${backup_dir}/1.${arc_filename}.zip
	cd $location
	zip -r ${backup_dir}/${arc_filename} ./
exit

#backup_db gravura
backup_db photoalbum
#backup_db lib
#backup_db video
#backup_db music
#backup_db modx
backup_db webpad
backup_db wp

	mv ${backup_dir}/db_files.zip ${backup_dir}/1.db_files.zip
	cd $db_dir/sqlite
	zip -r ${backup_dir}/db_files.zip ./


	echo "Backup pages dir "
	location=/mnt/terra/clouds/Yandex.Disk/sync/pages
	arc_filename=pages_files.zip
	mv ${backup_dir}/${arc_filename} ${backup_dir}/1.${arc_filename}.zip
	cd $location
	zip -r ${backup_dir}/${arc_filename} ./

	echo "Backup documents"
	location=/mnt/terra/clouds/0_data/documents
	arc_filename=my_documents.zip
	mv ${backup_dir}/${arc_filename} ${backup_dir}/1.${arc_filename}.zip
	cd $location
	zip -r ${backup_dir}/${arc_filename} ./
	
	location=/mnt/terra/clouds/Yandex.Disk/sync/docs
	arc_filename=docs.zip
	mv ${backup_dir}/${arc_filename} ${backup_dir}/1.${arc_filename}.zip
	cd $location
	zip -r ${backup_dir}/${arc_filename} ./

	echo "Backup sources"
	location=/mnt/terra/clouds/Yandex.Disk/sync/0_source
	arc_filename=source.zip
	mv ${backup_dir}/${arc_filename} ${backup_dir}/1.${arc_filename}.zip
	cd $location
	zip -r ${backup_dir}/${arc_filename} ./

	echo "Backup config settings"
	location=/mnt/terra/clouds/Yandex.Disk/sync/0_config
	arc_filename=config.zip
	mv ${backup_dir}/${arc_filename} ${backup_dir}/1.${arc_filename}.zip
	cd $location
	zip -r ${backup_dir}/${arc_filename} ./

#====================================================== COPY BOOKMARKS
#	mv ${backup_dir}/bookmarkbackups.zip ${backup_dir}/1.bookmarkbackups.zip
#	bookmark_dir=".."
#	bookmark_dir=$(find /home/roman -name bookmarkbackups)
#echo $bookmark_dir
#	cd $bookmark_dir
#	cd ../
#	zip -r ${backup_dir}/bookmarkbackups.zip bookmarkbackups
#	zip ${backup_dir}/bookmarkbackups.zip places.sqlite
#======================================================

