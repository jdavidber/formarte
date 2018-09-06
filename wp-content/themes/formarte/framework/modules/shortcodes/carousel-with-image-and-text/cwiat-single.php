<?php
namespace EdgeOxidesfModules\Shortcodes\CarouselWithImageAndTextSingle;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

class CarouselWithImageAndTextSingle implements ShortcodeInterface{

    private $base;

    /**
     * Carousel With Image And Text Single constructor.
     */
    public function __construct() {
        $this->base = 'edgtf_carousel_with_image_and_text_single';

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
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     */
    public function vcMap() {

        vc_map(array(
            'name'                      => 'Edge Carousel With Image And Text Single',
            'base'                      => $this->getBase(),
            'category'                  => 'by EDGE',
            'icon'                      => '',
            'as_child' => array('only' => 'edgtf_carousel_with_image_and_text'),
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'			=> 'attach_image',
                    'heading'		=> 'Image',
                    'param_name'	=> 'image',
                    'description'	=> 'Select images from media library'
                ),
                array(
                    'type'			=> 'textfield',
                    'heading'		=> 'Image Size',
                    'param_name'	=> 'image_size',
                    'description'	=> 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => 'Title',
                    'param_name'  => 'title',
                    'value'       => '',
                    'admin_label' => true
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => 'Title Tag',
                    'param_name' => 'title_tag',
                    'value'      => array(
                        ''   => '',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6',
                    ),
                    'dependency' => array('element' => 'title', 'not_empty' => true),
                    'group'      => 'Text Settings'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => 'Title Color',
                    'param_name' => 'title_color',
                    'dependency' => array('element' => 'title', 'not_empty' => true),
                    'group'      => 'Text Settings'
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => 'Text',
                    'param_name' => 'text',
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => 'Text Color',
                    'param_name' => 'text_color',
                    'dependency' => array('element' => 'text', 'not_empty' => true),
                    'group'      => 'Text Settings'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => 'Link',
                    'param_name'  => 'link',
                    'value'       => '',
                    'admin_label' => true
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => 'Link Text',
                    'param_name' => 'link_text',
                    'dependency' => array('element' => 'link', 'not_empty' => true)
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => 'Target',
                    'param_name' => 'target',
                    'value'      => array(
                        ''      => '',
                        'Self'  => '_self',
                        'Blank' => '_blank'
                    ),
                    'dependency' => array('element' => 'link', 'not_empty' => true),
                )
            )
        ));

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
            'image'			=> '',
            'image_size'		=> 'full',
            'title'		        => '',
            'title_tag'		    => 'h6',
            'title_color'		=> '',
            'text'		        => '',
            'text_color'		=> '',
            'link'                        => '',
            'link_text'                   => '',
            'target'                      => '_self'
        );

        $params = shortcode_atts($args, $atts);
        $params['image_size'] = $this->getImageSize($params['image_size']);
        $params['image'] = $this->getImage($params);
        $params['title_styles']    = $this->getTitleStyles($params);
        $params['title_tag'] = $this->getTitleTag($params,$args);
        $params['text_styles']     = $this->getTextStyles($params);

        $html = oxides_edge_get_shortcode_module_template_part('templates/cwiat-single', 'carousel-with-image-and-text', '', $params);

        return $html;

    }

    /**
     * Return image for carousel
     *
     * @param $params
     *
     * @return array
     */
    private function getImage($params) {

        $image = "";

        if ($params['image'] !== '') {

            $size = $params['image_size'];

            $img = wp_get_attachment_image_src($params['image'], $size);

            $image['url'] = $img[0];
            $image['width'] = $img[1];
            $image['height'] = $img[2];
            $image['title'] = get_the_title($params['image']);

        }

        return $image;

    }

    /**
     * Return image size or custom image size array
     *
     * @param $image_size
     * @return array
     */

    private function getImageSize($image_size) {

        //Remove whitespaces
        $image_size = trim($image_size);
        //Find digits
        preg_match_all( '/\d+/', $image_size, $matches );
        if ( !empty($matches[0]) ) {
            return array(
                $matches[0][0],
                $matches[0][1]
            );
        } elseif ( in_array( $image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full') )) {
            return $image_size;
        } else {
            return 'full';
        }

    }

    /**
     * Returns array of title styles
     *
     * @param $params
     *
     * @return array
     */

    private function getTitleStyles($params) {
        $styles = array();

        if(!empty($params['title_color'])) {
            $styles[] = 'color: '.$params['title_color'];
        }

        return $styles;
    }

    /**
     * Returns array of text styles
     *
     * @param $params
     *
     * @return array
     */

    private function getTextStyles($params) {
        $styles = array();

        if(!empty($params['text_color'])) {
            $styles[] = 'color: '.$params['text_color'];
        }

        return $styles;
    }

    /**
     * Return Title Tag. If provided heading isn't valid get the default one
     *
     * @param $params
     *
     * @return string
     */

    private function getTitleTag($params, $args){
        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
        return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];
    }


}