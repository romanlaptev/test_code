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
<div class=''>"
#echo $QUERY_STRING

#**************** FUNCTIONS ****************
list_folder()
{
	backup_dir=$1
	backup_dir_alias=$2
echo "
		<div class='panel panel-primary'>
			<div class='panel-heading'>
				<h3>list of ${backup_dir}</h3>
			</div>
			<div class='panel-body'>"
echo "<p>
index of /${backup_dir_alias} <small>(${backup_dir})</small>
</p>"
echo "<ul class='list-group'>"
for x in ${backup_dir}/*
	do
		if  [ -d  $x ]
			then 
echo "<li class='list-group-item'><b>[$x]</b></li>"
#stat -c "0"%a $x; 
			else 
echo "<li class='list-group-item'>"
echo "<b>${x##*/}</b>"; 
stat -c "| 0"%a $x
stat -c "| "%y $x; 
stat -c "| "%s" bytes" $x; 
#stat -f %Sm $x; 
#echo ", ";


#stat -f %z $x; 
#echo " bytes";
echo "<a href='/${backup_dir_alias}/${x##*/}' target='_blank'>download</a> | "
echo "<a href='/cgi-bin/backup-cgi/rm.cgi?$x'>remove</a></li>"

echo "</li>"; 
		fi
	done
echo "</ul>"
echo "			
			</div>
		</div>"
}
# end func


#**************** MAIN ****************
IFS='=&'
set -- $QUERY_STRING
backup_dir=$2
backup_dir_alias=$4
list_folder $2 $4

#echo "<a href='/cgi-bin/backup-cgi/index.cgi'>index</a>"
#echo "<script>location.href='/cgi-bin/backup-cgi/index.cgi'</script>";

echo "</div><!-- end container -->
</body>
</html>"