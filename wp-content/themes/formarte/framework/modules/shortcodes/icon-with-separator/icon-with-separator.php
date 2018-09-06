<?php
namespace EdgeOxidesfModules\Shortcodes\IconWithSeparator;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class IconWithSeparator
 * @package EdgeOxidesfModules\Shortcodes\IconWithSeparator
 */
class IconWithSeparator implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     *
     */
    public function __construct() {
        $this->base = 'edgtf_icon_with_separator';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     *
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Edge Icon With Separator', 'oxides'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-icon-with-separator extended-custom-icon',
            'category'                  => 'by EDGE',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                oxides_edge_icon_collections()->getVCParamsArray(),
                array(
                    array(
                        'type'       => 'attach_image',
                        'heading'    => 'Custom Icon',
                        'param_name' => 'custom_icon'
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Icon Size',
                        'param_name'  => 'icon_size',
                        'value'       => array(
                            'Tiny'       => 'edgtf-icon-tiny',
                            'Small'      => 'edgtf-icon-small',
                            'Medium'     => 'edgtf-icon-medium',
                            'Large'      => 'edgtf-icon-large',
                            'Very Large' => 'edgtf-icon-huge'
                        ),
                        'admin_label' => true,
                        'save_always' => true,
                        'group'       => 'Icon Settings',
                        'description' => 'This attribute doesn\'t work when Icon Position is Top'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => 'Custom Icon Size (px)',
                        'param_name' => 'custom_icon_size',
                        'group'      => 'Icon Settings'
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Icon Animation',
                        'param_name'  => 'icon_animation',
                        'value'       => array(
                            'No'  => '',
                            'Yes' => 'yes'
                        ),
                        'group'       => 'Icon Settings',
                        'admin_label' => true
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => 'Icon Animation Delay (ms)',
                        'param_name' => 'icon_animation_delay',
                        'group'      => 'Icon Settings',
                        'dependency' => array('element' => 'icon_animation', 'value' => array('yes'))
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Icon Bottom Margin (px)',
                        'param_name'  => 'icon_margin_bottom',
                        'value'       => '',
                        'admin_label' => true,
                        'group'       => 'Icon Settings',
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => 'Icon Color',
                        'param_name' => 'icon_color',
                        'group'      => 'Icon Settings'
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => 'Icon Hover Color',
                        'param_name' => 'icon_hover_color',
                        'group'      => 'Icon Settings'
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
                        'type'       => 'colorpicker',
                        'heading'    => 'Title Hover Color',
                        'param_name' => 'title_hover_color',
                        'dependency' => array('element' => 'title', 'not_empty' => true),
                        'group'      => 'Text Settings'
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => 'Color',
                        'param_name' => 'separator_color',
                        'group'      => 'Separator Settings',
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => 'Width',
                        'param_name' => 'separator_width',
                        'group'      => 'Separator Settings',
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => 'Thickness',
                        'param_name' => 'separator_thickness',
                        'group'      => 'Separator Settings',
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Margin Top',
                        'param_name'  => 'separator_margin_top',
                        'value'       => '',
                        'admin_label' => true,
                        'group'       => 'Separator Settings',
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Margin Bottom',
                        'param_name'  => 'separator_margin_bottom',
                        'value'       => '',
                        'admin_label' => true,
                        'group'       => 'Separator Settings',
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => 'Elements Alignment',
                        'param_name' => 'elements_alignment',
                        'value'      => array(
                            'Center' => 'center',
                            'Left'   => 'left',
                            'Right'  => 'right'
                        ),
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type'       => 'textarea',
                        'heading'    => 'Text',
                        'param_name' => 'text'
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
                        'type'       => 'dropdown',
                        'heading'    => 'Target',
                        'param_name' => 'target',
                        'value'      => array(
                            ''      => '',
                            'Self'  => '_self',
                            'Blank' => '_blank'
                        ),
                        'dependency' => array('element' => 'link', 'not_empty' => true),
                    ),
                    array(
                        'type'       => 'dropdown',
                        'heading'    => 'Animate on hover',
                        'param_name' => 'animate',
                        'value'      => array(
                            'No'     => 'no',
                            'Yes'    => 'yes' 
                        ),
                        'save_always'=> true,
                        'dependency' => array('element' => 'link', 'not_empty' => true),
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => 'Separator hover color',
                        'param_name' => 'separator_hover_color',
                        'dependency' => array('element' => 'animate', 'value' => array('yes'))
                    )
                )
            )
        ));
    }

    /**
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'custom_icon'                 => '',
            'icon_size'                   => '',
            'custom_icon_size'            => '',
            'icon_animation'              => '',
            'icon_animation_delay'        => '',
            'icon_margin_bottom'          => '',
            'icon_color'                  => '',
            'icon_hover_color'            => '',
            'title'                       => '',
            'title_tag'                   => 'h6',
            'title_color'                 => '',
            'title_hover_color'           => '',
            'separator_color'             => '',
            'separator_width'             => '',
            'separator_thickness'         => '',
            'separator_margin_top'        => '',
            'separator_margin_bottom'     => '',
            'elements_alignment'          => '',
            'text'          => '',
            'text_color'          => '',
            'link'                        => '',
            'target'                      => '_self',
            'animate'                     => 'no',
            'separator_hover_color'       => ''
        );

        $default_atts = array_merge($default_atts, oxides_edge_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        $params['holder_classes']   = $this->getHolderClasses($params);
        $params['holder_data']      = $this->getHolderDataAttr($params);
        $params['icon_parameters']  = $this->getIconParameters($params);
        $params['icon_styles']      = $this->getIconStyles($params);
        $params['title_styles']     = $this->getTitleStyles($params);
        $params['separator_params'] = $this->getSeparatorStyles($params);
        $params['lines_params']     = $this->getLinesStyles($params);
        $params['text_styles']      = $this->getTextStyles($params);

        return oxides_edge_get_shortcode_module_template_part('templates/iws', 'icon-with-separator', '', $params);
    }

    /**
     * Returns parameters for icon shortcode
     *
     * @param $params
     *
     * @return array
     */
    private function getIconParameters($params) {
        $params_array = array();

        if(empty($params['custom_icon'])) {
            $iconPackName = oxides_edge_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

            $params_array['icon_pack']   = $params['icon_pack'];
            $params_array[$iconPackName] = $params[$iconPackName];

            if(!empty($params['icon_size'])) {
                $params_array['size'] = $params['icon_size'];
            }

            if(!empty($params['custom_icon_size'])) {
                $params_array['custom_size'] = $params['custom_icon_size'];
            }

            $params_array['icon_color'] = $params['icon_color'];

            /* hover color is not passed to icon shortcode, but rendering in this shortcode */

            $params_array['icon_animation']       = $params['icon_animation'];
            $params_array['icon_animation_delay'] = $params['icon_animation_delay'];
        }

        return $params_array;
    }

    /**
     * Returns style for icon
     *
     * @param $params
     *
     * @return array
     */

    private function getIconStyles($params) {
        $styles = array();

        if(!empty($params['icon_margin_bottom'])) {
            $styles[] = 'margin-bottom: '.oxides_edge_filter_px($params['icon_margin_bottom']).'px';
        }

        return $styles;
    }


    /**
     * Returns array of holder classes
     *
     * @param $params
     *
     * @return array
     */
    private function getHolderClasses($params) {
        $classes = array();


        if($params['animate'] == 'yes') {
            $classes[] = 'animate';
        }

        if(!empty($params['elements_alignment'])) {
            switch($params['elements_alignment']) {
                case 'center':
                    $classes[] = 'text-align-center';
                    break;
                case 'left':
                    $classes[] = 'text-align-left';
                    break;
                case 'right':
                    $classes[] = 'text-align-right';
                    break;
                default:
                    break;
            }
        }


        return implode(' ', $classes);
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

        if(!empty($params['title_margin_top'])) {
            $styles[] = 'margin-top: '.oxides_edge_filter_px($params['title_margin_top']).'px';
        }

        if(!empty($params['title_margin_bottom'])) {
            $styles[] = 'margin-bottom: '.oxides_edge_filter_px($params['text_right_padding']).'px';
        }

        return $styles;
    }

    /**
     *
     * Returns array of title and icon data attr
     *
     * @param $params
     *
     * @return array
     */
    private function getHolderDataAttr($params) {
        $data = array();

        if(!empty($params['title_hover_color'])) {
            $data['data-iws-title-hover-color'] = $params['title_hover_color'];
        }

        if(!empty($params['icon_hover_color'])) {
            $data['data-iws-icon-hover-color'] = $params['icon_hover_color'];
        }

        if(!empty($params['separator_width'])) {
            $data['data-iws-lines-width'] = oxides_edge_filter_px($params['separator_width']);
        }

        return $data;
    }

    /**
     * Returns array of separator styles
     *
     * @param $params
     *
     * @return array
     */

    private function getSeparatorStyles($params) {
        $styles = array();

        if(!empty($params['separator_width'])) {
            $styles['width'] = oxides_edge_filter_px($params['separator_width']);
        }

        if(!empty($params['separator_thickness'])) {
            $styles['thickness'] = oxides_edge_filter_px($params['separator_thickness']);
        }

        if(!empty($params['separator_margin_top'])) {
            $styles['top_margin'] = oxides_edge_filter_px($params['separator_margin_top']);
        }

        if(!empty($params['separator_margin_bottom'])) {
            $styles['bottom_margin'] = oxides_edge_filter_px($params['separator_margin_bottom']);
        }

        if(!empty($params['separator_color'])) {
            $styles['color'] = $params['separator_color'];
        }

        return $styles;
    }


    /**
     * Returns array of lines styles
     *
     * @param $params
     *
     * @return array
     */

    private function getLinesStyles($params) {
        $styles = array();

        if(!empty($params['separator_hover_color'])) {
            $styles[] = 'background-color: '.$params['separator_hover_color'];
        }

        if(!empty($params['separator_thickness'])) {
            $height = '';
            $height = oxides_edge_filter_px($params['separator_thickness']);
            $styles[] = 'height: '.$height. 'px';
        }

        if(!empty($params['separator_margin_top'])) {
            $top = '';
            $top = oxides_edge_filter_px($params['separator_margin_top']);
            $styles[] = 'top: '.$top. 'px';
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
}