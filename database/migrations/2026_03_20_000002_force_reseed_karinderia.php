<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * This migration:
 * 1. Deletes the stale migration record for the seed_karinderia_data migration
 *    so Laravel will re-run it in this batch.
 *
 * This is needed because the previous version of that migration ran but
 * silently skipped all data (because tables weren't empty).
 */
return new class extends Migration
{
    public function up(): void
    {
        // Remove the stale record so the fixed version will execute again
        DB::table('migrations')
            ->where('migration', '2026_03_20_000001_seed_karinderia_data')
            ->delete();
    }

    public function down(): void
    {
        // Nothing to undo
    }
};
