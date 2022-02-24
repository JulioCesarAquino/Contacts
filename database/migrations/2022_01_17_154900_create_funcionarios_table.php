
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->change();
            $table->string('whatsapp', 15)->change();
            $table->string('e-mail');
            $table->string('photo');
            $table->foreignId('loja_id')->constrained();
            $table->foreignId('setor_id')->constrained('setors');
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
        Schema::dropIfExists('funcionarios', Function (Blueprint $table){
            $table->foreignId('loja_id')->constreined()->onDelete('cascade');
            $table->foreignId('setors_id')->constreined()->onDelete('cascade');
        });
    }
}
