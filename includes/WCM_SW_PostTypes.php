<?php

class WCM_SW_PostTypes {

    public function __construct()
    {
        $this->addPostTypeAction();
    }

    public function addPostTypeAction() {
        add_action('init', [$this, 'addPostType']);
    }

    public function addPostType() {

        register_post_type('sw_character', [
            'labels' => [
                'name' => 'Characters',
                'singular' => 'Character'
            ],
            'public' => true,
            'supports' => ['title', 'custom-fields']
            ]);
    }
}