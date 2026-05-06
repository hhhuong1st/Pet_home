<?php
include 'wp-load.php';
$terms = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);
echo "ALL CATEGORIES:\n";
foreach ($terms as $term) {
    echo " - " . $term->name . " (Slug: " . $term->slug . ") [ID: " . $term->term_id . "] [Parent: " . $term->parent . "]\n";
}
