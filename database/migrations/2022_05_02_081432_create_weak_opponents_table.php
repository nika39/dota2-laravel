<?php

use App\Models\Hero;
use App\Models\WeakOpponent;
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
        Schema::create('weak_opponents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hero::class);
            $table->foreignIdFor(WeakOpponent::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weak_opponents');
    }
};
