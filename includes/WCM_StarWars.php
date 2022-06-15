<?php

class WCMStarWars
{

    // Options sida, där man ska kunna kopiera in API URL,
    // och skriva people, så får man ut people.
    // Custom Post Type (CPT) för karaktärerna
    // Custom Fields (ACF) för de specifika delarna som finns för karaktären
    // ex. namn height mass skin color, etc etc.
    // Hämta data från APIet och skapa karaktärer.

    // Spara URL och gör anrop till:
    protected string $apiURL = 'https://swapi.dev/api/';

    public function __construct()
    {
        $this->addScripts();
        $this->addAjaxHandles();
        $this->addMenuPage();
    }

    public function addMenuPage()
    {
        add_action('admin_menu', [$this, 'setUpOptionsPage']);
    }

    public function setUpOptionsPage()
    {
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

    public function create_sw_menu_page()
    {
        $characters = get_transient('wcm_sw_character_list');
        $didAPICALL = 'Transient set successfully';

        if (!$characters) {
            $apiCall = wp_remote_get($this->apiURL . 'people');
            $characters = json_decode(wp_remote_retrieve_body($apiCall));
            // Define $didAPICALL as 'transient not set' if the transient is not set at this point
            $didAPICALL = 'transient not set';
            set_transient('wcm_sw_character_list', $characters);
        }

        include_once plugin_dir_path(__FILE__) . '../partials/sw_menu_page.php';
    }

    // ADD SCRIPTS AND ENQUEUEUEUUEUEUE
    protected function addScripts()
    {
        add_action('init', [$this, 'enqueueScripts']);
    }

    public function enqueueScripts()
    {
        wp_register_script('wcm_sw_script', plugins_url('../assets/starwars.js', __FILE__), [], '82', 'true');
        wp_enqueue_script('wcm_sw_script');
    }

    protected function addAjaxHandles()
    {
        add_action('wp_ajax_wc_sw_handle_form', [$this, 'handleForm']);
        add_action('wp_ajax_nopriv_wc_sw_handle_form', [$this, 'handleForm']);
    }

    public function handleForm()
    {
        if (!wp_verify_nonce($_POST['nonce'], 'wcm_sw_nonce')) {
            wp_send_json_error('Något gick fel!', 401);
            exit();
        }

        $apiCall = wp_remote_get($_POST['url']);
        $character = json_decode(wp_remote_retrieve_body($apiCall));

        $newPost = wp_insert_post([
            'post_title' => $character->name,
            'post_type' => 'sw_character',
            'meta_input' => [
                '_birthdate' => $character->birth_year,
                '_eye_color' => $character->eye_color,
                '_height' => $character->height,
            ],
        ]);

        if (! is_wp_error($newPost)) {
            wp_send_json_success([
                'status' => 'success',
                'message' => 'Karaktär har lagts till korrekt!'
            ]);
        } else {

            wp_send_json_error([
                'status' => 'error',
                'message' => 'Något gick sämst'
            ]);
        }
    }
}
