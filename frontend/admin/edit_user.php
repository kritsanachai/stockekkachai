<?php
include("header_admin.php");
  include("../../backend/connect_db.php");

  $userId = $_POST['id'];
  $num = $_POST['num'];
  $result = $conn->query("SELECT * FROM users WHERE user_id ='$userId'");
  $data = $result->fetch_array();

?>


<body>
    <input type="hidden" id="id" value="<?php echo $data['user_id']; ?>">
    <div class="input-group mb-3">
      <span class="input-group-text">#</span>
      <input type="text" readonly class="form-control" value="<?php echo $num; ?>">
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">รหัสพนักงาน</span>
      <input type="text" readonly class="form-control" id="code_user" value="<?php echo $data['code_user']; ?>">
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">ชื่อพนักงาน</span>
      <input type="text" class="form-control" id="fullname" value="<?php echo $data['fullname']; ?>" required>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">เบอร์โทร</span>
      <input type="text" class="form-control" id="tel" value="<?php echo $data['tel']; ?>" required>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">หน่วยงาน</span>
      <select id="id_agency" class="form-select">
        <?php 
            $id_agency = $data['id_agency'];
            $agenRe = $conn->query("SELECT * FROM agency WHERE id_agency = '$id_agency'");
            $rows = $agenRe->num_rows;
            if($rows == 0){ ?>
                <option class="text-danger">หน่วยงานถูกลบไปแล้ว กรุณาเพิ่มสังกัดใหม่</option>
           <?php } else{
            $agency1 = $agenRe->fetch_assoc();
        ?>
        <option value="<?php echo $agency1['id_agency'] ?>"><?php echo $agency1['name'] ?></option>
        <?php }
            $agenRe = $conn->query("SELECT * FROM agency");
            
            while($agency = $agenRe->fetch_assoc()){
        ?>
        <option value="<?php echo $agency['id_agency'] ?>"><?php echo $agency['name'] ?></option>
        <?php } ?>
        
    </select>
    </div>
    
    
    
    
    
    
   
    <button id="UpdateUser" class="btn btn-warning form-control my-4">อัพเดต</button>

 
</body>

