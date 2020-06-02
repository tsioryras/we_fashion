<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id'); // clé primaire
            $table->string('name', 100); // VARCHAR 100
            $table->text('description')->nullable(); // TEXT NULL
            $table->unsignedDouble('price')->default(0.0);
            $table->enum('size', ['XS', 'S', 'M', 'L', 'XL']);
            $table->enum('visibility', ['unpublished', 'publish'])->default('unpublished');
            $table->enum('code', ['standard', 'onSale'])->default('standard');
            $table->string('reference', 16); // VARCHAR 16
            $table->dateTime('published_at')->nullable(); // DATETIME
            $table->dateTime('updated_at')->nullable(); // DATETIME
            $table->dateTime('created_at')->default(now()); // DATETIME
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
