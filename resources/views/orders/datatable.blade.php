<script>
    $(function() {
           $('#orderManagementTable').DataTable({
               pageLength: 100,
               processing: true,
               serverSide: true,
               responsive:true,
               'columnDefs': [
                    {
                        targets : [6],
                        render :function(data,type,row){
                               return `<a class="edit_btn" style="width:100px;cursor:pointer;" data-id="${data}"><i class="fas fa-edit"></i></a>
                                    <a class="delete_btn"  onClick="deleteOrder(${data})" style='color:red;width:100px; cursor:pointer'><i class='fas fa-trash'></i></a>
                                    <a class="invoice_btn" style='color:red;width:100px; cursor:pointer' data-id="${data}"><i class='fas fa-file-invoice'></i></a>`
                                   ;
                        }
                    },

                ],
               dom: 'rtip',
               ajax: {
                   url: '{{route("order.getdata")}}',
                   type:"get",
                   data: function (d) {
                   }
               },
               "order": [[0, "desc"]],
               "paging": true,
               columns: [
                   { data: 'id', name: 'id',searchable: false}, 
                   { data: 'order_id', name: 'order_id'},
                   { data: 'name', name: 'name'}, 
                   { data: 'phone', name: 'phone'}, 
                   { data: 'net_amount', name: 'net_amount'}, 
                   { data: 'created_at', name: 'created_at'}, 
                   { data: 'id', name: 'id'}, 
               ],

               "initComplete": function() {
                        var i=0;
                        var input_text= [1,2,3,4];
                        var non_searchable= [];
                        this.api().columns().every(function() {
                            var column = this;
                            if(i==5)
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