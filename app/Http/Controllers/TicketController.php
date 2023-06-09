<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\StoreRequest;
use App\Http\Requests\Ticket\UpdateRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\File\FileResource;
use App\Http\Resources\Ticket\TicketResource;
use App\Jobs\TelegramNotificationJob;
use App\Models\Comment;
use App\Models\File;
use App\Models\Status;
use App\Models\Ticket;
use Carbon\Carbon;
//use Illuminate\Http\Request;  // it was changed for Request::input() from index()
use Illuminate\Support\Facades\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use function League\Flysystem\deleteDirectory;
use function League\Flysystem\get;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $tickets = Ticket::orderBy('created_at', 'desc')->get();
//        $tickets = TicketResource::collection($tickets);

//        $tickets = Ticket::orderBy('created_at', 'desc')->paginate(5);
        $tickets = Ticket::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('description', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%");
            })
            ->orderBy('status_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
//        $tickets = TicketResource::collection($tickets)->resolve();
        $tickets = TicketResource::collection($tickets);

//        $tickets = Ticket::orderBy('created_at', 'desc')->paginate(5); // is visible! but isn't work! and without Resource
        $filters = Request::only('search');

        return Inertia::render('Ticket/Index', compact('tickets', 'filters'));
    }

    public function indexGroup($status_id)
    {
        $tickets = Ticket::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('description', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%");
            })
            ->where('status_id', '=', $status_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $tickets = TicketResource::collection($tickets);
        $filters = Request::only('search');

        return Inertia::render('Ticket/Index', compact('tickets', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::all();
        return Inertia::render('Ticket/Create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $files = $data['files'];
        unset($data['files']);
        $ticket = Ticket::create($data);

        foreach ($files as $file) {
            $name = Carbon::now() . '-' . $file->hashName() . '.' . $file->extension();
            $filePath = Storage::disk('public')->putFileAs('/files', $file, $name);
            File::create([
                'path' => url('/storage/' . $filePath),
                'ticket_id' => $ticket->id,
            ]);

        }

        dispatch(new TelegramNotificationJob(543172626, $ticket));
        return redirect()->route('ticket.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $ticket = new TicketResource($ticket);
//        $comments = Comment::where('ticket_id', $ticket->id)->orderBy('created_at', 'desc')->get();
//        $comments = CommentResource::collection($comments);
        $files = File::where('ticket_id', $ticket->id)->get();
        $files = FileResource::collection($files);
        return Inertia::render('Ticket/Show', compact('ticket', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $ticket = new TicketResource($ticket);
        return Inertia::render('Ticket/Edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Ticket $ticket)
    {
//        dd($ticket);
        $ticket->update($request->validated());
        return redirect()->route('ticket.show', $ticket->id);
    }

    public function working($ticket_id)
    {
        DB::update('UPDATE tickets SET status_id = 2 WHERE id = ?', [$ticket_id]);
        return redirect()->route('ticket.show', $ticket_id);
    }

    public function done($ticket_id)
    {
        DB::update('UPDATE tickets SET status_id = 3 WHERE id = ?', [$ticket_id]);
        return redirect()->route('ticket.show', $ticket_id);
    }

    public function closed($ticket_id)
    {
        DB::update('UPDATE tickets SET status_id = 4 WHERE id = ?', [$ticket_id]);
        return redirect()->route('ticket.show', $ticket_id);
    }

    public function postponed($ticket_id)
    {
        DB::update('UPDATE tickets SET status_id = 5 WHERE id = ?', [$ticket_id]);
        return redirect()->route('ticket.show', $ticket_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('ticket.index');
    }
}
