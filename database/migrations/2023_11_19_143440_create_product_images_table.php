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
    Schema::create('product_images', function (Blueprint $table) {
      $table->id();
      $table->foreignId('item_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
      $table->smallInteger('sort_number');
      $table->string('url');
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
    Schema::dropIfExists('product_images');
  }
};
