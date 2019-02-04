<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointments;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class AlumniController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carbon = new Carbon();
        $accesslevel = \Auth::user()->accesslevel;
        $bDate = $carbon->startOfDay();
        $userType = ($accesslevel == 3) ? 'a_id' : 's_id';
        $values = Appointments::where($userType, \Auth::user()->id)
            ->where('date', '>', $bDate)
            ->where('date', '<', $carbon->copy()->addDays(7)->endOfDay())
            ->get(['*']);

        $usersData = User::all(['id','name']);


        if ($accesslevel == 3)
            $url = '/alumnisumit';
        else
            $url = '/submit';


        return view('schedule', ['values' => $values, 'accesslevel' => $accesslevel, 'url' => $url,'userData'=>$usersData]);
    }

    public function update()
    {
        Appointments::whereIn('id', Input::get('selectedRow'))
            ->where('is_approved', 0)
            ->where('a_id', \Auth::user()->id)
            ->update(['is_approved' => Input::get('action')]);
        return redirect()->back();
    }


}
