<?php
   /*
   Plugin Name: Smart Bar
   Plugin URI: http://www.ideaboxthemes.com
   Description: A plugin to display smart bar for subscribers on top.
   Version: 1.0
   Author: Saumya Sharma,Shruti Taldar,Purva Jain, Nidarshana Sharma, Nikita Pariyani
   Author URI: http://ideaboxthemes.com
   License: GPL2 or later
   License URI: http://www.gnu.org/licenses/gpl-2.0.html
   */
?>
<?php
add_action (
    'wp_head', 'sb_display');

add_action( 'wp_enqueue_scripts', 'prefix_add_my_stylesheet' );



function prefix_add_my_stylesheet() {
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'prefix-style', plugins_url('style1.css', __FILE__) );
    wp_enqueue_style( 'prefix-style',plugins_url('style1.css', __FILE__) );
    wp_enqueue_script( 'prefix-style',plugins_url('close.js', __FILE__) );
    wp_enqueue_style( 'fa-style',plugins_url('font-awesome-4.2.0/css/font-awesome.min.css', __FILE__) );
    
}


function sb_display() {?>

  
  

    <div class="sb_content clearfix">
        <div class="sb_close"> 
            <a class="sb_close_icon"><i class="fa fa-close"></i></a>
        <div class="sb_wrapper clearfix">  
            
            
                <div class="sb-text sb_wrapper_left">
                    
                    <?php   if ( get_theme_mod('sb_text') ) { ?>
                        <p><?php echo esc_html_e(get_theme_mod('sb_text')); ?></p>
                    <?php } else { ?>
                        <p><?php echo esc_html_e('Join our newsletter today for free','sb'); ?></p>
                    <?php } ?>
                </div>
            
                
                <div class="input sb_wrapper_right">  
                    <?php if (get_theme_mod('form_input'));{ ?>
                    <?php echo (get_theme_mod('form_input')); } ?>
                </div> 
            
        </div>
            
       </div>      
    </div>
  

<?php } ?>
     
<?php include 'customizer.php'; ?>
