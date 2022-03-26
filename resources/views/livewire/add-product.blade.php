<div>

    @if(Auth::check('login') == false )
    Bạn chưa đăng nhập
    @elseif($add==1)

    <div class="flex justify-center" style="float: left; margin-top: 100px">
        <h2>Thêm mới</h2>
        <div>
            @if(session()->has('message2'))
            <div class="alert alert-success">
                {{session('message2')}}
            </div>
            @endif
        </div>

        <form class="" wire:submit.prevent="addProduct" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's title" wire:model.debounce.500ms="newTitle">
                @error('newTitle') <span class="text-red-500 text-xs">{{$message}}</span>@enderror
            </div>
            <div class="form-group">
                <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's description" wire:model.debounce.500ms="newDescription">
                @error('newDescription') <span class="text-red-500 text-xs">{{$message}}</span>@enderror
            </div>
            <div class="form-group">
                <input type="file" wire:model="img">
                @error('img') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <input type="number" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's price" wire:model.debounce.500ms="newPrice">
                @error('newPrice') <span class="text-red-500 text-xs">{{$message}}</span>@enderror
            </div>
            <div class="py-2">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
    @else


    @endif
</div>