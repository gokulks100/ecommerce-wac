@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Product Management</h4>
    <button class="btn btn-primary" id="addProductBtn" onclick="openModal()">Add Products</button>
    <table class="table  table-striped" id="productListTable">
        <thead class="data-head"> 
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
        <tbody></tbody>
    </table>
    </div>
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel33">Add Product</h5>
              <button type="button" class="close"data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="post" id="productForm" action="">
                    <table class="table">
                        <thead>
                        </thead>
                        <td></td><td></td>
                        <tr>
                            <th>Product Name</th>
                            <td><input name="product_name" id="productName" type="text" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Product Image</th>
                            <td><input name="product_image" id="prdoductImage"   type="file" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Product Category</th>
                             <td>
                                <select name="product_category" id="productCategory">
                                    <option>select product</option>
                                    <option value="television">television</option>
                                    <option value="headphones">Headphones</option>
                                    <option value="mobilephones">Mobiles</option>
                                    <option value="gadget">Gadgets</option>
                                    <option value="watch">Watches</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td><input name="product_price" id="productPrice"  onkeypress="return onlyNumberKey(event)" type="text" class="form-control"></td>
                        </tr>
                    </table>
                         <input type="hidden" id="id" name="id" />
                        {{csrf_field()}}
                  </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" id="add" onclick="addProduct()" class="btn btn-primary">Save</button>
              <button type="button" id="update" onclick="updateProduct()" class="btn btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>
</div>
@include('script');
@include('datatable');
@endsection