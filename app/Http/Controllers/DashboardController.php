<?php

namespace App\Http\Controllers;

use App\Helpers\VoteItems;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Dashboard', [
            'alreadyVoted' => auth()->user()->voted,
            'voteItems' => array_keys(VoteItems::LIST)
        ]);
    }
}
