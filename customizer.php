<?php

function honeysbee_customize_register( $wp_customize ) {


//Add smartbar 
$wp_customize->add_section('newtheme_smartbar', array(
        'title' => __('Smartbar', 'newtheme'), 
        'priority' => 0,
    ));

//Add smartbar text
$wp_customize->add_setting('newtheme_smartbar_text', array(
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control('newtheme_smartbar_text', array(
        'label' => __('Smart bar text', 'newtheme'),
        'section' => 'newtheme_smartbar',
        'settings' => 'newtheme_smartbar_text',
         'type'=>'text',
        'priority' => 1,
    ));
     
     
//Add placeholder text     
$wp_customize->add_setting('newtheme_smartbar_placeholder', array(
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control('newtheme_smartbar_placeholder', array(
        'label' => __('Smart bar placeholder', 'newtheme'),
        'section' => 'newtheme_smartbar',
        'settings' => 'newtheme_smartbar_placeholder',
         'type'=>'text',
        'priority' => 2,
    ));
     
     
//Add button text    
$wp_customize->add_setting('newtheme_smartbar_button_text', array(
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control('newtheme_smartbar_button_text', array(
        'label' => __('Smart bar button', 'newtheme'),
        'section' => 'newtheme_smartbar',
        'settings' => 'newtheme_smartbar_button_text',
         'type'=>'text',
        'priority' => 3,
    ));
     $wp_customize->add_setting('newtheme_smartbar_button_color', array(
        'transport' => 'postMessage',
    ));
     
     $wp_customize->add_control( 
	new WP_Customize_Color_Control( 
	$wp_customize, 
	'link_color', 
	array(
		'label'      => __( 'Header Color', 'mytheme' ),
		'section'    => 'your_section_id',
		'settings'   => 'your_setting_id',
	) ) 
);
     
}
add_action( 'customize_register', 'honeysbee_customize_register' );