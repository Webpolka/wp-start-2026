<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package wp_start_2026
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'typography' ); ?>>

	<!-- Page Header -->
	<header class="entry-header mb-6">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</header>

	<!-- Page Thumbnail -->
	<?php wp_start_2026_post_thumbnail(); ?>

	<!-- Page Content -->
	<div class="entry-content max-w-none">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links mt-4 text-sm">' . esc_html__( 'Pages:', 'wp_start_2026' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<!-- Edit Link -->
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer mt-6 text-sm border-t pt-4">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
							/* translators: %s: Name of current page */
						__( 'Edit <span class="sr-only">%s</span>', 'wp_start_2026' ),
						array( 'span' => array( 'class' => array() ) )
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link hover:underline">',
				'</span>'
			);
			?>
		</footer>
	<?php endif; ?>

</article>