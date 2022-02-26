<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
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
        $user = auth()->user();
        $voteResult = Vote::where('user_id', $user->id)->first() ?? null;

        return Inertia::render('Dashboard', [
            'voteResult' => $voteResult,
        ]);
    }
}
