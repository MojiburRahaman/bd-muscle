<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\BestDeal;
use App\Models\BestDealProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BestDealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $best_deals = BestDeal::latest()->get();
        return view('backend.deals.index', compact('best_deals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status', 1)->select('id', 'title')->get();
        return view('backend.deals.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => ['date', 'required', 'after:tomorrow',],
            'discount' => ['required', 'numeric', 'min:2', 'max:99'],
            'title' => ['required',],
            'product_id.*' => ['required'],
        ]);
        if ($request->product_id != '') {
            $deal = new BestDeal;
            $deal->title = $request->title;
            $deal->discount = $request->discount;
            $deal->expire_date = $request->date;
            $deal->save();
            # code...
            foreach ($request->product_id as $key => $product_id) {

                $attributes = Attribute::where('product_id', $product_id)->get();
                foreach ($attributes as $key => $attribute) {
                    $attribute->discount = $request->discount;
                    $discount_amount = ($attribute->regular_price * $request->discount) / 100;
                    $sell_price = round($attribute->regular_price - $discount_amount);
                    $attribute->sell_price = $sell_price;
                    $attribute->save();
                }
                $deal_product = new BestDealProduct;
                $deal_product->best_deal_id = $deal->id;
                $deal_product->product_id = $product_id;
                $deal_product->save();
            }
            return redirect()->route('deals.index')->with('success', 'Added Successfully');
        };
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $BestDeal =  BestDeal::findorfail($id);
        if ($BestDeal->status == 1) {
            $best_deal_product = BestDealProduct::where('best_deal_id', $BestDeal->id)->get();
            foreach ($best_deal_product as $key => $deal_product) {
                $attributes = Attribute::where('product_id', $deal_product->product_id)->get();
                foreach ($attributes as $key => $attribute) {
                    $attribute->discount = '';
                    $attribute->sell_price = '';
                    $attribute->save();
                }
            }
            $BestDeal->status = 2;
            $BestDeal->save();
            return back()->with('warning', 'Inactive Successfully');
        } else {

            if (Carbon::today()->format('Y-m-d') > $BestDeal->expire_date) {
                return back()->with('warning', 'Out of Date');;
            }
            $best_deal_product = BestDealProduct::where('best_deal_id', $BestDeal->id)->get();
            foreach ($best_deal_product as $key => $deal_product) {
                $attributes = Attribute::where('product_id', $deal_product->product_id)->get();
                foreach ($attributes as $key => $attribute) {
                    $attribute->discount = $BestDeal->discount;
                    $discount_amount = ($attribute->regular_price * $BestDeal->discount) / 100;
                    $sell_price = round($attribute->regular_price - $discount_amount);
                    $attribute->sell_price = $sell_price;
                    $attribute->save();
                }
            }
            $BestDeal->status = 1;
            $BestDeal->save();
            return back()->with('success', 'Active Successfully');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $best_deal = BestDeal::findorfail($id);
        $products = Product::where('status', 1)->select('id', 'title')->get();
        $best_deal_product = BestDealProduct::where('best_deal_id', $best_deal->id)->get();
        return view('backend.deals.edit', [
            'best_deal' => $best_deal,
            'products' => $products,
            'best_deal_product' => $best_deal_product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $BestDeal =  BestDeal::findorfail($id);
        $best_deal_product = BestDealProduct::where('best_deal_id', $BestDeal->id)->get();
        foreach ($best_deal_product as $key => $deal_product) {
            $attributes = Attribute::where('product_id', $deal_product->product_id)->get();
            foreach ($attributes as $key => $attribute) {
                $attribute->discount = '';
                $attribute->sell_price = '';
                $attribute->save();
            }
            $deal_product->delete();
        }
        $BestDeal->delete();
        return back()->with('delete', 'Deleted Successfully');
    }
}
