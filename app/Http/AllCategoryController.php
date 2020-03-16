<?php
namespace CreatyDev\Http;
use Illuminate\Support\Facades\DB;
use CreatyDev\App\Controllers\Controller;
use Illuminate\Http\Request;
use CreatyDev\Domain\CategoryModel;
use Illuminate\Support\Facades\View;
use Symfony\Component\DomCrawler\form;
use Illuminate\Support\ServiceProvider;
use IlluminateAgnostic\Collection\Support\Str;
class AllCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryModel::all();
        return view('admin.category.index')->with('categories',$categories);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $catname = $request->input('category');
        $slug = $slug = Str::slug($catname, '_');
        //
        DB::table('categories')->insert([
            ['cname' => $catname,'slug' => $slug]
        ]);
        return redirect('product/categories')->with('status', 'Record created');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = DB::select('select * from categories where id = ?',[$id]);
        return view('admin.category.edit')->with('category',$category);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
            {

        //
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
        $name = $request->input('category');
        $slug = $slug = Str::slug($name, '_');
        DB::update('update categories set cname = ?,slug = ? where id = ?',[$name,$slug,$id]);
        return redirect('product/categories')->with('status', 'Record updated');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from categories where id = ?',[$id]);
        return redirect('product/categories')->with('status', 'Record deleted');

        //
    }
}
