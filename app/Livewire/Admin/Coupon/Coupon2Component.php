<?php

namespace App\Livewire\Admin\Coupon;

use Livewire\Component;
use App\Models\Coupon;
use App\models\Category;
use phpDocumentor\Reflection\Types\This;

class Coupon2Component extends Component
{
    public $coupon_name, $code, $type, $value, $category_id, $cart_value, $status;
    public $coupon_id, $coupon_delete_id;
    public $view_counpon_id,$view_coupon_name, $view_coupon_code, $view_coupon_type, $view_coupon_value, $view_coupon_category_id, $view_coupon_cart_value, $view_coupon_status,$view_coupon_date;
    
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'code' => 'required|unique:coupons', //Validation with ignoring own data
            'coupon_name' => 'required',
            'type'=>'required',
            'value' =>'required',
            'status' => 'required'
        ]);
    }

    public function storePost()
    {
        //on form submit validation
        $this->validate([
            'code' => 'required|unique:coupons',
            'coupon_name' => 'required',
            'type'=>'required',
            'value' =>'required',
            'status' => 'required'
        ]);

        //Add Data into Post table Data
        $post = new Coupon();
        $post->code = $this->code;
        $post->coupon_name = $this->coupon_name;
        $post->type = $this->type;
        $post->value = $this->value;
        $post->status = $this->status;
        $post->category_id = $this->category_id;
        $post->cart_value = $this->cart_value;
        $post->save();

        session()->flash('message', 'New Coupon addedd Successfully.');

        // $this->post_id = '';
        // $this->title = '';
        // $this->status = '';
        // $this->description = '';
        $this->resetInputs();
        //For hide modal after add posts success
        $this->dispatch ('close-modal');
    }


    public function resetInputs()
    {
        $this->code = '';
        $this->coupon_name = '';
        $this->type='';
        $this->category_id ='';
        $this->cart_value = '';
        $this->status = '';
        $this->value = '';
        $this->coupon_id = '';
    }

    public function viewPostDetails($id)
    {
        $post = Coupon::find($id);
        $this->view_counpon_id = $post->id;
        $this->view_coupon_name = $post->coupon_name;
        $this->view_coupon_code = $post->code;
        $this->view_coupon_type =$post->type;
        $this->view_coupon_value = $post->value;
        $this->view_coupon_category_id =$post->category_id;
        $this->view_coupon_cart_value = $post->cart_value;
        $this->view_coupon_status= $post->status;
        $this->view_coupon_date = $post->created_at;
        $this->dispatch('show-view-post-modal');
    }

    public function closeViewPostModal()
    {
        $this->view_counpon_id =  ''; 
        $this->view_coupon_name = '';
        $this->view_coupon_code = '';
        $this->view_coupon_type ='';
        $this->view_coupon_value = '';
        $this->view_coupon_category_id ='';
        $this->view_coupon_cart_value = '';
        $this->view_coupon_status= '';
        $this->view_coupon_date = '';
    }

    //Delete Confirmation
    public function deleteConfirmation($id)
    {
        $this->coupon_delete_id = $id; //post id

        $this->dispatch('show-delete-confirmation-modal');
    }


    public function deletePostData()
    {
        Coupon::destroy($this->coupon_delete_id);

        session()->flash('message', 'Coupon has been deleted successfully');

        $this->dispatch('close-modal');

        $this->coupon_delete_id = '';
    }

    public function cancel()
    {
        $this->coupon_delete_id = '';
    }

    public function render()
    {
        $coupons = Coupon::all();
        $categorys = Category::all();
        return view('livewire.admin.coupon.coupon2-component',['coupons'=>$coupons,'categorys'=>$categorys])->layout('livewire.layouts.base');
    }

    public function close()
    {
        $this->resetInputs();
    }

    public function editPost($id)
    {
        $post = Coupon::find($id);

        $this->coupon_id = $post->id;
        $this->coupon_name = $post->coupon_name;
        $this->code = $post->code;
        $this->type =$post->type;
        $this->value = $post->value;
        $this->coupon_category_id =$post->category_id;
        $this->cart_value = $post->cart_value;
        $this->status= $post->status;
        
//dd($this->coupon_id);
        $this->dispatch('show-edit-post-modal');
    }
    
    public function editPostData()
    {
        //dd($this->coupon_id);
        //on form submit validation
        $this->validate([
            'code' => 'required|unique:coupons,code,'.$this->coupon_id.'', //Validation with ignoring own data
            'coupon_name' => 'required',
            'type'=>'required',
            'value' =>'required',
            'status' => 'required'
        ]);

        $post = Coupon::find($this->coupon_id);
        $post->code = $this->code;
        $post->coupon_name = $this->coupon_name;
        $post->type = $this->type;
        $post->value = $this->value;
        $post->status = $this->status;
        $post->category_id = $this->category_id;
        $post->cart_value = $this->cart_value;
        $post->save();

        session()->flash('message', 'Coupon has been updated successfully');

        //For hide modal after add post added successfully
        $this->dispatch('close-modal');
    }
}
