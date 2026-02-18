<?php
$ui = require get_template_directory() . '/inc/ui-config.php';
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title text-2xl font-bold mb-4">
            <?php
            $start_comment_count = get_comments_number();
            if ( '1' === $start_comment_count ) {
                printf(
                    esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'start' ),
                    '<span class="font-normal">' . wp_kses_post( get_the_title() ) . '</span>'
                );
            } else {
                printf(
                    esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $start_comment_count, 'comments title', 'start' ) ),
                    number_format_i18n( $start_comment_count ),
                    '<span class="font-normal">' . wp_kses_post( get_the_title() ) . '</span>'
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list space-y-4">
            <?php
            wp_list_comments([
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
            ]);
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments text-gray-500 mt-4"><?php esc_html_e( 'Comments are closed.', 'start' ); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    $comment_form_args = [
        'class_form'    => 'space-y-4',
        'comment_field' => sprintf(
            '<p class="comment-form-comment"><textarea id="comment" name="comment" rows="5" required class="%s"></textarea></p>',
            $ui['textarea']
        ),
        'fields'        => [
            'author' => sprintf(
                '<p class="comment-form-author"><input id="author" name="author" type="text" placeholder="Name*" required class="%s"></p>',
                $ui['input']
            ),
            'email'  => sprintf(
                '<p class="comment-form-email"><input id="email" name="email" type="email" placeholder="Email*" required class="%s"></p>',
                $ui['input']
            ),
            'url'    => sprintf(
                '<p class="comment-form-url"><input id="url" name="url" type="url" placeholder="Website" class="%s"></p>',
                $ui['input']
            ),
        ],
        'class_submit'  => $ui['button_primary'],
        'title_reply'   => '<span class="text-xl font-bold">Leave a Comment</span>',
    ];

    comment_form( $comment_form_args );
    ?>

</div>
