<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Estate;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function home()
    {
        $data = Category::withCount('estates')->get(); // Fetch all categories
        
        return view('home.index', ['data' => $data]);
    }
    // ------
     public function index()
    {
        $data = Category::withCount('estates')->get(); // Fetch all categories
        if(Auth::id())
        {
            $usertype = Auth()->user()->usertype;
            if($usertype == 'user')
            {
                return view('home.index', ['data' => $data]);
            }
            else if($usertype == 'admin')
            {
                $estateCount = Estate::Count();
                $categoriesCount = Category::Count();
                $usersCount = User::Count();
                return view('admin.index', ['data' => $data,'estateCount' => $estateCount, 'categoriesCount' => $categoriesCount, 'usersCount' => $usersCount]);
            }
            else{
                return redirect()->back();
            }
        }
    } 

    // Log out the user ---
    public function logout(Request $request) 
   {
    Auth::logout();

    // Invalidate the session and regenerate the CSRF token
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect the user to the login page (or wherever you want)
    return redirect('/')->with('message', 'You have been logged out.');
    }

    // ---- categories
    public function categories()
    {
        $data = Category::withCount('estates')->get(); // Fetch all categories
        return view('admin.categories', ['data'=>$data]);
    }

    // ---- add category
    public function addCategory()
    {
        return view('admin.add-category');
    }
    // ---- store category
    public function storeCategory(Request $request)
    {
        $category = new category;

        $filename='';
        if($request->hasFile('image')){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('/assets/img/'), $filename);  // stock image in img folder
        }

        $category->name=$request->name;
        $category->image=$filename;

        // Debug: Check the category object before saving
       // dd($category);
        $category->save();
        return redirect()->back()->with('message','category ajouté avec succéss !');
    }

    public function deleteCategory($id)
    {
    $item = Category::findOrFail($id);
    $item->delete();

    return redirect()->back()->with('success', 'Item deleted successfully.');
    }

    /* ------- estate detail */
    public function estateList($category_id)
    {
        $data = Estate::where('category_id',$category_id)->get(); 
        //return view('admin.estates-list',['data'=>$data]);
        // Process the images for each estate
        $data->each(function ($estate) {
            $estate->images_array = explode(',', $estate->images); // Add a property for the images array
        });
        return view('admin.estates-list', [
            'data' => $data,
        ]);
    
        //dd($data);
        //return view('home.estate-detail');
    }
    
    // estates list -----
    public function AllEstateList()
    {
        $data = Estate::all(); 
    $data->each(function ($estate) {
        $estate->images_array = explode(',', $estate->images); // Add a property for the images array
    });
    return view('admin.all-estates-list', [
        'data' => $data,
    ]);
    }

    // users list -----
    public function UsersList()
    {
    return view('admin.users');
    }
}
