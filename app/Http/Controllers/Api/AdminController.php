<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Foodchef;
use App\Models\Branch;
use App\Models\FoodBranch;
use App\Models\FoodAttribute;

class AdminController extends Controller
{

  //add food
    public function store(Request $request)
    {// Validate the incoming request data
    $validatedData = $request->validate([
        'foodtitle' => 'required|string',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category' => 'required|string',
        'branch_id' => 'required|exists:branches,id',
        'quantity' => 'required|integer',
        'size' => 'required|string',
        'price' => 'required|string',
        'quty' => 'required|string',
    ]);

    // Upload and store the food image
    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
    $request->image->move(public_path('food'), $imageName);

    // Create the food item
    $food = Food::create([
        'foodtitle' => $validatedData['foodtitle'],
        'description' => $validatedData['description'],
        'image' => $imageName,
        'category' => $validatedData['category'],
    ]);

    // Associate food with branch and quantity
    $food->branches()->attach($validatedData['branch_id'], ['quantity' => $validatedData['quantity']]);

    // Create food attributes
    $foodAttributes = FoodAttribute::create([
        'food_id' => $food->id,
        'size' => $validatedData['size'],
        'price' => $validatedData['price'],
        'quty'=>  $validatedData['quty'],
    ]);

    return response()->json(['message' => 'Food item added successfully'],201);
    }




//delete food

    public function deleteFood($id)
    {
        $food = Food::find($id);
    
        if (!$food) {
            return response()->json(['message' => 'Food item not found'], 404);
        }
    
        $food->delete();
    
        return response()->json(['message' => 'Food item deleted successfully'], 200);
    }





  //  public function updatefood(Request $request, $id)
  //  {
        // Find the food item by ID
      //  $food = Food::find($id);
        //if (!$food) {
          //  return response()->json(['message' => 'Food item not found'], 404);
       // }
    
        // Define the validation rules
       // $rules = [
          //  'branch_id' => 'required|exists:branches,id',
            //'quantity' => 'nullable|integer',
           // 'size' => 'nullable|string',
           // 'price' => 'nullable|string',
           // 'quty' => 'nullable|string',
       // ];
    
        // If any of the following fields are included in the request, they must pass validation
        //if ($request->has('foodtitle')) {
          //  $rules['foodtitle'] = 'required|string';
       // }
    
      //  if ($request->has('description')) {
       //     $rules['description'] = 'required|string';
       // }
    
       
    
        // Validate the incoming request data
       // $validator = Validator::make($request->all(), $rules);
    
       // if ($validator->fails()) {
         //   return response()->json(['errors' => $validator->errors()], 400);
       // }
    
        // Update the food item's details
       // $food->update([
         //   'foodtitle' => $request->input('foodtitle', $food->foodtitle), // Use the existing value if not provided
          //  'description' => $request->input('description', $food->description), // Use the existing value if not provided
      //  ]);
    
      //  if ($request->has('branch_id')) {
        //    $food->branches()->sync([$request->input('branch_id') => ['quantity' => $request->input('quantity')]]);
       // }
    
        // Update the food attributes
      //  $food->attributes()->update([
            //'size' => $request->input('size'),
           // 'price' => $request->input('price'),
         //   'quty' => $request->input('quty'),
       // ]);
    
       // return response()->json(['message' => 'Food item updated successfully'], 200);
    //}

    //update food

    public function updatefood(Request $request, $id)
    {
        // Find the food item by ID
        $food = Food::find($id);
        if (!$food) {
            return response()->json(['message' => 'Food item not found'], 404);
        }
    
        // Define the validation rules
        $rules = [
            'branch_id' => 'exists:branches,id',
            'quantity' => 'nullable|integer',
            'size' => 'nullable|string',
            'price' => 'nullable|string',
            'quty' => 'nullable|string',
            'foodtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    
        // Validate the incoming request data
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        if ($request->has(['size', 'price', 'quty'])) {
          $food->attributes()->update([
              'size' => $request->input('size'),
              'price' => $request->input('price'),
              'quty' => $request->input('quty'),
          ]);
      }
        // Create an array to hold the fields to update
        $updateFields = [];
    
        if ($request->has(['branch_id', 'quantity'])) {
          // Find the specified branch in the pivot table
          $branch = $food->branches()->where('branch_id', $request->input('branch_id'))->first();
          if ($branch) {
              // If the branch is found, update the quantity
              $food->branches()->updateExistingPivot($request->input('branch_id'), ['quantity' => $request->input('quantity')]);
          } else {
              // If the branch is not found, attach a new branch with the specified quantity
              $food->branches()->attach($request->input('branch_id'), ['quantity' => $request->input('quantity')]);
          }
      }

        // Check if the request contains 'foodtitle', 'description', or 'image'
        if ($request->has('foodtitle')) {
            $updateFields['foodtitle'] = $request->input('foodtitle');
        }
    
        if ($request->has('description')) {
            $updateFields['description'] = $request->input('description');
        }
    
        if ($request->hasFile('image')) {
            // Handle image upload and update image field
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('food'), $imageName);
            $updateFields['image'] = $imageName;
        }
    
        // Update the food item with the specified fields
        $food->update($updateFields);
    
        return response()->json(['message' => 'Food item updated successfully'], 200);
    }

//get food

public function getfood() {
    // Retrieve all food items with their related data
    $foods = Food::with('attributes', 'branches')->get();

    // Return the result as a JSON response
    return response()->json(['foods' => $foods]);
}






}
