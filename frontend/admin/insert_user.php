<?php
include("../../backend/connect_db.php");
?>


<body>
    <input type="text" class="form-control my-4" id="code_user" placeholder="รหัสพนักงาน">
    <input type="password" class="form-control my-4" id="password_1" placeholder="รหัสผ่าน">
    <input type="password" class="form-control my-4" id="password_2" placeholder="ยืนยันรหัสผ่าน">
    <input type="text" class="form-control my-4" id="fullname" placeholder="ชื่อ - นามสกุล">
    <input type="text" class="form-control my-4" id="tel" placeholder="เบอร์โทร">
    <select id="id_agency" class="form-select my-4">
        <option>กรุณาเลือกแผนก</option>
        <?php 
            $agenRe = $conn->query("SELECT * FROM agency");
            
            while($agency = $agenRe->fetch_assoc()){
        ?>
        <option value="<?php echo $agency['id_agency'] ?>"><?php echo $agency['name'] ?></option>
        <?php } ?>
    </select>
   
    <button class="btn btn-success form-control my-4" id="submitUser">ยืนยัน</button>
</body>