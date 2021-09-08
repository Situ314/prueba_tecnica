<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoPermissionUserView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
            CREATE VIEW v_no_permission_user
            AS
            SELECT
                users.username as username
            FROM
                users
                LEFT JOIN role_user ON users.id = role_user.user_id
                LEFT JOIN roles ON role_user.role_id = roles.id
                LEFT JOIN permission_role ON permission_role.role_id = roles.id
                LEFT JOIN permissions ON permissions.id = permission_role.permission_id
                WHERE role_user.id IS NULL
                OR permission_role.id IS NULL;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
