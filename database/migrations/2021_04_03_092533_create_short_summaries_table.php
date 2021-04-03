<?php

use App\Models\Chapter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortSummariesTable extends Migration
{
    public function up()
    {
        Schema::create('short_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Chapter::class);
            $table->text('text');
            $table->timestamps();
        });
    }
}
