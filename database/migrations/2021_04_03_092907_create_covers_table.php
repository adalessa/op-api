<?php

use App\Models\Chapter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoversTable extends Migration
{
    public function up()
    {
        Schema::create('covers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Chapter::class);
            $table->text('text');
            $table->string('image');
            $table->timestamps();
        });
    }
}
