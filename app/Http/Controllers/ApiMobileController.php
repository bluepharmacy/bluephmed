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
            		 // 'map.table',
            		 // 'map.table',
            		 // 'locate.td',
            		 // 'locate.tr',
            	 	 'prices.unit_price',
            	 	 'selling.price',
            	 	 'stocks.available As stocks',
            	 	)
            ->orderBy('products.name')
            ->get();
            return $prod;
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

	// get all low stock
	public function lowStock()
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
            	 	 'prices.unit_price',
            	 	 'selling.price',
            	 	 'stocks.available As stocks',
            	 	)
            ->where('stocks.available', '<', 3)
            ->orderBy('products.name')
            ->get();
            return $prod;
	}

     // get selected item using ID
     public function getProduct(Request $request)
     {
        $prod = Product::join('prices', 'products.id', '=', 'prices.product_id')
                        ->leftjoin('selling', 'products.id', '=', 'selling.product_id')
                        ->leftjoin('locate', 'products.locate_id', '=', 'locate.id')
                        ->leftjoin('map', 'locate.map_id', '=', 'map.id')
                        ->leftjoin('unit', 'products.unit_id', '=', 'unit.id')
                        ->leftjoin('stocks', 'products.id', '=', 'stocks.product_id')
                        ->select(
                                 'products.id',
                                 'products.name',
                                 'unit.per As per',
                                 'map.name As location',
                                 'prices.unit_price',
                                 'selling.price',
                                 'stocks.available As stocks',
                                 // 'prices.id As price_id',
                                 // 'selling.id As sell_id',
                                )
                        ->where('products.id', '=', $request->id)
                        ->get();  
        return $prod;

     } 

     // get selected pendingSalesID
     public function getPendingSalesID(Request $request)
     {
        $pending_sales = Pending_Sales::find($request->id);
        return $pending_sales;
     }



     // move data = [stocks,unit_price,price,]
     public function moveStocksUnitPandSellingP(Request $request)
     {
            foreach($request->ids as $key => $value){ 
                    $products = Product::find($request->ids[$key]); 
                    $products->unit_price = $request->unit_prices[$key]; 
                    $products->sell_price = $request->prices[$key]; 
                    $products->stocks = $request->stocks[$key]; 
                    $products->save(); 
            }
            return "success";
     }


    public function getAllDisplayOnAddStocksView()
    {

        $data_allStocks = DB::table('products')
            ->leftjoin('locate', 'products.locate_id', '=', 'locate.id')
            ->leftjoin('map', 'locate.map_id', '=', 'map.id')
            ->leftjoin('unit', 'products.unit_id', '=', 'unit.id')
            ->leftjoin('classification', 'products.classification_id', '=', 'classification.id')
            ->leftjoin('supplier', 'products.sold_from', '=', 'supplier.id')
            ->select(
                     'products.id',
                     'products.name',
                     'products.unit_price',
                     'products.sell_price As price',
                     'products.stocks',
                     'products.stocks_alert',
                     'products.discount',
                     'products.sold_from As sold_fromID',
                     'products.classification_id',
                     'supplier.name As sold_from',
                     'classification.name As classification_name',
                     'unit.id As perID',
                     'unit.per As per',
                     'products.locate_id',
                     'map.id As map_id',
                     'map.name As location',
                     'map.table',
                     'map.table',
                     'locate.td',
                     'locate.tr',
                    )
            ->orderBy('products.name')
            ->get();
            
    
        $data_unit = DB::table('unit')
                        ->select(
                                'unit.id',
                                'unit.per',
                                )
                        ->get();

        $data_supplier = DB::table('supplier')
                            ->select(
                                    'supplier.id',
                                    'supplier.name'
                                    )
                            ->get();

        $data_classification = DB::table('classification')
                                ->select(
                                        'classification.id',
                                        'classification.name'
                                        )
                                ->get();

        $data_map = DB::table('map')
                        ->select(
                                'map.id',
                                'map.name',
                                'map.table',
                                )
                        ->get();

        
        $arr_allStocks = array('stocks' => $data_allStocks);
        $arr_unit = array('unit' => $data_unit);
        $arr_supplier = array('supplier' => $data_supplier);
        $arr_classification = array('classification' => $data_classification);
        $arr_map = array('map' => $data_map);

        return array_merge($arr_allStocks,$arr_unit,$arr_supplier,$arr_classification,$arr_map);
    }


    public function insertNewStocks(Request $request)
    {
        // return $request->name;
        $product = Product::where('name', strtoupper($request->name))->first();

        if($product == null)
        {
            $product = new Product();
            $product->name = strtoupper($request->name);
            $product->unit_price = $request->unit_price;
            $product->sell_price = $request->sell_price;
            $product->unit_id = $request->per_ID;
            $product->sold_from = $request->sold_from;
            $product->classification_id = $request->classification_id;
            $product->stocks = $request->stocks_to_add;
            $product->stocks_alert = $request->stocks_alert;
            $product->discount = $request->discount;

            $locate = Locate::where('target',$request->map_id . "|" .$request->tr. "|" .$request->td)->first();
            $locate_id = "";

            if($locate == null)
            {
                $new_locate = new Locate();
                $new_locate->target = $request->map_id . "|" .$request->tr. "|" .$request->td;
                $new_locate->map_id = $request->map_id;
                $new_locate->tr = $request->tr;
                $new_locate->td = $request->td;
                $new_locate->save();
                $locate_id = $new_locate->id;
            }
            else
            {
                $locate_id = $locate->id;
            }

            $product->locate_id = $locate_id;
            $product->save();




            return response()->json([
                'error' => false,
                'message' => '<b style="color:green">Successfully Inserted</b>',
                'product' => $product,
            ], 200);

        }
        else
        {
            return response()->json([
                'error' => false,
                'message' => '<b style="color:red">This Item is Already Exists [Not Saved]</b>',
                'product' => $product,
            ], 200);
        }
    }



    public function insertExistsStocks(Request $request)
    {
        $product = Product::where('name', strtoupper($request->name))->first();

        if($product == null)
        {
            
            return response()->json([
                'error' => false,
                'message' => '<b style="color:red">This Item is NOT EXIST [Not Saved]</b>',
                'product' => $product,
            ], 200);

        }
        else
        {
            $product->name = strtoupper($request->name);
            $product->unit_price = $request->unit_price;
            $product->sell_price = $request->sell_price;
            $product->unit_id = $request->per_ID;
            $product->sold_from = $request->sold_from;
            $product->classification_id = $request->classification_id;
            $product->stocks = $product->stocks + $request->stocks_to_add;
            $product->stocks_alert = $request->stocks_alert;
            $product->discount = $request->discount;

            $locate = Locate::where('target',$request->map_id . "|" .$request->tr. "|" .$request->td)->first();
            $locate_id = "";

            if($locate == null)
            {
                $new_locate = new Locate();
                $new_locate->target = $request->map_id . "|" .$request->tr. "|" .$request->td;
                $new_locate->map_id = $request->map_id;
                $new_locate->tr = $request->tr;
                $new_locate->td = $request->td;
                $new_locate->save();
                $locate_id = $new_locate->id;
            }
            else
            {
                $locate_id = $locate->id;
            }

            $product->locate_id = $locate_id;
            $product->save();
            
            return response()->json([
                'error' => false,
                'message' => '<b style="color:green">Stocks Successfully in this Item</b>',
                'product' => $product,
            ], 200);
        }
    }


    public function counterGetAllStocks()
    {
         $data = DB::table('products')
            ->leftjoin('locate', 'products.locate_id', '=', 'locate.id')
            ->leftjoin('map', 'locate.map_id', '=', 'map.id')
            ->leftjoin('unit', 'products.unit_id', '=', 'unit.id')
            ->leftjoin('classification', 'products.classification_id', '=', 'classification.id')
            ->leftjoin('supplier', 'products.sold_from', '=', 'supplier.id')
            ->select(
                     'products.id',
                     'products.name',
                     'products.unit_price',
                     'products.sell_price As price',
                     'products.stocks',
                     'products.stocks_alert',
                     'products.discount',
                     'products.sold_from As sold_fromID',
                     'products.classification_id',
                     'supplier.name As sold_from',
                     'classification.name As classification_name',
                     'unit.id As perID',
                     'unit.per As per',
                     'products.locate_id',
                     'map.id As map_id',
                     'map.name As location',
                     'map.table',
                     'map.table',
                     'locate.td',
                     'locate.tr',
                    )
            ->orderBy('products.name')
            ->get();

            return $data;
    }


    public function salesToCashier(Request $request)
  {

    $pending_sales = new Pending_Sales;
    $pending_sales->staff_id = $request->staff_id;
    $pending_sales->sales = $request->sales;
    $pending_sales->save();

    return "<b>Sales #".$pending_sales->id."</b> has been sent to cashier \nPlease present this number to your cashier\n<b>SO#".$pending_sales->id."</b>";
  }


  public function insertSalesAndTransaction(Request $request)
  {
    $transactions_search = Transactions::where('pending_sales_id', $request->so_number)->first();
    if($transactions_search == "")
    {
// Transaction
    $transactions = new Transactions;
    $transactions->customer_id = $request->customer_id;
    $transactions->customer_name = $request->customer_name;
    $transactions->payment = "Cash";
    $transactions->shipping = "0.00";
    $transactions->discount_less = "0.00";
    $transactions->grand_total = $request->grand_total;
    $transactions->customer_money = $request->money_amount;
    $transactions->change = $request->change;
    $transactions->staff_id_counter = $request->counter_id;
    $transactions->staff_id_cashier = $request->cashier_id;
    $transactions->pending_sales_id = $request->so_number;
    ($request->date_time == null) ?   :  $transactions->created_at = $request->date_time; // set created_at date when date_time is not null
    $transactions->save();


// // Sales and Products[Stocks Update]
    $arr = $request->items;
    $data = json_decode($arr[0], true);

    foreach($data as $key)
    {
      $dc_rate = 0;
      $discounted = 0;
      if($request->temp_DiscountVal == "1" || $request->temp_DiscountVal == "2")
      {
        $discounted = 1;
        $dc_rate = ($request->temp_DiscountVal == "1") ? "20" : "32"; 
      }

      $product = Product::find($key['id']);

      $sales = new Sales;
      $sales->transaction_id       = $transactions->id;
      $sales->product_id           = $product->id;
      $sales->quantity             = $key['temp_Qty'];
      $sales->discounted           = $discounted;
      $sales->discount_rate        = $dc_rate;
      $sales->price_per_unit       = $key['price'];
      $sales->total_price          = $key['temp_Total'];
      $sales->original_total_price = $key['temp_OrigTotal'];
      // $sales->discount_less_note   = $key['discount_less_note'];
      $sales->save();

      $product->stocks = $product->stocks - $key['temp_Qty'];
      $product->save();

    }


    // remove in pending list
    $pending_sales = Pending_Sales::find($transactions->pending_sales_id);
    $pending_sales->delete();

    return response()->json([
                'error' => false,
                'message' => "<b>Transactions #" . $transactions->id . "</b><br>Your Change: <b style='font-size:180%'>₱".$request->change."</b>",
                'timeCreated' => $transactions->created_at,
                'transactionID' => $transactions->id,
            ], 200);

  }else{

    return response()->json([
                'error' => false,
                'message' => "<b style='color:red'>This S0#".$request->so_number." is Already Done by Cashier #".$transactions_search->staff_id_cashier."</b>",
                // 'timeCreated' => $transactions_search->created_at,
            ], 200);
  }


  }



}
