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
    Schema::create('purchase_orders', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
      $table->decimal('grand_total', 15, 2)->default(0);
      $table->enum('status', ['cancel', 'pending','success'])->default('pending');
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
    Schema::dropIfExists('purchase_orders');
  }
};
