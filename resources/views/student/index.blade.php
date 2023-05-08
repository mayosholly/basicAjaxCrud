<html>
    <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Crud</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>

    <body>
<!-- Add Modal -->
<div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul id="saveFormErrorList"></ul>
            <div class="form-group-mb-3">
                <label for="">Name</label>
                <input type="text" class="name form-control">
            </div>
            <div class="form-group-mb-3">
                <label for="">Email</label>
                <input type="text" class="email form-control">
            </div>
            <div class="form-group-mb-3">
                <label for="">Phone</label>
                <input type="text" class="phone form-control">
            </div>
            <div class="form-group-mb-3">
                <label for="">Course</label>
                <input type="text" class="course form-control">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add_student">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Add modal -->

<!-- Edit Modal -->
<div class="modal fade" id="editStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul id="updateFormErrorList"></ul>
        <input type="hidden" id="stud_id">
            <div class="form-group-mb-3">
                <label for="">Name</label>
                <input type="text" id="edit_name" class="name form-control">
            </div>
            <div class="form-group-mb-3">
                <label for="">Email</label>
                <input type="text" id="edit_email" class="email form-control">
            </div>
            <div class="form-group-mb-3">
                <label for="">Phone</label>
                <input type="text" id="edit_phone" class="phone form-control">
            </div>
            <div class="form-group-mb-3">
                <label for="">Course</label>
                <input type="text" id="edit_course" class="course form-control">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_student">Update</button>
      </div>
    </div>
  </div>
</div>
<!-- End Edit Modal -->

<!-- Delete Modal -->
<div class="modal fade" id="deleteStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="delete_stud_id">
        <h4>Are you sure you want to delete</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary delete_student_btn">Yes Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Modal -->

    <!-- trigger button -->
    <div class="container py-5" >
        <div class="row">
            <div class="col-md-12">
                <div id="success_message"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Student Data
                             <a class="btn btn-primary float-end " href=""  data-bs-toggle="modal" data-bs-target="#addStudent">Add Student</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Course</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                           
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
   <script>
    $(document).ready(function () {
        fetchStudent()
        function fetchStudent(){
            $.ajax({
                type: "GET",
                url: "/fetchStudent",
                dataType: "json",
                success: function (response) {
                    // console.log(response.students);
                    $('tbody').html("")
                    $.each(response.students, function (key, item) { 
                         $('tbody').append('<tr>\
                                    <td>'+item.id+'</td>\
                                    <td>'+item.name+'</td>\
                                    <td>'+item.email+'</td>\
                                    <td>'+item.phone+'</td>\
                                    <td>'+item.course+'</td>\
                                    <td><button type="button" value="'+item.id+'" class="edit_student btn btn-primary">Edit</button></td>\
                                    <td><button type="button" value="'+item.id+'" class="delete_student btn btn-danger">Delete</td>\
                                </tr>')
                    });
                }
            });
        }

        $(document).on('click', '.delete_student', function (e) {
            e.preventDefault()
            var stud_id = $(this).val();
            // console.log(stud_id);
            $('#delete_stud_id').val(stud_id)
            $('#deleteStudent').modal('show')
        });

        $(document).on('click', '.delete_student_btn', function (e) {
            e.preventDefault()
            var stud_id = $('#delete_stud_id').val();

            $.ajaxSetup({
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
                });
            $.ajax({
                type: "DELETE",
                url: "students/"+stud_id,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    $('#success_message').html("")
                    $('#success_message').addClass('alert alert-success')
                    $('#success_message').text(response.message)
                    $('#deleteStudent').modal('hide')
                    fetchStudent()
                }
            });


        });

        $(document).on('click', '.edit_student' , function (e) {
            e.preventDefault();
            var stud_id = $(this).val()
            // console.log(stud_id);
            $('#editStudent').modal('show')

            $.ajax({
                type: "GET",
                url: "students/"+stud_id,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if(response.status == 404){
                        $('#success_message').html("")
                         $('#success_message').addClass('alert alert-success')
                         $('#success_message').text(response.message)
                    }else{
                       $('#edit_name').val(response.student.name)
                       $('#edit_email').val(response.student.email)
                       $('#edit_phone').val(response.student.phone)
                       $('#edit_course').val(response.student.course)
                       $('#stud_id').val(stud_id)
                    }
                }
            });
        });

        $(document).on('click', '.update_student', function (e) {
            e.preventDefault();
            var stud_id = $('#stud_id').val()
            var data = {
                'name' : $('#edit_name').val(),
                'email' : $('#edit_email').val(),
                'phone' : $('#edit_phone').val(),
                'course' : $('#edit_course').val(),
            } 
            $.ajaxSetup({
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
                });
            $.ajax({
                type: "PUT",
                url: "/students/"+stud_id,
                data: data,
                dataType: "json",
                success: function (response) {
                    // console.log(response);

                    if(response.status == 400){
                        $('#updateFormErrorList').html("");
                    $('#updateFormErrorList').addClass("alert alert-danger");
                    $.each(response.errors, function (key, err_value) { 
                        $('#updateFormErrorList').append('<li>' + err_value + '</li>')
                    });
                    }else if(response.status == 404){
                        $('#updateFormErrorList').html("");
                    $('#success_message').html("");
                    $('#success_message').addClass("alert alert-danger");
                    $('#success_message').text(response.message);
                }else{

                    $('#updateFormErrorList').html("");
                    $('#success_message').html("");
                    $('#success_message').addClass("alert alert-success");
                    $('#success_message').text(response.message);
                    $('#editStudent').modal('hide')
                    fetchStudent()
                }
                }
            });
        });

        $(document).on('click', '.add_student', function (e) {
            e.preventDefault()
            // console.log("submit");

            var data = {
                'name' : $('.name').val(),
                'email' : $('.email').val(),
                'phone' : $('.phone').val(),
                'course' : $('.course').val(),
            } 

            $.ajaxSetup({
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
                });
            // console.log(data);
            $.ajax({
                type: "POST",
                url: "/students",
                data: data,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                if(response.status == 400){
                    $('#saveFormErrorList').html("")
                    $('#saveFormErrorList').addClass('alert alert-danger')
                    $.each(response.errors, function (key, err_value) { 
                         $('#saveFormErrorList').append('<li>' + err_value + '</li>')
                    });
                }else{
                    $('#success_message').html("")
                    $('#success_message').addClass('alert alert-success')
                    $('#success_message').text(response.message)

                    $('#addStudent').modal('hide')
                    $('#addStudent').find('input').val("")

                    fetchStudent()
                }
                }
            });
        });

    });
    </script>

</body>
</html> 