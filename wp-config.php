<?php
  define('FS_METHOD', 'direct');
  /* That's all, stop editing! Happy publishing. */
/**
 *  define('FS_METHOD', 'direct');
 
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 * * This file contains the following configurations:
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
// define( 'DB_NAME', 'wordpress' );


define( 'DB_NAME', 'wordpress' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define('DB_HOST', 'localhost');
//define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );
/** Database username */
// define( 'DB_USER', 'wpuser' );

/** Database password */
// define( 'DB_PASSWORD', 'password123' );

/** Database hostname */
// define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */

/** The database collate type. Don't change this if in doubt. */
// define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         ';^f~chGr:g!dk2if,#IHf2xI<`*#is):ghDddQ6uy Q|nfI>qxQ:siqNNH)tTf>B' );
define( 'SECURE_AUTH_KEY',  ',Agza1zS }YCD+%icWr+9Y7RYs&Gx[((rPQ%be/o__JM^)v5t),63cr[$m94&FTo' );
define( 'LOGGED_IN_KEY',    '78HH _!L#=92MoY*I7]1=<V/y:h)0qEvm:~kDjZMH%=eTQlMe_<)l6o7u:@)-1%g' );
define( 'NONCE_KEY',        ' Ie$fP?Y2}UgN,*yyS rW{nHm4u-ro8d&!!>>$@eA]n0Q(v<NunIqEie`Oa lqTb' );
define( 'AUTH_SALT',        '+g$B>}(y$:wc}(]`5Tz.Q%YBWkKjK`^rS1(Ae/@rZTwB0{K,2a{|zUT_G95(2Wh}' );
define( 'SECURE_AUTH_SALT', 'WmgN*KW*<a;=5aFr_ +,>AWq<st-NbGX8i%#moDq{$nR8A|lU/y8[0BJoA{@z>3E' );
define( 'LOGGED_IN_SALT',   'g4ERRV>O>H?=/km.U-X5ms. h;w5.obW?RTibWu=f,s.5>1/tL8RbK9y^RJ|V^4v' );
define( 'NONCE_SALT',       '+5:{}:!<vQ?/3}k=gg:[]$Z5Vdg),/qG4/bn?IQ$|]1O)]K:o#tzD!sr9gfQ@X`b' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
define('WP_HOME', 'http://localhost/wordpress');
define('WP_SITEURL', 'http://localhost/wordpress');
/* Add any custom values between this line and the "stop editing" line. */



define( 'SURECART_ENCRYPTION_KEY', '78HH _!L#=92MoY*I7]1=<V/y:h)0qEvm:~kDjZMH%=eTQlMe_<)l6o7u:@)-1%g' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
