<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $pageTitle = "All News";
        $news = News::where('user_id', auth()->id())->with('category')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();

        return view($this->activeTemplate . 'user.news.index', compact('news', 'pageTitle', 'categories'));
    }

    public function pending()
    {
        $pageTitle = "Pending News";
        $news = News::pending()->where('user_id', auth()->id())->with('category')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();

        return view($this->activeTemplate . 'user.news.index', compact('news', 'pageTitle', 'categories'));
    }

    public function approved()
    {
        $pageTitle = "Approved News";
        $news = News::approved()->where('user_id', auth()->id())->with('category')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();

        return view($this->activeTemplate . 'user.news.index', compact('news', 'pageTitle', 'categories'));
    }

    public function rejected()
    {
        $pageTitle = "Rejected News";
        $news = News::rejected()->where('user_id', auth()->id())->with('category')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();

        return view($this->activeTemplate . 'user.news.index', compact('news', 'pageTitle', 'categories'));
    }

    public function create()
    {
        $pageTitle = "Add News";
        $categories = Category::active()->orderBy('name')->get();
        return view($this->activeTemplate . 'user.news.create', compact('categories', 'pageTitle'));
    }

    public function store(Request $request)
    {
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
        $news->user_id = auth()->id();
        $news->category_id = $request->category;
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->description = $request->description;
        $news->image = $image;

        $news->tags = json_encode($request->tags) ;

        $news->have_video = $request->video == 'on' ? 1 : 0;
        $news->video_link = $request->video == 'on' ? $request->video_link : null;

        $news->trending = $request->trending == 'on' ? 1 : 0;
        $news->must_read = $request->must_read == 'on' ? 1 : 0;
        $news->save();

        $notify[] = ['success', 'Successfully created news'];
        return back()->withNotify($notify);
    }

    public function edit(News $news)
    {
        if ($news->user_id != auth()->id()){
            $notify[] = ['error', 'Invalid link'];
            return back()->withNotify($notify);
        }

        $pageTitle = "Edit News";
        $categories = Category::active()->orderBy('name')->get();
        return view($this->activeTemplate . 'user.news.edit', compact('categories', 'pageTitle', 'news'));
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

    public function filterByCategory($categoryId, $categoryName)
    {
        $pageTitle = "Search News For $categoryName";
        $news = News::where('category_id', $categoryId)->active()->with('category', 'user')->latest()->paginate(getPaginate());
        $categories = Category::active()->orderBy('name')->get();

        return view($this->activeTemplate . 'user.news.index', compact('news', 'pageTitle', 'categories', 'categoryId'));
    }

    public function filterByDate(Request $request) {
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
        return view($this->activeTemplate . 'user.news.index', compact('news', 'pageTitle', 'categories', 'dateSearch'));
    }

}
