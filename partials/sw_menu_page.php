<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form action="options.php" method="post">
		<?php

		// output security fields for the registered setting "wcm_menu"
		settings_fields( 'wcm_sw_settings' );
		// output setting sections and their fields
		// (sections are registered for "wcm_menu", each field is registered to a specific section)
		do_settings_sections( 'wcm_sw_settings' );

		//do_settings_fields('wcm_newsletter_settings', 'default');
		// output save settings button
		submit_button( __( 'Save Settings', 'wcm_sw' ) );
		?>
    </form>
</div>
<?php
echo $characters->results[0]->name;
?>