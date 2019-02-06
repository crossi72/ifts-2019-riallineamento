<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
 
}

	function add_test_column($columns) {
		return array_merge( $columns, 
              array('colonna_test' => __('Test')) );
	}
	add_filter('manage_posts_columns' , 'add_test_column');

	function display_test_column( $column, $post_id ) {
		if ($column == 'colonna_test'){
echo '<a href="javascript:alert(\'Colonna di prova!\');">nuova col</a>';
		}
	}
	add_action( 'manage_posts_custom_column' , 'display_test_column', 10, 2);
	
	function modifica_ordinamento_articoli($query) {
		if ( $query->is_home() ) {
			$query->set('orderby', 'post_title');
			$query->set('order', 'ASC');
		}
	return $query;
	}
	add_filter('pre_get_posts', 'modifica_ordinamento_articoli');

	function save_auto_excerpt( $post_id, $post, $update ) {
		$excerpt_post = get_the_excerpt($post_id);	
		if($excerpt_post == "") {
			$my_post_update = array(
				'ID'           => $post_id,
				'post_excerpt'   => 'Riassunto autogenerato!',
			);
			wp_update_post( $my_post_update );
		}
	}
	add_action( 'save_post', 'save_auto_excerpt', 10, 3 );
?>