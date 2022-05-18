<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('account_name');
            $table->string('other_name')->nullable();
            $table->foreignId('account_number')->from(3000000001);
            $table->string('image')->nullable();
            $table->string('email_address')->nullable();
            $table->string('account_type');
            $table->string('phone_number');
            $table->text('address');
            $table->string('password');
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
        Schema::dropIfExists('accounts');
    }
};
