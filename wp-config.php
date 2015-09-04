<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'polestar_wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost:8889');

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
define('AUTH_KEY',         'L[GUPDV)%e**Mji;{Um$%2@`(FD fya)ml@.*Q*_I&C(|s`Ec~!4l;^2fu2_r=Mt');
define('SECURE_AUTH_KEY',  '0h9Jf-d1ngVT{Xb%43JPskGSR0R@-/`3N.oO4N#KGozn/hQpPbCaVp7Z!0^559(^');
define('LOGGED_IN_KEY',    'C}yO0|FR%cTn]7v<9C Mm1 iWQMYIc5_@Rzj3i:MKZG3Kx]|uYd5kB8U+NqJ|yOC');
define('NONCE_KEY',        'z1^SoO-EciNfp{;uNv:n-PX!5JU$9M:Li8Y1H--uG/S2LR+KWPwF-D]jJQKN<#C-');
define('AUTH_SALT',        'q4X~uW-u%*&>iITo8@mB0F=|V{+dsr14En<?Ei=1rBM*([4Mf.-d}8z4sVwb1j5l');
define('SECURE_AUTH_SALT', 'i8oBeC@PwS-H sn;O)W8:x7_LNsG]p--<-C1|F-B:*gj]_;}=E1MnY< R+xmC7t+');
define('LOGGED_IN_SALT',   'gB*q^,wUzK3$04g[;;SHs>[5^q-|w<iE)+;5 Idg~+1x;%44.&(O--4i=Q-%IV7J');
define('NONCE_SALT',       'I)2kxrFD<?oc/+m3krOtB_R8beuQc`l-n~cvUb4t$|LtjjZa`5#+{<F]N=iUV!xR');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
