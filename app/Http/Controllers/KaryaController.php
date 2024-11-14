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
        $data = vote::where('idNPK', $userNPK)->first();


        if (is_null($data)) {
            vote::create([
                'idNPK' => $userNPK,
                'idKarya' => $id,
                'temp' => $id
            ]);
        } elseif ($data->count() == 1 && $id != $data->temp) {
            $data->delete();
            vote::create([
                'idNPK' => $userNPK,
                'idKarya' => $id,
                'temp' => $id,
            ]);
        } elseif ($data->count() == 1 && $id == $data->temp) {
            $data->delete();

        }

        return redirect()->route('home');

    }



}