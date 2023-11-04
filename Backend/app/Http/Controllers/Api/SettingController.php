<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

use function PHPUnit\Framework\fileExists;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        if ($settings->count() > 0) {
            return response()->json([
                'settings' => $settings,

            ], 200);
        } else {

            return response()->json([
                'settings' => 'No Record Here',

            ], 404);
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [

                'name' => 'required|string|unique:settings',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'header' => 'required',
                'footer' => 'required',
                'about' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages(),

            ]);
        } else {

            $setting = new Setting;

            $setting->name = $request->name;
            $setting->header = $request->header;
            $setting->footer = $request->footer;
            $setting->about = $request->about;

            //$setting->image = $request->image->store('company_profile');

            if ($request->hasfile('image')) {

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $path = $file->move('company', $filename);
                Image::make($path)->resize(300, 300);

                $setting->image = $filename;

            }

            $setting->save();
        }

        if ($setting) {
            return response()->json([

                'message' => 'Setting Successfully Saved',
            ]);
        } else {

            return response()->json([

                'error' => 'Insert Fail',
            ]);
        }
    }

    // Search Method---------

    public function show($id)
    {

        $settings = Setting::find($id);

        if ($settings) {
            return response()->json([
                'settings' => $settings,

            ], 200);
        } else {

            return response()->json([
                'error' => 'Data Not Found',

            ], 404);
        }
    }

    //--------------

    public function edit_index($id)
    {

        $settings = Setting::find($id);

        if ($settings) {
            return response()->json([
                'settings' => $settings,

            ], 200);
        } else {

            return response()->json([
                'error' => 'Data Not Found',

            ], 404);
        }
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|unique:settings',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'header' => 'required',
                'footer' => 'required',
                'about' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages(),

            ], 404);
        }

        $setting = Setting::find($id);

        if ($setting) {

            $setting->name = $request->name;

            $setting->header = $request->header;
            $setting->footer = $request->footer;
            $setting->about = $request->about;

            if (fileExists($setting->image)) {

                unlink('company/'.$setting->image);

            }

            if ($request->hasfile('image')) {

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $path = $file->move('company', $filename);
                Image::make($path)->resize(300, 300);

            }

            $setting->image = $filename;

            $setting->update();

            return response()->json([

                'message' => 'Setting Successfully Saved',
            ], 200);

        } else {

            return response()->json([

                'message' => 'No Setting Found',
            ], 404);
        }

    }

    public function delete($id)
    {

        $setting = Setting::find($id);

        if (fileExists($setting->image)) {

            unlink('company/'.$setting->image);

        }
        if ($setting) {
            $setting->delete();

            return response()->json([

                'message' => 'Setting Delete',
            ], 200);

        } else {
            return response()->json([

                'message' => 'Setting Not Found',
            ], 404);
        }

    }
}
