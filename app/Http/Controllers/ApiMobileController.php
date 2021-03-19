<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Product;
use App\Unit;
use App\Selling;
use App\Prices;
use App\Order_Receipt;
use App\Or_Number;
use App\Stocks;
use App\History;
use App\Classification;
use App\Supplier;
use App\Map;
use App\Locate;
use App\Pending_Sales;
use App\Transactions;
use App\Sales;
use App\Users_type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;

class ApiMobileController extends Controller
{

	// Check if Logged in
	public function checkIsLoggedIn()
    {
        dd("you authenticated")->middleware('auth');
    }

    
    //Get all Users
    public function getAllUsers()
    { 
	    	return User::all();
	}

	// Get all Newbies Users
	public function getAllNewbies()
	{
		// $users = User::where('user_type' ,'=', 0)->get();
		// return $users;
		$users = DB::table('users')
            ->select(
            	 	 'id',
            	 	 'name',
            	 	 'email',
            	 	 'user_type',
            	 	 'created_at',
            	 	 'updated_at',
            	 	)
            ->where('user_type' ,'=', 0)
            ->get();
            return $users;
	}

    // Login Request
    public function loginMyAcc(Request $request)
	{

		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    	// Authentication was successful...
			$user = Auth::user();
			return response()->json([
                'error' => false,
                'message' => "Successfully Login",
                'user' => $user,
            ], 200);
		}
		else
		{
			return response()->json([
                'error' => true,
                'message' => "Credential not Match",
            ], 500);
		}

	}

	// Register my acc
	public function regMyAcc(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'error' => false,
            'message' => 'Successfully Registered',
        ], 201);
    }

    // Remove this id in New Users (ma dedelete niya yung user na ang user_type=0 na di approve sa mga sumasali)
    public function removeThisInNewUsers(Request $request)
	{
		// remove record in pending sales
			$user = User::find($request->id);
			$user->delete();
	}

	// Remove selected ids in New Users (Multiple Deletions sa mga user na ang user_type=0) 
	public function removeThisListInNewUsers(Request $request)
	{
		$ids = $request->ids;
		User::whereIn('id',$ids)->delete();
		return response()->json(['success'=>'Users have been rejected!']);
	}

	public function singleAcceptNewUser(Request $request)
	{
		$user = User::find($request->id);
		$user->user_type = $request->user_type;
		$user->save();
	}

	public function multiAcceptNewUsers(Request $request)
	{
		// Multiple update format
		foreach($request->ids as $key => $value){ 
      		$user = User::find($request->ids[$key]); 
      		$user->user_type = $request->user_types[$key]; 
      		$user->save(); 
		}
		

		return response()->json(['sucess'=>'Users have been acccepted']);
	}


	public function getAllStocks()
	{
		{
		// return Product::all();
		$prod = DB::table('products')
            ->join('prices', 'products.id', '=', 'prices.product_id')
            ->join('selling', 'products.id', '=', 'selling.product_id')
            ->leftjoin('locate', 'products.locate_id', '=', 'locate.id')
            ->leftjoin('map', 'locate.map_id', '=', 'map.id')
            ->leftjoin('unit', 'products.unit_id', '=', 'unit.id')
            ->leftjoin('stocks', 'products.id', '=', 'stocks.product_id')
            ->select(
            		 'products.id',
            		 'products.name',
            		 'unit.per As per',
            		 'products.locate_id',
            		 'map.name As location',
            		 'map.table',
            		 'map.table',
            		 'locate.td',
            		 'locate.tr',
            	 	 'prices.unit_price',
            	 	 'selling.price',
            	 	 'stocks.available As stocks',
            	 	)
            ->get();
            return $prod;
		}
	}

	public function updateStock(Request $request)
	{
		// return $request;

		// Product
		$product = Product::find($request->id);
		$product->update(['name' => $request->name]);

		// Selling
		$selling = Selling::where('product_id',$request->id);
		// $selling->price = $request->price;
		$selling->update(['price'=>$request->price]);

		// Prices
		$prices = Prices::where('product_id', $request->id);
		// $prices->unit_price = $request->unit_price;

		$prices->update(['unit_price'=>$request->unit_price]);

		// Stocks
		$stocks = Stocks::where('product_id', $request->id);
		$stocks->update(['available'=>$request->stocks]);



		#save

		// return $product;
	}



}
