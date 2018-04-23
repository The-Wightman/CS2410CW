<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateEventsTable extends Migration
{
 /**
 * Run the migrations.
 *
 * @return void
 */
 public function up()
 {
 Schema::create('events', function (Blueprint $table) {
 $table->increments('id');
 $table->string('Name');
 $table->enum('Category',['Sport','Culture','Other']);
 $table->string('Organiser');
 $table->string('email');
 $table->dateTime('Planned_for');
 $table->dateTime('Created_on');
 $table->string('Description');
 $table->string('place');
 $table->unsignedInteger('user_id');
 $table->unsignedInteger('likes')->default(0);
 $table->foreign('user_id')->references('id')->on('users');
 });
 }
 /**
 * Reverse the migrations.
 *
 * @return void
 */
 public function down()
 {
 Schema::dropIfExists('events');
 }
}
