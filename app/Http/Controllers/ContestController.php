<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response The HTML server response.
     */
    public function index()
    {
        $contests = Contest::all();

        return view('contest.index', compact('contests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response The HTML server response.
     */
    public function create()
    {
        return view('contest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function edit(Contest $contest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest)
    {
        //
    }
}
