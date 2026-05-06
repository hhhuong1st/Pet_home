<?php
require_once('wp-load.php');
global $wpdb;
$table = $wpdb->prefix . 'yoast_indexable';
foreach($wpdb->get_results("DESCRIBE $table") as $f) echo $f->Field . "\n";
?>
