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
define( 'DB_NAME', 'db_wordpress' );

/** Database username */
define( 'DB_USER', 'isr_wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'pass_wordpress' );

/** Database hostname */
define( 'DB_HOST', '172.18.0.2' );

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
define( 'AUTH_KEY',         '!+(]&$Lf&!q0dQYjv9P6!Go#fh=(?{Jtnz`Sa_ o5o|FI<Hnarz;^$-V[v#no3)l' );
define( 'SECURE_AUTH_KEY',  'h^0Q?XnIKXG;yW %Ceg[$lU{3~% )oOEo0jWuGt0;=0DEiM6r6Ux*F=e.tr]ojIC' );
define( 'LOGGED_IN_KEY',    'g4sS[/bs{#.Fze`l:|Dm52W uX2Rsx!U:H7#/H<I,3@Rue. <%L1wA@edCZfgLJ@' );
define( 'NONCE_KEY',        'a/6#Op3j!:DQcvO!cD/>yy[oyMD?~??>:t`DlK%L(1CYkJSD2TW>N~n*!]J:d+zP' );
define( 'AUTH_SALT',        '+gb1z7Dm4ghy`E8]^ L6nBcN79T)PQe)V+B V`l|-AM-cZh.68u{l%-?t&(SQu/!' );
define( 'SECURE_AUTH_SALT', 'W=}FTAkDlO&!Q83P<N`f=>R?9^nQX/}fix=yOBwg){AM|^G,qP_BUR<Q=,Z*)l5B' );
define( 'LOGGED_IN_SALT',   '~n+X`A31_oNH#~hL8-b #r<4v95)p/e#um.,e~I@d> .7/`,6Zko-I?jlVEbp_7j' );
define( 'NONCE_SALT',       ',E4nx9OAu A=PCngpU]<VBS^=:,}++~C=~FZ-T-|&&ksZAK~LFIar`@VA%eumTK}' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
