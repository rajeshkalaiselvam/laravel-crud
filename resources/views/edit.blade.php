<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Asset Form</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="{{ URL::asset('assets/style.css') }}">
	<!-- Include Select2 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<!-- Include Select2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="{{ URL::asset('assets/custom.js') }}"></script>	
</head>
  
<body>
	<div class="container">
		<div class="table-wrapper add-employee">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-12">
						<h2>Edit Details</h2>
					</div>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-md-12">
                    <form  id="myForm" action="javascript:void(0)" method="POST">
                    <div class="row">                       
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{$data->name}}" required>
                            <input type="hidden" class="form-control" name="id" value="{{$data->id}}">
                        </div>
                    </div>								
                    <div class="row">                        
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Gmail</label>
                                <input type="text" class="form-control" name="email" value="{{$data->email}}" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Mobile Number</label>
                                <input type="number" maxlength="10" class="form-control" value="{{$data->mobile}}" name="mobile" required>
                            </div>
                        </div>
                        @csrf
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Gender</label>
                               <select name="gender" class="form-control">
                                 <option value="" Selected Disabled>Select Gender</option>
                                 <option value="1" @if($data->gender == 1){{"selected"}}@endif>Male</option>
                                 <option value="2" @if($data->gender == 2){{"selected"}}@endif>Female</option>
                                 <option value="3" @if($data->gender == 3){{"selected"}}@endif>Other</option>
                               </select>
                            </div>
                        </div>
                    </div>								
				</div>
			</div>
		</div>		
		<div class="d-flex justify-content-center my-4 gap-3">
			<button type="submit" class="btn btn-success py-2 rounded-5 px-5"><strong>Submit</strong></button>
		</div>
	</div>
	</form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
        $(document).ready(function() {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const mobilePattern = /^\d{10}$/;

            function validateEmail(email) {
                return emailPattern.test(email);
            }

            function validateMobile(mobile) {
                return mobilePattern.test(mobile);
            }

            $('#myForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                
                var formData = $(this).serializeArray();
                var email = formData.find(field => field.name === "email").value;
                var mobile = formData.find(field => field.name === "mobile").value;

                let valid = true;
                let message = "";

                if (!validateEmail(email)) {
                    message += "Invalid email address.\n";
                    valid = false;
                }

                if (!validateMobile(mobile)) {
                    message += "Invalid mobile number. It should be 10 digits.\n";
                    valid = false;
                }

                if (!valid) {
                    Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: message,                   
                    });
                } else {
                    // console.log(formData);
                    // $(this).submit();
                    let formDataObject = {};
                    formData.forEach(function(field) {
                        formDataObject[field.name] = field.value;
                    });

                    // Get the CSRF token from the meta tag
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // Send the data via an AJAX call
                    $.ajax({
                        type: "POST",
                        url: "{{ url('updateForm') }}", // Replace with your server endpoint
                        data: JSON.stringify(formDataObject),
                        contentType: "application/json",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Good job!",
                                text: "Form Edited Successfully",
                                icon: "success"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to the desired page
                                    window.location.href = "{{ url('') }}"; // Replace with your desired URL
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "An error occurred: " + error,                                
                            });
                            // alert("An error occurred: " + error);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>