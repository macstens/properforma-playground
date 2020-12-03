<?php
/**
 * used for Jobs
 *
 * @package properforma-playground
 */
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="post-inner">
		<div class="entry-content">
			<div class="tags">
				<span class="all">Kategorie:</span>
				<?php foreach(get_the_category() as $category) {
					if($category->category_parent != 0) { ?>
						<span class="cats <?php echo $category->slug; ?>">
							<?php echo $category->cat_name; ?>
						</span>
					<?php }
				}
				?>
			</div>
			<h2><?php the_title(); ?></h2>
			<?php the_excerpt(); ?>

			<?php while(have_rows('artikel-download', get_the_ID())): the_row();
				$file          = get_sub_field('datei');
				$link          = get_sub_field('link');
				$downloadURL   = '';
				$downloadLabel = 'Download';

				if(get_sub_field('ist_link')) :
					$downloadURL   = $link;
					$downloadLabel = 'Zur Verlinkung';
				else :
					$downloadURL = $file['url'];
				endif; ?>
				<a href="<?php echo $downloadURL; ?>" class="link" target="_blank"><?= $downloadLabel; ?></a>
			<?php endwhile; ?>
		</div>
	</div>
</article>
