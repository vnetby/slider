<?php

// global $wp_query;
// $object = get_queried_object();
//
// $cat_id = $object->term_taxonomy_id;
//
// global $wpdb;
//
// $table = $wpdb->prefix . 'term_relationships';
//
// $query = "SELECT DISTINCT `object_id` FROM $table WHERE `term_taxonomy_id` = $cat_id";
//
// $res = $wpdb->get_results( $query );
//
// $suppliers = false;
//
// if ( $res ) {
//
//   $filtered_ids = filter_publish_posts( array_column($res, 'object_id' ) );
//
//   if ( $filtered_ids ) {
//     $ids = implode(',', $filtered_ids );
//
//     $query = "SELECT DISTINCT `term_taxonomy_id` FROM $table WHERE `object_id` IN ($ids)";
//
//     $res = $wpdb->get_results( $query );
//
//     if ( $res ) {
//       $ids = array_column( $res, 'term_taxonomy_id' );
//       $suppliers = get_terms([
//         'taxonomy'   => 'product_tag',
//         'include'    => $ids,
//         'hide_empty' => false
//       ]);
//
//     }
//   }
//
// }
//
//
// if ( $suppliers ) {
//
//   foreach ( $suppliers as &$supplier ) {
//
//     $id    = (int)$supplier->term_taxonomy_id;
//     $name  = $supplier->name;
//     $query = "SELECT `object_id` FROM $table WHERE `term_taxonomy_id` = $id";
//     $res   = $wpdb->get_results( $query );
//
//     if ( $res ) {
//
//       $filter_id = filter_publish_posts( array_column( $res, 'object_id' ) );
//       if ( $filter_id ) {
//         echo '<a href="'.get_permalink($filter_id[0]).'">'.$name.'</a>';
//         echo '<hr>';
//       }
//
//     }
//
//   }
//
// } else {
//
//   echo 'no suppliers';
//
// }
