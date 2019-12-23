<?php
/**
 * Adds extensive settings for the layout
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

// Receive our public post types
$types  = wf_get_post_types( true, true );

// Set-up the settings array
$layout = [
    'description'   => __('Adjust extensive settings and elements for various parts of the website here.', 'waterfall'),
    'id'            => 'waterfall_layout',
    'title'         => __('Layout', 'waterfall'),
    'panel'         => true,
    'sections'      => [
        'header' => [
            'id'            => 'style_header',
            'title'         => __('Header', 'waterfall'),
            'fields'    => [ 
                [
                    'default'       => '',
                    'id'            => 'header_disable',
                    'title'         => __('Disable Header', 'waterfall'),
                    'type'          => 'checkbox'
                ],    
                [
                    'default'       => 'full',
                    'id'            => 'header_width',
                    'title'         => __('Header Width', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => wf_get_container_options()
                ],
                [
                    'selector'      => ['selector' => '.molecule-header-atoms', 'property' => ['min-height', 'line-height']],
                    'default'       => '',
                    'id'            => 'header_height',
                    'title'         => __('Header Minimum Height', 'waterfall'),
                    'type'          => 'dimension'
                    ],                
                [
                    'default'       => '',
                    'id'            => 'header_fixed',
                    'title'         => __('Fixed Header', 'waterfall'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => 'header_border',
                    'title'         => __('Disable Header Bottom Border', 'waterfall'),
                    'type'          => 'checkbox'
                ],                 
                [
                    'default'       => '',
                    'id'            => 'header_headroom',
                    'title'         => __('Collapse Header when Scrolling', 'waterfall'),
                    'type'          => 'checkbox'
                ], 
                [
                    'default'       => '',
                    'id'            => 'header_transparent',
                    'title'         => __('Transparent Header', 'waterfall'),
                    'type'          => 'checkbox'
                ], 
                [
                    'default'       => 'left',
                    'id'            => 'header_logo_float',
                    'title'         => __('Logo Position', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => [
                        'center'    => __('Center', 'waterfall'),
                        'left'      => __('Left', 'waterfall'),
                        'right'     => __('Right', 'waterfall'),
                    ]
                ],
                [
                    'default'       => '',
                    'id'            => 'header_disable_logo',
                    'title'         => __('Disable Header Logo', 'waterfall'),
                    'type'          => 'checkbox'
                ],        
                [
                    'default'       => 'right',
                    'id'            => 'header_menu_float',
                    'title'         => __('Menu Position', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => [
                        'center'    => __('Center', 'waterfall'),
                        'left'      => __('Left', 'waterfall'),
                        'right'     => __('Right', 'waterfall'),
                    ]
                ],
                [
                    'default'       => '',
                    'id'            => 'header_search',
                    'title'         => __('Add a Search Icon to the Header', 'waterfall'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => __('Nothing found!', 'waterfall'),
                    'id'            => 'header_search_none',
                    'title'         => __('Nothing Found Search Text', 'waterfall'),
                    'description'   => __('Text when nothing is found in search', 'waterfall'),
                    'selector'      => ['selector' => '.atom-search-results .atom-posts-none', 'html' => true],
                    'transport'     => 'postMessage',                    
                    'type'          => 'input'
                ],
                [
                    'default'       => __('View All Results', 'waterfall'),
                    'id'            => 'header_search_all',
                    'title'         => __('All Results Search Text', 'waterfall'),
                    'description'   => __('Text for link to all the results', 'waterfall'),
                    'selector'      => ['selector' => '.atom-search-results .atom-search-all', 'html' => true],
                    'transport'     => 'postMessage',                      
                    'type'          => 'input'
                ],                
                [
                    'default'       => '',
                    'id'            => 'header_social',
                    'title'         => __('Add Social Icons to the Header', 'waterfall'),
                    'type'          => 'checkbox'
                ],     
                [
                    'default'       => '',
                    'id'            => 'header_disable_menu',
                    'title'         => __('Disable Header Menu', 'waterfall'),
                    'type'          => 'checkbox'
                ],               
                [
                    'default'       => 'mobile',
                    'id'            => 'header_menu_hamburger',
                    'title'         => __('Display of Mobile Menu', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => [
                        'always'    => __('Always Display', 'waterfall'),
                        'tablet'    => __('Display on Tablets', 'waterfall'),
                        'mobile'    => __('Display on Mobile', 'waterfall'),
                    ]
                ],
                [
                    'default'       => 'default',
                    'id'            => 'header_menu_style',
                    'title'         => __('Header Menu Style', 'waterfall'),
                    'description'   => __('Some styles always show a hamburger menu, while others are only visible in the mobile menu.', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => [
                        'default'   => __('Default', 'waterfall'),
                        'dark'      => __('Dark (Only Mobile)', 'waterfall'),
                        'fixed'     => __('Fixed (Always Hamburger)', 'waterfall'),
                        'left'      => __('Left (Always Hamburger)', 'waterfall'),
                        'right'     => __('Right (Always Hamburger)', 'waterfall'),
                    ]
                ]  
            ]              
        ]
    ]
]; 

// Based on our post types, we add variable settings if supported
if( $types ) {

    foreach( $types as $type => $name ) {

        $layout['sections'][$type . '_content'] = [
            'id'        => $type . '_content',
            'title'     => $name,
            'fields'    => [
                [
                    'default'       => '',
                    'id'            => $type . '_main_content_title_header',
                    'title'         => __('Title Section', 'waterfall'),
                    'type'          => 'heading'
                ],             
                [
                    'default'       => '',
                    'id'            => $type . '_header_disable',
                    'title'         => __('Disable Title Section', 'waterfall'),
                    'type'          => 'checkbox'
                ], 
                [
                    'default'       => false,
                    'id'            => $type . '_header_disable_title',
                    'title'         => __('Disable post title in Title Section', 'waterfall'),
                    'type'          => 'checkbox'
                ],                  
                [
                    'default'       => 'after',
                    'id'            => $type . '_header_featured',
                    'title'         => __('Featured Image Position', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => wf_get_background_options()
                ],   
                [
                    'default'       => 'half-hd',
                    'id'            => $type . '_header_size',
                    'title'         => __('Size Featured Image', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => wf_get_image_sizes()
                ],    
                [
                    'default'       => 'quarter',
                    'id'            => $type . '_header_height',
                    'title'         => __('Title Section Height', 'waterfall'),
                    'description'   => __('This will be the minimum height when a page does not have a featured image.', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => wf_get_height_options()
                ],
                [
                    'default'       => 'half',
                    'id'            => $type . '_header_height_image',
                    'title'         => __('Title Section with Featured Height', 'waterfall'),
                    'description'   => __('This will be the minimum height when a page or post has a featured image.', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => wf_get_height_options()
                ], 
                [
                    'default'       => 'default',
                    'description'   => __('Width of the content in the Title Section', 'waterfall'),
                    'id'            => $type . '_header_width',
                    'choices'       => wf_get_container_options(),
                    'title'         => __('Title Section Width', 'waterfall'),
                    'type'          => 'select'
                ],     
                [
                    'default'       => 'left',
                    'id'            => $type . '_header_align',
                    'title'         => __('Title Section Text Align', 'waterfall'),
                    'description'   => __('How should text be aligned within the Title Section?', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => wf_get_align_options()
                ],    
                [
                    'default'       => '',
                    'id'            => $type . '_header_parallax',
                    'title'         => __('Enable the parallax effect to Title Sections', 'waterfall'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_header_breadcrumbs',
                    'title'         => __('Display Breadcrumbs', 'waterfall'),
                    'type'          => 'checkbox'
                ], 
                [
                    'default'       => '',
                    'id'            => $type . '_header_breadcrumbs_archive',
                    'title'         => __('Display Archive in Breadcrumbs', 'waterfall'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_header_breadcrumbs_terms',
                    'title'         => __('Display Associated Terms in Breadcrumbs', 'waterfall'),
                    'type'          => 'checkbox'
                ],                                 
                [
                    'default'       => '',
                    'id'            => $type . '_header_date',
                    'title'         => __('Show the Postdate in Title Sections', 'waterfall'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_header_terms',
                    'title'         => __('Show Tags and Categories in Title Sections', 'waterfall'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_header_comments',
                    'title'         => __('Show Comments Indicator in Title Sections', 'waterfall'),
                    'type'          => 'checkbox'
                ],                
                [
                    'default'       => false,
                    'id'            => $type . '_header_share',
                    'title'         => __('Title Section Sharing Buttons', 'waterfall'),
                    'description'   => __('Displays sharing buttons inside the title section. Please scroll to the footer settings to specify what social networks you want to show.', 'waterfall'),
                    'type'          => 'checkbox'
                ],            
                [
                    'default'       => false,
                    'id'            => $type . '_header_author',
                    'title'         => __('Show the Author in Title Sections', 'waterfall'),
                    'type'          => 'checkbox'
                ],               
                [
                    'default'       => 'none',
                    'id'            => $type . '_header_scroll',
                    'title'         => __('Enable the Scroll Button in Title Sections', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => wf_get_button_options()
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_main_content_content_header',
                    'title'         => __('Main Content', 'waterfall'),
                    'type'          => 'heading'
                ],             
                [
                    'default'       => 'default',
                    'description'   => __('Width of the main content section.', 'waterfall'),
                    'id'            => $type . '_content_width',
                    'choices'       => wf_get_container_options(),
                    'title'         => __('Main Content Width', 'waterfall'),
                    'type'          => 'select'
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_content_readable',
                    'title'         => __('Limit content to readable width', 'waterfall'),
                    'description'   => __('Limits paragraphs, lists and smaller titles to a readable width and centers them.', 'waterfall'),
                    'type'          => 'checkbox'
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
                    'default'       => '',
                    'id'            => $type . '_main_content_related_header',
                    'title'         => __('Related Posts', 'waterfall'),
                    'type'          => 'heading'
                ],            
                [
                    'default'       => '',
                    'id'            => $type . '_related_disable',
                    'title'         => __('Disable the related content section', 'waterfall'),
                    'type'          => 'checkbox'
                ],    
                [
                    'default'       => 'default',
                    'description'   => __('Width of the related content section.', 'waterfall'),
                    'id'            => $type . '_related_width',
                    'choices'       => wf_get_container_options(),
                    'title'         => __('Related Section Width', 'waterfall'),
                    'type'          => 'select'
                ],    
                [
                    'default'       => '',
                    'id'            => $type . '_related_posts',
                    'title'         => __('Show related posts', 'waterfall'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => __('You also might like', 'waterfall'),
                    'id'            => $type . '_related_title',
                    'title'         => __('Title above Related Posts', 'waterfall'),
                    'selector'      => ['selector' => '.main-related > h3,  .main-related .components-container > h3', 'html' => true],
                    'transport'     => 'postMessage',                  
                    'type'          => 'input'
                ],  
                [
                    'default'       => 'third',
                    'description'   => __('Amount of grid columns for posts.', 'waterfall'),
                    'id'            => $type . '_related_grid',
                    'choices'       => wf_get_column_options(),
                    'title'         => __('Related Posts Columns', 'waterfall'),
                    'type'          => 'select'
                ],
                [
                    'default'       => 'default',
                    'description'   => __('The Gap Width Between the Related Posts,', 'waterfall'),
                    'id'            => $type . '_related_grid_gap',
                    'choices'       => wf_get_grid_gaps(),
                    'title'         => __('Gap Width', 'waterfall'),
                    'type'          => 'select'
                ],                 
                [
                    'default'       => '',
                    'description'   => __('Minimum height of related posts in pixels.', 'waterfall'),
                    'id'            => $type . '_related_height',
                    'title'         => __('Related Posts Height', 'waterfall'),
                    'selector'      => ['selector' => '.main-related .molecule-post', 'property' => 'min-height'],
                    'transport'     => 'postMessage',                 
                    'type'          => 'number'
                ],     
                [
                    'default'       => 3,
                    'description'   => __('Number of related posts to show', 'waterfall'),
                    'id'            => $type . '_related_number',
                    'title'         => __('Related Posts Amount', 'waterfall'),
                    'type'          => 'number'
                ], 
                [
                    'default'       => 'grid',
                    'id'            => $type . '_related_style',
                    'choices'       => wf_get_grid_options(),
                    'title'         => __('Related Posts Style', 'waterfall'),
                    'type'          => 'select'
                ],                    
                [
                    'default'       => '',
                    'description'   => __('Excerpt within related posts.', 'waterfall'),
                    'id'            => $type . '_related_content',
                    'choices'       => [
                        'excerpt'   => __('Excerpt', 'waterfall'),
                        'none'      => __('No excerpt', 'waterfall'),
                    ],
                    'title'         => __('Related Post Excerpt', 'waterfall'),
                    'type'          => 'select'
                ],    
                [
                    'default'       => '',
                    'description'   => __('Featured Image size within related posts.', 'waterfall'),
                    'id'            => $type . '_related_image',
                    'choices'       => wf_get_image_sizes(),
                    'title'         => __('Related Featured Image Size', 'waterfall'),
                    'type'          => 'select'
                ],    
                [
                    'default'       => '',
                    'description'   => __('Float of featured image within the related posts.', 'waterfall'),
                    'id'            => $type . '_related_image_float',
                    'choices'       => wf_get_float_options(),
                    'title'         => __('Related Featured Image Float', 'waterfall'),
                    'type'          => 'select'
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_related_image_enlarge',
                    'title'         => __('Enlarge Featured Image on Hover', 'waterfall'),
                    'type'          => 'checkbox'
                ],                 
                [
                    'default'       => __('View Post', 'waterfall'),
                    'id'            => $type . '_related_button',
                    'title'         => __('Text of Related Posts Button', 'waterfall'),
                    'description'   => __('The title inside the buttons. Leave empty to remove the button.', 'waterfall'),              
                    'type'          => 'input'
                ],
                [
                    'default'       => __('Bummer! No related posts have been found.', 'waterfall'),
                    'id'            => $type . '_related_none',
                    'title'         => __('No Related Posts Found', 'waterfall'),
                    'description'   => __('The text shown when no related posts are found.', 'waterfall'),                  
                    'type'          => 'input'
                ],                
                [
                    'default'       => '',
                    'id'            => $type . '_related_pagination',
                    'title'         => __('Show post pagination', 'waterfall'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => __('&lsaquo; Previous Article', 'waterfall'),
                    'id'            => $type . '_related_pagination_prev',
                    'title'         => __('Pagination Previous Article Title', 'waterfall'),
                    'selector'      => ['selector' => '.main-related .atom-pagination a[rel=\'prev\'] span', 'html' => true],
                    'transport'     => 'postMessage',                  
                    'type'          => 'input'
                ],
                [
                    'default'       => __('Next Article &rsaquo; ', 'waterfall'),
                    'id'            => $type . '_related_pagination_next',
                    'title'         => __('Pagination Next Article Title', 'waterfall'),
                    'selector'      => ['selector' => '.main-related .atom-pagination a[rel=\'next\'] span', 'html' => true],
                    'transport'     => 'postMessage',                   
                    'type'          => 'input'
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_main_content_footer_header',
                    'title'         => __('Content Footer', 'waterfall'),
                    'type'          => 'heading'
                ],                
                [
                    'default'       => '',
                    'id'            => $type . '_footer_disable',
                    'title'         => __('Disable content footer', 'waterfall'),
                    'type'          => 'checkbox'
                ],     
                [
                    'default'       => 'default',
                    'description'   => __('Width of the content footer.', 'waterfall'),
                    'id'            => $type . '_footer_width',
                    'choices'       => wf_get_container_options(),
                    'title'         => __('Content Footer Width', 'waterfall'),
                    'type'          => 'select'
                ],     
                [
                    'default'       => '',
                    'id'            => $type . '_footer_author',
                    'title'         => __('Show the author in the content footer', 'waterfall'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_footer_comments',
                    'title'         => __('Show comments in the content footer', 'waterfall'),
                    'type'          => 'checkbox'
                ], 
                [
                    'default'       => __('Comments are closed.', 'waterfall'),
                    'id'            => $type . '_footer_comments_closed',
                    'title'         => __('Text for closed comments', 'waterfall'),
                    'selector'      => ['selector' => '.main-footer .atom-comments-closed', 'html' => true],
                    'transport'     => 'postMessage',                  
                    'type'          => 'input'
                ], 
                [
                    'default'       => '',
                    'id'            => $type . '_footer_comments_title',
                    'title'         => __('Title above comments', 'waterfall'),
                    'description'   => __('Use {number} and {title} tags to display the number of comments and post title respectively.', 'waterfall'),
                    'selector'      => ['selector' => '.main-footer .atom-comments-title', 'html' => true],
                    'transport'     => 'postMessage',                  
                    'type'          => 'input'
                ],  
                [
                    'default'       => __('Leave a reply', 'waterfall'),
                    'id'            => $type . '_footer_comments_reply',
                    'title'         => __('Title above comments form', 'waterfall'),
                    'selector'      => ['selector' => '.main-footer .comment-reply-title', 'html' => true],
                    'transport'     => 'postMessage',                  
                    'type'          => 'input'
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_footer_share',
                    'title'         => __('Show sharing buttons in posts', 'waterfall'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_footer_share_fixed',
                    'title'         => __('Fix sharing buttons to the left of the screen', 'waterfall'),
                    'type'          => 'checkbox'
                ],  
                [
                    'default'       => '',
                    'id'            => $type . '_share_text',
                    'title'         => __('Text in sharing sharing button', 'waterfall'),
                    'type'          => 'input',
                    'transport'     => 'postMessage',
                    'selector'      => ['selector' => '.atom-share-title', 'html' => true]
                ],                           
                [
                    'default'       => '',
                    'id'            => $type . '_share_facebook',
                    'title'         => __('Show Facebook sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ],                     
                [
                    'default'       => '',
                    'id'            => $type . '_share_twitter',
                    'title'         => __('Show Twitter sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ],                     
                [
                    'default'       => '',
                    'id'            => $type . '_share_linkedin',
                    'title'         => __('Show LinkedIn sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ],                  
                [
                    'default'       => '',
                    'id'            => $type . '_share_pinterest',
                    'title'         => __('Show Pinterest sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ],                     
                [
                    'default'       => '',
                    'id'            => $type . '_share_reddit',
                    'title'         => __('Show Reddit sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ],                   
                [
                    'default'       => '',
                    'id'            => $type . '_share_pocket',
                    'title'         => __('Show Pocket sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ],                      
                [
                    'default'       => '',
                    'id'            => $type . '_share_whatsapp',
                    'title'         => __('Show Whatsapp sharing button', 'waterfall'),
                    'type'          => 'checkbox'
                ]   
            ]
        ];

        /**
         * If a page has been designed by elementor, we only show one field.
         */
        if( wf_elementor_theme_has_location('single', $type) ) {
            $layout['sections'][$type . '_content']['fields'] = [
                [
                    'id'            => $type . '_content_elementor',
                    'description'   => sprintf( __('The %s page is designed by the Elementor Theme Builder. Thus, no layout settings are shown here.', 'waterfall'), $name ),
                    'title'         => __('Designed by Elementor', 'waterfall'),
                    'type'          => 'heading'
                ] 
            ];  
        }       

        // Skip archives for pages
        if( $type == 'page' ) {
            continue;
        }

        /**
         * Additional Sections
         */
        $layout['sections'][$type . '_archives'] = [
            'id'        => $type . '_archives',
            'title'     => sprintf( __('%s Archives', 'waterfall'), $name ),
            'fields'    => [
                [
                    'default'       => '',
                    'id'            => $type . '_archive_title_header',
                    'title'         => __('Archive Title Section', 'waterfall'),
                    'type'          => 'heading'
                ],            
                [
                    'default'       => '',
                    'id'            => $type . '_archive_header_disable',
                    'title'         => __('Disable Archive Title Section', 'waterfall'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_archive_header_breadcrumbs',
                    'title'         => __('Display Breadcrumbs', 'waterfall'),
                    'type'          => 'checkbox'
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_archive_header_breadcrumbs_posts',
                    'title'         => __('Display Post Type in Breadcrumbs', 'waterfall'),
                    'type'          => 'checkbox'
                ],                
                [
                    'default'       => 'default',
                    'description'   => __('Width of title section in posts archives.', 'waterfall'),
                    'id'            => $type . '_archive_header_width',
                    'choices'       => wf_get_container_options(),
                    'title'         => __('Header Width', 'waterfall'),
                    'type'          => 'select'
                ],
                [
                    'default'       => 'default',
                    'description'   => __('Height of title section in posts archives.', 'waterfall'),
                    'id'            => $type . '_archive_header_height',
                    'choices'       => wf_get_height_options(),
                    'title'         => __('Header Height', 'waterfall'),
                    'type'          => 'select'
                ],    
                [
                    'default'       => 'left',
                    'id'            => $type . '_archive_header_align',
                    'title'         => __('Title Section Text Align', 'waterfall'),
                    'description'   => __('How should text be aligned within the archive header?', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => wf_get_align_options()
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_archive_header_title',
                    'title'         => __('Default Archives Page Title ', 'waterfall'),
                    'description'   => __('Add a custom title for the default archives page. Shown if no category, tag, term, author or date is queried.', 'waterfall'),
                    'type'          => 'input'
                ],   
                [
                    'default'       => '',
                    'id'            => $type . '_archive_header_description',
                    'title'         => __('Archives Page Description', 'waterfall'),
                    'description'   => __('Add a custom title description for the given archive. Use {description} to use the term description in taxonomy archives.', 'waterfall'),
                    'type'          => 'textarea'
                ],                               
                [
                    'default'       => '',
                    'id'            => $type . '_archive_posts_header',
                    'title'         => __('Archive Posts Section', 'waterfall'),
                    'type'          => 'heading'
                ],                
                [
                    'default'       => 'full',
                    'description'   => __('Choose the sidebar lay-out for archives.', 'waterfall'),
                    'id'            => $type . '_archive_sidebar_position',
                    'choices'       => wf_get_sidebar_options(),
                    'title'         => __('Sidebar Lay-Out', 'waterfall'),
                    'type'          => 'select'
                ],
                [
                    'default'       => 'default',
                    'description'   => __('Width of grid in posts archives.', 'waterfall'),
                    'id'            => $type . '_archive_content_width',
                    'choices'       => wf_get_container_options(),
                    'title'         => __('Grid Width', 'waterfall'),
                    'type'          => 'select'
                ],   
                [
                    'default'       => 'grid',
                    'description'   => __('Style of posts in archives.', 'waterfall'),
                    'id'            => $type . '_archive_content_style',
                    'choices'       => wf_get_grid_options(),
                    'title'         => __('Grid Style', 'waterfall'),
                    'type'          => 'select'
                ],   
                [
                    'default'       => 'third',
                    'description'   => __('The amount of columns used for displaying posts.', 'waterfall'),
                    'id'            => $type . '_archive_content_columns',
                    'choices'       => wf_get_column_options(),
                    'title'         => __('Grid Columns', 'waterfall'),
                    'type'          => 'select'
                ],   
                [
                    'default'       => 'third',
                    'description'   => __('The width of the gap between various posts.', 'waterfall'),
                    'id'            => $type . '_archive_content_gap',
                    'choices'       => wf_get_grid_gaps(),
                    'title'         => __('Grid Gap Width', 'waterfall'),
                    'type'          => 'select'
                ],                   
                [
                    'default'       => 'excerpt',
                    'description'   => __('Excerpt within archive posts.', 'waterfall'),
                    'id'            => $type . '_archive_content_content',
                    'choices'       => [
                        'excerpt'   => __('Excerpt', 'waterfall'),
                        'none'      => __('No excerpt', 'waterfall'),
                    ],
                    'title'         => __($type . ' Excerpt', 'waterfall'),
                    'type'          => 'select'
                ],
                [
                    'default'       => '',
                    'description'   => __('Shows the post type under the title of each post.', 'waterfall'),
                    'id'            => $type . '_archive_content_type',
                    'title'         => __('Post Type in Posts', 'waterfall'),
                    'type'          => 'checkbox'
                ],    
                [
                    'default'       => __('View Post', 'waterfall'),
                    'description'   => __('The label for this button. Leave empty to remove the button.', 'waterfall'),
                    'id'            => $type . '_archive_content_button',
                    'title'         => __('Posts Button Label', 'waterfall'),                 
                    'type'          => 'input'
                ],
                [
                    'default'       => __('Bummer! No posts found.', 'waterfall'),
                    'description'   => __('The text if no posts are found.', 'waterfall'),
                    'id'            => $type . '_archive_content_none',
                    'title'         => __('No Posts Found Text', 'waterfall'),                 
                    'type'          => 'input'
                ],                
                [
                    'default'       => '',
                    'description'   => __('Minimum height of posts in the archive in pixels.', 'waterfall'),
                    'id'            => $type . '_archive_content_height',
                    'title'         => __('Posts Height', 'waterfall'),
                    'selector'      => ['selector' => '.archive-posts .molecule-post.' . $type, 'property' => 'min-height'],
                    'transport'     => 'postMessage',                  
                    'type'          => 'number'
                ],    
                [
                    'default'       => 'medium',
                    'description'   => __('Featured Image size within archive posts.', 'waterfall'),
                    'id'            => $type . '_archive_content_image',
                    'choices'       => wf_get_image_sizes(),
                    'title'         => __('Featured Image Size', 'waterfall'),
                    'type'          => 'select'
                ],    
                [
                    'default'       => 'none',
                    'description'   => __('Float of featured image within the posts.', 'waterfall'),
                    'id'            => $type . '_archive_content_image_float',
                    'choices'       => wf_get_float_options(),
                    'title'         => __('Featured Image Float', 'waterfall'),
                    'type'          => 'select'
                ],
                [
                    'default'       => '',
                    'id'            => $type . '_archive_content_image_enlarge',
                    'title'         => __('Enlarge Featured Image on Hover', 'waterfall'),
                    'type'          => 'checkbox'
                ]                        
            ]              
        ];

        /**
         * If a page has been designed by elementor, we only show one field.
         */
        if( wf_elementor_theme_has_location('archive', $type) ) {

            $layout['sections'][$type . '_archives']['fields'] = [
                [
                    'id'            => $type . '_archives_elementor',
                    'description'   => sprintf( __('The %s archive is designed by the Elementor Theme Builder. Thus, no layout settings are shown here.', 'waterfall'), $name ),
                    'title'         => __('Designed by Elementor', 'waterfall'),
                    'type'          => 'heading'
                ] 
            ];          

        }


    }
}



// Search Page
$layout['sections']['search_page'] = [
    'id'        => 'search_page',
    'title'     => __('Search Page', 'waterfall'),
    'fields'    => [
        [
            'default'       => '',
            'id'            => 'search_title_header',
            'title'         => __('Search Title Section', 'waterfall'),
            'type'          => 'heading'
        ],
        [
            'default'       => '',
            'id'            => 'search_header_disable',
            'title'         => __('Disable Search Title Section', 'waterfall'),
            'type'          => 'checkbox'
        ],
        [
            'default'       => '',
            'id'            => 'search_header_breadcrumbs',
            'title'         => __('Display Breadcrumbs', 'waterfall'),
            'type'          => 'checkbox'
        ],
        [
            'default'       => 'default',
            'description'   => __('Width of header in search archives.', 'waterfall'),
            'id'            => 'search_header_width',
            'choices'       => wf_get_container_options(),
            'title'         => __('Search Title Section Width', 'waterfall'),
            'type'          => 'select'
        ],
        [
            'default'       => 'default',
            'description'   => __('Height of header in search archives.', 'waterfall'),
            'id'            => 'search_header_height',
            'choices'       => wf_get_height_options(),
            'title'         => __('Search Title Section Height', 'waterfall'),
            'type'          => 'select'
        ],    
        [
            'default'       => 'left',
            'id'            => 'search_header_align',
            'title'         => __('Search Title Section Text Align', 'waterfall'),
            'description'   => __('How should text be aligned within the search title section?', 'waterfall'),
            'type'          => 'select',
            'choices'       => wf_get_align_options()
        ],
        [
            'default'       => '',
            'id'            => 'search_header_title',
            'title'         => __('Custom Title for the Search Page', 'waterfall'),
            'description'   => __('Add a custom title for the search page. The {term} and {number} tags may be used to display the search term and number of results respectively.', 'waterfall'),
            'type'          => 'input'
        ],          
        [
            'default'       => '',
            'id'            => 'search_posts_header',
            'title'         => __('Search Results Section', 'waterfall'),
            'type'          => 'heading'
        ],           
        [
            'default'       => 'full',
            'description'   => __('Choose the sidebar lay-out for the search page.', 'waterfall'),
            'id'            => 'search_sidebar_position',
            'choices'       => wf_get_sidebar_options(),
            'title'         => __('Sidebar Lay-Out', 'waterfall'),
            'type'          => 'select'
        ], 
        [
            'default'       => 'default',
            'description'   => __('Width of the grid for search results.', 'waterfall'),
            'id'            => 'search_content_width',
            'choices'       => wf_get_container_options(),
            'title'         => __('Search Page Width', 'waterfall'),
            'type'          => 'select'
        ],    
        [
            'default'       => 'list',
            'description'   => __('Style of posts in the search page.', 'waterfall'),
            'id'            => 'search_content_style',
            'choices'       => wf_get_grid_options(),
            'title'         => __('Search Page Results Style', 'waterfall'),
            'type'          => 'select'
        ],
        [
            'default'       => 'full',
            'description'   => __('Amount of grid columns for search page posts.', 'waterfall'),
            'id'            => 'search_content_columns',
            'choices'       => wf_get_column_options(),
            'title'         => __('Search Page Columns', 'waterfall'),
            'type'          => 'select'
        ],    
        [
            'default'       => 'excerpt',
            'description'   => __('Excerpt within search page results.', 'waterfall'),
            'id'            => 'search_content_content',
            'choices'       => [
                'excerpt'   => __('Excerpt', 'waterfall'),
                'none'      => __('No excerpt', 'waterfall'),
            ],
            'title'         => __('Search Page Results Excerpt', 'waterfall'),
            'type'          => 'select'
        ],
        [
            'default'       => '',
            'description'   => __('Shows the post type under the title of each result.', 'waterfall'),
            'id'            => 'search_content_type',
            'title'         => __('Search Post Type in Results', 'waterfall'),
            'type'          => 'checkbox'
        ],
        [
            'default'       => __('View Post', 'waterfall'),
            'description'   => __('The label for this button. Leave empty to remove the button.', 'waterfall'),
            'id'            => 'search_content_button',
            'title'         => __('Search Page Results Button Label', 'waterfall'),
            'type'          => 'input'
        ],     
        [
            'default'       => '',
            'description'   => __('Minimum height of results in the search page.', 'waterfall'),
            'id'            => 'search_content_height',
            'title'         => __('Search Page Results Height', 'waterfall'),
            'type'          => 'number'
        ],    
        [
            'default'       => 'thumbnail',
            'description'   => __('Featured Image size within search page results.', 'waterfall'),
            'id'            => 'search_content_image',
            'choices'       => wf_get_image_sizes(),
            'title'         => __('Search Page Results Image Size', 'waterfall'),
            'type'          => 'select'
        ],    
        [
            'default'       => 'left',
            'description'   => __('Float of featured image within the results.', 'waterfall'),
            'id'            => 'search_content_image_float',
            'choices'       => wf_get_float_options(),
            'title'         => __('Search Page Featured Image Float', 'waterfall'),
            'type'          => 'select'
        ],
        [
            'default'       => '',
            'id'            => 'search_content_image_enlarge',
            'title'         => __('Enlarge Featured Image on Hover', 'waterfall'),
            'type'          => 'checkbox'
        ]                  
    ]             
];

// 404 Page
$layout['sections']['404_page'] = [
    'id'            => '404_page',
    'title'         => __('404 Page', 'waterfall'),
    'fields'    => [       
        [
            'default'       => 'half',
            'id'            => '404_header_height',
            'title'         => __('404 Header Minimum Height', 'waterfall'),
            'type'          => 'select',
            'choices'       => wf_get_height_options()
        ],
        [
            'default'       => 'default',
            'description'   => __('Width of the 404 Header', 'waterfall'),
            'id'            => '404_header_width',
            'choices'       => wf_get_container_options(),
            'title'         => __('404 Header Width', 'waterfall'),
            'type'          => 'select'
        ],      
        [
            'default'       => 'left',
            'id'            => '404_header_align',
            'title'         => __('Header Text Align', 'waterfall'),
            'description'   => __('How should text be aligned within the 404 header?', 'waterfall'),
            'type'          => 'select',
            'choices'       => wf_get_align_options()
        ],
        [
            'default'       => __('Woops! Nothing found here...', 'waterfall'),
            'id'            => '404_header_title',
            'title'         => __('Default 404 Title', 'waterfall'),
            'selector'      => ['selector' => '.nothing-title', 'html' => true],
            'transport'     => 'postMessage',             
            'type'          => 'input'
        ],
        [
            'default'       => __('Try visiting another page or searching.', 'waterfall'),
            'id'            => '404_header_description',
            'title'         => __('Default 404 Description', 'waterfall'),
            'selector'      => ['selector' => '.nothing-description', 'html' => true],
            'transport'     => 'postMessage',            
            'type'          => 'textarea'
        ],     
        [
            'default'       => '',
            'id'            => '404_header_breadcrumbs',
            'title'         => __('Display Breadcrumbs', 'waterfall'),
            'type'          => 'checkbox'
        ],
        [
            'default'       => '',
            'id'            => '404_header_search',
            'title'         => __('Display Searchform', 'waterfall'),
            'type'          => 'checkbox'
        ]    
    ]              
];
    
// Footer   
$layout['sections']['footer'] = [
    'id'            => 'styling_footer',
    'title'         => __('Footer', 'waterfall'),
    'fields'    => [
        [
            'default'       => '',
            'id'            => 'footer_disable',
            'title'         => __('Disable Footer', 'waterfall'),
            'type'          => 'checkbox'
        ],                
        [
            'default'       => 'default',
            'id'            => 'footer_width',
            'title'         => __('Footer Width', 'waterfall'),
            'type'          => 'select',
            'choices'       => wf_get_container_options(),
        ],
        [
            'default'       => '',
            'id'            => 'footer_display_sidebars',
            'title'         => __('Display Sidebars', 'waterfall'),
            'type'          => 'checkbox'
        ],    
        [
            'default'       => 'third',
            'description'   => __('Amount of sidebars in the footer.', 'waterfall'),
            'id'            => 'footer_sidebars',
            'choices'       => [
                'full'      => __('One sidebar', 'waterfall'),
                'half'      => __('Two sidebars', 'waterfall'),
                'third'     => __('Three sidebars', 'waterfall'),
                'fourth'    => __('Four sidebars', 'waterfall'),
                'fifth'     => __('Five sidebars', 'waterfall')
            ],
            'title'         => __('Footer Sidebars', 'waterfall'),
            'type'          => 'select'
        ], 
        [
            'default'       => 'default',
            'description'   => __('The gap width between the sidebars.', 'waterfall'),
            'id'            => 'footer_grid_gap',
            'choices'       => wf_get_grid_gaps(),
            'title'         => __('Sidebar Gap Width', 'waterfall'),
            'type'          => 'select'
        ],        
        [
            'default'       => '',
            'id'            => 'footer_display_socket',
            'title'         => __('Display Socket', 'waterfall'),
            'type'          => 'checkbox'
        ],    
        [
            'default'       => '',
            'id'            => 'footer_copyright',
            'title'         => __('Display Copyright', 'waterfall'),
            'type'          => 'checkbox'
        ],
        [
            'selector'      => ['selector' => '.atom-copyright span > span', 'html' => true],
            'default'       => get_bloginfo('name'),
            'id'            => 'footer_copyright_name',
            'title'         => __('Copyright Message', 'waterfall'),
            'type'          => 'textarea',
            'transport'     => 'postMessage'
        ],
        [
            'default'       => '',
            'id'            => 'footer_menu',
            'title'         => __('Display Footer Menu', 'waterfall'),
            'type'          => 'checkbox'
        ],
        [
            'default'       => '',
            'id'            => 'footer_social',
            'title'         => __('Display Social Icons', 'waterfall'),
            'type'          => 'checkbox'
        ],
        [
            'default'       => '',
            'id'            => 'footer_social_background',
            'title'         => __('Remove Background in Social Icons', 'waterfall'),
            'type'          => 'checkbox'
        ], 
        [
            'default'       => '',
            'id'            => 'footer_logo_stack',
            'title'         => __('Put Footer Logo above other elements.', 'waterfall'),
            'description'   => __('If you have defined a footer logo under Site Identity, it will appear in the bottom of your footer. Normally, it will center, but if this box is ticked it will render above the other socket elements.', 'waterfall'),
            'type'          => 'checkbox'
        ],
        [
            'default'       => 'none',
            'id'            => 'footer_scroll',
            'title'         => __('Scroll to Top Button', 'waterfall'),
            'type'          => 'select',
            'choices'       => [
                'none'      => __('None', 'waterfall'),
                'left'      => __('On the left', 'waterfall'),
                'center'    => __('On the center', 'waterfall'),
                'right'     => __('On the right', 'waterfall')
            ]            
        ],  
        [
            'default'       => 'default',
            'id'            => 'footer_scroll_style',
            'title'         => __('Scroll to Top Button Style', 'waterfall'),
            'type'          => 'select',
            'choices'       => [
                'default'   => __('Default', 'waterfall'),
                'rounded'   => __('Rounded', 'waterfall')
            ],            
        ]                                      
    ]              
];

/**
 * Other conditional settings. 
 * If some areas are designed by elementor, their display is conditional
 */
foreach(['header' => __('Header', 'waterfall'), 'footer' => __('Header', 'waterfall')] as $part => $label ) {
    
    if( ! wf_elementor_theme_has_location($part) ) {
        continue;
    }

    $layout['sections'][$part]['fields'] = [
        [
            'id'            => $part . '_elementor',
            'description'   => sprintf( __('The %s is designed by the Elementor Theme Builder. Thus, no settings are shown here.', 'waterfall'), $label ),
            'title'         => __('Designed by Elementor', 'waterfall'),
            'type'          => 'heading'
        ] 
    ]; 

}

// 404 Page
if( wf_elementor_theme_has_location('single', '404') ) {
    $layout['sections']['404_page']['fields'] = [
        [
            'id'            => '404_page_elementor',
            'description'   => __('The 404 page is designed by the Elementor Theme Builder. Thus, no settings are shown here.', 'waterfall'),
            'title'         => __('Designed by Elementor', 'waterfall'),
            'type'          => 'heading'
        ] 
    ];     
}

// Search Page
if( wf_elementor_theme_has_location('archive', 'search') ) {
    $layout['sections']['search_page']['fields'] = [
        [
            'id'            => 'search_page_elementor',
            'description'   => __('The search page is designed by the Elementor Theme Builder. Thus, no settings are shown here.', 'waterfall'),
            'title'         => __('Designed by Elementor', 'waterfall'),
            'type'          => 'heading'
        ] 
    ];     
}