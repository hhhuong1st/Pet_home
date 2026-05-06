<?php
require_once('wp-load.php');
global $wpdb;
$table = $wpdb->prefix . 'yoast_indexable';
$res = $wpdb->get_results("SELECT object_id, primary_focus_keyword_score, readability_score, primary_focus_keyword FROM $table WHERE object_type='term' AND (primary_focus_keyword_score < 90 OR readability_score < 90 OR primary_focus_keyword IS NULL)");

foreach($res as $r) {
    $term = get_term($r->object_id);
    echo "ID: {$r->object_id} | Name: " . ($term ? $term->name : 'Unknown') . " | Tax: " . ($term ? $term->taxonomy : 'N/A') . " | SEO: {$r->primary_focus_keyword_score} | Read: {$r->readability_score}\n";
}
?>
