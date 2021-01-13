<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blank
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<h3>Categories</h3>
	<p>Click on a category to start filtering.</p>
	<?php $categories = get_categories(); ?>
	<ul class="cat-list list-group">
		<li><a class="list-group-item cat-list_item active" href="#!" data-slug=""><?php _e('All categories of jobs', 'blank'); ?></a></li>
		<li><a class="list-group-item cat-list_item" href="#!" data-slug="kajshdkahsdl">False data test</a></li>

		<?php foreach($categories as $category) : ?>
			<li>
				<a class="cat-list_item" href="#!" data-slug="<?= $category->slug; ?>">
					<?= $category->name; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>

	<div class="entry-content">
		<?php
		$jobs = new WP_Query([
			                         'post_type' => 'ppp_job',
			                         'posts_per_page' => -1,
			                         'order_by' => 'date',
			                         'order' => 'desc',
		                         ]);
		?>

		<?php if($jobs->have_posts()): ?>
			<h3>Jobs</h3>
			<ul class="tiles list-group">
				<?php
				while($jobs->have_posts()) : $jobs->the_post();
					get_template_part('template-parts/content', 'job-list-item');
				endwhile;
				?>
			</ul>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

	</div><!-- .entry-content -->

	<form role="search" method="get" id="searchform-salary" class="searchform" action="/">
		<div>
			<label for="salary">Search for max. salary:</label>
			<input type="hidden" value="" name="s" id="s-s" />
			<input type="number" value="" name="salary" id="salary" />
			<input type="submit" id="searchsubmit-s" value="Search" />
		</div>
	</form>

	<ul class="list-group" id="salary-list">
	</ul>
<p class="email">
	<?php echo wpcodex_hide_email_shortcode('', 'info@properfoma.de'); ?>
</p>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'blank' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
