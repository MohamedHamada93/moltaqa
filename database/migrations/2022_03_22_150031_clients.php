<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Client;

class Clients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('lat');
            $table->string('lng');
            $table->string('address');
            $table->rememberToken();
            $table->timestamps();
        });

        $user = new Client;
        $user->name      = 'Lauretta McClure';
        $user->email     = 'shanie.gorczany@example.com';
        $user->phone     = '566666666';
        $user->lat       = '24.69023';
        $user->lng       = '46.685';
        $user->address   = 'address';
        $user->password  = bcrypt(111111);
        $user->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
