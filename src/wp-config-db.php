<?php
/**
 * Database Configuration for Hotel Nowy Dwór WordPress Installation
 *
 * This file detects the environment (Docker, local, production) and configures
 * database credentials accordingly. Never commit production credentials.
 *
 * @package HotelNowyDwor
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 */

// Detect Docker environment.
$is_docker = getenv( 'WORDPRESS_DB_HOST' ) !== false;

// Detect local development by hostname.
$is_local = in_array(
	$_SERVER['HTTP_HOST'] ?? '',
	array( 'localhost', '127.0.0.1', 'localhost:8080', 'localhost:8088' ),
	true
) || $is_docker;

if ( $is_docker ) {
	// Docker environment - use environment variables.
	define( 'DB_NAME', getenv( 'WORDPRESS_DB_NAME' ) ?: 'nowydwor_hotelnowydworeunew' );
	define( 'DB_USER', getenv( 'WORDPRESS_DB_USER' ) ?: 'wordpress' );
	define( 'DB_PASSWORD', getenv( 'WORDPRESS_DB_PASSWORD' ) ?: 'wordpress_dev_pass' );
	define( 'DB_HOST', getenv( 'WORDPRESS_DB_HOST' ) ?: 'db:3306' );

	// Docker site URLs.
	define( 'WP_HOME', 'http://localhost:8088' );
	define( 'WP_SITEURL', 'http://localhost:8088' );
} elseif ( $is_local ) {
	// Local development environment.
	define( 'DB_NAME', 'nowydwor_hotelnowydworeunew' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', '' );
	define( 'DB_HOST', 'localhost' );
} else {
	// Production environment - credentials from environment or .env file.
	define( 'DB_NAME', getenv( 'DB_NAME' ) ?: 'nowydwor_hotelnowydworeunew' );
	define( 'DB_USER', getenv( 'DB_USER' ) ?: 'nowydwor_wenuerowdywonletoh' );
	define( 'DB_PASSWORD', getenv( 'DB_PASSWORD' ) ?: '' ); // Set in .env or server env.
	define( 'DB_HOST', getenv( 'DB_HOST' ) ?: 'localhost' );
}

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );