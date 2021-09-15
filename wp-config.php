<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'custom-auto' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '+h.LDvup{]wMZ,7h b~v*T.Cz%Qg^WW20(w07WQ FJQmd~AyOLAZC~-]WmyjAXC9' );
define( 'SECURE_AUTH_KEY',  'u*zSE,3}MrCY!wIg}t5t@IT:Y|^)cFOk4E@u;pp_T`XPTP7I?NLYWhz^eTT,[/FT' );
define( 'LOGGED_IN_KEY',    '*CUHo6<CtG?l?I.nU}/qn8?CdpBF;y8Y=$0AO;T^yCVomV2@-V@87 o;EF!=O8g8' );
define( 'NONCE_KEY',        'Z:<GOl-^E2$?9fXU?2}[>SW0JNWAV#u9s ~tS^Y1/}`,WRMEcjUxpkHn[l1#8o6w' );
define( 'AUTH_SALT',        '1&i[j1g)2HB::d`p5wyF0dv^m:F/tUj$6MN5[vTGp>nvJ^p|XQ=a,t [g` (jI/ ' );
define( 'SECURE_AUTH_SALT', 'gpi_78rN7]gl6YqEU~T,WB}5;(0u=L{^tZ|I- cVRUGj0Pg| j:KpMye@:6m]Apy' );
define( 'LOGGED_IN_SALT',   'Ncg*V]TFm4^Edp:Q iIzsSippGc-TtL[L.)D5y+ba3l5!d0dU|iHj[/7xFhnh}2J' );
define( 'NONCE_SALT',       'G>0};#5xo^/T=-C;DqUmA4|riZI+ Ez{u=$VHSnW9X1fHJp#mS[4{#IzT7w1,3uG' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
