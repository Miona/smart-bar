<?php
/**
 * Smartbar Plugin Customizer
 *
 * @package Smartbar
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sb_customize_register( $wp_customize ) {
        
        /** ===============
     * Extends CONTROLS class to add textarea
     */
        class sb_customize_textarea_control extends WP_Customize_Control {

            public $type = 'textarea';

            public function render_content() {
                ?>

                <label>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                    <textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
                </label>

                <?php
            }

        }
        
//Add smartbar 
$wp_customize->add_section('smartbar', array(
        'title' => __('Smartbar', 'sb'), 
        'priority' => 0,
    ));

//Add smartbar text
  $wp_customize->add_setting('sb_text',array(
        'default'=>'',
         'sanitize_callback'=>'sanitize_text_field',
         'transport'=>'postmessage',
     ));
     $wp_customize->add_control(new sb_customize_textarea_control($wp_customize,'sb_customize_textarea_controls',array(
         'label'=>__('Smartbar text','sb'),
         'section'=>'smartbar',
         'settings'=>'sb_text',
         'priority'=>'1',
     )));
     
      $wp_customize->add_setting('form_input', array('default' => '',
        'sanitize_js_callback' => 'sb_sanitize_escaping',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new sb_customize_textarea_control($wp_customize, 'home_featured_right', array(
        'label' => __('Form Input Area', 'sb'),
        'section' => 'smartbar',
        'settings' => 'form_input',
        'priority' => 6,
    )));
     
    

     
//Add button text    
$wp_customize->add_setting('sb_button_text', array(
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control('sb_button_text', array(
        'label' => __('Smartbar button', 'sb'),
        'section' => 'smartbar',
        'settings' => 'sb_button_text',
         'type'=>'text',
        'priority' => '4',
    ));
    
     //Display options section
$wp_customize->add_section('display', array(
        'title' => __('Sb Display Options', 'sb'), 
       
    ));

 $wp_customize->add_setting('sb_background_color', array(
         
         'sanitize_callback' => 'sb_sanitize_hex_color',
         'sanitize_js_callback' => 'sb_sanitize_escaping',
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control( 
	new WP_Customize_Color_Control( 
	$wp_customize, 
	'sb_background_color', 
	array(
		'label'      => __( 'Button Color', 'sb' ),
		'section'    => 'display',
		'settings'   => 'sb_background_color',
	) ) 
);
     
     $wp_customize->add_setting('sb_button_text_color', array(
         'sanitize_callback' => 'sb_sanitize_hex_color',
         'sanitize_js_callback' => 'sb_sanitize_escaping',
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control( 
	new WP_Customize_Color_Control( 
	$wp_customize, 
	'sb_button_text_color', 
	array(
		'label'      => __( 'Button text color', 'sb' ),
		'section'    => 'display',
		'settings'   => 'sb_button_text_color',
	) ) 
);
     
     $wp_customize->add_setting('sb_color', array(
         
         'sanitize_callback' => 'sb_sanitize_hex_color',
         'sanitize_js_callback' => 'sb_sanitize_escaping',
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control( 
	new WP_Customize_Color_Control( 
	$wp_customize, 
	'sb_color', 
	array(
		'label'      => __( 'Section Color', 'sb' ),
		'section'    => 'display',
		'settings'   => 'sb_color',
	) ) 
);

     $wp_customize->add_setting('sb_desc_text_color', array(
         'sanitize_callback' => 'sb_sanitize_hex_color',
         'sanitize_js_callback' => 'sb_sanitize_escaping',
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control( 
	new WP_Customize_Color_Control( 
	$wp_customize, 
	'sb_desc_text_color', 
	array(
		'label'      => __( 'Smartbar text color', 'sb' ),
		'section'    => 'display',
		'settings'   => 'sb_desc_text_color',
                'priority'   => '2',
	) ) 
); 
}
add_action( 'customize_register', 'sb_customize_register' );

function sb_sanitize_hex_color($color){
    if($unhashed = sanitize_hex_color_no_hash($color)) {
        return '#' .$unhashed;
    }
    return $color;
}

function sb_background_color(){
$button_background= get_theme_mod('sb_background_color');
$button_text_color= get_theme_mod('sb_button_text_color');
$desc_text= get_theme_mod('sb_desc_text_color');
$sb_position= get_theme_mod('sb_desc_text_color');
$sb_section_color= get_theme_mod('sb_color');

?>
<style rel="text/css" id="background-css">
    <?php if (get_theme_mod('sb_color')) { ?>
    .sb_content{
        background-color:<?php echo $sb_section_color; ?>
    } 
    <?php } ?>
    <?php if (get_theme_mod('sb_background_color')) { ?>
    .sb_wrapper_right input[type="submit"]{
        background:<?php echo $button_background; ?>
    } 
    <?php } ?>
    
    <?php if (get_theme_mod('sb_button_text_color')) { ?>
    .sb_wrapper_right input[type="submit"]
{        color:<?php echo $button_text_color; ?>
    } 
    <?php } ?>
    
    <?php if (get_theme_mod('sb_desc_text_color')) { ?>
    .sb-text{
        color:<?php echo $desc_text; ?>
    } 
    <?php } ?>

    
</style>
<?php
}
add_action('wp_head','sb_background_color');

function sb_sanitize_escaping($input){
    $input= esc_attr($input);
    return $input;
}




/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sb_customize_preview_js() {
	wp_enqueue_script( 'sb_customizer', get_template_directory_uri() . '/includes/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'sb_customize_preview_js' );
