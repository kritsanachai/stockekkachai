$(document).ready(function () {
  $(document).on("click", "#InsertProduct", function () {
    Swal.fire({
      title: "เพิ่มสินค้า",
      showConfirmButton: false,
      html:
        '<input type="text" class="form-control my-4" id="name" placeholder="ชื่อสินค้า" required>' +
        '<input type="text" class="form-control my-4" id="detail" placeholder="รายละเอียด" required>' +
        '<input type="text" class="form-control my-4" id="price" placeholder="ราคา" required>' +
        '<input type="file" accept="image/png, image/jpg, image/jpeg" class="form-control my-4" id="img" required>' +
        '<button class="btn btn-warning form-control my-4" id="submitProduct">ยืนยัน</button>',
    });
  });

  $(document).on("click", "#submitProduct", function () {
    // alert('hi');
    var name = $("#name").val();
    var detail = $("#detail").val();
    var price = $("#price").val();
    var img = $('#img')[0].files[0];
    // console.log(name);
    // console.log(img);
    var formdata = new FormData();
    formdata.append("name", name);
    formdata.append("detail", detail);
    formdata.append("price", price);
    formdata.append("img", img);

    $.ajax({
      url: ".././backend/insert_product.php",
      type: "POST",
      data: formdata,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (data) {
        console.log(data)
        // if (data == 1) {
        //   Swal.fire({
        //     title: "เสร็จสิ้น",
        //     showConfirmButton: false,
        //     icon: "success",
        //     timer: 800,
        //   }).then((result) => {
        //     window.location.reload();
        //   });
        // } else {
        //   Swal.fire({
        //     title: "เกิดข้อผิดพลาด",
        //     showConfirmButton: false,
        //     icon: "error",
        //     timer: 800,
        //   });
        // }
      },
    });
  });
  //end submit product


  
});
