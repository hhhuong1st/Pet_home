<?php
require_once('wp-load.php');
global $wpdb;
foreach($wpdb->get_results("SHOW TABLES LIKE '%yoast%'") as $t) {
    foreach($t as $k => $v) echo $v . "\n";
}
?>
