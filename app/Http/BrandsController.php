<?php
namespace CreatyDev\Http;
use Illuminate\Support\Facades\DB;
use CreatyDev\App\Controllers\Controller;
use Illuminate\Http\Request;
use CreatyDev\Domain\BrandModel;
use Illuminate\Support\Facades\View;
use Symfony\Component\DomCrawler\form;
use Illuminate\Support\ServiceProvider;
use IlluminateAgnostic\Collection\Support\Str;
class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = BrandModel::all();
        return view('admin.brand.index')->with('brands',$brands);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brandname = $request->input('brand');
        $slug = $slug = Str::slug($brandname, '_');
        //
        DB::table('brands')->insert([
            ['name' => $brandname,'slug' => $slug]
        ]);
        return redirect('product/brands')->with('status', 'Record created');
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
        $brand = DB::select('select * from brands where id = ?',[$id]);
        return view('admin.brand.edit')->with('brand',$brand);
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
        $name = $request->input('brand');
        $slug = $slug = Str::slug($name, '_');
        DB::update('update brands set name = ?,slug = ? where id = ?',[$name,$slug,$id]);
        return redirect('product/brands')->with('status', 'Record updated');
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
        DB::delete('delete from brands where id = ?',[$id]);
        return redirect('product/brands')->with('status', 'Record deleted');

        //
    }
}
