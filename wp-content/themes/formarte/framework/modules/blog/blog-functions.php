<?php

if( !function_exists('oxides_edge_get_blog') ) {
	/**
	 * Function which return holder for all blog lists
	 *
	 * @return holder.php template
	 */
	function oxides_edge_get_blog($type) {

		$sidebar = oxides_edge_sidebar_layout();

		$params = array(
			"blog_type" => $type,
			"sidebar" => $sidebar
		);
		oxides_edge_get_module_template_part('templates/lists/holder', 'blog', '', $params);
	}
}

if( !function_exists('oxides_edge_get_blog_type') ) {

	/**
	 * Function which create query for blog lists
	 *
	 * @return blog list template
	 */

	function oxides_edge_get_blog_type($type) {
		global $wp_query;

		$id = oxides_edge_get_page_id();
		$category = get_post_meta($id, "edgtf_blog_category_meta", true);
		$post_number = esc_attr(get_post_meta($id, "edgtf_show_posts_per_page_meta", true));

		$paged = oxides_edge_paged();

		if(!is_archive()) {
			$blog_query = new WP_Query('post_type=post&paged=' . $paged . '&cat=' . $category . '&posts_per_page=' . $post_number);
		}else{
			$blog_query = $wp_query;
		}

		if(oxides_edge_options()->getOptionValue('blog_page_range') != ""){
			$blog_page_range = esc_attr(oxides_edge_options()->getOptionValue('blog_page_range'));
		} else{
			$blog_page_range = $blog_query->max_num_pages;
		}
		$params = array(
			'blog_query' => $blog_query,
			'paged' => $paged,
			'blog_page_range' => $blog_page_range,
			'blog_type' => $type
		);

		oxides_edge_get_module_template_part('templates/lists/' .  $type, 'blog', '', $params);
	}
}

if( !function_exists('oxides_edge_get_post_format_html') ) {

	/**
	 * Function which return html for post formats
	 * @param $type
	 * @return post hormat template
	 */

	function oxides_edge_get_post_format_html($type = "") {

		$post_format = get_post_format();
		$supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');
		
		if(in_array($post_format, $supported_post_formats) && $type !== "checkered") {
			$post_format = $post_format;
		} else {
			$post_format = 'standard';
		}

		$slug = '';
		if($type !== ""){
			$slug = $type;
		}

		$params = array();

		$chars_array = oxides_edge_blog_lists_number_of_chars();
		if(isset($chars_array[$type])) {
			$params['excerpt_length'] = $chars_array[$type];
		} else {
			$params['excerpt_length'] = '';
		}

		oxides_edge_get_module_template_part('templates/lists/post-formats/' . $post_format, 'blog', $slug, $params);
	}
}

if( !function_exists('oxides_edge_get_default_blog_list') ) {
	/**
	 * Function which return default blog list for archive post types
	 *
	 * @return post format template
	 */

	function oxides_edge_get_default_blog_list() {

		$blog_list = oxides_edge_options()->getOptionValue('blog_list_type');
		return $blog_list;
	}
}

if (!function_exists('oxides_edge_pagination')) {

	/**
	 * Function which return pagination
	 *
	 * @return blog list pagination html
	 */

	function oxides_edge_pagination($pages = '', $range = 4, $paged = 1){

		$showitems = $range+1;

		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages){
				$pages = 1;
			}
		}

		if(1 != $pages){

			echo '<span class="edgtf-pagination-new-holder">'. get_the_posts_pagination().'</span>';

			echo '<div class="edgtf-pagination">';
				echo '<ul>';
					echo '<li class="edgtf-pagination-prev';
					if($paged == 1) {
						echo ' edgtf-pagination-prev-first';
					}
					echo '"><a href="'.esc_url(get_pagenum_link($paged - 1)).'">
						<span class="edgtf-pagination-text-holder"><span class="edgtf-pagination-icon arrow_left"></span><span class="edgtf-pagination-text">'.esc_html__('NEWER POSTS', 'oxides').'</span>'.($paged-1).'<span class="edgtf-pagination-text-mark"></span>'.$pages.'</span></a></li>';
					echo '<li class="edgtf-pagination-next';
					if ($paged == $pages){
						echo ' edgtf-pagination-next-last';
					}
					echo '"><a href="';
					if($pages > $paged){
						echo esc_url(get_pagenum_link($paged + 1));
					} else {
						echo esc_url(get_pagenum_link($paged));
					}
					echo '"><span class="edgtf-pagination-text">'.($paged+1).'<span class="edgtf-pagination-text-mark"></span>'.$pages.'<span class="edgtf-pagination-text">'.esc_html__('OLDER POSTS', 'oxides').'</span></span><span class="edgtf-pagination-icon arrow_right"></span></a></li>';
				echo '</ul>';
			echo '</div>';
		}
	}
}

if(!function_exists('oxides_edge_post_info')){
	/**
	 * Function that loads parts of blog post info section
	 * Possible options are:
	 * 1. date
	 * 2. category
	 * 3. author
	 * 4. comments
	 * 5. like
	 * 6. share
	 *
	 * @param $config array of sections to load
	 */
	function oxides_edge_post_info($config){
		$default_config = array(
			'date' => '',
			'category' => '',
			'author' => '',
			'comments' => '',
			'like' => '',
			'share' => ''
		);

		extract(shortcode_atts($default_config, $config));

		if($date == 'yes'){
			oxides_edge_get_module_template_part('templates/parts/post-info-date', 'blog');
		}
		if($category == 'yes'){
			oxides_edge_get_module_template_part('templates/parts/post-info-category', 'blog');
		}
		if($author == 'yes'){
			oxides_edge_get_module_template_part('templates/parts/post-info-author', 'blog');
		}
		if($comments == 'yes'){
			oxides_edge_get_module_template_part('templates/parts/post-info-comments', 'blog');
		}
		if($like == 'yes'){
			oxides_edge_get_module_template_part('templates/parts/post-info-like', 'blog');
		}
		if($share == 'yes'){
			oxides_edge_get_module_template_part('templates/parts/post-info-share', 'blog');
		}
	}
}

if(!function_exists('oxides_edge_excerpt')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in edgt_set_blog_word_count function.
	 *
	 * It current post has read more tag set it will return content of the post, else it will return post excerpt
	 *
	 */
	function oxides_edge_excerpt($excerpt_length) {
		global $post;

		if(post_password_required()) {
			echo get_the_password_form();
		}

		//does current post has read more tag set?
		elseif(oxides_edge_post_has_read_more()) {
			global $more;

			//override global $more variable so this can be used in blog templates
			$more = 0;
			the_content(true);
		}

		//is word count set to something different that 0?
		elseif($excerpt_length != '0') {
			//if word count is set and different than empty take that value, else that general option from theme options
			$word_count = isset($excerpt_length) && $excerpt_length !== "" ? $excerpt_length : esc_attr(oxides_edge_options()->getOptionValue('number_of_chars'));

			//if post excerpt field is filled take that as post excerpt, else that content of the post
			$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);

			//remove leading dots if those exists
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

			//if clean excerpt has text left
			if($clean_excerpt !== '') {
				//explode current excerpt to words
				$excerpt_word_array = explode (' ', $clean_excerpt);

				//cut down that array based on the number of the words option
				$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);

				//and finally implode words together
				$excerpt 			= implode (' ', $excerpt_word_array);

				//is excerpt different than empty string?
				if($excerpt !== '') {
					echo '<p class="edgtf-post-excerpt">'.wp_kses_post($excerpt).'</p>';
				}
			}
		}
	}
}

if(!function_exists('oxides_edge_get_blog_single')) {

	/**
	 * Function which return holder for single posts
	 *
	 * @return single holder.php template
	 */

	function oxides_edge_get_blog_single() {
		$sidebar = oxides_edge_sidebar_layout();

		$params = array(
			"sidebar" => $sidebar
		);

		oxides_edge_get_module_template_part('templates/single/holder', 'blog', '', $params);
	}
}

if( !function_exists('oxides_edge_get_single_html') ) {

	/**
	 * Function return all parts on single.php page
	 *
	 *
	 * @return single.php html
	 */

	function oxides_edge_get_single_html() {

		$post_format = get_post_format();
		if($post_format === false){
			$post_format = 'standard';
		}

		//Related posts
  		$show_related = (oxides_edge_options()->getOptionValue('blog_single_related_posts') == 'yes') ? true : false;

  		if ($show_related) {
			$hasSidebar = oxides_edge_sidebar_layout();
			$post_id = get_the_ID();
			$related_post_number = ($hasSidebar == '' || $hasSidebar == 'default' || $hasSidebar == 'no-sidebar') ? 4 : 3;
			$related_posts_options = array('posts_per_page' => $related_post_number);
			$params = array('related_posts' => oxides_edge_get_related_post_type($post_id, $related_posts_options));
		}

		oxides_edge_get_module_template_part('templates/single/post-formats/' . $post_format, 'blog');
		if ($show_related) {
			oxides_edge_get_module_template_part('templates/single/parts/related-posts', 'blog', '', $params);
		}
		oxides_edge_get_module_template_part('templates/single/parts/single-navigation', 'blog');
		oxides_edge_get_module_template_part('templates/single/parts/author-info', 'blog');
		if(oxides_edge_show_comments()){
			comments_template('', true);
		}
	}
}

if( !function_exists('oxides_edge_additional_post_items') ) {

	/**
	 * Function which return parts on single.php which are just below content
	 *
	 * @return single.php html
	 */

	function oxides_edge_additional_post_items() {

		if(has_tag()){
			oxides_edge_get_module_template_part('templates/single/parts/tags', 'blog');
		}


		$args_pages = array(
			'before'           => '<div class="edgtf-single-links-pages"><div class="edgtf-single-links-pages-inner">',
			'after'            => '</div></div>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'pagelink'         => '%'
		);

		wp_link_pages($args_pages);

	}
	add_action('oxides_edge_before_blog_article_closed_tag', 'oxides_edge_additional_post_items');
}

if (!function_exists('oxides_edge_comment')) {

	/**
	 * Function which modify default wordpress comments
	 *
	 * @return comments html
	 */

	function oxides_edge_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		global $post;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment  = $post->post_author == $comment->user_id;

		$comment_class = 'edgtf-comment clearfix';

		if($is_author_comment) {
			$comment_class .= ' edgtf-post-author-comment';
		}

		if($is_pingback_comment) {
			$comment_class .= ' edgtf-pingback-comment';
		}

		?>

		<li>
		<div class="<?php echo esc_attr($comment_class); ?>">
			<?php if(!$is_pingback_comment) { ?>
				<div class="edgtf-comment-image"> <?php echo oxides_edge_kses_img(get_avatar($comment, 120)); ?> </div>
			<?php } ?>
			<div class="edgtf-comment-text">
				<div class="edgtf-comment-info">
					<h6 class="edgtf-comment-name">
						<?php if($is_pingback_comment) { esc_html_e('Pingback:', 'oxides'); } ?>
						<?php echo wp_kses_post(get_comment_author_link()); ?>
					</h6>
					<span class="edgtf-comment-date"><?php comment_time(get_option('date_format')); ?></span>
				</div>
				<?php if(!$is_pingback_comment) { ?>
					<div class="edgtf-text-holder" id="comment-<?php echo comment_ID(); ?>">
						<?php comment_text(); ?>
					</div>
					<div class="edgtf-comment-text-links">
					<?php
						comment_reply_link( array_merge( $args, array('reply_text' => esc_html__('Leave reply', 'oxides'), 'depth' => $depth, 'max_depth' => $args['max_depth'])) );
						edit_comment_link(esc_html__('Edit comment','oxides'));
					?>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>

		<?php
	}
}

if( !function_exists('oxides_edge_blog_archive_pages_classes') ) {

	/**
	 * Function which create classes for container in archive pages
	 *
	 * @return array
	 */

	function oxides_edge_blog_archive_pages_classes($blog_type) {

		$classes = array();
		if(in_array($blog_type, oxides_edge_blog_full_width_types())){
			$classes['holder'] = 'edgtf-full_width';
			$classes['inner'] = 'edgtf-full_width_inner';
		} elseif(in_array($blog_type, oxides_edge_blog_grid_types())){
			$classes['holder'] = 'edgtf-container';
			$classes['inner'] = 'edgtf-container-inner clearfix';
		}

		return $classes;
	}
}

if( !function_exists('oxides_edge_blog_full_width_types') ) {

	/**
	 * Function which return all full width blog types
	 *
	 * @return array
	 */

	function oxides_edge_blog_full_width_types() {

		$types = array('checkered');

		return $types;
	}
}

if( !function_exists('oxides_edge_blog_grid_types') ) {

	/**
	 * Function which return in grid blog types
	 *
	 * @return array
	 */

	function oxides_edge_blog_grid_types() {

		$types = array('standard', 'standard-whole-post');

		return $types;
	}
}

if( !function_exists('oxides_edge_blog_types') ) {

	/**
	 * Function which return all blog types
	 *
	 * @return array
	 */

	function oxides_edge_blog_types() {

		$types = array_merge(oxides_edge_blog_grid_types(), oxides_edge_blog_full_width_types());

		return $types;
	}
}

if( !function_exists('oxides_edge_blog_templates') ) {

	/**
	 * Function which return all blog templates names
	 *
	 * @return array
	 */

	function oxides_edge_blog_templates() {

		$templates = array();
		$grid_templates = oxides_edge_blog_grid_types();
		$full_templates = oxides_edge_blog_full_width_types();
		foreach($grid_templates as $grid_template){
			array_push($templates, 'blog-'.$grid_template);
		}
		foreach($full_templates as $full_template){
			array_push($templates, 'blog-'.$full_template);
		}

		return $templates;
	}
}

if( !function_exists('oxides_edge_blog_lists_number_of_chars') ) {

	/**
	 * Function that return number of characters for different lists based on options
	 *
	 * @return int
	 */

	function oxides_edge_blog_lists_number_of_chars() {

		$number_of_chars = array();
		
		$number_of_chars['standard'] = (oxides_edge_options()->getOptionValue('standard_number_of_chars') !== '') ? oxides_edge_options()->getOptionValue('standard_number_of_chars') : 45;
		$number_of_chars['checkered'] = (oxides_edge_options()->getOptionValue('checkered_number_of_chars') !== '') ? oxides_edge_options()->getOptionValue('checkered_number_of_chars') : 20;
		
		return $number_of_chars;
	}
}

if (!function_exists('oxides_edge_excerpt_length')) {
	/**
	 * Function that changes excerpt length based on theme options
	 * @param $length int original value
	 * @return int changed value
	 */
	function oxides_edge_excerpt_length( $length ) {

		if(oxides_edge_options()->getOptionValue('number_of_chars') !== ''){
			return esc_attr(oxides_edge_options()->getOptionValue('number_of_chars'));
		} else {
			return 45;
		}
	}

	add_filter( 'excerpt_length', 'oxides_edge_excerpt_length', 999 );
}

if(!function_exists('oxides_edge_post_has_read_more')) {
	/**
	 * Function that checks if current post has read more tag set
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function oxides_edge_post_has_read_more() {
		global $post;

		return strpos($post->post_content, '<!--more-->');
	}
}

if(!function_exists('oxides_edge_post_has_title')) {
	/**
	 * Function that checks if current post has title or not
	 * @return bool
	 */
	function oxides_edge_post_has_title() {
		return get_the_title() !== '';
	}
}

if (!function_exists('oxides_edge_modify_read_more_link')) {
	/**
	 * Function that modifies read more link output.
	 * Hooks to the_content_more_link
	 * @return string modified output
	 */
	function oxides_edge_modify_read_more_link() {
		$link = '<div class="edgtf-more-link-container">';
		$link .= oxides_edge_get_button_html(array(
			'link' => get_permalink().'#more-'.get_the_ID(),
			'text' => esc_html__('Continue reading', 'oxides')
		));

		$link .= '</div>';

		return $link;
	}

	add_filter( 'the_content_more_link', 'oxides_edge_modify_read_more_link');
}


if(!function_exists('oxides_edge_has_blog_widget')) {
	/**
	 * Function that checks if latest posts widget is added to widget area
	 * @return bool
	 */
	function oxides_edge_has_blog_widget() {
		$widgets_array = array(
			'edgt_latest_posts_widget'
		);

		foreach ($widgets_array as $widget) {
			$active_widget = is_active_widget(false, false, $widget);

			if($active_widget) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('oxides_edge_has_blog_shortcode')) {
	/**
	 * Function that checks if any of blog shortcodes exists on a page
	 * @return bool
	 */
	function oxides_edge_has_blog_shortcode() {
		$blog_shortcodes = array(
			'edgtf_blog_list',
			'edgtf_blog_slider',
			'edgtf_blog_carousel'
		);

		$slider_field = get_post_meta(oxides_edge_get_page_id(), 'edgtf_page_slider_meta', true); //TODO change

		foreach ($blog_shortcodes as $blog_shortcode) {
			$has_shortcode = oxides_edge_has_shortcode($blog_shortcode) || oxides_edge_has_shortcode($blog_shortcode, $slider_field);

			if($has_shortcode) {
				return true;
			}
		}

		return false;
	}
}


if(!function_exists('oxides_edge_load_blog_assets')) {
	/**
	 * Function that checks if blog assets should be loaded
	 *
	 * @see edgt_is_blog_template()
	 * @see is_home()
	 * @see is_single()
	 * @see edgt_has_blog_shortcode()
	 * @see is_archive()
	 * @see is_search()
	 * @see edgt_has_blog_widget()
	 * @return bool
	 */
	function oxides_edge_load_blog_assets() {
		return oxides_edge_is_blog_template() || is_home() || is_single() || oxides_edge_has_blog_shortcode() || is_archive() || is_search() || oxides_edge_has_blog_widget();
	}
}

if(!function_exists('oxides_edge_is_blog_template')) {
	/**
	 * Checks if current template page is blog template page.
	 *
	 *@param string current page. Optional parameter.
	 *
	 *@return bool
	 *
	 * @see oxides_edge_get_page_template_name()
	 */
	function oxides_edge_is_blog_template($current_page = '') {

		if($current_page == '') {
			$current_page = oxides_edge_get_page_template_name();
		}

		$blog_templates = oxides_edge_blog_templates();

		return in_array($current_page, $blog_templates);
	}
}

if(!function_exists('oxides_edge_read_more_button')) {
	/**
	 * Function that outputs read more button html if necessary.
	 * It checks if read more button should be outputted only if option for given template is enabled and post does'nt have read more tag
	 * and if post isn't password protected
	 *
	 * @param string $option name of option to check
	 * @param string $class additional class to add to button
	 *
	 */
	function oxides_edge_read_more_button($option = '', $class = '') {
		if($option != '') {
			$show_read_more_button = oxides_edge_options()->getOptionValue($option) == 'yes';
		}else {
			$show_read_more_button = 'yes';
		}
		if($show_read_more_button && !oxides_edge_post_has_read_more() && !post_password_required()) {
			echo oxides_edge_get_button_html(array(
				'type'         => 'solid',
				'size'         => 'small',
				'link'         => get_the_permalink(),
				'text'         => esc_html__('READ MORE', 'oxides'),
				'icon_pack'    => 'font_elegant',
				'fe_icon'         => 'arrow_right',
				'custom_class' => $class
			));
		}
	}
}
?>