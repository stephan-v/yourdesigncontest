<?php

namespace App\Http\Controllers;

use App\Contest;
use App\File;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use STS\ZipStream\ZipStream;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ContestFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Contest $contest The contest which the submission belongs to.
     * @param ZipStream $zip The ZipStream instance.
     * @return ZipStream Build the Zip file in memory as a stream.
     */
    public function zip(Contest $contest, ZipStream $zip)
    {
        // @TODO make sure only the contest owner can access this.

        $files = $contest->files->map->publicPath;

        return $zip->create("source-files.zip", $files->toArray());
    }

    /**
     * Display a listing of the resource.
     *
     * @param Contest $contest The contest which the submission belongs to.
     * @return View The HTML server response.
     * @throws AuthorizationException Thrown if the user is not allowed to view winning source files.
     */
    public function index(Contest $contest)
    {
        $this->authorize('viewAnySourceFiles', $contest);

        $contest->load('files');

        return view('contest.files.index', compact('contest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View The HTML server response.
     */
    public function create()
    {
        return view('contest.files.create');
    }

    /**
     * Display the specified resource.
     *
     * @param Contest $contest The contest which the submission belongs to.
     * @param File $file The file to download.
     * @return BinaryFileResponse The download response.
     * @throws AuthorizationException Thrown if the user is not allowed to view winning source files.
     */
    public function show(Contest $contest, File $file)
    {
        $this->authorize('viewAnySourceFiles', $contest);

        $path = storage_path("app/public/{$file->path}");

        return response()->download($path);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param File $sourceFile
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
     * @param File $sourceFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $sourceFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param File $sourceFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $sourceFile)
    {
        //
    }
}
