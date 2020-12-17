<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
    public function store(Request $request)
    {
        $request->validate([
            'doctype' => 'required|numeric|max:10',
            'return_html' => 'required|boolean',
            'quotepid' => 'required|numeric' . $request->quotepid > 0 ? '|exists:posts,id' : '',
            'message' => 'required|max:2028000',
            'threadid' => 'required|numeric' . $request->threadid == 0 ? '' : '|exists:threads,id',
        ]);
        
        $post = Post::create([
            'thread_id' => $request->threadid,
            'user_id' => $request->user()->id,
            'ip' => ip2long($request->ip()),
            'is_first' => 0,
            'doctype' => $request->doctype,
            'quote_pid' => $request->quote_pid,
            'message' => $request->message,
        ]);
        
        
        
        if ($request->return_html) {
            return response()->json([
                'code' => 0,
                'message' => view('section.post-list')->with('postList', [$post])->render()
            ]);
        }
        
        return response()->json([
            'code' => 0,
            'message' => trans('app.create_post_sucessfully')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
