<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Миграция за създаване на таблицата line_items.
     * Таблицата съдържа информация за артикулите на фактурите.
     */
    public function up(): void
    {
        Schema::create('line_items', function (Blueprint $table) {
            $table->id(); // ID на артикула
            $table->foreignId('invoice_id') // Външен ключ за ID на фактурата
                  ->constrained() // Задава се ограничение за външен ключ
                  ->onDelete('cascade'); // Изтриване на артикулите при изтриване на фактурата
            $table->string('description'); // Описание на артикула
            $table->integer('quantity'); // Количество на артикула
            $table->decimal('unit_price', 10, 2); // Цена на единица с две десетични
            $table->timestamps(); // Дата на създаване и актуализация на записа
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_items');
    }
};
