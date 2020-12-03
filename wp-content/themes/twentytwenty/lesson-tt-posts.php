<?php
/**
 * Template Name: Veranstaltung
 * The template for displaying Archive pages.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package properforma-playground
 */
 ?>

<section id="site-content-posts" role="main">

	<?php
	$args = array(
		'post_type'			=> 'post',
		'posts_per_page'	=> -1,
		'orderby'			=> 'title',
		'order'				=> 'ASC',
	);

	global $wp_query;
	$wp_query = new WP_Query( $args ); ?>

	<?php if ( $wp_query->have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">Beiträge</h1>
		</header>

		<?php /* Start the Loop */ ?>

		<div>
			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<?php
				/* Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', '' );
				?>
			<?php endwhile; ?>
		</div>

		<?php wp_reset_postdata(); ?>

	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; ?>

</section>
