<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\Social;

class SettingController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth']);
    }

    public function edit(){
        return view('setting', [
           'user' => auth()->user()
        ]);
    }

    public function update(UpdateSettingRequest $request,Social $social){
        $request->user()->updateSettings($request->getData());
        //  dd($request->all());

         return back()->with('message', 'Your Changes have been saved');
    }
}
