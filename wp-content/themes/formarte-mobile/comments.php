<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title"><span class="fa fa-comments"></span>
			<?php
				printf( _nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title', 'nightly-mobile' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h4>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 56,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php nightly_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'nightly-mobile' ); ?></p>
	<?php else : ?>
	
	<h4 class="comment-title-reply"><span class="fa fa-pencil"></span>Leave a reply</h4>

	<?php 
	
	$comment_args = array( 'title_reply'=>'',
	
	'fields' => apply_filters( 'comment_form_default_fields', array(
	
	'author' => '<p class="comment-form-author">' .
	
	        '<input data-role="none" class="nightly-input" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_html__( 'Name *', 'nightly-mobile' ) . '" /></p>',   
	
	    'email'  => '<p class="comment-form-email">' .
	
	                '<input data-role="none" class="nightly-input" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_html__( 'Email *', 'nightly-mobile' ) . '" />'.'</p>',
	
	    'url'    => '' ) ),
	
	    'comment_field' => '<p>' .
	
	                '<textarea data-role="none" class="nightly-input" id="comment" name="comment" cols="25" rows="8" aria-required="true" placeholder="' . esc_html__( 'Comment *', 'nightly-mobile' ) . '"></textarea>' .
	
	                '</p>',
	
	    'submit_button' => '<input type="submit" data-role="none" data-theme="'. get_option("nightly_theme").'" class="nightly-button" value="'.esc_html__('Post Comment', 'nightly-mobile').'" />'
	
	);
	
	comment_form($comment_args);
	
  endif;
	
	?>

</div><!-- .comments-area -->
