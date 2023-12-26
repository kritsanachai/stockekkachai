<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma@4/bulma.css" rel="stylesheet">

 

    <link rel="stylesheet" href="frontend/css/style1.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;600&display=swap');
        *{
          font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<body>
    <!-- Section: Design Block -->
    <section class="text-center text-lg-start" >
        <!-- Jumbotron -->
        <div class="container py-4">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card cascading-right bg-dark text-white" >
                        <div class="card-body p-5 shadow-5 text-center">
                            <h1 class="fw-bold mb-5">เข้าสู่ระบบ</h1>
                
                                <!-- 2 column grid layout with text inputs for the first and last names -->


                                <!-- Email input -->
                                <div class="form-outline form-white mb-4" data-mdb-input-init>
                                    <input type="email" id="email" class="form-control form-control-lg"
                                        required />
                                    <label class="form-label" for="typeEmailX">อีเมล</label>
                                </div>



                                <div class="form-outline form-white mb-4" data-mdb-input-init>
                                    <input type="password" id="pass" class="form-control form-control-lg"
                                        required />
                                    <label class="form-label" for="typePasswordX">รหัสผ่าน</label>
                                </div>



                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4" id="login">
                                    เข้าสู่ระบบ
                                </button>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <!-- <p>or sign up with:</p> -->
                                    <a href="#">สมัครสมาชิก</a>&nbsp;&nbsp;&nbsp;
                                    <a href="#">ลืมรหัสผ่าน?</a>

                                </div>
            
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg"
                        class="w-100 rounded-4 shadow-4" alt="" />
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).on("click", "#login", function () {
            var email = $('#email').val();
            var pass = $('#pass').val();

            if (email.trim() === '' || pass.trim() === '') {
                Swal.fire({
                    title: "กรุณากรอกข้อมูลให้ครบถ้วน!!",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1200
                }).then((result) => {
                    window.location.reload();
                });
            } else {
                // alert('Fetching data for student ID: ' + codePass);
                var formdata = new FormData();
                formdata.append("email",email);
                formdata.append("pass",pass);
                
                $.ajax({
                    url: "backend/login_db.php",
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        // alert(data)
                        // console.log(data)
                        if (data == 1) {
                            Swal.fire({
                                title: "เข้าสู่ระบบเรียบร้อย",
                                showConfirmButton: false,
                                icon: "success",
                                timer: 800,
                            }).then((result) => {
                                window.location.href = "frontend/all_product.php";
                            });
                        }else if(data == 2){
                            Swal.fire({
                                title: "เข้าสู่ระบบเรียบร้อย",
                                showConfirmButton: false,
                                icon: "success",
                                timer: 800,
                            }).then((result) => {
                                window.location.href = "frontend/user.php";
                            });
                        }else if(data == 3){
                            Swal.fire({
                                title: "ไม่มีข้อมูลในระบบ",
                                showConfirmButton: false,
                                icon: "error",
                                timer: 800,
                            });
                        }else if(data == 4){
                            Swal.fire({
                                title: "อีเมลผิด",
                                showConfirmButton: false,
                                icon: "error",
                                timer: 800,
                            });
                        }else{
                            Swal.fire({
                                title: "รหัสผ่านผิด",
                                showConfirmButton: false,
                                icon: "error",
                                timer: 800,
                            });
                        }
                    },
                });
            }

        });
    </script>

</body>

</html>