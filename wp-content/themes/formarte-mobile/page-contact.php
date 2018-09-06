<?php
/**
 * Template Name: Page – Contact
 * Description: Custom contact page
 *
 * @package WordPress
 * @subpackage Nightly
 * @since Nightly 1.0
 */
 
$nightly_contact_form_email = html_entity_decode( nightly_global('nightly_contact_form_email') );
$nightly_contact_form_map_src = html_entity_decode( nightly_global('nightly_contact_form_map_src') );
 
if( @isset($_POST['submited']) ) {

	$to = $nightly_contact_form_email;
	$subject = "Message from ".get_bloginfo('name');
	
	$name_field = @$_POST['message_name'];
	$email_field = @$_POST['message_email'];
	$headers = 'From: '. $email_field . "\r\n" .
	  'Reply-To: ' . $email_field . "\r\n";
	$message = @$_POST['message_text'];
	$human = @$_POST['message_human'];
	 
	$body = "From: $name_field\n E-Mail: $email_field\n Message:\n $message";
	
	if( !empty($human) && !empty($name_field) && !empty($email_field) && !empty($message) ) {
	    if( $human == 2 ) {
	
	      if( filter_var($email_field, FILTER_VALIDATE_EMAIL)) {
	       
	        if( wp_mail($to, $subject, strip_tags($message), $headers) ) {
	        	$_status = "success";
	        } else $_status = "error";
	        
	      } else $_status = "retroemail";
	    
	    } else $_status = "nohuman";
	    
	  } else $_status = "fillall";

} 
get_header(); ?>

	<div class="content-area">

		<?php
		
		if( ! empty( $nightly_contact_form_map_src ) ) $_class = "item has-post-thumbnail";
		else $_class = "item";
	
		while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class($_class); ?>>
			
			<?php if( !empty( $nightly_contact_form_map_src ) ) : ?>
				<iframe class="fullwidth" src="<?php echo esc_attr ( $nightly_contact_form_map_src ); ?>" height="300" width="100%" frameborder="0" marginwidth="0" marginheight="0" scrolling="yes"></iframe>
				<?php endif; ?>
				
					<header class="entry-header">
						<?php
							the_title( '<h2>', '</h2>' );
						?>
					</header><!-- .entry-header -->
					
					<div class="entry-content blog-prologue">
						<?php the_content(); ?>

						<?php if( !empty($_status) ) :
					    if( $_status == 'success' ) echo "<div class='nightly-alert nightly-alert-success'><i class='fa fa-2x fa-check fa-fw'></i><p>Your message has been sent successfully.</p></div>";
					    
					    if( $_status == 'error' ) echo "<div class='nightly-alert nightly-alert-error'><i class='fa fa-2x fa-exclamation fa-fw'></i><p>Your message has not been sent. Check your mail server.</p></div>";
					    
					    if( $_status == 'fillall' ) echo "<div class='nightly-alert nightly-alert-warning'><i class='fa fa-2x fa-warning fa-fw'></i><p>Please fill all the necessary fields.</p></div>";
					    
					    if( $_status == 'nohuman' ) echo "<div class='nightly-alert nightly-alert-warning'><i class='fa fa-2x fa-warning fa-fw'></i><p>Looks like you are not human. Please check your answer.</p></div>";
					    
					    if( $_status == 'retroemail' ) echo "<div class='nightly-alert nightly-alert-error'><i class='fa fa-2x fa-exclamation fa-fw'></i><p>Given email address is not email address.</p></div>";
					    endif;
					?>
                	<form action="<?php the_permalink(); ?>" method="post">
                				<label for="message_human">Your Name <span>*</span></label>
                        <input data-role="none" type="text" class="nightly-input" name="message_name" value="<?php if( !empty($_POST['message_name'] ) ) echo esc_attr($_POST['message_name']); ?>" required />
                        
                        <label for="message_human">Your Email <span>*</span></label>
                        <input data-role="none" type="text" class="nightly-input" name="message_email" value="<?php if( !empty($_POST['message_email'] ) ) echo esc_attr($_POST['message_email']); ?>" required />
                        
                        <label for="message_human">Your Message <span>*</span></label>
                        <textarea data-role="none" rows="4" class="nightly-input" name="message_text" required ><?php if( !empty($_POST['message_text'] ) ) echo esc_textarea($_POST['message_text']); ?></textarea>
                        
                        <input type="hidden" name="submited" value="1">
                        
                        <label for="message_human">Human Verification: <span>*</span></label>
                        <input data-role="none" class="nightly-input" type="text" style="font-size: 18px !important;width: 10px !important; display: inline-block;" name="message_human"><span style="margin-left: 8px;">+ 3 = 5</span></p>
                        
                        <button data-role="none" type="submit" class="nightly-button big" data-theme="<?php echo get_option("nightly_theme") ?>"><i class="fa fa-send"></i>Send</button>
                    </form>
					</div><!-- .entry-content -->
					
					<footer class="entry-footer">
						<?php edit_post_link( esc_html__( 'Edit', 'nightly-mobile' ), '<button data-role="none" class="nightly-button">', '</button>' ); ?>
					</footer><!-- .entry-footer -->
				
				</article><!-- #post-## -->

			<?php // If comments are open or we have at least one comment, load up the comment template.

		// End the loop.
		endwhile;
		?>

	</div><!-- .content-area -->

<?php get_footer(); ?>
