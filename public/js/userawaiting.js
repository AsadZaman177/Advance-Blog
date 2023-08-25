// Displaying Blogs
var table = $('#awaiting').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        order: [0, 'asc'],
        "ajax": {
            'url': baseUrl+'/user/allawaitingblogs',
            'type': 'POST',
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
            {data: 'title', name: 'title'},
            {data: 'image', name: 'image'},
            {data: 'url', name: 'url'},
            {data: 'category_id', name: 'category_id'},
            {data: 'user_id', name: 'user_id'},
            {data: 'active', name: 'active'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
    });

var table = $('#approved').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        order: [0, 'asc'],
        "ajax": {
            'url': baseUrl+'/user/allapprovedblogs',
            'type': 'POST',
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
            {data: 'title', name: 'title'},
            {data: 'image', name: 'image'},
            {data: 'url', name: 'url'},
            {data: 'category_id', name: 'category_id'},
            {data: 'user_id', name: 'user_id'},
            {data: 'active', name: 'active'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
    });


// Delete Blog
$( document ).ready(function() {
        $(document).on('click', '.deleteBlog', function(e){
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
                    url : baseUrl+'/user/deleteBlog/'+id,
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
                        $('#awaiting').DataTable().ajax.reload();
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


