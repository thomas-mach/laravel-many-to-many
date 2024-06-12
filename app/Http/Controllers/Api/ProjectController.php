<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // $results = Project::all();
        $results = Project::with('technologies', 'type')->get();

        // $per_page = $request->perPage ?? 12;
        // $results = Post::with('category', 'tags', 'user')->paginate(9);

        return response()->json([
            // 'project' => $project
            'results' => $results
        ]);
    }
}
