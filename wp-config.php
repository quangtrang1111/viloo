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
define('DB_NAME', 'u734673011_viloo');

/** MySQL database username */
define('DB_USER', 'u734673011_viloo');

/** MySQL database password */
define('DB_PASSWORD', 'Admin1!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'J{_T.cfaU-l+&l H2Y&`ZcMW[<lo!$_D]]TdKS9~S5k|8%a#~ZU[z9fQ!tN#4[ |');
define('SECURE_AUTH_KEY',  'H@e|.:v+RO+%m^NSkOHU#+n%2L-Z-z>EgAs^Hhk~|zf=6$pRs[ayXy +4ArlfM6k');
define('LOGGED_IN_KEY',    '|@o|>i%w2+EQk}JKuEspt5G(l.4Rwh,*[bd,7j1KA-1z]Ngxk:Z)z>+B#SU#cajl');
define('NONCE_KEY',        'xC+Ps~oMpo*KCor@|L#pJ&HrbfKjet9mCbzW@&+Dgxg22?6:f]=p~LpVL7*;G64k');
define('AUTH_SALT',        'T;UHXjZ.2P|`@x+*-P@ x||Mi3/]*&-l}fMk3tS0U-]#)^-;f6ppK`qZ:eCF.e^E');
define('SECURE_AUTH_SALT', 'jB F`fHtk-Cc-Veg3K2r-h_AG|x=5b6a7TnRdD+<~N4;^s:wM,<hRbdx_}Tbzd;R');
define('LOGGED_IN_SALT',   '9BF#9~%&Is(S)b~!E(RHdRRCY9%a(Iy/QqmG9$m8{;1]Sj]%h^i#5+%4Fe|$=!Ug');
define('NONCE_SALT',       '&v qp @PNef>9EJOSlF4wPpX|3Ru=jL|aY{#?Y0g++c3oeR/Lb05k+_L1f9M}Mm=');

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
