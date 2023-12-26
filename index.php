<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frontend/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma@4/bulma.css" rel="stylesheet">
    
        <title>Login</title>
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');
        *{
          font-family: 'Kanit', sans-serif;
        }
    </style>
</head>
<body>
  <div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image" >
                       
                <!-------------      image     ------------->
                

                <!-- <div class="text text-center">
                    <p>บริษัทห้างหุ้นส่วนเอกชัย <br> อเล็กทริก</p>
                    <p>Join the community of developers <i>- ludiflex</i></p>
                </div> -->
                
            </div>

            <div class="col-md-6 right">
                
                <div class="input-box">
                <h2 class ="text-center">บริษัทห้างหุ้นส่วนเอกชัย <br> อเล็กทริก</h2>
                   <!-- <h2 class ="text-center mt-3">เข้าสู่ระบบ</h2> -->
                   <div class="input-field">
                        <input type="text" class="input" id="codeuser" required="" autocomplete="off">
                        <label for="email">รหัสพนักงาน</label> 
                    </div> 
                   <div class="input-field">
                        <input type="password" class="input" id="pass" required="">
                        <label for="pass">รหัสผ่าน</label>
                    </div> 
                   <div class="input-field">
                        
                        <input type="submit" class="submit" id="login" value="เข้าสู่ระบบ">
                   </div> 
                   <div class="signin">
                    <span>หากลืมรหัสผ่าน กรุณาติดต่อฝ่ายดูแลระบบ</span>
                   </div>
                </div>  
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on("click", "#login", function () {
            var codeuser = $('#codeuser').val();
            var pass = $('#pass').val();

            if (codeuser.trim() === '' || pass.trim() === '') {
                Swal.fire({
                    title: "กรุณากรอกข้อมูลให้ครบถ้วน!!",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1200
                });
            } else {
                // alert('Fetching data for student ID: ' + codePass);
                var formdata = new FormData();
                formdata.append("codeuser",codeuser);
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
                                window.location.href = "frontend/admin/all_product.php";
                            });
                        }else if(data == 2){
                            Swal.fire({
                                title: "เข้าสู่ระบบเรียบร้อย",
                                showConfirmButton: false,
                                icon: "success",
                                timer: 800,
                            }).then((result) => {
                                window.location.href = "frontend/user/user.php";
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