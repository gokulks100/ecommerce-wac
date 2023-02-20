<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OrderManagementController extends Controller
{
    public function index()
    {
        $products = Product::take(20)->get();
        return view('orders.index',['product'=>$products]);
    }

    public function getData()
    {
        $order = Order::query();

        return DataTables::of($order)
        ->editColumn('created_at', function($data){
            return Carbon::parse($data->created_at)->format('d-m-Y H:i:s');
        })->make(true);
    }

    public function store(Request $request)
    {  
        $validate = Validator::make($request->all(),[
            'name'=>'required',
            'phone'=>'required',
            'products'=>'required'
        ]);

        if($validate->fails())
        {
            return ['success'=>false ,'errorMsg'=>$validate->errors()->first()];
        }

        try{
            DB::beginTransaction();
            $amount = 0;
            foreach($request->products as $product)
            {
                $pro = Product::where('id',$product['product_id'])->first();
                $price = $pro->product_price * $product['quantity'];
                $prod[] = [
                    'product_name'=>$pro->product_name,
                    'product_quantity'=>$product['quantity'],
                    'amount'=> $price
                ];
            }

            foreach($prod as $prods)
            {
                $amount += $prods['amount'];
            }

            Order::updateOrCreate([
            'id'=>$request->id
            ],[
                'order_id'=> rand(),
                'name'=>$request->name,
                'phone'=>$request->phone,
                'product'=>$prod,
                'net_amount'=>$amount,
            ]);
            DB::commit();
            return ['success'=>true];

        }
        catch(Exception $e)
        {
            Log::debug($e);
            return ['success'=>false ,'errorMsg'=>'something wrong'];
        }

    }

    public function editData(Request $request)
    {
        return  Order::find($request->id);
    }

    public function invoice(Request $request)
    {
        $orders = Order::find($request->id);
        $printData = view('orders.print',['order'=>$orders])->render();
        return ['success'=>true ,'preview'=>$printData];
    }

    public function delete(Request $request)
    {
        Order::find($request->id)->delete();
        return ['success'=>true];
    }
}
