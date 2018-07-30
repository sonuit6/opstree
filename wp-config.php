<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'rozgar_wp1');

/** MySQL database username */
define('DB_USER', 'rozgar_wp1');

/** MySQL database password */
define('DB_PASSWORD', 'B~(9BmS1ryI&eTq2I5@23@(6');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'JPM5CY9ERnsHDusB5pHWhFVOcN3NyKfg9z56EkW1MLUwrCwSyM7j5VgfyfXhpo0i');
define('SECURE_AUTH_KEY',  '7axYl0H737m3Hi3YML8ByO1q57cZb8cNxzbGu78QGnpy8e4UettN8JogKWoZ7wKR');
define('LOGGED_IN_KEY',    'g9ta4I7Om9Lu3O93TwEtGod7yLsU9pqaHZlcATVcn0ehr46fyqRWRvaeRxhEmsSk');
define('NONCE_KEY',        'lE7bm4f1SsCIdXU4fSB5waMcYadiSgE79mEVre4dfR3iYiR4xfGCCjGjp88YMw0Z');
define('AUTH_SALT',        'DplbEUHGxTh3qEpmeUvyrSJlWgZciPJYOovyo3PdFpZk72lgsnaZiKVgIkYU9gqL');
define('SECURE_AUTH_SALT', 'YV9HHg2s0qepGMHeMqZ3PJHB2PxKWXkfiZOGRWB5QinhgjXzvvK4ICnAa4YBNuma');
define('LOGGED_IN_SALT',   'lbmzbK6JQHRzBsxVjl9qCLBaqxU1bqxPnCMThY7LOvnRkjAl8giK1V5tQ44MBEk9');
define('NONCE_SALT',       'EhsDlCa7Nqpuc6NtxoMGMLChdebto6Wqw1NR1XnZ3RHfgP0Io88N6zcJZdPOi7IL');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
