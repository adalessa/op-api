<?php

use App\Models\Entity;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAliasesTable extends Migration
{
    public function up()
    {
        Schema::create('aliases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Entity::class);
            $table->boolean('default')->default(false);
            $table->string('name');
            $table->timestamps();

            $table->unique(['entity_id', 'name']);
        });
    }
}
