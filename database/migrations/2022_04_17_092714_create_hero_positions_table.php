<?php

use App\Models\Hero;
use App\Models\Position;
use App\Models\Rank;
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
        Schema::create('hero_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Position::class);
            $table->foreignIdFor(Hero::class);
            $table->foreignIdFor(Rank::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hero_positions');
    }
};
