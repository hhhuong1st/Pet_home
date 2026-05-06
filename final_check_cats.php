<?php
require_once('wp-load.php');
global $wpdb;
$table = $wpdb->prefix . 'yoast_indexable';
$results = $wpdb->get_results("SELECT object_id, primary_focus_keyword_score, readability_score FROM $table WHERE object_type='term'");
foreach($results as $r) {
    $term = get_term($r->object_id, 'product_cat');
    if ($term && !is_wp_error($term)) {
        echo "ID: {$r->object_id} | Name: {$term->name} | SEO: {$r->primary_focus_keyword_score} | Read: {$r->readability_score}\n";
    }
}
?>
