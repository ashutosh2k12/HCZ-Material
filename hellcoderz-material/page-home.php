<?php /* Template Name: Homepage */ ?>
<?php
get_header(); ?>
<div class="col-md-3 col-xs-12">
	<?php get_sidebar(); ?>
</div>
    <div class="col-md-9 col-xs-12 full">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php
				get_template_part( 'content', 'home' );
			?>

		<?php endwhile; ?>

</div>
<?php get_footer(); ?>

