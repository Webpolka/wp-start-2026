<?php
/**
 * The template for displaying the footer
 *
 * @package wp_start_2026
 */

?>
<footer id="colophon" class="bg-blue-600 text-white py-7">
    <div class="container">
        <div class="flex items-center justify-between">
            <div>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></div>
            <div>
                <?php
                printf(
                    /* translators: 1: Theme name, 2: Theme author. */
                    esc_html__('Theme %1$s by %2$s', 'wp_start_2026'),
                    'wp_start_2026',
                    '<a href="https://github.com/Webpolka" class="hover:text-white">Wtemu</a>'
                );
                ?>
            </div>
        </div>
    </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>