<?php
/**
 * Remove 404s for Landing Pages by adding them to the main query search
 */
add_action( 'pre_get_posts', function ( $query ) {
    if ( ! $query->is_main_query() || is_admin() ) {
        return;
    }

    // Only apply this logic if the query is looking for a single page/post
    if ( ! empty( $query->query['name'] ) || ! empty( $query->query['pagename'] ) ) {
        $query->set( 'post_type', array( 'post', 'page', 'landing_pages' ) );
    }
} );