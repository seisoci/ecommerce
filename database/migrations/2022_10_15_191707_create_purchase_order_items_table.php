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
    Schema::create('purchase_order_items', function (Blueprint $table) {
      $table->id();
      $table->foreignId('purchase_order_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
      $table->foreignId('item_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
      $table->integer('qty');
      $table->decimal('price', 15, 2)->default(0);
      $table->decimal('total_price', 15, 2)->default(0);
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
    Schema::dropIfExists('purchase_order_items');
  }
};
