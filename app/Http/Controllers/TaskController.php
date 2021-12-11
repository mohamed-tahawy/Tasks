<?php

namespace App\Http\Controllers;
use App\Models\Option;
use App\Models\Product;
use App\Models\product_option;
use App\Models\Variant;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
     //
     public function task() 
     {
             //properites
 
             $colors = array('Red', 'Black', 'Blue');
 
             $size 	= array('Large', 'Medium', 'Small');
 
             $types 	= array('Cotton', 'Polyester');
             
             // array to push data into for passing it to view
 
             $data 		= array();
             $AllData	= array();
 
             // code for test one with 9 outputs
 
                 // for ($i=0; $i < count($colors); $i++) { 
                 // 		$variant_array = array();
                 // 			for ($s=0; $s < count($size); $s++) { 
                 // 						$variant_array = [$colors[$i],$size[$s]];
                 // 						array_push($data, $variant_array);	
                 // 			}
                 // }
                
 
 
             // code for task two with 18 outputs 
 
                 for ($i=0; $i < count($colors); $i++) { 
                         $variant_array = array();
                             for ($s=0; $s < count($size); $s++) { 
                                     for ($p=0; $p < count($types); $p++) { 
                                             $variant_array = [$colors[$i],$size[$s], $types[$p]];
                                             array_push($AllData, $variant_array);											
                                     }
                             }
                 }
 
        
         return view('output', compact('data', 'AllData'));
 
     }

     // create product
     public function createProduct()
     {
         $options = Option::all();
         return view('dashboard.create-product', compact('options'));
     }
     // create store product
     public function storeProduct(Request $request)
     {
         
         $data = $request->validate([
             'product_name' => 'required', 'string|max:255', 'min:2',
             'description' => 'required',
             'option_values' => 'required',
             'option_id' => 'required',
         ]);
         $data = $request->all();
         $product = Product::create($data);
         
         $options = Option::all();
        //  return view('dashboard.create-product', compact('options'));
        $counter = 0;
        foreach($request->option_id as $opt)
        {
           if( $counter == 0)
           {
               $counter = $opt;
           }
        // ceate new answer with right and false answer
            $new_option = new Product_Option();
            $new_option->product_id = $product->id;
            $new_option->option_id = (int) $opt;
            $new_option->save();   
        
           
        }
  

    
    $arr = $request->option_values;

    function variations($array) {
        if (empty($array)) {
            return [];
        }

        function traverse($array, $parent_ind) {
            $r = [];
            $pr = '';

            if(!is_numeric($parent_ind)) {
                $pr = $parent_ind.'-';
            }

            foreach ($array as $ind => $el) {
                if (is_array($el)) {
                    $r = array_merge($r, traverse($el, $pr.(is_numeric($ind) ? '' : $ind)));
                } elseif (is_numeric($ind)) {
                    $r[] = $pr.$el;
                } else {
                    $r[] = $pr.$ind.'-'.$el;
                }
            }

            return $r;
        }

        //1. Go through entire array and transform elements that are arrays into elements, collect keys
        $keys = [];
        $size = 1;

        foreach ($array as $key => $elems) {
            if (is_array($elems)) {
                $rr = [];

                foreach ($elems as $ind => $elem) {
                    if (is_array($elem)) {
                        $rr = array_merge($rr, traverse($elem, $ind));
                    } else {
                        $rr[] = $elem;
                    }
                }

                $array[$key] = $rr;
                $size *= count($rr);
            }

            $keys[] = $key;
        }

        //2. Go through all new elems and make variations
        $rez = [];
        for ($i = 0; $i < $size; $i++) {
            $rez[$i] = [];

            foreach ($array as $key => $value) {
                $current = current($array[$key]);
                $rez[$i][$key] = $current;
            }

            foreach ($keys as $key) {
                if (!next($array[$key])) {
                    reset($array[$key]);
                } else {
                    break;
                }
            }
        }

        return $rez;
    }


    $output = variations($arr);
    $order_details = [];
    for($i= 0; $i < count($output); $i++)
    {

        $order_details[] = [
            'product_id' => $product->id,
            'variant_name' => $output[$i],
           
        ]; 

    }
    foreach($order_details as $order)
    {
         $new_answer = new Variant();
         $new_answer->product_id = $order['product_id'];
        {
            
             $new_answer->variant_name = implode($order['variant_name'], ',');
             $new_answer->save();

        }
    }
    
        return redirect()->back()->with('status', 'product create successfully');

    }


     // view product data tables 
       // datatable all levels 
       public function product()
       {
           return view ('dashboard.products');
       } 
       public function getProducts(Request $request) {
           if ($request->ajax()) {
                   $data = Product::all();
                   return DataTables::of($data)
                       ->addIndexColumn()
                    //    ->addColumn('chapter', function($row){
                    //        $chapterLink = '<a href="/dashboard/level/chapter/'. $row->id .'" >view chapter</a>';
                    //        return $chapterLink;
                    //    })
                       ->addColumn('action', function($row){
                           $actionBtn = '<a href="/dashboard/edit/product/'. $row->id .'" class="edit btn btn-success btn-sm">Edit</a> <a href="/dashboard/product/delete/'. $row->id .'" class="delete btn btn-danger btn-sm">Delete</a>';
                           return $actionBtn;
                       })   
                       ->rawColumns(['action'])
                       ->make(true);
               }
       }

       // edit product
       public function edit($id)
       {
            $product = Product::find($id);
            $variant = Variant::where('product_id', $product->id)->get();
            json_decode($variant, true);
            return view('dashboard.edit-product', compact('product', 'variant'));
       }
       // update data
       public function update(Request $request, $id)
       {
        $data = $request->validate([
            'product_name' => 'required','string', 'max:255', 'min:2',
            'description' => 'required',
        ]);
        $product = Product::find($id);
        $product->product_name = $data['product_name'];
        $product->description = $data['description'];
        if($product->save())
        {
            return redirect()->back()->with('status', 'Success Updated successfully');
        }else {
            return redirect()->back()->with('status', 'Erorr happend try again');

        }        



       }

       // delete product
       public function delete($id)
       {
           $product = Product::find($id);
           if($product->delete())
           {
               return redirect()->back()->with('status', 'Success delete successfully');
           }else {
               return redirect()->back()->with('status', 'Erorr happend try again');

           }
       }

}
