<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up():void { Schema::create('announcements',function(Blueprint $table){$table->id();$table->foreignId('event_id')->constrained()->cascadeOnDelete();$table->string('message',300);$table->timestamps();}); } public function down():void { Schema::dropIfExists('announcements'); } };
