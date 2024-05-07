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
use Illuminate\Pagination\Paginator;
//MODELS

use App\Models\Meals;
use App\Models\Room_Type;

class RoomController extends Controller
{
    

    function view(): View{
        $meals = Meals::get();
        $room_types = Room_Type::paginate(5);
        return view('admin.rooms.room_type', compact ('meals', 'room_types'));
    }
    function delete($id){
        $meals = Meals::find($id);
        $meals->delete();
        return redirect()->back()->with("error", "Meal has been deleted");
    }

    function editView(int $id): View{
        $meals = Meals::paginate(3);
        $room_types = Room_Type::where('id', $id)->get();
        return view('admin.rooms.edit_room_type', compact ('meals', 'room_types'));
    }

    function update(Request $request, int $id){
        
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required',
            'price' => 'required',
            'total_sleeps' => 'required',
            'description' => 'required',
            'bed' => 'required',
            'restroom' => 'required',
            'wifi' => 'required',
            'ac' => 'required',         
        ],[
            'image.mimes' => 'The room image should be in JPEG, JPG, PNG format.',
            'image.max' => 'The room image max KB is 2048.',
            'required' => 'Please fill out all fields.',
           
        ]);

        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        };
      
        $matchName = Room_Type::where('id', $id)->first();

        if ($matchName) {
            $name = Str::upper($matchName->name);
        } else {
            $findName = Room_Type::where('name', $request->name)->first();
        
            if ($findName) {
                return redirect()
                    ->back()
                    ->with("error", "Room Name already exists")
                    ->withInput();
            } else {
                $name = Str::upper($request->name);
            }
        }

        $rooms = Room_Type::find($id);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/img/', $fileName);
            
            $rooms->update([
            'image' =>  $fileName,
            'name' => $name,
            'price' => $request->price,
            'status' => '1',
            'description' => $request->description,
    
            'bed' => $request->bed,
            'restroom' => $request->restroom,
            'total_sleeps' => $request->total_sleeps,
            'wifi' => $request->wifi,
            'ac' => $request->ac,
            ]);  
    
            return redirect(route('rooms.room_type'))->with("success", "Room has been updated successfully");
        }else{
            $rooms->update([
            'name' => $name,
            'price' => $request->price,
            'status' => '1',
            'description' => $request->description,
    
            'bed' => $request->bed,
            'restroom' => $request->restroom,
            'total_sleeps' => $request->total_sleeps,
            'wifi' => $request->wifi,
            'ac' => $request->ac,
            ]);  
    
            return redirect(route('rooms.room_type'))->with("success", "Room updated successfully");
        }
    }

    function addMeals(Request $request): RedirectResponse {
        $request->validate([
            'inputs.*.name' => 'required',
            'inputs.*.room_type_id' => 'required',  
            'inputs.*.price' => 'required',    
        ],[
            'required' => 'Fill out the form correctly'
        ]);
    
        foreach ($request->inputs as $key => $value) {
            $name = Str::upper($value['name']);
            $room_type_id = Str::upper($value['room_type_id']);
    
            $existingMeal = Meals::where('name', $name)
                ->where('room_type_id', $room_type_id)
                ->first();
    
            if ($existingMeal) {
                return redirect()
                    ->back()
                    ->with("error", "Meal '{$name}' for room type '{$room_type_id}' already exists")
                    ->withInput();
            }
            $value['name'] = $name;
            $value['room_type_id'] = $room_type_id;
            Meals::create($value);  
        }
    
        return redirect()->back()->with("success", "Meals added successfully");
    }
    

    function addRoom(Request $request):RedirectResponse{
        $validator = Validator::make($request->all(), [
            'image' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|unique:room_type',
            'price' => 'required',
            'total_sleeps' => 'required',
            'description' => 'required',

            'bed' => 'required',
            'restroom' => 'required',
            'wifi' => 'required',
            'ac' => 'required',         
        ],[
            'image.mimes' => 'The room image should be in JPEG, JPG, PNG format.',
            'image.max' => 'The room image max KB is 2048.',
            'required' => 'Please fill out each field',
           
        ]);

        $name = Str::upper($request->name);

        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        };

        $fileName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/img/', $fileName);

        $rooms = Room_Type::create([
        'image' =>  $fileName,
        'name' => $name,
        'price' => $request->price,
        'status' => '1',
        'description' => $request->description,

        'bed' => $request->bed,
        'restroom' => $request->restroom,
        'total_sleeps' => $request->total_sleeps,
        'wifi' => $request->wifi,
        'ac' => $request->ac,
        ]);  

        return redirect()->back()->with("success", "Room has been added successfully");
    }


}
