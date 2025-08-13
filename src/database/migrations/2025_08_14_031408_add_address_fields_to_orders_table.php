<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'post_code')) {
                $table->string('post_code')->nullable();
            }
            if (!Schema::hasColumn('orders', 'address')) {
                $table->string('address')->nullable();
            }
            if (!Schema::hasColumn('orders', 'building')) {
                $table->string('building')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['post_code', 'address', 'building']);
        });
    }
}
