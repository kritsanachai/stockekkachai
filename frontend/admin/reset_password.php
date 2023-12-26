<?php
include("header_admin.php");
  include("../../backend/connect_db.php");

  $userId = $_POST['id'];
  $result = $conn->query("SELECT * FROM users WHERE user_id ='$userId'");
  $data = $result->fetch_array();

?>


<body>

    <input type="hidden" id="id" value="<?php echo $data['user_id']; ?>">
    <div class="input-group mb-3">
      <span class="input-group-text">รหัสพนักงาน</span>
      <input type="text" readonly class="form-control" value="<?php echo $data['code_user']; ?>">
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">ชื่อพนักงาน</span>
      <input type="text" readonly class="form-control" value="<?php echo $data['fullname']; ?>">
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">รหัสผ่านใหม่</span>
      <input type="password" class="form-control" id="password_1">
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">ยืนยันรหัสผ่าน</span>
      <input type="password" class="form-control" id="password_2">
    </div>
    
    
    
    
    
    
   
    <button id="UpdatePassword" class="btn btn-warning form-control my-4">อัพเดต</button>

 
</body>

