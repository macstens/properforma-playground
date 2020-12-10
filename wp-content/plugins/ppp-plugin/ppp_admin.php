<?php
    if($_POST['ppp_hidden'] == 'Y') {
        //Form data sent
		$dbhost = $_POST['ppp_dbhost'];
		update_option('ppp_dbhost', $dbhost);

		$dbname = $_POST['ppp_dbname'];
		update_option('ppp_dbname', $dbname);

		$dbuser = $_POST['ppp_dbuser'];
		update_option('ppp_dbuser', $dbuser);

		$dbpwd = $_POST['ppp_dbpwd'];
		update_option('ppp_dbpwd', $dbpwd);

		$prod_img_folder = $_POST['ppp_prod_img_folder'];
		update_option('ppp_prod_img_folder', $prod_img_folder);

		$store_url = $_POST['ppp_store_url'];
		update_option('ppp_store_url', $store_url);
	?>
		<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
	<?php
    } else {
        //Normal page display
	    $dbhost = get_option('ppp_dbhost');
	    $dbname = get_option('ppp_dbname');
	    $dbuser = get_option('ppp_dbuser');
	    $dbpwd = get_option('ppp_dbpwd');
	    $prod_img_folder = get_option('ppp_prod_img_folder');
	    $store_url = get_option('ppp_store_url');
    }
?>
<div class="wrap">
	<?php    echo "<h2>" . __( 'Pro Performa Options', 'ppp_trdom' ) . "</h2>"; ?>

	<form name="ppp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="ppp_hidden" value="Y">
		<?php    echo "<h4>" . __( 'Pro Performa Database Settings', 'ppp_trdom' ) . "</h4>"; ?>
		<p><?php _e("Database host: " ); ?><input type="text" name="ppp_dbhost" value="<?php echo $dbhost; ?>" size="20"><?php _e(" ex: localhost" ); ?></p>
		<p><?php _e("Database name: " ); ?><input type="text" name="ppp_dbname" value="<?php echo $dbname; ?>" size="20"><?php _e(" ex: oscommerce_shop" ); ?></p>
		<p><?php _e("Database user: " ); ?><input type="text" name="ppp_dbuser" value="<?php echo $dbuser; ?>" size="20"><?php _e(" ex: root" ); ?></p>
		<p><?php _e("Database password: " ); ?><input type="text" name="ppp_dbpwd" value="<?php echo $dbpwd; ?>" size="20"><?php _e(" ex: secretpassword" ); ?></p>
		<hr />
		<?php    echo "<h4>" . __( 'Pro Performa Storage Settings', 'ppp_trdom' ) . "</h4>"; ?>
		<p><?php _e("Base URL: " ); ?><input type="text" name="ppp_store_url" value="<?php echo $store_url; ?>" size="20"><?php _e(" ex: http://www.yourstore.com/" ); ?></p>
		<p><?php _e("Image folder: " ); ?><input type="text" name="ppp_prod_img_folder" value="<?php echo $prod_img_folder; ?>" size="20"><?php _e(" ex: http://www.yourstore.com/images/" ); ?></p>

		<p class="submit">
			<input type="submit" name="Submit" value="<?php _e('Update Options', 'ppp_trdom' ) ?>" />
		</p>
	</form>
</div>