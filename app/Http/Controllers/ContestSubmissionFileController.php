<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContestSubmissionFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View The HTML server response.
     */
    public function index()
    {
        return view('contest.submission.files.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View The HTML server response.
     */
    public function create()
    {
        return view('contest.submission.files.create');
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
     * @param  \App\File  $sourceFile
     * @return View The HTML server response.
     */
    public function show(File $sourceFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $sourceFile
     * @return \Illuminate\Http\Response
     */
    public function edit(File $sourceFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $sourceFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $sourceFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $sourceFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $sourceFile)
    {
        //
    }
}
