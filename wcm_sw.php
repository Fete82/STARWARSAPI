<?php

/**
 * Plugin Name: Star Wars Plugin of Doom
 * Author: FETUSLANUS
 * Text Domain: wcm_sw
 * Domain Path: /languages
 * Version: 1.0.82
 */

 register_activation_hook( __FILE__ , 'wcm_sw_activation');
 register_activation_hook( __FILE__ , 'wcm_sw_deactivation');

 function wcm_sw_activation() {
     flush_rewrite_rules();
 }
 
 function wcm_sw_deactivation() {
    flush_rewrite_rules();
}

require plugin_dir_path( __FILE__ ) . 'includes/WCM_StarWars.php';
function runWcmSW() {
    $wcm_sv = new WCMStarWars();
}
runWcmSW();