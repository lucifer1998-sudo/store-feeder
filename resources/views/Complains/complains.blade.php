<div class="flex ">
    <form method="POST" action="{{route('logs.store')}}" class="w-full" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <select class="js-example-basic-multiple form-control" name="users[]" multiple="multiple" placeholder = "Notify to">
                @foreach ($users as $user)
                    <option value="{{$user -> id}}">{{$user -> name}}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="order_id" value="{{$order['OrderNumber']}}">
        <div class="form-group">
            <!-- <label for="">Logs</label> -->
            <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter a Log..." required></textarea>
        </div>
        <div class="form-group">
            <input type="checkbox" id="high_priority" name="high_priority">
            <label for="high_priority"><b>High Priority</b></label>
        </div>
        <div class="form-group">
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <div class="form-group">
            <div class="text-right">
                <button type="submit" class="btn btn-primary mb-2">Save</button>
            </div>
        </div>
    </form>

</div>
