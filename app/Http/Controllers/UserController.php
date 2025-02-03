<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Estate;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function addEstate()
    {
        if(Auth::id())
        {
          $data = category::all();
          return view('home.addEstate',compact('data'));  
        }
        else{
            return redirect('login');
        }
    }

     // store estate
    public function storeEstate(Request $request)
    {
        $estate = new Estate;
       
        // Ensure the 'images' field is an array of files
        $imageNames = []; // To store the names of uploaded images

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Generate a unique name for each image
                $filename = time() . '_' . uniqid() . '.' . $image->extension();

                // Move the image to the public directory
                $image->move(public_path('/assets/img/'), $filename);

                // Add the filename to the array
                $imageNames[] = $filename;
            }
        }

        // Convert the array of image names to a comma-separated string
        $imagesString = implode(',', $imageNames);

        // make the specifications as array
        $specifications = $request->input('specification');
        // Convert array to comma-separated string
        $specificaitonString = implode(',', $specifications );

        $estate->type=$request->type;
        $estate->category_id=$request->category;
        $estate->floor=$request->floor;
        $estate->pieces=$request->pieces;
        $estate->surface=$request->surface;
        $estate->specification =$specificaitonString;
        $estate->price=$request->price;
        $estate->price_unit=$request->price_unit;
        $estate->state=$request->state;
        $estate->town=$request->town;
        $estate->city=$request->city;
        $estate->description=$request->description;
        $estate->images=$imagesString;
        $estate->phone=$request->phone;
        
        //dd($estate);  for testing
        $estate->save();
        return redirect()->back()->with('message','immobilier ajouté avec succéss !');
    }

    /* estate detail */
    public function estateList($category_id)
    {
        $data = Estate::where('category_id',$category_id)->get();
        return view('home.estates-list',['data'=>$data]);
        //dd($data);
        //return view('home.estate-detail');
    }

    /* public function estateDetail($id)
    {
        $data = Estate::where('id',$id)->get();
        return view('home.estate-detail', ['data' => $data,'images' => explode(',', $data->images)]);
    } */
    public function estateDetail($id)
    {
        $data = Estate::where('id', $id)->first(); // Fetch a single record
        if (!$data) {
            return redirect()->back()->with('error', 'Estate not found.');
        }
    
        return view('home.estate-detail', [
            'data' => $data,
            'images' => explode(',', $data->images),
            'specifications' => explode(',', $data->specification)
        ]);
    }
    
}

