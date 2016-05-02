
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php ascent_light_post_media( $post->ID, 'ascent-light-thumbnail-span-8' ); ?>
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
    </div>
</article><!-- end post-teaser -->