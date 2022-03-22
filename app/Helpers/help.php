<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\SmsEmailNotification;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM as FCM;
use LaravelFCM\Message\Topics;

use App\User;
use App\Role;
use App\SiteSetting;
use App\Report;
use App\Client;
use App\Driver;





use App\Configuration;
use App\Notification;
use App\Inbox;
use App\Setting;


use App\Mail\ManagerMail;

// use Carbon;
// use DateTime;

use Illuminate\Support\Facades\DB;

function Home()
{
	
    $colors = [
    'bg-info',
    'bg-secondary',
    'bg-success',
    'bg-warning',
    'bg-danger',
    'bg-gray-dark',
    'bg-indigo',
    'bg-purple',
    'bg-fuchsia',
    'bg-pink',
    'bg-maroon',
    'bg-orange',
    'bg-lime',
    'bg-teal',
    'bg-olive',
    ];
    $home =[

        [
            'title' =>'عدد المشرفين',
            'count'=>User::count(),
            'icon' =>'<i class="fas fa-address-book"></i>',
            'color'=>$colors[array_rand($colors)],
            'route'=>'supervisors'
        ],

        [
            'title' =>'عدد العملاء',
            'count'=>Client::count(),
            'icon' =>'<i class="fas fa-address-book"></i>',
            'color'=>$colors[array_rand($colors)],
            'route'=>'home'
        ],

        [
            'title' =>'عدد السائقين',
            'count'=>Driver::count(),
            'icon' =>'<i class="fas fa-address-book"></i>',
            'color'=>$colors[array_rand($colors)],
            'route'=>'home'
        ],

        [
            'title' =>'عدد الصلاحيات',
            'count'=>Role::count(),
            'icon' =>'<i class="fas fa-biohazard"></i>',
            'color'=>$colors[array_rand($colors)],
            'route'=>'permissions'
        ]
      
    ];

    return $blocks[]=$home; 
}


#role name
function Role()
{
    $role = Role::findOrFail(Auth::user()->role);
    if($role)
    {
        return $role->role;
    }else{
        return 'عضو';
    }
}




# report
function MakeReport($event)
{
	$report = new Report;
    $report->user_id = Auth::user()->id;
    $report->event   = 'قام '.Auth::user()->name .' '.$event;
    $report->save();
}



#current route
function currentRoute()
{
    $routes = Route::getRoutes();
    foreach ($routes as $value)
    {
        if($value->getName() === Route::currentRouteName()) 
        {
            if(isset($value->getAction()['title']))
            {
                if(isset($value->getAction()['icon']))
                {
                    echo $value->getAction()['icon'].' '.$value->getAction()['title'] ;
                }else{
                    echo $value->getAction()['title'] ;
                }
                # echo $value->getAction()['icon'] ;
            }
            // return $value->getAction() ;
        }
    }
}

#email colors
function EmailColors()
{
    $html = Html::select('email_header_color','email_footer_color','email_font_color')->first();
    $setting = SiteSetting::first();
    return ['email'=>$html,'site_name'=>$setting->site_name_ar];
}

# generate uniqe code
function UniqCode(){
    $code = md5(uniqid(rand(), true));
    $array_code = str_split($code);
    return implode("",array_slice($array_code,22));
}

#setting and html
function SettingAndHtml()
{
    $setting = SiteSetting::first();
    $html    = Html::first();
    $SettingAndHtml = ['setting'=>$setting,'html'=>$html];
    return $SettingAndHtml;
}

function CustomerStatus($status)
{
    if($status == 0)
    {
        return '<span class="badge badge-danger">حظر</span>';
    }elseif($status == 1)
    {
        return '<span class="badge badge-success">نشط</span>';
    }
}

function AccountType($type,$front = false)
{
    if($type == 'person' && !$front)
    {
        return '<span class="badge badge-primary">فرد</span>';
    }elseif($type == 'firm' && !$front)
    {
        return '<span class="badge badge-warning">منشأة</span>';
    }

    if($type == 'person' && $front)
    {
        return 'فرد';
    }elseif($type == 'firm' && $front)
    {
        return 'منشأة';
    }
}

function UserType($type)
{
    if($type == 'user')
    {
        return '<span class="badge badge-success">مستخدم</span>';
    }elseif($type == 'provider')
    {
        return '<span class="badge badge-primary">مقدم خدمة</span>';
    }
}

function EditPhoneFormat($num)
{
    $num = str_split($num);
    if($num[0] != '9')
    {
        if($num[0] == '0' && $num[1] == '5')
        {
            array_shift($num);
            $num = '966'.implode($num);
            return $num;
		}elseif($num[0] == '0' && $num[1] == '0' && $num[2] == '9')
		{
			array_shift($num);
			array_shift($num);
            $num = implode($num);
            return $num;
		}elseif($num[0] == '0' && $num[1] == '9')
		{
			array_shift($num);
            $num = implode($num);
            return $num;
		}elseif($num[0] == '+' && $num[1] == '9')
		{
			array_shift($num);
            $num = implode($num);
            return $num;
		}elseif($num[0] == '5')
        {
            $num = '966'.implode($num);
            return $num;
        }else{
            return implode($num);
        }
    }else{
        return implode($num);
    }
}

function send_mobile_sms($numbers, $msg)
{
    $url = 'http://api.yamamah.com/SendSMS';
    $fields = array(
        "Username" => "966543956641",
        "Password" => "new#nagez&5454",
        "Message" => $msg,
        "RecepientNumber" => $numbers,
        "ReplacementList" => "",
        "SendDateTime" => "0",
        "EnableDR" => False,
        "Tagname" => "Nagez",
        "VariableList" => "0"
    );

    $fields_string = json_encode($fields);

    $ch = curl_init($url);
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => $fields_string
    ));
    $result = curl_exec($ch);
    curl_close($ch);
}

function OrderType($type,$front = true)
{
    if($type == 'custom')
    {
        if($front)
        {
            return 'مخصص';
        }else{
            return '<span class="badge badge-success">مخصص</span>';
        }
    }elseif($type == 'not_custom')
    {
        if($front)
        {
            return 'غير مخصص';
        }else{
            return '<span class="badge badge-primary">غير مخصص</span>';
        }
    }
}

function CalcOffer($offer)
{
    $setting  = Setting::first();
    $tax_rate = $setting->tax_rate;
    $app_rate = $setting->app_rate;
    $tax_price = round($offer * $tax_rate / 100,2);
    $app_price = round($offer * $app_rate / 100,2);

    return $arr = [
        'tax_rate'  => $tax_rate,
        'app_rate'  => $app_rate,
        'tax_price' => $tax_price,
        'app_price' => $app_price,
        'total'     => round($offer + $tax_price ,2),
        'profit'    => round($offer - $app_price ,2),
    ];
}

function SendNotification($noti,$customer_id = null,$provider_id = null,$order_id = null)
{
    # store notification
   $not = new Notification;
   $not->noti        = $noti;
   $not->customer_id = $customer_id;
   $not->provider_id = $provider_id;
   $not->order_id    = $order_id;
   $not->save();
}

function MainArticles()
{
    return Article::take(6)->get();
}

function OrderStatus($num)
{
    if($num == '0')
    {
        return 'طلب جديد';
    }elseif($num == '1')
    {
        return 'تم تقديم عروض';
    }elseif($num == '2')
    {
        return 'طلب جاري';
    }elseif($num == '3')
    {
        return 'طلب منتهي';
    }elseif($num == '4')
    {
        return 'طلب ملغي';
    }
}

function InboxUnreadCount()
{
    return Inbox::where('is_read',0)->count();
}