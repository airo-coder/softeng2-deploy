<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            // PostgreSQL-compatible: disable triggers, truncate with cascade
            $driver = DB::getDriverName();

            if ($driver === 'pgsql') {
                DB::statement('SET session_replication_role = replica;');
            } else {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            }

            // Truncate tables to start fresh
            $tables = [
                'kitchen_stock_deductions',
                'kitchen_production_logs',
                'ingredient_audit_logs',
                'product_audit_logs',
                'transaction_items',
                'transactions',
                'recipes',
                'batch_sizes',
                'ingredients',
                'products',
                'users',
            ];

            foreach ($tables as $table) {
                if (Schema::hasTable($table)) {
                    if ($driver === 'pgsql') {
                        DB::statement("TRUNCATE TABLE {$table} CASCADE;");
                    } else {
                        DB::table($table)->truncate();
                    }
                }
            }

            if ($driver === 'pgsql') {
                DB::statement('SET session_replication_role = DEFAULT;');
            } else {
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            }

            // Create role-based users
            $users = [
                [
                    'first_name' => 'Admin',
                    'last_name'  => 'User',
                    'email'      => 'admin@udc.com',
                    'role'       => 'admin',
                    'password'   => 'admin123',
                    'is_active'  => true,
                ],
                [
                    'first_name' => 'Cashier',
                    'last_name'  => 'Staff',
                    'email'      => 'cashier@udc.com',
                    'role'       => 'cashier',
                    'password'   => 'cashier123',
                    'is_active'  => true,
                ],
                [
                    'first_name' => 'Kitchen',
                    'last_name'  => 'Manager',
                    'email'      => 'kitchen@udc.com',
                    'role'       => 'kitchen_manager',
                    'password'   => 'kitchen123',
                    'is_active'  => true,
                ],
                [
                    'first_name' => 'Inventory',
                    'last_name'  => 'Manager',
                    'email'      => 'inventory@udc.com',
                    'role'       => 'inventory_manager',
                    'password'   => 'inventory123',
                    'is_active'  => true,
                ],
            ];

            foreach ($users as $userData) {
                User::create($userData);
            }

        } catch (\Exception $e) {
            $this->command->error($e->getMessage());
            throw $e;
        }
    }
}
