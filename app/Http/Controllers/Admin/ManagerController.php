<?php

namespace App\Http\Controllers\Admin;

use App\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManagerController extends IndexController
{
    public function __invoke()
    {
        $view = view('admin.manager_list');
        $managers = Manager::paginate();
        $view->with('managers', $managers);
        $view->with('title', 'Managers list');
        return $view;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.manager_create');
        $view->with('title', 'New manager');
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email|unique:managers',
            'password'  => 'required|string|confirmed|size:6',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('managers.create')->withErrors($validator)->withInput();
        }

        $manager = new Manager();
        $manager->name = $request->get('name');
        $manager->email = $request->get('email');
        $password = $request->get('password');
        if (!empty($password)) {
            $manager->password = Hash::make($password);
        }
        $manager->enabled = $request->filled('enabled');
        $manager->save();

        $file = $request->file('photo');
        if (null != $file) {
            $manager->saveImage($file);
        }
        return redirect()->route('managers.edit', ['id'=>$manager->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Manager $manager)
    {
        $view = view('admin.manager_edit');
        $view->with('title', $manager->name);

        $er = $request->session()->get('errors');
        if (!empty($er)) {
            $manager->name = $request->old('name');
            $manager->email = $request->old('email');
            $manager->enabled = (bool)$request->old('enabled');
        }

        $view->with('manager', $manager);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email|unique:managers,email,'.$manager->id,
            'password'  => 'string|nullable|confirmed|size:6',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('managers.edit', ['id'=>$manager->id])->withErrors($validator)->withInput();
        }

        $manager->name = $request->get('name');
        $manager->email = $request->get('email');
        $password = $request->get('password');
        if (!empty($password)) {
            $manager->password = Hash::make($password);
        }
        $manager->enabled = $request->filled('enabled');
        $manager->save();

        if ($request->get('delete_photo')) {
            $manager->deleteImage();
        }
        $file = $request->file('photo');
        if (null != $file) {
            $manager->saveImage($file);
        }
        return redirect()->route('managers.edit', ['id'=>$manager->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        Manager::destroy($manager->id);
        return redirect(url()->previous());
    }
}
