<?php
/**
 * UI Config — базовый набор классов Tailwind для элементов интерфейса
 */

return [
    // ---------------------------------------------------
    // Кнопки
    // ---------------------------------------------------
    'button_primary' => 'bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors',
    'button_secondary' => 'bg-gray-200 text-gray-800 font-semibold px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors',
    'button_danger' => 'bg-red-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-red-700 transition-colors',

    // ---------------------------------------------------
    // Инпуты и TextArea
    // ---------------------------------------------------
    'input' => 'w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none',
    'textarea' => 'w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none',
    'label' => 'block mb-2 font-medium text-gray-700 dark:text-gray-300',

    // ---------------------------------------------------
    // Ссылки
    // ---------------------------------------------------
    'link' => 'text-blue-600 hover:underline',
    'link_secondary' => 'text-gray-600 hover:text-gray-800 transition-colors',
];
