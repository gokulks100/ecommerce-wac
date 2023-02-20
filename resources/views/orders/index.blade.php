@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Order Management</h4>
    <button class="btn btn-primary" id="addOrderManagement" onclick="openModal()">Add Orders</button>
    <table class="table  table-striped" id="orderManagementTable">
        <thead class="data-head"> 
            <tr>
                <th>#</th>
                <th>Order Id</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Net Amount</th>
                <th>Order Date</th>
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
                <th></th>
            </tr>
        </tfoot>
        <tbody></tbody>
    </table>
    </div>
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel33">Add Orders</h5>
              <button type="button" class="close"data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="post" id="orderForm" action="">
                    <table class="table" style="width:100%" id="orderAddTable">
                        <tr>
                            <th style="width:150px;">Customer Name</th>
                            <td><input name="name" id="customerName"   type="text" class="form-control"></td>
                        </tr>
                         <tr>
                            <th>Phone</th>
                            <td><input name="phone" id="phone"  onkeypress="return onlyNumberKey(event)" type="text" class="form-control"></td>
                        </tr>
                        <tr>
                        <td></td>
                        <td>Select Product</td>
                        <td>quantity</td>
                        </tr>
                        <tr id="product_section">
                          <th>Product</th>
                          <td>
                              <select name="products[1][product_id]" id="product" style="width:100%">
                                  <option>select product</option>
                                  @foreach($product as $products)
                                      <option value="{{$products->id}}">{{$products->product_name}}</option>
                                  @endforeach
                              </select>
                          </td>
                           <td><input name="products[1][quantity]" id="quantity" onkeypress="return onlyNumberKey(event)" type="text" class="form-control"></td>                
                        </tr>
                        <tr id="edit_section">

                        </tr>
                    </table>
                     <div class="button_wrapper">
                          <p align="right" style="padding-top: 3px;">
                              <button class="btn btn-success  check-row check-plus"  type="button" onclick="addRow()">Add</button>
                              <button class="btn btn-danger  check-row check-minus"  type="button" onclick="deleteRow()">Delete</button>
                          </p>
                      </div>
                         <input type="hidden" id="id" name="id" />
                        {{csrf_field()}}
                  </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" id="add" onclick="addOrder()" class="btn btn-primary">Save</button>
              <button type="button" id="update" onclick="updateOrder()" class="btn btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>
</div>
@include('orders.script');
@include('orders.datatable');
@endsection