<?php 
    include("header_admin.php");
    include("../../backend/connect_db.php");

    $x = 0;
    ?>
    
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('nav_right_admin.php');?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include('nav_top_admin.php'); ?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-2 text-gray-800">บุคลากรทั้งหมด (All user)</h1><button class="btn btn-primary" id="InsertUser">เพิ่มบุคลากร</button>
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
                                            <th>รหัสพนักงาน</th>
                                            <th>ชื่อ - นามสกุล</th>
                                            <th>หน่วยงานที่สังกัด</th>
                                            <th>เบอร์โทร</th>
                                            <th style="text-align: center;">เปลี่ยนรหัสผ่าน</th>
                                            <th style="text-align: center;">แก้ไข</th>
                                            <th style="text-align: center;">ลบ</th>
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
                                        $result = $conn->query('SELECT * FROM users WHERE status = "user"');
                                        while ($row = $result->fetch_assoc()){
                                            $x++;
                                    ?>
                                        <tr>
                                            <td><?php echo $x;?></td>
                                            <td><?php echo $row['code_user']?></td>
                                            <td><?php echo $row['fullname']?></td>
                                            <td><?php 
                                                $id_agency = $row['id_agency'];
                                                $agenRe = $conn->query("SELECT * FROM agency WHERE id_agency = '$id_agency'");
                                                $rows = $agenRe->num_rows;
                                                // echo $rows;
                                                if($rows == 0){
                                                    echo '<p class = "text-danger">ไม่มีหน่วยงานหรือหน่วยงานถูกลบ <br> กรุณาเพิ่มหน่วยงาน</p>';
                                                }else{
                                                    $agency = $agenRe->fetch_assoc();
                                                    echo $agency['name'];
                                                }  
                                                ?>
                                                </td>
                                            <td><?php echo $row['tel'];?></td>
                                            <td><div class="text-center"><button class="btn btn-primary" id="ResetPassword" data-id="<?php echo $row['user_id'];?>">แก้รหัส</button></div></td>
                                            <td><div class="text-center"><button class="btn btn-warning" id="EditUser" data-id="<?php echo $row['user_id'];?>" data-num="<?php echo $x;?>">แก้ไข</button></div></td>
                                            <td><div class="text-center"><button class="btn btn-danger" id="DeleteUser" data-id="<?php echo $row['user_id'];?>">ลบ</button></div></td>
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
    <!-- <script>
        function ConfirmDelete(){
            var con = confirm("คุณต้องการลบรายการนี้ใช่หรือไม่?");
            if (con == true){
                return true;
            }else{
                return false;
            }
        }
    </script> -->
    
    <script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
       $(document).on("click", "#DeleteUser", function () {
            var id = $(this).data("id");
            // alert(id);
            Swal.fire({
            title: "คุณต้องการลบใช่หรือไม่?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ยืนยัน",
            cancelButtonText: "ยกเลิก",
            }).then((result) => {
            if (result.isConfirmed) {
                var formdata = new FormData();
                formdata.append("id", id);
                // alert(id);

                $.ajax({
                    url:"../../backend/delete_user.php",
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
  $(document).on("click", "#InsertUser", function () {
    $.ajax({
				url: "insert_user.php",
				type: "POST",
				dataType: "html",
				contentType: false,
				processData: false,
				success: function (data) {
					Swal.fire({
                        title: "เพิ่มบุคลากร",
						showConfirmButton: false,
						html: data
					});
				}
			});
  });

  $(document).on("click", "#submitUser", function () {
    // alert('hi');
    var code_user = $("#code_user").val();
    var password_1 = $("#password_1").val();
    var password_2 = $("#password_2").val();
    var fullname = $("#fullname").val();
    var id_agency = $("#id_agency").val();
    var tel = $("#tel").val();
    // console.log(code_user, password_1, password_2, fullname,id_agency,tel);
    if (code_user.trim() === '' || fullname.trim() === '' ||  tel.trim() === '' || password_1.trim() === '' || password_2.trim() === '' || id_agency.trim() === "กรุณาเลือกแผนก") {
				Swal.fire({
					title: "กรุณากรอกข้อมูลให้ครบถ้วน!!",
					icon: "error",
					showConfirmButton: false,
					timer: 1200
				});
	} 
    else {

    var formdata = new FormData();

    formdata.append("code_user", code_user);
    formdata.append("password_1", password_1);
    formdata.append("password_2", password_2);
    formdata.append("fullname", fullname);
    formdata.append("tel", tel);
    formdata.append("id_agency", id_agency);
    // formdata.append("img", img);

    $.ajax({
      url: "../../backend/insert_user.php",
      type: "POST",
      data: formdata,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (data) {
        console.log(data)
        if (data == 2) {
            Swal.fire({
                title: "รหัสผ่านไม่ตรงกัน!!",
                showConfirmButton: false,
                icon: "error",
                timer: 800,
            });
            } else if (data == 1) {
            Swal.fire({
                title: "เพิ่มบุคลากรเรียบร้อย",
                showConfirmButton: false,
                icon: "success",
                timer: 800,
            }).then((result) => {
                window.location.href = "all_user.php";
            });
            } else {
            Swal.fire({
                title: "รหัสพนักงานถูกใช้กรุณาเปลี่ยนชื่ออื่น",
                showConfirmButton: false,
                icon: "error",
                timer: 1000,
            });
            }
      },
    });
    }
  });
  $(document).on("click", "#EditUser", function () {
        var idProduct = $(this).data("id");
        var numProduct = $(this).data("num");
        var formdata = new FormData();
        formdata.append("id",idProduct);
        formdata.append("num",numProduct);
        $.ajax({
            url:"edit_user.php",
            type:"POST",
            data:formdata,
            dataType:"html",
            contentType:false,
            processData:false,
            success:function(data){
                Swal.fire({
                    title: "แก้ไขบุคลากร",
                    showConfirmButton: false,
                    html:data 
                });
            }
        })
    
  });
  $(document).on("click", "#UpdateUser", function () {
        // alert("hi");
        var id = $('#id').val();
        var code_user = $('#code_user').val();
        var fullname = $('#fullname').val();
        var tel = $('#tel').val();
        var id_agency = $('#id_agency').val();

        var formdata = new FormData();
        
        formdata.append("id", id);
        formdata.append("code_user", code_user);
        formdata.append("fullname", fullname);
        formdata.append("tel", tel);
        formdata.append("id_agency", id_agency);
        $.ajax({
            url: "../../backend/update_user.php",
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
                }else {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        showConfirmButton: false,
                        icon: "error",
                        timer: 1000,
                    });
                }
            },
    });
});
$(document).on("click", "#ResetPassword", function () {
        var idUser = $(this).data("id");
        var formdata = new FormData();
        formdata.append("id",idUser);
        $.ajax({
            url:"reset_password.php",
            type:"POST",
            data:formdata,
            dataType:"html",
            contentType:false,
            processData:false,
            success:function(data){
                Swal.fire({
                    title: "แก้ไขรหัสผ่าน",
                    showConfirmButton: false,
                    html:data 
                });
            }
        })
    
  });
  $(document).on("click", "#UpdatePassword", function () {
        // alert("hi");
        var id = $('#id').val();
        var password_1 = $('#password_1').val();
        var password_2 = $('#password_2').val();
        if (password_1.trim() === '' || password_2.trim() === '') {
				Swal.fire({
					title: "กรุณากรอกข้อมูลให้ครบถ้วน!!",
					icon: "error",
					showConfirmButton: false,
					timer: 1200
				});
	}else {

        var formdata = new FormData();
        
        formdata.append("id", id);
        formdata.append("password_1", password_1);
        formdata.append("password_2", password_2);
        $.ajax({
            url: "../../backend/reset_password.php",
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
                }else if(data == 2) {
                    Swal.fire({
                        title: "รหัสผ่านไม่ตรงกัน!!",
                        showConfirmButton: false,
                        icon: "error",
                        timer: 1000,
                    });
                }else {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        showConfirmButton: false,
                        icon: "error",
                        timer: 1000,
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