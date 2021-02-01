<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckContestPayment;
use App\Models\Contest;
use App\Http\Requests\ContestRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ContestController extends Controller
{
    /**
     * ContestController constructor.
     */
    public function __construct() {
        $this->middleware(CheckContestPayment::class)->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request The incoming HTTP request.
     * @return View The HTML server response.
     */
    public function index(Request $request)
    {
        $request->session()->forget('contest');

        $contests = Contest::has('payment')
            ->with('submissions')
            ->orderBy('expires_at')
            ->paginate(10);

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
        $request->session()->put('contest', $request->validated());

        return redirect()->route('checkout.create');
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

        // Submissions without the winner.
        $submissions = $contest
            ->submissions()
            ->withTrashed()
            ->orderByDesc('winner')
            ->orderByDesc('rating')
            ->latest('order')
            ->with(['user', 'contest'])
            ->paginate(15);

        // Whether the rating and other components can still be edited.
        $locked = optional(auth()->user())->cant('manage', $contest) || $contest->expired;

        return view('contest.show', compact('contest', 'locked', 'submissions'));
    }
}
