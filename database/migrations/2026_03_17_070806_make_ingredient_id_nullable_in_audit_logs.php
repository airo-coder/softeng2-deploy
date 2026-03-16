<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the non-null constraint forcefully for PostgreSQL
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE ingredient_audit_logs ALTER COLUMN ingredient_id DROP NOT NULL;');
        } else {
            DB::statement('ALTER TABLE ingredient_audit_logs MODIFY ingredient_id bigint unsigned null;');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert the non-null constraint
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE ingredient_audit_logs ALTER COLUMN ingredient_id SET NOT NULL;');
        } else {
            DB::statement('ALTER TABLE ingredient_audit_logs MODIFY ingredient_id bigint unsigned not null;');
        }
    }
};
