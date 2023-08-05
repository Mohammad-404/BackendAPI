<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\favorite;
use App\Traits\GeneralTrait;

class favoriteController extends Controller
{
    use GeneralTrait;

    public function get(){
        $customer_id = \Auth::id();
        $data = favorite::where('customer_id',$customer_id)->with('watershop')->selection()->get();
        return $this->returnData('200', 'ok', 'favorite', $data);
    }

    public function insert(Request $request){
        try {
            $customer_id = \Auth::id();
            
            favorite::create([
                'customer_id'       => $customer_id,
                'watershop_id'      => $request->card_no,
            ]);

            return $this->returnSuccess(200,'Created Successfully !!');

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function remove($id){
        try {
            $ids = favorite::find($id);
            if (!$ids) {
                return $this->returnError(404,'ID is not found !!');
            }
            $ids->delete();

            return $this->returnSuccess(200,'Deleted Successfully !!');

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }


}
