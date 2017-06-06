<?php get_header(); ?>
<article class="not-found">
    <header class="entry-header">               
        <?= wa_content_container_open(); ?>
            <h1 class="entry-title" itemprop="headline"><?php _e('404', 'wa'); ?></h1>
        <?= wa_content_container_close(); ?>                     
    </header>
    <div class="entry-content" itemprop="text">
        <?= wa_content_container_open(); ?>
            <p><?php _e('The page you want to reach does not exist. Perhaps try searching?', 'wa'); ?></p>
        <?= wa_content_container_close(); ?>    
    </div>
    <footer class="entry-footer">
        <?= wa_content_container_open(); ?>
            <?php get_search_form(); ?>
        <?= wa_content_container_close(); ?>
    </footer>   
</article>  
<?php get_footer(); ?>