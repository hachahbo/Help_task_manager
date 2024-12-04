<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Check if the column doesn't already exist before adding it
        if (!Schema::hasColumn('users', 'role')) {
            $table->enum('role', ['admin', 'user', 'technicien'])->default('user');
        }
    });

}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role'); // Remove role column
    });
}

};
