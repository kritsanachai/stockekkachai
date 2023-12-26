<?php
include("header_user.php");
include("../../backend/connect_db.php");
$id_user = $_SESSION['user_login'];
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('nav_right_user.php'); ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include('nav_top_user.php'); ?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-2 text-gray-800">แก้ไขรหัสผ่าน</h1>
                    </div>

                    <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">

                            <div class="container-fluid">
                                <label for="basic-url" class="form-label ">รหัสผ่านเดิม</label>
                                <input type="password" id="password_0" class="form-control">
                                <label for="basic-url" class="form-label mt-3">เปลี่ยนรหัสผ่าน</label>
                                <input type="password" id="password_1" class="form-control">
                                <label for="basic-url" class="form-label mt-3">ยืนยันรหัสผ่าน</label>
                                <input type="password" id="password_2" class="form-control">
                            </div>
                            <button class="btn btn-success form-control mt-4" id="updateUser1">อัพเดท</button>
                        </div>


                    </div>
                    <!-- <div class="d-flex justify-content-center row">
                            <div class="col-8">
                                
                            </div>
                        </div> -->


                </div>

            </div>
            <!-- End of Main Content -->



        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <script>
        $(document).on("click", "#updateUser1", function () {
            
            var password_0 = $("#password_0").val();
            var password_1 = $("#password_1").val();
            var password_2 = $("#password_2").val();
            console.log(password_0, password_1,password_2);
            if (password_0.trim() === '' || password_1.trim() === '' || password_2.trim() === '') {
				Swal.fire({
					title: "กรุณากรอกข้อมูลให้ครบถ้วน!!",
					icon: "error",
					showConfirmButton: false,
					timer: 1200
				});
	        } 
            else {

            var formdata = new FormData();
            formdata.append("password_0", password_0);
            formdata.append("password_1", password_1);
            formdata.append("password_2", password_2);
            // formdata.append("img", img);

            $.ajax({
                url: "../../backend/edit_pass.php",
                type: "POST",
                data: formdata,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data)
                    if (data == 1) {
                        Swal.fire({
                            title: "เปลี่ยนรหัสเสร็จสิ้น",
                            showConfirmButton: false,
                            icon: "success",
                            timer: 800,
                        }).then((result) => {
                            window.location.reload();
                        });
                    } else if (data == 2) {
                        Swal.fire({
                            title: "ไม่สามารถแก้ไขได้",
                            text: "เนื่องจากรหัสผ่านของคุณไม่ตรงกัน",
                            showConfirmButton: false,
                            icon: "error",
                            timer: 1500,
                        });
                    }else if (data == 3) {
                        Swal.fire({
                            title: "ไม่สามารถแก้ไขได้",
                            text: "กรุณากรอกรหัสผ่านเดิมให้ถูกต้อง!!!",
                            showConfirmButton: false,
                            icon: "error",
                            timer: 1500,
                        });
                    } else {
                        Swal.fire({
                            title: "เกิดข้อผิดพลาด",
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

    <script src="../assets_admin/js/sb-admin-2.min.js"></script>

</body>

</html>