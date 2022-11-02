<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $pageTitle = "Search Result of $search";
            $advertisements = Advertise::where('resolution', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $pageTitle = "All Advertisements";
            $advertisements = Advertise::latest()->paginate(getPaginate());
        }
        $empty_message = "No Advertisements found";
        return view('admin.advertise.index', compact('pageTitle', 'advertisements', 'search', 'empty_message'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'type' => 'required|in:1,2',
            'size' => 'required|in:728x90,980x90,300x250,300x600,980x120',
            'redirect_url' => 'required_if:type,1|url',
            'adimage' => 'required_if:type,1|image|mimes:jpg,jpeg,png,PNG,gif',
            'script' => 'required_if:type,2',
        ]);

        $advr = new Advertise();
        $advr->type = $request->type;
        $advr->script = $request->script ?? null;
        $advr->redirect_url = $request->redirect_url;
        $advr->resolution = $request->size;
        if ($request->adimage) {
            list($width, $height) = getimagesize($request->adimage);
            $size = $width . 'x' . $height;
            if ($request->size != $size) {
                $notify[] = ['error', 'Sorry image size has to be ' . $request->size];
                return back()->withNotify($notify);
            }
            $advr->ad_image = uploadFile($request->adimage, imagePath()['advertise']['path']);
        }
        $advr->save();

        $notify[] = ['success', 'Advertisement added successfully'];
        return back()->withNotify($notify);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:1,2',
            'size' => 'required|in:728x90,980x90,300x250,300x600,980x120',
            'redirect_url' => 'required_if:type,1|url',
            'adimage' => 'image|mimes:jpg,jpeg,png,PNG,gif',
            'script' => 'required_if:type,2',
        ]);

        $advr = Advertise::findOrFail($id);
        $advr->type = $request->type;
        $advr->script = $request->script ?? null;
        $advr->redirect_url = $request->redirect_url;
        $advr->resolution = $request->size;
        if ($request->adimage) {
            $old = $advr->ad_image ?? null;
            list($width, $height) = getimagesize($request->adimage);
            $size = $width . 'x' . $height;
            // if ($request->size != $size) {
            //     $notify[] = ['error', 'Sorry image size has to be ' . $request->size];
            //     return back()->withNotify($notify);
            // }
            $advr->ad_image = uploadFile($request->adimage, imagePath()['advertise']['path'], null, $old);
        }

        $advr->save();

        $notify[] = ['success', 'Advertisement Updated successfully'];
        return back()->withNotify($notify);
    }

    public function delete($id)
    {
        $ad = Advertise::findOrFail($id);

        $path = imagePath()['advertise']['path'] . '/' . $ad->ad_image;
        removeFile($path);

        $ad->delete();

        $notify[] = ['success', 'Advertisement removed successfully'];
        return back()->withNotify($notify);
    }

    public function status(Advertise $advertise)
    {
        $advertise->status = ($advertise->status ? 0 : 1);
        $advertise->save();

        $notify[] = ['success', 'Category '. ($advertise->status ? 'Activated!' : 'Deactivated!')];
        return back()->withNotify($notify);
    }
}
