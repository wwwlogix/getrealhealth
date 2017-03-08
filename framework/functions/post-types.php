<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

// Should be inited before the visual composer (that is 9)
$casestudy_slug = wlgx_get_option( 'casestudy_slug', 'casestudy' );
add_action( 'init', 'wlgx_create_post_types', 8 );
function wlgx_create_post_types() {
	// casestudy post type
	global $casestudy_slug;
	if ( $casestudy_slug == '' ) {
		$casestudy_rewrite = array( 'slug' => FALSE, 'with_front' => FALSE );
	} else {
		$casestudy_rewrite = array( 'slug' => untrailingslashit( $casestudy_slug ) );
	}
	register_post_type(
		'wlgx_casestudy', array(
			'labels' => array(
				'name' => __( 'casestudy Items', 'wlgx' ),
				'singular_name' => __( 'casestudy Item', 'wlgx' ),
				'add_new' => __( 'Add casestudy Item', 'wlgx' ),
				'add_new_item' => __( 'Add casestudy Item', 'wlgx' ),
				'edit_item' => __( 'Edit casestudy Item', 'wlgx' ),
			),
			'public' => TRUE,
			'rewrite' => $casestudy_rewrite,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'comments' ),
			'capability_type' => 'wlgx_casestudy',
			'map_meta_cap' => TRUE,
			'menu_icon' => 'dashicons-images-alt',
		)
	);
	
	register_post_type( 'news-releases',
			array(
				'labels' => array(
					'name' => 'News Releases',
					'singular_name' => 'News Release',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New News Release',
					'edit' => 'Edit',
					'edit_item' => 'Edit Item',
					'new_item' => 'New Item',
					'view' => 'View',
					'view_item' => 'View Item',
					'search_items' => 'Search',
					'not_found' => 'No items found',
					'not_found_in_trash' => 'No items found in Trash',
					'parent' => 'Parent Item'
				),

				'public' => true,
				'capability_type' => 'post',
				'menu_position' => 20,
				'supports' => array( 'title', 'editor'),
				'taxonomies' => array( '' ),
				//'menu_icon' => plugins_url( 'img/admin-icon.png', __FILE__ ),
				'has_archive' => true,
				'hierarchical' => true
			)
		);
		
	register_post_type( 'publications-media',
			array(
				'labels' => array(
					'name' => 'Publications & Media',
					'singular_name' => 'Publication & Media Post',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New Publication & Media',
					'edit' => 'Edit',
					'edit_item' => 'Edit Item',
					'new_item' => 'New Item',
					'view' => 'View',
					'view_item' => 'View Item',
					'search_items' => 'Search Publication & Media',
					'not_found' => 'No items found',
					'not_found_in_trash' => 'No items found in Trash',
					'parent' => 'Parent Item'
				),

				'public' => true,
				'capability_type' => 'post',
				'menu_position' => 22,
				'supports' => array( 'title', 'editor'),
				'taxonomies' => array( '' ),
				'has_archive' => true,
				'hierarchical' => true
			)
		);
		
	register_post_type(
		'wlgx_testimonial', array(
			'labels' => array(
				'name' => __( 'Testimonials', 'wlgx' ),
				'singular_name' => __( 'Testimonial', 'wlgx' ),
				'add_new' => __( 'Add Testimonial', 'wlgx' ),
				'add_new_item' => __( 'Add Testimonial', 'wlgx' ),
				'edit_item' => __( 'Edit Testimonial', 'wlgx' ),
				'featured_image' => __( 'Author Photo', 'wlgx' ),
			),
			'show_ui' => TRUE,
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'menu_icon' => 'dashicons-testimonial',
		)
	);

	// casestudy categories
	register_taxonomy(
		'wlgx_casestudy_category', array( 'wlgx_casestudy' ), array(
			'hierarchical' => TRUE,
			'label' => __( 'casestudy Categories', 'wlgx' ),
			'singular_label' => __( 'casestudy Category', 'wlgx' ),
			'rewrite' => array( 'slug' => wlgx_get_option( 'casestudy_category_slug', 'casestudy_category' ) ),
		)
	);
	
	register_taxonomy(
		'pub-media-category',
		'publications-media',
		array(
			'labels' => array(
				'name' => 'Categories',
				'add_new_item' => 'Add New Category',
				'new_item_name' => "New Category"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);
	
	
	// casestudy slug may have changed, so we need to keep WP's rewrite rules fresh
	if ( get_transient( 'wlgx_flush_rules' ) ) {
		flush_rewrite_rules();
		delete_transient( 'wlgx_flush_rules' );
	}
}

add_filter( 'manage_wlgx_casestudy_posts_columns', 'wlgx_manage_casestudy_columns' );
function wlgx_manage_casestudy_columns( $columns ) {
	$columns['wlgx_casestudy_category'] = __( 'Categories', 'wlgx' );
	if ( isset( $columns['comments'] ) ) {
		$title = $columns['comments'];
		unset( $columns['comments'] );
		$columns['comments'] = $title;
	}
	if ( isset( $columns['date'] ) ) {
		$title = $columns['date'];
		unset( $columns['date'] );
		$columns['date'] = $title;
	}

	return $columns;
}

add_action( 'manage_wlgx_casestudy_posts_custom_column', 'wlgx_manage_casestudy_custom_column', 10, 2 );
function wlgx_manage_casestudy_custom_column( $column_name, $post_id ) {
	if ( $column_name == 'wlgx_casestudy_category' ) {
		if ( ! $terms = get_the_terms( $post_id, $column_name ) ) {
			echo '<span class="na">&ndash;</span>';
		} else {
			$termlist = array();
			foreach ( $terms as $term ) {
				$termlist[] = '<a href="' . admin_url( 'edit.php?' . $column_name . '=' . $term->slug . '&post_type=wlgx_casestudy' ) . ' ">' . $term->name . '</a>';
			}

			echo implode( ', ', $termlist );
		}
	}
}

// TODO Move to a separate plugin for proper action order, and remove page refreshes
add_action( 'admin_init', 'wlgx_add_theme_caps' );
function wlgx_add_theme_caps() {
	global $wp_post_types;
	$role = get_role( 'administrator' );
	$force_refresh = FALSE;
	$custom_post_types = array( 'wlgx_casestudy', 'wlgx_client' );
	foreach ( $custom_post_types as $post_type ) {
		if ( ! isset( $wp_post_types[$post_type] ) ) {
			continue;
		}
		foreach ( $wp_post_types[$post_type]->cap as $cap ) {
			if ( ! $role->has_cap( $cap ) ) {
				$role->add_cap( $cap );
				$force_refresh = TRUE;
			}
		}
	}
	if ( $force_refresh AND current_user_can( 'manage_options' ) AND ! isset( $_COOKIE['wlgx_cap_page_refreshed'] ) ) {
		// To prevent infinite refreshes when the DB is not writable
		setcookie( 'wlgx_cap_page_refreshed' );
		header( 'Refresh: 0' );
	}
}

if ( strpos( $casestudy_slug, '%wlgx_casestudy_category%' ) !== FALSE ) {
	function wlgx_casestudy_link( $post_link, $id = 0 ) {
		$post = get_post( $id );
		if ( is_object( $post ) ) {
			$terms = wp_get_object_terms( $post->ID, 'wlgx_casestudy_category' );
			if ( $terms ) {
				return str_replace( '%wlgx_casestudy_category%', $terms[0]->slug, $post_link );
			}
		}

		return $post_link;
	}

	add_filter( 'post_type_link', 'wlgx_casestudy_link', 1, 3 );
} elseif ( $casestudy_slug == '' ) {
	function wlgx_casestudy_remove_slug( $post_link, $post, $leavename ) {
		if ( 'wlgx_casestudy' != $post->post_type || 'publish' != $post->post_status ) {
			return $post_link;
		}
		$post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

		return $post_link;
	}

	add_filter( 'post_type_link', 'wlgx_casestudy_remove_slug', 10, 3 );

	function wlgx_casestudy_parse_request( $query ) {
		if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
			return;
		}
		if ( ! empty( $query->query['name'] ) ) {
			$query->set( 'post_type', array( 'post', 'wlgx_casestudy', 'page' ) );
		}
	}

	add_action( 'pre_get_posts', 'wlgx_casestudy_parse_request' );
}
