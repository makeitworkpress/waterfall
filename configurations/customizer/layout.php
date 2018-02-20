<?php
/**
 * Adds extensive settings for the layout
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

// Receive our public post types
$types  = get_option('waterfall_post_types');

// Set-up the settings array
$layout = array(
    'description'   => __('Adjust extensive settings and elements for various parts of the website here.', 'waterfall'),
    'id'            => 'waterfall_layout',
    'title'         => __('Theme Layout', 'waterfall'),
    'panel'         => true,
    'sections'      => array(
        'style_header' => array(
            'id'            => 'style_header',
            'title'         => __('Header', 'waterfall'),
            'fields'    => array( 
                array(
                    'default'       => '',
                    'id'            => 'header_disable',
                    'title'         => __('Disable Header', 'waterfall'),
                    'type'          => 'checkbox'
                ),    
                array(
                    'default'       => 'full',
                    'id'            => 'header_width',
                    'title'         => __('Header Width', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => wf_get_container_options()
                ),
                array(
                    'selector'      => array('selector' => '.molecule-header-atoms', 'property' => array('min-height', 'line-height') ),
                    'default'       => '',
                    'id'            => 'header_height',
                    'title'         => __('Header Minimum Height', 'waterfall'),
                    'type'          => 'dimension'
                ),                
                array(
                    'default'       => '',
                    'id'            => 'header_fixed',
                    'title'         => __('Fixed Header', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => '',
                    'id'            => 'header_border',
                    'title'         => __('Disable Header Bottom Border', 'waterfall'),
                    'type'          => 'checkbox'
                ),                 
                array(
                    'default'       => '',
                    'id'            => 'header_headroom',
                    'title'         => __('Collapse Header when Scrolling', 'waterfall'),
                    'type'          => 'checkbox'
                ), 
                array(
                    'default'       => '',
                    'id'            => 'header_transparent',
                    'title'         => __('Transparent Header', 'waterfall'),
                    'type'          => 'checkbox'
                ), 
                array(
                    'default'       => 'left',
                    'id'            => 'header_logo_float',
                    'title'         => __('Logo Position', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => array(
                        'center'    => __('Center', 'waterfall'),
                        'left'      => __('Left', 'waterfall'),
                        'right'     => __('Right', 'waterfall'),
                    ),
                ),
                array(
                    'default'       => '',
                    'id'            => 'header_disable_logo',
                    'title'         => __('Disable Header Logo', 'waterfall'),
                    'type'          => 'checkbox'
                ),        
                array(
                    'default'       => 'right',
                    'id'            => 'header_menu_float',
                    'title'         => __('Menu Position', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => array(
                        'center'    => __('Center', 'waterfall'),
                        'left'      => __('Left', 'waterfall'),
                        'right'     => __('Right', 'waterfall'),
                    ),
                ),
                array(
                    'default'       => '',
                    'id'            => 'header_search',
                    'title'         => __('Add a Search Icon to the Header', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => __('Nothing found!', 'waterfall'),
                    'id'            => 'header_search_none',
                    'title'         => __('Nothing Found Search Text', 'waterfall'),
                    'description'   => __('Text when nothing is found in search', 'waterfall'),
                    'selector'      => array('selector' => '.atom-search-results .atom-posts-none', 'html' => true),
                    'transport'     => 'postMessage',                    
                    'type'          => 'input'
                ),
                array(
                    'default'       => __('View All Results', 'waterfall'),
                    'id'            => 'header_search_all',
                    'title'         => __('All Results Search Text', 'waterfall'),
                    'description'   => __('Text for link to all the results', 'waterfall'),
                    'selector'      => array('selector' => '.atom-search-results .atom-search-all', 'html' => true),
                    'transport'     => 'postMessage',                      
                    'type'          => 'input'
                ),                
                array(
                    'default'       => '',
                    'id'            => 'header_social',
                    'title'         => __('Add Social Icons to the Header', 'waterfall'),
                    'type'          => 'checkbox'
                ),     
                array(
                    'default'       => '',
                    'id'            => 'header_disable_menu',
                    'title'         => __('Disable Header Menu', 'waterfall'),
                    'type'          => 'checkbox'
                ),               
                array(
                    'default'       => 'mobile',
                    'id'            => 'header_menu_hamburger',
                    'title'         => __('Display of Mobile Menu', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => array(
                        'always'    => __('Always Display', 'waterfall'),
                        'tablet'    => __('Display on Tablets', 'waterfall'),
                        'mobile'    => __('Display on Mobile', 'waterfall'),
                    ),
                ),
                array(
                    'default'       => 'default',
                    'id'            => 'header_menu_style',
                    'title'         => __('Header Menu Style', 'waterfall'),
                    'description'   => __('Some styles always show a hamburger menu, while others are only visible in the mobile menu.', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => array(
                        'default'   => __('Default', 'waterfall'),
                        'dark'      => __('Dark (Mobile)', 'waterfall'),
                        'fixed'     => __('Fixed (Hamburger)', 'waterfall'),
                        'left'      => __('Left (Hamburger)', 'waterfall'),
                        'right'     => __('Right (Hamburger)', 'waterfall'),
                    ),
                )  
            )              
        ),
    )
); 

// Based on our post types, we add variable settings
foreach( $types as $type => $properties ) {

    $layout['sections'][$type . '_content'] = array(
        'id'        => $type . '_content',
        'title'     => $properties['name'],
        'fields'    => array(
            array(
                'default'       => '',
                'id'            => $type . '_header_disable',
                'title'         => __('Disable Title Section', 'waterfall'),
                'type'          => 'checkbox'
            ),     
            array(
                'default'       => 'after',
                'id'            => $type . '_header_featured',
                'title'         => __('Featured Image Position', 'waterfall'),
                'type'          => 'select',
                'choices'       => wf_get_background_options()
            ),   
            array(
                'default'       => 'half-hd',
                'id'            => $type . '_header_size',
                'title'         => __('Size Featured Image', 'waterfall'),
                'type'          => 'select',
                'choices'       => wf_get_image_sizes()
            ),    
            array(
                'default'       => 'quarter',
                'id'            => $type . '_header_height',
                'title'         => __('Title Section Minimum Height', 'waterfall'),
                'description'   => __('This will be the minimum height when a page does not have a featured image.', 'waterfall'),
                'type'          => 'select',
                'choices'       => wf_get_height_options()
            ),
            array(
                'default'       => 'half',
                'id'            => $type . '_header_height_image',
                'title'         => __('Title Section with Featured Image Minimum Height', 'waterfall'),
                'description'   => __('This will be the minimum height when a page has a featured image.', 'waterfall'),
                'type'          => 'select',
                'choices'       => wf_get_height_options()
            ), 
            array(
                'default'       => 'default',
                'description'   => __('Width of the header of the content.', 'waterfall'),
                'id'            => $type . '_header_width',
                'choices'       => wf_get_container_options(),
                'title'         => __('Title Section Width', 'waterfall'),
                'type'          => 'select'
            ),     
            array(
                'default'       => 'left',
                'id'            => $type . '_header_align',
                'title'         => __('Title Section Text Align', 'waterfall'),
                'description'   => __('How should text be aligned within the Title Section?', 'waterfall'),
                'type'          => 'select',
                'choices'       => wf_get_align_options()
            ),    
            array(
                'default'       => '',
                'id'            => $type . '_header_parallax',
                'title'         => __('Enable the parallax effect to Title Sections', 'waterfall'),
                'type'          => 'checkbox'
            ),
            array(
                'default'       => '',
                'id'            => $type . '_header_breadcrumbs',
                'title'         => __('Display Breadcrumbs', 'waterfall'),
                'type'          => 'checkbox'
            ),    
            array(
                'default'       => '',
                'id'            => $type . '_header_date',
                'title'         => __('Show a date in Title Sections', 'waterfall'),
                'type'          => 'checkbox'
            ),
            array(
                'default'       => '',
                'id'            => $type . '_header_terms',
                'title'         => __('Show tags and categories in Title Sections', 'waterfall'),
                'type'          => 'checkbox'
            ),
            array(
                'default'       => false,
                'id'            => $type . '_header_author',
                'title'         => __('Show the author in post Title Sections', 'waterfall'),
                'type'          => 'checkbox'
            ), 
            array(
                'default'       => false,
                'id'            => $type . '_header_disable_title',
                'title'         => __('Disable the title in Title Sections', 'waterfall'),
                'type'          => 'checkbox'
            ),                
            array(
                'default'       => 'none',
                'id'            => $type . '_header_scroll',
                'title'         => __('Enable the scroll button in Title Sections', 'waterfall'),
                'type'          => 'select',
                'choices'       => wf_get_button_options()
            ),
            array(
                'default'       => 'default',
                'description'   => __('Width of the main content section.', 'waterfall'),
                'id'            => $type . '_content_width',
                'choices'       => wf_get_container_options(),
                'title'         => __('Main Content Width', 'waterfall'),
                'type'          => 'select'
            ),
            array(
                'default'       => '',
                'id'            => $type . '_content_readable',
                'title'         => __('Limit content to readable width', 'waterfall'),
                'description'   => __('Limits paragraphs, lists and smaller titles to a readable width and centers them.', 'waterfall'),
                'type'          => 'checkbox'
            ),     
            array(
                'default'       => 'full',
                'description'   => __('Choose the sidebar lay-out.', 'waterfall'),
                'id'            => $type . '_sidebar_position',
                'choices'       => wf_get_sidebar_options(),
                'title'         => __('Sidebar Lay-Out', 'waterfall'),
                'type'          => 'select'
            ),
            array(
                'default'       => '',
                'id'            => $type . '_related_disable',
                'title'         => __('Disable the related content section', 'waterfall'),
                'type'          => 'checkbox'
            ),    
            array(
                'default'       => 'default',
                'description'   => __('Width of the related content section.', 'waterfall'),
                'id'            => $type . '_related_width',
                'choices'       => wf_get_container_options(),
                'title'         => __('Related Section Width', 'waterfall'),
                'type'          => 'select'
            ),    
            array(
                'default'       => '',
                'id'            => $type . '_related_posts',
                'title'         => __('Show related posts', 'waterfall'),
                'type'          => 'checkbox'
            ),
            array(
                'default'       => __('You also might like', 'waterfall'),
                'id'            => $type . '_related_title',
                'title'         => __('Title above Related Posts', 'waterfall'),
                'selector'      => array('selector' => '.main-related > h3,  .main-related .components-container > h3', 'html' => true),
                'transport'     => 'postMessage',                  
                'type'          => 'input'
            ),  
            array(
                'default'       => 'third',
                'description'   => __('Amount of grid columns for posts.', 'waterfall'),
                'id'            => $type . '_related_grid',
                'choices'       => wf_get_column_options(),
                'title'         => __('Related Posts Columns', 'waterfall'),
                'type'          => 'select'
            ),
            array(
                'default'       => '',
                'description'   => __('Minimum height of related posts in pixels.', 'waterfall'),
                'id'            => $type . '_related_height',
                'title'         => __('Related Posts Height', 'waterfall'),
                'selector'      => array('selector' => '.main-related .molecule-post', 'property' => 'min-height'),
                'transport'     => 'postMessage',                 
                'type'          => 'number'
            ),     
            array(
                'default'       => 3,
                'description'   => __('Number of related posts to show', 'waterfall'),
                'id'            => $type . '_related_number',
                'title'         => __('Related Posts Amount', 'waterfall'),
                'type'          => 'number'
            ), 
            array(
                'default'       => 'grid',
                'id'            => $type . '_related_style',
                'choices'       => wf_get_grid_options(),
                'title'         => __('Related Posts Style', 'waterfall'),
                'type'          => 'select'
            ),                    
            array(
                'default'       => 'none',
                'description'   => __('Excerpt within related posts.', 'waterfall'),
                'id'            => $type . '_related_content',
                'choices'       => array(
                    'excerpt'   => __('Excerpt', 'waterfall'),
                    'none'      => __('No excerpt', 'waterfall'),
                ),
                'title'         => __('Related Post Excerpt', 'waterfall'),
                'type'          => 'select'
            ),    
            array(
                'default'       => 'square-ld',
                'description'   => __('Featured Image size within related posts.', 'waterfall'),
                'id'            => $type . '_related_image',
                'choices'       => wf_get_image_sizes(),
                'title'         => __('Related Featured Image Size', 'waterfall'),
                'type'          => 'select'
            ),    
            array(
                'default'       => 'none',
                'description'   => __('Float of featured image within the related posts.', 'waterfall'),
                'id'            => $type . '_related_image_float',
                'choices'       => wf_get_float_options(),
                'title'         => __('Related Featured Image Float', 'waterfall'),
                'type'          => 'select'
            ),
            array(
                'default'       => '',
                'id'            => $type . '_related_image_enlarge',
                'title'         => __('Enlarge Featured Image on Hover', 'waterfall'),
                'type'          => 'checkbox'
            ),                 
            array(
                'default'       => __('View Post', 'waterfall'),
                'id'            => $type . '_related_button',
                'title'         => __('Text of Related Posts Button', 'waterfall'),
                'description'   => __('The title inside the buttons. Leave empty to remove the button.', 'waterfall'), 
                'selector'      => array('selector' => '.main-related .molecule-post .atom-button span', 'html' => true),
                'transport'     => 'postMessage',                   
                'type'          => 'input'
            ),
            array(
                'default'       => '',
                'id'            => $type . '_related_pagination',
                'title'         => __('Show post pagination', 'waterfall'),
                'type'          => 'checkbox'
            ),
            array(
                'default'       => __('&lsaquo; Previous Article', 'waterfall'),
                'id'            => $type . '_related_pagination_prev',
                'title'         => __('Pagination Previous Article Title', 'waterfall'),
                'selector'      => array('selector' => '.main-related .atom-pagination a[rel=\'prev\'] span', 'html' => true),
                'transport'     => 'postMessage',                  
                'type'          => 'input'
            ),
            array(
                'default'       => __('Next Article &rsaquo; ', 'waterfall'),
                'id'            => $type . '_related_pagination_next',
                'title'         => __('Pagination Next Article Title', 'waterfall'),
                'selector'      => array('selector' => '.main-related .atom-pagination a[rel=\'next\'] span', 'html' => true),
                'transport'     => 'postMessage',                   
                'type'          => 'input'
            ),    
            array(
                'default'       => '',
                'id'            => $type . '_footer_disable',
                'title'         => __('Disable content footer', 'waterfall'),
                'type'          => 'checkbox'
            ),     
            array(
                'default'       => 'default',
                'description'   => __('Width of the content footer.', 'waterfall'),
                'id'            => $type . '_footer_width',
                'choices'       => wf_get_container_options(),
                'title'         => __('Content Footer Width', 'waterfall'),
                'type'          => 'select'
            ),     
            array(
                'default'       => '',
                'id'            => $type . '_footer_author',
                'title'         => __('Show the author in the content footer', 'waterfall'),
                'type'          => 'checkbox'
            ),
            array(
                'default'       => '',
                'id'            => $type . '_footer_comments',
                'title'         => __('Show comments in the content footer', 'waterfall'),
                'type'          => 'checkbox'
            ), 
            array(
                'default'       => __('Comments are closed.', 'waterfall'),
                'id'            => $type . '_footer_comments_closed',
                'title'         => __('Text for closed comments', 'waterfall'),
                'selector'      => array('selector' => '.main-footer .atom-comments-closed', 'html' => true),
                'transport'     => 'postMessage',                  
                'type'          => 'input'
            ),                   
            array(
                'default'       => '',
                'id'            => $type . '_footer_share',
                'title'         => __('Show sharing buttons in posts', 'waterfall'),
                'type'          => 'checkbox'
            ),
            array(
                'default'       => '',
                'id'            => $type . '_footer_share_fixed',
                'title'         => __('Fix sharing buttons to the left of the screen', 'waterfall'),
                'type'          => 'checkbox'
            ),                
            array(
                'default'       => '',
                'id'            => $type . '_share_facebook',
                'title'         => __('Show Facebook sharing button', 'waterfall'),
                'type'          => 'checkbox'
            ),                     
            array(
                'default'       => '',
                'id'            => $type . '_share_twitter',
                'title'         => __('Show Twitter sharing button', 'waterfall'),
                'type'          => 'checkbox'
            ),                     
            array(
                'default'       => '',
                'id'            => $type . '_share_linkedin',
                'title'         => __('Show LinkedIn sharing button', 'waterfall'),
                'type'          => 'checkbox'
            ),                     
            array(
                'default'       => '',
                'id'            => $type . '_share_google-plus',
                'title'         => __('Show Google Plus sharing button', 'waterfall'),
                'type'          => 'checkbox'
            ),                     
            array(
                'default'       => '',
                'id'            => $type . '_share_pinterest',
                'title'         => __('Show Pinterest sharing button', 'waterfall'),
                'type'          => 'checkbox'
            ),                     
            array(
                'default'       => '',
                'id'            => $type . '_share_reddit',
                'title'         => __('Show Reddit sharing button', 'waterfall'),
                'type'          => 'checkbox'
            ),                     
            array(
                'default'       => '',
                'id'            => $type . '_share_stumbleupon',
                'title'         => __('Show StumbleUpon sharing button', 'waterfall'),
                'type'          => 'checkbox'
            ),                     
            array(
                'default'       => '',
                'id'            => $type . '_share_pocket',
                'title'         => __('Show Pocket sharing button', 'waterfall'),
                'type'          => 'checkbox'
            ),                      
            array(
                'default'       => '',
                'id'            => $type . '_share_whatsapp',
                'title'         => __('Show Whatsapp sharing button', 'waterfall'),
                'type'          => 'checkbox'
            )   
        )
    );

    // Skip archives for pages
    if( $type == 'page' ) {
        continue;
    }

    /**
     * Additional Sections
     */
    $layout['sections'][$type . '_archives'] = array(
        'id'        => $type . '_archives',
        'title'     => sprintf( __('%s Archives', 'waterfall'), $properties['singular'] ),
        'fields'    => array(
            array(
                'default'       => '',
                'id'            => $type . '_archive_header_disable',
                'title'         => __('Disable Archive Header', 'waterfall'),
                'type'          => 'checkbox'
            ),
            array(
                'default'       => '',
                'id'            => $type . '_archive_header_breadcrumbs',
                'title'         => __('Display Breadcrumbs', 'waterfall'),
                'type'          => 'checkbox'
            ),
            array(
                'default'       => 'default',
                'description'   => __('Width of header in posts archives.', 'waterfall'),
                'id'            => $type . '_archive_header_width',
                'choices'       => wf_get_container_options(),
                'title'         => __('Header Width', 'waterfall'),
                'type'          => 'select'
            ),
            array(
                'default'       => 'default',
                'description'   => __('Width of header in posts archives.', 'waterfall'),
                'id'            => $type . '_archive_header_height',
                'choices'       => wf_get_height_options(),
                'title'         => __('Header Height', 'waterfall'),
                'type'          => 'select'
            ),    
            array(
                'default'       => 'left',
                'id'            => $type . '_archive_header_align',
                'title'         => __('Header Text Align', 'waterfall'),
                'description'   => __('How should text be aligned within the archive header?', 'waterfall'),
                'type'          => 'select',
                'choices'       => wf_get_align_options()
            ),    
            array(
                'default'       => 'full',
                'description'   => __('Choose the sidebar lay-out for archives.', 'waterfall'),
                'id'            => $type . '_archive_sidebar_position',
                'choices'       => wf_get_sidebar_options(),
                'title'         => __('Sidebar Lay-Out', 'waterfall'),
                'type'          => 'select'
            ),
            array(
                'default'       => 'default',
                'description'   => __('Width of grid in posts archives.', 'waterfall'),
                'id'            => $type . '_archive_content_width',
                'choices'       => wf_get_container_options(),
                'title'         => __('Grid Width', 'waterfall'),
                'type'          => 'select'
            ),   
            array(
                'default'       => 'grid',
                'description'   => __('Style of posts in archives.', 'waterfall'),
                'id'            => $type . '_archive_content_style',
                'choices'       => wf_get_grid_options(),
                'title'         => __('Grid Style', 'waterfall'),
                'type'          => 'select'
            ),   
            array(
                'default'       => 'third',
                'description'   => __('Amount of grid columns for posts archives.', 'waterfall'),
                'id'            => $type . '_archive_content_columns',
                'choices'       => wf_get_column_options(),
                'title'         => __('Grid Columns', 'waterfall'),
                'type'          => 'select'
            ),    
            array(
                'default'       => 'none',
                'description'   => __('Excerpt within archive posts.', 'waterfall'),
                'id'            => $type . '_archive_content_content',
                'choices'       => array(
                    'excerpt'   => __('Excerpt', 'waterfall'),
                    'none'      => __('No excerpt', 'waterfall'),
                ),
                'title'         => __($type . ' Excerpt', 'waterfall'),
                'type'          => 'select'
            ),
            array(
                'default'       => '',
                'description'   => __('Shows the post type under the title of each post.', 'waterfall'),
                'id'            => $type . '_archive_content_type',
                'title'         => __('Post Type in Posts', 'waterfall'),
                'type'          => 'checkbox'
            ),    
            array(
                'default'       => __('View Post', 'waterfall'),
                'description'   => __('The label for this button. Leave empty to remove the button.', 'waterfall'),
                'id'            => $type . '_archive_content_button',
                'title'         => __('Posts Button Label', 'waterfall'),
                'selector'      => array('selector' => '.archive-posts .molecule-post .atom-button span', 'html' => true),
                'transport'     => 'postMessage',                   
                'type'          => 'input'
            ),    
            array(
                'default'       => '',
                'description'   => __('Minimum height of posts in the archive in pixels.', 'waterfall'),
                'id'            => $type . '_archive_content_height',
                'title'         => __('Posts Height', 'waterfall'),
                'selector'      => array('selector' => '.archive-posts .molecule-post', 'property' => 'min-height'),
                'transport'     => 'postMessage',                  
                'type'          => 'number'
            ),    
            array(
                'default'       => 'square-ld',
                'description'   => __('Featured Image size within archive posts.', 'waterfall'),
                'id'            => $type . '_archive_content_image',
                'choices'       => wf_get_image_sizes(),
                'title'         => __('Featured Image Size', 'waterfall'),
                'type'          => 'select'
            ),    
            array(
                'default'       => 'none',
                'description'   => __('Float of featured image within the posts.', 'waterfall'),
                'id'            => $type . '_archive_content_image_float',
                'choices'       => wf_get_float_options(),
                'title'         => __('Featured Image Float', 'waterfall'),
                'type'          => 'select'
            ),
            array(
                'default'       => '',
                'id'            => $type . '_archive_content_image_enlarge',
                'title'         => __('Enlarge Featured Image on Hover', 'waterfall'),
                'type'          => 'checkbox'
            ),                        
        )              
    );
    


}

// Search Page
$layout['sections']['search_page'] = array(
    'id'        => 'search_page',
    'title'     => __('Search Page', 'waterfall'),
    'fields'    => array(
        array(
            'default'       => '',
            'id'            => 'search_header_disable',
            'title'         => __('Disable Search Header', 'waterfall'),
            'type'          => 'checkbox'
        ),
        array(
            'default'       => '',
            'id'            => 'search_header_breadcrumbs',
            'title'         => __('Display Breadcrumbs', 'waterfall'),
            'type'          => 'checkbox'
        ),
        array(
            'default'       => 'default',
            'description'   => __('Width of header in search archives.', 'waterfall'),
            'id'            => 'search_header_width',
            'choices'       => wf_get_container_options(),
            'title'         => __('Search Page Header Width', 'waterfall'),
            'type'          => 'select'
        ),
        array(
            'default'       => 'default',
            'description'   => __('Height of header in search archives.', 'waterfall'),
            'id'            => 'search_header_height',
            'choices'       => wf_get_height_options(),
            'title'         => __('Search Page Header Height', 'waterfall'),
            'type'          => 'select'
        ),    
        array(
            'default'       => 'left',
            'id'            => 'search_header_align',
            'title'         => __('Search Page Header Text Align', 'waterfall'),
            'description'   => __('How should text be aligned within the search page header?', 'waterfall'),
            'type'          => 'select',
            'choices'       => wf_get_align_options()
        ),    
        array(
            'default'       => 'full',
            'description'   => __('Choose the sidebar lay-out for the search page.', 'waterfall'),
            'id'            => 'search_sidebar_position',
            'choices'       => wf_get_sidebar_options(),
            'title'         => __('Sidebar Lay-Out', 'waterfall'),
            'type'          => 'select'
        ), 
        array(
            'default'       => 'default',
            'description'   => __('Width of the grid for search results.', 'waterfall'),
            'id'            => 'search_content_width',
            'choices'       => wf_get_container_options(),
            'title'         => __('Search Page Width', 'waterfall'),
            'type'          => 'select'
        ),    
        array(
            'default'       => 'grid',
            'description'   => __('Style of posts in the search page.', 'waterfall'),
            'id'            => 'search_content_style',
            'choices'       => wf_get_grid_options(),
            'title'         => __('Search Page Results Style', 'waterfall'),
            'type'          => 'select'
        ),
        array(
            'default'       => 'third',
            'description'   => __('Amount of grid columns for search page posts.', 'waterfall'),
            'id'            => 'search_content_columns',
            'choices'       => wf_get_column_options(),
            'title'         => __('Search Page Columns', 'waterfall'),
            'type'          => 'select'
        ),    
        array(
            'default'       => 'excerpt',
            'description'   => __('Excerpt within search page results.', 'waterfall'),
            'id'            => 'search_content_content',
            'choices'       => array(
                'excerpt'   => __('Excerpt', 'waterfall'),
                'none'      => __('No excerpt', 'waterfall'),
            ),
            'title'         => __('Search Page Results Excerpt', 'waterfall'),
            'type'          => 'select'
        ),
        array(
            'default'       => '',
            'description'   => __('Shows the post type under the title of each result.', 'waterfall'),
            'id'            => 'search_content_type',
            'title'         => __('Search Post Type in Results', 'waterfall'),
            'type'          => 'checkbox'
        ),
        array(
            'default'       => __('View Post', 'waterfall'),
            'description'   => __('The label for this button. Leave empty to remove the button.', 'waterfall'),
            'id'            => 'search_content_button',
            'title'         => __('Search Page Results Button Label', 'waterfall'),
            'type'          => 'input'
        ),     
        array(
            'default'       => '',
            'description'   => __('Minimum height of results in the search page.', 'waterfall'),
            'id'            => 'search_content_height',
            'title'         => __('Search Page Results Height', 'waterfall'),
            'type'          => 'number'
        ),    
        array(
            'default'       => 'thumbnail',
            'description'   => __('Featured Image size within search page results.', 'waterfall'),
            'id'            => 'search_content_image',
            'choices'       => wf_get_image_sizes(),
            'title'         => __('Search Page Results Image Size', 'waterfall'),
            'type'          => 'select'
        ),    
        array(
            'default'       => 'left',
            'description'   => __('Float of featured image within the results.', 'waterfall'),
            'id'            => 'search_content_image_float',
            'choices'       => wf_get_float_options(),
            'title'         => __('Search Page Featured Image Float', 'waterfall'),
            'type'          => 'select'
        ),
        array(
            'default'       => '',
            'id'            => 'search_content_image_enlarge',
            'title'         => __('Enlarge Featured Image on Hover', 'waterfall'),
            'type'          => 'checkbox'
        )                  
    )              
);

// 404 Page
$layout['sections']['404_page'] = array(
    'id'            => '404_page',
    'title'         => __('404 Page', 'waterfall'),
    'fields'    => array(       
        array(
            'default'       => 'half',
            'id'            => '404_header_height',
            'title'         => __('404 Header Minimum Height', 'waterfall'),
            'type'          => 'select',
            'choices'       => wf_get_height_options()
        ),
        array(
            'default'       => 'default',
            'description'   => __('Width of the 404 Header', 'waterfall'),
            'id'            => '404_header_width',
            'choices'       => wf_get_container_options(),
            'title'         => __('404 Header Width', 'waterfall'),
            'type'          => 'select'
        ),      
        array(
            'default'       => 'left',
            'id'            => '404_header_align',
            'title'         => __('Header Text Align', 'waterfall'),
            'description'   => __('How should text be aligned within the 404 header?', 'waterfall'),
            'type'          => 'select',
            'choices'       => wf_get_align_options()
        ),
        array(
            'default'       => __('Woops! Nothing found here...', 'waterfall'),
            'id'            => '404_header_title',
            'title'         => __('Default 404 Title', 'waterfall'),
            'selector'      => array('selector' => '.nothing-title', 'html' => true),
            'transport'     => 'postMessage',             
            'type'          => 'input'
        ),
        array(
            'default'       => __('Try visiting another page or searching.', 'waterfall'),
            'id'            => '404_header_description',
            'title'         => __('Default 404 Description', 'waterfall'),
            'selector'      => array('selector' => '.nothing-description', 'html' => true),
            'transport'     => 'postMessage',            
            'type'          => 'textarea'
        ),     
        array(
            'default'       => '',
            'id'            => '404_header_breadcrumbs',
            'title'         => __('Display Breadcrumbs', 'waterfall'),
            'type'          => 'checkbox'
        ),
        array(
            'default'       => '',
            'id'            => '404_header_search',
            'title'         => __('Display Searchform', 'waterfall'),
            'type'          => 'checkbox'
        ),    
    )              
);
    
// Footer   
$layout['sections']['styling_footer'] = array(
    'id'            => 'styling_footer',
    'title'         => __('Footer', 'waterfall'),
    'fields'    => array(
        array(
            'default'       => '',
            'id'            => 'footer_disable',
            'title'         => __('Disable Footer', 'waterfall'),
            'type'          => 'checkbox'
        ),                
        array(
            'default'       => 'default',
            'id'            => 'footer_width',
            'title'         => __('Footer Width', 'waterfall'),
            'type'          => 'select',
            'choices'       => wf_get_container_options(),
        ),
        array(
            'default'       => '',
            'id'            => 'footer_display_sidebars',
            'title'         => __('Display Sidebars', 'waterfall'),
            'type'          => 'checkbox'
        ),    
        array(
            'default'       => 'third',
            'description'   => __('Amount of sidebars in the footer.', 'waterfall'),
            'id'            => 'footer_sidebars',
            'choices'       => array(
                'full'      => __('One sidebar', 'waterfall'),
                'half'      => __('Two sidebars', 'waterfall'),
                'third'     => __('Three sidebars', 'waterfall'),
                'fourth'    => __('Four sidebars', 'waterfall'),
                'fifth'     => __('Five sidebars', 'waterfall')
            ),
            'title'         => __('Footer Sidebars', 'waterfall'),
            'type'          => 'select'
        ), 
        array(
            'default'       => '',
            'id'            => 'footer_display_socket',
            'title'         => __('Display Socket', 'waterfall'),
            'type'          => 'checkbox'
        ),    
        array(
            'default'       => '',
            'id'            => 'footer_copyright',
            'title'         => __('Display Copyright', 'waterfall'),
            'type'          => 'checkbox'
        ),
        array(
            'selector'      => array('selector' => '.atom-copyright span > span', 'html' => true ),
            'default'       => get_bloginfo('name'),
            'id'            => 'footer_copyright_name',
            'title'         => __('Copyright Message', 'waterfall'),
            'type'          => 'textarea',
            'transport'     => 'postMessage'
        ),
        array(
            'default'       => '',
            'id'            => 'footer_menu',
            'title'         => __('Display Footer Menu', 'waterfall'),
            'type'          => 'checkbox'
        ),
        array(
            'default'       => '',
            'id'            => 'footer_social',
            'title'         => __('Display Social Icons', 'waterfall'),
            'type'          => 'checkbox'
        ),
        array(
            'default'       => '',
            'id'            => 'footer_social_background',
            'title'         => __('Remove Background in Social Icons', 'waterfall'),
            'type'          => 'checkbox'
        )                  
    )              
);