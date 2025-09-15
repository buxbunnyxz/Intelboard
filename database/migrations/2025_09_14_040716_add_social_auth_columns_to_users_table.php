<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'full_name')) {
                $table->string('full_name')->nullable()->after('id');
            }
            if (!Schema::hasColumn('users', 'phone_number')) {
                $table->string('phone_number')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('broker')->after('phone_number');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->string('status')->default('active')->after('role');
            }
            if (!Schema::hasColumn('users', 'joined_date')) {
                $table->date('joined_date')->nullable()->after('status');
            }
            if (!Schema::hasColumn('users', 'google_id')) {
                $table->string('google_id')->nullable()->unique()->after('id');
            }
            if (!Schema::hasColumn('users', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable()->after('joined_date');
            }
            if (!Schema::hasColumn('users', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable()->after('last_login_at');
            }
            if (!Schema::hasColumn('users', 'remember_token')) {
                $table->rememberToken();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Optional: usually you wouldn't drop these in production.
            if (Schema::hasColumn('users', 'google_id')) $table->dropColumn('google_id');
            if (Schema::hasColumn('users', 'last_login_at')) $table->dropColumn('last_login_at');
            if (Schema::hasColumn('users', 'email_verified_at')) $table->dropColumn('email_verified_at');
            if (Schema::hasColumn('users', 'joined_date')) $table->dropColumn('joined_date');
            if (Schema::hasColumn('users', 'status')) $table->dropColumn('status');
            if (Schema::hasColumn('users', 'role')) $table->dropColumn('role');
            if (Schema::hasColumn('users', 'phone_number')) $table->dropColumn('phone_number');
            if (Schema::hasColumn('users', 'full_name')) $table->dropColumn('full_name');
            if (Schema::hasColumn('users', 'remember_token')) $table->dropColumn('remember_token');
        });
    }
};