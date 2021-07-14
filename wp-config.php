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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'speedon_sat' );

/** MySQL database username */
define( 'DB_USER', 'speedon_sat' );

/** MySQL database password */
define( 'DB_PASSWORD', 's@t#sPx0nl1n3&' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ' d{ctI5:x7Pm%.$uC[0bcbi!%]4VK{T@J5=r;wPeXq&RV6~X:]O8&ohu`w:!||{ ' );
define( 'SECURE_AUTH_KEY',  'SO A] 0TgYrXJ}u(Sff^~I1*a8FL;;[eoy3wkg(t-G3A~-@4(b&Fwxx8>#B~=Q$@' );
define( 'LOGGED_IN_KEY',    ':+/JI+/,g{:-k@|f0SeKFd)l2NK#*Sg+-G|g$1G@0m-t[0[whlD+7Oq(]*g6)4bB' );
define( 'NONCE_KEY',        'kF6dCb9jZC3!@1Q0V_+BP:k/R4(V&<9C[pWKIj8i}VIeEdgf}9QN)^ax+7S@fC]r' );
define( 'AUTH_SALT',        '2j:@o%FF+JAc5N4/k920qI+Ip?C6zB8YNX9EU8S.W8z[w}IXMJK:`Vzj$1GB@I<T' );
define( 'SECURE_AUTH_SALT', 'U0U?,rf;GdqQ!F[CYyB&M7^A=Y[#S&_7PmxGlOkeiX[BQ5_*`}+C>3q5yn]#s3(i' );
define( 'LOGGED_IN_SALT',   '[[*)`J((k%]/n9~HLDreO&gvMV;zRY0D?ANLM0s=xamC *X})IAC;hE3VWt+XN,r' );
define( 'NONCE_SALT',       'F8pc8T{26qq0#ygDGv(0*Rs$>B>PbeLzy3~#e%ALzt,&:>Lc#:`02X})+D:F$TLo' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
