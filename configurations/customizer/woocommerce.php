<?php
/**
 * Adds extra panels to the woocommerce panels
 */
defined( 'ABSPATH' ) or die( 'Go eat veggies!' );

$woocommerce = [
    'description'   => __('Adjust extensive settings and elements for various parts of the website here.', 'waterfall'),
    'id'            => 'woocommerce',
    'title'         => __('Woocommerce', 'waterfall'),
    'panel'         => true,
    'sections'      => [
        'header' => [
            'id'        => 'woocommerce_menu',
            'title'     => __('Navigation Menu', 'waterfall'),
            'fields'    => [
                [
                    'default'       => '',
                    'id'            => 'header_cart',
                    'title'         => __('Add a Shopping Cart to the Menu', 'waterfall'),
                    'type'          => 'checkbox'                    
                ]
            ]
        ],
        'woocommerce_product_catalog' => [
            'id'        => 'woocommerce_product_catalog',
            'title'     => __('Product Catalog', 'waterfall'),
            'fields'    => [    
                array(
                    'default'       => '',
                    'id'            => 'product_archive_header_disable',
                    'title'         => __('Disable Product Archive Title Section', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => '',
                    'id'            => 'product_archive_header_breadcrumbs',
                    'title'         => __('Display Breadcrumbs in Product Archive', 'waterfall'),
                    'type'          => 'checkbox'
                ),       
                array(
                    'default'       => 'default',
                    'description'   => __('Width of title section in product archives.', 'waterfall'),
                    'id'            => 'product_archive_header_width',
                    'choices'       => wf_get_container_options(),
                    'title'         => __('Product Archive Header Width', 'waterfall'),
                    'type'          => 'select'
                ),
                array(
                    'default'       => 'default',
                    'description'   => __('Height of title section in product archives.', 'waterfall'),
                    'id'            => 'product_archive_header_height',
                    'choices'       => wf_get_height_options(),
                    'title'         => __('Product Archive Title Section Height', 'waterfall'),
                    'type'          => 'select'
                ),
                array(
                    'default'       => 'left',
                    'id'            => 'product_archive_header_align',
                    'title'         => __('Product Archive Title Section Text Align', 'waterfall'),
                    'description'   => __('Alignment of the text in the title section of product archives.', 'waterfall'),
                    'type'          => 'select',
                    'choices'       => wf_get_align_options()
                ),
                array(
                    'default'       => 'left',
                    'description'   => __('Choose the sidebar lay-out for the product archives.', 'waterfall'),
                    'id'            => 'product_archive_sidebar_position',
                    'choices'       => wf_get_sidebar_options(),
                    'title'         => __('Sidebar Lay-Out', 'waterfall'),
                    'type'          => 'select'
                ), 
                array(
                    'default'       => 'default',
                    'description'   => __('Width of the grid with the products and sidebar.', 'waterfall'),
                    'id'            => 'product_archive_content_width',
                    'choices'       => wf_get_container_options(),
                    'title'         => __('Product Archive Width', 'waterfall'),
                    'type'          => 'select'
                )        
            ]                     
        ],
        [
            'id'            => 'woocommerce_product_images',
            'title'         => __('Product Images', 'waterfall'),
            'fields'        => [ 
                array(
                    'default'       => '',
                    'id'            => 'product_content_zoom',
                    'title'         => __('Enable product image zoom', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'default'       => '',
                    'id'            => 'product_content_slider',
                    'title'         => __('Enable product images slider', 'waterfall'),
                    'type'          => 'checkbox'
                ),
                array(
                    'description'   => __('Be aware that the lightbox will not apply when Product Zoom is enabled', 'waterfall'),
                    'default'       => '',
                    'id'            => 'product_content_lightbox',
                    'title'         => __('Enable product images lightbox', 'waterfall'),
                    'type'          => 'checkbox'
                )                   
            ]
        ],        
        [
            'id'            => 'woocommerce_product',
            'title'         => __('Single Products', 'waterfall'),
            'fields'        => [            
                array(
                    'default'       => 'full',
                    'description'   => __('Choose the sidebar lay-out for a single product.', 'waterfall'),
                    'id'            => 'product_sidebar_position',
                    'choices'       => wf_get_sidebar_options(),
                    'title'         => __('Sidebar Lay-Out', 'waterfall'),
                    'type'          => 'select'
                ), 
                array(
                    'default'       => 'default',
                    'description'   => __('Width of the product Display.', 'waterfall'),
                    'id'            => 'product_content_width',
                    'choices'       => wf_get_container_options(),
                    'title'         => __('Single Product Width', 'waterfall'),
                    'type'          => 'select'
                ),        
                array(
                    'default'       => '',
                    'id'            => 'product_content_breadcrumbs',
                    'title'         => __('Display Breadcrumbs in Single Products', 'waterfall'),
                    'type'          => 'checkbox'
                )         
            ]
        ]        
    ]
];