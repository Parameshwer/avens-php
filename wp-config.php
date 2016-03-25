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
define('DB_NAME', 'avens-php');

/** MySQL database username */
define('DB_USER', 'parameshwer');

/** MySQL database password */
define('DB_PASSWORD', '123456');

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
define('AUTH_KEY',         'p!*wrw 8c*#[ U(I!v,P_g+5s-H#/2w{VC!PrWqRi=R5LlBc[L}1p#cFKXK276wi');
define('SECURE_AUTH_KEY',  ')-x#zgk??9fVo|&qR3uN#+idrgUQDQ_~,dsq9F:+T1R/)F]-A6Y{xeWA1p>e?:,t');
define('LOGGED_IN_KEY',    'J;V{xh@[&O$gk(Wtnw-(,Og]:HIGCRQ>rvP(x`ST}.rA+QBp,e{EJw*#nE-p=7SY');
define('NONCE_KEY',        'IDa4ZAhoeLUHOy}CjJ!r|sQi|-}kw7U&3e3<rD;(OODD+sE.{ccrW*|bGx)nQi[0');
define('AUTH_SALT',        'o#||ns(K^`16,i2/#/f`tve?Ybg?:`w|M~T@nuC%+yNct&-qBI?S@H-);k+tg}<Q');
define('SECURE_AUTH_SALT', 'PW$S]|+aYQAl<+x/gsJvxx$/2xa4-JBa/6sJ(s-%{Vk@Sj.}6Z1}Tft74p1Ze&I4');
define('LOGGED_IN_SALT',   '8G896Mfu:5;7uN`;+aE[Fj~67MZ0fplc3rX@&W+kT+:>2H-$6xaB@esu*F-4@dY|');
define('NONCE_SALT',       'zA]R$6s/pNiq9bV3lnJ+kO`O q<sFtGH:I]3%/zr6AM@G)N`zb}%POlY)8f~{T_+');

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
?>