<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->unique()
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->bigInteger('parent_id')->nullable();
            $table->string('phone')->unique();
            $table->decimal('balance')->default(0);
            $table->decimal('total_commission')->default(0);
            $table->integer('completed_tasks')->default(0);
            $table->decimal('commission_ratio1')->default(0.7);
            $table->decimal('commission_ratio2')->default(5);
            $table->decimal('min_balance')->default(50);
            $table->decimal('min_withdrawal')->default(1000);
            $table->decimal('max_withdrawal')->default(50000);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
