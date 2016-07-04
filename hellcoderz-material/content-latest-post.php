<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h4 class="home-subtitle"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
<div class="article-post">
	<?php hcz_post_thumbnail(); ?>
	<?php
		if ( has_excerpt() || false != get_theme_mod( 'material_auto_excerpt') ) {
				the_excerpt( );
			} else {
				the_content( );
		}
	?>
	<div class="tags">
        
    </div>
</div>
<div class="footer">
<?php 
	material_posted_on(); 
	echo '<br />';
	the_tags( '<i class="fa fa-tag"></i> ', ' , ', '<br />' );
?>
</div>
</article>
<hr>