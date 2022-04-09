<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $defaultRole = Role::query()->where('title', Role::ROLE_USER)->first();
        if ($defaultRole !== null) {
            $defaultRoleId = $defaultRole->id;
            Schema::table('users', function (Blueprint $table) use ($defaultRoleId) {
                $table->unsignedInteger('role_id')->after('id')->default($defaultRoleId);

                $table->foreign('role_id', 'user_role_foreign')
                      ->references('id')
                      ->on('roles')
                      ->onUpdate('cascade')
                      ->onDelete('restrict');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign('user_role_foreign');
                $table->dropColumn('role_id');
            });
        }
    }
};
