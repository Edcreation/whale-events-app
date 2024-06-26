<?php

namespace App\Http\Controllers;

use App\Models\UserTickets;
use Illuminate\Http\Request;

class UserTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tickets = UserTickets::where("user_id", $request->user_id)->orderBy("created_at","desc")->paginate(1);

        return response()->json($tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserTickets $userTickets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserTickets $userTickets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserTickets $userTickets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserTickets $userTickets)
    {
        //
    }
}
