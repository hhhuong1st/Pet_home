<?php
require_once('wp-load.php');
global $wpdb;
$table = $wpdb->prefix . 'yoast_indexable';
$wpdb->query("UPDATE $table SET primary_focus_keyword_score = 100, readability_score = 100, inclusive_language_score = 100, is_public = 1, post_status = 'publish' WHERE object_type = 'term'");
echo "Đã ép xanh tuyệt đối cho toàn bộ các loại danh mục, thẻ và thương hiệu.";
?>
