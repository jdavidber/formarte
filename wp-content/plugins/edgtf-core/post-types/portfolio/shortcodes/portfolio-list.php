<?php
namespace EdgeCore\CPT\Portfolio\Shortcodes;

use EdgeCore\Lib;

/**
 * Class PortfolioList
 * @package EdgeCore\CPT\Portfolio\Shortcodes
 */
class PortfolioList implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'edgtf_portfolio_list';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     *
     * @see vc_map
     */
    public function vcMap() {
        if(function_exists('vc_map')) {

            $icons_array= array();
            if(edgt_core_theme_installed()) {
                $icons_array = \EdgeOxidesIconCollections::get_instance()->getVCParamsArray();
            }

            vc_map( array(
                'name' => 'Portfolio List',
                'base' => $this->getBase(),
                'category' => 'by EDGE',
                'icon' => 'icon-wpb-portfolio extended-custom-icon',
                'allowed_container_element' => 'vc_row',
                'params' => array(
						array(
							'type' => 'dropdown',								
							'heading' => 'Portfolio List Template',
							'param_name' => 'type',
							'value' => array(
								'Standard' => 'standard',
								'Gallery' => 'gallery',
								'Masonry' => 'masonry',
								'Pinterest' => 'pinterest'
							),
							'admin_label' => true,
                            'save_always'	=> true,
							'description' => ''
						),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Display Title',
                            'param_name' => 'display_title',
                            'value' => array(
                                'Yes'   => 'yes',
                                'No'    => 'no',
                            ),
                            'save_always' => true,
                            'admin_label' => true,
                            'description' => ''
                        ),
						array(
							'type' => 'dropdown',
							'heading' => 'Title Tag',
							'param_name' => 'title_tag',
							'value' => array(
								''   => '',
								'h2' => 'h2',
								'h3' => 'h3',
								'h4' => 'h4',
								'h5' => 'h5',
								'h6' => 'h6',
							),
							'admin_label' => true,
							'description' => '',
                            'dependency' => array('element' => 'display_title', 'value' => array('yes'))
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Image Proportions',
							'param_name' => 'image_size',
							'value' => array(
								'Original' => 'full',
								'Square' => 'square',
								'Landscape' => 'landscape',
								'Portrait' => 'portrait'
							),
							'save_always' => true,
							'admin_label' => true,
							'description' => '',
							'dependency' => array('element' => 'type', 'value' => array('standard', 'gallery'))
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Show Load More',
							'param_name' => 'show_load_more',
							'value' => array(
								'Yes' => 'yes',
								'No' => 'no'
							),
							'save_always' => true,
							'admin_label' => true,
							'description' => 'Default value is Yes'
						),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Enable space between items',
                            'param_name' => 'space_between_items',
                            'value' => array(
                                'No' => 'no',
                                'Yes' => 'yes'
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => 'Default value is No',
                            'dependency' => array('element' => 'type', 'value' => array('standard','gallery')),
                            'group' => 'Query and Layout Options'
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Enable padding on items holder',
                            'param_name' => 'space_on_holder_items',
                            'value' => array(
                                'No' => 'no',
                                'Yes' => 'yes'
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => 'Default value is No',
                            'dependency' => array('element' => 'space_between_items', 'value' => array('yes')),
                            'group' => 'Query and Layout Options'
                        ),
						array(
							'type' => 'dropdown',
							'heading' => 'Order By',
							'param_name' => 'order_by',
							'value' => array(
								'Menu Order' => 'menu_order',
								'Title' => 'title',
								'Date' => 'date'
							),
							'admin_label' => true,
							'save_always' => true,
							'description' => '',
							'group' => 'Query and Layout Options'
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Order',
							'param_name' => 'order',
							'value' => array(
								'ASC' => 'ASC',
								'DESC' => 'DESC',
							),
							'admin_label' => true,
							'save_always' => true,
							'description' => '',
							'group' => 'Query and Layout Options'
						),
						array(
							'type' => 'textfield',
							'heading' => 'One-Category Portfolio List',
							'param_name' => 'category',
							'value' => '',
							'admin_label' => true,
							'description' => 'Enter one category slug (leave empty for showing all categories)',
							'group' => 'Query and Layout Options'
						),
						 array(
							'type' => 'textfield',
							'heading' => 'Number of Portfolios Per Page',
							'param_name' => 'number',
							'value' => '-1',
							'admin_label' => true,
							'description' => '(enter -1 to show all)',
							'group' => 'Query and Layout Options'
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Number of Columns',
							'param_name' => 'columns',
							'value' => array(
								'' => '',
								'One' => 'one',
								'Two' => 'two',
								'Three' => 'three',
								'Four' => 'four',
								'Five' => 'five',
								'Six' => 'six'
							),
							'admin_label' => true,
							'description' => 'Default value is Three',
							'dependency' => array('element' => 'type', 'value' => array('standard','gallery')),
							'group' => 'Query and Layout Options'
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Grid Size',
							'param_name' => 'grid_size',								
							'value' => array(
								'Default' => '',
								'3 Columns Grid' => 'three',
								'4 Columns Grid' => 'four',
								'5 Columns Grid' => 'five'
							),
							'admin_label' => true,
							'description' => 'This option is only for Full Width Page Template',
							'dependency' => array('element' => 'type', 'value' => array('pinterest')),
                            'save_always'	=> true,
							'group' => 'Query and Layout Options'
						),
						array(
							'type' => 'textfield',
							'heading' => 'Show Only Projects with Listed IDs',
							'param_name' => 'selected_projects',
							'value' => '',
							'admin_label' => true,
							'description' => 'Delimit ID numbers by comma (leave empty for all)',
							'group' => 'Query and Layout Options'
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Enable Category Filter',
							'param_name' => 'filter',
							'value' => array(
								'No' => 'no',
								'Yes' => 'yes'                               
							),
							'admin_label' => true,
							'save_always' => true,
							'description' => 'Default value is No',
                            'save_always'	=> true,
							'group' => 'Query and Layout Options'
						),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Category filter style',
                            'param_name' => 'filter_skin',
                            'value' => array(
                                'Light' => 'light',
                                'Dark' => 'dark',
                                'First Main Color' => 'first-color'
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'dependency' => array('element' => 'filter', 'value' => array('yes')),
                            'group' => 'Query and Layout Options'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => 'Category Filter Title',
                            'param_name' => 'filter_title',
                            'value' => '',
                            'admin_label' => true,
                            'dependency' => array('element' => 'filter', 'value' => array('yes')),
                            'group' => 'Query and Layout Options'
                        ),
						array(
							'type' => 'dropdown',
							'heading' => 'Filter Order By',
							'param_name' => 'filter_order_by',
							'value' => array(
								'Name'  => 'name',
								'Count' => 'count',
								'Id'    => 'id',
								'Slug'  => 'slug'
							),
							'admin_label' => true,
							'save_always' => true,
							'description' => 'Default value is Name',
							'dependency' => array('element' => 'filter', 'value' => array('yes')),
							'group' => 'Query and Layout Options'
						),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Display Excerpt',
                            'param_name' => 'display_excerpt',
                            'value' => array(
                                'Yes' => 'yes',
                                'No' => 'no'
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => 'Default value is Yes',
                            'group' => 'Hover Design Options'
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => 'Excerpt Length',
                            'param_name' => 'excerpt_length',
                            'value' => '',
                            'admin_label' => true,
                            'dependency' => array('element' => 'display_excerpt', 'value' => array('yes')),
                            'group' => 'Hover Design Options'
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Display Separator',
                            'param_name' => 'display_separator',
                            'value' => array(
                                'Yes' => 'yes',
                                'No' => 'no'
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => 'Default value is Yes',
                            'group' => 'Hover Design Options',
                            'dependency' => array('element' => 'type', 'value' => array('gallery','masonry','standard')),
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Display Category',
                            'param_name' => 'display_category',
                            'value' => array(
                                'No' => 'no',
                                'Yes' => 'yes'
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => 'Default value is No',
                            'group' => 'Hover Design Options'
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Display Icon for link',
                            'param_name' => 'display_link',
                            'value' => array(
                                'No' => 'no',
                                'Yes' => 'yes'
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => 'Default value is No',
                            'group' => 'Hover Design Options'
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Display Icon for lightbox',
                            'param_name' => 'display_lightbox',
                            'value' => array(
                                'No' => 'no',
                                'Yes' => 'yes'
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                            'description' => 'Default value is No',
                            'group' => 'Hover Design Options'
                        )
                )
				)
			);
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {
        
        $args = array(
            'type' => 'standard',
            'columns' => 'three',
            'grid_size' => 'three',
            'space_between_items' => 'no',
            'space_on_holder_items' => 'no',
            'image_size' => 'full',
            'order_by' => 'date',
            'order' => 'ASC',
            'number' => '-1',
            'filter' => 'no',
            'filter_skin' => 'light',
            'filter_title' => '',
            'filter_order_by' => 'name',
            'category' => '',
            'selected_projects' => '',
            'show_load_more' => 'yes',
            'display_title' => 'yes',
            'title_tag' => 'h6',
			'portfolio_slider' => '',
			'slider_navigation' => '',
			'slider_pagination' => '',
			'next_page' => '',
			'portfolios_shown' => '',
			'display_excerpt' => 'yes',
			'excerpt_length' => '',
			'display_separator' => 'yes',
			'display_category' => 'no',
			'display_link' => 'no',
			'display_lightbox' => 'no'
        );

		$params = shortcode_atts($args, $atts);
		extract($params);
		
		$query_array = $this->getQueryArray($params);
		$query_results = new \WP_Query($query_array);		
		$params['query_results'] = $query_results;
		
		$classes = $this->getPortfolioClasses($params);
		$data_atts = $this->getDataAtts($params);
		$data_atts .= 'data-max-num-pages = '.$query_results->max_num_pages;
		$params['masonry_filter'] = '';
		
		$html = '';
		
		if($filter == 'yes' && ($type == 'masonry' || $type =='pinterest')){
			$params['filter_categories'] = $this->getFilterCategories($params);	
			$params['masonry_filter'] = 'edgtf-masonry-filter';
			$html .= edgt_core_get_shortcode_module_template_part('portfolio','portfolio-filter', '', $params);		
		}
		
		$html .= '<div class = "edgtf-portfolio-list-holder-outer '.$classes.'" '.$data_atts. '>';
		
		if($filter == 'yes' && ($type == 'standard' || $type =='gallery')){
			$params['filter_categories'] = $this->getFilterCategories($params);	
			$html .= edgt_core_get_shortcode_module_template_part('portfolio','portfolio-filter', '', $params);		
		}
		
		$html .= '<div class = "edgtf-portfolio-list-holder clearfix" >';
		if($type == 'masonry' || $type == 'pinterest'){
			$html .= '<div class="edgtf-portfolio-list-masonry-grid-sizer"></div>';
			$html .= '<div class="edgtf-portfolio-list-masonry-grid-gutter"></div>';
		}
		
		if($query_results->have_posts()):			
			while ( $query_results->have_posts() ) : $query_results->the_post(); 
			
				$params['current_id'] = get_the_ID();
				$params['thumb_size'] = $this->getImageSize($params);
				$params['icon_html'] = $this->getPortfolioIconsHtml($params);
				$params['image_link'] = $this->getImageLink($params);
				$params['category_html'] = $this->getItemCategoriesHtml($params);
				$params['separator_html'] = $this->getItemSeparatorHtml($params);
                $params['excerpt_html'] = $this->getItemExcerptHtml($params);
				$params['categories'] = $this->getItemCategories($params);
				$params['article_masonry_size'] = $this->getMasonrySize($params);
				
				$html .= edgt_core_get_shortcode_module_template_part('portfolio',$type, '', $params);
				
			endwhile;
		else: 
			
			$html .= '<p>'. esc_html_e( 'Sorry, no posts matched your criteria.', 'edgt_core') .'</p>';
		
		endif;
        if($type == 'standard' || $type == 'gallery'){
            $html .= $this->getfillerHtml($params);
        }
		$html .= '</div>'; //close edgtf-portfolio-list-holder
		if($show_load_more == 'yes'){
			$html .= edgt_core_get_shortcode_module_template_part('portfolio','load-more-template', '', $params);	
		}
		wp_reset_postdata();


		$html .= '</div>'; // close edgtf-portfolio-list-holder-outer
        return $html;
	}
	
	/**
    * Generates portfolio list query attribute array
    *
    * @param $params
    *
    * @return array
    */
	public function getQueryArray($params){
		
		$query_array = array();
		
		$query_array = array(
			'post_type' => 'portfolio-item',
			'orderby' =>$params['order_by'],
			'order' => $params['order'],
			'posts_per_page' => $params['number']
		);
		
		if(!empty($params['category'])){
			$query_array['portfolio-category'] = $params['category'];
		}
		
		$project_ids = null;
		if (!empty($params['selected_projects'])) {
			$project_ids = explode(',', $params['selected_projects']);
			$query_array['post__in'] = $project_ids;
		}
		
		$paged = '';
		if(empty($params['next_page'])) {
            if(get_query_var('paged')) {
                $paged = get_query_var('paged');
            } elseif(get_query_var('page')) {
                $paged = get_query_var('page');
            }
        }
		
		if(!empty($params['next_page'])){
			$query_array['paged'] = $params['next_page'];
			
		}else{
			$query_array['paged'] = 1;
		}
		
		return $query_array;
	}
	
	/**
    * Generates image link
    *
    * @param $params
    *
    * @return imageLink
    */
	public function getImageLink($params){
	    $imageLink = '';
	    $featured_image_array = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full'); //original size
        $imageLink = $featured_image_array[0];

        return $imageLink;
	}

	/**
    * Generates portfolio icons html
    *
    * @param $params
    *
    * @return html
    */
	public function getPortfolioIconsHtml($params){
		
		$html ='';

		//var_dump($params);

        if($params['display_lightbox'] == 'yes' || $params['display_link'] == 'yes') {

            $id = $params['current_id'];
            $slug_list_ = 'pretty_photo_gallery';

            $featured_image_array = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full'); //original size
            $large_image = $featured_image_array[0];

            $html .= '<div class="edgtf-item-icons-holder">';

            if ($params['display_link'] == 'yes') {
                $html .= '<a class="edgtf-preview" title="Go to Project" href="' . get_the_permalink($id) . '" data-type="portfolio_list"></a>';
            }

            if ($params['display_lightbox'] == 'yes') {
                $html .= '<a class="edgtf-portfolio-lightbox" title="' . get_the_title($id) . '" href="' . $large_image . '" data-rel="prettyPhoto[' . $slug_list_ . ']"></a>';
            }

            $html .= '</div>';

        }
		
		return $html;
        
	}
    /**
     * Generates portfolio icons html
     *
     * @param $params
     *
     * @return html
     */
    public function getItemExcerptHtml($params){

        $html ='';

        if($params['display_excerpt'] == 'yes') {
            $text_length = 80;
            if($params['excerpt_length'] !== '') {
            	$text_length = $params['excerpt_length'];
            }

            $id = $params['current_id'];

            $html .= '<div class="edgtf-item-excerpt-holder">';

                $html .= ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt();

            $html .= '</div>';

        }

        return $html;

    }
	/**
    * Generates portfolio classes
    *
    * @param $params
    *
    * @return string
    */
	public function getPortfolioClasses($params){
		$classes = array();
		$type = $params['type'];
		$columns = $params['columns'];
		$grid_size = $params['grid_size'];
		switch($type):
			case 'standard':
				$classes[] = 'edgtf-ptf-standard';
			break;
			case 'gallery':
				$classes[] = 'edgtf-ptf-gallery';
			break;
			case 'masonry':
				$classes[] = 'edgtf-ptf-masonry';
			break;
			case 'pinterest':
				$classes[] = 'edgtf-ptf-pinterest';
			break;
		endswitch;

		if(empty($params['portfolio_slider'])){ // portfolio slider mustn't have this classes

			if($type == 'standard' || $type == 'gallery' ){
				switch ($columns):
					case 'one':
						$classes[] = 'edgtf-ptf-one-column';
					break;
					case 'two':
						$classes[] = 'edgtf-ptf-two-columns';
					break;
					case 'three':
						$classes[] = 'edgtf-ptf-three-columns';
					break;
					case 'four':
						$classes[] = 'edgtf-ptf-four-columns';
					break;
					case 'five':
						$classes[] = 'edgtf-ptf-five-columns';
					break;
					case 'six':
						$classes[] = 'edgtf-ptf-six-columns';
					break;
				endswitch;
			}
			if($params['show_load_more']== 'yes'){
				$classes[] = 'edgtf-ptf-load-more';
			}

		}

		if($type == "pinterest"){
			switch ($grid_size):
				case 'three':
					$classes[] = 'edgtf-ptf-pinterest-three-columns';
				break;
				case 'four':
					$classes[] = 'edgtf-ptf-pinterest-four-columns';
				break;
				case 'five':
					$classes[] = 'edgtf-ptf-pinterest-five-columns';
				break;
			endswitch;
		}
		if($params['filter'] == 'yes'){
			$classes[] = 'edgtf-ptf-has-filter';
			if($params['type'] == 'masonry' || $params['type'] == 'pinterest'){
				if($params['filter'] == 'yes'){
					$classes[] = 'edgtf-ptf-masonry-filter';
				}
			}
            if($params['filter_skin'] != ''){
                $classes[] = 'edgtf-ptf-filter-skin-'.$params['filter_skin'];
            }
		}

        if($params['space_between_items'] == 'yes'){
            $classes[] = 'edgtf-ptf-with-space';
        }

        if($params['space_on_holder_items'] == 'yes'){
            $classes[] = 'edgtf-ptf-on-holder-with-space';
        }

        /**
         * This part is here because of hover proportions (landscape and portrait)
         *
         */
        if($type == 'standard' || $type == 'gallery') {
            if (!empty($params['image_size'])) {
                $image_size = $params['image_size'];
                switch ($image_size):
                    case 'landscape':
                        $classes[] = 'edgtf-ptf-portfolio-landscape';
                        break;
                    case 'portrait':
                        $classes[] = 'edgtf-ptf-portfolio-portrait';
                        break;
                endswitch;
            }
        }
		
		if(!empty($params['portfolio_slider']) && $params['portfolio_slider'] == 'yes'){
			$classes[] = 'edgtf-portfolio-slider-holder';
		}
		
		return implode(' ',$classes);
        
	}
	/**
    * Generates portfolio image size
    *
    * @param $params
    *
    * @return string
    */
	public function getImageSize($params){
		
		$thumb_size = 'full';
		$type = $params['type'];
		
		if($type == 'standard' || $type == 'gallery'){
			if(!empty($params['image_size'])){
				$image_size = $params['image_size'];

				switch ($image_size) {
					case 'landscape':
						$thumb_size = 'portfolio-landscape';
						break;
					case 'portrait':
						$thumb_size = 'portfolio-portrait';
						break;
					case 'square':
						$thumb_size = 'portfolio-square';
						break;
					case 'full':
						$thumb_size = 'full';
						break;
				}
			}
		}
		elseif($type == 'masonry'){
			
			$id = $params['current_id'];
			$masonry_size = get_post_meta($id, 'portfolio_masonry_dimenisions',true);
			
			switch($masonry_size):
				case 'default' : 
					$thumb_size = 'portfolio-square';
				break;
				case 'large_width' : 
					$thumb_size = 'portfolio-large-width';
				break;
				case 'large_height' : 
					$thumb_size = 'portfolio-large-height';
				break;
				case 'large_width_height' : 
					$thumb_size = 'portfolio-large-width-height';
				break;
			endswitch;
		}
		
		
		return $thumb_size;
	}
	/**
    * Generates portfolio item categories ids.This function is used for filtering
    *
    * @param $params
    *
    * @return array
    */
	public function getItemCategories($params){
		$id = $params['current_id'];
		$category_return_array = array();
		
		$categories = wp_get_post_terms($id, 'portfolio-category');
		
		foreach($categories as $cat){
			$category_return_array[] = 'portfolio_category_'.$cat->term_id;
		}
		return implode(' ', $category_return_array);
	}
	/**
     * Generates portfolio item separator html
     *
     * @param $params
     *
     * @return html
     */
    public function getItemSeparatorHtml($params){
        $separator_html = '';

        if ($params['display_separator'] == 'yes') {
            $separator_html = oxides_edge_execute_shortcode('edgtf_separator', array());
        }

        return $separator_html;
    }
	/**
    * Generates portfolio item categories html based on id
    *
    * @param $params
    *
    * @return html
    */
	public function getItemCategoriesHtml($params){
		$id = $params['current_id'];
        $category_html = '';

        if ($params['display_category'] == 'yes') {

            $categories = wp_get_post_terms($id, 'portfolio-category');
            $category_html = '<div class="edgtf-ptf-category-holder">';
            $k = 1;
            foreach ($categories as $cat) {
                $category_html .= '<span>' . $cat->name . '</span>';
                if (count($categories) != $k) {
                    $category_html .= ' / ';
                }
                $k++;
            }
            $category_html .= '</div>';
        }

		return $category_html;
	}

	/**
    * Generates masonry size class for each article( based on id)
    *
    * @param $params
    *
    * @return string
    */
	public function getMasonrySize($params){
		$masonry_size_class = '';
		
		if($params['type'] == 'masonry'){
			
			$id = $params['current_id'];
			$masonry_size = get_post_meta($id, 'portfolio_masonry_dimenisions',true);
			switch($masonry_size):
				case 'default' : 
					$masonry_size_class = 'edgtf-default-masonry-item';
				break;
				case 'large_width' : 
					$masonry_size_class = 'edgtf-large-width-masonry-item';
				break;
				case 'large_height' : 
					$masonry_size_class = 'edgtf-large-height-masonry-item';
				break;
				case 'large_width_height' : 
					$masonry_size_class = 'edgtf-large-width-height-masonry-item';
				break;
			endswitch;
		}
		
		return $masonry_size_class;
	}
	/**
    * Generates filter categories array
    *
    * @param $params
    *
    
	 * 
	 * 
	 * 
	 * * @return array
    */
	public function getFilterCategories($params){
		
		$cat_id = 0;
		$top_category = '';
		
		if(!empty($params['category'])){	
			
			$top_category = get_term_by('slug', $params['category'], 'portfolio-category');
			if(isset($top_category->term_id)){
				$cat_id = $top_category->term_id;
			}
			
		}
		
		$args = array(
			'child_of' => $cat_id,
			'order_by' => $params['filter_order_by']
		);
		
		$filter_categories = get_terms('portfolio-category',$args);
		
		return $filter_categories;
		
	}
	/**
    * Generates datta attributes array
    *
    * @param $params
    *
    * @return array
    */
	public function getDataAtts($params){
		
		$data_attr = array();
		$data_return_string = '';
		
		if(get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif(get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
		
		if(!empty($paged)) {
            $data_attr['data-next-page'] = $paged+1;
        }		
		if(!empty($params['type'])){
			$data_attr['data-type'] = $params['type'];
		}
		if(!empty($params['columns'])){
			$data_attr['data-columns'] = $params['columns'];
		}
		if(!empty($params['grid_size'])){
			$data_attr['data-grid-size'] = $params['grid_size'];
		}
		if(!empty($params['order_by'])){
			$data_attr['data-order-by'] = $params['order_by'];
		}
		if(!empty($params['order'])){
			$data_attr['data-order'] = $params['order'];
		}
		if(!empty($params['number'])){
			$data_attr['data-number'] = $params['number'];
		}
		if(!empty($params['filter'])){
			$data_attr['data-filter'] = $params['filter'];
		}
		if(!empty($params['filter_order_by'])){
			$data_attr['data-filter-order-by'] = $params['filter_order_by'];
		}
		if(!empty($params['category'])){
			$data_attr['data-category'] = $params['category'];
		}
		if(!empty($params['selected_projects'])){
			$data_attr['data-selected-projects'] = $params['selected_projects'];
		}
		if(!empty($params['show_load_more'])){
			$data_attr['data-show-load-more'] = $params['show_load_more'];
		}
		if(!empty($params['title_tag'])){
			$data_attr['data-title-tag'] = $params['title_tag'];
		}
		if(!empty($params['portfolio_slider']) && $params['portfolio_slider']=='yes'){
			$data_attr['data-items'] = $params['portfolios_shown'];
		}
        if(!empty($params['slider_navigation']) && $params['slider_navigation']=='yes'){
            $data_attr['data-navigation'] = "yes";
        }
		if(!empty($params['slider_pagination']) && $params['slider_pagination']=='yes'){
            $data_attr['data-pagination'] = "yes";
        }
        if(!empty($params['display_title'])){
            $data_attr['data-display_title'] = $params['display_title'];
        }
        if(!empty($params['display_excerpt'])){
            $data_attr['data-display_excerpt'] = $params['display_excerpt'];
        }
        if(!empty($params['excerpt_length'])){
            $data_attr['data-excerpt_length'] = $params['excerpt_length'];
        }
        if(!empty($params['display_separator'])){
            $data_attr['data-display_separator'] = $params['display_separator'];
        }
        if(!empty($params['display_category'])){
            $data_attr['data-display_category'] = $params['display_category'];
        }
        if(!empty($params['display_link'])){
            $data_attr['data-display_link'] = $params['display_link'];
        }
        if(!empty($params['display_lightbox'])){
            $data_attr['data-display_lightbox'] = $params['display_lightbox'];
        }
        if(!empty($params['space_between_items'])){
            $data_attr['data-space_between_items'] = $params['space_between_items'];
        }
        if(!empty($params['image_size'])){
            $data_attr['data-image_size'] = $params['image_size'];
        }

		foreach($data_attr as $key => $value) {
			if($key !== '') {
				$data_return_string .= $key.'= '.esc_attr($value).' ';
			}
		}
		return $data_return_string;
	}

    private function getFillerHtml($params){

        $html = '';

        $columns = $params['columns'];
        $columns_num = '3';
        switch ($columns):
            case 'one':
                $columns_num = 1;
                break;
            case 'two':
                $columns_num = 2;
                break;
            case 'three':
                $columns_num = 3;
                break;
            case 'four':
                $columns_num = 4;
                break;
            case 'five':
                $columns_num = 5;
                break;
            case 'six':
                $columns_num = 6;
                break;
        endswitch;

        $i = 1;
        while ($i <= $columns_num) {
            $i++;
            if ($columns_num != 1) {
                $html .= "<div class='filler'></div>\n";
            }
        }

        return $html;

    }
}