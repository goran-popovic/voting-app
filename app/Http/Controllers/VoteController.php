<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessVote;
use Illuminate\Http\Request;
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

        if(!$user->voted) {
            $location = ($position = Location::get())
                ? $position->countryName
                : "Unknown Location";

            ProcessVote::dispatch([
                'user' => $user,
                'vote_result' => $request->vote,
                'ip_address' => $request->ip(),
                'location' => $location,
            ]);

            $user->update([
                'voted' => true
            ]);

            return back();
        }

        return back()->withErrors('You can vote only once.');
    }
}
