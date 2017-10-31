<h1><?php echo get_admin_page_title() ?></h1>

<form action="" method="post">
	<?php    
    
	do_settings_sections('helloicms_integration');    
    
	submit_button(__('Save Settings','helloicms'));
	?>
</form>
