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
        DB::statement('ALTER TABLE ingredient_audit_logs ALTER COLUMN ingredient_id DROP NOT NULL;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert the non-null constraint
        DB::statement('ALTER TABLE ingredient_audit_logs ALTER COLUMN ingredient_id SET NOT NULL;');
    }
};
