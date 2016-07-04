<?php
get_header(); ?>
<div class="col-md-3 col-xs-12">
	<?php get_sidebar(); ?>
</div>
    <div class="col-md-9 col-xs-12 full">
		<?php if ( have_posts() ) : ?>
			<?php if( ! is_singular() && get_post_type()=='post' && get_option( 'page_for_posts' ) ): ?>
			<h2 class="blog-title-pro">Latest Posts</h2>
			<div class="well">
				<?php 
					while ( have_posts() ) : the_post();
					get_template_part( 'content', 'latest-post' ); 
					endwhile; 

					hcz_paging_nav();
				?>
			</div>
			<?php
				else :
						while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );
						endwhile;
				endif;
			?>
			
		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
</div>
<?php get_footer(); ?>
