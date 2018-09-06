<?php
namespace EdgeOxidesfModules\Shortcodes\SingleProduct;

use EdgeOxidesfModules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class SingleProduct
 * @package EdgeOxidesfModules\Shortcodes\SingleProduct
 */
class SingleProduct implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     *
     */
    public function __construct() {
        $this->base = 'edgtf_single_product';

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
            'name'                      => esc_html__('Edge Single Product', 'oxides'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-single-product extended-custom-icon',
            'category'                  => 'by EDGE',
            'allowed_container_element' => 'vc_row',
            'params'                    =>
                array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Stock Keeping Unit (SKU)',
                        'param_name'  => 'sku',
                        'value'       => '',
                        "description" => "",
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
                        )
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => 'Title Color',
                        'param_name' => 'title_color'
                    ),
                    array(
                        "type" => "dropdown",
                        "class" => "",
                        "heading" => "Image Size",
                        "param_name" => "image_size",
                        "value" => array(
                            "Original" => "original",
                            "Landscape" => "landscape",
                            "Portrait" => "portrait",
                            "Square" => "square"
                        ),
                        "save_always" => true,
                        "description" => "",
                    ),
                )
            )
        );
    }

    /**
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'sku'                         => '',
            'title_tag'                   => 'h6',
            'title_color'                 => '',
            'image_size'                 => '',
        );

        $params       = shortcode_atts($default_atts, $atts);

        $params['title_styles']     = $this->getTitleStyles($params);
        $params['product_params']     = $this->getProductParams($params);
        return oxides_edge_get_shortcode_module_template_part('templates/single-product', 'single-product', '', $params);
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
     * Returns array of product details
     *
     * @param $params
     *
     * @return array
     */

    private function getProductParams($params){
        $params_array = array();

        if($params['sku'] != '') {

            $meta_query = WC()->query->get_meta_query();

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 1,
                'no_found_rows' => 1,
                'post_status' => 'publish',
                'meta_query' => $meta_query
            );

            $args['meta_query'][] = array(
                'key' => '_sku',
                'value' => $params['sku'],
                'compare' => '='
            );


            switch ($params['image_size']) {
                case 'landscape':
                    $thumb_image_size = 'portfolio-landscape';
                    break;
                case 'square':
                    $thumb_image_size = 'portfolio-square';
                    break;
                case 'portrait':
                    $thumb_image_size = 'portfolio-portrait';
                    break;
                default:
                    $thumb_image_size = 'full';
                    break;
            }

            $q = new \WP_Query($args);

            while ($q->have_posts()) : $q->the_post();

                $product = wc_get_product(get_the_ID());

                $params_array['on_sale'] = $product->is_on_sale();
                $params_array['out_of_stock'] = !$product->is_in_stock();
                $params_array['image'] = get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
                $params_array['title'] = get_the_title();
                $params_array['price'] = $product->get_price_html();
                $params_array['link'] = $product->get_permalink();
                $params_array['excerpt'] = get_the_excerpt();

                $params_array['rating_exists'] = 'no';
                if ( $product->get_rating_html() ) {
                    $params_array['rating_exists'] = 'yes';
                    $params_array['rating'] = $product->get_rating_html();
                }


                /* information for add to cart button */
                $params_array['add_to_cart_url'] = $product->add_to_cart_url();
                $params_array['id'] = get_the_ID();
                $params_array['sku'] = $product->get_sku();
                $params_array['quantity'] = isset( $quantity ) ? $quantity : 1;
                $params_array['type'] = $product->product_type;
                $params_array['add_to_cart_text'] = $product->add_to_cart_text();
                $params_array['is_in_stock'] = $product->is_in_stock();



            endwhile;
            wp_reset_postdata();

        }
        return $params_array;
    }
}