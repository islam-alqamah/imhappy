<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        // $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**

         * @get('/admin/permissions')
         * @name('admin.permissions.index')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $permissions = Permission::all(); //Get all permissions

        return view('admin.permissions.index')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**

         * @get('/admin/permissions/create')
         * @name('admin.permissions.create')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $roles = Role::get(); //Get all roles

        return view('admin.permissions.create')->with('roles', $roles);
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

         * @post('/admin/permissions')
         * @name('admin.permissions.store')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (! empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }

        session()->flash('alert', ['type' => 'success', 'message' => 'Permission '.$permission->name.' added']);

        return redirect()->route('admin.permissions.index');
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

         * @get('/admin/permissions/{permission}')
         * @name('admin.permissions.show')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        return redirect('permissions');
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

         * @get('/admin/permissions/{permission}/edit')
         * @name('admin.permissions.edit')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));
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
         * @uri('/admin/permissions/{permission}')
         * @name('admin.permissions.update')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $permission = Permission::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $input = $request->all();
        $permission->fill($input)->save();

        session()->flash('alert', ['type' => 'success', 'message' => 'Permission '.$permission->name.' updated']);

        return redirect()->route('admin.permissions.index');
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

         * @delete('/admin/permissions/{permission}')
         * @name('admin.permissions.destroy')
         * @middlewares(web, auth:sanctum, verified, auth)
         */
        $permission = Permission::findOrFail($id);

        //Make it impossible to delete this specific permission
        if ($permission->name == 'Administer roles & permissions') {
            session()->flash('alert', ['type' => 'error', 'message' => 'Permission '.$permission->name.' cannot be deleted']);

            return redirect()->route('admin.permissions.index');
        }

        $permission->delete();

        session()->flash('alert', ['type' => 'success', 'message' => 'Permission '.$permission->name.' deleted']);

        return redirect()->route('admin.permissions.index');
    }
}
