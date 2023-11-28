<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Food;
use App\Models\Foodchef;
use App\Models\Branch;
use App\Models\FoodBranch;
use App\Models\FoodAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class AdminController extends Controller
{
    public function index()
    {
        $user=user::all();
        return view('admin.admin',compact("user")); 

    }

     public function search(Request $request){
 
        if($request->ajax()){
 
            $data=User::where('id','like','%'.$request->search.'%')
            ->orwhere('name','like','%'.$request->search.'%')
            ->orwhere('email','like','%'.$request->search.'%')->get();
 
            $output='';
            if(count($data)>0){
                $output ='
                    <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>';
                        foreach($data as $row){
                            $output .='
                            <tr>
                            <th scope="row">'.$row->id.'</th>
                            <td>'.$row->name.'</td>
                            <td>'.$row->email.'</td>
                            
                            </tr>
                            ';
                        }
                $output .= '
                    </tbody>
                    </table>';
            }
            else{
                $output .='No results';
            }
            return $output;
        }
    }


    //View and CRUD function for food
    public function foodmenu(){
        $food = Food::all();
        $branches = Branch::all();
        $foodCount = Food::where('category', 'food')->count();
        $beverageCount = Food::where('category', 'beverages')->count();
        $dessertCount = Food::where('category', 'dessert')->count();

        // Loop through each branch
      //  foreach ($branches as $branch) {
            // Fetch food items associated with the current branch
           // $foodByBranch[$branch->name] = Food::whereHas('branches', function ($query) use ($branch) {
                //$query->where('branch_id', $branch->id);
          //  })->get();
      //  }
    
        return view("admin.foodmenu",[
            'foodCount' => $foodCount,
            'beverageCount' => $beverageCount,
            'dessertCount' => $dessertCount,
            'food' => $food,
            'branches' => $branches
        ]);
    }

    public function store(Request $request){
    $validatedData = $request->validate([
        'foodtitle' => 'required|string',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category' => 'required|string',
   
    ]);

    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
    $request->image->move(public_path('food'), $imageName);

 
    // Create the food item
    $food = new Food;
    $food->foodtitle = $validatedData['foodtitle'];
    $food->description = $validatedData['description'];
    $food->image = $imageName;
    $food->category = $validatedData['category'];
    $food->save();

    // Create an array to hold the attributes
    $attributeData = [];

    // Loop through the attributes submitted in the form
    $sizes = $request->input('sizes');
    $prices = $request->input('prices');
    $quantities = $request->input('quty');
    
    foreach ($sizes as $index => $size) {
        $attributeData[] = [
            'size' => $size,
            'price' => $prices[$index],
            'quty' => $quantities[$index],
        ];
    }

    // Create and attach attributes to the food item
    $food->attributes()->createMany($attributeData);

    $branches = $request->input('branches');
    $branchQuantities = $request->input('branch_quantities');

    foreach ($branches as $branchId) {
        $foodBranch = new FoodBranch;
        $foodBranch->food_id = $food->id;
        $foodBranch->branch_id = $branchId;

        // Get the quantity for this branch from the input
        $quantity = isset($branchQuantities[$branchId]) ? $branchQuantities[$branchId] : 0;

        // Store the quantity in the database
        $foodBranch->quantity = $quantity;

        $foodBranch->save();
    }

    return redirect()->back()->with('success', 'Food item added successfully');
}




public function deleteFood($id){
    $food=food::find($id);
    $food->delete();
    return redirect()->back();
}


public function updateFood(Request $request)
{
    try {
        $request->validate([
            'foodtitle' => 'required|string',
            'description' => 'required|string',
            'new_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'edit_sizes.*' => 'required|string',
            'edit_prices.*' => 'required|numeric',
            'edit_qtys.*' => 'required|numeric',
          
        ]);

        $foodId = $request->input('food_id');
        $food = Food::findOrFail($foodId);

        // Update regular food details
        $food->foodtitle = $request->input('foodtitle');
        $food->description = $request->input('description');

        if ($request->hasFile('new_image')) {
            $imageName = time() . '.' . $request->file('new_image')->getClientOriginalExtension();
            $request->file('new_image')->move(public_path('food'), $imageName);
            $food->image = $imageName;
        }
        

        $food->save();
        

        // Update attributes
        foreach ($food->attributes as $index => $attribute) {
            $attribute->size = $request->input('edit_sizes')[$index];
            $attribute->price = $request->input('edit_prices')[$index];
            $attribute->quty = $request->input('edit_qtys')[$index];
            $attribute->save();
        }

        return redirect()->back()->with('success', 'Food item updated successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while updating the food item.');
    }
}












//View and all CRUD function  to chef

public function chefview(){
    $chef = Foodchef::all();
    return view("admin.chefdash",compact('chef'));
}

public function storechef(Request $request){
    $validatedData = $request->validate([
        'name' => 'required|string',
        'speciality' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
       
    ]);

    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
    $request->image->move(public_path('chef'), $imageName);

    $chef = new Foodchef;
    $chef->name = $validatedData['name'];
    $chef->speciality = $validatedData['speciality'];
    $chef->image = $imageName;
    $chef->save();

    return redirect()->back()->with('success', 'Food item added successfully');
}

public function deleteChef($id){
    $chef=foodchef::find($id);
    $chef->delete();
    return redirect()->back();
}

public function updatechef(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string',
            'speciality' => 'required|string',
            'new_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $chefId = $request->input('chef_id');
        $chef = Foodchef::findOrFail($chefId);

        $chef->name = $request->input('name');
        $chef->speciality = $request->input('speciality');

        if ($request->hasFile('new_image')) {
            $imageName = time() . '.' . $request->file('new_image')->getClientOriginalExtension();
            $request->file('new_image')->move(public_path('chef'), $imageName);
            $chef->image = $imageName;
        }

        $chef->save();

        return redirect()->back()->with('success', 'Chef information updated successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while updating the chef information.');
    }
}

public function changePassword(Request $request, $id){
    $data = User::find($id);

    $data->update([
        'password' => Hash::make($request->newpw),
    ]);
    
    Session::flash('success', 'Password updated successfully!');
    Auth::logout();

    return redirect('/login');
}

public function updatep(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        // Add other profile fields validation here if needed
    ]);

    // Update the user's profile
    $user = Auth::user();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');
    $user->address = $request->input('address');
    // Update other profile fields here if needed
    $user->save();

    // Redirect the user back to the profile page with a success message
    return redirect()->back();
}

public function deleteProfile()
{
    $user = Auth::user(); // Get the authenticated user
    $user->delete(); // Delete the user

    // Logout the user after deletion
    Auth::logout();

    // Redirect to the registration page (or any other desired page)
    return redirect()->route('register')->with('success', 'Your profile has been deleted successfully.');
}



}
