<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HasJsonResponse;
use App\Models\Category;
use App\Models\Like;
use App\Models\Video;
use App\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use Validator;

class HomeController extends Controller
{

    use HasJsonResponse;

    /**
     * Application Home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allCategories = Category::all();
        $categories = null;
        
        foreach ($allCategories as $cat) {
            $categories[] = Category::where('id', $cat->id)->with(['videos' => function($q){
                $q->first();
            }])->first();
        }


        $videos = Video::with('category')->withCount('likes')->withCount('dislikes')->get();
        
        return $this->jsonResponse(200, 'Logged in Successfully', null, compact('categories', 'videos'));
    }


    /**
     * Search for videos.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        
        $videos = Video::join('video_translations', 'videos.id', 'video_translations.video_id')
            ->groupBy('videos.id')
            ->where('video_translations.videos_title', 'LIKE', '%'. trim($request->text) . '%')
            ->with('category')->withCount('likes')->withCount('dislikes')->get();

        return $this->jsonResponse(200, 'Logged in Successfully', null, compact('videos'));
    }

    /**
     * Login the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function category(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric',
        ]);

        
        // $category = Category::findOrFail($request->id)->with('translations')->get();
        $category = Category::findOrFail($request->id);
        $videos = Video::where('category_id', $category->id)->withCount('likes')->withCount('dislikes')->get();
        
        return $this->jsonResponse(200, 'Logged in Successfully', null, compact('category', 'videos'));
    }

    /**
     * Login the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function likeVideo(Request $request)
    {

        $this->validate($request, [
            'video_id' => 'required|numeric',
        ]);

        $videoID = $request->video_id;
        $userID = Auth::guard('users')->id();
        
        $videoLikes = Video::findOrFail($videoID)->likes->pluck('users_id')->toArray();
        $videoDislikes = Video::findOrFail($videoID)->dislikes->pluck('users_id')->toArray();
        $getLike = Like::where('videos_id', $videoID)->where('users_id', $userID)->first();

        // check if this user dislikes this video
        $checkDisLike = in_array($userID, $videoDislikes);
        // check if this user likes this video
        $checkLike = in_array($userID, $videoLikes);

        // First, if not liked and disliked then Like the video
        if (!$checkDisLike && !$checkLike && !$getLike) {
            Like::create([
                'videos_id'     =>  $videoID, 
                'users_id'      =>  $userID, 
                'status'        =>  "1"
            ]);

            return $this->jsonResponse(200, 'Liked Successfully', null, true);
        }

        // if this user has dislike for this video
        if ($checkDisLike) {
            // Like the video and cancel dislike
            $getLike->status = "1";
            $getLike->save();

            return $this->jsonResponse(200, 'Liked Successfully', null, true);

        } else {
            
            // if this user has like for this video
            if ($checkLike) {
                // Cancel Like the video
                $getLike->status = "0";
                $getLike->save();

                return $this->jsonResponse(200, 'Delete Liked Successfully', null, false);
            }

            // unless, Like the video
            $getLike->status = "1";
            $getLike->save();
            
            return $this->jsonResponse(200, 'Liked Successfully', null, true);

        }

    }


    /**
     * Login the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dislikeVideo(Request $request)
    {
        $this->validate($request, [
            'video_id' => 'required|numeric',
        ]);

        $videoID = $request->video_id;
        $userID = Auth::guard('users')->id();
        
        $videoLikes = Video::findOrFail($videoID)->likes->pluck('users_id')->toArray();
        $videoDislikes = Video::findOrFail($videoID)->dislikes->pluck('users_id')->toArray();
        $getLike = Like::where('videos_id', $videoID)->where('users_id', $userID)->first();

        // check if this user dislikes this video
        $checkDisLike = in_array($userID, $videoDislikes);
        // check if this user likes this video
        $checkLike = in_array($userID, $videoLikes);

        // First, if not liked and disliked then Like the video
        if (!$checkDisLike && !$checkLike && !$getLike) {
            Like::create([
                'videos_id'     =>  $videoID, 
                'users_id'      =>  $userID, 
                'status'        =>  "2"
            ]);
            return $this->jsonResponse(200, 'DisLiked Successfully', null, true);
        }

        // if this user has like for this video
        if ($checkLike) {
            // DisLike the video and cancel like
            $getLike->status = "2";
            $getLike->save();

            return $this->jsonResponse(200, 'DisLiked Successfully', null, true);
            
        } else {
            // check if this user dislikes this video
            $checkDisLike = in_array($userID, $videoDislikes);

            // if this user has dislike for this video
            if ($checkDisLike) {
                // Cancel DisLike the video
                $getLike->status = "0";
                $getLike->save();

                return $this->jsonResponse(200, 'Delete DisLiked Successfully', null, false);
            }

            // unless, Like the video
            $getLike->status = "2";
            $getLike->save();
            
            return $this->jsonResponse(200, 'DisLiked Successfully', null, true);

        }
    }



}
