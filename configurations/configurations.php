<?php
/**
 * Contains the basic configurations for the theme
 */

            $thing = array(
                'icon'      => 'share',
                'id'        => 'social',
                'title'     => __('Social Networks', 'waterfall'),
                'fields'    => array(                   
                    array (
                        'description'   => __('Add your social networks here', 'waterfall'),
                        'id'            => 'social_networks',
                        'title'         => __('Social Networks', 'waterfall'),
                        'type'          => 'repeatable',
                        'fields'        => array(
                            array(
                                'columns'       => 'half',
                                'id'            => 'network',
                                'title'         => __('Type of Social Network', 'waterfall'),
                                'placeholder'   => __('Select a network', 'waterfall'),
                                'type'          => 'select',    
                                'options'       => array(
                                    'email'         => __('Email', 'waterfall'), 
                                    'facebook'      => __('Facebook', 'waterfall'), 
                                    'instagram'     => __('Instagram', 'waterfall'), 
                                    'twitter'       => __('Twitter', 'waterfall'), 
                                    'linkedin'      => __('LinkedIn', 'waterfall'), 
                                    'google-plus'   => __('Google Plus', 'waterfall'), 
                                    'pinterest'     => __('Pinterest', 'waterfall'), 
                                    'reddit'        => __('Reddit', 'waterfall'),   
                                    'whatsapp'      => __('Whatsapp', 'waterfall')   
                                )
                            ),
                            array(
                                'columns'       => 'half',
                                'id'            => 'url',
                                'title'         => __('Url, E-mail Address or Telephone Number', 'waterfall'),
                                'type'          => 'input',    
                                'subtype'       => 'url' 
                            )    
                        )
                    ),     
                )              
            );        
