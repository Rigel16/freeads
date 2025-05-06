<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class AnnonceController extends Controller
{
    public function index()
{

    $annonces = Annonce::with('images')->where('user_id', Auth::id())->latest()->paginate(5); 

    return view('annonces.index', compact('annonces'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('annonces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse{
        $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['required','string','max:1000'],
            'price' => ['required','numeric'],
            'location' => ['required','string','max:255'],
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
            ]);


            $annonce = Annonce::create([
                'title' => $request ->title,
                'description' => $request -> description,
                'price' => $request -> price,
                'location' => $request -> location,
                'user_id' => Auth::id(),
            ]);
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $imageFile) {
                    $path = $imageFile->store('annonce_images', 'public');
                    $annonce->images()->create(['path' => $path]);
                }
            }
            return redirect(route('dashboard', absolute: false));

    }

    /**
     * Display the specified resource.
     */
    public function show(Annonce $annonce)
    {
        return view('annonces.show', compact('annonce'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Annonce $annonce)
    {
        return view('annonces.edit', compact('annonce'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Annonce $annonce)
    {
        //on verifie d'abord si l'utilisateur connecté est le propriétaire de l'annonce

        if ($annonce -> user_id !== Auth::id()){
            return redirect()-> route('dashboard');
        }
        $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['required','string','max:1000'],
            'price' => ['required','numeric'],
            'location' => ['required','string','max:255'],
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

        $annonce->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
        ]);

        // Ajouter les nouvelles images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('annonce_images', 'public');
                $annonce->images()->create(['path' => $path]);
            }
        }
        // Supprimer les anciennes images si elles existent
        if ($request->input('delete_images')) {
            foreach ($request->input('delete_images') as $imageId) {
                $image = $annonce->images()->find($imageId);
                if ($image) {
                    // Supprimer le fichier physique (optionnel)
                    // Storage::disk('public')->delete($image->path);
                    $image->delete();
                }
            }
        }
        return redirect()->route('annonces.index')
            ->with('success', 'Annonce mise à jour avec succès !');


    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annonce $annonce)
    {
        if ($annonce->user_id !== Auth::id()) {
            return redirect()->route('dashboard')
                ->with('error', 'Vous n\'êtes pas autorisé à supprimer cette annonce.');
        }

        // Supprimer les images associées
        foreach ($annonce->images as $image) {
            // Supprimer le fichier physique 
            // Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $annonce->delete();

        return redirect()->route('annonces.index')
            ->with('success', 'Annonce supprimée avec succès !');
    }

        public function search(Request $request)
    {
        $query = $request->input('query');
        
        $annonces = Annonce::with('images')
            ->where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->orWhere('location', 'like', "%{$query}%")
            ->latest()
            ->paginate(6);
            
        return view('annonces.search', compact('annonces', 'query'));
    }
}
