            </div><!-- .main -->
            <footer id="footer" class="footer" itemscope="itemscope" itemtype="http://www.schema.org/WPFooter" role="contentinfo">
                <div class="footer-widgets">
                    <?php if( is_active_sidebar( 'footer-sidebar-1' ) || is_active_sidebar( 'footer-sidebar-2' ) || is_active_sidebar( 'footer-sidebar-3' ) ) { ?>
                        <?= wa_container_open(); ?>
                            <div class="grid-row">
                                <?php if( is_active_sidebar( 'footer-sidebar-3' ) ) { 
                                    echo '<div class="grid-col-6 grid-item">';
                                        dynamic_sidebar('footer-sidebar-1'); 
                                    echo '</div>';
                                }
                                if( is_active_sidebar( 'footer-sidebar-3' ) ) {
                                    echo '<div class="grid-col-3 grid-item">';
                                        dynamic_sidebar('footer-sidebar-2'); 
                                    echo '</div>';
                                }
                                if( is_active_sidebar( 'footer-sidebar-3' ) ) { 
                                    echo '<div class="grid-col-3 grid-item">';
                                        dynamic_sidebar('footer-sidebar-3');
                                    echo '</div>';
                                } ?> 
                            </div>    
                        <?= wa_container_close(); ?> 
                    <?php } ?> 
                </div>
                <div class="socket">
                    <?= wa_container_open(); ?>
                        <div class="copyright left">
                            &copy; <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> 
                            <span itemprop="copyrightHolder">
                                <?php bloginfo('name'); ?>
                            </span>
                            <span class="sitebuilder">
                                <i class="fa fa-cubes"></i><a href="http://www.creativesolvers.nl">CreativeSolvers</a> & Kraater</a>
                            </span>    
                        </div>
                        <?php if ( has_nav_menu('socket') ) { ?>
                            <nav class="socket-menu right" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                                <?php 
                                    wp_nav_menu(array(
                                      'theme_location' => 'socket',
                                      'container' => false,
                                    ));
                                 ?>     
                            </nav>  
                        <?php } ?>
                    <?= wa_container_close(); ?>                      
                </div><!-- .socket -->   
            </footer>
		</div><!-- .site -->
		<?php wp_footer(); ?>
    </body>
</html>