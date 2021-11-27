<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_types', function (Blueprint $table) {
			$table->bigIncrements('id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();

            $table->string('plural_name');
            $table->string('singular_name');
        });

        Schema::create('items', function (Blueprint $table) {
			$table->bigIncrements('id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();

            $table->foreignId('item_type_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('name');
        });

        Schema::create('lists', function (Blueprint $table) {
			$table->bigIncrements('id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();

            $table->foreignId('item_type_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->tinyInteger('type');

            $table->string('title');
        });

        Schema::create('ranked_user_lists', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('list_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });

        Schema::create('ranked_user_list_items', function (Blueprint $table) {
			$table->foreignId('ranked_user_list_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('item_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->tinyInteger('rank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_types');

        Schema::dropIfExists('items');

        Schema::dropIfExists('lists');

        Schema::dropIfExists('ranked_user_lists');

        Schema::dropIfExists('ranked_user_items');
    }
}
