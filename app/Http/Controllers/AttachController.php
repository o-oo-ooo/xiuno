<?php

namespace App\Http\Controllers;

use App\Models\Attach;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAttach;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttachController extends Controller
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
    public function store(StoreAttach $request)
    {
        $this->authorize('create', Attach::class);
        
        $ext = strtolower(substr(strrchr($request->name, '.'), 1));
        if (!in_array($ext, config('filesystems.filetypes.all'))) {
            $ext = '_' . $ext;
        }
        
        $filename = Str::random() . '.' . $ext;
        
        $filedirectory = 'temp';
        
        $filepath = Storage::path($filedirectory . '/' . $filename);
        
        $filetype = 'other';
        foreach (config('filesystems.filetypes') as $type => $exts) {
            if ($type == 'all') {
                continue;
            }
            if (in_array($ext, $exts)) {
                $filetype = $type;
                break;
            }
        }
        
        Storage::put($filedirectory . '/' . $filename, $request->data);

        $sessionfiles = $request->session()->get('files') ?? [];
        
        $filecount = count($sessionfiles);
        
        $filesize = filesize($filepath);
        
        $attach = [
            'url' => $filedirectory . '/' . $filename,
            'path' => $filepath,
            'orgfilename' => $request->name,
            'filetype' => $filetype,
            'filesize' => $filesize,
            'width' => $request->width,
            'height' => $request->height,
            'isimage' => $request->is_image,
            'downloads' => 0,
            'id' => $filecount
        ];
        
        $request->session()->push('files', $attach);
        
        unset($attach['path']);
        
        return response()->json([
            'code' => 0,
            'message' => $attach
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attach  $attach
     * @return \Illuminate\Http\Response
     */
    public function show(Attach $attach)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attach  $attach
     * @return \Illuminate\Http\Response
     */
    public function edit(Attach $attach)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attach  $attach
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attach $attach)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attach  $attach
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attach $attach)
    {
        //
    }
}
