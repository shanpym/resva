<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\Room_Type;
use App\Models\Appearance;


class AppearanceController extends Controller
{
    public function view(){
        $appearance = Appearance::get();
        $rooms = Room_Type::get();
        return view('admin.appearance.edit', compact('appearance', 'rooms'));
    }

    public function welcomeView(){
        $appearance = Appearance::first();
        $room = Room_Type::first();
        return view('welcome', compact('appearance', 'room'));
    }

    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'hero_image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',  
            'about_background' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'about_character' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            
            'about_icon' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ],[
            'hero_image.mimes' => 'The image should be in JPEG, JPG, PNG format.',
            'hero_image.max' => 'The image max KB is 2048.',
            'about_background.mimes' => 'The image should be in JPEG, JPG, PNG format.',
            'about_background.max' => 'The image max KB is 2048.',
            'about_character.mimes' => 'The image should be in JPEG, JPG, PNG format.',
            'about_character.max' => 'The image max KB is 2048.',
            'about_icon.mimes' => 'The image should be in JPEG, JPG, PNG format.',
            'about_icon.max' => 'The image max KB is 2048.',
            'required' => 'Please fill out all fields.',
           
        ]);

        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        };
      

        $hero = Appearance::where('id', '1')->first();
        
        if ($request->hasFile('hero_image')) {
            $fileName = time() . '.' . $request->hero_image->extension();
            $request->hero_image->storeAs('public/img/', $fileName);

            $hero->update([
                'hero_image' => $fileName,
                'hero_welcome' => $request->hero_welcome, 
                'hero_motto' => $request->hero_motto, 
                'hero_motto_highlight_1' => $request->hero_motto_highlight_1, 
                'hero_motto_highlight_2' => $request->hero_motto_highlight_2, 
                'hero_description' => $request->hero_description, 
            ]);
        }
        else{
            $hero->update([
                'hero_welcome' => $request->hero_welcome, 
                'hero_motto' => $request->hero_motto, 
                'hero_motto_highlight_1' => $request->hero_motto_highlight_1, 
                'hero_motto_highlight_2' => $request->hero_motto_highlight_2, 
                'hero_description' => $request->hero_description, 
            ]);
        }

        if ($request->hasFile('service_image')) {
            $fileName = time() . '.' . $request->service_image->extension();
            $request->service_image->storeAs('public/img/', $fileName);
    
            $service_image = Appearance::where('id', '6')->first();
            $service_image->update([
                'service_image' => $fileName,
            ]);
        }
        
        $service = Appearance::where('id', '6')->first();
        $service->update([
            'service_name' => $request->service_name, 
            'service_description' => $request->service_description, 
            'service_description_highlight_1' => $request->service_description_highlight_1, 
            'service_description_highlight_2' => $request->service_description_highlight_2, 
        ]);

        if ($request->hasFile('about_background')) {
            $fileName = time() . '.' . $request->about_background->extension();
            $request->about_background->storeAs('public/img/', $fileName);
    
            $about_background = Appearance::where('id', '2')->first();
            $about_background->update([
                'about_background' => $fileName,
            ]);
        }

        if ($request->hasFile('about_character')) {
            $fileName = time() . '.' . $request->about_character->extension();
            $request->about_character->storeAs('public/img/', $fileName);
    
            $about_character = Appearance::where('id', '2')->first();
            $about_character->update([
                'about_character' => $fileName,
            ]);
        }
       
        $about1 = Appearance::where('id', '2')->first();
        if ($request->hasFile('about_icon_1')) {
            $fileName = time() . '.' . $request->about_icon_1->extension();
            $request->about_icon_1->storeAs('public/img/', $fileName);
    
            $about_icon = Appearance::where('id', '2')->first();
            $about_icon->update([
                'about_icon' => $fileName,
            ]);
        }else{
            $about1->update([
                'about_name' => $request->about_name_1, 
                'about_description' => $request->about_description_1, 
            ]);
        }

        $about2 = Appearance::where('id', '3')->first();
        if ($request->hasFile('about_icon_2')) {
            $fileName = time() . '.' . $request->about_icon_2->extension();
            $request->about_icon_2->storeAs('public/img/', $fileName);
    
            $about_icon = Appearance::where('id', '3')->first();
            $about_icon->update([
                'about_icon' => $fileName,
            ]);
        }else{
            $about2->update([
                'about_name' => $request->about_name_2, 
                'about_description' => $request->about_description_2, 
            ]);
        }
        

        $about3 = Appearance::where('id', '4')->first();
        if ($request->hasFile('about_icon_3')) {
            $fileName = time() . '.' . $request->about_icon_3->extension();
            $request->about_icon_3->storeAs('public/img/', $fileName);
    
            $about_icon = Appearance::where('id', '4')->first();
            $about_icon->update([
                'about_icon' => $fileName,
            ]);
        }else{
        $about3->update([
            'about_name' => $request->about_name_3, 
            'about_description' => $request->about_description_3, 
        ]);
        }

        $about4 = Appearance::where('id', '5')->first();
        if ($request->hasFile('about_icon_4')) {
            $fileName = time() . '.' . $request->about_icon_4->extension();
            $request->about_icon_4->storeAs('public/img/', $fileName);
    
            $about_icon = Appearance::where('id', '5')->first();
            $about_icon->update([
                'about_icon' => $fileName,
            ]);
        }else{
        $about4->update([
            'about_name' => $request->about_name_4, 
            'about_description' => $request->about_description_4, 
        ]);
        }


        return redirect()->back()->with("success", "Page has been updated successfully");
    }
}
