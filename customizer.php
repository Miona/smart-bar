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
$wp_customize->add_section('sb_smartbar', array(
        'title' => __('Smartbar', 'sb'), 
        'priority' => 0,
    ));

//Add smartbar text
  $wp_customize->add_setting('sb_smartbar_text',array(
        'default'=>'',
         'sanitize_callback'=>'sanitize_text_field',
         'transport'=>'postmessage',
     ));
     $wp_customize->add_control(new sb_customize_textarea_control($wp_customize,'sb_customize_textarea_controls',array(
         'label'=>__('Smartbar text','sb'),
         'section'=>'sb_smartbar',
         'settings'=>'sb_smartbar_text',
         'priority'=>'1',
     )));
     
     
     $wp_customize->add_setting('sb_smartbar_desc_text_color', array(
         'sanitize_callback' => 'sb_sanitize_hex_color',
         'sanitize_js_callback' => 'sb_sanitize_escaping',
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control( 
	new WP_Customize_Color_Control( 
	$wp_customize, 
	'sb_smartbar_desc_text_color', 
	array(
		'label'      => __( 'Smartbar text color', 'sb' ),
		'section'    => 'sb_smartbar',
		'settings'   => 'sb_smartbar_desc_text_color',
	) ) 
);

     $wp_customize->add_setting('sb_smartbar_desc',array(
        'default'=>'',
         'sanitize_callback'=>'sanitize_text_field',
         'transport'=>'postmessage',
     ));
     $wp_customize->add_control(new sb_customize_textarea_control($wp_customize,'sb_customize_textarea_control',array(
         'label'=>__('Code Area','sb'),
         'section'=>'sb_smartbar',
         'settings'=>'sb_smartbar_desc',
         'priority'=>'3',
     )));
     
//Add placeholder text     
/*$wp_customize->add_setting('sb_smartbar_placeholder', array(
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control('sb_smartbar_placeholder', array(
        'label' => __('Smart bar Placeholder', 'sb'),
        'section' => 'sb_smartbar',
        'settings' => 'sb_smartbar_placeholder',
         'type'=>'text',
        'priority' => 2,
    ));*/
     
     
//Add button text    
$wp_customize->add_setting('sb_smartbar_button_text', array(
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control('sb_smartbar_button_text', array(
        'label' => __('Smartbar button', 'sb'),
        'section' => 'sb_smartbar',
        'settings' => 'sb_smartbar_button_text',
         'type'=>'text',
        'priority' => 3,
    ));
     $wp_customize->add_setting('sb_smartbar_background_color', array(
         
         'sanitize_callback' => 'sb_sanitize_hex_color',
         'sanitize_js_callback' => 'sb_sanitize_escaping',
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control( 
	new WP_Customize_Color_Control( 
	$wp_customize, 
	'sb_smartbar_background_color', 
	array(
		'label'      => __( 'Button Color', 'sb' ),
		'section'    => 'sb_smartbar',
		'settings'   => 'sb_smartbar_background_color',
	) ) 
);
     
     $wp_customize->add_setting('sb_smartbar_text_color', array(
         'sanitize_callback' => 'sb_sanitize_hex_color',
         'sanitize_js_callback' => 'sb_sanitize_escaping',
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control( 
	new WP_Customize_Color_Control( 
	$wp_customize, 
	'sb_smartbar_text_color', 
	array(
		'label'      => __( 'Text color', 'sb' ),
		'section'    => 'sb_smartbar',
		'settings'   => 'sb_smartbar_text_color',
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
$button_background= get_theme_mod('sb_smartbar_background_color');
$button_text= get_theme_mod('sb_smartbar_text_color');
$desc_text= get_theme_mod('sb_smartbar_desc_text_color');
?>
<style rel="text/css" id="background-css">
    <?php if (get_theme_mod('sb_smartbar_background_color')) { ?>
    .smartbar-submit{
        background: <?php echo $button_background; ?>
    } 
    <?php } ?>
    
    <?php if (get_theme_mod('sb_smartbar_text_color')) { ?>
    .smartbar-submit{
        color: <?php echo $button_text; ?>
    } 
    <?php } ?>
    
    <?php if (get_theme_mod('sb_smartbar_desc_text_color')) { ?>
    .smartbar-text{
        color: <?php echo $desc_text; ?>
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
