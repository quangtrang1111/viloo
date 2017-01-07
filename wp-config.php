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
define('DB_NAME', 'viloo');

/** MySQL database username */
define('DB_USER', 'viloo');

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
define('AUTH_KEY',         'X$&:Hjo/=4R7joR)8se&..eTtPEpUECGNC{kG3~35&UH`XvGbRm{$bLF%z<3v`)*');
define('SECURE_AUTH_KEY',  'ddsddl.Du.b=ZL$Z0v42YDHpca8aZ~*8h^.9Sok;~`q[h M6j0h[tLD_;6p0.O+r');
define('LOGGED_IN_KEY',    '_:MUGKU@yQIo#t>u9%RH1_P#FUzf,Xq9o+HJCRWkKs}^+L~e*>vI;B&fZ!|-+7:a');
define('NONCE_KEY',        'FXmFY$AkuL[@X*!H]|*|@CwLnd&@:AF0P;H12sEM]RPs8Yb17?B`_J]8l5gaB/.F');
define('AUTH_SALT',        'yHyC|Wbz+BiU+d><m-;ft2]-sWow{,{G{eB&q&4Y^(:3+w&ib:!q O>}y||@)+F%');
define('SECURE_AUTH_SALT', 'Tg85SU9PFhn5O363<tL?tZ4GYnAUl7zHK]t)T_+2%jt+<]+I{|u4+(2Cm/M}_?{9');
define('LOGGED_IN_SALT',   'B6>^,1-tl`_w;!r_:v-%2^Ag?i71B.o*+5%c#g^aq|zW?v~C_+thG-E&YkfcCh5?');
define('NONCE_SALT',       '+uiv$.6A,,p|U39WrXkV!:k(R[KUWG?il4qDB9d*FgJ2a@,mvjB$fCW-T=`tc0:v');

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
