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
    Schema::create('payments', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger('merchant_id');
      $table->foreign('merchant_id')->references('id')->on('merchants');

      $table->unsignedBigInteger('external_id');

      $table->unsignedBigInteger('user_id')->nullable();

      $table->foreign('user_id')->references('id')->on('users');

      $table->string('status');
      $table->integer('amount');
      $table->integer('amount_paid');

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
    Schema::dropIfExists('payments');
  }
};
