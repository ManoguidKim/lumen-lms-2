<?php

namespace App\Http\Controllers;

use App\Models\Learner;
use App\Models\User;
use Illuminate\Http\Request;

class LearnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $learner = User::where('id', auth()->user()->id)->first();
        return view('learner.index', compact('learner'));
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
    public function show(Learner $learner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Learner $learner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Learner $learner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Learner $learner)
    {
        //
    }
}
