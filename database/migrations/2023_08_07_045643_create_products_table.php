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
   // database/migrations/xxxx_xx_xx_create_products_table.php

   public function up()
   {
       Schema::create('products', function (Blueprint $table) {
           $table->id();
           $table->string('name');
           $table->decimal('price', 10, 2); // Adjust decimal places as needed
           $table->string('image')->nullable();
           $table->string('category');
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
