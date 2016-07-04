<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Casper
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( _nx( '1 comment', '%1$s comments', get_comments_number(), 'comments title', 'hellcoderz-material' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'hellcoderz-material' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'hellcoderz-material' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'hellcoderz-material' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'short_ping' => true,
					'walker' => new CommentWalker()
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'hellcoderz-material' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'hellcoderz-material' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'hellcoderz-material' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'hellcoderz-material' ); ?></p>
	<?php endif; ?>

	<?php
	$fields =  array(

  'author' =>
    '<div class="comment-form-author form-group label-floating has-success is-empty"><label for="author" class="control-label">' . __( 'Name ', 'hellcoderz-material' ) . ( $req ? '*' : '' ) . '</label> ' .
    '<input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' /></div>',

  'email' =>
    '<div class="comment-form-email form-group label-floating has-success is-empty"><label for="email" class="control-label">' . __( 'Email', 'hellcoderz-material' ) . ( $req ? '*' : '' ) . '</label> ' .
    '<input id="email" name="email" type="text" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></div>',

  'url' =>
    '<div class="comment-form-url form-group label-floating has-success is-empty"><label for="url" class="control-label">' . __( 'Website', 'hellcoderz-material' ) . '</label>' .
    '<input id="url" name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" /></div>',
);

		$comments_args = array(
		'id_form'           => 'commentform',
		'class_submit'      => 'submit btn btn-raised btn-primary',
        'label_submit'=>'Send',
        'title_reply'=>'',
        'comment_notes_after' => '',
        'fields' => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_notes_before' => '<div class="alert alert-info comment-notes">' .
	    __( 'Your email address will not be published. Required feilds are marked *', 'hellcoderz-material' ) . ( $req ? 'Required' : '' ) .
	    '</div>',
	    'comment_notes_after' => '<p class="text-primary form-allowed-tags">' .
	    sprintf(
	      __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'hellcoderz-material' ),
	      ' <code>' . allowed_tags() . '</code>'
	    ) . '</p>',
        'logged_in_as' => '<p class="logged-in-as">' .
		    sprintf(
		    __( 'Comment as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'hellcoderz-material' ),
		      admin_url( 'profile.php' ),
		      $user_identity,
		      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
		    ) . '</p>',
        'comment_field' => '<div class="comment-form-comment form-group label-floating has-success is-empty"><label for="comment" class="control-label">' . _x( 'Comment', 'noun', 'hellcoderz-material' ) . '</label><textarea id="comment" name="comment" class="form-control" aria-required="true"></textarea></div>',
		);
	?>
	<div class="row">
	<div class="col-md-12">
	<?php comment_form($comments_args); ?>
	</div>
	</div>

</div><!-- #comments -->
