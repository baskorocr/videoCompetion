<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all Karya records from the database
        $artworks = Karya::all();


        foreach ($artworks as $artwork) {
            $artwork->thumbnail_url = $this->getYouTubeThumbnail($artwork->link);  // Menyimpan URL thumbnail di setiap artwork
        }

        // Pass the Karya data to the view
        return view('welcome', compact('artworks'));
    }


    private function getYouTubeThumbnail($url) {
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
