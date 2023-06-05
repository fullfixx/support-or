<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\StoreRequest;
use App\Models\File;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Ticket $ticket)
    {
        return Inertia::render('File/Create', compact('ticket'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Ticket $ticket)
    {
        $data = $request->validated();
        $files = $data['files'];
        foreach ($files as $file) {
            $name = Carbon::now() . '-' . $file->hashName() . '.' . $file->extension();
            $filePath = Storage::disk('public')->putFileAs('/files', $file, $name);
            File::create([
                'path' => url('/storage/' . $filePath),
                'ticket_id' => $data['ticket_id'],
            ]);

        }
        return redirect()->route('ticket.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }
}
