<?php
require_once('wp-load.php');
global $wpdb;
$table = $wpdb->prefix . 'yoast_indexable';
$count = $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE object_type='term' AND (primary_focus_keyword_score < 90 OR readability_score < 90 OR primary_focus_keyword IS NULL)");
echo "Categories NOT green: $count";
?>
