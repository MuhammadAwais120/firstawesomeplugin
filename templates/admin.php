<div class="wrap">
    <h1>Hi I am Admin :)</h1>
	<?php settings_errors(); ?>

	<form method="post" action="options.php">
		<?php 
			settings_fields( 'awesome_options_group' );
			do_settings_sections( 'awesome_plugin' );
			submit_button();
		?>
	</form>
</div>