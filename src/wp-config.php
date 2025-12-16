<?php

require_once "wp-config-db.php";

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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG_LOG', true );

/* Add any custom values between this line and the "stop editing" line. */

define( 'DISALLOW_FILE_EDIT', true );
define( 'WP_POST_REVISIONS', false );
define( 'EMPTY_TRASH_DAYS', 7 ); // 7 days
define( 'AUTOSAVE_INTERVAL', false );
define( 'WP_AUTO_UPDATE_CORE', false );

// Memory limits
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );

// Force HTTPS
define( 'FORCE_SSL_ADMIN', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
