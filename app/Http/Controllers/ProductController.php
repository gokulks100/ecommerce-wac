<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        
        return view('home');
    }

    public function getData()
    {
        $product = Product::query();

        return DataTables::of($product)
        ->editColumn('created_at', function($data){
            return Carbon::parse($data->created_at)->format('d-m-Y H:i:s');
        })->make(true);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'product_name'=>'required',
            'product_category'=>'required',
            'product_image'=>'required|mimes:jpeg,png,jpg,gif,svg',
            'product_price'=>'required',
        ]);

        if($validate->fails())
        {
            return ['success'=>false ,'errorMsg'=>$validate->errors()->first()];
        }

        try{
            DB::beginTransaction();
            $file = $request->file('product_image');
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/images' ;
            $file->move($destinationPath,$fileName);

            Product::updateOrCreate([
            'id'=>$request->id
            ],[
                'product_name'=>$request->product_name,
                'product_category'=>$request->product_category,
                'product_image'=>$fileName,
                'product_price'=>$request->product_price
            ]);
            DB::commit();
            return ['success'=>true];

        }
        catch(Exception $e)
        {
            dd($e);
            Log::debug($e);
            return ['success'=>false ,'errorMsg'=>'something wrong'];
        }
    }

    public function editData(Request $request)
    {
        if(!empty($request->id))
        {
            return Product::find($request->id);
        }
    }

    public function delete(Request $request)
    {
        if(!empty($request->id))
        {
            Product::find($request->id)->delete();
            return ['success'=>true];
        }
        return ['success'=>false];
    }
}
