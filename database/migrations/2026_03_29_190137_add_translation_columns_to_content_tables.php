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
        Schema::table('products', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->string('name_bn')->nullable()->after('name_en');
            $table->string('tagline_en')->nullable()->after('tagline');
            $table->string('tagline_bn')->nullable()->after('tagline_en');
            $table->string('short_description_en')->nullable()->after('short_description');
            $table->string('short_description_bn')->nullable()->after('short_description_en');
            $table->text('description_en')->nullable()->after('description');
            $table->text('description_bn')->nullable()->after('description_en');
            $table->json('features_en')->nullable()->after('features');
            $table->json('features_bn')->nullable()->after('features_en');
            $table->json('use_cases_en')->nullable()->after('use_cases');
            $table->json('use_cases_bn')->nullable()->after('use_cases_en');
            $table->string('meta_title_en')->nullable()->after('meta_title');
            $table->string('meta_title_bn')->nullable()->after('meta_title_en');
            $table->text('meta_description_en')->nullable()->after('meta_description');
            $table->text('meta_description_bn')->nullable()->after('meta_description_en');
        });

        Schema::table('blog_categories', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->string('name_bn')->nullable()->after('name_en');
            $table->text('description_en')->nullable()->after('description');
            $table->text('description_bn')->nullable()->after('description_en');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('title_bn')->nullable()->after('title_en');
            $table->text('excerpt_en')->nullable()->after('excerpt');
            $table->text('excerpt_bn')->nullable()->after('excerpt_en');
            $table->longText('content_en')->nullable()->after('content');
            $table->longText('content_bn')->nullable()->after('content_en');
            $table->string('meta_title_en')->nullable()->after('meta_title');
            $table->string('meta_title_bn')->nullable()->after('meta_title_en');
            $table->text('meta_description_en')->nullable()->after('meta_description');
            $table->text('meta_description_bn')->nullable()->after('meta_description_en');
        });

        Schema::table('case_studies', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('title_bn')->nullable()->after('title_en');
            $table->string('client_en')->nullable()->after('client');
            $table->string('client_bn')->nullable()->after('client_en');
            $table->string('industry_en')->nullable()->after('industry');
            $table->string('industry_bn')->nullable()->after('industry_en');
            $table->text('excerpt_en')->nullable()->after('excerpt');
            $table->text('excerpt_bn')->nullable()->after('excerpt_en');
            $table->text('challenge_en')->nullable()->after('challenge');
            $table->text('challenge_bn')->nullable()->after('challenge_en');
            $table->text('solution_en')->nullable()->after('solution');
            $table->text('solution_bn')->nullable()->after('solution_en');
            $table->text('results_en')->nullable()->after('results');
            $table->text('results_bn')->nullable()->after('results_en');
            $table->text('testimonial_quote_en')->nullable()->after('testimonial_quote');
            $table->text('testimonial_quote_bn')->nullable()->after('testimonial_quote_en');
            $table->string('testimonial_author_en')->nullable()->after('testimonial_author');
            $table->string('testimonial_author_bn')->nullable()->after('testimonial_author_en');
            $table->string('testimonial_position_en')->nullable()->after('testimonial_position');
            $table->string('testimonial_position_bn')->nullable()->after('testimonial_position_en');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->string('question_en')->nullable()->after('question');
            $table->string('question_bn')->nullable()->after('question_en');
            $table->text('answer_en')->nullable()->after('answer');
            $table->text('answer_bn')->nullable()->after('answer_en');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->string('name_bn')->nullable()->after('name_en');
            $table->string('position_en')->nullable()->after('position');
            $table->string('position_bn')->nullable()->after('position_en');
            $table->string('company_en')->nullable()->after('company');
            $table->string('company_bn')->nullable()->after('company_en');
            $table->text('content_en')->nullable()->after('content');
            $table->text('content_bn')->nullable()->after('content_en');
        });

        DB::table('products')->update([
            'name_en' => DB::raw('name'),
            'tagline_en' => DB::raw('tagline'),
            'short_description_en' => DB::raw('short_description'),
            'description_en' => DB::raw('description'),
            'features_en' => DB::raw('features'),
            'use_cases_en' => DB::raw('use_cases'),
            'meta_title_en' => DB::raw('meta_title'),
            'meta_description_en' => DB::raw('meta_description'),
        ]);
        DB::table('blog_categories')->update([
            'name_en' => DB::raw('name'),
            'description_en' => DB::raw('description'),
        ]);
        DB::table('blog_posts')->update([
            'title_en' => DB::raw('title'),
            'excerpt_en' => DB::raw('excerpt'),
            'content_en' => DB::raw('content'),
            'meta_title_en' => DB::raw('meta_title'),
            'meta_description_en' => DB::raw('meta_description'),
        ]);
        DB::table('case_studies')->update([
            'title_en' => DB::raw('title'),
            'client_en' => DB::raw('client'),
            'industry_en' => DB::raw('industry'),
            'excerpt_en' => DB::raw('excerpt'),
            'challenge_en' => DB::raw('challenge'),
            'solution_en' => DB::raw('solution'),
            'results_en' => DB::raw('results'),
            'testimonial_quote_en' => DB::raw('testimonial_quote'),
            'testimonial_author_en' => DB::raw('testimonial_author'),
            'testimonial_position_en' => DB::raw('testimonial_position'),
        ]);
        DB::table('faqs')->update([
            'question_en' => DB::raw('question'),
            'answer_en' => DB::raw('answer'),
        ]);
        DB::table('testimonials')->update([
            'name_en' => DB::raw('name'),
            'position_en' => DB::raw('position'),
            'company_en' => DB::raw('company'),
            'content_en' => DB::raw('content'),
        ]);
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'name_bn', 'position_en', 'position_bn', 'company_en', 'company_bn', 'content_en', 'content_bn']);
        });
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['question_en', 'question_bn', 'answer_en', 'answer_bn']);
        });
        Schema::table('case_studies', function (Blueprint $table) {
            $table->dropColumn([
                'title_en',
                'title_bn',
                'client_en',
                'client_bn',
                'industry_en',
                'industry_bn',
                'excerpt_en',
                'excerpt_bn',
                'challenge_en',
                'challenge_bn',
                'solution_en',
                'solution_bn',
                'results_en',
                'results_bn',
                'testimonial_quote_en',
                'testimonial_quote_bn',
                'testimonial_author_en',
                'testimonial_author_bn',
                'testimonial_position_en',
                'testimonial_position_bn',
            ]);
        });
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn([
                'title_en',
                'title_bn',
                'excerpt_en',
                'excerpt_bn',
                'content_en',
                'content_bn',
                'meta_title_en',
                'meta_title_bn',
                'meta_description_en',
                'meta_description_bn',
            ]);
        });
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'name_bn', 'description_en', 'description_bn']);
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'name_en',
                'name_bn',
                'tagline_en',
                'tagline_bn',
                'short_description_en',
                'short_description_bn',
                'description_en',
                'description_bn',
                'features_en',
                'features_bn',
                'use_cases_en',
                'use_cases_bn',
                'meta_title_en',
                'meta_title_bn',
                'meta_description_en',
                'meta_description_bn',
            ]);
        });
    }
};
