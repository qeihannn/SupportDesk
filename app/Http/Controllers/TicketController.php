<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Daftar Tiket';

        $tickets = (Auth::user()->role == 'admin')
            ? Ticket::with('user')->get()
            : Ticket::where('user_id', Auth::id())->get();

        return view('tickets.index', compact('tickets', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Buat Tiket Baru';
        return view('tickets.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
           'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',

        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('tickets', 'public');
        }

        Ticket::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Tiket berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Tiket';

        $ticket = Ticket::findOrFail($id);

        if (Auth::user()->role == 'user' && $ticket->user_id != Auth::id()) {
            abort(403);
        }

        return view('tickets.show', compact('title', 'ticket'));
    }

    /**
     * Update ticket status (admin only).
     */
    public function updateStatus(Request $request, Ticket $ticket)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $ticket->update(['status' => $request->status]);

        return redirect()->route('tickets.index')
            ->with('success', 'Status tiket diperbarui.');
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
