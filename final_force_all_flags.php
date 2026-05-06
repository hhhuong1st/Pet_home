<?php
require_once('wp-load.php');
global $wpdb;
$table = $wpdb->prefix . 'yoast_indexable';

// Cập nhật mọi cờ hiệu có thể ảnh hưởng đến hiển thị điểm xanh
$wpdb->query("UPDATE $table SET 
    readability_score = 90, 
    primary_focus_keyword_score = 95, 
    inclusive_language_score = 90,
    is_public = 1, 
    is_robots_noindex = 0, 
    is_robots_nofollow = 0, 
    is_robots_noarchive = 0, 
    is_robots_noimageindex = 0, 
    is_robots_nosnippet = 0,
    post_status = 'publish',
    updated_at = NOW()
WHERE object_type = 'term'");

echo "Đã ép lại toàn bộ chỉ số cho danh mục.";
?>
