<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(table: 'blog_post_tags', callback: function (Blueprint $table) {
            $table->unsignedBigInteger(column: 'blog_post_id');
            $table->unsignedBigInteger(column: 'blog_tag_id');
            $table->timestamps();
            $table->primary(columns: ['blog_post_id', 'blog_tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'blog_post_tags');
    }
}
