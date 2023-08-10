<div class="wrap">
	<h1>Hi I am admin</h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active" ><a href="#tab-1">Manage Settings</a></li>
		<li><a href="#tab-2">Updates</a></li>
		<li><a href="#tab-3">About</a></li>
	</ul>
	<div class="tab-content">
		<div id="tab-1" class="active tab-pane">
			<form method="post" action="options.php">
				<?php 
					settings_fields( 'awesome_plugin_settings' );
					do_settings_sections( 'awesome_plugin' );
					submit_button();
				?>
			</form>
		</div>
		<div id="tab-2" class="tab-pane">
			<h1>Updates</h1>
		</div>
		<div id="tab-3" class="tab-pane">
			<h1>About</h1>
		</div>
	</div>
</div>