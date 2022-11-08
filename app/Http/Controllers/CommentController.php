<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentEditRequest;

use App\Models\Comment;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class CommentController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentCreateRequest $request)
    {
        try {
            $data = $request->all();
            $data['idUser'] = DB::table('user')->where('name', session('name'))->first()->id;
            
            $comment = new Comment($data);
            $comment->save();
            return back()->with('works', 'Comment added successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['default' => 'Could not send the comment...']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comment.edit', 
        [
            'comment' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentEditRequest $request, Comment $comment)
    {
        try {
            $actualTime = Carbon::now('+1:00');
            $limitTime = Carbon::createFromDate($comment->created_at)->addMinutes(1);
            
            if ($limitTime > $actualTime) {
                $data = $request->all();
                $data['idPost'] = $comment->idPost;
                $data['idUser'] = DB::table('user')->where('name', session('name'))->first()->id;
                $comment->update($data);
                return redirect('user/' . $comment->idUser)->with('works', "Comment with id $comment->id changed succesfully!");
            } else {
                return redirect('user/' . $comment->idUser)->withErrors(['default' => 'You can edit a comment for 5 minutes after creating it']);
            }
                
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['default' => "Could not change the comment with id $comment->id..."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        try {
            $actualTime = Carbon::now('+1:00');
            $limitTime = Carbon::createFromDate($comment->created_at)->addMinutes(1);
            
            if ($limitTime > $actualTime) {
                $comment->delete();
                return redirect('user/' . $comment->idUser)->with('works', "Comment with id $comment->id has been deleted successfully");
            } else {
                return redirect('user/' . $comment->idUser)->withErrors(['default' => 'You can delete a comment for 5 minutes after creating it']);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['default' => "Could not delete the comment with id $comment->id..."]);
        }
    }
}
