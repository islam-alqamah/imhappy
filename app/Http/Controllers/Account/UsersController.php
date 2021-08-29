<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\subscribe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index(){
        $users = User::where('current_team_id',currentTeam()->id)->where('type','team_member')->get();
        return view('account.users.index',compact('users'));
    }
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
        return view('account.users.edit', compact('plans','user', 'roles')); //pass user and roles data to view
    }
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
        ]);
        $user->name = $request->name;
        if(isset($request->password))
            $user->password = bcrypt($request->password);
        $user->user_permissions = json_encode($request->permissions);
        $user->save();

        notify()->success('User has been updated');

        return back();
    }
    public function store(Request $request)
    {
        /**

         * @post('/account/users')
         * @name('account.users.store')
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
        $user->current_team_id = currentTeam()->id;
        $user->type = 'team_member';
        $user->user_permissions = json_encode($request->permissions);
        $user->save();
        $roles = $request['roles']; //Retrieving the roles field

        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }

        session()->flash('alert', ['type' => 'success', 'message' => 'User added']);
        return redirect()->route('account.users');
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
    public function toggle($id){
        $user = User::find($id);
        $user->active = !$user->active;
        $user->updated_by = auth()->user()->name;
        $user->save();
        return back();
    }
}
