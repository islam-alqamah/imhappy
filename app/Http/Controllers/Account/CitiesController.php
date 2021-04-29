<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Team;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        $cities = Team::find(currentTeam()->id)->cities;
        return view('account.cities',compact('cities'));
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|min:3',
        ]);
        $city = new City();
        $city->name = $request->name;
        $city->team_id = currentTeam()->id;
        $city->save();
        return back();
    }
}
