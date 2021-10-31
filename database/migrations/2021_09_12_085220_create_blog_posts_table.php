<?php

use DavorMinchorov\Blog\Enums\BlogPostStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(table: 'blog_posts', callback: function (Blueprint $table) {
            $table->id();
            $table->efficientUuid(column: 'uuid');
            $table->unsignedBigInteger(column: 'user_id');
            $table->string(column: 'title');
            $table->string(column: 'slug');
            $table->text(column: 'excerpt');
            $table->text(column: 'content');
            $table->tinyInteger(column: 'status')->default(BlogPostStatus::DRAFT);
            $table->timestamp(column: 'published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'blog_posts');
    }
}
