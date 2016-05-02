<?php
/**
 * The template for displaying Comments.
 */
?>

<div id="comments">
    <?php if ( post_password_required() ) : ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'ascent-light' ); ?></p>
</div><!-- #comments -->
<?php
    /* Stop the rest of comments.php from being processed,
    * but don't kill the script entirely -- we still have
    * to fully load the template.
    */
    return;
endif;
?>

<?php if ( have_comments() ) : ?>
    <h2 id="comments-title">
        <?php
            printf( _n( 'Comments (%1$s)', '%1$s Comments So Far', get_comments_number(), 'ascent-light' ),
            number_format_i18n( get_comments_number() ) );
        ?>
    </h2>


<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
    <div class="navigation">
        <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav"></span> Older Comments', 'ascent-light' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav"></span>', 'ascent-light' ) ); ?></div>
    </div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

<ol class="commentlist">
    <?php
        /* Loop through and list the comments. Tell wp_list_comments()
        * to use ascent_light_comment() to format the comments.
        * If you want to overload this in a child theme then you can
        * define ascent_light_comment() and that will be used instead.
        * See ascent_light_comment() in themeora/functions.php for more.
        */
        wp_list_comments();
    ?>
</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
    <div class="navigation">
        <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav"></span> Older Comments', 'ascent-light' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav"></span>', 'ascent-light' ) ); ?></div>
    </div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:
    /* If there are no comments and comments are closed,
    * let's leave a little note, shall we?
    */
    if ( comments_open() ) :
        print '<p>' . __('There are no comments yet.', 'ascent-light') . '</p>';
    endif;
    
    if ( ! comments_open() ) :
?>
    <p class="nocomments"><?php _e( 'Comments are closed.', 'ascent-light' ); ?></p>
    <?php endif; // end ! comments_open() ?>
<?php endif; // end have_comments() ?>

<?php
$comment_args = array(
        'fields' => apply_filters(
            'comment_form_default_fields', array(
                'author' => '<p class="comment-form-author">' .
                    '<label for="author" class="assistive-text">' . __( 'Your Name', 'ascent-light' ) . 
                    ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="author" placeholder="'. __('Your name', 'ascent-light') .'" class="required input-text" name="author" type="text" value="' .
                    esc_attr( $commenter['comment_author'] ) . '" size="30" />' .
                    '</p><!-- #form-section-author .form-section -->',
                'email'  => '<p class="comment-form-email">' .
                    '<label for="email" class="assistive-text">' . __( 'Your Email', 'ascent-light' ) .
                    ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="email" placeholder="'. __('Your email address', 'ascent-light') .'" class="required input-text" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                    '" size="30" />' .
                    '</p><!-- #form-section-email .form-section -->',
                'url'    => ''
            )
        ),
        'comment_field' => '<p class="comment-form-comment">' .
            '<label for="comment" class="assistive-text">' . __( 'Your comment:', 'ascent-light' ) . '*</label>' .
            '<textarea placeholder="'. __('Enter your comment', 'ascent-light') .'" id="comment" name="comment" cols="45" rows="8" class="required input-text"></textarea>' .
            '</p><!-- #form-section-comment .form-section -->',
    'comment_notes_after' => '',
    'title_reply' => __('Leave a Comment', 'ascent-light')
    );
comment_form( $comment_args);
?>

</div><!-- #comments -->
