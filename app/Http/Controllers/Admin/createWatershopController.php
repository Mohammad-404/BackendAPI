<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Admin;
use App\Models\deliveryOrders;
use App\Traits\GeneralTrait;

class createWatershopController extends Controller
{
    use GeneralTrait;
<<<<<<< HEAD
 
=======
>>>>>>> 921395e5d3914facbefaf2262f8f8eb3148b9631

    public function profile(){
        try {
            $id = \Auth::id();
            $data = Admin::where('id',$id)->with('delivery')->selection()->get();

            return $this->returnData('200', 'ok', 'watershop', $data);
        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function create(){ //in the c-panel
        
    }
}
