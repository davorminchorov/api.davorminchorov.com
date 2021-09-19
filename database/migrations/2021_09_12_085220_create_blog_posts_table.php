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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->efficientUuid('uuid');
            $table->efficientUuid('user_uuid');
            $table->string('title');
            $table->string('slug');
            $table->text('excerpt');
            $table->text('content');
            $table->tinyInteger('status')->default(BlogPostStatus::DRAFT);
            $table->timestamp('published_at');
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
        Schema::dropIfExists('blog_posts');
    }
}
