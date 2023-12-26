<?php
include("header_user.php");
include("../../backend/connect_db.php");
$id_user = $_SESSION['user_login'];
$result = $conn->query("SELECT * FROM users WHERE user_id = $id_user");
$data = $result->fetch_assoc();
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
                        <h1 class="h3 mb-2 text-gray-800">แก้ไขข้อมูลส่วนตัว</h1>
                    </div>

                    <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="basic-url" class="form-label">รหัสพนักงาน</label>
                                            <input type="text" class="form-control" readonly
                                                value="<?php echo $data['code_user']; ?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="basic-url" class="form-label">ชื่อพนักงาน</label>
                                            <input type="text" class="form-control" placeholder="ชื่อพนักงาน"
                                               id = "fullname" value="<?php echo $data['fullname']; ?>">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="basic-url" class="form-label">เบอร์โทร</label>
                                            <input type="text" class="form-control"  id = "tel" value="<?php echo $data['tel'];?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="basic-url" class="form-label">หน่วยงาน</label>
                                            <input type="text" class="form-control" readonly value="<?php 
                                            $id_agency = $data['id_agency']; 
                                            $agenRe = $conn->query("SELECT * FROM agency WHERE id_agency = '$id_agency'");
                                            $agenData = $agenRe->fetch_assoc();
                                            echo $agenData['name'];
                                            ?>">
                                        </div>
                                    </div>
                                    <button class="btn btn-success form-control mt-4" id="updateUser">อัพเดท</button>
                                </div>
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
            $(document).on("click", "#updateUser", function () {
                // alert('hi');
                var fullname = $("#fullname").val();
                var tel = $("#tel").val();


                // console.log(fullname, tel, password_1, password_2);

                var formdata = new FormData();

                formdata.append("fullname", fullname);
                formdata.append("tel", tel);
                // formdata.append("img", img);

                $.ajax({
                    url: "../../backend/edit_user.php",
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data)
                        if (data == 1) {
                            Swal.fire({
                                title: "เสร็จสิ้น",
                                showConfirmButton: false,
                                icon: "success",
                                timer: 800,
                            }).then((result) => {
                                window.location.reload();
                            });
                        }else {
                            Swal.fire({
                                title: "เกิดข้อผิดพลาด",
                                showConfirmButton: false,
                                icon: "error",
                                timer: 800,
                            });
                        }
                    },
                });
            });

        </script>

        <script src="../assets_admin/js/sb-admin-2.min.js"></script>

</body>

</html>