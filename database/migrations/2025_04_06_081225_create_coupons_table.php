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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('description');
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->decimal('percentage_discount', 5, 2)->nullable()->comment('Percentage discount (0-100)');
            $table->decimal('fixed_discount', 10, 2)->nullable()->comment('Fixed amount discount');
            $table->integer('usage_limit')->nullable();
            $table->integer('times_used')->default(0);
            $table->date('valid_from');
            $table->date('valid_until');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
