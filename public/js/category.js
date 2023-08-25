// Displaying Category
var table = $('#categories').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        buttons: [
            'csv', 'excel', 'pdf', 'print', 'reset', 'reload'
        ],
        order: [0, 'asc'],
        "ajax": {
            'url': baseUrl+'/getAllCategories',
            'type': 'POST',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,},
            {data: 'name', name: 'name'},
            {data: 'slug', name: 'slug'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],

    });


// Creating Category
$( document ).ready(function() {
        $('#addCategory').submit(function(event){
            event.preventDefault();
            var form = $('#addCategory')[0];
            var formData = new FormData(form);
            
            $.ajax({ 
                url : baseUrl+'/addCategory',
                type : 'POST',
                data : formData,
                contentType : false,
                processData : false,

                success : function(data){
                   $('#addCategoryModal').modal('hide');
                   onSuccessRemoveErrors();
                   Swal.fire({
                      icon: 'success',
                      text: 'Category Added Successfully!',
                    })
                   $('#categories').DataTable().ajax.reload();
                },

                error : function(reject){
                    if(reject.status = 422){
                        refreshErrors();
                        var errors = $.parseJSON(reject.responseText);
                        $.each(errors.errors, function(key, value){
                            $('#'+key).addClass('is-invalid');
                            $('#'+key+'_help').text(value[0]);
                        });
                     }
                }
            });
        });

        function onSuccessRemoveErrors(){
            $('#category_name').removeClass('is-invalid');
            $('#category_name').val('');
            $('#category_name_help').text('');
        }

         function refreshErrors(){
            $('#category_name').removeClass('is-invalid');
            $('#category_name_help').text('');
        }

        $('#addCategoryModal').on('hidden.bs.modal', function(){ 
            onSuccessRemoveErrors();
        });


        // Get Category For Edit

        $(document).on('click', '.editCategory', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
              $.ajax({ 
                url : baseUrl+'/getCategory/'+id,
                type : 'GET',
                data : id,
                contentType : false,
                processData : false,

                success : function(data){
                    $('#category_id').val(data.id);
                    $('#editcategory_name').val(data.name);
                   $('#editCategoryModal').modal('show');
                },
            });
            
        });

        // Update Category
        $('#editCategory').submit(function(event){
            event.preventDefault();
            var form = $('#editCategory')[0];
            var formData = new FormData(form);
            
            $.ajax({ 
                url : baseUrl+'/updateCategory',
                type : 'POST',
                data : formData,
                contentType : false,
                processData : false,

                success : function(data){
                   $('#editCategoryModal').modal('hide');
                   onSuccessRemoveEditErrors();
                   Swal.fire({
                      icon: 'success',
                      text: 'Category Updated Successfully!',
                    })
                   $('#categories').DataTable().ajax.reload();
                },

                error : function(reject){
                    if(reject.status = 422){
                        refreshEditErrors();
                        var errors = $.parseJSON(reject.responseText);
                        $.each(errors.errors, function(key, value){
                            $('#'+key).addClass('is-invalid');
                            $('#'+key+'_help').text(value[0]);
                        });
                     }
                }
            });
        });

      
        function onSuccessRemoveEditErrors(){
        $('#editcategory_name').removeClass('is-invalid');
        $('#editcategory_name').val('');
        $('#editcategory_name_help').text('');
        }

         function refreshEditErrors(){
            $('#editcategory_name').removeClass('is-invalid');
            $('#editcategory_name_help').text('');
        }

        $('#editCategoryModal').on('hidden.bs.modal', function(){ 
            onSuccessRemoveEditErrors();
        });


        //Delete Category
        $(document).on('click', '.deleteCategory', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({ 
                    url : baseUrl+'/deleteCategory/'+id,
                    type : 'GET',
                    data : id,
                    contentType : false,
                    processData : false,

                    success : function(data){
                        Swal.fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                          );
                        $('#categories').DataTable().ajax.reload();
                    },

                    error: function(data,textStatus,xhr){
                        Swal.fire({
                          title: 'Error', 
                          icon: 'warning',
                          text: 'Unable To Find!',
                        })
                    }
                });
            }
        });     

      });

    });
