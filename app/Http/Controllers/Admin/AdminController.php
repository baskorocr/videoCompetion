<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karya;

class AdminController extends Controller
{

    public function index()
    {
        $karyas = Karya::all();
        return view('admin.index', compact('karyas'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|url',
        ]);

        Karya::create($request->all());

        return redirect()->route('admin.index')->with('success', 'Karya created successfully.');
    }

    public function show(Karya $karya)
    {

        $youtube = $this->getYouTubeVideoId($karya->link);
        return view('users.karya', compact('karya', 'youtube'));
    }

    private function getYouTubeVideoId($url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        $videoId = $query['v'] ?? null;

        if ($videoId) {
            return "https://www.youtube.com/embed/" . $videoId;
        }

        return null;
    }

    public function edit(Karya $karya)
    {
        return view('admin.edit', compact('karya'));
    }

    public function update(Request $request, Karya $karya)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|url',
        ]);

        $karya->update($request->all());

        return redirect()->route('admin.index')->with('success', 'Karya updated successfully.');
    }

    public function destroy(Karya $karya)
    {
        $karya->delete();

        return redirect()->route('admin.index')->with('success', 'Karya deleted successfully.');
    }
}