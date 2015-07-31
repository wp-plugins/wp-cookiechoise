<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Wp-CookieChoice
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Your Name or Company Name
 */
 
		$default_values = array(
			'kind' => 'top' ,
			'active' => false,
			'message' => 'Your message for visitors here',
			'close' => 'OK',
			'more' => 'learn more',
			'url' => 'http://example.com',
		);
 
 
 
 if(isset($_POST['send']) && $_POST['send']){
 
	// SAVE THAT SHIT
	
	$cookieChoice = get_option('cookiechoice','');

	if($cookieChoice == ''){ $cookieChoice = $default_values;  }
		
	if(isset($_POST['cookiechoice_integration'])){
	
		$cookieChoice['kind'] = sanitize_text_field($_POST['cookiechoice_integration']);
	
	}
	
	if(isset($_POST['cookiechoice_active'])){
	
		$cookieChoice['active'] = 1;
	
	} else {
	
		$cookieChoice['active'] = 0;
		
	}

	if(isset($_POST['cookiechoice_message'])){

		$cookieChoice['message'] = esc_html($_POST['cookiechoice_message']);
	
	} else {
	
		$cookieChoice['message'] = $default_value['message'];
		
	}
	
	if(isset($_POST['cookiechoice_close'])){
	
		$cookieChoice['close'] = sanitize_text_field($_POST['cookiechoice_close']);
	
	} else {
	
		$cookieChoice['close'] = $default_value['close'];
		
	}
	
	if(isset($_POST['cookiechoice_more'])){
	
		$cookieChoice['more'] = sanitize_text_field($_POST['cookiechoice_more']);
	
	} else {
	
		$cookieChoice['more'] = $default_value['more'];
		
	}
	
	if(isset($_POST['cookiechoice_url'])){
	
		$cookieChoice['url'] = sanitize_text_field($_POST['cookiechoice_url']);
	
	} else {
	
		$cookieChoice['url'] = $default_value['url'];
		
	}
	
	
	
	update_option( 'cookiechoice', $cookieChoice );		
	
	

	
	// REDIRECT NICELY
 
 }
 
 
 ?>



<div class="wrap">

	<?php 
	
		screen_icon(); 
	
		$cookieChoice = get_option('cookiechoice',$default_values);

	?>
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	
	<form action="" method="post">
		<table class="form-table">
			<tr valign="top">
			<th scope="row" > <label> Choose kind of integration</label> </th>
			<td>
			
				<?php 
				
				if($cookieChoice['kind'] == 'top') {
				
				?>
				
				<ul id="kind">
					<li>
					
						<h3>Fixed on top </h3>
						<img src="<?php echo plugins_url( '/wp-cookiechoise/assets/top.jpg' ); ?>" width="150" height="100" /><br />
						<input type="radio" checked="checked" name="cookiechoice_integration" value="top" />
    
					</li>
					<li>
						<h3>Popup solution</h3>
						<img src="<?php echo plugins_url( '/wp-cookiechoise/assets/popup.jpg' ); ?>" width="150" height="100" /><br />
						<input type="radio" name="cookiechoice_integration" value="popup" />
				
					</li>
				</ul>
				
				<?php 
				
				} else {

				?>
				
				<ul>
					<li style="display:inline-block;">
						<h3>Fixed on top </h3>
						<img src="<?php echo plugins_url( '/wp-cookiechoise/assets/top.jpg' ); ?>" width="150" height="100" /><br />
						<input type="radio" name="cookiechoice_integration" value="top" />
					</li>
					<li style="display:inline-block;">
						<h3>Popup solution</h3>
						<img src="<?php echo plugins_url( '/wp-cookiechoise/assets/popup.jpg' ); ?>" width="150" height="100" /><br />	
						<input type="radio" checked="checked" name="cookiechoice_integration" value="popup" />
					</li>
				</ul>	
				
				<?php 
				
				}
				
				?>
			
			
			</td>
			</tr>
			
			
			<tr valign="top">
			<th scope="row" > <label>Your message for visitors here</label> </th>
			<td>
		
				<input type="text" name="cookiechoice_message" value="<?php echo $cookieChoice['message']; ?>" /><br />
				<span class="description">Example for German: Cookies erleichtern die Bereitstellung unserer Dienste. Mit der Nutzung unserer Dienste erklären Sie sich damit einverstanden, dass wir Cookies verwenden.</span>
			</td>
			</tr>
			
			<tr valign="top">
			<th scope="row" > <label>close message</label> </th>
			<td>

				<input type="text" name="cookiechoice_close" value="<?php echo $cookieChoice['close']; ?>" />
				
			</td>
			</tr>
			
			<tr valign="top">
			<th scope="row" > <label>learn more</label> </th>
			<td>

				<input type="text" name="cookiechoice_more" value="<?php echo $cookieChoice['more']; ?>" /><br />
				<span class="description">Example: more informations </span>	
			</td>
			</tr>
			
			<tr valign="top">
			<th scope="row" > 
				<label>Link to privacy page</label> 
				
			</th>
			<td>

				<input type="text" name="cookiechoice_url" value="<?php echo $cookieChoice['url']; ?>" /><br />
				<span class="description">Example: /pricacy </span>
				
			</td>
			</tr>
			
			
			
			
			
			
			
			
			<tr valign="top">
			<th scope="row" > <label>Active</label> </th>
			<td>
			
				<?php 
				
				if($cookieChoice['active']) {
				
				?>
			
				<input type="checkbox" checked="checked" name="cookiechoice_active" value="1" />
				
				<?php 
				
				} else {
								
				?>
				
				<input type="checkbox" name="cookiechoice_active" value="1" />
				
				<?php 
				
				}
				
				?>
				
			</td>
			</tr>
			
			<tr valign="top">
			<th scope="row"></th >
			<td> <input type="submit" class="button-primary" name="sender" value="save Code" /> </td>
			</tr>
			</tr>
		</table>
		
		
		
		<input type="hidden" name="send" value="send" />
	</form>
	
	<!-- TODO: Provide markup for your options page here. -->

</div>
