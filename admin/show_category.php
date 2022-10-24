<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
} else {
    include "../function/connect.php";
    include "swal.php";
    include('function/head.php');
    include "function/slide.php";
    include "function/navbar.php";
    $query = "SELECT * FROM tb_shop";
    $result = mysqli_query($con, $query);
?>
<div class="container mt-4 text-center">
    <div class="card shadow-lg p-3">
        <div class="card-body">
            <h3 align="center">ประเภทสินค้าทั้งหมด</h3>
            <div class="table-responsive">
                <?= isset($_SESSION['success']) ? "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>" : "";
                    unset($_SESSION["success"]); ?>
                <table id="employee_data" class="table table-bordered table table-striped table-hover text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th style="text-align:center;">ลำดับ</th>
                            <th style="text-align:center;">ชื่อประเภท</th>
                            <th style="text-align:center;">จัดการ</th>
                        </tr>
                    </thead>
                    <?php
                        $i = 1;
                        $category = mysqli_query($con, "SELECT * FROM tb_category");
                        while ($row = mysqli_fetch_array($category)) {
                        ?>
                    <tr>
                        <td width="5%"><?= $i++; ?></td>
                        <td><?= $row['category_name']; ?></td>
                        <td width="15%">
                            <div class="btn-group" style="width:100%">
                                <a href="edit_category.php?action=edit&id=<?= $row['id']; ?>"
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

</body>

</html>
<?php
    if (isset($_GET['action']) && $_GET['action'] == "del") {
        $result = mysqli_query($con, "DELETE FROM tb_category WHERE id = '$_GET[id]'");
        if ($result) {
            $_SESSION['success'] = "";
            echo $use->Swal('success','ลบประเภทสินค้าเรียบร้อย','','show_category.php');
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
            "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
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
<?php include('function/footer.php'); ?>
<?php } ?>