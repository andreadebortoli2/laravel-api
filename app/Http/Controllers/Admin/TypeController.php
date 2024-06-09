<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Project;
use Illuminate\Support\Str;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.types.index', ['types' => Type::paginate()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $validated = $request->validated();

        $slug = Str::slug($request->name, '-');
        $validated['slug'] = $slug;
        Type::create($validated);

        return to_route('admin.types.index')->with('status', "$request->name - Type created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        $projects = Project::where('type_id', $type->id)->get();
        return view('admin.types.show', compact('type', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($request->name, '-');

        $type->update($validated);

        return to_route('admin.types.index')->with('status', "$request->name - Type successfully edited");
    }

    public function filter(Type $type)
    {
        /* dd(Type::all(), $type); */
        // $projects = Project::where('type_id', $type->id)->get();
        return view('admin.types.filter', compact('type'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return back()->with('status', "$type->name - Type deleted");
    }
}
