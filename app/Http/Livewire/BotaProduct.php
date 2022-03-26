<?php

namespace App\Http\Livewire;

use App\Models\ProductManage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BotaProduct extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $newTitle, $newDescription, $img, $newPrice, $selected_id, $upTitle, $upDescription, $upImg,
    $upPrice, $user, $searchProduct, $searchProductP, $searchProductPrice, $view, $add, $edit, $delete;
    public function mount()
    {
        if (Auth::check('login') == true) {
            $permission   = str_split(Auth::user()->role);
            $this->view   = $permission[0];
            $this->add    = $permission[1];
            $this->edit   = $permission[2];
            $this->delete = $permission[3];
        } else {
            return redirect(route('login'));
        }
    }
    protected $listeners = ['fileUpload' => 'handleFileUpload'];
    public function handleFileUpload($imageData)
    {
        $this->img = $imageData;
    }
    // VALIDATE
    public function updated($propertyName)
    {
        $this->validateOnly(
            $propertyName,
            [
                'newTitle'       => 'required|max:255',
                'newDescription' => 'required|max:255',
                'img'            => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
                'newPrice'       => 'required|numeric',
                'upTitle'        => 'required|max:255',
                'upDescription'  => 'required|max:255',
                'upImg'          => 'required|mimes:jpg,jpeg,png,svg,gif|max:2048',
                'upPrice'        => 'required|numeric',
            ],
        );
    }
    // THÊM MỚI
    public function addProduct()
    {
        $this->validate([
            'newTitle'       => 'required',
            'newDescription' => 'required',
            'img'            => 'required',
            'newPrice'       => 'required',
        ]);
        $addNew = ProductManage::create([
            'title'       => $this->newTitle,
            'description' => $this->newDescription,
            'img'         => $this->img->store('bota-product', 'public'),
            'price'       => $this->newPrice,
            'user_id'     => (Auth::user()->id),
        ]);
        $this->resetPage();
        session()->flash('message2', 'Them thanh cong :))');
    }
    // SỬA
    public function edit($selected_id)
    {
        $products          = ProductManage::find($selected_id);
        $this->selected_id = $products->id;

        $this->upTitle       = $products->title;
        $this->upDescription = $products->description;
        $this->upImg         = $products->img;
        $this->upPrice       = $products->price;
    }
    public function updateProduct()
    {
        $products = ProductManage::find($this->selected_id);
        // dd($products);
        $this->validate([
            'upTitle'       => 'required',
            'upDescription' => 'required',
            'upPrice'       => 'required',
        ]);
        $products->update([
            'title'       => $this->upTitle,
            'description' => $this->upDescription,
            'img'         => $this->upImg->store('bota-product', 'public'),
            'price'       => $this->upPrice,
            'user_id'     => (Auth::user()->id),
        ]);
        $this->reset();
        session()->flash('message1', 'Sửa thành công :))');
    }
    // XÓA
    public function remove($productId)
    {
        $product = ProductManage::find($productId);
        $product->delete();
        session()->flash('message', 'remove successfully');
    }

    // VIEW
    public function render()
    {
        $products = ProductManage::query();
        if ($this->searchProduct) {
            $products = $products->where('title', 'like', '%' . $this->searchProduct . '%');
        }
        if ($this->searchProductP) {
            $products = $products->where('price', '>=', $this->searchProductP);
        }
        if ($this->searchProductPrice) {
            $products = $products->where('price', '<=', $this->searchProductPrice);
        }
        $products = $products->paginate(10);
        return view('livewire.bota-product', ['products' => $products]);
    }
}
