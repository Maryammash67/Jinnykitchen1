<?php


namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Food;
use App\Models\Branch;
use App\Models\FoodBranch;
use App\Models\FoodAttribute;
use App\Models\Foodchef;
use App\Models\Adtodcart;
use App\Models\Purchase_history;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class SettingController extends Controller
{
    public function settings()
    {    
        $user = Auth::user();
        
        return view('user.setting',compact('user'));
    }
}
