<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h2 class="blog-title-pro"><?php the_title(); ?></h2>
<div class="well animated fadeIn">
	<div>
	<?php
		if ( has_excerpt() || false != get_theme_mod( 'material_auto_excerpt') ) {
				the_excerpt();
			} else {
				the_content( );
		}

		the_tags( 'Tagged with: ', ' • ', '<br />' );
	?>
    </div>
</div>
</article>