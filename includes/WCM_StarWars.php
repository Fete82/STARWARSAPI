<?php

class WCMStarWars {

     // Options sida, där man ska kunna kopiera in API URL,
     // och skriva people, så får man ut people.
     // Custom Post Type (CPT) för karaktärerna
     // Custom Fields (ACF) för de specifika delarna som finns för karaktären
     // ex. namn height mass skin color, etc etc.
     // Hämta data från APIet och skapa karaktärer.

    // Spara URL och gör anrop till:
    protected string $apiURL = 'https://swapi.dev/api/';

    public function __construct() {
       $this->addMenuPage();
    }

    public function addMenuPage() {
        add_action('admin_menu', [$this, 'setUpOptionsPage']);
    }
     
    public function setUpOptionsPage() {
        add_menu_page(
            'Star Wars API',
            'Star Wars Settings',
            'manage_options',
            'star_wars_settings',
            [$this, 'create_sw_menu_page'],
            'dashicons-document',
            20
        );

        // Anrop till API i options

    }

    public function create_sw_menu_page() {
        $apiCall = wp_remote_get($this->apiURL . 'people');
        $characters = json_decode(wp_remote_retrieve_body($apiCall));

        include_once plugin_dir_path(__FILE__) . '../partials/sw_menu_page.php';
    }
}
