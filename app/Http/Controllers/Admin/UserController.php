<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\subscribe;
use App\Models\Team;
use App\Models\TeamSetting;
use App\Models\User;
use App\Permission;
use Carbon\Carbon;
use Illuminate\Http\Request;
//Enables us to output flash messaging
use Session;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**

         * @get('/admin/users')
         * @name('admin.users.index')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $users = User::all();
        $plans = Plan::all();
        return view('admin.users.index',compact('plans'))->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**

         * @get('/admin/users/create')
         * @name('admin.users.create')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $roles = Role::all();

        return view('admin.users.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**

         * @post('/admin/users')
         * @name('admin.users.store')
         * @middlewares(web, auth:sanctum, verified, auth)
         */

        //Validate name, email and password fields
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
        ]);



        $user = User::create(['name'=> $request->name, 'email' => $request->email, 'password' => bcrypt($request->password)]);
        $user->email_verified_at = Carbon::now()->format('Y-m-d');
        $user->save();
        $this->createTeam($user);
        if($request->plan_id) {
            $subscribe = new subscribe;
            $subscribe->user_id = $user->id;
            $subscribe->team_id = $user->team->id;
            $subscribe->plan_id = $request->plan_id;
            $subscribe->subscribed_by = auth()->user()->name;
            $subscribe->payment_id = 0;
            $subscribe->starts_at = Carbon::now()->format('Y-m-d');
            $subscribe->ends_at = Carbon::now()->addMonth()->format('Y-m-d');
            $subscribe->save();
        }
        $roles = $request['roles']; //Retrieving the roles field

        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }

        session()->flash('alert', ['type' => 'success', 'message' => 'User added']);
        return redirect()->route('admin.users.index');
    }

    protected function createTeam(User $user)
    {


        $trial_days = null;
        if (config('saas.trial_days') !== null) {
            $trial_days = now()->addDays(config('saas.trial_days'));
        }
        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'",
            'personal_team' => true,
            // Create trials period for the new team created
            'trial_ends_at' => $trial_days,
        ]);
        $user->ownedTeams()->save($team);
        $settings = new TeamSetting();
        $settings->team_id = $team->id;
        $settings->company_name = $user->name;
        $settings->logo = 'images\logos\default.png';
        $settings->reporting_email = $user->email;
        $settings->telegram = '-group_id';
        $settings->facebook = '#';
        $settings->youtube = '#';
        $settings->instagram = '#';
        $settings->save();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /**

         * @get('/admin/users/{user}')
         * @name('admin.users.show')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $user = User::find($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**

         * @get('/admin/users/{user}/edit')
         * @name('admin.users.edit')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles
        $plans = Plan::all();
        return view('admin.users.edit', compact('plans','user', 'roles')); //pass user and roles data to view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**

         * @methods(PUT, PATCH)
         * @uri('/admin/users/{user}')
         * @name('admin.users.update')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $user = User::findOrFail($id); //Get role specified by id

        //Validate name, email and password fields
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            // 'password'=>'required|min:6|confirmed'
        ]);
        $input = $request->only(['name', 'email']); //Retreive the name, email and password fields
        $roles = $request['roles']; //Retreive all roles
        $user->fill($input)->save();

        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        } else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        if($request->plan_id) {
            $subscribe = new subscribe;
            $subscribe->user_id = $user->id;
            $subscribe->team_id = $user->team->id;
            $subscribe->plan_id = $request->plan_id;
            $subscribe->subscribed_by = auth()->user()->name;
            $subscribe->payment_id = 0;
            $subscribe->starts_at = Carbon::now()->format('Y-m-d');
            $subscribe->ends_at = Carbon::now()->addMonth()->format('Y-m-d');
            $subscribe->save();
        }
        notify()->success('User has been updated');

        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggle($id){
        $user = User::find($id);
        $user->active = !$user->active;
        $user->updated_by = auth()->user()->name;
        $user->save();
        return back();
    }
    public function invoice($payment_id){
        $payment = Payment::find($payment_id);
        return view('admin.invoice', compact('payment'));
    }
    public function destroy($id)
    {
        /**

         * @delete('/admin/users/{user}')
         * @name('admin.users.destroy')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        //Find a user with a given id and delete
        $user = User::findOrFail($id);

        // do not delete super-admin user or is an admin
        if (($user->email == env('SUPER_ADMIN_EMAIL')) || $user->hasRole('admin')) {
            session()->flash('alert', ['type' => 'danger', 'message' => 'Not allowed to delete this user']);

            return redirect()->route('admin.users.index');
        } else {
            $user->delete();

            notify()->success('User has been deleted');

            return redirect(route('admin.users.index'));
        }
    }
}
