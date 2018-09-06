<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<form role="search" method="get" class="nightly-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input data-role="none" class="nightly-input" type="text" name="s" id="s" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'nightly-mobile' ); ?>" value="<?php echo get_search_query(); ?>"/>
    <input data-role="none" class="nightly-button" type="submit" name="submit" value="&#xf002;" />
    <input type="hidden" name="post_type" value="product" />
</form>