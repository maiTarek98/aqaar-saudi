<?php
namespace App\Http\Controllers\Api\V1\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponses;
use App\Http\Resources\Api\Home\ContactResource;
use App\Models\GeneralSettings;
use App\Models\SocialSettings;

use Validator;
class MainController extends Controller
{
    use ApiResponses;
   
    public function getSetting(GeneralSettings $settings,SocialSettings $social_settings)
    {
        $data= [
          'whatsapp_phone'  =>  $settings->whatsapp_phone,
          'mobile'          =>  $settings->phone,
          'website_link'    =>  url('/'),
          'facebook_link'   =>  $social_settings->facebook_link,
          'instagram_link'  =>  $social_settings->instagram_link,
          ];
        return $this->successResponse($data,__('api.get setting')); 
    }
    
}
