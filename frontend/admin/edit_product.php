<?php
include("header_admin.php");
  include("../../backend/connect_db.php");

  $productId = $_POST['id'];
  $num = $_POST['num'];
  $result = $conn->query("SELECT * FROM products WHERE id_product='$productId'");
  $data = $result->fetch_array();

?>


<body>
    <input type="hidden" id="id" value="<?php echo $data['id_product'];?>">
    <div class="input-group mb-3">
      <span class="input-group-text">รหัสวัสดุ</span>
      <input type="text" readonly class="form-control" value="<?php echo $num; ?>" required>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">ชื่อวัสดุ</span>
      <input type="text" class="form-control" id="name" value="<?php echo $data['name']; ?>" required>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">ราคาต่อหน่วย</span>
      <input type="text" class="form-control" id="price" value="<?php echo $data['price']; ?>" required>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">จำนวนวัสดุ</span>
      <input type="text" class="form-control" id="qty" value="<?php echo $data['qty']; ?>" required>
    </div>
      
      
      
      <!-- <input type="hidden" class="form-control  my-4" id="img2" value="<?php echo $data['img']; ?>" required> -->
      
      <!-- <input type="text" class="form-control  my-4" id="qty" value="<?php echo $data['qty']; ?>" required> -->
      <!-- <input type="file" class="form-control  my-4" id="img">
      <img width="100%" src="upload/<?php echo $data['img']; ?>" id="previewImg" alt=""> -->
      
      <button id="UpdateProduct" class="btn btn-warning form-control my-4">อัพเดต</button>
    
 
</body>

