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
            $table->uuid('id')->primary();
            $table->uuid('booking_id');
            $table->integer('rating');
            $table->integer('cleaness_rating');  
            $table->integer('accurency_rating');  
            $table->integer('communication_rating');  
            $table->integer('location_rating');  
            $table->integer('check-in_rating');  
            $table->integer('value_rating');      
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
