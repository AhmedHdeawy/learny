<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class VideosController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
      $request->flash();

      $inputsArray = [    
        'video_translations.videos_title'   => [ 'like', request('title') ],
        'video_translations.videos_desc'   => [ 'like', request('desc') ],
        'videos.videos_status'              => [ '=', request('status') ],
        'videos.category_id'              => [ '=', request('category_id') ]
      ];

      $query = Video::join('video_translations', 'videos.id', 'video_translations.video_id')
                        ->groupBy('videos.id');
      
      $searchQuery = $this->handleSearch($query, $inputsArray);

      $videos = $searchQuery->paginate(env('perPage'));

      $categories = Category::all();

      return view('dashboard.videos.index', compact('videos', 'categories'));
    }


    /**
     * Goto the form for creating a new video.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allFiles = $this->getFilesAndDirectories('uploads/videos/');
        $allFiles = $this->sortFiles($allFiles);
        
        $categories = Category::all();

      return view('dashboard.videos.create', compact('categories', 'allFiles'));
    }    

    
    /**
     * Store a newly created video.
     *
     * @param  \App\Modules\Admin\Http\Requests\VideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {       
        $video = Video::create($request->all());

        return redirect()->route('admin.videos.index')->with('msg_success', __('lang.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Video $video)
    {
        $showLang = $request->showLang;

        return view('dashboard.videos.show', compact('video', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $allFiles = $this->getFilesAndDirectories('uploads/videos/');
        $allFiles = $this->sortFiles($allFiles);
        $categories = Category::all();

      return view('dashboard.videos.edit', compact('video', 'categories', 'allFiles'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\VideoRequest  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, Video $video)
    {
        $video->update($request->all());

        return redirect()->route('admin.videos.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }

    /**
     * Delete the video
     */
    public function destroy(Video $video)
    {        

        $filename = $video->videos_name;

        // Delete Record
        $video->delete();

        File::delete('uploads/videos/'.$filename);

      return back()->with('msg_success', __('lang.deletedSuccessfully'));
    }

    /**
     * Store the given video.
     *
     * @param  \App\Modules\Admin\Http\Requests\VideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadVideo(Request $request)
    {

        $file = $request->video;
        
        $name =  $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $name = 'learny_' . time() . '_' . str_random(20) . '.' . $ext;
        
        $file->move('uploads/videos/', $name);

        // $file->storeAs('uploadedVideos', $name, 'public');
        return response()->json($name);
    }

    /**
     * Get all Files in a directory.
     *
     * @param  String  $directory
     * @return Array
     */
    private function getFilesAndDirectories($directory)
    {
        // Get allFiles in Directory
        $filesInFolder = File::allFiles($directory);

        foreach ($filesInFolder as $file) {
            // If this Item is a Directory not a files
            if ($file->getRelativePath()) {
                    
                $allFiles[$file->getRelativePath()][] = $file->getRelativePathName();

            } else {
                // If this Item is a files
                $allFiles[] = $file->getRelativePathName();
            }
        }
        
        return $allFiles;
    }

    /**
     * Sort array based on Key.
     *
     * @param  Array $array
     * @return Array
     */
    private function sortFiles($arr)
    {
        $newArray = [];
        
        // Stor Arrays in first
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $newArray[$key] = $value;
            }
        }

        // Store norkal values in the end
        foreach ($arr as $key => $value) {
            if (!is_array($value)) {
                $newArray[] = $value;
            }
        }

        return $newArray;
    }

}
