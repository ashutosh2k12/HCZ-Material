<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php /*
<h2 class="blog-title-pro"><?php the_title(); ?></h2>
*/ ?>
<div class="well">
    <div class="article-post">
    <?php if ( 'post' == get_post_type() ) : ?>
        <?php hcz_post_thumbnail(); ?>
        <header class="page-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="entry-meta">
                <span class="post-meta">
                    <?php 
                            material_posted_on();
                            edit_post_link( __( 'Edit&rarr;', 'hellcoderz-material' ), '<span class="edit-link">&nbsp;&bull;&nbsp;', '</span>' ); 
                    ?>
                    <div class="tags">
                    <?php the_tags( '<span class="label label-success"><i class="fa fa-tag"></i> ', ' </span>&nbsp;<span class="label label-success"><i class="fa fa-tag"></i> ', '</span>' ); ?>
                    </div>
                </span>
            </div>
        </header>
    <?php endif; ?>
    	<?php the_content(); ?>
        <hr class="clear">
        <?php 

        hcz_post_nav(); 
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
</article>