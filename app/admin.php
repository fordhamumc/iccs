<?php

namespace App;

use DateTime;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand, .hero__title',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogdescription', [
        'selector' => '.hero__tagline',
        'render_callback' => function () {
            bloginfo('description');
        }
    ]);

    // Add short title
    $wp_customize->add_setting( 'short_title', array(
	    'capability'            => 'edit_theme_options',
	    'sanitize_callback'     => 'sanitize_text_field',
	    'transport'             => 'postMessage'
    ));
    $wp_customize->add_control( 'short_title', array(
	    'type'          => 'text',
	    'section'       => 'title_tagline',
	    'label'         => __( 'Short Title', 'fu-iccs' )
    ));
    $wp_customize->selective_refresh->add_partial('short_title', [
	    'selector' => '.banner__brand',
	    'render_callback' => function () {
		    return get_theme_mod('short_title');
	    }
    ]);

    // Add conference info section
    $wp_customize->add_section('iccs_info', array(
        'title'         => __('Conference Information', 'fu-iccs'),
        'capability'    => 'edit_theme_options',
        'priority'      => 120
    ));

    // Add dates
    $date_settings = array(
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'App\iccs_sanitize_date',
        'transport'             => 'postMessage'
    );
    $date_control = array(
        'type'          => 'date',
        'section'       => 'iccs_info',
        'input_attrs'   => array(
            'placeholder'   => __( 'mm/dd/yyyy', 'fu-iccs' )
        )
    );
    $wp_customize->add_setting('info[start_date]', $date_settings);
    $wp_customize->add_control('info_start_date', array_merge($date_control, array(
        'settings'      => 'info[start_date]',
        'label'         => __( 'Start Date', 'fu-iccs' )
    )));
    $wp_customize->add_setting('info[end_date]', $date_settings);
    $wp_customize->add_control('info_end_date', array_merge($date_control, array(
        'settings'      => 'info[end_date]',
        'label'         => __( 'End Date', 'fu-iccs' )
    )));
    $wp_customize->selective_refresh->add_partial('info_date', [
        'selector'          => '.hero__date',
        'settings'          => array('info[start_date]', 'info[end_date]'),
        'render_callback'   => function () {
            $info = get_theme_mod('info');
            return fu_date_format($info['start_date'], $info['end_date']);
        }
    ]);

    // Add Location
    $wp_customize->add_setting( 'info[location]', array(
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'sanitize_textarea_field',
        'transport'             => 'postMessage'
    ));
    $wp_customize->add_control( 'info_location', array(
        'type'          => 'textarea',
        'section'       => 'iccs_info',
        'settings'      => 'info[location]',
        'label'         => __( 'Location', 'fu-iccs' )
    ));
    $wp_customize->add_setting( 'info[location-short]', array(
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'sanitize_text_field',
        'transport'             => 'postMessage'
    ));
    $wp_customize->add_control( 'info_location_short', array(
        'type'          => 'text',
        'section'       => 'iccs_info',
        'settings'      => 'info[location-short]',
        'label'         => __( 'Location (Short)', 'fu-iccs' )
    ));
    $wp_customize->selective_refresh->add_partial('info_location', [
        'selector'          => '.hero__location',
        'settings'          => array('info[location]', 'info[location-short]'),
        'render_callback'   => function () {
            $info = get_theme_mod('info');
            return $info['location-short'] ?: nl2br($info['location']);
        }
    ]);

    // Add Registration
    $wp_customize->add_setting( 'info[registration-url]', array(
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'esc_url_raw',
        'transport'             => 'postMessage'
    ));
    $wp_customize->add_control( 'info_registration_url', array(
        'type'          => 'text',
        'section'       => 'iccs_info',
        'settings'      => 'info[registration-url]',
        'label'         => __( 'Registration URL', 'fu-iccs' )
    ));
    $wp_customize->add_setting( 'info[registration-text]', array(
        'capability'            => 'edit_theme_options',
        'default'               => __('Register', 'fu-iccs'),
        'sanitize_callback'     => 'sanitize_text_field',
        'transport'             => 'postMessage'
    ));
    $wp_customize->add_control( 'info_registration_text', array(
        'type'          => 'text',
        'section'       => 'iccs_info',
        'settings'      => 'info[registration-text]',
        'label'         => __( 'Registration Text', 'fu-iccs' )
    ));

    // Add Hashtag
    $wp_customize->add_setting( 'info[hashtag]', array(
        'capability'            => 'edit_theme_options',
        'default'               => '#',
        'sanitize_callback'     => 'sanitize_text_field',
        'transport'             => 'postMessage'
    ));
    $wp_customize->add_control( 'info_hashtag', array(
        'type'          => 'text',
        'section'       => 'iccs_info',
        'settings'      => 'info[hashtag]',
        'label'         => __( 'Hashtag', 'fu-iccs' ),
        'input_attrs'   => array(
            'placeholder'   => __( '#', 'fu-iccs' )
        )
    ));
    $wp_customize->selective_refresh->add_partial('info[hashtag]', [
        'selector' => '.hero__hashtag',
        'render_callback' => function () {
            return get_theme_mod('info')['hashtag'];
        }
    ]);
});

function iccs_sanitize_date( $input ) {
    $date = new DateTime( $input );
    return $date->format('Y-m-d');
}

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});
