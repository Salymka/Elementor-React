<?php
/**
 * Plugin Name: Elementor React Addon
 * Plugin URI: 
 * Author: S-CRAFT
 * Author URI: 
 * Description: Simple start pack for develop elementor widgets with ReactJs.
 * Version: 1.0.0
 * License: 1.0.0
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: custom-elementor-react-addon
*/
namespace Custom_Widget\ElementorWidgets;

use Custom_Widget\ElementorWidgets\Widgets\Widget_1;
use Custom_Widget\ElementorWidgets\Widgets\Widget_2;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class CustomElementorReactAddon {

    const VERSION = '0.1.0';
    const ELEMENTOR_MINIMUM_VERSION = '3.0.0';
    const PHP_MINIMUM_VERSION = '7.0';

    private static $_instance = null;

    public function __construct() {
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
        add_action( 'elementor/elements/categories_registered', [ $this, 'create_new_category' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_custom_elementor_react_addon_scripts' ] );
    }

    public function i18n() {
        load_plugin_textdomain( 'custom-elementor-react-addon' );
    }

    public function init_plugin() {
        if ( version_compare( PHP_VERSION, self::PHP_MINIMUM_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_elementor' ] );
            return;
        }

        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::ELEMENTOR_MINIMUM_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        // check if elementor is installed
        // bring in the widget classes
        // bring in the controls
    }

    public function init_controls() {
        
    }

    public function init_widgets( $widgets_manager ) {

        // Require the widget class.
        require_once __DIR__ . '/widgets/widget-1.php';
        require_once __DIR__ . '/widgets/widget-2.php';

        // Register widget with elementor.
        $widgets_manager->register( new Widget_1() );
        $widgets_manager->register( new Widget_2() );

    }

    public static function get_instance() {

        if ( null == self::$_instance ) {
            self::$_instance = new Self();
        }

        return self::$_instance;

    }

    public function create_new_category( $elements_manager ) {

        $elements_manager->add_category(
            'custom-category',
            [
                'title' => __( 'Custom category', 'textdomain' ),
                'icon'  => 'fa fa-plug'
            ]
        );

    }

    public function enqueue_custom_elementor_react_addon_scripts() {
        wp_enqueue_script(
            'custom-widget-js',
            plugin_dir_url( __FILE__ ) . 'assets/js/main.js',
            [ 'jquery', 'elementor-frontend' ],
            '1.0.0',
            true
        );

        wp_enqueue_style(
            'custom-widget-css',
            plugin_dir_url( __FILE__ ) . 'assets/css/main.css',
            [],
            '1.0.0'
        );
    }

}

CustomElementorReactAddon::get_instance();