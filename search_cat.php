<?php
include 'wp-load.php';
$term = get_term_by('name', 'Chó', 'product_cat');
if ($term) {
    echo "Found: " . $term->name . " - Slug: " . $term->slug . " - ID: " . $term->term_id . "\n";
} else {
    echo "Not found by name 'Chó'\n";
}
$term2 = get_term_by('slug', 'cho', 'product_cat');
if ($term2) {
    echo "Found by slug 'cho': " . $term2->name . " - ID: " . $term2->term_id . "\n";
} else {
    echo "Not found by slug 'cho'\n";
}
