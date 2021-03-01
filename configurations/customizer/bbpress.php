<?php
/**
 * Adds extra panels for bbPress customizer settings
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$bbpress = [
    'description'   => __('Adjust bbPress related lay-out settings here.', 'waterfall'),
    'id'            => 'bbpress',
    'title'         => __('bbPress', 'waterfall'),
    'panel'         => true,
    'sections'      => []
];

foreach( wf_get_bbpress_types() as $type => $label ) {
    $bbpress['sections'][$type] = [
        'id'        => 'bbpress_' .  $type,
        'title'     => $label,
        'fields'    => [ 
            [
                'default'       => '',
                'id'            => $type . '_title_header',
                'title'         => __('Title Section', 'waterfall'),
                'type'          => 'heading',
                'choices'       => [
                    $type . '_header',
                    $type . '_header_breadcrumbs',
                    $type . '_header_width',
                    $type . '_header_height',
                    $type . '_header_align',
                    $type . '_header_title',
                    $type . '_header_description',
                    $type . '_header_search'
                ]                    
            ],                  
            [
                'default'       => '',
                'id'            => $type . '_header',
                'title'         => __('Display Title Section', 'waterfall'),
                'type'          => 'checkbox'
            ],
            [
                'default'       => '',
                'id'            => $type . '_header_breadcrumbs',
                'title'         => __('Display Breadcrumbs in title section', 'waterfall'),
                'type'          => 'checkbox'
            ],              
            [
                'default'       => 'default',
                'description'   => __('Width of title section.', 'waterfall'),
                'id'            => $type . '_header_width',
                'choices'       => wf_get_container_options(),
                'title'         => __('Header Width', 'waterfall'),
                'type'          => 'select'
            ],
            [
                'default'       => 'default',
                'description'   => __('Height of title section.', 'waterfall'),
                'id'            => $type . '_header_height',
                'choices'       => wf_get_height_options(),
                'title'         => __('Header Height', 'waterfall'),
                'type'          => 'select'
            ],    
            [
                'default'       => 'left',
                'id'            => $type . '_header_align',
                'title'         => __('Title Section Text Align', 'waterfall'),
                'description'   => __('How should text be aligned within the title section?', 'waterfall'),
                'type'          => 'select',
                'choices'       => wf_get_align_options()
            ],
            [
                'default'       => '',
                'id'            => $type . '_header_title',
                'title'         => __('Custom Title ', 'waterfall'),
                'description'   => __('Add a custom title, overwrites the default title.', 'waterfall'),
                'type'          => 'input'
            ],   
            [
                'default'       => '',
                'id'            => $type . '_header_description',
                'title'         => __('Title Description', 'waterfall'),
                'description'   => __('Add a custom title description.', 'waterfall'),
                'type'          => 'textarea'
            ],
            [
                'default'       => '',
                'id'            => $type . '_header_search',
                'title'         => __('Display Searchform in Header', 'waterfall'),
                'type'          => 'checkbox'
            ],
            [
                'default'       => '',
                'id'            => $type . '_title_content',
                'title'         => __('Content Section', 'waterfall'),
                'type'          => 'heading',
                'choices'       => [
                    $type . '_content_width',
                    $type . '_content_sidebar_width',
                    $type . '_sidebar_position',
                    $type . '_sidebar_width'
                ]                    
            ],               
            [
                'default'       => 'default',
                'description'   => __('Width of the container of the content section.', 'waterfall'),
                'id'            => $type . '_content_width',
                'choices'       => wf_get_container_options(),
                'title'         => __('Container Width', 'waterfall'),
                'type'          => 'select'
            ],
            [
                'selector'      => [
                    'min-width' => '768px',
                    'property'  => 'width',
                    'selector'  => $type == 'forum_archive' ? '.post-type-archive-forum .content' : '.single-' . $type . ' .content'
                ],
                'default'       => '',
                'id'            => $type . '_content_sidebar_width',
                'title'         => __('Content Custom Width', 'waterfall'),
                'description'   => __('Sets the width of the actual content.', 'waterfall'),
                'type'          => 'dimension'  
            ],                     
            [
                'default'       => 'full',
                'description'   => __('Choose the sidebar lay-out.', 'waterfall'),
                'id'            => $type . '_sidebar_position',
                'choices'       => wf_get_sidebar_options(),
                'title'         => __('Sidebar Lay-Out', 'waterfall'),
                'type'          => 'select'
            ],
            [
                'selector'      => [
                    'min-width' => '768px',
                    'property'  => 'width',
                    'selector'  => $type == 'forum_archive' ? '.post-type-archive-forum .main-sidebar' : '.single-' . $type . ' .main-sidebar'
                ],
                'default'       => '',
                'id'            => $type . '_sidebar_width',
                'title'         => __('Sidebar Custom Width ', 'waterfall'),
                'description'   => __('Sets the width of the sidebar.', 'waterfall'),
                'type'          => 'dimension'  
            ],
            [
                'default'       => '',
                'id'            => $type . '_private',
                'title'         => __('Hide for users that are not logged-in', 'waterfall'),
                'type'          => 'checkbox'
            ]                     
        ] 
    ];
}

// Additional settings for the profile page
$bbpress['sections']['profile'] = [
    'id'        => 'bbpress_profile',
    'title'     => __('Profile', 'waterfall'),
    'fields'    => [ 
        [
            'default'       => '',
            'id'            => 'user_header_breadcrumbs',
            'title'         => __('Display Breadcrumbs in User Profile', 'waterfall'),
            'type'          => 'checkbox'
        ], 
        [
            'default'       => '',
            'id'            => 'user_header_title',
            'title'         => __('Display User Name as Title', 'waterfall'),
            'type'          => 'checkbox'
        ],
        [
            'default'       => '',
            'id'            => 'user_private',
            'title'         => __('Hide profiles for users that are not logged-in', 'waterfall'),
            'type'          => 'checkbox'
        ]          
    ]
];