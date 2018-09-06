<?php
/**
 * The template for displaying Author bios
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightl 1.0
 */
?>

<div class="author-info">
	<h4 class="author-heading"><span class="fa fa-user"></span><?php esc_html_e( 'Published by', 'nightly-mobile' ); ?></h4>
	<div class="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), '80' ); ?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<h5 class="author-title"><a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></h5>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p><!-- .author-bio -->
		<div class="author-clear"></div>
	</div><!-- .author-description -->
</div><!-- .author-info -->
