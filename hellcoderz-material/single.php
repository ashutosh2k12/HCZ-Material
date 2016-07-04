<?php
get_header(); ?>
<div class="col-md-3 col-xs-12">
	<?php get_sidebar(); ?>
</div>
<div class="col-md-9 col-xs-12 full">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

		<?php endwhile; // end of the loop. ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>