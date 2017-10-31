<?php

// Cache busting
// This automatically pulls from main.scss
define('THEME_VERSION', file_get_contents(__DIR__.'/../_/dist/webpack_hash'));
define('THEME_SUFFIX', sprintf('?v=%s', THEME_VERSION));
// define('USER_SUPER_ADMIN', 'vermilion_admin'); // vermilion_admin

// main content and breadcrumb defined classes
define('STYLES_COLUMNS_MAIN_CONTENT_FULL', 'columns small-12 medium-11 large-10 columns-centered');
define('STYLES_COLUMNS_MAIN_CONTENT_FULL_WIDE', 'columns small-12 medium-11 columns-centered');
define('STYLES_COLUMNS_MAIN_CONTENT_FULL_NARROW', 'columns small-12 medium-11 large-8 columns-centered');
define('STYLES_COLUMNS_MAIN_CONTENT_SIDEBAR_ARTICLE', 'columns small-12 medium-8');
define('STYLES_COLUMNS_MAIN_CONTENT_SIDEBAR_BREADCRUMB', 'columns small-12 medium-4 large-3');

// page ids