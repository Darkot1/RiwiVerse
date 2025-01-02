<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function private()
    {
        $posts = Post::with('user')->where('user_id', Auth::id())->latest()->get();
        return Inertia::render('Private', ['posts' => $posts]);
    }

    public function friends()
    {
        $posts = Post::with('user')->where('user_id', Auth::id())->latest()->get();
        return Inertia::render('Friends', ['posts' => $posts]);
    }
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return Inertia::render('General', ['posts' => $posts]);
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
        $request->validate([
            'content' => 'string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        try {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();

            // Guardar imagen
            $path = $image->storeAs('memes', $imageName, 'public');

            // Crear post
            $post = Post::create([
                'content' => $request->content,
                'image' => $path,
                'user_id' => Auth::id(),
            ]);

            return redirect()->back()->with('success', 'Meme publicado exitosamente');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error al guardar el meme']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
