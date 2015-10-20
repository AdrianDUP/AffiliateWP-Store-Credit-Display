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
         * Class Constructor
         */
        public function __construct() {
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

function store_credit_display() {
    return new AFFWP_Store_Credit_Display();
}
store_credit_display();