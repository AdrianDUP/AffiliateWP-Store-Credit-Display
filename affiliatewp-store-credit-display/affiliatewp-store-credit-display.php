<?php

/**
 * Plugin Name: AffiliateWP Store Credit Display
 * Plugin URI: https://github.com/Jogger71/AffiliateWP-Store-Credit-Display
 * Author: Adrian Du Plessis
 * Author URI: https://github.com/Jogger71/
 *
 * Description: This plugin displays the current amount of store credit that you have left in your affiliate's affiliate area under statistics.
 *
 * Version: 1.0.0
 */

if ( ! defined('ABSPATH' ) ) {
    exit('Cheaters Detected');
}

if ( ! class_exists('AFFWP_Store_Credit_Display') ) {
    class AFFWP_Store_Credit_Display {

        /**
         * @var AFFWP_Store_Credit_Display $instance The instance for the main plugin class
         * @since 1.1.0
         */
        private static $instance;

        /**
         * Class Constructor
         *
         * The Constructor has been deprecated as class initialisation method in version 1.1.0 in favour of instance()
         */
        /*public function __construct() {
            if ( self::is_prerequisite_checks_good() ) {
                //  Create some definitions
                if (!defined('SCD_PLUGIN_DIR')) {
                    define('SCD_PLUGIN_DIR', dirname(__FILE__));
                }

                //  Add the required actions
                add_action('affwp_affiliate_dashboard_after_earnings', array( $this, 'store_credit_display' ), 10, 1);
            } else {
                add_action('admin_notices', array($this, 'display_errors'));
            }
        }*/

        /**
         * This function will create the instance for the class. This should be the only way to create an instance.
         *
         * @return AFFWP_Store_Credit_Display
         * @since 1.1.0
         */
        public static function instance() {
            if ( !isset( self::$instance ) && !( self::$instance instanceof AFFWP_Store_Credit_Display) ) {
                self::$instance = new AFFWP_Store_Credit_Display();

                if ( self::is_prerequisite_checks_good() ) {
                    //  Set the constants
                    self::$instance->set_constants();

                    //  Add the required actions
                    add_action('affwp_affiliate_dashboard_after_earnings', array( self::$instance, 'store_credit_display' ), 10, 1);
                } else {
                    add_action('admin_notices', array(self::$instance, 'display_errors'));
                }
            }
            return self::$instance;
        }

        /**
         * Prerequisite Checks. Ensure everything needed has been activated.
         *
         * @since 1.0.0
         */
        public static function prerequisite_checks() {
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

            if ( is_plugin_active( 'affiliate-wp/affiliate-wp.php' ) && is_plugin_active( 'affiliatewp-store-credit/affiliatewp-store-credit.php' ) ) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * Returns if prerequisite checks is good
         *
         * @since 1.0.0
         */
        public static function is_prerequisite_checks_good() {
            return self::prerequisite_checks();
        }

        /**
         * This function generates the necessary errors if the prerequisite checks fail
         *
         * @since 1.0.0
         */
        public function display_errors() {
            echo '<div class="error"><p><strong>';
            _e('Warning, this plugin requires both AffiliateWP and AffiliateWP Store Credit in order to work!', 'affwp-scd');
            echo '</strong></p></div>';
        }

        /**
         * Sets all the constant values for the plugin
         *
         * @access private
         * @since 1.1.0
         */
        private function set_constants() {
            if (!defined('SCD_PLUGIN_DIR')) {
                define('SCD_PLUGIN_DIR', dirname(__FILE__));
            }
        }

        /**
         * Action function that will render the additional information
         *
         * @param int $user
         * @since 1.0.0
         */
        public function store_credit_display($user) {
            include_once(SCD_PLUGIN_DIR . '/templates/template-affiliate-store-credit.php');
        }
    }
}

function affwp_store_credit_display() {
    return AFFWP_Store_Credit_Display::instance();
}
affwp_store_credit_display();