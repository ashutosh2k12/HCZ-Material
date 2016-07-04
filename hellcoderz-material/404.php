<?php
get_header(); ?>
<div class="col-md-3 col-xs-12">
	<?php get_sidebar(); ?>
</div>
<div class="col-md-9 col-xs-12 full">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h2 class="page-title blog-title-pro"><?php _e( 'Oops! That page can&rsquo;t be found.', 'hellcoderz-material' ); ?></h2>
				</header><!-- .page-header -->

				<div class="well age-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'hellcoderz-material' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- .site-main -->
	</div><!-- .content-area -->
</div>
<?php get_footer(); ?>
