<?php

use App\Models\Group;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('insignias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Group::class)->constrained();
            $table->string('path');
            $table->integer('requirement')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('insignias');
    }
};
