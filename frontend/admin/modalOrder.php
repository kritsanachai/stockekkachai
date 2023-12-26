<?php
    include("header_admin.php");
    include("../../backend/connect_db.php");
    $idOrder = $_POST['idOrder'];
    $idUser = $_POST['idUser'];
    $resultUser = $conn->query("SELECT * FROM users WHERE user_id = '$idUser'");
    $user = $resultUser->fetch_assoc();
    $id_agency = $user['id_agency'];
    $agenRe = $conn->query("SELECT * FROM agency WHERE id_agency = '$id_agency'");
    $agency = $agenRe->fetch_assoc();
    $x = 0;
    $total = 0;
?>

<h3 class="d-flex justify-content-center fw-bold mt-5">รายการเบิกวัสดุ</h3>

<h5 class="d-flex justify-content-center fw-semibold mt-3">รายละเอียดข้อมูล</h5>

<div class="justify-content-center ">
    <div class="d-flex justify-content-around flex-sm-wrap mt-3">
        <div>
            <p>รหัสพนักงาน : <span>
                    <?php echo $user['code_user']; ?>
                </span></p>
            <p>ชื่อ - สกุล : <span>
                    <?php echo $user['fullname']; ?>
                </span></p>
        </div>
        <div class="mt-2">
            <p>หน่วยงาน : <span>
                    <?php echo $agency['name']; ?>
                </span></p>
            <p>เบอร์โทร : <span>
                    <?php echo $user['tel']; ?>
                </span></p>
        </div>
    </div>

</div>


<table class="table table-hover" style="width: 900px;">
    <thead class="table-secondary">
        <tr>
            <th scope="col">#</th>
            <th scope="col">ชื่อสินค้า</th>
            <th scope="col">จำนวน</th>
            <th scope="col">ราคารวม</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $shipping = 50;
        $stu = $conn->query("SELECT * FROM order_details WHERE id_order = '$idOrder'");
        while ($row = $stu->fetch_assoc()) {
            $idPro = $row['product_id'];
            $rePro = $conn->query("SELECT * FROM products WHERE id_product = '$idPro'");
            $product = $rePro->fetch_assoc();
            $sumPro = $product['price'] * $row['qty'];
            $x++;
            $total += $sumPro;
            ?>
            <tr>
                <td>
                    <?php echo $x; ?>
                </td>
                <td>
                    <?php echo $product['name'] ?>
                </td>
                <td>
                    <?php echo $row['qty']; ?>
                </td>
                <td>
                    <?php echo $sumPro; ?>
                </td>
            </tr>

        <?php } ?>
    </tbody>
    <tfoot>
        <!-- <tr class="text-dark fw-bolder">
            <td colspan="3" class="text-center">ราคารวม</td>
            <td>
                <?php echo $total; ?>
            </td>
        </tr>
        <tr class="text-dark fw-bolder">
            <td colspan="3" class="text-center">ค่าจัดส่ง</td>
            <td>
                <?php echo $shipping; ?>
            </td>
        </tr> -->
        <tr class="table-active fw-bolder">
            <td colspan="3" class="text-center ">ราคาทั้งหมด</td>
            <td>
                <?php echo $total; ?>
            </td>
        </tr>
    </tfoot>
</table>

<div class="d-flex justify-content-evenly mt-3">
    <button class="btn btn-success" id="confirmOrder" data-id="<?php echo $idOrder; ?>">อนุมัติรายการ</button>
    <button class="btn btn-danger" id="cancelOrder" data-id="<?php echo $idOrder; ?>">ยกเลิกรายการ</button>
</div>