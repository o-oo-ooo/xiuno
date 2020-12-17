<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Forum;
use App\Models\Post;
use App\Models\Attach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Util;
use Illuminate\Support\Carbon;

class ThreadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
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
    public function create(Request $request)
    {
        $allowForum = Forum::all()->reject(function ($value) use ($request) {
            return $value->accesson && !$value->accesslist[1]['allowthread'];
        });
        
        $filelist = $request->session()->get('files');
        
        return view('thread.create')
                ->with('allowforum', $allowForum)
                ->with('filelist', $filelist);
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
            'fid' => 'required|numeric|exists:forums,id',
            'subject' => 'required|max:128',
            'message' => 'required|max:2028000',
            'doctype' => 'required|numeric|max:10',
            'quotepid' => 'required|numeric' . $request->quotepid > 0 ? '|exists:posts,id' : ''
        ]);
        
        $blockquote = '';
        if ($request->quotepid > 0) {
            $quote = Post::find($request->quotepid);
            $blockquote = '<blockquote class="blockquote">
                                <a href="'. route('user.show', $quote->user->id) .'" class="text-small text-muted user">
                                        <img class="avatar-1" src="'. $quote->user->avatar_url .'">
                                        '.$quote->user->name.'
                                </a>
                                '. substr($quote->message, 100).'
                            </blockquote>';
        }
        
        
        $post = Post::create([
            'thread_id' => 0,
            'is_first' => 1,
            'user_id' => $request->user()->id,
            'ip' => ip2long($request->ip()),
            'message' => $request->message,
            'message_format' => $blockquote . $request->message,
            'doctype' => $request->doctype
        ]);
        
        $thread = Thread::create([
            'forum_id' => $request->fid,
            'subject' => $request->subject,
            'user_id' => $request->user()->id,
            'first_pid' => $post->id,
            'last_pid' => $post->id,
            'ip' => ip2long($request->ip())
        ]);
        
        $request->user()->increment('threads');
        
        $sql = Forum::where('id', $request->fid)->update(['threads' => DB::raw('threads+1'), 'today_threads' => DB::raw('today_threads+1')]);

        Post::where('id', $post->id)->update(['thread_id' => $thread->id]);
        
        $sessionFiles = $request->session()->get('files');
        
        if ($sessionFiles) {
            $attachFiles = [];
            $date = Carbon::now()->format('Ym');
            $destDirectory = 'attach/' . $date . '/';
            foreach ($sessionFiles as $file) {
                $pathinfo = Util::pathinfo($file['url']);
                Storage::makeDirectory($destDirectory);
                Storage::move($file['url'], $destDirectory . $pathinfo['basename']);
                
                $attachFiles[] = [
                    'thread_id' => $thread->id,
                    'post_id' => $post->id,
                    'user_id' => $request->user()->id,
                    'filesize' => $file['filesize'],
                    'width' => $file['width'],
                    'height' => $file['height'],
                    'filename' => $date . '/' . $pathinfo['basename'],
                    'orgfilename' => $file['orgfilename'],
                    'filetype' => $file['filetype'],
                    'comment' => '',
                    'downloads' => 0,
                    'isimage' => $file['isimage']
                ];
            }
            
            Attach::query()->insert($attachFiles);
        }
        
        $request->session()->forget('files');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        return view('thread.show')
                ->with('thread', $thread)
                ->with('firstPost', $thread->post->find($thread->first_pid))
                ->with('postList', $thread->post->except($thread->first_pid));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
