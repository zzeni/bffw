<?php
/*
 * Used for both audio, video and standard post types
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-teaser'); ?>>
    <?php ascent_light_post_media( $post->ID, 'ascent-light-thumbnail-span-8' ); ?>
    <div class="content">
        
        <?php if ( is_single() ) : ?>
        <?php else : ?>
            <h2 class="title"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php endif; ?>
        
        <?php if ( !is_single() ) : ?>
            <?php ascent_light_entry_meta(); ?>
        <?php endif; ?>
            
        
        <div class="content">
            <?php the_content( __( 'Read More', 'ascent-light' ) ); ?>
            <?php wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ascent-light' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'ascent-light' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ) ); ?>
        </div><!-- .post-text -->
        
    </div>
</article><!-- end post-teaser -->