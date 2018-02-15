<?php
/**
 * Displays the date for a post
 */

// Atom values
$atom = MakeitWorkPress\WP_Components\Build::multiParseArgs( $atom, [
    'attributes' => [
        'datetime' => get_the_date('c'),
        'itemprop' => 'datePublished'   
    ],
    'date'      => get_the_date(),
    'icon'      => '',
] ); 

$attributes = MakeitWorkPress\WP_Components\Build::attributes($atom['attributes']); ?>

<time <?php echo $attributes; ?>>
    <?php if( $atom['icon'] ) { ?>
        <i class="fa fa-<?php echo $atom['icon'] ?>"></i>
    <?php } ?>
    <?php echo $atom['date'] ?>
</time>