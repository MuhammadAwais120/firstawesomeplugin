<?php
/**
    * @package firstawesome-plugin
*/

if ( ! defined('WP_UNINSTALL_PLUGIN') ) {
    die;
}


//method one to delete post_type data from DB

$books = get_posts( [ 'post_type' => 'book','numberposts' => -1 ] );
foreach ($books as $book) {
        wp_delete_post( $book->ID, true );
}


//method two to delete post_type data from DB

// global $wpdb;
// $wpdb->query( " DELETE FROM wp_posts WHERE post_type = 'book' " );
// $wpdb->query( " DELETE FROM wp_postmeta WHERE post_id NOT IN( SELECT id FROM wp_posts )");
// $wpdb->query( " DELETE FROM wp_terms_relationships WHERE object_id NOT IN( SELECT id FROM wp_posts )");