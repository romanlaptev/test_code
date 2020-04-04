#!/bin/sh
uname -a
echo "Test MySQL connection"
echo "\n"

mysqlshow --host=localhost --user=root --password=master --verbose
#mysqladmin -uroot -pmaster version
#mysql -uroot -pmaster < test_mysql.sql

