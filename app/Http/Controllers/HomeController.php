<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use App\Models\transaction;
use App\Models\vote;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $check = auth()->check() ? vote::where('idNPK', auth()->user()->npk)->count() : 0;
        // Fetch all Karya records from the database
        $isUserAuthenticated = auth()->user() && auth()->user()->npk ? auth()->user()->npk : '';
        $artworks = Karya::withSum([
            'transactions' => function ($query) {
                $query->where('status', 'paid'); // Only count transactions with 'paid' status
            }
        ], 'total_amount')  // Sum of total_amount
            ->withCount([
                'transactions as total_donations' => function ($query) {
                    $query->where('status', 'paid'); // Only count transactions with 'paid' status
                },
                'votes as total_votes'  // Count the votes for each artwork
            ])  // Count votes along with transactions
            ->selectRaw('
        (SELECT COUNT(*) FROM votes WHERE votes.idNPK = ? AND votes.idKarya = karyas.id) as user_votes,
        (SELECT temp FROM votes WHERE votes.idNPK = ? AND votes.idKarya = karyas.id LIMIT 1) as temp
    ', [$isUserAuthenticated, $isUserAuthenticated])  // Subquery for both user_votes and temp with user filter
            ->orderBy('title', 'asc')  // Order by title ascending
            ->get();

        $totalDonator = transaction::where('status', 'paid')->count();

        $totalAmountSum = transaction::where('status', "paid")->sum('total_amount');







        foreach ($artworks as $artwork) {
            $artwork->thumbnail_url = $this->getYouTubeThumbnail($artwork->link);  // Menyimpan URL thumbnail di setiap artwork
        }



        // Pass the Karya data to the view
        return view('welcome', compact('artworks', 'totalDonator', 'totalAmountSum', 'check'));
    }


    private function getYouTubeThumbnail($url)
    {
        // Mengambil ID video dari URL YouTube
        preg_match("/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*\?v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i", $url, $matches);

        // Jika ID video ditemukan
        if (isset($matches[1])) {
            $videoId = $matches[1];

            // Menyusun URL thumbnail
            $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";

            return $thumbnailUrl;
        } else {
            return "Invalid YouTube URL"; // Jika URL tidak valid
        }
    }

}