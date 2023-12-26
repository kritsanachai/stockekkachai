<?php
include("header_user.php");
include("../../backend/connect_db.php");

$x = 0;
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
                        <h1 class="h3 mb-2 text-gray-800">วัสดุ</h1>
                        <a href="user.php">
                            <button type="button" class="btn btn-primary position-relative">ย้อนกลับ</button>
                        </a>
                    </div>

                    <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="h5">รายการเบิกของคุณ</th>
                                                <th scope="col">ราคาต่อหน่วย</th>
                                                <th scope="col">จำนวน</th>
                                                <th scope="col">ราคารวม</th>
                                                <th scope="col" class="text-center">ตัวจัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            $shipping = 50;
                                            $user_id = $_SESSION['user_login'];
                                            $sqlUser = $conn->query("SELECT * FROM users WHERE user_id = '$user_id'");
                                            $dataUser = $sqlUser->fetch_assoc();
                                            $resultCart = $conn->query("SELECT * FROM cart WHERE id_user = '$user_id'");
                                            $rowCart = $resultCart->num_rows;
                                            // echo $rowCart;
                                            

                                            if ($resultCart->num_rows > 0) {
                                                while ($dataCart = $resultCart->fetch_assoc()) {
                                                    $id_product = $dataCart['id_product'];
                                                    $resultPro = $conn->query("SELECT * FROM products WHERE id_product = '$id_product'");
                                                    $product = $resultPro->fetch_assoc();
                                                    $qty = $dataCart['qty'];
                                                    $pricePro = $product['price'];
                                                    $sumTotal = $qty * $pricePro;
                                                    $total += $sumTotal;
                                                    $x++;

                                                    // $total += $dataCart['total'];
                                                    ?>
                                                    <input type="hidden" id="rowCart" value="<?php echo $rowCart; ?>">
                                                    <tr>
                                                        <th scope="row" class="border-bottom-0">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-column ms-4">
                                                                   
                                                                    <p class="mb-2">
                                                                    <?php echo $x;?> &nbsp;<?php echo $product['name']; ?>
                                                                    </p>
                                                                    <!-- <p class="mb-0">
                                                                        <?php echo $product['detail']; ?>
                                                                    </p> -->
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <td class="align-middle border-bottom-0">
                                                            <p class="mb-0" style="font-weight: 500;">
                                                                <?php echo $product['price']; ?> บาท
                                                            </p>
                                                        </td>
                                                        <td class="align-middle border-bottom-0">
                                                            <div class="d-flex flex-row">


                                                                <input min="0" id="qty" value="<?php echo $dataCart['qty']; ?>"
                                                                    type="number"
                                                                    class="form-control form-control-sm numberChange"
                                                                    style="width: 70px;" />
                                                                <input type="hidden"
                                                                    value="<?php echo $dataCart['id_product']; ?>"
                                                                    id="id_product">
                                                                



                                                            </div>
                                                        </td>
                                                        <td class="align-middle border-bottom-0">
                                                            <p class="mb-0" style="font-weight: 500;">
                                                                <?php echo $sumTotal; ?> บาท
                                                            </p>
                                                        </td>
                                                        <td class="align-middle border-bottom-0 text-center">
                                                            <i class="fa fa-trash  text-danger pe-2" id="deleteCart"
                                                                data-id_cart="<?php echo $dataCart['id_cart']; ?>"
                                                                style="cursor : pointer;"></i>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="5">
                                                        <div class="card shadow-2-strong mb-5 mb-lg-0 mt-3"
                                                            style="border-radius: 16px;">
                                                            <div class="card-body p-4 ">
                                                                <h2 class="text-center">ไม่มีรายการที่เบิก!!</h2>
                                                                <div class="d-flex justify-content-center mt-3">
                                                                    <a href="user.php">
                                                                        <button
                                                                            class="btn btn-success">เบิกวัสดุ</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>

                                </div>


                                <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
                                    <div class="card-body p-4">

                                        <div class="row justify-content-end">
                                            
                                            
                                            <div class="col-lg-8 col-xl-6 mt-3">
                                               

                                               

                                                <div class="d-flex justify-content-between mb-4"
                                                    style="font-weight: 500;">
                                                    <p class="mb-2">ราคาทั้งหมด</p>
                                                    <span class="mb-2">
                                                        <?php echo $total  ?>
                                                        <input type="hidden" value="<?php echo $total ?>" id="total">
                                                    </span>
                                                </div>

                                                <button type="button" class="btn btn-primary btn-block btn-lg" id="InsertOrder">
                                                    <div class="d-flex justify-content-between ">
                                                        <span>ยืนยันการเบิก</span>
                                                    </div>
                                                </button>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- End of Main Content -->



            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->

    <script>
        $(".numberChange").on("change", function () {
            var $el = $(this).closest('tr');
            var qty = $el.find("#qty").val();
            var id_product = $el.find("#id_product").val();

            var formdata = new FormData();
            formdata.append("id_product", id_product);
            formdata.append("qty", qty);

            $.ajax({
                url: "../../backend/numberChange.php",
                type: "POST",
                data: formdata,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (data) {
                    window.location.reload();
                },
            });
        });

        $(document).on("click", "#deleteCart", function () {
            var id_cart = $(this).data("id_cart");
            // var id_product = $(this).data("id_product");
            // alert(id_product);
            // var qty = $el.find("#qty").val();
            // var id_product = $el.find("#id_product").val();
            Swal.fire({
            title: "คุณต้องการลบรายการนี้ใช่หรือไม่?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ยืนยัน",
            cancelButtonText: "ยกเลิก",
            }).then((result) => {
            if (result.isConfirmed) {
                var formdata = new FormData();
                formdata.append("id_cart", id_cart);
                // alert(id);

                $.ajax({
                    url:"../../backend/delete_cart.php",
                    type:"POST",
                    data:formdata,
                    dataType:"json",
                    contentType:false,
                    processData:false,
                    success:function(data){
                        if(data == 1){
                            Swal.fire({
                            title:"เสร็จสิ้น",
                            showConfirmButton:false,
                            icon:"success",
                            timer:800
                        }).then((result) => {
                            window.location.reload();
                        });
                        }else{
                            Swal.fire({
                            title:"เกิดข้อผิดพลาด",
                            showConfirmButton:false,
                            icon:"error",
                            timer:800
                        });
                        }

                        }
                    });
                }
            });
        });

        $(document).on("click", "#InsertOrder", function () {
            // var slipMoney = $('#slipMoney').val();
            var total = $('#total').val();
            var rowCart = $('#rowCart').val();
            // alert(rowCart);
            if(rowCart === undefined){
                Swal.fire({
                    title: "ไม่สามารถดำเนินการได้",
                    text: "คุณไม่วัสดุที่ต้องการเบิก!!",
                    icon : "error",
                    showConfirmButton: false,
                    timer: 1200
                });
            }
            else{
                Swal.fire({
            title: "คุณต้องการเบิกวัสดุใช่หรือไม่?",
            text: "กรุณาตรวจสอบรายการก่อนกดยืนยัน",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ยืนยัน",
            cancelButtonText: "ยกเลิก",
            }).then((result) => {
            if (result.isConfirmed) {
                var formdata = new FormData();
                formdata.append("total", total);

                $.ajax({
                    url:"../../backend/insert_order.php",
                    type:"POST",
                    data:formdata,
                    dataType:"json",
                    contentType:false,
                    processData:false,
                    success:function(data){
                        console.log(data)
                        if(data == 1){
                            Swal.fire({
                                title:"ทำรายเบิกเสร็จสิ้น",
                                text: "คุณสามารถดูสถานะรายการเบิกได้ที่การเบิกวัสดุ",
                                showConfirmButton:false,
                                icon:"success",
                                timer:1200
                        }).then((result) => {
                            window.location.reload();
                        });
                        }else if(data == 2){
                            Swal.fire({
                                title:"ไม่สามารถทำรายการเบิกได้!!",
                                text: "มีจำนวนวัสดุที่เบิกมีมากกว่าในคลัง กรุณาตรวจสอบอีกครั้ง",
                                showConfirmButton:false,
                                icon:"error",
                                timer:4000
                            });
                        }else{
                            Swal.fire({
                                title:"เกิดข้อผิดพลาด",
                                showConfirmButton:false,
                                icon:"error",
                                timer:800
                            });
                        }

                        }
                    });
                }
            });
                // console.log("hi");
                
                }
        });

    </script>

    <script src="../assets_admin/js/sb-admin-2.min.js"></script>

</body>

</html>