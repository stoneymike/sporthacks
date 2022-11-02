<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $pageTitle = "All News";
        $news = News::with('category', 'user')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.news.index', compact('news', 'pageTitle', 'categories'));
    }

    public function pending()
    {
        $pageTitle = "Pending News";
        $news = News::pending()->with('category', 'user')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.news.index', compact('news', 'pageTitle', 'categories'));
    }

    public function approved()
    {
        $pageTitle = "Approved News";
        $news = News::approved()->with('category', 'user')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.news.index', compact('news', 'pageTitle', 'categories'));
    }

    public function rejected()
    {
        $pageTitle = "Rejected News";
        $news = News::rejected()->with('category', 'user')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.news.index', compact('news', 'pageTitle', 'categories'));
    }

    public function edit(News $news)
    {
        $pageTitle = "Edit News";
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.news.edit', compact('news', 'pageTitle', 'categories'));
    }

    public function update(Request $request, News $news, $slug = null)
    {
        $request->validate([
            'category' => 'required|integer|in:'.Category::active()->pluck('id')->join(','),
            'title' => 'required|string',
            'short_description' => 'required',
            'description' => 'required',
            'video_link' => 'required_if:video,==,on|url',
            'image' => 'image|mimes:jpg,jpeg,png,jpeg',
            'tags' => 'required|max:60000|array',
        ]);

        $directory = date("Y")."/".date("m")."/".date("d");
        $size = imagePath()['news']['size'];
        $path = imagePath()['news']['path'].'/'.$directory;

        if ($request->has('image')) {
            try {
                removeFile(imagePath()['news']['path'].'/'.$news->image);
                $image = $directory.'/'.uploadImage($request->image, $path, $size);
                $news->image = $image;
            } catch (\Throwable $th) {
                $notify[] = ['error', 'Could Not Upload Image'];
                return back()->withNotify($notify);
            }
        }

        $news->category_id = $request->category;
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->description = $request->description;

        $news->tags = json_encode($request->tags);

        $news->have_video = $request->video == 'on' ? 1 : 0;
        $news->video_link = $request->video == 'on' ? $request->video_link : null;

        $news->trending = $request->trending == 'on' ? 1 : 0;
        $news->must_read = $request->must_read == 'on' ? 1 : 0;
        $news->save();

        $notify[] = ['success', 'Successfully updated news'];
        return back()->withNotify($notify);
    }

    public function status(News $news)
    {
        $news->status = ($news->status ? 0 : 1);
        $news->save();

        $notify[] = ['success', 'News '. ($news->status ? 'Activated!' : 'Deactivated!')];
        return back()->withNotify($notify);
    }

    public function approveOrReject(News $news)
    {
        if (\request()->approve){
            $news->admin_check = 1;
        } else {
            $news->admin_check = 2;
        }

        $news->save();

        $notify[] = ['success', 'News '. ($news->admin_check == 1 ? 'approved!' : 'rejected!')];
        return back()->withNotify($notify);
    }

    public function delete(News $news)
    {
        $path = imagePath()['news']['path']. '/' . $news->image;
        removeFile($path);

        $news->delete();

        $notify[] = ['success', 'Successfully deleted the news'];
        return back()->withNotify($notify);
    }

    public function filterByCategory($categoryId, $categoryName)
    {
        $pageTitle = "Search News For $categoryName";
        $news = News::where('category_id', $categoryId)->active()->with('category', 'user')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();

        return view('admin.news.index', compact('pageTitle', 'news', 'categories', 'categoryId'));
    }

    public function filterByDate(Request $request) {

        if (!$request->date) {
            return back();
        }

        $date = explode('-',$request->date);
        $start = @$date[0];
        $end = @$date[1];
        // date validation
        $pattern = "/\d{2}\/\d{2}\/\d{4}/";

        if ($start && !preg_match($pattern,$start)) {
            $notify[] = ['error','Invalid date format'];
            return back()->withNotify($notify);
        }
        if ($end && !preg_match($pattern,$end)) {
            $notify[] = ['error','Invalid date format'];
            return back()->withNotify($notify);
        }

        $pageTitle = 'Search Result For ' . $request->date;

        $date = array_map(function ($item) {
            return Carbon::parse($item)->toDateString();
        }, explode('-', $request->date));

        if (count($date) == 1) {
            $news = News::active()->whereDate('created_at', $date[0])->with('category', 'user')->latest()->paginate(getPaginate());
        } else {
            $news = News::active()->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1])->with('category', 'user')->latest()->paginate(getPaginate());
        }

        $categories = Category::active()->orderBy('name')->get();
        $dateSearch = $request->date;
        return view('admin.news.index', compact('pageTitle', 'news', 'dateSearch', 'categories'));
    }

    //User news
    public function userAllNews($id)
    {
        $pageTitle = "User All News";
        $news = News::where('user_id', $id)->with('category', 'user')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.news.index', compact('news', 'pageTitle', 'categories'));
    }

    public function userPendingNews($id)
    {
        $pageTitle = "User Pending News";
        $news = News::where('user_id', $id)->pending()->with('category', 'user')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.news.index', compact('news', 'pageTitle', 'categories'));
    }

    public function userApprovedNews($id)
    {
        $pageTitle = "User Approved News";
        $news = News::where('user_id', $id)->approved()->with('category', 'user')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.news.index', compact('news', 'pageTitle', 'categories'));
    }

    public function userRejectedNews($id)
    {
        $pageTitle = "User Rejected News";
        $news = News::where('user_id', $id)->rejected()->with('category', 'user')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.news.index', compact('news', 'pageTitle', 'categories'));
    }

    //Live news
    public function live()
    {
        $pageTitle = "Live News";
        return view('admin.news.live', compact('pageTitle'));
    }

    public function storeLiveNews()
    {
        \request()->validate([
            'title' => 'required|string',
            'live_news_link' => 'required|url|string',
            'description' => 'required|string',
        ]);

        $general = GeneralSetting::first();
        $general->live_news_title = request()->title;
        $general->live_news_link = request()->live_news_link;
        $general->live_news_description = request()->description;
        $general->save();

        $notify[] = ['success', 'Successfully set live news'];
        return back()->withNotify($notify);
    }

    public function createPage(){
        $pageTitle = "Add News";
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.news.create', compact('categories', 'pageTitle'));
    }

    public function create(Request $request){

        $request->validate([
            'category' => 'required|integer|in:'.Category::active()->pluck('id')->join(','),
            'title' => 'required|string',
            'short_description' => 'required',
            'description' => 'required',
            'video_link' => 'required_if:video,==,on|url',
            'image' => 'required|image|mimes:jpg,jpeg,png,jpeg',
            'tags' => 'required|max:60000|array',
        ]);

        $directory = date("Y")."/".date("m")."/".date("d");
        $size = imagePath()['news']['size'];
        $path = imagePath()['news']['path'].'/'.$directory;

        if ($request->has('image')) {
            try {
                $image = $directory.'/'.uploadImage($request->image, $path, $size);
            } catch (\Throwable $th) {
                $notify[] = ['error', 'Could Not Upload Image'];
                return back()->withNotify($notify);
            }
        }

        $news = new News();
        $news->user_id = 0;
        $news->category_id = $request->category;
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->description = $request->description;
        $news->image = $image;

        $news->	admin_check = 1;

        $news->tags = json_encode($request->tags) ;

        $news->have_video = $request->video == 'on' ? 1 : 0;
        $news->video_link = $request->video == 'on' ? $request->video_link : null;

        $news->trending = $request->trending == 'on' ? 1 : 0;
        $news->must_read = $request->must_read == 'on' ? 1 : 0;
        $news->save();

        $notify[] = ['success', 'Successfully created news'];
        return back()->withNotify($notify);
    }

}
