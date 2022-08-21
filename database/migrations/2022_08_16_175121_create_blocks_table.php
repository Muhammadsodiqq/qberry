<?php

use App\Models\Room;
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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Room::class)->comment('комната которой принадлежит блок');
            $table->string('name')->comment('название блока');
            $table->decimal('price')->comment('цена блока за день');
            $table->decimal('width')->comment('ширина блока');
            $table->decimal('height')->comment('высота блока');
            $table->decimal('length')->comment('длина блока');
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
        Schema::dropIfExists('blocks');
    }
};
