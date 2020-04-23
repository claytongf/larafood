<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $repository;

    public function __construct(Product $product){
        $this->repository = $product;
    }

    public function index(){
        $products = $this->repository->latest()->paginate();
        return view('admin.pages.products.index', compact('products'));
    }

    public function create(){
        return view('admin.pages.products.create');
    }

    public function store(StoreUpdateProductRequest $request){
        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if($request->hasFile('image') && $request->image->isValid()){
            $data["image"] = $request->image->store("products/{$tenant->uuid}/products");
        }
        $this->repository->create($data);
        return redirect()->route('products.index');
    }

    public function edit($id){
        if(!$product = $this->repository->find($id)){
            return redirect()->back();
        }
        return view('admin.pages.products.edit', compact('product'));
    }

    public function update(StoreUpdateProductRequest $request, $id){
        if(!$product = $this->repository->find($id)){
            return redirect()->back();
        }
        $data = $request->all();
        $tenant = auth()->user()->tenant;
        if($request->hasFile('image') && $request->image->isValid()){
            if(Storage::exists($product->image)){
                Storage::delete($product->image);
            }
            $data["image"] = $request->image->store("products/{$tenant->uuid}/products");
        }

        $product->update($data);
        return redirect()->route('products.index');
    }

    public function show($id){
        if(!$product = $this->repository->find($id)){
            return redirect()->back();
        }
        return view('admin.pages.products.show', compact('product'));
    }

    public function destroy($id){
        if(!$product = $this->repository->find($id)){
            return redirect()->back();
        }
        if(Storage::exists($product->image)){
            Storage::delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index');
    }

    /**
     * Search results.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('filter');
        $products = $this->repository->where(function ($query) use ($request) {
            if ($request->filter) {
                $query->where('name', 'LIKE', "%{$request->filter}%")
                    ->orWhere('description', 'LIKE', "%{$request->filter}%");
            }
        })->latest()->paginate();

        return view('admin.pages.products.index', compact('products', 'filters'));
    }
}
