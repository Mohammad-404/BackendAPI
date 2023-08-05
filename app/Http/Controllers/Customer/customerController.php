<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\customerPayment;
use App\Traits\GeneralTrait;
use App\Models\Admin;
use App\Models\products;

class customerController extends Controller
{
    use GeneralTrait;
    
    function uploadImage($folder , $image){
        $image->store('/' ,$folder);
        $filename   =  $image->hashName();
        $path       = 'assets/'.$folder.'/'.$filename;
        return $path;
    }

    public function getInfo(){ //this function to get all data when cutomer tried to take order.
        try {
            $customer_id        = \Auth::id();
            $data = Customer::where('id',$customer_id)->with('customerPayment')->selection()->get();
            return $this->returnData('200', 'ok', 'customers_information', $data);
        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function profile(){
        try {
            $customer_id        = \Auth::id();
            $data = Customer::where('id',$customer_id)->with('customerPayment')->selection()->get();
            return $this->returnData('200', 'ok', 'customers_information', $data);
        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function updateProfile(Request $request){
        try {
            $customer_id        = \Auth::id();
            $ids = Customer::find($customer_id);
            if (!$ids) {
                return $this->returnError(404,'ID is not found !!');
            }
            
            $filePath = "";
            if($request->has('photo') != ""){
                $filePath = $this->uploadImage('customer' , $request->photo);
                $filePath = uploadImage('customer' , $request->photo);
            }            
            
            $ids->update([
                'phonenumber'                   => $request->phonenumber,
                'username'                      => $request->username,
                'address'                       => $request->address,
                'email'                         => $request->email,
                'password'                      => $request->password,
                'photo'                         => $filePath,
                'payment'                       => $request->payment,
                'city'                          => $request->city,
                'street'                        => $request->street,
                'bulding_no'                    => $request->bulding_no,
                'apartment_no'                  => $request->apartment_no,
                'nearest_famous_landmark'       => $request->nearest_famous_landmark,
            ]);

            return $this->returnSuccess(404,'Updated Successfully !!');

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function CreatePaymentCard(Request $request){
        try {
            $customer_id = \Auth::id();
         
            customerPayment::create([
                'customer_id'       => $customer_id,
                'card_no'           => $request->card_no,
                'card_expire'       => $request->card_expire,
                'code'              => $request->code
            ]);

            return $this->returnSuccess(404,'Created Successfully !!');

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function EditPaymentCard($id){
        try {
            $payment_information = customerPayment::find($id);
            if (!$payment_information) {
                return $this->returnError(404,'ID is not found !!');
            }

            return $this->returnData('200', 'ok', 'payment_information', $payment_information);

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    public function updatePaymentCard($id, Request $request){
        try {
            $ids = customerPayment::find($id);
            if (!$ids) {
                return $this->returnError(404,'ID is not found !!');
            }
            
            $ids->update([
                'card_no'           => $request->card_no,
                'card_expire'       => $request->card_expire,
                'code'              => $request->code,
            ]);

            return $this->returnSuccess(404,'Updated Successfully !!');

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    
    public function RemovePaymentCard($id){
        try {
            $ids = customerPayment::find($id);
            if (!$ids) {
                return $this->returnError(404,'ID is not found !!');
            }
            
            $ids->delete();

            return $this->returnSuccess(404,'Deleted Successfully !!');

        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    }

    //get products it's releated with watershop
    public function getProductsWaterShop($id){
        try {
            $data = Admin::where('id',$id)->with('products')->selection()->get();
            return $this->returnData('200', 'ok', 'all_products_for_watershop', $data);
        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    } 
    
    //get watershops
    public function getWaterShops(){
        try {
            $data = Admin::selection()->get();
            return $this->returnData('200', 'ok', 'all_water_shops', $data);
        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    } 

    //get products details after press on products.
    public function getProductsDetails($id){
        try {
            $data = products::where('id',$id)->selection()->get();
            return $this->returnData('200', 'ok', 'products_details', $data);
        } catch (\Exception $ex) {
            return $this->returnError(404,'Please Contact Support !!');
        }
    } 


    // 
    
}
