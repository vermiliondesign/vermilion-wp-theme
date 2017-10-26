# Boilerplate Requirements:

* NodeJs
* Composer

# Boilerplate Features:

1. Enables WP minor auto-updates by keeping WordPress out of version control by installing via Composer
2. Installs TacoWordPress and AddMany via Composer

# Getting Started

1. Run `composer install`.  This installs WordPress, Taco theme, and any other theme dependencies as specified in the `composer.json` and `/html/wp-content/themes/taco-theme/app/core/composer.json` files

3. Add your salts and table prefix to the `wp-config.php`

4. Add a `db.php` file at the root of the repo, with the below database constants:

```
<?php
define(CLIENT_DB_HOSTNAME, '');
define(CLIENT_DB_NAME, '');
define(CLIENT_DB_USER, '');
define(CLIENT_DB_PASSWORD, '');
```

5. Visit the host to setup the WordPress database. Before installing, remove the `/wordpress/` in the url path before installing.

5. Update `.gitlab-ci.yml` with staging and production paths

6. Check the .htaccess and when setting up password protection on staging environments. A password should be required automatically on Staging 3.

7. Recommended plugins to install

* WP Yoast SEO
* iThemes Security
* Regenerate Thumbnails
* Broken Link Checker
* WP Super Cache

# Git Workflow

All development work should be done on a branch called `develop`.

Only production ready code should live on the `master` branch.

In general, run `git rebase master` to pull changes back into the `develop` branch and `git merge` to merge changes from `develop` back to `master`.

Gitlab is set to automatically deploy the `develop` branch, and is set to manually deploy the `master` branch.


# Ignored files

This theme ignores WordPress core files. It also ignores the `db.php` so make sure this gets manually migrated when the site moves environments.

# Frontend tasks

Run `npm start` in the root Taco theme directory (`/html/wp-content/themes/taco-theme`) or `shortcut-to-taco-theme` to start development on your local machine. The front end cache is busted automatically by webpack whenever changes are made.

Run `npm run build-prod` to run a production build locally.

Note: You'll see some deprecation warnings when running Webpack. These are currently expected and should be fixed when the Webpack Extract Text Plugin developers update their plugin.

# Changelog

### v1.1.2
* Bumping required tacowordpress/util version

### v1.1.1
* Updating extract text plugin and addmany versions

### v1.1
* Upgrading to Webpack 3

### v1.0.1
* Some cleanup of default JS and CSS

### v1.0
* First version to be used with PHP 7