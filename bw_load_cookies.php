<?php 
   /*
   Plugin Name: Cookies Notice 
   Plugin URI: http://blickwert.at
   description: activate a Cookies Notice
   Version: 1.0
   Author: Kreativb&uuml;ro blickwert
   Author URI: http://blickwert.at
   License: GPL2
   */
   

/*
// create custom plugin settings menu
add_action('admin_menu', 'baw_create_menu');

function baw_create_menu() {



// Add to admin_menu function
$page = add_submenu_page( 'tools.php', __('Cookies Popup Options'), __('Cookies Popup Options'), 'edit_pages', 'cookies_notice_options', bw_cookies_options);
 
function bw_cookies_options() {
?>
<div class="wrap">
<h2>Cookies Popup Options</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'bw_settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Text</th>
        <td><textarea name="bw_cookies_note_text" rows="4" cols="50"> <?php echo esc_attr( get_option('bw_cookies_note_text'));?></textarea></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Linktext</th>
        <td><input type="textarea" name="bw_cookies_note_linktext" value="<?php echo get_option('bw_cookies_note_linktext'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Cookies Link</th>
        <td><input type="text" name="bw_cookies_note_linkurl" value="<?php get_option('bw_cookies_note_linkurl'); ?>" /></td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } 


}
*/




    
    
       

    
function bw_get_cookies_css() {
?>   
<style>
    .cookies_note {
    	background-color: #7d7c77;
    	color: rgba(255, 255, 255, 0.8);
    	font: 300 12px/19px sans-serif;
    	text-align: center;
    	position: fixed;
    	z-index:999;
    	bottom:0;
    	left:0;
    	right:0;
    }
    .cookies_note a {
    	color: rgba(255, 255, 255, 0.5);
    	text-decoration: underline;
    	padding-right: 1em;
    	 white-space: nowrap;
    	
    }
    .cookies_note .close {
		cursor: pointer;
		display: inline-block;
		padding: .3em .6em;
		background-color: rgba(255, 255, 255, 0.25);
		font-weight: 400;
		font-size: 16px;
		font-style: normal;
		text-decoration: none;
		color: #fff;
    } 
    .page-footer .table-cell {
        padding-bottom: 40px;
    }
</style>
<?php
}    
    
    
function bw_get_cookies_notice($link, $loadjquery=false) {    
    
    
    $info_text  = 'Diese Seite verwendet Cookies. Durch die Nutzung unserer Webseite erkl&auml;ren Sie sich mit dem Einsatz von Cookies einverstanden.';
    $link_url   = get_bloginfo( 'url' ).'/datenschutz/';
    $link_name  = 'Mehr erfahren >>';
 

    
  if ( !isset($_COOKIE["disclaimer"]) ) { ?>
		<div class="cookies_note">
    		<?php echo $info_text; ?>
    		<a href="<?php echo $link_url; ?>"><?php echo $link_name; ?></a>
    		<div class="close">OK</a>
		</div>
    </div>
    <?php
  //       if ($loadjqueryy) echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>'; 
  // end cookies_note
    }
    
}



function bw_get_cookies_js() {
?>
    <script>  
	//    $(document).ready(function(){
        jQuery(document).ready(function($) {
        
        
        if (document.cookie.indexOf('disclaimer') >= 0) {
            $('.cookies_note').hide();
        }
        
                $('.cookies_note .close').click(function(){
                    $('.cookies_note').slideUp();
                    var nDays = 999;
                    var cookieName = "disclaimer";
                    var cookieValue = "true";
                    var today = new Date();
                    var expire = new Date();
                    expire.setTime(today.getTime() + 3600000*24*nDays);
                    document.cookie = cookieName+"="+escape(cookieValue)+";expires="+expire.toGMTString()+";path=/";
                 });
        
        });
    </script>
<?php
    
    
}



add_action('wp_footer', 'bw_get_cookies_css',0);
add_action('wp_footer', 'bw_get_cookies_notice',0);
add_action('wp_footer', 'bw_get_cookies_js',99);
