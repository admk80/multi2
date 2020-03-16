<?php

namespace CreatyDev\Http;
use Illuminate\Support\Facades\DB;
use CreatyDev\App\Controllers\Controller;
use CreatyDev\Domain\Store;
use Session;
use Illuminate\Http\Request;
use IlluminateAgnostic\Collection\Support\Str;
use Illuminate\Support\Facades\Hash;
use Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = DB::table('products')
            ->limit(18)
            ->get();
        // $product = DB::table('products')
        // ->join('categories', 'products.category', '=', 'categories.id')
        // ->select('products.*', 'categories.cname')
        // // ->where('products.slug', $slug)
        // ->get();
        //dd($data['products'][0]);
        if(session('store')!=""){
            $store_session = session()->get('store');
            $data['store'] = Store::where('email', '=', $store_session)->first();
    
            foreach ($data['products'] as $key => $product){
                $proid = $product->id;
                $data['products'][$key]->prices = DB::table('prices')
                ->join('stores','prices.store_id','=','stores.id')
                ->where('prices.product_id',$product->id)
                ->where('stores.id',$data['store']->id)
                ->get();
    
            }
        }

        return View('home.stores')->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'filename' => 'required',

            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $address = $request->input('address');
        $image=$request->input('filename');
        $pwd = Hash::make($request->input('pwd'));
        //

        $imageName = time().'.'.request()->filename->getClientOriginalExtension();



        request()->filename->move(public_path('images'), $imageName);
        $store= new Store();
        $store->store_name=$name;
        $store->email=$email;
        $store->address=$address;
        $store->password=$pwd;
        $store->logo=$imageName;



        $store->save();

        return back()->with('status', 'Store has been registered. Admin will review it.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CreatyDev\Domain\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CreatyDev\Domain\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \CreatyDev\Domain\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CreatyDev\Domain\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
    public function storeLogin(Request $request)
    {
        $pwd = $request->input('spwd');
        $email = $request->input('semail');
        $results =Store::where('email', '=', $email)->first();

        if ($results) {
            if ($results->verified == 'yes') {
                $is_valid=Hash::check($pwd, $results->password);
                if ($is_valid){
                    Session::put('store', $email);
                    // return View('home.stores')->with('results',$results);
                    return redirect()->route('stores')->with('results',$results);
                }
                else{
                    return back()->with('status', 'Invalid Email or password');
                }
            }else{
                return back()->with('status', 'Your email is not verified from the admin.');
            }
        }else{
            return back()->with('status', 'Invalid Email or password');
        }
        
        //dd($results);
    }

    public function storeProfile(){

        $email = Session::get('store');
        $data['results'] =Store::where('email', '=', $email)->first();
        return view('home.profile')->with($data);

    }

    public function storeUpdate(Request $request){

        $this->validate($request, [
            'name' =>'required',
            'address' =>'required',
            'filename' => 'nullable',

            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $address = $request->input('address');
          
        $store=  Store::where('id', $id)->first();
        $store->store_name=$name;
        $store->email=$email;
        $store->address=$address;
        if ($request->file('filename')) {
            $image=$request->input('filename');
            $imageName = time().'.'.request()->filename->getClientOriginalExtension();
            request()->filename->move(public_path('images'), $imageName);
            $store->logo=$imageName;
        } 
        $store->save();

        return back()->with('status', 'Profile has been updated successfully.');

    }
    public function storeLoggout()
    {
        Session::forget('store'); // Removes a specific variable
        return back()->with('status', 'You have been logged out.');
    }
    }
