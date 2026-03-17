<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ensure ingredient_id is nullable on ingredient_audit_logs.
     * This is needed because product stock-in audit logs don't have an ingredient_id.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            // Check if the column currently has a NOT NULL constraint before dropping it
            $isNullable = DB::selectOne("
                SELECT is_nullable
                FROM information_schema.columns
                WHERE table_name = 'ingredient_audit_logs'
                  AND column_name = 'ingredient_id'
            ");

            if ($isNullable && $isNullable->is_nullable === 'NO') {
                DB::statement('ALTER TABLE ingredient_audit_logs ALTER COLUMN ingredient_id DROP NOT NULL;');
            }

            // Also drop the foreign key constraint if it exists, so NULLs are allowed
            $fkExists = DB::selectOne("
                SELECT constraint_name
                FROM information_schema.table_constraints
                WHERE table_name = 'ingredient_audit_logs'
                  AND constraint_type = 'FOREIGN KEY'
                  AND constraint_name LIKE '%ingredient_id%'
            ");

            if ($fkExists) {
                DB::statement('ALTER TABLE ingredient_audit_logs DROP CONSTRAINT ' . $fkExists->constraint_name . ';');
            }
        } else {
            // MySQL: make nullable and keep foreign key with SET NULL
            DB::statement('ALTER TABLE ingredient_audit_logs MODIFY ingredient_id bigint unsigned NULL;');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE ingredient_audit_logs ALTER COLUMN ingredient_id SET NOT NULL;');
        } else {
            DB::statement('ALTER TABLE ingredient_audit_logs MODIFY ingredient_id bigint unsigned NOT NULL;');
        }
    }
};
