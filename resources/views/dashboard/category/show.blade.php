<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <table width="100%" class="table table-bordered">
                    <tr>
                        <th>Image</th>
                        <td><img src="{{$category->image}}" alt="{{$category->name}}" width="500"></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{$category->name}}</td>
                    </tr>
                    <tr>
                        <th>Subcategory</th>
                        <td>
                            @foreach($category->subcategories as $subcategory)
                                {{ $subcategory->name }} <br>
                            @endforeach
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <a href="javascript:"
                   onclick="remove('{{route('category.destroy',['id' => $category->id])}}')"
                   class="btn btn-danger btn-elevate btn-icon-sm">
                    <i class="la la-trash"></i>
                    Delete
                </a>
                <a href="{{route('category.edit',['id' => $category->id])}}"
                   class="btn btn-info btn-elevate btn-icon-sm">
                    <i class="la la-edit"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>



