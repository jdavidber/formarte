<form role="search" method="get" class="nightly-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="s"><?php esc_html__( 'Search for:', 'nightly-mobile' ); ?></label>
    <input data-role="none" class="nightly-input" type="text" name="s" id="s" placeholder="<?php echo esc_attr_x( 'Search on website', 'placeholder', 'nightly-mobile' ); ?>" value="<?php echo get_search_query(); ?>"/>
    <input data-role="none" class="nightly-button" type="submit" name="submit" value="&#xf002;" />
</form>