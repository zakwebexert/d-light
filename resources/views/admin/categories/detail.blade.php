<div class="card-datatable table-responsive">
    <table id="clients" class="datatables-demo table table-striped table-bordered">
        <tbody>
        <tr>
            <td>Image</td>
            <td><img src="{{ asset('productImage/'.$category->image)}}" alt="profile Pic" height="200" width="200"></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{$category->name}}</td>
        </tr>
        <tr>
            <td>Created at</td>
            <td>{{$category->created_at}}</td>
        </tr>

        </tbody>
    </table>
</div>

