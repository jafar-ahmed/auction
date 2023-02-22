<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Mail\ActivationCodeMail;
use App\Models\UserFcmToken;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     //  const GOOGLE_NOTIFICATION_KEY ='key=AAAA6y4tsgI:APA91bEi7eTERN7s-VycRdRVBMUGP0TDyFIw4D9Lpp-a3rJbOk3Yef8xFPJKie5ZYTZE3AOjU3GuP9a82zDNNP76tZowKknq3uvHRo8-G7WP7ZRUgsb_WfJon4A2s0x_P853Cm9g7sY0';// 'key=AAAAyVZwR24:APA91bGwO4afbV1KKiZdgoF6aI9hw0V5te_Wprs4hfxRVMPpi5HeGNLGlSITi7QwiURfFyNJ2147EyM5uUg-UVrD4hpFEDh32M0fd2_4XMcaaYpjnU2oke4s2SqiJtzfWBJh2I8HEiAz';
     const GOOGLE_NOTIFICATION_KEY ='key=AAAAh572IoQ:APA91bEMZZ3eKz6b8t0Rf4wwLyInTAPDOOUU5VwiO9oPA1PEvoEJox3SJR_-OIatDBjeVxhFKddt1jHIDdaJJuHgXv9WFluUeBiI_I4ve5VjDmsXhHMEeldzyRIcG1WLfrdZvRydBr6z';

     public static function result($status, $message, $status_code, $data = null /*[]*/)
     {
         $arr = array("status" => $status, "message" => $message, "status_code" => $status_code, 'items' => $data);
         return $arr;
     }
     public function resultWithVar($status, $message, $status_code, $result_name, $result_value)
     {
         $arr = array("status" => $status, "message" => $message, "status_code" => $status_code, $result_name => $result_value);
         return $arr;
     }
 
     public function resultWith2Var($status, $message, $status_code, $result1_name, $result1_value, $result2_name, $result2_value)
     {
         $arr = array("status" => $status, "message" => $message, "status_code" => $status_code, $result1_name => $result1_value, $result2_name => $result2_value);
         return $arr;
     }
 
     public function resultWith3Var($status, $message, $status_code, $result1_name, $result1_value, $result2_name, $result2_value, $result3_name, $result3_value)
     {
         $arr = array("status" => $status, "message" => $message, "status_code" => $status_code, $result1_name => $result1_value, $result2_name => $result2_value, $result3_name => $result3_value);
         return $arr;
     }
     public function resultWitharray($status, $message, $status_code, $data = [])
     {
         $arr = array("status" => $status, "message" => $message, "status_code" => $status_code, 'items' => $data);
         return $arr;
     }
     public function jsonResult($status, $message, $status_code, $server_status)
     {
         return response()->json(['status' => $status, 'message' => $message, 'status_code' => $status_code, 'items' => []], $server_status);
     }
 
     public function successMessage()
     {
         return response()->json($this->result(true, __('api.successMessage'), 200));
     }
 
     public function unexpectedMessage()
     {
         return response()->json($this->result(false, trans('api.Sorry: An unexpected error occurred: During this process'), 500));
     }
 
     public function notFoundMessage()
     {
         return response()->json($this->result(false, "لم يتم العثور على العنصر المحدد", 404));
 //        return response()->json($this->result(false, __('api.The item to be displayed could not be obtained'), 404));
     }
 
     public function webUnexpectedMessage()
     {
         return back()->with('danger', 'عذراً: حدث خلل أثناء عملية الإرسال، حاول في وقت لاحق.');
     }
 
     public function webSuccessMessage()
     {
         return back()->with('success', 'تمت العملية بنجاح');
     }
 
     public function webSuccessStoreAppMessage()
     {
         return back()->with('success', 'شكرا لك سيتم التواصل معك قريباً');
     }
 
     public function webNotFoundMessage()
     {
         return back()->with('warning', 'تعذر الحصول على الصفحة');
     }
 
 
     public function validatorErrorsToStringArray($validator)
     {
         $array = [];
         foreach ($validator->errors()->messages() as $key => $value) {
             foreach ($value as $message) {
                 array_push($array, $message);
             }
         }
         return $array;
     }
 
     public static function humanDate($date){
       return  \Carbon\Carbon::parse($date)->diffForHumans();
     }
     public function getPaginationLinks($pagination)
     {
         try {
             $pagination_data = [];
 
             $pagination_data["currentPage"] = $pagination->currentPage();
             $pagination_data["lastPage"] = $pagination->lastPage();
             $pagination_data["perPage"] = $pagination->perPage();
             $pagination_data["hasMorePages"] = $pagination->hasMorePages();
             $pagination_data["nextPageUrl"] = $pagination->nextPageUrl();
             $pagination_data["firstItem"] = $pagination->firstItem();
             $pagination_data["lastItem"] = $pagination->lastItem();
             $pagination_data["total"] = $pagination->total();
             $pagination_data["count"] = $pagination->count();
 
             return $pagination_data;
         } catch (\Exception $exception) {
             return null;
         }
     }
 
     public static function  timeAgo($date)//CONVERT TIMESTAMP TO STRING
     {
         if (empty($date)) {
             return trans('app.timeNotSpecified');
         }
 
         $periods = array(trans('second'), trans('minute'), trans('hour'), trans('day'), trans('week'), trans('month'), trans('year'), trans('decade'));
         $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
 
         $now = time();
         $unix_date = strtotime($date);
 
         // check validity of date
         if (empty($unix_date)) {
             return trans('invalidDate');
         }
 
         // is it future date or past date
         if ($now > $unix_date) {
             $difference = $now - $unix_date;
             $tense = trans('since');
 
         } else {
             $difference = $unix_date - $now;
             $tense = trans('formNow');
         }
 
         for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
             $difference /= $lengths[$j];
         }
 
         $difference = round($difference);
 
         if ($difference != 1) {
             $periods[$j] .= "";
         }
 
         return "{$tense} $difference $periods[$j]";
     }
 
     public static function arabicTimeAgo($date)//CONVERT TIMESTAMP TO STRING
     {
         if (empty($date)) {
             return 'الوقت غير محدد';
         }
 
         $periods = array('ثانية', 'دقيقة', 'ساعة', 'يوم', 'أسبوع', 'شهر', 'سنة', 'عقد');
         $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
 
         $now = time();
         $unix_date = strtotime($date);
 
         // check validity of date
         if (empty($unix_date)) {
             return 'صيغة غير صالحة للتاريخ';
         }
 
         // is it future date or past date
         if ($now > $unix_date) {
             $difference = $now - $unix_date;
             $tense = 'منذ';
 
         } else {
             $difference = $unix_date - $now;
             $tense = 'من الآن';
         }
 
         for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
             $difference /= $lengths[$j];
         }
 
         $difference = round($difference);
 
         if ($difference != 1) {
             $periods[$j] .= "";
         }
 
         return "{$tense} $difference $periods[$j]";
     }
     public static function arabicDate($date)//CONVERT TIMESTAMP TO STRING
     {
         if (empty($date)) {
             return 'التاريخ غير محدد';
         }
 
         $monthes = [
             "Jan" => "يناير",
             "Feb" => "فبراير",
             "Mar" => "مارس",
             "Apr" => "أبريل",
             "May" => "مايو",
             "Jun" => "يونيو",
             "Jul" => "يوليو",
             "Aug" => "أغسطس",
             "Sep" => "سبتمبر",
             "Oct" => "أكتوبر",
             "Nov" => "نوفمبر",
             "Dec" => "ديسمبر"
 
             ];
 
         $month = Carbon::parse($date)->format('M');
         $locale=app()->getLocale();
         $date = Carbon::parse($date)->format('M d');
 
 
         return $locale == 'ar' ? str_replace($month,$monthes[$month],$date) : $date;
     }
 
     public function sendActivationEmail($user)
     {
 
         try {
             $details = [
                 'name' => $user->name,
                 'actionURL' => url('/'),
                 'body' => 'This is Activation Email from BreadCom. The activation code is ' . $user->activation_code,
 
             ];
            // \Mail::to($user->email)->send(new ActivationCodeMail($details));
 
         } catch (\Exception $e) {
             //dd('d');
             return $this->unexpectedMessage();
         }
     }
     public static function now()
     {
         $now = Carbon::now();
         $now->setTimezone('Asia/Riyadh');
         $now->format('h:i:s a');
         return $now;
     }
 
     public function authApiID()
     {
         return Auth::guard('api')->user()->id;
     }
 
     public function authID()
     {
         return Auth::guard('web')->user()->id;
     }
     public function jsonResultWithVar($status, $message, $status_code, $result_name, $result_value, $server_status)
     {
         return response()->json(['status' => $status, 'message' => $message, 'status_code' => $status_code, $result_name => $result_value], $server_status);
     }
     public static function timeAgoMultipleLang($date)//CONVERT TIMESTAMP TO STRING
     {
         if (empty($date)) {
             return trans('app.timeNotSpecified');
         }
 
         $periods = array(trans('app.second'), trans('app.minute'), trans('app.hour'), trans('app.day'), trans('app.week'), trans('app.month'), trans('app.year'), trans('app.decade'));
         $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
 
         $now = time();
         $unix_date = strtotime($date);
 
         // check validity of date
         if (empty($unix_date)) {
             return trans('app.invalidDate');
         }
 
         // is it future date or past date
         if ($now > $unix_date) {
             $difference = $now - $unix_date;
             $tense = trans('app.since');
 
         } else {
             $difference = $unix_date - $now;
             $tense = trans('app.formNow');
         }
 
         for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
             $difference /= $lengths[$j];
         }
 
         $difference = round($difference);
 
         if ($difference != 1) {
             $periods[$j] .= "";
         }
 
         return "{$tense} $difference $periods[$j]";
     }
 
     public static function getStatusNameForApi($status, $user_lang)
     {
         try {
             if ($user_lang == "ar") {
                 $status_list = [ 'new' => 'جديد',
                     'preparing' => 'جاري التجهيز',
                     'accepted' => 'مقبول',
                     'delivering' => 'جاري التوصيل',
                     'delivered' => 'تم التسليم',
                     'cancelled' => 'ملغي',
                     'pending' => 'معلق',];
             } else {
                 $status_list = ['new' => 'New',
                     'preparing' => 'Preparing',
                     'accepted' => 'Accepted',
                     'delivering' => 'In delivery',
                     'delivered' => 'Delivered',
                     'cancelled' => 'Cancelled',
                     'pending' => 'Pending'];
             }
             return $status_list[$status];
         } catch (\Exception $exception) {
             return "حالة غير معروفة";
         }
     }
 
     public static function sendOrderNotificationWithUnreadCount($unread_count, $notification_id, $user_id, $notification_title, $notification_body, $model_name, $model_id, $order_number)
     {
         try {
             //set model name
             $data = [];
             $data["badge"] = $unread_count;
             $data["id"] = $notification_id;
             $data["model_name"] = $model_name;
             $data["model_id"] = $model_id;
             $data["order_number"] = $order_number;
             $data["title"] = $notification_title;
             $data["body"] = $notification_body;
             $data["click_action"] = 'order_details';
             //check if fcm_token does not empty
             $fcm_token = self::getFcmToken($user_id);
             if ($fcm_token) {
                 //check if fcm device type ios or android
                 try {
                     $url = 'https://fcm.googleapis.com/fcm/send';
                     $headers = ['Content-type' => 'application/json', 'Authorization' => self::GOOGLE_NOTIFICATION_KEY];
 
                     /*if ($fcm_token->device_type == "android") {
                         $body = ['to' => $fcm_token->fcm_token, 'priority' => 'high', 'notification' => ['title' => $notification_title, 'body' => $notification_body, 'sound' => 'default'], 'data' => $data];
                         //$body = ['to' => $fcm_token->fcm_token, 'data' => $data];
 
                         $client = new Client();
                         $client->post($url, ['body' => json_encode($body), 'headers' => $headers]);
                     } else {
                         //for ios*/
                   //  $body = ['to' => $fcm_token->fcm_token, 'priority' => 'high', 'notification' => ['title' => $notification_title, 'body' => $notification_body, 'sound' => 'default', 'badge' => $unread_count, 'click_action' => 'order_details'], 'data' => $data];
 
                     $client = new Client();
                     //$client->post($url, ['body' => json_encode($body), 'headers' => $headers]);
                     //return $request->getBody();
                     //return $request->getStatusCode();
                     //}
                 } catch (\Exception $exception) {
                     //do nothing
                     dd($exception->getMessage());
                 }
             }
         } catch (\Exception $exception) {
             //do nothing
             dd($exception->getMessage());
         }
     }
     public static function getFcmToken($user_id)
     {
         try {
            // $find_fcm_token = App\Http\Controllers\UserFcmToken::where('user_id', /*785*/ $user_id)->orderByDesc('created_at')->first();
            // return $find_fcm_token;
         } catch (\Exception $exception) {
             return ["fcmTokenNotFound"];
         }
     }
 
}
