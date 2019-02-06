<?php
/**
 * Template Name: Template per custom post nella pagina
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

			endwhile; // End of the loop.

/* QUI IL CODICE PER RECUPERARE I CUSTOM POST LEZIONE */
$args = array(
	'posts_per_page'   => -1,
	'offset'           => 0,
	'orderby'          => 'date',
	'order'            => 'DESC',
	'post_type'        => 'lezione',
	'post_status'      => 'publish'
);
$posts_array = get_posts( $args );	

if(count($posts_array) > 0) {
?>
	<div style="margin-left: 200px ">
<?php
	foreach($posts_array as $lezione) {

?>
		<p>
			<a href="<?php echo(get_permalink($lezione->ID)); ?>"><strong><?php echo($lezione->post_title); ?></strong></a><br/>
			<?php echo(wp_trim_words( $lezione->post_content, 30)); ?><br/>
			Docente: <?php echo(get_post_meta($lezione->ID,"docente",true)); ?>
		</p>
<?php
	}
?>
	</div>
<?php
}
/* QUI IL CODICE PER RECUPERARE I CUSTOM POST LEZIONE */

			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
