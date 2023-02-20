<script>
    $(function() {
           $('#productListTable').DataTable({
               pageLength: 100,
               processing: true,
               serverSide: true,
               responsive:true,
               'columnDefs': [
                    {
                        targets : [5],
                        render :function(data,type,row){
                               return `<a class="edit_btn" style="width:100px;cursor:pointer;" data-id="${data}"><i class="fas fa-edit"></i></a>
                                    <a class="delete_btn"  onClick="deleteProduct(${data})" style='color:red;width:100px; cursor:pointer'><i class='fas fa-trash'></i></a>`
                                   ;
                        }
                    },

                ],
               dom: 'rtip',
               ajax: {
                   url: '{{route("product.getdata")}}',
                   type:"get",
                   data: function (d) {
                   }
               },
               "order": [[0, "desc"]],
               "paging": true,
               columns: [
                   { data: 'id', name: 'id',searchable: false}, 
                   { data: 'product_name', name: 'product_name'},
                   { data: 'product_category', name: 'product_category'}, 
                   { data: 'product_price', name: 'product_price'}, 
                   { data: 'created_at', name: 'created_at'}, 
                   { data: 'id', name: 'id'}, 
               ],

               "initComplete": function() {
                        var i=0;
                        var input_text= [1,2,3,4];
                        var non_searchable= [];
                        this.api().columns().every(function() {

                            var column = this;

                            if(i==4)
                            {
                                var input = `<input type="date" >`
                                $(input).appendTo($(column.footer()).empty())
                                .on('change', function () {
                                        column.search($(this).val(), false, false, true).draw();
                                    });
                            }
                            else if(non_searchable.includes(i))
                            {
                                var input = ``
                                $(input).appendTo($(column.footer()).empty())
                                .on('change', function () {

                                    });
                            }
                           else if (input_text.includes(i)) {
                                var input = "<input type='text'  placeholder=\"&#xF002; Search\" style='height:25px; font-family: Arial,FontAwesome' class=\"per-page form-control form-control-sm m-input\">";
                                $(input).appendTo($(column.footer()).empty())
                                .on('change', function () {
                                         column.search($(this).val(), false, false, true).draw();
                                    });
                            }
                            i++;

                        });
               }
           });
       });


</script>