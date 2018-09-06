<?php
/**
 * The default template for displaying gallery post format.
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("item entry-gallery-post"); ?>>

	<?php $args = array(
		'post_type' => 'attachment',
		'numberposts' => -1,
		'post_status' => null,
		'post_mime_type'   => 'image',
		'post_parent' =>  $post->ID
	);
	
	$attachments = get_posts( $args );
	
	if( $attachments ) : ?>
		<div data-role="none" id="gallery-post-<?php the_ID(); ?>" class="owl-carousel fullwidth disableswipe">
			<?php foreach( $attachments as $attachment ) : ?>
				<div class="item"><?php echo wp_get_attachment_image( $attachment->ID, 'full' ); ?></div>
			<?php endforeach; ?>	
		</div>
	<?php endif; ?>

<?php $categories_list = get_the_category_list();
if ( $categories_list && $attachments ) : ?>
	<div class="entry-categories-list">
		<?php echo '<span class="categories-links" data-theme="'. get_option("nightly_theme").'">' . $categories_list . '</span>'; ?>
	</div>
<?php endif; ?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h2>', '</h2>' );
			else :
				the_title( sprintf( '<a href="%s" rel="bookmark"><h2>', esc_url( get_permalink() ) ), '</h2></a>' );
			endif;
		?>
	</header><!-- .entry-header -->
	
	<?php nightly_entry_meta(); ?>

	<div class="entry-content blog-prologue">
		<?php
			/* translators: %s: Name of current post */

			if( !is_single() ) {
				if ( get_the_excerpt() != "" ) {
					echo nightly_content_format(60);
				} else {
					echo "<p></p>";
				}
			} else {
				echo nightly_content_format();
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'nightly-mobile' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'nightly-mobile' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
			}

		?>
	</div><!-- .entry-content -->
	
	<?php if ( is_single() ) :
	
		the_tags( '<div>Tagged in <span class="ui-tag" data-theme="'. get_option("nightly_theme").'">', '</span><span class="ui-tag" data-theme="'. get_option("nightly_theme").'">', '</span></div>' );
		endif;

		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<?php nightly_entry_footer(); ?>

</article><!-- #post-## -->

<?php if ( $attachments ) : ?>

	<script>
		jQuery(document).ready(function() {
			jQuery("#gallery-post-<?php the_ID(); ?>").owlCarousel({    
		      slideSpeed : 700,
		      paginationSpeed : 700,
		      rewindSpeed : 1500,
		      singleItem : true,
		      pagination : true,
		      autoPlay : false,
		      autoHeight : true,
		      navigation: false,
		      navigationText: [
		        "<i class='owl-nav-left fa fa-angle-left'></i>",
		        "<i class='owl-nav-right fa fa-angle-right'></i>"
		        ]
		   });
		});
	</script>
<?php endif; ?>
