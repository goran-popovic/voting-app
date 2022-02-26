<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessVote;
use App\Models\User;
use App\Models\Vote;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Stevebauman\Location\Facades\Location;

class VoteController extends Controller
{
    /**
     * Handle an incoming store request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'vote' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $voteExists = Vote::where('user_id', $user->id)->first();

        if(!$voteExists) {
            $location = ($position = Location::get())
                ? $position->countryName
                : "Unknown Location";

            ProcessVote::dispatch([
                'user' => $user,
                'vote_result' => $request->vote,
                'ip_address' => $request->ip(),
                'location' => $location,
            ]);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
