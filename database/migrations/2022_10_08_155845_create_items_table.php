<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('items', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('slug');
      $table->foreignId('category_item_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
      $table->string('poster')->nullable();
      $table->integer('qty')->default(0);
      $table->text('description')->nullable();
      $table->tinyInteger('published')->default(0);
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
    Schema::dropIfExists('items');
  }
};
