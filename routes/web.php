<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['role','auth'],'prefix'=>'admin'], function() {

	#------------------------------- start of HomeController -----------------------------#

	Route::get('/home',[
		'uses'  =>'HomeController@index',
		'as'    =>'home',
		'icon'  =>'<i class="nav-icon fas fa-home"></i>',
		'title' =>'الرئيسيه'
	]);

	#------------------------------- end of HomeController -----------------------------#
	

	#------------------------------- start of SupervisorsController -----------------------------#

	# users
	Route::get('supervisors',[
		'uses' =>'SupervisorsController@Index',
		'as'   =>'supervisors',
		'title'=>'المشرفين',
		'subTitle'=>'المشرفين',
		'icon' =>'<i class="fas fa-user-secret"></i>',
		'subIcon' =>'<i class="fas fa-user-secret"></i>',
		'child'=>[
			'supervisorspage',
			'storesupervisor',
			'deletesupervisor',
			'edittsupervisors',
			'updatesupervisor',
		]
	]);

	# add user
	Route::get('add-supervisor-page',[
		'uses'=>'SupervisorsController@AddSupervisorPage',
		'as'  =>'supervisorspage',
		'icon' =>'<i class="fas fa-plus"></i>',
		'title'=>'إضافة مشرف',
		'hasFather'=>true,
		'q_a'=>true
	]);

	# store user
	Route::post('store-supervisor',[
		'uses'=>'SupervisorsController@StoreSupervisor',
		'as'  =>'storesupervisor',
		'title'=>'حفظ المشرف'
	]);

	# edit user
	Route::get('edit-supervisor/{id}',[
		'uses'=>'SupervisorsController@EditSupervisor',
		'as'  =>'edittsupervisors',
		'title'=>'تعديل مشرف'
	]);

	# update user
	Route::post('update-supervisor',[
		'uses'=>'SupervisorsController@UpdateSupervisor',
		'as'  =>'updatesupervisor',
		'title'=>'تحديث مشرف'
	]);

	# delete user
	Route::get('delete-supervisor/{id}',[
		'uses'=>'SupervisorsController@DeleteSupervisor',
		'as'  =>'deletesupervisor',
		'title'=>'حذف مشرف'
	]);

	#------------------------------- end of SupervisorsController -----------------------------#


	#------------------------------- start of ClientsController -----------------------------#

	# clients
	Route::get('clients',[
		'uses' =>'ClientsController@Index',
		'as'   =>'clients',
		'title'=>'العملاء',
		'subTitle'=>'العملاء',
		'icon' =>'<i class="fas fa-male"></i>',
		'subIcon' =>'<i class="fas fa-male"></i>',
		'q_a'=>true,
		'child'=>[
			'storeclient',
			'updateclient',
			'deleteclient',
		]
	]);

	# store client
	Route::post('store-client',[
		'uses'=>'ClientsController@Store',
		'as'  =>'storeclient',
		'title'=>'إضافة عميل '
	]);

	# update client
	Route::post('update-client',[
		'uses'=>'ClientsController@Update',
		'as'  =>'updateclient',
		'title'=>'تحديث عميل'
	]);

	# delete client
	Route::get('delete-client/{id}',[
		'uses'=>'ClientsController@Delete',
		'as'  =>'deleteclient',
		'title'=>'حذف عميل'
	]);

	#------------------------------- end of ClientsController -----------------------------#


	#------------------------------- start of DriversController -----------------------------#
	
	# drivers
	Route::get('drivers',[
		'uses' =>'DriversController@Index',
		'as'   =>'drivers',
		'title'=>'السائقين',
		'subTitle'=>'السائقين',
		'icon' =>'<i class="fas fa-car-side"></i>',
		'subIcon' =>'<i class="fas fa-car-side"></i>',
		'q_a'=>true,
		'child'=>[
			'storedriver',
			'updatedriver',
			'deletedriver',
		]
	]);

	# store driver
	Route::post('store-driver',[
		'uses'=>'DriversController@Store',
		'as'  =>'storedriver',
		'title'=>'إضافة سائق '
	]);

	# update driver
	Route::post('update-driver',[
		'uses'=>'DriversController@Update',
		'as'  =>'updatedriver',
		'title'=>'تحديث سائق'
	]);

	# delete driver
	Route::get('delete-driver/{id}',[
		'uses'=>'DriversController@Delete',
		'as'  =>'deletedriver',
		'title'=>'حذف سائق'
	]);

	#------------------------------- end of DriversController -----------------------------#


	#------------------------------- start of PermissionsController -----------------------------#

	# permissions
	Route::get('permissions',[
		'uses' =>'PermissionsController@Index',
		'as'   =>'permissions',
		'title'=>'الصلاحيات',
		'subTitle'=>'الصلاحيات',
		'icon' =>'<i class="fas fa-biohazard"></i>',
		'subIcon' =>'<i class="fas fa-biohazard"></i>',
		'child'=>[
			'addrolepage',
			'addpermission',
			'editpermission',
			'editrolepage',
			'updatepermission',
			'deletepermission',
		]
	]);

	# add role page
	Route::get('add-role-page',[
		'uses'=>'PermissionsController@AddRolePage',
		'as'  =>'addrolepage',
		'icon' =>'<i class="fas fa-plus"></i>',
		'title'=>'إضافة صلاحيه',
		'hasFather'=>true
	]);

	# add role (ajax)
	Route::post('add-permission',[
		'uses'=>'PermissionsController@Add',
		'as'  =>'addpermission',
		'title'=>'حفظ صلاحيه'
	]);

	# edit permission
	Route::get('edit-permission/{id}',[
		'uses'  =>'PermissionsController@EditRole',
		'as'    =>'editrolepage',
		'title' =>'تعديل صلاحيه'
	]);

	# update role (ajax)
	Route::post('update-permission',[
		'uses'=>'PermissionsController@Update',
		'as'  =>'updatepermission',
		'title'=>'تحديث صلاحيه'
	]);

	# delete role 
	Route::post('delete-permission',[
		'uses'=>'PermissionsController@Delete',
		'as'  =>'deletepermission',
		'title'=>'حذف صلاحيه'
	]);

	#------------------------------- end of PermissionsController -----------------------------#

	#------------------------------- start of ReportsController -----------------------------#
	# supervisor reports
	Route::get('supervisors-reports',[
		'uses'  =>'ReportsController@Index',
		'as'    =>'supervisorsresports',
		'icon'  =>'<i class="fas fa-clipboard"></i>',
		'subIcon'  =>'<i class="fas fa-clipboard"></i>',
		'title' =>'التقارير',
		'subTitle' =>'تقارير المشرفين',
		'child' =>[
			'deletereport',
			'deleteallreports',
			'reports'
		]
	]);

	# reports
	Route::get('reports/{id?}',[
		'uses'=>'ReportsController@Reports',
		'as'  =>'reports',
		'title'=>'قائمة التقارير'
	]);


	# delete all reports
	Route::post('delete-all-reports',[
		'uses'=>'ReportsController@DeleteAllReports',
		'as'  =>'deleteallreports',
		'title'=>'حذف جميع التقارير'
	]);

	# delete report
	Route::post('delete-report',[
		'uses'=>'ReportsController@DeleteReport',
		'as'  =>'deletereport',
		'title'=>'حذف تقرير'
	]);

	#------------------------------- end of ReportsController -----------------------------#

	#------------------------------- start of SettingController -----------------------------#

	# setting
	Route::get('setting',[
		'uses' =>'SettingController@Index',
		'as'   =>'setting',
		'title'=>'الإعدادات',
		'icon' =>'<i class="fas fa-cog"></i>',
		'child'=>[
			'updatemainsetting',
			'updatecopyrigth',
			'updateaboutapp',
			'updatepolicy',
			'updatesmtp',
			'updatesms',
			'updateonesignal',
			'updatefcm',
			'storedynamicsetting',
			'updatedynamicsetting',
			'deletedynamicsetting',
			'Storesocial',
			'socialUpdate',
			'Deletesocial',
			'updatewhyus',
		]
	]);

	# update main setting
	Route::post('update-main-setting',[
		'uses'=>'SettingController@UpdateMainSetting',
		'as'  =>'updatemainsetting',
		'title'=>'تحديث الإعدادات العامه'
	]);

	# update copyrigth
	Route::post('update-copyrigth',[
		'uses'=>'SettingController@UpdateMainCopyrigth',
		'as'  =>'updatecopyrigth',
		'title'=>'تحديث الحقوق'
	]);

	# update about app
	Route::post('update-about-app',[
		'uses'=>'SettingController@UpdateMainAboutApp',
		'as'  =>'updateaboutapp',
		'title'=>'تحديث عن التطبيق'
	]);

	# update why us
	Route::post('update-why-us',[
		'uses'=>'SettingController@UpdateWhyUs',
		'as'  =>'updatewhyus',
		'title'=>'تحديث لماذا أفتي'
	]);

	# update app policy
	Route::post('update-policy',[
		'uses'=>'SettingController@UpdatePolicy',
		'as'  =>'updatepolicy',
		'title'=>' تحديث الشروط والأحكام'
	]);

	# update smtp
	Route::post('update-smtp',[
		'uses'=>'SettingController@UpdateSMTP',
		'as'  =>'updatesmtp',
		'title'=>'تحديث ال SMTP'
	]);

	# update sms
	Route::post('update-sms',[
		'uses'=>'SettingController@UpdateSmS',
		'as'  =>'updatesms',
		'title'=>'تحديث ال sms'
	]);

	# update onesignal
	Route::post('update-onesignal',[
		'uses'=>'SettingController@UpdateOneSignal',
		'as'  =>'updateonesignal',
		'title'=>'تحديث ال onesignal'
	]);

	# update fcm
	Route::post('update-fcm',[
		'uses'=>'SettingController@UpdateFCM',
		'as'  =>'updatefcm',
		'title'=>'تحديث ال fcm'
	]);

	# store dynamic setting
	Route::post('store-dynamic-setting',[
		'uses'=>'SettingController@StoreDynamicSetting',
		'as'  =>'storedynamicsetting',
		'title'=>'إضافة إعدادات إضافية'
	]);

	# update dynamic setting
	Route::post('update-dynamic-setting',[
		'uses'=>'SettingController@UpdateDynamicSetting',
		'as'  =>'updatedynamicsetting',
		'title'=>'تحديث إعدادات إضافية'
	]);

	# delete dynamic setting
	Route::post('delete-dynamic-setting',[
		'uses'=>'SettingController@DeleteDynamicSetting',
		'as'  =>'deletedynamicsetting',
		'title'=>'حذف إعدادات إضافية'
	]);

	# store social
	Route::post('store-socials',[
		'uses'=>'SettingController@Storesocial',
		'as'  =>'Storesocial',
		'title'=>'إضافة موقع'
	]);

	# update social
	Route::post('update-socials-media',[
		'uses'=>'SettingController@socialUpdate',
		'as'  =>'socialUpdate',
		'title'=>'تحديث موقع'
	]);

	# delete social
	Route::post('delete-socials',[
		'uses'=>'SettingController@Deletesocial',
		'as'  =>'Deletesocial',
		'title'=>'حذف موقع'
	]);

	#------------------------------- end of SettingController -----------------------------#
});
use App\City;
use  Illuminate\Support\Facades\Auth;
use  Illuminate\Support\Facades\File;

Route::get('dd',function(){

	Artisan::queue('view:clear');	
});
// Auth::routes();
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::get('admin/logout', 'Auth\LoginController@logout')->name('logout');
