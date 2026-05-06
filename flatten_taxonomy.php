<?php
include 'wp-load.php';

// 1. Move all categories to top-level for short URLs
$terms = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);
foreach ($terms as $term) {
    if ($term->parent != 0) {
        wp_update_term($term->term_id, 'product_cat', ['parent' => 0]);
        echo "Moved '{$term->slug}' (ID: {$term->term_id}) to top level.\n";
    }
}

// 2. Assign products to main categories to ensure the main link works
$cat_cho_id = (int) get_term_by('slug', 'cho', 'product_cat')->term_id;
$cat_meo_id = (int) get_term_by('slug', 'meo', 'product_cat')->term_id;

$dog_slugs = ['thuc-an-cho-cho', 'banh-thuong-cho-cho', 've-sinh-cho', 'hat-cho-cho', 'balo-long-van-chuyen'];
$cat_slugs = ['thuc-an-meo', 'pate-meo', 'cat-meo', 'hat-cho-meo'];

function assign_products_to_parent($sub_slugs, $parent_id) {
    if (!$parent_id) return;
    foreach ($sub_slugs as $slug) {
        $term = get_term_by('slug', $slug, 'product_cat');
        if ($term) {
            $args = [
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => [[
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $term->term_id,
                ]]
            ];
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $product_id = get_the_ID();
                    $current_terms = wp_get_post_terms($product_id, 'product_cat', ['fields' => 'ids']);
                    if (!in_array($parent_id, $current_terms)) {
                        $current_terms[] = $parent_id;
                        wp_set_post_terms($product_id, $current_terms, 'product_cat');
                        echo "Assigned product $product_id to parent category $parent_id\n";
                    }
                }
            }
            wp_reset_postdata();
        }
    }
}

assign_products_to_parent($dog_slugs, $cat_cho_id);
assign_products_to_parent($cat_slugs, $cat_meo_id);

// 3. Flush rewrite rules just in case
flush_rewrite_rules();
echo "Taxonomy flattened and products synced.\n";
