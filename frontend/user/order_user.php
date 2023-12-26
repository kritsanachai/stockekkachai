<?php 
    include("header_user.php");
    include("../../backend/connect_db.php");
    $id_user = $_SESSION['user_login'];
    $result = $conn->query("SELECT * FROM cart WHERE id_user = $id_user");
    $rows = $result->num_rows;
    $x = 0;
    ?>
    
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('nav_right_user.php');?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include('nav_top_user.php'); ?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-2 text-gray-800">รายการเบิกวัสดุ</h1>
                    </div>
                    
                    <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4" >
                        <div class="card-body">
                            <div class="table-responsive">
                                            <table class="table table-striped text-center" id="myTable" width="100%" cellspacing="0">
                                                <thead >
                                                    <tr>
                                                        <th class="text-center">ลำดับ</th>
                                                        <th class="text-center">วันที่ทำการสั่งซื้อ</th>
                                                        <th class="text-center">รายการออเดอร์</th>
                                                        <th class="text-center">สถานะ</th>
                                                        <th class="text-center">หมายเหตุ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $id_user = $_SESSION['user_login'];
                                                        $result = $conn->query("SELECT * FROM orders WHERE id_user = '$id_user'");
                                                        $rows = $result->num_rows;
                                                        $x = 0;
                                                        if ($rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                            // $userRe = $conn->query("SELECT * FROM users WHERE user_id = '$id_user'");
                                                            // $user = $userRe->fetch_assoc();
                                                            $date = date_create($row['order_date']);
                                                            // $date = date_format($dateStart, "d-m-Y");
                                                            $x++;
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $x; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo date_format($date, "d/m/Y"); ?>
                                                                </td>
                                                                <td><button class="btn btn-primary" id="openOrderApp"
                                                                        data-id="<?php echo $row['id_order']; ?>"
                                                                        data-id_user="<?php echo $row['id_user']; ?>">เปิด</button></td>
                                                                <td class="fw-bolder">
                                                                        <?php if($row['status'] == "อนุมัติแล้ว"){ ?>
                                                                            <p class="text-success"><?php echo $row['status']; ?></p>
                                                                        <?php }else if($row['status'] == "รอยืนยัน"){ ?>
                                                                            <p class="text-warning"><?php echo $row['status']; ?></p>
                                                                        <?php }else { ?>
                                                                            <p class="text-danger"><?php echo $row['status']; ?></p>
                                                                        <?php }?>
                                                                </td>
                                                                <td><?php echo $row['note'];?></td>
                                                            </tr>
                                                        <?php }
                                                    } else { ?>
                                                        <tr>
                                                            <td style="display:none"></td>
                                                            <td style="display:none"></td>
                                                            <td style="display:none"></td>
                                                            <td style="display:none"></td>
                                                            <td colspan="5" class="text-danger">ไม่มีรายการเบิก</td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                    </div>

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

    <!-- Logout Modal-->
    <script>
         $(document).ready(function () {
            $('#myTable').DataTable();
        });
        $(document).on("click", "#openOrderApp", function () {
            var idOrder = $(this).data("id");
            var idUser = $(this).data("id_user");
            console.log(idUser);
            var formdata = new FormData();
            formdata.append("idOrder", idOrder);
            formdata.append("idUser", idUser);
            $.ajax({
                url: "modalOrderUser.php",
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
  
    </script>

<script src="../assets_admin/js/sb-admin-2.min.js"></script>

</body>

</html>