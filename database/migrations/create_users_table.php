<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('user')->unique();
            $table->string('email')->unique();
            $table->date('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('active');
            $table->integer('failed_attempts')->nullable();
            $table->timestamps();
        });

        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('identification');
            $table->string('names');
            $table->string('surnames');
            $table->string('email');
            $table->integer('phone');
            $table->boolean('active');
            $table->timestamps();
        });

        Schema::create('user_by_person', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('user')->onDelete('restrict'); // Evita eliminar el usuario si hay relación
            $table->foreignId('person_id')->unique()->constrained('persons')->onDelete('restrict'); // Evita eliminar la persona si hay relación
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_by_person');
        Schema::dropIfExists('user');
        Schema::dropIfExists('persons');
    }
};