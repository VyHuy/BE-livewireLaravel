<div>
    @if(Auth::check('login') == false )
    Bạn chưa đăng nhập
    @elseif($edit ==1)

    <div class="flex justify-right" style="float: right; margin-top: 100px">
        <h2>Sửa</h2>
        <div>
            @if(session()->has('message1'))
            <div class="alert alert-success">
                {{session('message1')}}
            </div>
            @endif
        </div>
        <input type="hidden" wire:model="selected_id">
        <form class="" wire:submit.prevent="updateProduct" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's title" wire:model.debounce.500ms="upTitle">
                @error('upTitle') <span class="text-red-500 text-xs">{{$message}}</span>@enderror
            </div>
            <div class="form-group">
                <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's description" wire:model.debounce.500ms="upDescription">
                @error('upDescription') <span class="text-red-500 text-xs">{{$message}}</span>@enderror
            </div>
            <div class="form-group">
                <input type="file" wire:model="upImg">
                @error('upImg') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <input type="number" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's price" wire:model.debounce.500ms="upPrice">
                @error('upPrice') <span class="text-red-500 text-xs">{{$message}}</span>@enderror
            </div>
            <div class="py-2">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    @else

    @endif

</div>