<?php
include("header_admin.php");
  include("../../backend/connect_db.php");

  $agencyId = $_POST['id'];
  $num = $_POST['num'];
  $result = $conn->query("SELECT * FROM agency WHERE id_agency ='$agencyId'");
  $data = $result->fetch_array();

?>


<body>
  <input type="hidden" id="id" value="<?php echo $data['id_agency']; ?>">
    <div class="input-group mb-3">
      <span class="input-group-text">รหัสวัสดุ</span>
      <input type="text" readonly class="form-control" value="<?php echo $num; ?>" required>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">ชื่อหน่วยงาน</span>
      <input type="text" class="form-control" id="name" value="<?php echo $data['name']; ?>" required>
    </div>
    
   
    
    <button id="UpdateAgency" class="btn btn-warning form-control my-4">อัพเดต</button>

 
</body>

