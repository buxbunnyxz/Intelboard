<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('users') || !Schema::hasTable('brokers')) {
            return;
        }

        // Ensure column exists & nullable
        if (Schema::hasColumn('users', 'broker_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('broker_id')->nullable()->change();
            });

            if (!$this->foreignKeyExists('users', 'users_broker_id_foreign')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->foreign('broker_id')
                          ->references('id')
                          ->on('brokers')
                          ->nullOnDelete();
                });
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'broker_id')) {
            Schema::table('users', function (Blueprint $table) {
                if ($this->foreignKeyExists('users', 'users_broker_id_foreign')) {
                    $table->dropForeign(['broker_id']);
                }
            });
        }
    }

    private function foreignKeyExists(string $table, string $fkName): bool
    {
        $connection = config('database.default');
        $dbName = config("database.connections.$connection.database");

        $count = DB::table('information_schema.TABLE_CONSTRAINTS')
            ->where('TABLE_SCHEMA', $dbName)
            ->where('TABLE_NAME', $table)
            ->where('CONSTRAINT_NAME', $fkName)
            ->count();

        return $count > 0;
    }
};