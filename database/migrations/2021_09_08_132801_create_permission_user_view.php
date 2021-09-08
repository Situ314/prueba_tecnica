<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionUserView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
            CREATE VIEW v_permission_user
            AS
            SELECT
                users.username as username,
                permissions.id as permission_id,
                permissions.name as permission_name
            FROM
                users
                LEFT JOIN role_user ON users.id = role_user.user_id
                LEFT JOIN roles ON role_user.role_id = roles.id
                LEFT JOIN permission_role ON permission_role.role_id = roles.id
                LEFT JOIN permissions ON permissions.id = permission_role.permission_id
                WHERE permission_role.id IS NOT NULL;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_user_view');
    }
}
