<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Type;
use App\Models\User;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function welcome(Request $request)
    {
        $users = User::all();
        $typeId = $request->type_id;
        $categories = Type::orderBy('name', 'asc')->get();
        $projects = $typeId ? Project::where('type_id', $typeId)->get() : Project::all();

        // Carica la vista con i progetti filtrati
        return view('welcome', compact('projects', 'categories', 'users'))->with('typeId', $typeId);
    }

    public function index(Request $request)
    {

        $typeId = $request->type_id;

        $categories = Type::orderBy('name', 'asc')->get();
        $projects = $typeId ? Project::where('type_id', $typeId)->get() : Project::all();

        return view('admin.projects.index', compact('projects', 'categories'))->with('typeId', $typeId);
    }

    // public function showProjectsByUser($userId)
    // {

    //     $user = User::find($userId);
    //     $projects = $user->projects;

    //     return view('admin.user_projects', compact('projects'));
    // }

    public function showProjectsByUser()
    {
        $user = Auth::user();
        $projects = $user->projects;

        return view('admin.projects.user_projects', compact('projects'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId =  Auth::id();
        $categories = Type::orderBy('name', 'asc')->get();
        $technologies = Technology::orderBy('name', 'asc')->get();
        return view('admin.projects.create', compact('categories', 'technologies', 'userId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $base_slug = Str::slug($form_data['title']);
        $slug = $base_slug;
        // dd($form_data, $slug);
        $n = 0;

        do {
            // SELECT * FROM `posts` WHERE `slug` = ?
            $find = Project::where('slug', $slug)->first(); // null | Post

            if ($find !== null) {
                $n++;
                $slug = $base_slug . '-' . $n;
            }
        } while ($find !== null);

        $form_data['slug'] = $slug;
        $new_project = Project::create($form_data);

        // controlliamo se sono stati inviati dei tags
        if ($request->has('technologies')) {
            // $post->tags()->attach($form_data['tags']);
            $new_project->technologies()->attach($form_data['technologies']);
        }

        //dd($form_data);
        //dd($new_project);
        $new_project->save();

        return to_route('admin.projects.index', $new_project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $categories = Type::orderBy('name', 'asc')->get();
        $project->load('technologies', 'technologies.projects',);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $project->load(['technologies']);
        $categories = Type::orderBy('name', 'asc')->get();
        $technologies = Technology::orderBy('name', 'asc')->get();
        return view('admin.projects.edit', compact('categories', 'project', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        $form_data = $request->validated();

        $project->update($form_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            // l'utente non ha selezionato niente eliminiamo i collegamenti con i tags
            $project->technologies()->detach();
            // $post->tags()->sync([]); // fa la stessa cosa
        }

        return to_route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index');
    }
}
