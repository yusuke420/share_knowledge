<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // カラム追加（descriptionの後に追加、NULL許可）
            $table->text('image')->after('body')->nullable();
    
            // カラム追加（テーブルの最後に追加）
            // $table->text('image');
            
            // カラム追加（指定したカラムの後に追加）
            // $table->text('image')->after('description');
    
            // NULL許可
            // $table->string('image')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // カラム削除
            $table->dropColumn('image');
        });
    }
};
