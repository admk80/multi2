<?php

namespace CreatyDev\Http\Account\Controllers;

use CreatyDev\App\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CreatyDev\Domain\Users\Models\User;
use CreatyDev\Domain\Store;

class StoresController extends Controller
{
    public function index()
    { 
    	$data['stores'] = Store::all();
        return view('stores.index')->with($data);
    }

    public function storeVerify(Request $request){

    	$store = Store::find($request->user_id);
        $store->verified = $request->verified;
        $store->save();
        if ($store->verified == 'yes' ) {
        	return response()->json(['success'=>'Status change successfully.']); 
        }elseif ($store->verified == 'no') {
        	return response()->json(['successNo'=>'Status change successfully.']);
        }
    }
}
