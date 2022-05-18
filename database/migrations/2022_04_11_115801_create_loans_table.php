<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Branches;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(Branches::class, 'branch_id');
            $table->foreignId('loan_number')->from(1000000001);
            $table->string('phone_number');
            $table->string('image')->nullable();
            $table->string('loan_type');
            $table->string('full_name');
            $table->string('age');
            $table->string('religion');
            $table->string('gender');
            $table->string('nationality');
            $table->string('state');
            $table->string('LGA');
            $table->text('residential_address');
            $table->text('occupation');
            $table->text('nature_of_business');
            $table->text('office_address');
            $table->text('purpose_of_loan');
            $table->integer('amount_needed');
            $table->integer('duration');
            $table->string('method_of_payment');
            $table->string('day_of_payment');
            $table->integer('mandatory_savings');
            $table->integer('default_fee')->nullable();
            $table->string('collateral')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('loans');
    }
};
