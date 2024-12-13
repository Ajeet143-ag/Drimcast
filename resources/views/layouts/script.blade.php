<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imgInp').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#profile_image ").change(function(){
            readURL(this);
        });
                
        $(document).ready(function() {
          
            toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
            getusers();
            $('#uploadForm').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        digits: true
                    },
                    role_id: {
                        required: true
                    },
                    profile_image: {
                        required: true,
                    
                    },
                    description: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        maxlength: "Name cannot be more than 255 characters"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    phone: {
                        required: "Please enter your phone number",
                        minlength: "Phone number should be 10 digits",
                        maxlength: "Phone number should be 10 digits",
                        digits: "Please enter only digits"
                    },
                    role_id: {
                        required: "Please select a role"
                    },
                    profile_image: {
                        required: "Please select an image file",
                    
                    },
                    description: {
                        required: "Please enter a description"
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                   

                    $.ajax({
                        url: '{{url("api/save-user")}}', 
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $("#name").val('');
                            $("#email").val('');
                            $("#phone").val('');
                            $("#description").val('');
                            $('#imgInp').hide();
                            $("#profile_image").val('');
                            $('#response').html(response);
                            getusers(); 
                            toastr.success('Form submit successfully');
                        },
                        error: function(response) {
                            if (response.status === 422) {
                                var errors = response.responseJSON.errors;

                                toastr.error(errors);
                            
                            } else {
                                toastr.error('Something went wrong!');
                            }
                        }
                    });
                    return false;
                }
            });
            function getusers() { 
                var rows = '';
                $.ajax({
                    url: '{{url("api/get-users-list")}}', 
                    type: 'get',
                    dataType: 'JSON',
                    success: function(response) {
                        if(response.status=='success'){
                            $.each(response.data, function(key,val) {      
                            rows += '<tr>'+
                                        '<td>'+val.name+'</td>'+
                                        '<td>'+val.email+'</td>'+
                                        '<td>'+val.phone+'</td>'+
                                        '<td>'+val.description+'</td>'+
                                        '<td>'+val.get_user_roles.role_name+'</td>'+
                                        '<td>'+(val.profile_image ? '<img src="'+window.location.origin + '/' + val.profile_image+'" width="50">' : '')+'</td>'+
                                    '</tr>';       
                        });     

                        $('#userTable tbody').html(rows);
                        }
                    },
            
                }); 
            }
        });
        </script>

@yield('script')        