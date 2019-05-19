<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AJAX Advance</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />

</head>

<body>

    <div class="container">
        <h1>Contacts</h1>
        <a onclick="addData()" class="btn btn-primary">New Contact</a>
        <table id="contact-table" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Religion</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        @include('form')
    </div>


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https:////cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
//         swal({
//   title: "Good job!",
//   text: "You clicked the button!",
//   icon: "success",
//   button: "Aww yiss!",
// });
    </script>
    <script type="text/javascript">
        var table1 = $('#contact-table').DataTable({
            processing:true,
            serverSide:true,
            ajax: "{{ route('all.contact') }}",
            columns : [
                {data:'id', name: 'id'},
                {data:'name', name: 'name'},
                {data:'email', name: 'email'},
                {data:'phone', name: 'phone'},
                {data:'religion', name: 'religion'},
                {data:'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        function addData(){
            save_method = 'add';
            $('input[name_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('NEW CONTACT');
            $('#insert-button').text('Save');
            $('#update-button').hide();
            $(document).on('click', '#insert-button', function(event){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('contact.store') }}",
                    type: "POST",
                    data: {
                        'name' : $('#name').val(),
                        'email': $('#email').val(),
                        'phone': $('#phone').val(),
                        'religion': $('#religion').val(),
                    },
                    success: function(data){
                        $('#modal-form').modal('hide');
                        table1.ajax.reload();
                        swal({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success",
                            button: "Aww yiss!",
                        });
                    },
                    error: function(data){
                        // swal({
                        //     title: "Oops...",
                        //     text: data.message,
                        //     icon: "error",
                        //     timer: '1500',
                        // });
                        // console.log(data.responseJSON.errors);
                        // // console.log(Object.entries(data.responseJSON.errors));
                        var first_item = Object.entries(data.responseJSON.errors)[0];
                        // console.log(first_item);
                        if(first_item[0] == "name")
                        {
                            $('#nameHelp').text('* ' + first_item[1]);
                        }
                        else if(first_item[0] == 'email')
                        {
                            $('#emailHelp').text('* ' + first_item[1]);
                        }
                        else if(first_item[0] == 'phone')
                        {
                            $('#phoneHelp').text('* ' + first_item[1]);
                        }
                        else if(first_item[0] == 'religion')
                        {
                            $('#religionHelp').text('* ' + first_item[1]);
                        }
                    }
                });
            });
            // $(function(){
            //     $('#modal-form form').on('submit', function(e){
            //         if(!e.isDefaultPrevented()){
            //             var id = $('#id').val();
                        
            //             if(save_method == 'add') url = "{{ url('contact') }}";
            //             else url = "{{ url('contact') . '/'}}" + id;
            //             $.ajax({
            //                 url: url,
            //                 type: "POST",
            //                 data: new FormData($("#modal-form form")[0]),
            //                 contentType: false,
            //                 processData: false,
            //                 success: function(data){
            //                     $('#modal-form').modal('hide');
            //                     table1.ajax.reload();
            //                     swal({
            //                         title: "Good job!",
            //                         text: "You clicked the button!",
            //                         icon: "success",
            //                         button: "Aww yiss!",
            //                     });
            //                 },
            //                 error: function(data){
            //                     swal({
            //                         title: "Oops...",
            //                         text: data.message,
            //                         icon: "error",
            //                         timer: '1500',
            //                     });
            //                 }
            //             });
            //             return false;
            //         }
            //     });
            // });
        }
        function editData(id){
            $('#modal-form form')[0].reset();
            
            $.ajax({
                url: "{{ url('contact') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success : function(data)
                {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('EDIT CONTACT');
                    $('#insert-button').hide();
                    $('#update-button').text('Update');
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#religion').val(data.religion);
                },
                error: function(error)
                {
                    alert('Error...');
                }
            });
            $(document).on('click', '#update-button', function(event){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('contact') }}" + '/' + id,
                    type: "POST",
                    data: {
                        '_method' : 'PUT',
                        'id' : $('#id').val(),
                        'name' : $('#name').val(),
                        'email': $('#email').val(),
                        'phone': $('#phone').val(),
                        'religion': $('#religion').val(),
                    },
                    success: function(data){
                        $('#modal-form').modal('hide');
                        table1.ajax.reload();
                        swal({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success",
                            button: "Aww yiss!",
                        });
                    },
                    error: function(data){
                        // swal({
                        //     title: "Oops...",
                        //     text: data.message,
                        //     icon: "error",
                        //     timer: '1500',
                        // });
                        var first_item = Object.entries(data.responseJSON.errors)[0];
                        if(first_item[0] == "name")
                        {
                            $('#nameHelp').text('* ' + first_item[1]);
                        }
                        else if(first_item[0] == 'email')
                        {
                            $('#emailHelp').text('* ' + first_item[1]);
                        }
                        else if(first_item[0] == 'phone')
                        {
                            $('#phoneHelp').text('* ' + first_item[1]);
                        }
                        else if(first_item[0] == 'religion')
                        {
                            $('#religionHelp').text('* ' + first_item[1]);
                        }
                    }
                });
            });
        }
        function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('contact') }}" + '/' + id,
                        type: "POST",
                        data: {'_method' : "DELETE", '_token' : csrf_token},
                        success : function(data){
                            table1.ajax.reload();
                            swal({
                                title: "Delete Done!",
                                text: "You clicked the button!",
                                icon: "success",
                                button: "Done!",
                            });
                        },
                        error: function(data)
                        {
                            swal({
                                title: "Oops...",
                                text: data.message,
                                icon: "error",
                                timer: '1500',
                            });
                        }
                    });

                    swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
        }
        function showData(id){
            $('#single-contact').modal('show');
            $.ajax({
                url: "{{ url('contact') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success : function(data)
                {
                    $('#single-contact').modal('show');
                    //$('#show-id').val(data.id);
                    $('#fullname').text(data.name);
                    $('#contactemail').text(data.email);
                    $('#contactphone').text(data.phone);
                    $('#contactreligion').text(data.religion);
                },
                error: function(data)
                {
                    swal({
                            title: "Oops...",
                            text: data.message,
                            icon: "error",
                            timer: '1500',
                        });
                }
            });
        }
    </script>
</body>

</html>