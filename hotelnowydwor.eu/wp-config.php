<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'nowydwor_hotelnowydworeunew' );

/** Database username */
define( 'DB_USER', 'nowydwor_wenuerowdywonletoh' );

/** Database password */
define( 'DB_PASSWORD', '9WHRGZ);{7}f(^(n' );

/** Database hostname */
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
define( 'AUTH_KEY',         'g94ihnWr*2:ij*OfOw!P3qo)wLZj<([:pxW`][MHEV`jB?d3bNeh>x(KrK|]uzdu' );
define( 'SECURE_AUTH_KEY',  'i6{eg]?4HVX*1gtqoM(BJ$Vk=|XV9RT46!f.sv7Vw6[:,jc](S|HZwU$#q1Zp M2' );
define( 'LOGGED_IN_KEY',    'xWCKh/Ih,i;hOmh}ogsw>qgDlO=8-gqU4|:Gn:w/`T*i!Ad,UkirySU_0yTa]oTb' );
define( 'NONCE_KEY',        'TCGR@sq]>D3fPZ4diMeg+_(78Q(<Ssz*#pr58!2<:x3By]IQ<a/eD#QVCQ{/$SQ^' );
define( 'AUTH_SALT',        '`pzx|uu2YjfI#,<[E/,g]u,_ADOWCV{gb,nX4`K4x(4i-uPYxQ~7;Q%^xp|mLW| ' );
define( 'SECURE_AUTH_SALT', '[bGHVKOqMeg-E<L;aXU0=tW/w-A?XMYxwt[1b3a~x|~]g;n#GW@QauJuq{9$jPxO' );
define( 'LOGGED_IN_SALT',   'L].|X:;IG*^a>EP!x{c*6wk*6`|FK3UYWdAo/e=_ NaN az$;-9},Snp.fi]j/Xx' );
define( 'NONCE_SALT',       'GBqYeG:f-d+&pX>,/!O6:g&0oMJDSuO%,|,/>n5O(t5)Do)|hs99Xk(EW.,Gvll|' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_hotelnowydworeu';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
