<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_comment', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('booking_id');
            $table->dateTimetz('created_at');
            $table->int('rating');
            $table->int('cleaness_rating');  
            $table->int('accurency_rating');  
            $table->int('communication_rating');  
            $table->int('location_rating');  
            $table->int('check-in_rating');  
            $table->int('value_rating');      
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
        Schema::dropIfExists('booking_comment');
    }
}
