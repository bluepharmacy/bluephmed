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
use DB;

class ApiTestController extends Controller
{

	// Show All users
	public function getAllUsers()
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

    //Create Product -- 
	public function createProduct(Request $request)
	{
		Product::create([
            'name' => $request->name,
            'sold_from' => $request->sold_from,
        ]);
		return response()->json($request);

	}



	// Create Selling --
	public function createSelling(Request $request)
	{
		Selling::create([
			'product_id' => $request->product_id,
			'per' => $request->per,
			'price' => $request->price,
		]);
	}

	// Create Prices --
	public function createPrices(Request $request)
	{
		Prices::create([
			'product_id' => $request->product_id,
			'per' => $request->per,
			'unit_price' => $request->unit_price,
		]);
	}

	// Create Order Receipt
	public function createOrderReceipt(Request $request)
	{
		Order_Receipt::create([
			'or_id' => $request->or_id,
			'product_id' => $request->product_id,
			'qty' => $request->qty,
			'unit_name_id' => $request->unit_name_id,
			'unit_price' => $request->unit_price,
			'unit_amount' =>$request->unit_amount,
			'unit_price_per_pieces' => $request->unit_price_per_pieces,
			'selling_price_id' => $request->selling_price_id,
		]);
	}

	// Create Or Number
	public function createOrNumber(Request $request)
	{
		Or_Number::create([
			'order_receipt_number' => $request->order_receipt_number,
			'unit_amount_total' => $request->unit_amount_total,
		]);
	}



	// Create Stocks
	public function createStocks(Request $request)
	{
		Stocks::create([
			'product_id' => $request->product_id,
			'available' => $request->available,
			'alert' => $request->alert,
		]);
	}




// TEST------------

	public function testPostMan(Request $request)
	{

		// Pending_Sales::create([
		// 	'staff_id' => $request->staff_id,
		// 	'sales' => $request->sales,
		// ]);
		// return $request;
	}

	public function testUpdate()
	{
		
		$product = Product::find(33);

		$product->name = 'Julius Po';

		$product->save();
		echo "updated";
	}


	public function testInsertToMultipleTable(Request $request)
	{

		$history = new History;
		$prod_search = Product::where('name', $request->name)->first();
		if($prod_search != '')
		{
			// update product


			
			$prices = Prices::where('product_id', $prod_search->id)->first();
			$selling= Selling::where('product_id', $prod_search->id)->first();
			$stocks = Stocks::where('product_id', $prod_search->id)->first();

			

			// Add History
			$add_in_history = "";
			$add_in_history.= ($request->sold_from != $prod_search->sold_from) ? 'sold_from=Updated into "'.$prod_search->sold_from.'"' : 'sold_from=';
			
			$uprice = ($prices->unit_price == $request->unit) ? true : false;
			if($uprice)
			{
				$add_in_history .= "&unit_price=";
			}
			else
			{
				$add_in_history.= ($prices->unit_price > $request->unit_price) ? '&unit_price=Decreased from "'.$prices->unit_price.'" to "'.$request->unit_price.'"' : '&unit_price=Increased from "'.$prices->unit_price.'" to "'.$request->unit_price.'"';
			}

			$sprice = ($selling->price == $request->selling_price) ? true : false;
			if($sprice)
			{
				$add_in_history .= "&selling_price=";
			}
			else
			{
				$add_in_history.= ($selling->price > $request->selling_price) ? '&selling_price=Decreased from "'.$selling->price.'" to "'.$request->selling_price.'"' : '&selling_price=Increased from "'.$selling->price.'" to "'.$request->selling_price.'"';
			}

			$prod_search->name = $request->name;
			$prod_search->sold_from = $request->sold_from;
			$prices->unit_price = $request->unit_price;
			$selling->price = $request->selling_price;
			$stocks->available = $stocks->available + $request->stocks;

			$add_in_history .= "&stocks=".$request->stocks." Stocks added,Stocks Available is ".$stocks->available;

			// history
			$history->product_id = $prod_search->id;
			$history->method = 'update';
			$history->data = $add_in_history;
			$history->save();


			// Saving
			$prod_search->save();
			$prices->save();
			$selling->save();
			$stocks->save();


		}
		else
		{

		
			$product = new Product;
			$prices = new Prices;
			$selling = new Selling;
			$stocks = new Stocks;

			// Product
			$product->name = $request->name;
			// $product->sold_from = $request->sold_from;
			$product->sold_from = 1;
			$product->classification_id = 1;
			$product->save();

			$prod_search = Product::where('name', $request->name)->first();


			// Prices
			$prices->unit_price = $request->unit_price;
			$prices->product_id = $prod_search->id;
			$prices->per = "Cap"; //--------------------->sample

			// Selling
			$selling->price = $request->selling_price;
			$selling->product_id = $prod_search->id;
			$selling->per = "Cap"; //--------------------->sample

			// Stocks
			$stocks->available = $request->stocks;
			$stocks->product_id = $prod_search->id;
			$stocks->alert = "1"; //--------------------->sample

			// add product
			

			$prices->save();
			$selling->save();
			$stocks->save();
			echo "added";



		}




		


	}

	public function insertByLocation(Request $request)
	{
		// check if empty
		return "test";

	}

	public function showByLocation()
	{
		return Unit::all();
	}





	/* System Last :::::::::::::::::::: */

	public function createSupplier(Request $request)
	{
		Supplier::create([
			'name' => $request->name,
			'contact_number' => $request->contact_number,
			'contact_email' => $request->contact_email,
		]);

		return $request;
	}


	public function createUnit(Request $request)
	{
		Unit::create([
			'per' => $request->per,
		]);
		return response($request);
	}


	public function createClassification(Request $request)
	{
		Classification::create([
			'name' => $request->name,
		]);
		return response($request);

	}


	public function createMap(Request $request)
	{
		Map::create([
			'name' => $request->name,
			'table' => $request->table,
		]);
	}


	public function getMaps()
	{
		return Map::all();
	}


	public function createLocate(Request $request)
	{
		Locate::create([
			'map_id' => $request->map_id,
			'tr' => $request->tr,
			'td' => $request->td,
		]);
	}


	public function getProducts()
	{
		return Product::all();
	}

	public function addStocks(Request $request)
	{
		
		$stocks = Stocks::where('product_id', $request->product_id)->first();

		if($stocks == "")
		{
			// no stocks available so let them add record
			$addStock = new Stocks;
			$addStock->product_id = $request->product_id;
			$addStock->available = $request->stocks_to_add;
			$addStock->alert = $request->alert;
			$addStock->save();

		}
		else
		{
			// add stocks and update			
			$stocks->available = $stocks->available + $request->stocks_to_add;
			$stocks->alert = $request->alert;
			$stocks->save();
		}
	}

	public function getUnits()
	{
		return Unit::all();
	}

	public function getSoldFrom()
	{
		return Supplier::all();
	}

	public function getClassification()
	{
		return Classification::all();
	}



	// getExisting
	public function getExistingRecord()
	{
		$prod = DB::table('products')
            // ->select('products.*', 'prices.unit_price', 'selling.price')
            ->join('unit', 'products.unit_id', '=', 'unit.id')
            ->leftjoin('supplier', 'products.sold_from', '=', 'supplier.id')
            ->leftjoin('classification', 'products.classification_id', '=', 'classification.id')
            ->leftjoin('prices', 'products.id', '=', 'prices.product_id')
            ->leftjoin('selling', 'products.id', '=', 'selling.product_id')
            ->leftjoin('stocks', 'products.id', '=', 'stocks.product_id')
            ->leftjoin('locate', 'products.locate_id', '=', 'locate.id')
            ->select('products.id AS tag_num',
            		 'products.name AS product_name',
            		 'products.unit_id AS tag_unit', 
            		 'products.sold_from', 
            		 'products.classification_id AS tag_classification',
            		 'products.locate_id AS tag_locate', 
            		 'unit.per', 'supplier.name AS supplier', 
            		 'classification.name AS classification',
            		 'prices.unit_price AS uprice',
            		 'selling.price AS sprice',
            		 'locate.map_id AS map',
            		 'stocks.alert AS stock_alert',
            		 'locate.tr AS tr',
            		 'locate.td AS td',
            		)
            ->get();
            return $prod;
	}


	// insertProduct
	public function insertProduct(Request $request)
	{
		if ($request->method == "New Product")
		{
			$product = new Product;
			$product->name = strtoupper($request->name);
			$product->unit_id = $request->unit_id;
			$product->sold_from = $request->sold_from;
			$product->classification_id = $request->sold_from;

			// Locate
			$targetlocate = Locate::where('target', $request->map_id."|".$request->tr.'|'.$request->td)->first();
			if($targetlocate == "")
			{
				// no target
				$locate = new Locate;
				$locate->target = $request->map_id.'|'.$request->tr.'|'.$request->td;
				$locate->map_id = $request->map_id;
				$locate->tr = $request->tr;
				$locate->td = $request->td;
				$locate->save();	
			}

			$targetlocate = Locate::where('target', $request->map_id."|".$request->tr.'|'.$request->td)->first();
			$product->locate_id = $targetlocate->id;
			
			$product->save();

			$product_id = Product::where('name', $request->name)->first();
			// Stocks / Prices / Selling /
			echo $product_id;
			$stocks= new Stocks;
			$stocks->product_id = $product_id->id;
			$stocks->available = $request->stocks_to_add;
			$stocks->alert = $request->alert;
			$stocks->save();
			$prices= new Prices;
			$prices->product_id = $product_id->id;
			$prices->unit_price = $request->unit_price;
			$prices->save();
			$selling= new Selling;
			$selling->product_id = $product_id->id;
			$selling->price = $request->price;
			$selling->save();

		}
		else if($request->method == "Adding Stocks")
		{
			$product = Product::where('name', $request->name)->first();
			// Price / Selling 
			$prices = Prices::where('product_id', $product->id)->first();
			$selling = Selling::where('product_id', $product->id)->first();
			if($prices == "" || $selling == "")
			{
				// no unit price or no selling price 
				return "No data for $prices or $selling :)";
			}
			else
			{
				$prices->unit_price = $request->unit_price;
				$prices->save();

				$selling->price = $request->price;
				$selling->save();
			}

			// Stocks
			$stocks = Stocks::where('product_id', $product->id)->first();
			if($stocks == "")
			{
				// no stocks exist
				return "No stocks exist"; 
			}
			else
			{
				$stocks->available = $request->stocks_to_add + $stocks->available;
				$stocks->alert = $request->alert;
				$stocks->save();
								
			}


		}

		else
		{
			return "Error Method";
		}
	}

	// get pending sales
	public function getAllPendingSales()
	{
		return Pending_Sales::all();
	}

	public function insertSales(Request $request)
	{

		// transaction muna then sales
		// checking pending sales in transaction kung meron exists kung wala bagong transaction ulit 
		$transactions_search = Transactions::where('pending_sales_id', $request->pending_sales_id)->first();

		if($transactions_search == "")
		{
			// transaction
			$transactions = new Transactions;
			$transactions->customer_id = $request->customer_id;
			$transactions->customer_name = $request->customer_name;
			$transactions->payment = $request->payment;
			$transactions->shipping = $request->shipping;
			$transactions->discount_less = $request->discount_less;
			$transactions->grand_total = $request->grand_total;
			$transactions->customer_money = $request->customer_money;
			$transactions->change = $request->change;
			$transactions->staff_id_counter = $request->staff_id_counter;
			$transactions->staff_id_cashier = $request->staff_id_cashier;
			$transactions->pending_sales_id = $request->pending_sales_id;
			$transactions->save();

			$transactions_search = Transactions::where('pending_sales_id', $request->pending_sales_id)->first();
			$product_search = Product::where('name', $request->product)->first();
			// sales
			$sales = new Sales;
			$sales->transaction_id = $transactions_search->id;
			$sales->product_id = $product_search->id;
			$sales->quantity = $request->qty;
			//
			$sales->discounted = $request->dc;
			$sales->discount_rate = $request->dc_rate;
			$sales->price_per_unit = $request->price;
			$sales->total_price = $request->total;
			$sales->original_total_price = $request->orig_total;
			$sales->discount_less_note = $request->discount_less_note;
			$sales->save();

			// remove in stocks
			$stocks = Stocks::where('product_id', $product_search->id)->first();
			$stocks->available = $stocks->available - $request->qty;
			$stocks->save();

			


		}
		else
		{
			
			$product_search = Product::where('name', $request->product)->first();
			// sales
			$sales = new Sales;
			$sales->transaction_id = $transactions_search->id;
			$sales->product_id = $product_search->id;
			$sales->quantity = $request->qty;
			//
			$sales->discounted = $request->dc;
			$sales->discount_rate = $request->dc_rate;
			$sales->price_per_unit = $request->price;
			$sales->total_price = $request->total;
			$sales->original_total_price = $request->orig_total;
			$sales->discount_less_note = $request->discount_less_note;
			$sales->save();

			// remove in stocks
			$stocks = Stocks::where('product_id', $product_search->id)->first();
			$stocks->available = $stocks->available - $request->qty;
			$stocks->save();

		
		}



	}


	public function removeInPendingSales(Request $request)
	{
		// remove record in pending sales
			$pending_sales = Pending_Sales::find($request->pending_sales_id);
			$pending_sales->delete();
	}

	public function sendToCashier(Request $request)
	{

		$pending_sales = new Pending_Sales;
		$pending_sales->staff_id = $request->staff_id;
		$pending_sales->sales = $request->sales;
		$pending_sales->save();

		return "Sales #".$pending_sales->id." has been sent to cashier \nPlease present this number to your cashier\nSO#".$pending_sales->id;
	}


	public function getAllSalesToday()
	{
		$getSales = DB::table('sales')
            ->join('transactions', 'sales.transaction_id', '=', 'transactions.id')
            ->leftjoin('products', 'sales.product_id', '=', 'products.id')
            ->leftjoin('unit', 'products.unit_id', '=', 'unit.id')
            ->leftjoin('prices', 'products.id', '=', 'prices.product_id')
            ->select(
            			'products.name As product_name',
            			'unit.per As unit_per',
            			'sales.id As item_number',
            			'sales.quantity As qty',
            			'sales.discounted As dc',
            			'sales.discount_rate As dc_rate',
            			'sales.price_per_unit As price_per_unit',
            			'sales.total_price As total_price',
            			'sales.original_total_price As orig_total',
            			'sales.discount_less_note As dc_note',
            			'transactions.customer_name As customer_name',
            			'transactions.customer_id As present_id',
            			'transactions.payment As pay_using',
            			'transactions.shipping As shipping',
            			'transactions.discount_less As dc_less',
            			'transactions.grand_total As grand_total',
            			'transactions.customer_money As present_money',
            			'transactions.change As customer_change',
            			'transactions.staff_id_counter As assign_counter',
            			'transactions.staff_id_cashier As assign_cashier',
            			'prices.unit_price As unit_price',
            			'sales.created_at As created_at',
            		)
            ->whereDate('sales.created_at', '=', date('Y-m-d'))
            ->orderBy('sales.created_at','asc')
            ->get();
            return $getSales;
	}


	public function getMeAsUser()
	{
		return Auth::check();
	}
	



}
