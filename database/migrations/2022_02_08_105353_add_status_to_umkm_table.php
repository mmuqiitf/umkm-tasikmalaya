<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToUmkmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->enum('klasifikasi_umum', ['usaha mikro', 'usaha kecil', 'usaha menengah'])->default('usaha mikro');
            $table->enum('status_umkm', ['umkm sudah berizin usaha', 'umkm belum berizin usaha'])->default('umkm belum berizin usaha');
            $table->tinyInteger('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropColumn(['status, status_umkm', 'klasifikasi_umum']);
        });
    }
}
