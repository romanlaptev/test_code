#!/bin/sh
echo "Content-type: text/html"
echo ""
uname -a
echo "<h3>Test MySQL connection</h3>"
echo "<pre>"

mysqlshow --host=localhost --user=root --password=master --verbose
mysqladmin -uroot -pmaster version
mysql -uroot -pmaster < test_mysql.sql
mysql -uroot -pmaster < test_mysql_create.sql

echo "<pre>"
