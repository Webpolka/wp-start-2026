<?php
/**
 * The template for displaying all single posts
 *
 * @package wp_start_2026
 */

get_header();
?>
<!-- Main Content -->
<main id="primary" class="site-main flex-1 p-4">
    <div class="container">
        <?php
        while (have_posts()):
            the_post();

            // Use the Tailwind-styled content template.
            get_template_part('template-parts/content', get_post_type());

            // Post navigation.
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle text-sm">' . esc_html__('Previous:', 'wp_start_2026') . '</span> <span class="nav-title hover:underline">%title</span>',
                    'next_text' => '<span class="nav-subtitle text-sm">' . esc_html__('Next:', 'wp_start_2026') . '</span> <span class="nav-title hover:underline">%title</span>',
                    'class' => 'flex justify-between my-8',
                )
            );

            // Comments.
            if (comments_open() || get_comments_number()):
                echo '<div class="mt-8">';
                comments_template();
                echo '</div>';
            endif;

        endwhile; // End of the loop.
        ?>
    </div>
</main><!-- #primary -->

<?php
get_sidebar();
get_footer();