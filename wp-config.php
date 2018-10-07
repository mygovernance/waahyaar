<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


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
define('DB_NAME', 'db_of_wahwahyar_786');

/** MySQL database username */
define('DB_USER', 'dataname_786');

/** MySQL database password */
define('DB_PASSWORD', 'm0AcT7lgtLKZ1a@#@##%^$$$8JVy');

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
define('AUTH_KEY',         '&LLyvZDnh>*+V{i.,[~y(iLCj1s*Y$U>uVX%L=Cxg-pjai(<TbO2JIlH#23Nb01J');
define('SECURE_AUTH_KEY',  '5$*UwsN},l#C6}=n>F@I<)K2+T=-sj[S=@V9{:9imQP0#ASk0(|xb7<3*#,StL a');
define('LOGGED_IN_KEY',    '/NWm)F[TTca!mK}y`I4~+kx.DEMusVESU{MCX;CHaH+SLWNW2$%prCG:*4q)ANic');
define('NONCE_KEY',        'pf87_]<h.Muy5,;pG|8-%5K:pCLOv`_&,zsFD)/lF ~[J|wW,46XIpf@vy*pN(i-');
define('AUTH_SALT',        'Nb=1/=jwtc7r8Y5,m?jHhYBq-Wko2`V%e$FrDjhzaqt#g#Hk:6q{({*5C[pw!Jhc');
define('SECURE_AUTH_SALT', 'zK$Q^V~o*`(LEKW@ HcR9$Mm*,3N#C-4*Q(f%_)y^M38KT[#i<7WIE<t9)c!~NW]');
define('LOGGED_IN_SALT',   '7wwpDKW8?n9F_|H}T%{yfL9C7fL*#)pMS57I?[hH2&[ ja54gEyJxC]X2l`GwXlI');
define('NONCE_SALT',       '6XJ.K0J2R5c?7-@@Iw+?=k5S)$~V]0Eu%ez2o*q9;M-cErs3:^NF t>O.oTR^nnn');

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

define( 'WP_HOME', 'http://wahwahyar.com' );
define( 'WP_SITEURL', 'http://wahwahyar.com' );

define( 'RELOCATE', true );


define( 'WP_DEBUG', true );