<?php

if ( ! function_exists( 'ascent_light_hero_area' ) ) :
/**
 * Prints the hero area for pages and posts
 * @since themeora 1.0
 */
function ascent_light_hero_area(){ ?>
    <?php
     $banner_image = get_theme_mod( 'ascent-light-homepage-banner-image', '');
     $banner_image_width = get_theme_mod( 'ascent-light-homepage-banner-image-width', '');
     ?>
    <header class="full-width-container hero-area accent-background <?php if (is_front_page() && $banner_image != '' ) print 'no-bottom-padding' ?> <?php has_excerpt() ? print 'header-with-excerpt ' : print 'header-without-excerpt'; ?>" role="banner">
        <?php
        // Call the function that loads the logo / menu area
        ascent_light_branding_area();
        ?>
        
        
        <?php if ( is_home() && is_front_page() ) : ?>
        <?php else : ?>
        
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 hero-area-content">
                        <?php if ( is_404() ) : ?>
                            <h1 class="title"><?php _e('Sorry! We cant find that page!', 'ascent-light'); ?></h1>
                        <?php elseif ( is_author() ) : ?>
                            <?php the_post(); ?>
                            <h1 class="archive-title"><?php printf( __( 'All posts by %s', 'ascent-light' ), get_the_author() ); ?></h1>
                            <?php rewind_posts(); ?>
                        <?php elseif (is_search() ) : ?>
                            <h1 class="title">
                                <?php _e('Search Results for', 'ascent-light'); ?> 
                                '<?php the_search_query() ?>'
                            </h1>
                        <?php elseif ( is_archive() ) : ?>
                            <h1 class="archive-title"><?php echo single_cat_title( '', false ) ; ?></h1>
                            <?php if ( category_description() ) : // Show an optional category description ?>
                                <div class="category-description"><?php echo category_description(); ?></div>
                            <?php endif; ?>
                        <?php elseif ( is_home() ) : ?>
                            <h1><?php single_post_title(); ?></h1>
                        <?php elseif ( is_front_page() ) : ?>
                            <h1 class="title"><?php the_title(); ?></h1>    
                        <?php else : ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <h1 class="title"><?php the_title(); ?></h1>
                                <?php if ( has_excerpt() ) : ?> 
                                    <div class="hero-area-intro">
                                        <?php the_excerpt(); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div><!-- end col-md-8 -->
                </div><!-- end row -->
            </div><!-- end container -->
        <?php endif; ?>
        
        <?php if ( is_front_page() && $banner_image != '' ) : ?>
            <img class="homepage-banner-image" src="<?php echo esc_url($banner_image) ?>" style="<?php esc_attr($banner_image_width) != '' ? print 'max-width:' . esc_attr($banner_image_width) . 'px' : '' ; ?>" alt="" />
        <?php endif; ?>
     </header><!-- end header - full width container -->
<?php
}
endif;


if ( ! function_exists( 'ascent_light_downloads_loop' ) ) :
/**
 * Prints grid of EDD items
 * @since themeora 1.0
 * @param int col - how many columns to use
 * @param int items - number of items to show
 */
    
function ascent_light_downloads_loop( $cols = null, $items = null ){
    if ( post_type_exists('download') ) : ?>

        <?php
        global $wp_query;
        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) { 
            $paged = get_query_var('page');
        } else { 
            $paged = 1;
        }
        
        $cols = isset( $cols ) ? $cols : 3;
        $postsToShow = isset( $items ) ? $items : 9;
        
        // Query to show the downloads
        $args = array(
            'post_type' => 'download',
            'post_status' => 'publish',
            'posts_per_page' => $postsToShow,
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => $paged,
        );

        $wp_query = new WP_Query( $args );
        
        // Set variabled to show the grid with the image size that fits best
        if ( $cols == 2 ) {
            $gridClass = 'col-md-6';
            $divReset = '2';
            $imgSize = 'ascent-light-thumbnail-span-4';
        }
        else {
            $gridClass = 'col-sm-4';
            $divReset = '3';
            $imgSize = 'ascent-light-thumbnail-span-4';
        }
        ?>

        <div class="row portfolio-row">
            <?php if ( $wp_query->have_posts() ) : ?>
                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                    <div class="<?php echo $gridClass; ?> col-xs-12">
                        <?php if ( has_post_thumbnail( $wp_query->post->ID )) : ?>
                            <?php 
                            // Get the width of the image so we know how wide to set the container
                            $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $wp_query->post->ID ), $imgSize ); 
                            $image_width = $image_data[1];
                            if ( !empty( $image_width ) ) {
                                $widthCss = 'max-width:' . $image_width . 'px';
                            }
                            ?>
                            <div class="portfolio-item" style="<?php echo $widthCss; ?>">
                                <a href="<?php the_permalink(); ?>" class="portfolio-link" title="<?php the_title() ?>">
                                    <?php echo get_the_post_thumbnail( $wp_query->post->ID, $imgSize ); ?>
                                    <div class="portfolio-details">
                                        <div class="details-text">
                                            <h2><?php the_title(); ?></h2>
                                            <?php 
                                            if( function_exists('edd_price') ) {
                                                edd_price($wp_query->post->ID);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                            </div><!-- portfolio-item -->
                        <?php endif; ?>
                    </div>

                <?php endwhile; ?>

            <?php else : ?>
                <p><?php _e('No posts found' , 'ascent-light') ?></p>
            <?php endif; //query-have-posts ?>
        </div><!-- portfolio row -->
        
        <?php ascent_light_pagination(); ?>
        
    <?php endif; // post_type_exists('download')
}
endif;

if ( ! function_exists( 'ascent_light_pagination' ) ) :
/**
 * Prints post pagination
 * @since themeora 1.0
 */
function ascent_light_pagination(){
    the_posts_pagination( array(
        'prev_text'          => sprintf('<i class="fa fa-chevron-left"></i> <span class="sr-only">%s</span>', __('Previous page', 'ascent-light')),
        'next_text'          => sprintf(' <span class="sr-only">%s</span> <i class="fa fa-chevron-right"></i>', __('Next page', 'ascent-light')),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'ascent-light' ) . ' </span>',
    ) );
}
endif;

if ( ! function_exists( 'ascent_light_branding_area' ) ) :
/**
 * Prints HTML width layout of the banding area
 * @since themeora 1.0
 */
function ascent_light_branding_area() { ?>
    <div class="branding">
        <div class="container">
            <div class="navbar-header">
                <?php if ( get_theme_mod( 'ascent-light-img-upload-logo' ) ) { ?>
                    <a href="<?php echo home_url( '/' ); ?>">
                        <img class="logo-uploaded" style="max-width:<?php echo esc_attr( get_theme_mod( 'ascent-light-img-upload-logo-width', '200' ) ); ?>px" src="<?php echo esc_url( get_theme_mod( 'ascent-light-img-upload-logo' ) );?>" alt="<?php esc_attr( bloginfo( 'title' ) ); ?>" />
                    </a>
                <?php } else { ?>
                    <h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" rel="home"><?php esc_attr( bloginfo( 'title' ) ); ?></a></h1>
                <?php } ?>
                <?php if ( get_theme_mod( 'ascent-light-show-description-header' ) == 'Yes' ) : ?>
                    <h2 class="site-description"><?php esc_attr( bloginfo( 'description' ) ); ?></h2>
                <?php endif; ?>
            </div><!-- end navbar-header -->
            
            <a href="#" class="sb-toggle-right themeora-nav-toggle"><div class="sr-only"><?php _e('Toggle navigation', 'ascent-light') ?></div> <i class="fa fa-bars"></i> </a>
        </div><!-- container -->  
    </div>
    <!-- END NAV -->
<?php }
endif;

if ( ! function_exists( 'ascent_light_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 * @since themeora 1.0
 * @param boolean shorten. Weather to shorten by removing category information. Default false.
 */
function ascent_light_entry_meta($shorten = false) {
    global $post;
    if ( is_sticky() && is_home() && ! is_paged() )
        echo '<span class="featured-post">' . __( 'Sticky', 'ascent-light' ) . '</span>';

    if ( 'post' == get_post_type() ) {
    echo '<div class="meta">';
        //echo __('Posted on', 'ascent-light') . ' ';
        _e('By ', 'ascent-light') . ' ' ;
        $username = get_userdata( $post->post_author );
        echo '<a href="' . get_author_posts_url( $post->post_author ) . '">' . ucfirst($username->user_nicename) . '</a>';
        echo ' on ';
        echo get_the_time('jS') . ' ' . get_the_time('F');
        /*
        if ( ! $shorten ) {
            echo '. ' . __('Posted in', 'ascent-light') . ' '; 
            the_category(', ');
            echo '.';
        }
        */
        ?>
    <?php echo '</div>';
    }
}
endif;

if ( ! function_exists( 'ascent_light_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 * @since themeora 1.0
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function ascent_light_entry_date( $echo = true ) {
    if ( has_post_format( array( 'chat', 'status' ) ) )
        $format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'ascent-light' );
    else
        $format_prefix = '%2$s';

    $date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
        esc_url( get_permalink() ),
        esc_attr( sprintf( __( 'Permalink to %s', 'ascent-light' ), the_title_attribute( 'echo=0' ) ) ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
    );

    if ( $echo )
        echo $date;

    return $date;
}
endif;


if ( ! function_exists( 'ascent_light_post_nav' ) ) :
/**
* Displays navigation to next/previous post when applicable. For single posts only.
* @since themeora 1.0
*/
function ascent_light_post_nav() {
    global $post;
    if( get_theme_mod( 'post_pagination' ) == true ) {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
        $next     = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous )
            return;
        ?>
        <nav class="navigation post-navigation">
            <div class="nav-links">
                <?php if ( $previous ) : ?>
                    <div class="nav-links-prev">
                        <?php previous_post_link( '%link', _x( '<i class="fa fa-chevron-left"></i> <span class="sr-only">Last Post</span>', 'Previous post link', 'ascent-light' ) ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( $next ) : ?>
                    <div class="nav-links-next">
                        <?php next_post_link( '%link', _x( '<span class="sr-only">Next Post</span> <i class="fa fa-chevron-right"></i>', 'Next post link', 'ascent-light' ) ); ?>
                    </div>
                <?php endif; ?>
            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
	<?php
    }
}
endif;

if ( ! function_exists( 'ascent_light_paging' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 * @since themeora 1.0
 */
function ascent_light_paging() {
    global $wp_query;

    // Don't print empty markup if there's only one page.
    if ( $wp_query->max_num_pages < 2 )
            return;
    ?>
    <div class="article_nav mobile-stack">
        <nav class="navigation paging-navigation">
            <h2 class="sr-only"><?php _e( 'Posts navigation', 'ascent-light' ); ?></h2>
            <div class="nav-links post-navigation">               
                <?php if ( get_previous_posts_link() ) : ?>
                    <div class="nav-links-prev"><?php previous_posts_link( __( '<i class="fa fa-chevron-left"></i> Previous', 'ascent-light' ) ); ?></div>
                <?php endif; ?>


                <?php if ( get_next_posts_link() ) : ?>
                    <div class="nav-links-next"><?php next_posts_link( __( 'Next <i class="fa fa-chevron-right"></i> ', 'ascent-light' ) ); ?></div>
                <?php endif; ?>
            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
    </div>
<?php
}
endif;


if ( ! function_exists( 'ascent_light_post_tags' ) ) :
/**
* Displays post tags
* @since themeora 1.0
*/
function ascent_light_post_tags() {
    global $post;
    if( get_theme_mod( 'show_tags' ) == true && has_tag() && is_singular() ) {
        echo '<div class="post-tags">';
        echo the_tags( '<h3>' . __('Tagged As', 'ascent-light') . '</h3>', '', '' );
        echo '</div>';
    }
}
endif;


if ( ! function_exists( 'ascent_light_post_author_meta' ) ) :
/**
 * Displays author information under posts
*  @since themeora 1.0
*/
function ascent_light_post_author_meta() {
    if( get_theme_mod( 'show_author_bio' ) == true ) {
        if ( 'post' == get_post_type() && get_the_author_meta('first_name') != '' && get_the_author_meta('last_name') != '') { ?>
            <div class="post-author">
                <?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
                <h2 class="author-bio-title"><?php _e('Author', 'ascent-light') ?>: <a href="<?php echo home_url(); ?>/?author=<?php the_author_meta('ID'); ?>" title="<?php _e('Posts by ', 'ascent-light'); the_author_meta('first_name'); print ' '; the_author_meta('last_name'); ?>">
                <?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></a></h2>
                <p><?php the_author_meta('description'); ?></p>
                <a class="btn" href="<?php echo home_url(); ?>/?author=<?php the_author_meta('ID'); ?>">
                <?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?>
                <?php _e('has', 'ascent-light'); ?>
                <?php the_author_posts(); ?> 
                <?php
                count_user_posts( get_the_author_meta('ID') ) == 1 ? _e('article', 'ascent-light') : _e('articles', 'ascent-light');
                ?></a>
            </div>
        <?php
        }
    }
}
endif;


if ( ! function_exists( 'ascent_light_post_media' ) ) :
/**
 * Displays the correct media above a post
 * @since themeora 1.0
 * @param int post. The id of the post.
 * @param string size. The size for featured images
 */
function ascent_light_post_media( $postId, $size = null ){
    //check for a featured image
    if ( has_post_thumbnail( $postId ) ) : ?>
        <div class="featured-image">
            <?php if ( is_single() || is_page() ) : ?>
                <?php echo get_the_post_thumbnail( $postId, $size ); ?>
            <?php else : ?>
                <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $postId, $size ); ?></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php
}
endif;

if ( ! function_exists( 'ascent_light_video_audio' ) ) :
/**
 * Displays audio or video embed in featured image area
 * @since themeora 1.0
 * @param int post. The id of the post.
 */
function ascent_light_video_audio( $postId ) {
    
    $embed_url = get_post_meta($postId, '_ascent_light_video_audio', true);
    
    //if it is a video, show the video in the featured image location if the video meta is being used
    if ( get_post_format($postId) == "video" ) : ?>
        <?php if ( $embed_url != '') : ?>
            <div class="featured-media">
                <div class="<?php get_post_format($postId) == "video" ? print "embed-container" : '' ?>">
                <?php
                    //run the oEmbed process from Wordpres
                    if ( isset( $GLOBALS['wp_embed'] ))
                        $media = $GLOBALS['wp_embed']->autoembed($embed_url);
                        echo do_shortcode( $media );
                ?>
                </div>
            </div>
        <?php 
        //if a featured image is set on the video post then show this instead
        elseif ( has_post_thumbnail( $postId ) ) : ?>    
            <div class="featured-image">
                <?php if ( is_single() ) : ?>
                    <?php echo get_the_post_thumbnail( $postId, 'ascent-light-thumbnail-span-8' ); ?>
                <?php else : ?>
                    <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $postId, 'ascent-light-thumbnail-span-8' ); ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif;

    //if it is an audio post, show the embed from the custom field and also a featured image if set
    if ( get_post_format($postId) == "audio" ) : ?>
        <?php if ( has_post_thumbnail( $postId ) ) : ?>
            <div class="featured-image audio-featured-image">
                <?php if ( is_single() ) : ?>
                    <?php echo get_the_post_thumbnail( $postId, 'ascent-light-thumbnail-span-8' ); ?>
                <?php else : ?>
                    <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $postId, 'ascent-light-thumbnail-span-8' ); ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="featured-media">
            <?php
                //run the oEmbed process from Wordpres
                if ( isset( $GLOBALS['wp_embed'] ))
                    $media = $GLOBALS['wp_embed']->autoembed($embed_url);
                    echo do_shortcode( $media );
            ?>
        </div>
    <?php endif;
}
endif;

if ( ! function_exists( 'ascent_light_quote_meta' ) ) :
/**
 * Displays quote post meta
 * @since themeora 1.0
 * @param int post. The id of the post.
 */
function ascent_light_quote_meta( $postId ) {
    
    $quote = get_post_meta($postId, '_ascent_light_quote', true);
    $quote_author = get_post_meta($postId, '_ascent_light_quote_source', true);
    
    if ( $quote != '' ) : ?>
        
        <div class="quote-content">
            <a href="<?php the_permalink(); ?>">
                <blockquote>
                    <?php echo $quote ?>
                    <?php if ( $quote_author != '' ) : ?>
                        <small><?php echo $quote_author ?></small>
                    <?php endif; ?>
                </blockquote>
            </a>
        </div>
    
    <?php endif;
}
endif;


if ( !function_exists( 'ascent_light_gallery' ) ) {
 /**
 * Displays attatchments as Bootstrap carousel
 * @since themeora 1.0
 * @param int post. The id of the post.
 * @param string imgsize. The image cut.
 * @param string layout. The layout options
 * @param string orderby. How to order the posts
 * @param bool single. Is the page a single page or not
 */
function ascent_light_gallery($postid, $imagesize = '', $orderby = ''  ) {
    $thumb_ID = get_post_thumbnail_id( $postid );
    $image_ids_raw = get_post_meta($postid, '_ascent_light_image_ids', true);

    if( $image_ids_raw != '' ) {
        $image_ids = explode(',', $image_ids_raw);
        $post_parent = null;
    } else {
        $image_ids = '';
        $post_parent = $postid;
    }

    // PULL THE IMAGE ATTACHMENTS
    $args = array(
        'exclude' => $thumb_ID,
        'include' => $image_ids,
        'numberposts' => -1,
        'orderby' => $orderby,
        'order' => 'ASC',
        'post_type' => 'attachment',
        'post_parent' => $post_parent,
        'post_mime_type' => 'image',
        'post_status' => null,
        );
    $attachments = get_posts($args);

    //TRANSFER RANDO META FOR TRUE/FALSE SLIDE RANDOMIZE
    if ( $orderby == 'rand') {
        $orderby_slides = 'true';
    } else {
        $orderby_slides = 'false';
    }
    ?>

    <div id="carousel-<?php echo $postid ?>" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php
            if( !empty($attachments) )
            {
                $i = 1;
                foreach( $attachments as $attachment )
                {
                    $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                    //$caption = $attachment->post_excerpt;
                    //$caption = ($caption) ? "<div class='ascent-light-slide-caption'>$caption</div>" : '';
                    $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                    if ( $i == 1 ) {
                        echo "<div class='item active'>";
                    }
                    else {
                        echo "<div class='item'>";
                    }
                        echo "<img height='$src[2]' src='$src[0]' alt='$alt'/>";
                    echo "</div>";
                    $i ++;
                }
            } // END if( !empty($attachments) )
            ?>
        </div><!-- END .carousel-inner -->
        
        <a class="left carousel-control" href="#carousel-<?php echo $postid ?>" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-<?php echo $postid ?>" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div><!-- END .carousel -->

     <?php
         
    } // END function ascent_light_gallery
} // END if ( !function_exists( 'ascent_light_gallery' ) )

if ( ! function_exists( 'ascent_light_excerpt_more' ) ) :
/**
 * Add our own read more link to the except
 */

function ascent_light_excerpt_more() {
    return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">'. __('...read more', 'ascent-light') . '</a>';
}
endif;

add_filter( 'excerpt_more', 'ascent_light_excerpt_more' );


if ( ! function_exists( 'ascent_light_get_link_url' ) ) :
/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 * @since Themeora 1.0
 * @return string The Link format URL.
 */
function ascent_light_get_link_url() {
    $content = get_the_content();
    $has_url = get_url_in_content( $content );

    return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
endif;


if ( ! function_exists( 'ascent_light_portfolio_prev_next' ) ) :
/**
 * Show next / prev links on portfolio
 *
 * Falls back to the post permalink if no URL is found in the post.
 * @since Themeora 1.0
 * @param int post - the post id
 */
function ascent_light_portfolio_prev_next(){
    $pagelist = get_pages('sort_column=menu_order&sort_order=asc&meta_key=_wp_page_template&meta_value=template-portfolio-item.php');
    $pages = array();
    foreach ( $pagelist as $page ) {
       $pages[] += $page->ID;
    }
    $current = array_search(get_the_ID(), $pages);
    $prevID = isset( $pages[$current-1] ) ? $pages[$current-1] : '' ;
    $nextID = isset( $pages[$current+1] ) ? $pages[$current+1] : '' ;
    ?>

    <div class="portfolio-next-prev-navigation">
        <?php if ( !empty($prevID) ) { ?>
            <a class="btn" href="<?php echo get_permalink($prevID); ?>" title="<?php echo get_the_title($prevID); ?>"><?php _e('Previous', 'ascent-light') ?></a>
        <?php }
        if ( !empty($nextID) ) { ?>
            <a class="btn" href="<?php echo get_permalink($nextID); ?>" title="<?php echo get_the_title($nextID); ?>"><?php _e('Next', 'ascent-light') ?></a>
        <?php } ?>
    </div><!-- .portfolio-next-prev-navigation -->
<?php }
endif;


if ( ! function_exists( 'ascent_light_related_downloads' ) ) :
/**
 * Show related downloads
 *
 * @since Themeora 1.0
 * @param int post - the post id
 */
    
function ascent_light_related_downloads( $post = null ){
    global $post;
    // Setup paging for portfolio pagaination
    if ( get_query_var('paged') ) {
        $paged = get_query_var('paged');
    } elseif ( get_query_var('page') ) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }

    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $related_title = __('You may also like', 'ascent-light');

    //list the links to each category
    if ( have_posts() ) : 
    $terms = get_the_terms($post->ID, 'download_category' );

    if ($terms && ! is_wp_error($terms)) :
        $term_slugs_arr = array();
        foreach ($terms as $term) {
            $term_link = get_term_link( $term );
            $term_slugs_arr[] = '<a href="'. $term_link . '">'. $term->name .'</a>,';
        }
        $terms_slug_str = join( " ", $term_slugs_arr);
    endif;
    if ( isset( $terms_slug_str ) ) {
        //echo '<div class="terms-wrapper"><i class="fa fa-chevron-right"></i>' . rtrim( $terms_slug_str, ',' ) . '</div>';
    }
    endif;
    // Load related posts
    if ( post_type_exists('download') && isset( $term->slug ) ) : ?>
        <div class="related-work full-width-container">
            <div class="container">
                <div class="row portfolio-row">
                    <?php
                    $args = array(
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'download_category',
                                'terms' => $term->slug,
                                'field' => 'slug',
                                'operator' => 'IN'
                            )
                        ),
                        'post_type' => 'download',
                        'post_status' => 'publish',
                        'posts_per_page' => 3,
                        'orderby' => 'menu_order',
                        'order' => 'DESC',
                        'paged' => $paged,
                        'post__not_in' => array($post->ID) //exclude current post
                    );

                    $wp_query = new WP_Query( $args );
                    //set the grid based on theme options
                    $gridClass = 'col-md-4 col-sm-4';
                    $imgSize = 'ascent-light-thumbnail-span-4';
                    ?>

                    <?php if ( $wp_query->have_posts() ) : ?>
                        <h3 class="col-md-12 text-center no-top-margin"><?php echo $related_title; ?></h3>
                        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                            <div class="<?php echo $gridClass; ?> col-xs-12 mobile-stack">
                                <?php if ( has_post_thumbnail( $wp_query->post->ID )) : ?>
                                    <div class="portfolio-item">
                                        <a href="<?php the_permalink(); ?>" class="portfolio-link" title="">
                                            <?php echo get_the_post_thumbnail( $wp_query->post->ID, $imgSize ); ?>
                                            <div class="portfolio-details">
                                                <div class="details-text">
                                                    <h2><?php the_title(); ?></h2>
                                                    <?php edd_price($wp_query->post->ID); ?>
                                                </div><!-- details text -->
                                            </div><!-- portfolio details -->
                                        </a>
                                    </div><!-- portfolio-item -->
                                <?php endif; ?>
                            </div><!-- gridClass -->
                        <?php endwhile; ?>
                    <?php 
                        endif; 
                        wp_reset_query();
                    ?>
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end related-work -->
    <?php endif;
} // end function
endif;