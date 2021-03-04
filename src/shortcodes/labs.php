<?php

/**
 * Create the class and return results.
 */
function andyp_labs_stack_callback($atts){
    
    wp_register_style( 'andyp_labs_css', ANDYP_LABS_STACK_PATH.'src/sass/style.css' );
    wp_enqueue_style( 'andyp_labs_css' );

    $stack = new \andyp\labsstack\REST\labs();

    return $stack->out();
}

add_shortcode( 'andyp_labs_stack', 'andyp_labs_stack_callback' );