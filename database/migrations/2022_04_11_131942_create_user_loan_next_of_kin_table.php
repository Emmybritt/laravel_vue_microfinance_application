<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Loan;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_loan_next_of_kin', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Loan::class, 'loan_id');
            $table->string('name');
            $table->string('relationship');
            $table->text('address');
            $table->bigInteger('phone_no');
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
        Schema::dropIfExists('user_loan_next_of_kin');
    }
};
