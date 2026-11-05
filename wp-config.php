<?php
define( 'WP_CACHE', true );

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u425598304_Koe3K' );

/** Database username */
define( 'DB_USER', 'u425598304_XS72t' );

/** Database password */
define( 'DB_PASSWORD', 'fVQJfXC1Ui' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '_h/+c]}T2@])o!qD@xyd=wUszj59p7$sMh:G}Q{mkX,_XGs.*;sMq_W6qoY|8%f,' );
define( 'SECURE_AUTH_KEY',   '5iEF{pK:Q)-`_64D5ssm[b#JHE.F(ZYp=#WlE{;)*^^Z&Kef~j#JD`tUf::%IH2W' );
define( 'LOGGED_IN_KEY',     'Y.T)+A}&f?$aPhet41)e+!`UitFYXY%YMvme>{t<B9-)MtAnsrd_?t3jfQ@yTMw9' );
define( 'NONCE_KEY',         'tmbt9V|+~N 7Da#&@;zm^SAKetBdV`` e&pJ`.pSA LM,kx$_->Kw]/*(!Mbg<O(' );
define( 'AUTH_SALT',         'n]5({+5}t#^y8 f&Xj*NBMM&]qLiGQ12IiPoKJKq>i6fu}3vkM7jzt9=~OTP_9Q1' );
define( 'SECURE_AUTH_SALT',  '~!<-0.<dmmW=j?yvqnvO@&r2#k?&P/8PAm)P~{2]4tfTy?*pHRf9zY@h`Y9aw#&F' );
define( 'LOGGED_IN_SALT',    'Xc4AA0WV8|SqzwO/w?*Ik?zmdg(V##v!h_US){h/C`l){+:4CmphB[FM!8>(59Q2' );
define( 'NONCE_SALT',        'P-%KR3y_jREr*!3K:TAZ W Lj{9]ubr0/ANMJ |X)lq:A^UJD$8b^1<sjI3*$P@-' );
define( 'WP_CACHE_KEY_SALT', 'awIv>%a>F*l:^1<F#..{Ibs}AZF{Yt*?-} |ztIykFUi5V65up3|!<6b!`I~=g_)' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '41537a8e0932b41fc6f80be56530b24c' );
define( 'WP_AUTO_UPDATE_CORE', false );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
