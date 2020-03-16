<?php


namespace CreatyDev\Http;

use Illuminate\Support\Facades\DB;
use CreatyDev\App\Controllers\Controller;
use Illuminate\Http\Request;
use CreatyDev\Domain\CategoryModel;
use CreatyDev\Domain\BrandModel;
use CreatyDev\Domain\ProductsModel;
use Illuminate\Support\Facades\View;
use Symfony\Component\DomCrawler\form;
use Illuminate\Support\ServiceProvider;
use IlluminateAgnostic\Collection\Support\Str;
use CreatyDev\Domain\Store;
use CreatyDev\Domain\Prices;
use Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductsModel::all();
        return view('admin.product.index')->with('products', $products);
        //
    }

    public function home()
    {
        $products = ProductsModel::all();
        return view('home.index')->with('products', $products);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryModel::all();
        $brands = BrandModel::all();
        $data = ['categories' => $categories, 'brands' => $brands];
        return View('admin.product.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'filename' => 'required',
            'content' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        $title = $request->input('title');
        $slug = Str::slug($title, '_');
        $pice = $request->price;
        $desc = $request->input('content');
        $pname = $request->input('name');
        $category = $request->input('category');
        $brand_id = $request->input('brand_id', 0);
        $gallery = $request->input('gallery');
        //

        if ($request->hasfile('filename')) {

            foreach ($request->file('filename') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/images/', $name);
                $data[] = $name;

            }
            $images = "" . implode(",", $data) . "";
        }

        $product = new ProductsModel();
        $product->title = $title;
        $product->name = $pname;
        $product->price = $pice;
        $product->category = $category;
        $product->slug = $slug;
        $product->description = $desc;
        $product->gallery = $images;
        $product->brand_id = $brand_id;


        $product->save();

        return back()->with('status', 'Product added');


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::select('select products.id,products.price,products.brand_id,products.title,products.name,products.category,products.description,products.gallery, categories.id as catid,categories.cname from products join categories on products.category=categories.id where products.id = ?', [$id]);
        $categories = CategoryModel::all();
        $brands = BrandModel::all();
        $data = [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands
        ];
        ## Debugging Error, By Abbas
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";

        return view('admin.product.edit')->with($data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title = $request->input('title');
        $slug = Str::slug($title, '_');
        $desc = $request->input('content');
        $category = $request->input('category');
        $brand_id = $request->input('brand_id', 0);
        $pname = $request->input('name');
        $gallery = $request->input('filename');
        $price = $request->input('price');
        //

        if ($request->hasfile('filename')) {

            foreach ($request->file('filename') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/images/', $name);
                $data[] = $name;

            }

            $images = "" . implode(",", $data) . "";

            DB::table('products')
                ->where('id', $id)
                ->update(['name' => $pname, 'title' => $title, 'description' => $desc, 'category' => $category, 'brand_id' => $brand_id, 'gallery' => $images, 'price' => $price]);


            return back()->with('status', 'Product updated');
        } else {

            $product = ProductsModel::find($id);
            //dd($product);
            DB::table('products')
                ->where('id', $id)
                ->update(['name' => $pname, 'title' => $title, 'description' => $desc, 'category' => $category, 'brand_id' => $brand_id, 'price' => $price]);

            return back()->with('status', 'Product updated');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from products where id = ?', [$id]);
        return back()->with('status', 'Product deleted');
    }

    public function showProduct($slug, Request $request)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.cname','brands.name as brand_name')
            ->where('products.slug', $slug)
            ->get();
        foreach ($product as $product) {
            $proid = $product->id;
        }
//dd($product);
        $store_session = $request->session()->get('store');
        $store = Store::where('email', '=', $store_session)->first();
        $prices = DB::table('prices')
            ->join('stores', 'prices.store_id', '=', 'stores.id')
            ->where('prices.product_id', $proid)
            ->get();
        //dd($prices);
        return view('product.index')->with([
            'product' => $product,
            'store' => $store,
            'prices' => $prices
        ]);
    }

    public function addPrice(Request $request)
    {
        $this->validate($request, [
            'price' => 'required|numeric',
            'pid' => 'required',
            'sid' => 'required',
        ]);
        $productid = $request->input('pid');
        $storeid = $request->input('sid');
        $price = $request->input('price');
        $newprice = new Prices();
        $newprice->store_id = $storeid;
        $newprice->product_id = $productid;
        $newprice->price = $price;
        $newprice->save();
        return back()->with('status', 'Your Price has been added');
    }

    public function productPrice(Request $request)
    {

        $productid = $request->input('pid');
        $storeid = $request->input('sid');
        $price = $request->input('price');

        Prices::where('product_id', $productid)->where('store_id', $storeid)
            ->update(['price' => $price]);

        echo json_encode(array('status' => 'success', 'code' => 200));
        //return back()->with('status','Your Price has been added');
    }

    public function addToCart(Request $request)
    {
        session_start();
        $cartData = $_SESSION["session_cart"] ?? [];
        $product_id = $request->input('product_id', 0);
        $store_id = $request->input('store_id', 0);
        $price = $request->input('price', 0);
        $key = $product_id . "_" . $store_id;
        $cartData[$key]["product_id"] = $product_id;
        $cartData[$key]["store_id"] = $store_id;
        $cartData[$key]["price"] = $price;
        $cartData[$key]["total_price"] = $price;
        $cartData[$key]["quantity"] = 1;
        if (intval($product_id) > 0) {
            $product = DB::table('products')->where('id', $product_id)->first();
            $images = $product->gallery;
            $all = isset($images) ? explode(',', $images) : [];
            $store = DB::table('stores')->where('id', $store_id)->first();
            $cartData[$key]['product_name'] = $product->name ?? '';
            $cartData[$key]['store_name'] = $store->store_name ?? '';
            $cartData[$key]['product_image'] = $all[0] ?? '';
        }
        $_SESSION["session_cart"] = $cartData;
        echo json_encode(array('status' => 'success', 'code' => 200, 'session_cart' => $cartData));
        //return back()->with('status','Your Price has been added');
    }

    public function updateCart(Request $request)
    {
        session_start();
        $cartData = $_SESSION["session_cart"] ?? [];
        $p_key = $request->input('key', 0);
        $quantity = $request->input('quantity', 0);
        if (isset($cartData[$p_key]) && $quantity == 0) {
            unset($cartData[$p_key]);
        } elseif (isset($cartData[$p_key])) {
            $price = $cartData[$p_key]['price'] ?? 0;
            $cartData[$p_key]['quantity'] = $quantity;
            $cartData[$p_key]["total_price"] = $quantity * $price;
        }
        $_SESSION["session_cart"] = $cartData;
        echo json_encode(array('status' => 'success', 'code' => 200, 'session_cart' => $cartData));

    }

    public function removeFromCart(Request $request)
    {
        session_start();
        $cartData = $_SESSION["session_cart"] ?? [];
        $p_key = $request->input('key', 0);
        if (isset($cartData[$p_key])) {
            unset($cartData[$p_key]);
        }
        $_SESSION["session_cart"] = $cartData;
        echo json_encode(array('status' => 'success', 'code' => 200, 'session_cart' => $cartData));

    }

    public function myCart(Request $request)
    {
        session_start();
        $cartData = $_SESSION["session_cart"] ?? [];
        $responseData = [];
        $total = ['total_count' => 0, 'total_price' => 0];
        if (isset($cartData)) {
            foreach ($cartData as $key => $cdata) {
                $total_price = $cdata['total_price'] ?? 0;
                $total['total_price'] = $total['total_price'] + $total_price;
            }
        }
        /*   echo ' < pre>';
           print_r($responseData);
           echo ' </pre > ';
           echo "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
           exit;*/
        $data = ['myCart' => $cartData, 'total' => $total];
        return View('home.my_cart')->with($data);
    }
}