<div>

    @if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
        <a href="{{url('/')}}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
        <span>{{Auth::user()->name}}</span>
        @auth
        <livewire:logout />
        @endauth
        @else
        <a href="{{route('login')}}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
        @if (Route::has('register'))
        <a href="{{route('register')}}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
        @endif
        @endauth
    </div>
    @endif
    <div class="input-group">
        <div class="form-outline">
            <label class="form-label" for="form1">Search</label>
            <input type="search" id="form1" class="form-control" wire:model="searchProduct" />
            <div class="input-group">
                Từ: <input type="number" id="form1" class="form-control" wire:model="searchProductP" />Đến: <input type="number" id="form1" class="form-control" wire:model="searchProductPrice" />
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
            <th>User</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td>{{$p->title}}</td>
                <td>{{$p->description}}</td>
                <td><img src="{{asset('storage/'.$p->img)}}" alt="" width="50px" height="50px"></td>
                <td>{{$p->price}}</td>
                <td>{{$p->creator->name}}</td>
                <td>
                    @if(Auth::check('login') == false )
                    @elseif($edit == 1)
                    <a type="small-button" class="btn btn-success" wire:click="edit({{$p->id}})">Sửa</a>
                    @endif
                    @if($delete == 1)
                    <a type="small-button" class="btn btn-danger" wire:click="remove({{$p->id}})">Delete</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        <div>
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
        </div>
    </table>

    <div class="row">

        {{ $products->links('customPaginate') }}

    </div>

    @include('livewire.add-product')

    @include('livewire.update-product')


</div>