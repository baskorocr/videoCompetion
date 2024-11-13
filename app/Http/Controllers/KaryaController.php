<?php

namespace App\Http\Controllers;

use App\Models\vote;
use Illuminate\Http\Request;

class KaryaController extends Controller
{
    public function like($id)
    {

        $userNPK = auth()->user()->npk;

        // Check if there are any existing votes for the user
        $count = vote::where('idNPK', $userNPK)->count();

        if ($count == 0) {
            // Create a new vote if none exists
            vote::create([
                'idNPK' => $userNPK,
                'idKarya' => $id
            ]);
        } else {
            // Delete existing votes for this user
            vote::where('idNPK', $userNPK)->delete();
        }

        return redirect()->back();

    }



}