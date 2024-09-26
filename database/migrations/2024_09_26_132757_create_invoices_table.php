<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Таблицата съдържа информация за фактурите, генерирани от потребителите.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // автоматично генерирано ID на фактурата
            $table->string('invoice_number')->unique(); // уникален номер на фактурата
            $table->date('date'); // дата на фактурата
            $table->string('customer_name'); // име на клиента
            $table->string('customer_email'); // имейл на клиента
            $table->decimal('total_amount', 10, 2); // обща сума на фактурата
            $table->foreignId('user_id') // външен ключ за ID на потребителя
                  ->constrained() // ограничение за външен ключ
                  ->onDelete('cascade'); // изтриване на фактурите при изтриване на потребителя
            $table->timestamps(); // дата на създаване и актуализация на записа
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
