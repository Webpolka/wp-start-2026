<?php
/**
 * The header for Starter theme
 *
 * Displays <head> section, body open, and primary navigation
 *
 * @package wp_start_2026
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>

</head>

<body <?php body_class('bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100'); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class='min-h-screen flex flex-col'>

        <!-- Skip link for accessibility -->
        <a class="skip-link sr-only focus:not-sr-only" href="#primary">
            <?php esc_html_e('Skip to content', 'wp_start_2026'); ?>
        </a>

        <!-- Header -->
        <header id="masthead" class="bg-blue-600 text-white">
            <div class="container">

                <div class="flex justify-between items-center h-16 relative">

                    <!-- Logo -->
                    <div class="flex flex-col gap-1">
                        <?php if (function_exists('the_custom_logo'))
                            the_custom_logo(); ?>
                        <h1 class="site-title text-2xl md:text-3xl font-bold">
                            <a href="<?php echo home_url(); ?>" class="hover:opacity-80">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                        <p class="site-description text-sm md:text-base opacity-80">
                            <?php bloginfo('description'); ?>
                        </p>

                    </div>


                    <!-- Desktop Menu -->
                    <nav id="mainMenu" class="hidden md:flex md:items-center md:space-x-6">
                        <?php wp_start_desktop_menu('primary'); ?>
                    </nav>

                    <!-- Dark mode toggle -->
                    <div class="hidden md:block">
                        <?php wp_start_dark_mode_toggle(); ?>
                    </div>

                    <!-- Burger Button (Mobile) -->
                    <button id="burgerBtn" aria-label="Open menu" aria-expanded="false" aria-controls="mobileMenu"
                        class="md:hidden p-2 text-white cursor-pointer">
                        <?php svg_icon('burger', 'w-6 h-6 fill-current'); ?>
                    </button>
                </div>
            </div>
        </header>


        <!-- Mobile Off-Canvas Menu -->
        <div id="mobileMenu"
            class="fixed inset-0 z-[100] bg-white dark:bg-black transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col md:hidden"
            role="navigation" aria-hidden="true">


            <!-- Top Bar -->
            <div class="flex items-center justify-between flex-none px-6 pt-14 pb-10">
                <span class="font-bold text-xl">Menu</span>
                <div class="flex items-center gap-2">
                    <?php wp_start_dark_mode_toggle(); ?>
                    <button id="closeMenu" aria-label="Close menu" class="text-2xl leading-none cursor-pointer">
                        <?php svg_icon('close', 'w-4 h-4 fill-current'); ?>
                    </button>
                </div>
            </div>

            <!-- Menu Content -->
            <div class="flex-1 overflow-y-auto px-6 pb-6">
                <?php wp_start_mobile_menu('primary'); ?>
            </div>
        </div>