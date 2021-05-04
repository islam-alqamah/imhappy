<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\TeamSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        $settings = TeamSetting::where('team_id',currentTeam()->id)->first();
        return view('account.settings',compact('settings'));
    }

    public function save(Request $request){
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $settings = TeamSetting::find($request->id);
        $settings->company_name = $request->name;
        $settings->address = $request->address;
        $settings->phone = $request->phone;
        $settings->fax = $request->fax;
        if($request->file('logo')){
            $file = $request->file('logo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/logos/'), $fileName);
            $settings->logo = 'images/logos/'.$fileName;
        }
        $settings->reporting_email = $request->reporting_email;
        $settings->telegram = $request->telegram;
        $settings->response_time_delay = $request->response_time_delay;
        $settings->facebook = $request->facebook;
        $settings->youtube = $request->youtube;
        $settings->instagram = $request->instagram;
        $settings->save();
        return back()->with(['status'=>'success','msg'=>'Data Saved']);
    }
    public function profile(){
        return view('account.profile');
    }
}
