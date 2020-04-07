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
<div class='container'>"

echo "<h3>Remove $QUERY_STRING</h3>"
rm $QUERY_STRING

#echo "<a href='/cgi-bin/backup-cgi/index.cgi'>index</a>"
#echo "<script>location.href='/cgi-bin/backup-cgi/index.cgi'</script>";

echo "</div><!-- end container -->
</body>
</html>"