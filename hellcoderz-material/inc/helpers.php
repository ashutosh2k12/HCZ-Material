<?php
	class CommentWalker extends Walker_Comment {
		var $tree_type = 'comment';
		var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
		// constructor – wrapper for the comments list
		function __construct() { ?>

			<section class="comments-list">
				<div class="list-group">
		<?php }

		// start_lvl – wrapper for child comments list
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>
			
			<section class="child-comments comments-list">
				<div class="list-group">

		<?php }
	
		// end_lvl – closing wrapper for child comments list
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>
				</div>
			</section>

		<?php }

		// start_el – HTML for comment template
		function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
			$depth++;
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment'] = $comment;
			$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 
	
			if ( 'article' == $args['style'] ) {
				$tag = 'article';
				$add_below = 'comment';
			} else {
				$tag = 'article';
				$add_below = 'comment';
			} ?>

			<div class="list-group-item" id="comment-<?php comment_ID() ?>">
				<div class="row-action-primary">
					<figure class="gravatar"><?php echo get_avatar( $comment, 65, 'http://www.gravatar.com/avatar/?d=mm', 'Author’s gravatar' ); ?></figure>
				</div>
				<div class="row-content">
					<div class="least-content">
						<time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?>, <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time>
					</div>
      				<h4 class="list-group-item-heading"><a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a></h4>

      				<?php if ($comment->comment_approved == '0') : ?>
					<p class="comment-meta-item">Your comment is awaiting moderation.</p>
					<?php endif; ?>

      				<p class="list-group-item-text">
      					<?php comment_text() ?>
      					<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])),$comment->comment_ID) ?>
      				</p>

      				<?php edit_comment_link('<p class="comment-meta-item">Edit this comment</p>','',''); ?>
      			</div>
		<?php }

		// end_el – closing HTML for comment template
		function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

			</div>
			<div class="list-group-separator"></div>

		<?php }

		// destructor – closing wrapper for the comments list
		function __destruct() { ?>
				</div>
			</section>
		
		<?php }

	}
?>