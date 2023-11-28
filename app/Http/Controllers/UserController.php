<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Food;
use App\Models\Branch;
use App\Models\FoodBranch;
use App\Models\FoodAttribute;
use App\Models\Foodchef;
use App\Models\Reservation;
use App\Models\Adtodcart;
use App\Models\Purchase_history;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Stripe;


class UserController extends Controller
{
    public function index()
    {
        $chef = Foodchef::orderBy('id')
            ->take(3)
            ->get();
    
        $food = Food::where('category', 'food')
            ->with('attributes') // Eager load the attributes relationship
            ->orderBy('id')
            ->take(7)
            ->get();
    
        return view('welcome', compact('food', 'chef'));
    }


    // public function cart(Request $request)
    // {
    //     $selectedBranchId = $request->input('branch_id'); // Get the selected branch ID
    //     $selectedFoodId = $request->input('food_id');
    //     $selectedFood = Food::findOrFail($selectedFoodId);
        
    //     // Load branches related to the selected food item
    //     $branches = $selectedFood->branches()->paginate(5); // Paginate the branches
    //     $selectedBranchName = $selectedBranchId ? Branch::find($selectedBranchId)->name : null;

    
    //     $attributes = $selectedFood->attributes()->paginate(5, ['*'], 'attributesPaginated');
    //     $maxPrice = $attributes->max('price') ?? 0;
    
    //     $food = Food::all();
    
    //     return view('user.cart', compact('food', 'selectedFood', 'branches', 'selectedBranchId','selectedBranchName', 'maxPrice', 'attributes'));
    // }
    public function cart(Request $request)
    {
        $selectedFoodId = $request->input('food_id');
        $selectedFood = $selectedFoodId ? Food::findOrFail($selectedFoodId) : new Food();
        
        // Load branches related to the selected food item
        $branches = $selectedFood ? $selectedFood->branches()->paginate(5) : null; // Paginate the branches
        
        $selectedBranchId = $request->input('branch_id'); // Get the selected branch ID
        $selectedBranchName = $selectedBranchId ? Branch::find($selectedBranchId)->name : null;
    
        $attributes = $selectedFood ? $selectedFood->attributes()->paginate(5, ['*'], 'attributesPaginated') : null;
        $maxPrice = $attributes ? $attributes->max('price') : 0;
        
        $food = Food::all();
    
        return view('user.cart', compact('food', 'selectedFood', 'branches', 'selectedBranchId','selectedBranchName', 'maxPrice', 'attributes'));
    }
  
    
    
    
    


    public function addToCart(Request $request)
    {
        $foodId = $request->input('food_id');
        $userId = auth()->id();
        $selectedSize = $request->input('selectedSize');
        $selectedPrice = $request->input('selectedPrice');
        $selectedBranchName = $request->input('selectedBranchName');
        $quantity = $request->input('quantity');
    
        // Find the branch with the given name
        $branch = Branch::where('name', $selectedBranchName)->first();
    
        if (!$branch) {
            return redirect()->back()
                ->with('branch_not_found_error', 'The selected branch does not exist.');
        }
    
        // Check if the item already exists in the cart
        $existingCartItem = Adtodcart::where('user_id', $userId)
            ->where('food_id', $foodId)
            ->where('size', $selectedSize)
            ->where('branch_id', $branch->id)
            ->first();
    
        if ($existingCartItem) {
            // Update the quantity of the existing item
            $existingCartItem->quantity += $quantity;
            $existingCartItem->total_price = $existingCartItem->price * $existingCartItem->quantity;
            $existingCartItem->save();
    
            return redirect()->back()
                ->with('food_added_success', 'Food quantity updated in your cart. Thank You, Happy Shopping.');
        }
    
        // Create a new cart item if it doesn't exist
        $foodItem = Food::join('food_attributes', 'food.id', '=', 'food_attributes.food_id')
            ->select('food.id', 'food.foodtitle', 'food_attributes.price', 'food_attributes.size')
            ->where('food.id', $foodId)
            ->where('food_attributes.size', $selectedSize)
            ->first();
    
        if (!$foodItem) {
            return redirect()->back()
                ->with('food_not_found_error', 'The selected food item does not exist.');
        }
    
        $cartItem = new Adtodcart;
        $cartItem->food_id = $foodId;
        $cartItem->user_id = $userId;
        $cartItem->foodtitle = $foodItem->foodtitle;
        $cartItem->price = $selectedPrice;
        $cartItem->size = $selectedSize;
        $cartItem->branch_id = $branch->id;
        $cartItem->branch_name = $selectedBranchName;
        $cartItem->quantity = $quantity;
        $cartItem->total_price = $cartItem->price * $cartItem->quantity;
        $cartItem->save();
    
        return redirect()->back()
            ->with('food_added_success', 'Food added successfully to your cart. Thank You, Happy Shopping.');
    }

   

//displaying the cart item
// public function cartitem(){

//     $user = auth()->user();
//     $cartItems = Adtodcart::where('user_id', $user->id)
//                     ->with('food')
//                     ->get();

//     return view ('user.addcartpage',compact('user','cartItems'));

// }

public function cartitem()
{
    $user = auth()->user();
    $cartItems = Adtodcart::where('user_id', $user->id)
                    ->with('food')
                    ->get();

    // Check if all items in the cart belong to the same branch
    $sameBranch = true;
    $branchId = null;
    foreach ($cartItems as $cartItem) {
        if ($branchId === null) {
            $branchId = $cartItem->branch_id;
        } else {
            if ($branchId !== $cartItem->branch_id) {
                $sameBranch = false;
                break;
            }
        }
    }

    return view ('user.addcartpage', compact('user', 'cartItems', 'sameBranch'));
}


public function removeCartItem(Adtodcart $cartItem)
{
    // Ensure that the user can only remove items from their own cart
    if ($cartItem->user_id === auth()->id()) {
        $cartItem->delete();
    }
    
    return redirect()->back()->with('success', 'Item removed from your cart successfully');
}

public function stripe($totalprice){
    return view('stripe',compact('totalprice'));
}
   

public function stripePost(Request $request ,$totalprice)

{   

    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    Stripe\Charge::create ([

            "amount" => $totalprice * 100,

            "currency" => "usd",

            "source" => $request->stripeToken,

            "description" => "Test payment from itsolutionstuff.com." 

    ]);  


    $userId = auth()->id();
    $cartItems = Adtodcart::where('user_id', $userId)->get();

    foreach ($cartItems as $cartItem) {
        // Get the food_id and branch_id of the purchased item
        $foodId = $cartItem->food_id;
        $branchId = $cartItem->branch_id;
        $purchasedQuantity = $cartItem->quantity;

        // Find the corresponding food_branch record
        $foodBranch = FoodBranch::where('food_id', $foodId)
            ->where('branch_id', $branchId)
            ->first();

        if ($foodBranch) {
            // Subtract the purchased quantity from the available quantity
            $availableQuantity = $foodBranch->quantity;
            $updatedQuantity = max($availableQuantity - $purchasedQuantity, 0);

            // Update the quantity in the food_branch record
            $foodBranch->quantity = $updatedQuantity;
            $foodBranch->save();
        }

        //today working
      
        $purchaseHistory = new Purchase_history();
        $purchaseHistory->user_id = $userId;
        $purchaseHistory->food_id = $cartItem->food_id;
        $purchaseHistory->branch_id = $cartItem->branch_id;
        $purchaseHistory->quantity = $cartItem->quantity;
        $purchaseHistory->total_price = $cartItem->total_price;
        $purchaseHistory->save();
        
        
    }



    // Clear the user's cart//today working
    Adtodcart::where('user_id', $userId)->delete();

    Session::flash('success', 'Payment successful!');      

    return back();

}


//purcahes history analytic part
public function history()
{
    $user = Auth::user(); // Get the logged-in user

    // Fetch the purchase history data for the logged-in user
    $purchaseHistories = Purchase_history::where('user_id', $user->id)
        ->join('food', 'purchase_histories.food_id', '=', 'food.id')
        ->join('branches', 'purchase_histories.branch_id', '=', 'branches.id')
        ->select('branches.name as branch_name', 'food.foodtitle as food_name', 'purchase_histories.quantity', 'purchase_histories.created_at', 'purchase_histories.total_price','purchase_histories.id')
        ->get();

    $labels = $purchaseHistories->pluck('food_name')->unique()->values(); // Product names
    $datasets = [];
    $branchColors = ['grey', 'light blue', 'green', 'orange', 'purple', 'pink']; // Define distinct colors
    
    // Group data by branch
    $branches = $purchaseHistories->pluck('branch_name')->unique();
    $colorIndex = 0; // Initialize the color index
    foreach ($branches as $branch) {
        $branchData = $purchaseHistories->where('branch_name', $branch)->pluck('quantity');
        $datasets[] = [
            'label' => $branch,
            'data' => $branchData,
            'backgroundColor' => $branchColors[$colorIndex], // Use the specified color for bars
        ];
    
        // Increment the color index (cycling through the colors)
        $colorIndex = ($colorIndex + 1) % count($branchColors);
    }

    return view('user.history', compact('labels', 'datasets','purchaseHistories'));
}
public function deletePurchase($purchaseId)
{
    $user = Auth::user();

    // Ensure that the purchase belongs to the logged-in user
    $purchase = Purchase_history::where('user_id', $user->id)
        ->where('id', $purchaseId)
        ->first();

    if ($purchase) {
        // Delete the purchase history item
        $purchase->delete();

        return redirect()->back()->with('success', 'Purchase history item deleted successfully.');
    }

    return redirect()->back()->with('error', 'Purchase history item not found or you do not have permission to delete it.');
}


public function reservation(Request $request){
        
    $data= new Reservation;
    $data->name=$request->name;
    $data->email=$request->email;
    $data->phone=$request->phone;
    $data->guestno=$request->guest;
    $data->date=$request->date;
    $data->time=$request->time;
    $data->message=$request->message;
    $data->save();
    return redirect()->back();
  
}

}
