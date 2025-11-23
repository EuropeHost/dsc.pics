<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('slug', 7)->unique()->nullable()->after('id');
        });
		
        DB::table('images')->whereNull('slug')->cursor()->each(function ($image) {
            DB::table('images')
                ->where('id', $image->id)
                ->update(['slug' => Str::random(7)]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
