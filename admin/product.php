<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
} else {
    include "function/head.php";
    include "function/slide.php";
    include "function/navbar.php";
    include "../function/connect.php";
    $query = "SELECT * FROM tb_shop";
    $result = mysqli_query($con, $query);
?>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h3 align="center">สินค้าทั้งหมด</h3>
            <div>
                <div class="table-responsive">
                    <?= isset($_SESSION['success']) ? "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>" : "";
                        unset($_SESSION["success"]); ?>
                    <table id="employee_data" class="table table-bordered table table-striped table-hover text-center">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th style="text-align: center;">รหัส</th>
                                <th style="text-align: center;">รูปภาพ</th>
                                <th style="text-align: center;">ชื่อสินค้า</th>
                                <th style="text-align: center;">รายละเอียด</th>
                                <th style="text-align: center;">ประเภท</th>
                                <th style="text-align: center;">ราคา</th>
                                <th style="text-align: center;">จำนวน</th>
                                <th style="text-align: center;">ค่าส่ง</th>
                                <th style="text-align: center;">จัดการ</th>
                            </tr>
                        </thead>
                        <?php
                            $category = mysqli_query(
                                $con,
                                "SELECT tb_category.category_name
            FROM tb_shop
            LEFT JOIN tb_category
            ON tb_shop.category = tb_category.id"
                            );
                            $i = 1;
                            while ($row = mysqli_fetch_array($result)) {
                                $result_category = mysqli_fetch_array($category);
                            ?>
                        <tr>
                            <td><?= $i++;; ?></td>
                            <td><img src="../<?= $row['img']; ?>" width="150px" height="120px"></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= strlen($row['description']) < 20 ? $row['description']: mb_substr($row['description'], 0, 20).'...'; ?>
                            </td>
                            <td><?= $result_category['category_name']; ?></td>
                            <td><?= $row['price']; ?></td>
                            <td><?= $row['count']; ?></td>
                            <td><?= $row['delivery']; ?></td>
                            <td width="12%">
                                <div class="btn-group" style="width:100%">
                                    <a href="edit.php?action=edit&id=<?= $row['id']; ?>&category=<?= $row['category']; ?>"
                                        class="btn btn-warning">แก้ไข</a>
                                    <a href="?action=del&id=<?= $row['id'] ?>" class="btn btn-danger"
                                        onclick="confirmdelete(event)">ลบ</a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
<?php
    if (isset($_GET['action']) && $_GET['action'] == "del") {
        $result = mysqli_query($con, "DELETE FROM tb_shop WHERE id = '$_GET[id]'");
        if ($result) {
            $_SESSION['success'] = "ลบสินค้าเรียบร้อย";
            echo '<script>window.location="product.php"</script>';
        }
    }
    ?>
<script>
$(document).ready(function() {
    $('#employee_data').DataTable({
        "oLanguage": {
            "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
            "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
            "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
            "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
            "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด MAX เร็คคอร์ด)",
            "sSearch": "ค้นหา :",
            "aaSorting": [
                [0, 'desc']
            ],
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "หน้าสุดท้าย"
            },
        }
    });
});
</script>
<?php require('function/footer.php'); ?>
<?php } ?>