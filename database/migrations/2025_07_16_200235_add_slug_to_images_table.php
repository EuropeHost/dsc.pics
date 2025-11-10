<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Media;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            $table->string('slug', 7)->unique()->nullable()->after('id');
        });
		
        Media::cursor()->each(function (Media $media) {
            if (empty($media->slug)) {
                $media->slug = Str::random(7);
                $media->saveQuietly(); // avoid triggering events
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
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
