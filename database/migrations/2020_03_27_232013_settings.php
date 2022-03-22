<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Setting;

class Settings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->longText('tagged')->nullable();
            $table->longText('copyrigth')->nullable();
            $table->longText('about_ar')->nullable();
            $table->longText('about_en')->nullable();
            $table->longText('why_us_ar')->nullable();
            $table->longText('why_us_en')->nullable();
            $table->longText('customer_policy_ar')->nullable();
            $table->longText('customer_policy_en')->nullable();
            $table->longText('provider_policy_ar')->nullable();
            $table->longText('provider_policy_en')->nullable();
            $table->string('address_ar',500)->nullable();
            $table->string('address_en',500)->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->float('tax_rate')->default(0);
            $table->float('app_rate')->default(0);
            $table->timestamps();
        });

        $setting = new Setting;
        $setting->name  = 'إسم التطبيق';
        $setting->email = 'mohamed.hamada0103@gmail.com';
        $setting->phone = '01068549674';
        $setting->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
