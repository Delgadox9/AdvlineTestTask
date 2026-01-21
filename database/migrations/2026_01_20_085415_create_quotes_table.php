<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("text")->nullable();
            $table->timestamps();

            // Добавляем индекс для ускорения поиска по заголовку. Предполагая, что поиск будет
            // идти по полному тексту заголовка.
            $table->index("title");

            // Насчёт индекса для текста уже не уверен, если предполагать, что мы будем брать случайный фрагмент текста,
            // то обычный индекс не поможет. Если же брать FULLTEXT индекс, то ускорить получится только есть брать
            // отдельные слова.
            // Здесь бы использовать внешний поиск, к примеру grep'ом.
            // Поэтому так и оставлю его медленным и грустным.
//            $table->index("text");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
