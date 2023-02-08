<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LocalizationController extends Controller
{
    //
    public function swp($locale) {

        $availLocale = [
            'en'=>'en',
            'fr'=>'fr',
            'et'=>'et',
            'rw'=>'rw',
            'sw'=>'sw'
        ];
        // check for existing language
        if (array_key_exists($locale, $availLocale)) {
            session()->put('locale', $locale);
        }
        $ln = '';$url='';
        switch ($locale) {
            case 'en':
                $ln = 'ENGLISH';
                $url ='/global_assets/images/landing/GB.svg';
                break;
            case 'fr':
                $ln = 'FRENCH';
                $url ='/global_assets/images/landing/FR.svg';
                break;
            case 'sw':
                $ln = 'SWAHILI';
                $url ='/global_assets/images/landing/TZ.svg';
                break;
            case 'rw':
                $ln = 'KINYARWANDA';
                $url ='/global_assets/images/landing/RW.svg';
                break;
            case 'et':
                $ln = 'AMHARIC';
                $url ='/global_assets/images/landing/ET.svg';
                break;

            default:
                $ln = 'ENGLISH';
                $url ='/global_assets/images/landing/GB.svg';
                break;
        }
        return redirect()->back()->with(['ln'=>$ln, 'file'=>$url]);
     }
}
