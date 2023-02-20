<script>
    function openModal()
    {
        $("#productModal").modal("show");
        $("#update").hide();
    }
    
    
    function addProduct()
    {
        let data = new FormData($('#productForm')[0]);
        $.ajax({
        url: "{{route('product.store')}}",
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData:false,
        success:function(data){
            if(data.success==true){
                $('#productModal').modal('hide');
                $('#productForm')[0].reset();
                $('#productListTable').DataTable().draw();
                swal('success','Success','success');
            }else{
                swal('warning',data.errorMsg,'warning');
            }
        },error:function(){
            swal('error','something went wrong','error');
        }
        });
    
    }
    
    
    function updateProduct()
    {
        let data = new FormData($('#productForm')[0]);
        $.ajax({
        url: "{{route('product.store')}}",
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData:false,
        success:function(data){
            if(data.success==true){
                $('#productModal').modal('hide');
                $('#productForm')[0].reset();
                $('#productListTable').DataTable().draw();
                swal('success','Updated','success');
            }else{
                swal('warning',data.errorMsg,'warning');
            }
        },error:function(){
            swal('error','something went wrong','error');
        }
        });
    
    }
    
    $(document).on('hide.bs.modal','#productListTable', function () {
        $('#productForm')[0].reset();
    });
    
    
    $(document).ready( function(){
        $('#productListTable').on('click', 'tbody .edit_btn', function () {
            var id= $(this).attr('data-id');
            $.ajax({
                url: "{{route("product.edit")}}",
                type: "get",
                data: {id:id},
                beforeSend: function (xhr) {
                },
                success: function (result) {
                    $("#id").val(result.id);
                    $("#productName").val(result.product_name);
                    $("#productCategory").val(result.product_category);
                    $("#productPrice").val(result.product_price);
                    $("#productImage").val(result.product_image);
                }
            });
            $("#productModal").modal("show");
            $("#modalLabel33").html("Edit Product");
            $("#add").hide();
            $("#update").show();
    
        });
    });
    
    
    function onlyNumberKey(evt) {
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
    

    function deleteProduct(id)
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
                    url: "{{route("product.delete")}}",
                    type: "DELETE",
                    data: {'id':id , '_token': '{{ csrf_token() }}'},
                    beforeSend: function (xhr) {
                    },
                    success: function (result) {
                        if(result.success == true)
                        {
                            swal('success','success','success');
                            $('#productListTable').DataTable().draw();
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

    
    
    </script>
    