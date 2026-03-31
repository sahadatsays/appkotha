<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->string('name_bn')->nullable()->after('name_en');
            $table->string('tagline_en')->nullable()->after('tagline');
            $table->string('tagline_bn')->nullable()->after('tagline_en');
            $table->string('short_description_en')->nullable()->after('short_description');
            $table->string('short_description_bn')->nullable()->after('short_description_en');
            $table->text('description_en')->nullable()->after('description');
            $table->text('description_bn')->nullable()->after('description_en');
            $table->string('meta_title_en')->nullable()->after('meta_title');
            $table->string('meta_title_bn')->nullable()->after('meta_title_en');
            $table->text('meta_description_en')->nullable()->after('meta_description');
            $table->text('meta_description_bn')->nullable()->after('meta_description_en');
        });

        DB::table('services')->update([
            'name_en' => DB::raw('name'),
            'tagline_en' => DB::raw('tagline'),
            'short_description_en' => DB::raw('short_description'),
            'description_en' => DB::raw('description'),
            'meta_title_en' => DB::raw('meta_title'),
            'meta_description_en' => DB::raw('meta_description'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'name_en',
                'name_bn',
                'tagline_en',
                'tagline_bn',
                'short_description_en',
                'short_description_bn',
                'description_en',
                'description_bn',
                'meta_title_en',
                'meta_title_bn',
                'meta_description_en',
                'meta_description_bn',
            ]);
        });
    }
};
