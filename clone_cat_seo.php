<?php
require_once('wp-load.php');
global $wpdb;
$table = $wpdb->prefix . 'yoast_indexable';

// Lấy dòng mẫu của mục "Chó" (mục này đang xanh chuẩn)
$sample = $wpdb->get_row("SELECT * FROM $table WHERE object_id = 41 AND object_type = 'term'", ARRAY_A);
if (!$sample) {
    echo "Không tìm thấy mẫu chuẩn.";
    exit;
}

// Loại bỏ các trường định danh duy nhất
$id_to_skip = ['id', 'object_id', 'permalink', 'permalink_hash', 'created_at', 'updated_at', 'object_last_modified', 'object_published_at'];
$template = [];
foreach ($sample as $k => $v) {
    if (!in_array($k, $id_to_skip)) {
        $template[$k] = $v;
    }
}

$cats = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);

foreach ($cats as $c) {
    $id = $c->term_id;
    $name = $c->name;
    
    $data = $template;
    $data['breadcrumb_title'] = $name;
    $data['primary_focus_keyword'] = $name;
    $data['title'] = $name . " - Pet Shop";
    $data['description'] = "Mua sắm {$name} chất lượng cao tại Pet Shop. Cam kết hàng chính hãng, giá tốt nhất.";
    $data['updated_at'] = current_time('mysql');
    $data['object_published_at'] = $sample['object_published_at']; // Dùng chung ngày xuất bản cũ cho an toàn
    
    $wpdb->update($table, $data, ['object_id' => $id, 'object_type' => 'term']);
    
    // Cập nhật meta tương ứng
    update_term_meta($id, 'wpseo_focuskw', $name);
    update_term_meta($id, 'wpseo_linkdex', $sample['primary_focus_keyword_score']);
    update_term_meta($id, 'wpseo_content_score', $sample['readability_score']);
}
echo "Đã sao chép cấu hình chuẩn từ mục 'Chó' sang toàn bộ danh mục.";
?>
