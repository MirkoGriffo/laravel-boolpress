<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validazione
        $request->validate([
            'title' => 'required|unique:posts|max:50',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags_id' => 'nullable|exists:tags,id',

        ]);

        $data = $request->all();

        //gen slug
        $data['slug'] = Str::slug($data['title'], '-');

        //create and save
        $new_post = new Post();

        $new_post->fill($data);

        $new_post->save();

        //salva relazione con tags in tabella pivot
        if (array_key_exists('tags', $data)) {
            $new_post->tags()->attach($data['tags']); //aggiunge nuovi records nella tabella pivot
        }

        return redirect()->route('admin.posts.show', $new_post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            abort(404);
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        if (!$post) {
            abort(404);
        }
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'title' => [
                'required',
                Rule::unique('posts')->ignore($id),

            ],

            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ], [
            'required' => 'The :attribute is required!',
            'unique' => 'The :atttribute is already in use in another post',
            'max' => 'Max :max 5 characters allowed for the :attribute',

        ]);
        //validate
        $data = $request->all();
        $post = Post::find($id);

        //gen slug
        if ($data['title'] != $post->title) {
            $data['slug'] = Str::slug($data['title'], '-');
        }

        $post->update($data); //fillable

        //Aggiorna relazione tabella pivot
        if (array_key_exists('tags', $data)) {
            //aggiungere record tabella pivot
            $post->tags()->sync($data['tags']);

        } else {
            $post->tags()->detach(); //rimuove tutte le records nella pivot
        }

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        //pulizia da tabella pivot
        $post->tags()->detach();

        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }
}
