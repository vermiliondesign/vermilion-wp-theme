<?php

// Cache busting
// This automatically pulls from main.scss
define('THEME_VERSION', file_get_contents(__DIR__.'/../_/dist/webpack_hash'));
define('THEME_SUFFIX', sprintf('?v=%s', THEME_VERSION));
// define('USER_SUPER_ADMIN', 'vermilion_admin'); // vermilion_admin

// any custom site vars