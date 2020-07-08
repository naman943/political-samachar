<?php

/**
 * WordPress settings API
 * @author WP Qastle <info@wpqastle.com>
 */

if ( !class_exists('BNT_Settings_API_News_Ticker' ) ):
class BNT_Settings_API_News_Ticker {

    private $settings_api;

    function __construct() {
        $this->settings_api = new AmityThemes_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_menu_page( 'Ticker Options', 'Ticker Options', 'delete_posts', 'breaking-news-ticker', array($this, 'bnt_plugin_page') );

        // Returning true.
        return true;
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'bnt_basics',
                'title' => __( 'Basic Options', 'breaking-nt' )
            ),
            array(
                'id' => 'bnt_ticker',
                'title' => __( 'Ticker Options', 'breaking-nt' )
            ),
            array(
                'id' => 'bnt_styles',
                'title' => __( 'Style Options', 'breaking-nt' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() { 

        $pt_args = array('public' => true);
        $output = 'names'; // names or objects, note names is the default
        $operator = 'and'; // 'and' or 'or'
        $bnt_post_types = get_post_types( $pt_args, $output, $operator );
        $arr2['options'] = array();

                foreach ( $bnt_post_types as $bnt_post_type ) {

                        $arr2['name'] = 'bnt_post_type';
                        $arr2['label'] = 'Post Type';
                        $arr2['desc'] = 'Select One';
                        $arr2['type'] = 'select';
                        $arr2['options'][$bnt_post_type] = $bnt_post_type;

                }

        $args = array( 'hide_empty=0' );
        $terms = get_terms( 'category', $args );
        $arr['options'] = array();
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $count = count( $terms );
                $i = 0;
                    foreach ( $terms as $term ) {
                         $i++;

                        $cat_id = $term->term_id;
                        $cat_name = $term->name;

                        $arr['name'] = 'bnt_cat';
                        $arr['label'] = 'Post Category ';
                        $arr['desc'] = 'Default: All (If you select post_type "POST" )';
                        $arr['type'] = 'multicheck';
                        $arr['default'] = 'no';
                        $arr['options'][$cat_id] = $cat_name;

                }
            }

        $settings_fields = array(

            'bnt_basics' => array(
                array(
                    'name'              => 'activate_deactivate',
                    'label'             => __('Activate', 'breaking-nt'),
                    'desc'              => __('Default: Activate', 'breaking-nt'),
                    'type'              => 'select',
                    'options'           => array(
                                'Yes'       => 'Activate',
                                'No'        => 'Deactivate'
                    )
                ),

                array(
                    'name'              => 'main_title',
                    'label'             => __('Breaking News Title', 'breaking-nt'),
                    'desc'              => __('Type in the ticker title text.', 'breaking-nt'),
                    'type'              => 'text',
                    'default'           => 'Breaking News'
                ),

                array(
                    'name'              => 'display_date',
                    'label'             => __('Display Date', 'breaking-nt'),
                    //'desc'              => __('', 'breaking-nt'),
                    'type'              => 'select',
                    'options'           => array(
                                'Yes'       => 'YES',
                                'No'        => 'NO'
                    )
                ),

                array(
                    'name'              => 'posts_per_page',
                    'label'             => __('Display Posts', 'breaking-nt'),
                    'desc'              => __('Enter the maximum number of posts. Default : 5', 'breaking-nt'),
                    'type'              => 'number',
                    'default'           => '5'
                ),

                array(
                    'name'              => 'posts_order',
                    'label'             => __('Posts Order', 'breaking-nt'),
                    'desc'              => __('Default: DESC', 'breaking-nt'),
                    'type'              => 'select',
                    'options'           => array (
                            'DESC'      => 'Default',
                            'ASC'       => 'ASC',
                            'DESC'      => 'DESC'
                        )
                )
            ),
 
            'bnt_ticker' => array(
                array(
                    'name'              => 'direction',
                    'label'             => __('Ticker Direction', 'breaking-nt'),
                    //'desc'              => __('Default: UP', 'breaking-nt'),
                    'type'              => 'select',
                    'options'           => array (
                            'up'       => 'UP',
                            'down'       => 'DOWN'
                    )
                ),

                array(
                    'name'              => 'speed',
                    'label'             => __('Ticker Speed', 'breaking-nt'),
                    //'desc'              => __('', 'breaking-nt'),
                    'type'              => 'number',
                    'default'           => '500'
                ),

                array(
                    'name'              => 'interval',
                    'label'             => __('Ticker Duration', 'breaking-nt'),
                    //'desc'              => __('', 'breaking-nt'),
                    'type'              => 'number',
                    'default'           => '3000'
                ),
                array(
                    'name'              => 'mouse_pause',
                    'label'             => __('Mouse Pause', 'breaking-nt'),
                    //'desc'              => __('', 'breaking-nt'),
                    'type'              => 'select',
                    'options'           => array (
                            '1'       => 'YES',
                            '0'       => 'NO'
                    )
                ),

                array(
                    'name'              => 'controls',
                    'label'             => __('Show Controls', 'breaking-nt'),
                    //'desc'              => __('', 'breaking-nt'),
                    'type'              => 'select',
                    'options'           => array(
                                'Yes'       => 'YES',
                                'No'        => 'NO'
                    )
                ),

                array(
                    'name'              => 'control-top',
                    'label'             => __('Control Top Margin', 'breaking-nt'),
                    'desc'              => __('Default: 5px', 'breaking-nt'),
                    'type'              => 'number',
                    'default'           => '5'
                ),
            ),
            
            'bnt_styles' => array(
                array(
                    'name'              => 'border_radius',
                    'label'             => __('Border Radius', 'breaking-nt'),
                    'desc'              => __('Default: 0px', 'breaking-nt'),
                    'type'              => 'number',
                    'default'           => '0'
                   
                ),

                array(
                    'name'              => 'border_width',
                    'label'             => __('Border', 'breaking-nt'),
                    'desc'              => __('Default: 0px', 'breaking-nt'),
                    'type'              => 'number',
                    'default'           => '0'
                ),

                 array(
                    'name'              => 'border_style',
                    'label'             => __('Border Style', 'breaking-nt'),
                    'desc'              => __('Default: Solid', 'breaking-nt'),
                    'type'              => 'select',
                    'options'           => array (
                            'solid'       => 'Solid',
                            'dotted'      => 'Dotted',
                            'dashed'      => 'Dashed',
                            'double'      => 'Double'

                        )
                ),

                array(
                    'name'              => 'border_color',
                    'label'             => __('Border Color', 'breaking-nt'),
                    //'desc'              => __('', 'breaking-nt'),
                    'type'              => 'color',
                    'default'           => '#222222'
                ),

                array(
                    'name'              => 'title_length',
                    'label'             => __('Title Length', 'breaking-nt'),
                    'desc'              => __('Enter the maximum number of title Length. Default : 55', 'breaking-nt'),
                    'type'              => 'number',
                    'default'           => '55'
                ),

                array(
                    'name'              => 'title_font_size',
                    'label'             => __('Title Font Size', 'breaking-nt'),
                    'desc'              => __('Default: 16px', 'breaking-nt'),
                    'type'              => 'number',
                    'default'           => '15'
                ),

                array(
                    'name'              => 'title_font_color',
                    'label'             => __('Title Font Color', 'breaking-nt'),
                    //'desc'              => __('', 'breaking-nt'),
                    'type'              => 'color',
                    'default'           => '#FFFFFF'
                ),

                array(
                    'name'              => 'title_bg_color',
                    'label'             => __('Title Background Color', 'breaking-nt'),
                    //'desc'              => __('', 'breaking-nt'),
                    'type'              => 'color',
                    'default'           => '#333333'
                ),

                array(
                    'name'              => 'ticker_bg_color',
                    'label'             => __('Background Color', 'breaking-nt'),
                    //'desc'              => __('', 'breaking-nt'),
                    'type'              => 'color',
                    'default'           => '#222222'
                ),

                array(
                    'name'              => 'headline_font_size',
                    'label'             => __('Headline Font Size', 'breaking-nt'),
                    'desc'              => __('Default: 16px', 'breaking-nt'),
                    'type'              => 'number',
                    'default'           => '16'
                ),

                array(
                    'name'              => 'headline_title_color',
                    'label'             => __('Headline Color', 'breaking-nt'),
                    //'desc'              => __('', 'breaking-nt'),
                    'type'              => 'color',
                    'default'           => '#FFFFFF'
                ),

                array(
                    'name'              => 'date_color',
                    'label'             => __('Date Color', 'breaking-nt'),
                    //'desc'              => __('', 'breaking-nt'),
                    'type'              => 'color',
                    'default'           => '#FFFFFF'
                ),

                array(
                    'name'              => 'control_button_bg',
                    'label'             => __('Controls Button Background', 'breaking-nt'),
                    //'desc'              => __('', 'breaking-nt'),
                    'type'              => 'color',
                    'default'           => '#dd3333'
                )
            )

        );

       array_push($settings_fields['bnt_basics'], $arr2);
       array_push($settings_fields['bnt_basics'], $arr);
   
   return $settings_fields;
    }

    function BNT_plugin_page() {
        echo '<div class="wrap">';
        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();
        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}

endif;

$settings = new BNT_Settings_API_News_Ticker();