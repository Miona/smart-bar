<?php
   /*
   Plugin Name: Smart Bar
   Plugin URI: http://www.ideaboxthemes.com
   Description: A plugin to display smart bar for subscribers on top.
   Version: 1.0
   Author: Saumya Sharma,Purva Jain, Nidarshana Sharma, Nikita Pariyani, Shruti Taldar
   Author URI: http://ideaboxthemes.com
   License: GPL2 or later
   License URI: http://www.gnu.org/licenses/gpl-2.0.html
   */
?>
<?php
add_action (
    'wp_head', 'smartbar_display');

add_action( 'wp_enqueue_scripts', 'prefix_add_my_stylesheet' );



function prefix_add_my_stylesheet() {
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'prefix-style', plugins_url('style1.css', __FILE__) );
    wp_enqueue_style( 'prefix-style',plugins_url('style1.css', __FILE__) );
    wp_enqueue_script( 'prefix-style',plugins_url('close.js', __FILE__) );
}



function smartbar_display() {?>
 <div id="smartbar-popup" class="smartbar-popup">
    <a class="smartbar-link" target="_blank" href="http://sumome.com/?src=sm-ba-5a316e8bd2f8962ed11db73981cf8b18d2bdf43368ce276112d0408aee092ed1">
        
    </a>
  

    <div class="sb_content">
        <div class="sb_wrapper">
        <div class="smartbar-form">
                
                
                <div class="smartbar-input">
                   
                        <div class="smartbar-text">
                    <?php   if ( get_theme_mod('sb_smartbar_text') ) { ?>
                        <p><?php echo esc_html_e(get_theme_mod('sb_smartbar_text')); ?></p>
                    <?php } else { ?>
                        <p><?php echo esc_html_e('Join our newsletter today for free','sb'); ?></p>
                    <?php } ?>
                </div>
                  <div class="input">     
                   <input id="smartbar_email_address" 
                           type="text"
                           placeholder="<?php if ( get_theme_mod('sb_smartbar_desc') !='' ) {  ?>
                  <?php echo esc_html(get_theme_mod('sb_smartbar_desc')); ?>
                           <?php } else { ?> <?php esc_html_e('Enter your e-mail', 'sb') ?> 
                                           <?php } ?>"
                         
                           name="smartbar_email_address" value="">
                    </input>
                         
                                        
                                        
                                        
                                        
                     <button class="smartbar-submit" type="submit" >
                        <?php   if ( get_theme_mod('sb_smartbar_button_text') ) { ?>
                                        <?php echo esc_html_e(get_theme_mod('sb_smartbar_button_text')); ?>
                                        <?php } else { ?>
                                        <?php echo esc_html_e('Subscribe','sb'); ?>
                                        <?php } ?>
                    </button>
                   </div>
                   
                    <div class="color">
                         <?php  get_theme_mod('sb_smartbar_button_color') ?>
                        
                    </div>
                </div>
            <div class="close">
                close
            </div>
        </div>
    </div>
    </div>      
</div>
<?php
}
?>
<?php include 'customizer.php'; ?>
