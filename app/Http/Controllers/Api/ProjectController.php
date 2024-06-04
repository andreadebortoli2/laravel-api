<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {

        $projects = Project::with('type', 'technologies')->orderByDesc('id')->paginate(6);

        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }

    public function show($slug)
    {
        $single_project = Project::with('type', 'technologies')->where('slug', $slug)->first();

        if ($single_project) {
            return  response()->json([
                'success' => true,
                'project' => $single_project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'project' => '404'
            ]);
        }
    }
}
