<?php get_header(); ?>
<div class="col-md-3 col-xs-12">
	<?php get_sidebar(); ?>
</div>
<div class="col-md-9 col-xs-12 full">
	
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h2 class="page-title blog-title-pro">', '</h2>' );
				?>
			</header><!-- .page-header -->
			<div class="well">
			<?php
			the_archive_description( '<div class="alert alert-dismissible alert-info"><button type="button" class="close" data-dismiss="alert">×</button>', '</div>' );
			// Start the Loop.
			while ( have_posts() ) : the_post();

			//	get_template_part( 'content', get_post_format() );
				get_template_part( 'content', 'latest-post' ); 

			// End the loop.
			endwhile;

			hcz_paging_nav();
		?>
			</div>
		<?php
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->
	
</div>
<?php get_footer(); ?>
