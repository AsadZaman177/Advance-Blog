// Displaying Category
var table = $('#tags').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        order: [0, 'asc'],
        "ajax": {
            'url': baseUrl+'/getAllTags',
            'type': 'POST',
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
            {data: 'name', name: 'name'},
            {data: 'slug', name: 'slug'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
    });


// Creating Category
$( document ).ready(function() {
        $('#addTag').submit(function(event){
            event.preventDefault();
            var form = $('#addTag')[0];
            var formData = new FormData(form);
            
            $.ajax({ 
                url : baseUrl+'/addTag',
                type : 'POST',
                data : formData,
                contentType : false,
                processData : false,

                success : function(data){
                   $('#addTagModal').modal('hide');
                   onSuccessRemoveErrors();
                   Swal.fire({
                      icon: 'success',
                      text: 'Tag Added Successfully!',
                    })
                   $('#tags').DataTable().ajax.reload();
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
            $('#tag_name').removeClass('is-invalid');
            $('#tag_name').val('');
            $('#tag_name_help').text('');
        }

         function refreshErrors(){
            $('#tag_name').removeClass('is-invalid');
            $('#tag_name_help').text('');
        }

        $('#addTagModal').on('hidden.bs.modal', function(){ 
            onSuccessRemoveErrors();
        });


        // Get Tag For Edit

        $(document).on('click', '.editTag', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
              $.ajax({ 
                url : baseUrl+'/getTag/'+id,
                type : 'GET',
                data : id,
                contentType : false,
                processData : false,

                success : function(data){
                    $('#tag_id').val(data.id);
                    $('#edittag_name').val(data.name);
                   $('#editTagModal').modal('show');
                },
            });
            
        });

        // Update Tag
        $('#editTag').submit(function(event){
            event.preventDefault();
            var form = $('#editTag')[0];
            var formData = new FormData(form);
            
            $.ajax({ 
                url : baseUrl+'/updateTag',
                type : 'POST',
                data : formData,
                contentType : false,
                processData : false,

                success : function(data){
                   $('#editTagModal').modal('hide');
                   onSuccessRemoveEditErrors();
                   Swal.fire({
                      icon: 'success',
                      text: 'Tag Updated Successfully!',
                    })
                   $('#tags').DataTable().ajax.reload();
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
        $('#edittag_name').removeClass('is-invalid');
        $('#edittag_name').val('');
        $('#edittag_name_help').text('');
        }

         function refreshEditErrors(){
            $('#edittag_name').removeClass('is-invalid');
            $('#edittag_name_help').text('');
        }

        $('#editTagModal').on('hidden.bs.modal', function(){ 
            onSuccessRemoveEditErrors();
        });


        //Delete Category
        $(document).on('click', '.deleteTag', function(e){
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
                    url : baseUrl+'/deleteTag/'+id,
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
                        $('#tags').DataTable().ajax.reload();
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
