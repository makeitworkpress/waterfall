<?php
/**
 * Loads our option configurations
 */  
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$options = [
    'capability'    => 'manage_options',
    'class'         => 'tabs-left',
    'id'            => 'waterfall_options',
    'location'      => 'menu', 
    'menu_icon'     => 'dashicons-admin-generic',
    'menu_title'    => __('Waterfall', 'waterfall'),
    'menu_position' => 99,
    'title'         => __('Waterfall Settings', 'waterfall'),
    'sections'      => [
        'general'   => [
            'icon'      => 'settings',
            'id'        => 'general',
            'title'     => __('General Settings', 'waterfall'),
            'fields'    => [ 
                [
                    'default'       => '',
                    'description'   => __('This determines what microdata is used, so that Google knows your website is resembling a person or organization.', 'waterfall'),
                    'id'            => 'represent_scheme',
                    'options'       => [
                        'organization' => __('Organization', 'waterfall'),
                        'person'       => __('Person', 'waterfall')
                    ],
                    'subtype'       => 'password',
                    'title'         => __('Microscheme for Website Representation', 'waterfall'),
                    'type'          => 'select'
                ],                                                            
                [
                    'default'       => '',
                    'description'   => __('A license code allows you to receive updates and support for the Waterfall Reviews Plugin.', 'waterfall'),
                    'id'            => 'reviews_license',
                    'subtype'       => 'password',
                    'title'         => __('License code for Waterfall Reviews Plugin', 'waterfall'),
                    'type'          => 'input'
                ],                 
            ]      
        ]
    ] 
];