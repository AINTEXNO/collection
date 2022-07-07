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
            $table->foreignIdFor(\App\Models\Category::class)->constrained()->cascadeOnDelete();
            $table->string('title', 140);
            $table->text('description');
            $table->float('price');
            $table->integer('count');
            $table->text('photo')->nullable();
            $table->string('code', 7)->unique();
            $table->foreignIdFor(\App\Models\Collection::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Style::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Brand::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Color::class)->nullable()->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('products');
    }
}
