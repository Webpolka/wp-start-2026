<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class('min-h-screen flex flex-col bg-white text-gray-900 dark:bg-black dark:text-white'); ?>>

    <!-- Header -->
    <header class="bg-blue-600 text-white">
        <div class="container">

            <div class="flex justify-between items-center h-16 relative">

                <!-- Logo -->
                <div class="flex flex-col gap-1">
                    <h1 class="text-2xl md:text-3xl font-bold">
                        <a href="<?php echo home_url(); ?>" class="hover:opacity-80"><?php bloginfo('name'); ?></a>
                    </h1>
                    <p class="text-sm md:text-base opacity-80"><?php bloginfo('description'); ?></p>
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
                <button id="burgerBtn" aria-label="Open menu" aria-expanded="false"
                    class="md:hidden flex flex-col justify-center items-center gap-1 p-2 text-white">
                    <span class="block w-6 h-[2px] bg-current"></span>
                    <span class="block w-6 h-[2px] bg-current"></span>
                    <span class="block w-6 h-[2px] bg-current"></span>
                </button>

            </div>
        </div>
        </div>
    </header>


    <!-- Mobile Off-Canvas Menu -->
    <div id="mobileMenu"
        class="fixed inset-0 z-[100] bg-white dark:bg-black text-black dark:text-white transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col md:hidden">

        <!-- Top Bar -->
        <div class="flex items-center justify-between flex-none px-6 pt-14 pb-10">
            <span class="font-bold text-xl">Menu</span>
            <div class="flex items-center gap-2">
                <?php wp_start_dark_mode_toggle(); ?>
                <button id="closeMenu" aria-label="Close menu" class="text-2xl leading-none">✕</button>
            </div>
        </div>

        <!-- Menu Content -->
        <div class="flex-1 overflow-y-auto px-6 pb-6">
            <?php wp_start_mobile_menu('primary'); ?>
        </div>

    </div>



    <!-- Main Content -->
    <main class="flex-1 p-4 bg-gray-100 dark:bg-gray-900">
        <div class="container">