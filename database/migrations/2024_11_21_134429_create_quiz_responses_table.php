<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('quiz_responses', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->text('response');
            $table->foreignId('quiz_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_responses');
    }
};
