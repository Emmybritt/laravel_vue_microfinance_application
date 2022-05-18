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
        Schema::create('guarantors_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Loan::class, 'loan_id');
            $table->string('guarantors_image')->nullable();
            $table->string('full_name');
            $table->string('age');
            $table->string('gender');
            $table->string('state');
            $table->string('lga');
            $table->text('residential_address');
            $table->string('occupation');
            $table->string('phone_no');
            $table->text('nature_of_business');
            $table->text('address_of_business');
            $table->string('relationship');
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
        Schema::dropIfExists('guarantors_forms');
    }
};
