<?php
/**
 * Template part for displaying posts
 *
 * @package wp_start_2026
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?>>

	<!-- Post Header -->
	<header class="entry-header mb-4">
		<?php
		if ( is_singular() ) :
			the_title( '<h1>', '</h1>' );
		else :
			the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				wp_start_2026_posted_on();
				echo ' | ';
				wp_start_2026_posted_by();
				?>
			</div>
		<?php endif; ?>
	</header>

	<!-- Post Thumbnail -->
	<?php wp_start_2026_post_thumbnail(); ?>

	<!-- Post Content -->
	<div class="entry-content max-w-none">
		<?php
		the_content(
			sprintf(
				wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="sr-only"> "%s"</span>', 'wp_start_2026' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links mt-4 text-sm">' . esc_html__( 'Pages:', 'wp_start_2026' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<!-- Post Footer -->
	<footer class="entry-footer mt-6 text-sm border-t pt-4">
		<?php wp_start_2026_entry_footer(); ?>
	</footer>
</article>