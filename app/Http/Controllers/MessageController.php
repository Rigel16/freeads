<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Annonce;




class MessageController extends Controller
{
/**
 * Display a listing of the resource.
 */
public function index()
{
    $userId = Auth::id();

    // On récupère les derniers messages avec chaque utilisateur (et annonce)
    $conversations = Message::where('sender_id', $userId)
        ->orWhere('receiver_id', $userId)
        ->with(['annonce', 'sender', 'receiver'])
        ->latest()
        ->get()
        ->groupBy(function ($message) use ($userId) {
            // On groupe par annonce_id et l'autre utilisateur (pas moi)
            $otherUserId = $message->sender_id === $userId ? $message->receiver_id : $message->sender_id;
            return $message->annonce_id . '-' . $otherUserId;
        });

    return view('messages.index', compact('conversations'));
}


/**
 * Show the form for creating a new resource.
 */
public function create()
{
    //
}

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    //
}

/**
 * Display the specified resource.
 */

    public function show(Annonce $annonce, User $user)
    {
        $currentUserId = Auth::id();
    
        // Vérifie si l'utilisateur a le droit de voir cette conversation
        $messages = Message::where('annonce_id', $annonce->id)
            ->where(function ($query) use ($currentUserId, $user) {
                $query->where(function ($q) use ($currentUserId, $user) {
                    $q->where('sender_id', $currentUserId)
                    ->where('receiver_id', $user->id);
                })->orWhere(function ($q) use ($currentUserId, $user) {
                    $q->where('sender_id', $user->id)
                    ->where('receiver_id', $currentUserId);
                });
            })
            ->orderBy('created_at')
            ->get();
    
        return view('messages.show', compact('annonce', 'user', 'messages'));
    }


public function send(Request $request, Annonce $annonce, User $user)
{
    $request->validate([
        'content' => 'required|string'
    ]);

    Message::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $user->id,
        'annonce_id' => $annonce->id,
        'content' => $request->content,
    ]);

    return redirect()->route('messages.show', [$annonce->id, $user->id]);
}


/**
 * Show the form for editing the specified resource.
 */
public function edit(Message $message)
{
    //
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, Message $message)
{
    //
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(Message $message)
{
    //
}
}
