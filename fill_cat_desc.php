<?php
require_once('wp-load.php');

$cats = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);

foreach ($cats as $c) {
    $id = $c->term_id;
    $name = $c->name;
    
    // Cập nhật mô tả chính thức của WordPress cho danh mục
    // Điều này sẽ làm đầy cột "Miêu tả" trong danh sách
    wp_update_term($id, 'product_cat', [
        'description' => "Chuyên cung cấp các sản phẩm {$name} chất lượng cao, chính hãng, giá tốt nhất thị trường. Đặt hàng ngay tại Pet Shop để nhận nhiều ưu đãi hấp dẫn!"
    ]);
}
echo "Đã cập nhật mô tả cho toàn bộ danh mục.";
?>
