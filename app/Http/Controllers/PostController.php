<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditRequest;

use App\Models\Category;
use App\Models\Post;

use Illuminate\Http\Request;
use DB, Str;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', 
        [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        try {
            $data = $request->all();
            $data['idCategory'] = DB::table('category')->where('name', $data['category'])->first()->id;
            $data['idUser'] = DB::table('user')->where('name', session('name'))->first()->id;
            $data['title'] = Str::of($data['title'])->upper();
            
            $post = new Post($data);
            $post->save();
            return redirect('/')->with('works', 'Post added successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['default' => 'Could not store the post...']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', 
        [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', 
        [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostEditRequest $request, Post $post)
    {
        try {
            $actualTime = Carbon::now('+1:00');
            $limitTime = Carbon::createFromDate($post->created_at)->addMinutes(5);
            
            if ($limitTime > $actualTime) {
                dd($request->all());
                $post->update($request->all());
                return redirect('user/' . $post->idUser)->with('works', "Post with id $post->id changed succesfully!");
            } else {
                return redirect('user/' . $post->idUser)->withErrors(['default' => 'You can edit a post for 5 minutes after creating it']);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['default' => "Could not change the post with id $post->id..."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {
            $actualTime = Carbon::now('+1:00');
            $limitTime = Carbon::createFromDate($post->created_at)->addMinutes(5);
            
            if ($limitTime > $actualTime) {
                $post->delete();
                return redirect('user/' . $post->idUser)->with('works', "Post with id $post->id has been deleted successfully");
            } else {
                return redirect('user/' . $post->idUser)->withErrors(['default' => 'You can delete a post for 5 minutes after creating it']);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['default' => "Could not delete the post with id $post->id..."]);
        }
    }
}
