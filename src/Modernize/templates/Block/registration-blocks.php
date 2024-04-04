<?php

function vendor_plugin_register_blocks() {
    // sample block 1
    wp_register_script(
        'sample-block-1',
        plugins_url( '/build/sample-block-1/index.js', dirname(__FILE__) ),
        array( 'wp-blocks', 'wp-element', 'wp-editor' )
    );

    wp_register_style(
        'sample-block-1-editor',
        plugins_url( '/build/sample-block-1/editor.css', dirname(__FILE__) ),
        array( 'wp-edit-blocks' )
    );

    wp_register_style(
        'sample-block-1',
        plugins_url( '/build/sample-block-1/style.css', dirname(__FILE__) ),
        array()
    );

    register_block_type( 'vendor-plugin/sample-block-1', array(
        'editor_script' => 'sample-block-1',
        'editor_style'  => 'sample-block-1-editor',
        'style'         => 'sample-block-1',
    ) );

    // sample block 2
    wp_register_script(
        'sample-block-2',
        plugins_url( '/build/sample-block-2/index.js', dirname(__FILE__) ),
        array( 'wp-blocks', 'wp-element', 'wp-editor' )
    );

    wp_register_style(
        'sample-block-2-editor',
        plugins_url( '/build/sample-block-2/editor.css', dirname(__FILE__) ),
        array( 'wp-edit-blocks' )
    );

    wp_register_style(
        'sample-block-2',
        plugins_url( '/build/sample-block-2/style.css', dirname(__FILE__) ),
        array()
    );

    register_block_type( 'vendor-plugin/sample-block-2', array(
        'editor_script' => 'sample-block-2',
        'editor_style'  => 'sample-block-2-editor',
        'style'         => 'sample-block-2',
    ) );
}

add_action( 'init', 'vendor_plugin_register_blocks' );

