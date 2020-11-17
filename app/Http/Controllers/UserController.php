<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Illuminate\Http\Request;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        //dd($user);
        return view('admin/user/user_list', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = User::all();
        return view('admin/user/user_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $valid_data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'image|required',
            'address' => 'required',
            'city' => 'required',
            'mobile' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
        ],
        [
            'image.mimes' => 'Please insert image only of png,jpg,jpeg format.'
        ]); 
        
        if($request->hasFile('image')){
            $getFilenameWithExt = $request->file('image')->getClientOriginalName();
            //get just Filename
            $filename = pathinfo($getFilenameWithExt, PATHINFO_FILENAME);
            //get just Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            //Upload the Image
            $path = $request->file('image')->storeAs('public/images/UserImages/', $filenameToStore);
        }else{
            $filenameToStore = 'Avatar.png';
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $filenameToStore;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->mobile = $request->phone;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->pincode = $request->pincode;
        $user->save();
        
        return redirect()->to('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // $user = User::find($id);
        return view('admin/user/user_edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($request->hasFile('image')){
            $getFilenameWithExt = $request->file('image')->getClientOriginalName();
            //get just Filename
            $filename = pathinfo($getFilenameWithExt, PATHINFO_FILENAME);
            //get just Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            //Upload the Image
            $path = $request->file('image')->storeAs('public/images/UserImages', $filenameToStore);            

            $user = User::findOrFail($user->id);
            $userImage = $user->image;
            if($userImage){
                File::delete('storage/images/UserImages/'.$userImage);
            }
        }else{
            $filenameToStore = 'Avatar.png';
        }
        //dd($request->image);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        //if($request->hasFile('image')) {
            $user->image = $filenameToStore;
        //}
        $user->address = $request->get('address');
        $user->mobile = $request->get('phone');
        $user->city = $request->get('city');
        $user->state = $request->get('state');
        $user->country = $request->get('country');
        $user->pincode = $request->get('pincode');
        $user->save();
        
        return redirect()->to('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    { 
        $user = User::findOrFail($user->id);
        $userImage = $user->image;
        if($userImage){
            File::delete('storage/images/UserImages/'.$userImage);
        }

        $user->delete($user->id); 
        return redirect()->to('user')->with('success','Data Deleted');
    }
}
