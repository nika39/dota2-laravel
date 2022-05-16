<?php

use App\Models\StrongOpponent;
use App\Models\Hero;
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
        Schema::create('strong_opponents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hero::class);
            $table->foreignIdFor(StrongOpponent::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('strong_opponents');
    }
};
