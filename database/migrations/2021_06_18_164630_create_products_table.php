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
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name')->unique();
            $table->text('title');
            $table->string('slug');
            $table->string('images');
            $table->string('main_image')->nullable();
            $table->text('summary')->nullable();
            $table->string('sku', 100)->default(0);
            $table->float('price')->default(0);
            $table->float('sales')->nullable()->default(null);
            $table->tinyInteger('featured')->nullable()->default(0);
            $table->text('descriptions');
            $table->enum('status', ['Published', 'Draft', 'Soon'])->default('Published');
            $table->unsignedBigInteger('category_id')->nullabl();
            $table->unsignedBigInteger('brand_id')->nullabl();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->date('published_at')->nullable()->default(null);
            $table->softDeletes();
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