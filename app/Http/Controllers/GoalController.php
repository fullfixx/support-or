<?php

namespace App\Http\Controllers;

use App\Http\Requests\Goal\StoreRequest;
use App\Http\Resources\Goal\GoalResource;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goals = Goal::all();
        $goals = GoalResource::collection($goals);
        return Inertia::render('Goal/Index', compact('goals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Goal::create($request->validated());
        return redirect()->route('goal.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Goal $goal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Goal $goal)
    {
        $goal->tasks()->delete();
        $goal->delete();
        return redirect()->route('goal.index');
    }
}
