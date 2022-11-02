<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\Category;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\Language;
use App\Models\News;
use App\Models\Page;
use App\Models\SupportAttachment;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {

        $count = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->count();
        if ($count == 0) {
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'HOME';
            $page->slug = 'home';
            $page->save();
        }

        $reference = @$_GET['reference'];
        if ($reference) {
            session()->put('reference', $reference);
        }

        $pageTitle = 'Home';
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->first();

        //News
        $latestNews = News::active()->approved()->latest()->limit(5)->get(['id', 'title']);

        $latest_news_banner = News::active()->approved()->orderBy('id', 'desc')->take(10)->get(['id', 'title', 'image', 'short_description']);
        $last_news = News::active()->approved()->orderBy('id', 'desc')->first();
        $trendings = News::active()->approved()->trending()->orderBy('id', 'desc')->skip(1)->take(3)->get();
        $last_must_read = News::active()->approved()->must_read()->orderBy('id', 'desc')->first();
        $latest_news = News::active()->approved()->orderBy('id', 'desc')->take(4)->get();
        $must_reads = News::active()->approved()->must_read()->orderBy('id', 'desc')->take(4)->get();
        $last_trending = News::active()->approved()->trending()->orderBy('id', 'desc')->first();

        $first_four_categories = Category::active()->orderBy('serial')->whereHas('news', function ($q){
            $q->active()->approved();
        })->take(4)->with('news')->get();

        $four_videos = News::active()->approved()->video()->orderBy('id', 'desc')->take(4)->get(['id', 'video_link', 'have_video']);

        $trending_news = News::active()->approved()->trending()->orderBy('id', 'desc')->take(8)->get();
        if (News::active()->approved()->trending()->orderBy('id', 'desc')->count() <= 8){
            $more_trending_news = [];
        } else {
            $more_trending_news = News::active()->approved()->trending()->orderBy('id', 'desc')->skip(8)->take(5)->get();
        }

        $most_popular = News::active()->approved()->orderBy('views', 'desc')->take(5)->get(['id', 'title']);
        $photos = News::active()->approved()->orderBy('id', 'desc')->take(5)->get(['id', 'title', 'image']);

        //Category
        $categories = Category::active()->whereHas('news', function ($q){
            $q->active()->approved();
        })->orderBy('serial')->get();
        if (count($categories) <= 4){
            $after_four_categories = [];
        } else {
            $after_four_categories = Category::active()->orderBy('serial')->whereHas('news', function ($q){
                $q->active()->approved();
            })->skip(4)->take(count($categories) - 4)->with('news')->get();
        }

        return view($this->activeTemplate . 'home', compact('pageTitle', 'sections', 'latestNews', 'latest_news_banner', 'last_news', 'trendings', 'last_must_read', 'latest_news', 'must_reads', 'last_trending', 'first_four_categories', 'four_videos', 'trending_news', 'more_trending_news', 'most_popular', 'photos', 'categories', 'after_four_categories'));
    }

    public function search(Request $request)
    {
        if (!$request->search){
            return back();
        }

        $searchInput = $request->search;

        $search = News::active()
                      ->approved()
                      ->where(function($query) use ($searchInput) {
                          $query->orWhere('tags', 'like', '%' . $searchInput . '%')
                          ->orWhere('short_description', 'like', '%' . $searchInput . '%')
                          ->orWhere('title', 'like', '%' . $searchInput . '%');
                      })
                      ->orWhereHas('category', function($query) use ($searchInput) {
                        $query->where('name', 'like', '%'. $searchInput .'%');
                      })
                      ->orderBy('id', 'desc')
                      ->paginate(12);

        $pageTitle = "Search result for {$request->search}";
        return view($this->activeTemplate . 'news.search', compact('pageTitle', 'search'));
    }

    public function archived(Request $request) {

        $search = News::active()->approved()->whereDate('created_at', Carbon::parse($request->date))
            ->orderBy('id', 'DESC')
            ->paginate(12);

        $pageTitle = "News search for $request->date";

        return view($this->activeTemplate . 'news.search', compact('pageTitle', 'search'));
    }

    public function videos()
    {
        $videos = News::active()->approved()->video()->orderBy('id', 'desc')->paginate(8);
        $pageTitle = 'Videos';
        return view($this->activeTemplate . 'videos', compact('pageTitle', 'videos'));
    }

    public function photos()
    {
        $photos = News::active()->approved()->orderBy('id', 'desc')->paginate(8);
        $pageTitle = 'Photos';
        return view($this->activeTemplate . 'photos', compact('pageTitle', 'photos'));
    }

    public function pages($slug)
    {
        $page = Page::where('tempname', $this->activeTemplate)->where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
    }


    public function contact()
    {
        $pageTitle = "Contact Us";
        return view($this->activeTemplate . 'contact', compact('pageTitle'));
    }


    public function contactSubmit(Request $request)
    {

        $attachments = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);


        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'ticket created successfully!'];

        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function policyDetails($id, $slug)
    {
        $policy = Frontend::where('id', $id)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle = $policy->data_values->title;
        return view($this->activeTemplate . 'policy_details', compact('policy', 'pageTitle'));
    }

    public function newsDetails($id, $slug = null)
    {
        $news = News::active()->approved()->where('id', $id)->firstOrFail();
        $top_news = News::active()->approved()->where('id', '!=', $id)->orderBy('views', 'desc')->take(6)->get(['id', 'title']);
        $trending_news = News::active()->approved()->where('id', '!=', $id)->trending()->orderBy('id', 'desc')->take(4)->get(['id', 'title', 'image']);
        $latest_news = News::active()->approved()->where('id', '!=', $id)->orderBy('id', 'desc')->take(6)->get(['id', 'title', 'image']);

        $pageTitle = 'News Details';
        return view($this->activeTemplate . 'news.details', compact('news', 'pageTitle', 'top_news', 'trending_news', 'latest_news'));
    }

    public function categoryDetails($id, $slug)
    {
        $category = Category::active()->where('id', $id)->with('news')->firstOrFail();
        $first_cat_news = News::active()->approved()->where('category_id', $category->id)->orderBy('id', 'desc')->first();
        $latest_news = News::active()->approved()->orderBy('id', 'desc')->take(6)->get(['id', 'title', 'image']);
        $removeDuplicate = @$latest_news->first()->id;
        $pageTitle = "{$category->name} News";
        return view($this->activeTemplate . 'category.details', compact('category', 'pageTitle', 'first_cat_news', 'latest_news', 'removeDuplicate'));
    }

    public function loadMore(Request $request)
    {
        if($request->id > 0){
            $data = News::active()->approved()->where('category_id', $request->catId)->where('id','<',$request->id)->orderBy('id', 'desc')->take(8)->get(['id', 'title', 'image']);
        }else{
            $data = News::active()->approved()->where('category_id', $request->catId)->where('id', '!=', $request->remove)->orderBy('id', 'desc')->take(8)->get(['id', 'title', 'image']);
        }

        $next = News::active()->approved()->where('category_id', $request->catId)->where('id','<', @$data->last()->id)->orderBy('id', 'desc')->take(8)->count();

        return ['next'=>$next , 'output'=>$data, 'add'=>advertisements('728x90')];
    }

    public function cookieAccept()
    {
        session()->put('cookie_accepted', true);
        return response()->json(['success' => 'Cookie accepted successfully']);
    }

    public function placeholderImage($size = null)
    {
        $imgWidth = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX = ($imgWidth - $textWidth) / 2;
        $textY = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

}
