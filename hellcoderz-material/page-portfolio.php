<?php /* Template Name: Portfolio */ ?>
<?php
get_header(); ?>
<div class="col-md-3 col-xs-12">
	<?php get_sidebar(); ?>
</div>
<div class="col-md-9 col-xs-12 full">
    	<h2 class="blog-title-pro"><?php the_title(); ?></h2>
				<div class="isotope"><div>
				<?= do_shortcode('[HCZPF]'); ?>
				</div></div>
</div>
<?php get_footer(); ?>
