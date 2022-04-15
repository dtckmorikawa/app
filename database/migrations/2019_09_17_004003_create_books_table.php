<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id")->index()->nullable();
            $table->unsignedInteger("category_id")->index()->nullable();
            $table->string("slug")->unique();

            $table->string("title")->nullable()->default("Book Title");
            $table->string("subtitle")->nullable()->default("Book Subtitle");
            $table->text("meta_desc")->nullable();
            $table->mediumText("topics")->nullable();

            $table->dateTime("posted_at")->index()->nullable()->comment("Public posted at time, if this is in future then it wont appear yet");
            $table->boolean("is_published")->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
