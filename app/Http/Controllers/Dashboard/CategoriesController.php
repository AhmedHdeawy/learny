<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

use App\Models\Category;


class CategoriesController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
      $request->flash();

      $inputsArray = [    
        'category_translations.categories_title'   => [ 'like', request('title') ],
        'category_translations.categories_desc'   => [ 'like', request('desc') ],
        'categories.categories_status'              => [ '=', request('status') ]
      ];

      $query = Category::join('category_translations', 'categories.id', 'category_translations.category_id')
                        ->groupBy('categories.id');
      
      $searchQuery = $this->handleSearch($query, $inputsArray);

      $categories = $searchQuery->paginate(env('perPage'));

      return view('dashboard.categories.index', compact('categories'));
    }


    /**
     * Goto the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.categories.create');
    }


    /**
     * Store a newly created category.
     *
     * @param  \App\Modules\Admin\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
       // dd($request->all());
        $category = Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('msg_success', __('lang.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Category $category)
    {
        $showLang = $request->showLang;
        return view('dashboard.categories.show', compact('category', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
      return view('dashboard.categories.edit', compact('category'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }

    /**
     * Delete the category
     */
    public function destroy(Category $category)
    {        
        // Delete Record
        $category->delete();

      return back()->with('msg_success', __('lang.deletedSuccessfully'));
    }

}
