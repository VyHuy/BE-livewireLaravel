<div>
    @if(Auth::check('login') == false )
    Bạn chưa đăng nhập
    @elseif($view ==1 && $add==1 && $edit ==1 && $delete == 1 )

    <div class="flex justify-right" style="float: right; margin-top: 100px">
        <h2>Sửa</h2>
        <div>
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
        </div>
        <input type="hidden" wire:model="selected_id">
        <form class="" wire:submit.prevent="updateUser">
            <select name="" id="" wire:model="upRole">
                <option value="1111">Admin</option>
                <option value="1110">VAE</option>
                <option value="1100">VA</option>
                <option value="1000">V</option>
                @error('upRole') <span class="text-red-500 text-xs">{{$message}}</span>@enderror
            </select>

            <div class="py-2">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

    @else

    @endif

</div>