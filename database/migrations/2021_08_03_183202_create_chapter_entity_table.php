<?php

use App\Models\Chapter;
use App\Models\Entity;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapterEntityTable extends Migration
{
    public function up()
    {
        Schema::create('chapter_entity', function (Blueprint $table) {
            $table->foreignIdFor(Chapter::class);
            $table->foreignIdFor(Entity::class);
            $table->unsignedInteger("type");
            $table->timestamps();

            $table->primary(["chapter_id", "entity_id", "type"]);
        });
    }
}
