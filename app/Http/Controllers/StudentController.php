<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointments;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $options = [
            "1pm-2pm" => 13,
            "4pm-5pm" => 16,
            "6pm-7pm" => 18
        ];

        $users = User::where('accesslevel', 3)->get(['id', 'name']);

        $carbon = new Carbon();
        $initail = $carbon::now()->addDays(1)->toDateString();
        $final = $carbon::now()->addDays(7)->toDateString();

        return view('list', ['options' => $options, 'a_id' => $users,'initial'=>$initail,'final'=>$final]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store1(Request $request)
    {
        $carbon = new Carbon($request->getDate);
        $carbon->hour = $request->getSlot;
        $a_id = $request->userData;
        $s_id = \Auth::user()->id;
        $post = new Appointments();

        $carbonActual = new Carbon();

        $totalAppmt = Appointments::where('a_id', $a_id)
            ->where('s_id', $s_id)
            ->where('is_approved', '>', -1)
            ->where('date', '>', $carbonActual->startOfDay())
            ->where('date', '<', $carbonActual->copy()->addDays(7)->endOfDay())
            ->get(['is_approved', 'date']);


        if ($totalAppmt->contains('date', $carbon)) {
            return redirect('\schedule')->withErrors(["Request already exist!!!"]);
        }

        if ($totalAppmt->contains('is_approved', 0)) {
            return redirect('\schedule')->withErrors(["Request is pending!!!"]);
        }


        if ($totalAppmt->count() > 1) {
            return redirect('\schedule')->withErrors(["Request limit Exceed!!!!!!"]);
        }


        $post->s_id = $s_id;
        $post->a_id = $a_id;
        $post->is_approved = 0;
        $post->date = $carbon;

        $post->save(['*']);

        return redirect('\schedule');

    }

    public function userData(){


    }

}
