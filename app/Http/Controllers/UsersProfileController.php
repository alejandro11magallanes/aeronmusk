<?php

namespace App\Http\Controllers;

use App\Models\UsersProfile;
use App\Http\Requests\StoreUsersProfileRequest;
use App\Http\Requests\UpdateUsersProfileRequest;

class UsersProfileController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUsersProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersProfileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsersProfile  $usersProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UsersProfile $usersProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsersProfile  $usersProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersProfile $usersProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersProfileRequest  $request
     * @param  \App\Models\UsersProfile  $usersProfile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersProfileRequest $request, UsersProfile $usersProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsersProfile  $usersProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsersProfile $usersProfile)
    {
        //
    }
}
