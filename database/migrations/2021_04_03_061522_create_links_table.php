<?php

use App\Models\Chapter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Chapter::class);
            $table->string('site');
            $table->string('url');
            $table->timestamps();
        });
    }
}
