<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $repository;

    public function __construct(Category $category){
        $this->repository = $category;
    }

    public function index(){
        $categories = $this->repository->latest()->paginate();
        return view('admin.pages.categories.index', compact('categories'));
    }

    public function create(){
        return view('admin.pages.categories.create');
    }

    public function store(StoreUpdateCategoryRequest $request){
        $this->repository->create($request->all());
        return redirect()->route('categories.index');
    }

    public function edit($id){
        if(!$category = $this->repository->find($id)){
            return redirect()->back();
        }
        return view('admin.pages.categories.edit', compact('category'));
    }

    public function update(StoreUpdateCategoryRequest $request, $id){
        if(!$category = $this->repository->find($id)){
            return redirect()->back();
        }
        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    public function show($id){
        if(!$category = $this->repository->find($id)){
            return redirect()->back();
        }
        return view('admin.pages.categories.show', compact('category'));
    }

    public function destroy($id){
        if(!$category = $this->repository->find($id)){
            return redirect()->back();
        }
        $category->delete();
        return redirect()->route('categories.index');
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
        $categories = $this->repository->where(function ($query) use ($request) {
            if ($request->filter) {
                $query->where('name', 'LIKE', "%{$request->filter}%")
                    ->orWhere('description', 'LIKE', "%{$request->filter}%");
            }
        })->latest()->paginate();

        return view('admin.pages.categories.index', compact('categories', 'filters'));
    }
}
