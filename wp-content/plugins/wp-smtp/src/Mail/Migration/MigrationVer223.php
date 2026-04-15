<?php

namespace SolidWP\Mail\Migration;

use WPSMTP\Logger\Table;

/**
 * Class MigrationVer223
 *
 * Migration for version 2.2.3 to update the logs table charset and collation.
 *
 * @package SolidWP\Mail\Migration
 */
class MigrationVer223 {

	/**
	 * Migration logic for version 2.2.3.
	 *
	 * Update the logs table columns charset and collation to utf8mb4.
	 * dbDelta does not update existing column charset/collation, so we use ALTER TABLE.
	 *
	 * @param string $version
	 *
	 * @return void
	 */
	public function migration( string $version ): void {
		global $wpdb;

		if ( version_compare( $version, '2.2.3', '>=' ) ) {
			return;
		}

		$charset_collate = $wpdb->get_charset_collate();

		if ( ! str_contains( $charset_collate, 'utf8mb4' ) ) {
			// Database does not support utf8mb4, it does not make sense to run the migration.
			return;
		}

		if ( str_starts_with( $charset_collate, 'DEFAULT ' ) ) {
			$charset_collate = substr( $charset_collate, strlen( 'DEFAULT ' ) );
		}

		$table = Table::get_name();

		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		// phpcs:disable WordPress.DB.DirectDatabaseQuery
		$wpdb->query( "ALTER TABLE {$table} DEFAULT {$charset_collate}" );

		$wpdb->query( "ALTER TABLE `{$table}` CONVERT TO {$charset_collate}" );
		// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		// phpcs:enable WordPress.DB.DirectDatabaseQuery
	}
}
