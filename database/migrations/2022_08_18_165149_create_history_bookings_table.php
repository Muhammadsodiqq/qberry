<?php

use App\Models\Block;
use App\Models\User;
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
        Schema::create('history_bookings', function (Blueprint $table) {
            $table->id();
            $table->date('start_date_booking');
            $table->date('end_date_booking')->nullable();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Block::class);
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
        Schema::dropIfExists('history_bookings');
    }
};
