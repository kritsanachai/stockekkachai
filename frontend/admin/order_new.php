<?php
include('../../backend/connect_db.php');
include('header_admin.php');
$x = 0;
?>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include("nav_right_admin.php"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('nav_top_admin.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-2 text-gray-800">รายการขอเบิกล่าสุด</h1>
                    </div>

                    <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>#</th>
                                            <th>วันที่ขอเบิก</th>
                                            <th>รหัสพนักงาน</th>
                                            <th>ชื่อ - สกุล</th>
                                            <th>หน่วยงาน</th>
                                            <th>สถานะ</th>
                                            <th>ดูรายการเบิก</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot> -->

                                    <tbody>
                                        <?php
                                        $status = "รอยืนยัน";
                                        $result = $conn->query("SELECT * FROM orders WHERE status = '$status'");
                                        while ($row = $result->fetch_assoc()) {
                                            $date = date_create($row['order_date']); //format date จาก db
                                            $id_user = $row['id_user'];
                                            $userRe = $conn->query("SELECT * FROM users WHERE user_id = '$id_user'");
                                            $user = $userRe->fetch_assoc();
                                            $id_agency = $user['id_agency'];
                                            $agenRe = $conn->query("SELECT * FROM agency WHERE id_agency = '$id_agency'");
                                            $agency = $agenRe->fetch_assoc();
                                            $x++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $x; ?>
                                                </td>
                                                <td>
                                                    <?php echo date_format($date, "d/m/Y"); ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['code_user'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $user['fullname'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $agency['name']; ?>
                                                </td>

                                                <td class="text-center">
                                                    <p class="text-warning">
                                                        <?php echo $row['status']; ?>
                                                    </p>
                                                </td>
                                                <td class="text-center"><button class="btn btn-danger" id="openOrder"
                                                        data-id="<?php echo $row['id_order']; ?>"
                                                        data-id_user="<?php echo $row['id_user']; ?>">เปิด</button></td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

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

    <!-- Logout Modal-->
    <!-- Bootstrap core JavaScript-->


    <script src="../assets_user/js/main.js"></script>
    <script src="../assets_admin/js/sb-admin-2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });

        $(document).on("click", "#openOrder", function () {
            var idOrder = $(this).data("id");
            var idUser = $(this).data("id_user");
            // console.log(idUser, idOrder);
            var formdata = new FormData();
            formdata.append("idOrder", idOrder);
            formdata.append("idUser", idUser);
            $.ajax({
                url: "modalOrder.php",
                type: "POST",
                data: formdata,
                dataType: "html",
                contentType: false,
                processData: false,
                success: function (data) {
                    Swal.fire({
                        width: '1000px',
                        showConfirmButton: false,
                        html: data
                    });
                }
            })
        });
        $(document).on("click", "#confirmOrder", function () {
            // console.log("hi")
            var idOrder = $(this).data("id");
            // alert(id);
            Swal.fire({
                title: "ต้องการอนุมัติออเดอร์ใช่หรือไม่?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    var formdata = new FormData();
                    formdata.append("idOrder", idOrder);
                    // alert(id);

                    $.ajax({
                        url: "../../backend/approve_order.php",
                        type: "POST",
                        data: formdata,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if (data == 1) {
                                Swal.fire({
                                    title: "อนุมัติเสร็จสิ้น",
                                    showConfirmButton: false,
                                    icon: "success",
                                    timer: 800
                                }).then((result) => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "เกิดข้อผิดพลาด",
                                    showConfirmButton: false,
                                    icon: "error",
                                    timer: 800
                                });
                            }

                        }
                    });
                }
            });
        });

        $(document).on("click", "#cancelOrder", function () {
            // console.log("hi")

            // alert(id);
            Swal.fire({
                title: "ต้องการยกเลิกออเดอร์ใช่หรือไม่?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    var idOrder = $(this).data("id");
                    // alert(idOrder);
                    Swal.fire({
                        title: "ใส่เหตุผลที่ยกเลิก",
                        showConfirmButton: false,
                        html:
                            '<input type="text" class="form-control my-4" id="note" placeholder="เหตุผล" required>' + 
                            '<button class="btn btn-success form-control my-4" id="submitNote">ยืนยัน</button>',
                    });
                    $(document).on("click", "#submitNote", function () { 
                        var note = $("#note").val();
                        // alert(note);
                        var formdata = new FormData();
                        formdata.append("idOrder", idOrder);
                        formdata.append("note", note);
                        
                        $.ajax({
                        url: "../../backend/cancel_order.php",
                        type: "POST",
                        data: formdata,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if (data == 1) {
                                Swal.fire({
                                    title: "ยกเลิกเสร็จสิ้น",
                                    showConfirmButton: false,
                                    icon: "success",
                                    timer: 800
                                }).then((result) => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "เกิดข้อผิดพลาด",
                                    showConfirmButton: false,
                                    icon: "error",
                                    timer: 800
                                });
                            }

                        }
                    });
                    });
                }
            });
        });

    </script>

</body>

</html>