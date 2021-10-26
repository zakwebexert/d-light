<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<tbody>
        <tr>
            <td>Image</td>
            <td><img src="{{ asset('productImage/'.$product->image)}}" alt="profile Pic" height="200" width="200"></td>
        </tr>
		<tr>
			<td>Name</td>
			<td>{{$product->name}}</td>
		</tr>
		<tr>
			<td>Description</td>
			<td>{{$product->product_desc}}</td>
		</tr>
        <tr>
            <td>SKU</td>
            <td>{{$product->product_sku}}</td>
        </tr>
        <tr>
            <td>Category</td>
            <td>{{$product->category->name}}</td>
        </tr>
        <tr>
            <td>Style</td>
            <td>{{$product->style->style_name}}</td>
        </tr>
        <tr>
            <td>Price</td>
            <td>{{$product->price}}</td>
        </tr>

		<tr>
			<td>Created at</td>
			<td>{{$product->created_at}}</td>
		</tr>

		</tbody>
	</table>
</div>

