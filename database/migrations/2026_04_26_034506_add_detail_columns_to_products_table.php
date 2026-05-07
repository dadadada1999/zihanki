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
        Schema::table('products', function (Blueprint $table) {

            $table->string('img_path')
                ->nullable();

            $table->integer('stock')
                ->default(0);

            $table->text('comment')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn([
                'img_path',
                'stock',
                'comment'
            ]);
        });
    }
};