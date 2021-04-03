<?php

use App\Models\Reference;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceablesTable extends Migration
{
    public function up()
    {
        Schema::create('referenceables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Reference::class);
            $table->morphs('referenceable');
            $table->timestamps();
        });
    }
}
