<h2 class="blog-title-pro"><?php the_title(); ?></h2>
<div class="well">
    <div class="article-page">
    	<?php 
    	hcz_post_thumbnail();

    	the_content();

    	wp_link_pages( array(
			'before'      => '<hr class="clear"><div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'hellcoderz-material' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) );

		edit_post_link( __( 'Edit', 'hellcoderz-material' ), '<span class="edit-link">', '</span>' );
		?>
    </div>
</div>
<?php
if ( comments_open() || '0' != get_comments_number() ) :
    ?><div class="well"><?php
    comments_template();
    ?></div><?php
endif;
?>