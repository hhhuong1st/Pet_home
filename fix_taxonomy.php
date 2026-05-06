<?php
include 'wp-load.php';

function get_or_create_term($name, $slug) {
    $term = get_term_by('slug', $slug, 'product_cat');
    if (!$term) {
        $term = get_term_by('name', $name, 'product_cat');
    }
    if (!$term) {
        $result = wp_insert_term($name, 'product_cat', ['slug' => $slug]);
        if (!is_wp_error($result)) {
            $term = get_term($result['term_id'], 'product_cat');
        }
    }
    return $term;
}

// 1. Create main categories
$cat_cho = get_or_create_term('Chó', 'cho');
$cat_meo = get_or_create_term('Mèo', 'meo');
$cat_smart = get_or_create_term('Thiết Bị Thông Minh', 'thiet-bi-thong-minh');

if ($cat_cho) echo "Main Cat 'Chó' ID: " . $cat_cho->term_id . "\n";
if ($cat_meo) echo "Main Cat 'Mèo' ID: " . $cat_meo->term_id . "\n";
if ($cat_smart) echo "Main Cat 'Smart' ID: " . $cat_smart->term_id . "\n";

// 2. Map existing categories to parents
$map = [
    // Dogs
    'thuc-an-cho-cho' => $cat_cho->term_id,
    'banh-thuong-cho-cho' => $cat_cho->term_id,
    've-sinh-cho' => $cat_cho->term_id,
    'hat-cho-cho' => $cat_cho->term_id, // hat-cho-cho was child of 30, but moving to main 'cho' is cleaner or keep nested?
    'balo-long-van-chuyen' => $cat_cho->term_id,
    
    // Cats
    'thuc-an-meo' => $cat_meo->term_id,
    'pate-neo' => $cat_meo->term_id,
    'cat-meo' => $cat_meo->term_id,
];

// Note: ID 38 (hat-cho-cho) was child of 30. Better to keep that nesting but move 30 under 'cho'.
// So let's just move the PARENTS under the new main categories.

$parents_to_move = [
    'thuc-an-cho-cho' => $cat_cho->term_id,
    'banh-thuong-cho-cho' => $cat_cho->term_id,
    've-sinh-cho' => $cat_cho->term_id,
    'balo-long-van-chuyen' => $cat_cho->term_id,
    
    'thuc-an-meo' => $cat_meo->term_id,
    'pate-neo' => $cat_meo->term_id,
    'cat-meo' => $cat_meo->term_id,
];

foreach ($parents_to_move as $slug => $parent_id) {
    if ($parent_id) {
        $term = get_term_by('slug', $slug, 'product_cat');
        if ($term && $term->parent == 0) {
            wp_update_term($term->term_id, 'product_cat', ['parent' => $parent_id]);
            echo "Moved '$slug' under ID $parent_id\n";
        }
    }
}
