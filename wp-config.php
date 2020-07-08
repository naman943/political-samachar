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
define('DB_NAME', 'Politics');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         ' XU^R8lxQzo.s|<ck9QcbUb@1<wkFw+SNscZd![J4({2 ic0/^+oK&@+o&<b|Y{:');
define('SECURE_AUTH_KEY',  'yg]&Fvq2p#lZQZ_>IZhW3h2N+^lI+(gS*ML4WkR2T[y<O!K*i]45j#[8)`S#aVgq');
define('LOGGED_IN_KEY',    'OGyK6gPK$%_6z~/N[V@N+HyAWuq$S+h=hD<Zk{=FvyPD0[7G;afWPGWN>|Uik{T0');
define('NONCE_KEY',        'svoHr`Xfz!#E9]trL8r__q&KpSH#.`1)0`8Wcz-{kDH9Kf._(o6oInA9WK8LDbn4');
define('AUTH_SALT',        '2hj[W#ko;)TD+=X&x?]ZGTNmpn(^d%RJ3Ed`[t74`yS_ @XfY+u?jUzyyA$s~tb.');
define('SECURE_AUTH_SALT', 'TpH,G5&Tl^#]gfAH*}I_+dGccTF_|Z$xOQvdg7Y*^{U|@FAJBK:t5oyg^{C9t;ER');
define('LOGGED_IN_SALT',   '7!m{8]ARi&fU;>-ya4=B3Y@XaDtBc.(kT*R{:l%May%ckF$e@#PDvPmzJgp)P=q6');
define('NONCE_SALT',       '4,$]|>BO(sVHWHA#i7nQT^`rX;e)j6=_oGuFmclNzJ)w|c/&HC8Buff:_2}3c&Wj');

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
