<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

$module_name = "zip";
$loadedExt = get_loaded_extensions();
if ( !in_array( $module_name, $loadedExt ) ) {
	$msg = "<p>-- error, <b>".$module_name."</b> module  is not in the list of loaded extensions...</p>\n";
	echo $msg;
echo "loaded extensions: <pre>";
print_r( $loadedExt );
echo "</pre>";
	exit;
}

echo "Extract zip archive<br>\n";

//$zip = new ZipArchive;
//$zip->open('../uploads/drupal-6.22.zip');
//$zip->extractTo("../");
//$zip->close();
$zip = new ZipArchive;
//$location_arc = '../uploads/';
$location_arc = '../';
$unzip_path = "../";

/*
$location_arc = '../drupal/sites/';
$unzip_path = "../drupal/sites/";

$filename = $location_arc."cck-6.x-2.9.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$filename = $location_arc."filefield-6.x-3.10.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$filename = $location_arc."imagefield-6.x-3.10.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$filename = $location_arc."imageapi-6.x-1.10.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$filename = $location_arc."imagecache-6.x-2.0-beta12.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$filename = $location_arc."imagecache_actions-6.x-1.8.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$filename = $location_arc."imagecache_profiles-6.x-1.3.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$filename = $location_arc."image-6.x-1.1.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$filename = $location_arc."transliteration-6.x-3.0.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$filename = $location_arc."views-6.x-2.12.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$filename = $location_arc."lightbox2-6.x-1.11.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$filename = $location_arc."node_export-6.x-2.24.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$filename = $location_arc."taxonomy_image-6.x-1.6.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";
*/

/*
$filename = $location_arc."views_bonus-6.x-1.1.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$filename = $location_arc."views_data_export-6.x-2.0-beta5.zip";
$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";
*/

//$filename = $location_arc."modx-1.0.0_evo.zip";
//$filename = $location_arc."drupal-6.22.zip";
//$filename = $location_arc."25-05-2012_kanistra_files.zip";
$filename = $location_arc."Joomla_2.5.6.zip";

$zip->open($filename);
$zip->extractTo($unzip_path);
echo "Unzip ".$filename." in ".$unzip_path;
echo "<br>";

$zip->close();

?>
