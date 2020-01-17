<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Http\Requests\ContestSubmissionRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContestSubmissionController extends Controller
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
     * @param Contest $contest
     * @return View The HTML server response.
     */
    public function create(Contest $contest)
    {
        return view('submission.create', compact('contest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContestSubmissionRequest $request The incoming HTTP client request.
     * @return \Illuminate\Http\Response
     */
    public function store(ContestSubmissionRequest $request)
    {
        dd('Nice image');
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
