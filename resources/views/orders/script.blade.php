<script>
    function openModal()
    {
        $("#orderModal").modal("show");
        $("#update").hide();
    }
    
    
    function addOrder()
    {
        let data = new FormData($('#orderForm')[0]);
        $.ajax({
        url: "{{route('order.store')}}",
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData:false,
        success:function(data){
            if(data.success==true){
                $('#orderModal').modal('hide');
                $('#orderForm')[0].reset();
                $('#orderManagementTable').DataTable().draw();
                swal('success','Success','success');
            }else{
                swal('warning',data.errorMsg,'warning');
            }
        },error:function(){
            swal('error','something went wrong','error');
        }
        });
    
    }
    
    
    function updateOrder()
    {
        let data = new FormData($('#orderForm')[0]);
        $.ajax({
        url: "{{route('order.store')}}",
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData:false,
        success:function(data){
            if(data.success==true){
                $('#orderModal').modal('hide');
                $('#orderForm')[0].reset();
                $('#orderManagementTable').DataTable().draw();
                swal('success','Updated','success');
            }else{
                swal('warning',data.errorMsg,'warning');
            }
        },error:function(){
            swal('error','something went wrong','error');
        }
        });
    
    }
    
    $(document).on('hide.bs.modal','#orderManagementTable', function () {
        $('#orderForm')[0].reset();
    });
    
    
    $(document).ready( function(){
        $('#orderManagementTable').on('click', 'tbody .edit_btn', function () {
            var id= $(this).attr('data-id');
            $.ajax({
                url: "{{route("order.edit")}}",
                type: "get",
                data: {id:id},
                beforeSend: function (xhr) {
                },
                success: function (result) {
                    $("#id").val(result.id);
                    $("#phone").val(result.phone);
                    $("#customerName").val(result.name);
                }
            });
            $("#orderModal").modal("show");
            $("#modalLabel33").html("Edit Product");
            $("#add").hide();
            $("#update").show();
    
        });

        $('#orderManagementTable').on('click', 'tbody .invoice_btn', function () {
             var id= $(this).attr('data-id');
            $.ajax({
                url: "{{route("order.invoice")}}",
                type: "get",
                data: {id:id},
                beforeSend: function (xhr) {
                },
                success:function(data){
                    if(data.success==true){
                        var newWin = window.open("");
                        newWin.document.write(data.preview);
                        newWin.print();
                        newWin.close();
                    }else{
                        swal('warning',data.errorMsg,'warning');
                    }
                },error:function(){
                    swal('error','something went wrong','error');
                }
            });
        });

    });
    
    
    function onlyNumberKey(evt) {
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
    

    function deleteOrder(id)
    {
        swal({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e){
            if(e.value)
            {
                $.ajax({
                    url: "{{route("order.delete")}}",
                    type: "DELETE",
                    data: {'id':id , '_token': '{{ csrf_token() }}'},
                    beforeSend: function (xhr) {
                    },
                    success: function (result) {
                        if(result.success == true)
                        {
                            swal('success','success','success');
                            $('#orderManagementTable').DataTable().draw();
                        }
                        else
                        {
                            swal('error',result.errorMsg,'error');
                        }
                    }
                });
            }

        });

    }

    function addRow()
    {
        var html     = '';
        var rowCount = $('#orderAddTable tr').length;
        var newno    = Number(rowCount)+1;
        html = '<tr>'+
                    '<th>Product</th>'+
                    ' <td>'+
                        ' <select name="products['+newno+'][product_id]" id="product" style="width:100%">'+
                            @foreach($product as $products)
                            '<option value="{{$products->id}}">{{$products->product_name}}</option>'
                            @endforeach
                    +' </select>'+
                    ' </td>'+
                    '<td>'+'<input name="products['+newno+'][quantity]" id="quantity" onkeypress="return onlyNumberKey(event)" type="text" class="form-control">'+'</td>'                
                +'</tr>';
        $('#orderAddTable > tbody:last-child').append(html);
    }

    function deleteCashRow()
    {
        var totalRowCount = $("#orderAddTable tr").length;
        if(totalRowCount > 2){
            var table = $('#orderAddTable'),
            lastRow = table.find('tbody tr:last'),
            rowClone = lastRow.remove();
        }
    }


    function deleteRow()
    {

    }

    function generateInvoice()
    {
       

    }
    
    
    </script>
    