<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Http\Requests\ContestRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View The HTML server response.
     */
    public function index()
    {
        $contests = Contest::has('payment')->with('submissions')->latest()->get();

        return view('contest.index', compact('contests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View The HTML server response.
     */
    public function create()
    {
        return view('contest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContestRequest $request The incoming HTTP client request.
     * @return RedirectResponse Response to redirect to the checkout.
     * @throws Exception Emits Exception in case of an error.
     */
    public function store(ContestRequest $request)
    {
        $contest = $request->user()->contests()->create($request->validated());

        $request->session()->put('contest', $contest);

        return redirect()->route('checkout.create', $contest);
    }

    /**
     * Display the specified resource.
     *
     * @param Contest $contest The contest to display.
     * @return RedirectResponse|View The HTML server response.
     */
    public function show(Contest $contest)
    {
        $contest->with('submissions');

        $submissions = $contest
            ->submissions()
            ->latest('order')
            ->with(['user', 'contest'])
            ->paginate(12);

        // Whether the rating and other components can still be edited.
        $locked = optional(auth()->user())->cant('manage', $contest) || $contest->finished;

        return view('contest.show', compact('contest', 'locked', 'submissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contest $contest
     * @return Response
     */
    public function edit(Contest $contest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Contest $contest
     * @return Response
     */
    public function update(Request $request, Contest $contest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contest $contest
     * @return Response
     */
    public function destroy(Contest $contest)
    {
        //
    }
}
