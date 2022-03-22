<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Driver;

class Drivers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('lat');
            $table->string('lng');
            $table->string('address');
            $table->rememberToken();
            $table->timestamps();
        });

        $drivers = [
            ['name'=>'Kristian Beatty','email'=>'brandyn50@example.org','phone'=>'577777777','password'=>'222222','lat'=>'24.69023','lng'=>'46.685','address'=>'address'],
            ['name'=>'Ms. Raquel Borer Sr.','email'=>'hhudson@example.org','phone'=>'588888888','password'=>'222222','lat'=>'24.69022','lng'=>'46.684','address'=>'address'],
            ['name'=>'Jordane Schroeder','email'=>'alden.rutherford@example.com','phone'=>'584444444','password'=>'222222','lat'=>'24.69018','lng'=>'46.680','address'=>'address'],
            ['name'=>'Dr. Lemuel Jacobson','email'=>'norval23@example.net','phone'=>'599999999','password'=>'222222','lat'=>'24.69021','lng'=>'46.683','address'=>'address'],
            ['name'=>'Kiel Volkman','email'=>'ynolan@example.net','phone'=>'5111111110','password'=>'222222','lat'=>'24.69020','lng'=>'46.682','address'=>'address'],
            ['name'=>'Cortney Wolf','email'=>'jast.lillian@example.org','phone'=>'563333333','password'=>'222222','lat'=>'24.69019','lng'=>'46.681','address'=>'address']
        ];

        foreach($drivers as $driver)
        {
            $user = new Driver;
            $user->name       = $driver['name'];
            $user->email      = $driver['email'];
            $user->phone      = $driver['phone'];
            $user->lat        = $driver['lat'];
            $user->lng        = $driver['lng'];
            $user->address    = 'address';
            $user->password   = bcrypt('222222');
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
