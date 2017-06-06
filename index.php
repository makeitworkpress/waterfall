<?php get_header(); ?>
    <header class="entry-header">
        <?= wa_container_open(); ?>
            <h1 class="entry-title" itemprop="name"><?php wa_archive_title(); ?></h1>    
        <?= wa_container_close(); ?> 
    </header>
    <?php get_template_part('content'); ?> 
    <footer class="entry-footer">
        <?= wa_container_open(); ?>
            <?= wa_pagination(); ?>
        <?= wa_container_close(); ?>   
    </footer>
<?php get_footer(); ?>