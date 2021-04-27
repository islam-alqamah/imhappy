<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        // $this->middleware(['auth', 'isAdmin']);//isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**

         * @get('/admin/roles')
         * @name('admin.roles.index')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $roles = Role::all(); //Get all roles

        return view('admin.roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**

         * @get('/admin/roles/create')
         * @name('admin.roles.create')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $permissions = Permission::all(); //Get all permissions

        return view('admin.roles.create', ['permissions'=>$permissions]);
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

         * @post('/admin/roles')
         * @name('admin.roles.store')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        //Validate name and permissions field
        $this->validate($request, [
            'name'=>'required|unique:admin.roles|max:10',
            'permissions' =>'required',
            ]
        );

        $name = $request['name'];
        $role = new Role();
        $role->name = $name;

        $permissions = $request['permissions'];

        $role->save();
        //Looping thru selected permissions
        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            //Fetch the newly created role and assign permission
            $role = Role::where('name', '=', $name)->first();
            $role->givePermissionTo($p);
        }

        session()->flash('alert', ['type' => 'success', 'message' => 'Role '.$role->name.' added']);

        return redirect()->route('admin.roles.index');
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

         * @get('/admin/roles/{role}')
         * @name('admin.roles.show')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        return redirect('roles');
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

         * @get('/admin/roles/{role}/edit')
         * @name('admin.roles.edit')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
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
         * @uri('/admin/roles/{role}')
         * @name('admin.roles.update')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $role = Role::findOrFail($id); //Get role with the given id
        //Validate name and permission fields
        $this->validate($request, [
            'name'=>'required|max:10|unique:admin.roles,name,'.$id,
            'permissions' =>'required',
        ]);

        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];
        $role->fill($input)->save();

        $p_all = Permission::all(); //Get all permissions

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
            $role->givePermissionTo($p);  //Assign permission to role
        }

        session()->flash('alert', ['type' => 'success', 'message' => 'Role '.$role->name.' updated']);

        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /**

         * @delete('/admin/roles/{role}')
         * @name('admin.roles.destroy')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $role = Role::findOrFail($id);
        $role->delete();

        session()->flash('alert', ['type' => 'success', 'message' => 'Role '.$role->name.' deleted']);

        return redirect()->route('admin.roles.index');
    }
}
