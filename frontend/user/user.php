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
                        <h1 class="h3 mb-2 text-gray-800">วัสดุ</h1><a href="cart.php"><button type="button" class="btn btn-primary position-relative">
            รายการเบิกวัสดุ
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            
            <?php echo $rows; ?>
              <!-- <span class="visually-hidden">unread messages</span> -->
            </span>
          </button></a>
                    </div>
                    
                    <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <!-- <th>รูปภาพ</th> -->
                                            <th>ชื่อวัสดุ</th>
                                            <th>ราคาต่อหน่วย</th>
                                            <th>จำนวน</th>
                                            <th style="text-align: center;">เบิกวัสดุ</th>
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
                                        $result = $conn->query('SELECT * FROM products');
                                        while ($row = $result->fetch_assoc()){
                                            $x++;
                                    ?>
                                        <tr>
                                            <td><?php echo $x;?></td>
                                            <!-- <td><img style="width:150px; height:150px;" class="mx-auto d-block" src="upload/<?php echo $row['img']; ?>" alt="" class="rounded"></td> -->
                                            
                                            <!-- <td><img src="upload/<?php echo $row['img'];?>" alt=""></td> -->
                                            <td><?php echo $row['name']?></td>
                                            <td><?php echo $row['price']?></td>
                                            <td><?php echo $row['qty']?></td>
                                            <td><div class="text-center"><button class="btn btn-primary" id="AddCart" data-id_product="<?php echo $row['id_product'];?> " data-qty="1">เบิก</button></div></td>
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
        function ConfirmDelete(){
            var con = confirm("คุณต้องการลบรายการนี้ใช่หรือไม่?");
            if (con == true){
                return true;
            }else{
                return false;
            }
        }
    </script>
    
    <script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
       $(document).on("click", "#DeleteProduct", function () {
            var id = $(this).data("id");
            // alert(id);
            Swal.fire({
            title: "คุณต้องการลบใช่หรือไม่?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            }).then((result) => {
            if (result.isConfirmed) {
                var formdata = new FormData();
                formdata.append("id", id);
                // alert(id);

                $.ajax({
                    url:"../backend/delete_product.php",
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
  //start insert
  $(document).on("click", "#InsertProduct", function () {
    Swal.fire({
      title: "เพิ่มสินค้า",
      showConfirmButton: false,
      html:
        '<input type="text" class="form-control my-4" id="name" placeholder="ชื่อสินค้า" required>' +
        '<input type="text" class="form-control my-4" id="price" placeholder="ราคา" required>' +
        '<input type="text" class="form-control my-4" id="qty" placeholder="จำนวน" required>' +
        '<button class="btn btn-success form-control my-4" id="submitProduct">ยืนยัน</button>',
    });
  });
  
  $(document).on("click", "#submitProduct", function () {
    // alert('hi');
    var name = $("#name").val();
    var qty = $("#qty").val();
    var price = $("#price").val();
    // var img = $('#img')[0].files[0];
    // console.log(name);
    // console.log(img);
    var formdata = new FormData();
    formdata.append("name", name);
    formdata.append("qty", qty);
    formdata.append("price", price);
    // formdata.append("img", img);

    $.ajax({
      url: ".././backend/insert_product.php",
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
  });
  //end insert

  //start update
  $(document).on("click", "#EditProduct", function () {
        var idProduct = $(this).data("id");
        var numProduct = $(this).data("num");
        var formdata = new FormData();
        formdata.append("id",idProduct);
        formdata.append("num",numProduct);
        $.ajax({
            url:"edit_product.php",
            type:"POST",
            data:formdata,
            dataType:"html",
            contentType:false,
            processData:false,
            success:function(data){
                Swal.fire({
                    title: "แก้ไขสินค้า",
                    showConfirmButton: false,
                    html:data 
                });
            }
        })
    
  });

  $(document).on("click", "#UpdateProduct", function () {
        // alert("hi");
        var id = $('#id').val();
        var name = $('#name').val();
        // var qty = $('#qty').val();
        var price = $('#price').val();
        // var img = $('#img')[0].files[0];
        // var img2 = $('#img2')[0].files[0];
        // console.log(img);

        var formdata = new FormData();
        formdata.append("id", id);
        formdata.append("name", name);
        // formdata.append("qty", qty);
        formdata.append("price", price);
        // formdata.append("img", img);
        $.ajax({
            url: ".././backend/update_product.php",
            type: "POST",
            data: formdata,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data)
                if (data == 1) {
                Swal.fire({
                    title: "แก้ไขเสร็จสิ้น",
                    showConfirmButton: false,
                    icon: "success",
                    timer: 800,
                }).then((result) => {
                    window.location.reload();
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
});

$(document).on("click", "#AddCart", function () {
    // alert("hi");
			var id_product = $(this).data("id_product");
			var qty = $(this).data("qty");
            
			var formdata = new FormData();
			formdata.append("id_product", id_product);
			formdata.append("qty", qty);

			$.ajax({
				url: "../../backend/cart_add.php",
				type: "POST",
				data: formdata,
				dataType: "json",
				contentType: false,
				processData: false,
				success: function (data) {
					console.log(data)
					if (data == 1) {
						Swal.fire({
							title: "เพิ่มวัสดุเสร็จสิ้น",
							showConfirmButton: false,
							icon: "success",
							timer: 800,
						}).then((result) => {
							window.location.reload();
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
		});

  
    </script>

<script src="../assets_admin/js/sb-admin-2.min.js"></script>

</body>

</html>