<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
} else {
    include "../function/connect.php";
    include('function/head.php');
    include "function/slide.php";
    include "function/navbar.php";
?>
<div class="container mt-5">
    <div class="card p-4 shadow-lg">
        <h1 class="text-center">ผู้ดูแลระบบ</h1>
        <br />
        <div>
            <div class="table-responsive">
                <?= isset($_SESSION['success']) ? "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>" : "";
                    unset($_SESSION["success"]); ?>
                <?= isset($_SESSION['delete']) ? "<div class='alert alert-success'>" . $_SESSION['delete'] . "</div>" : "";
                    unset($_SESSION["delete"]); ?>
                <a href="add_admin.php" class="btn btn-primary mb-3">เพิ่มผู้ดูแล</a>
                <table id="employee_data" class="table table-bordered table table-striped table-hover text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th style="text-align: center;">ลำดับ</th>
                            <th style="text-align: center;">ชื่อผู้ดูแล</th>
                            <th style="text-align: center;">อีเมลล์</th>
                            <th style="text-align: center;">สถานะ</th>
                            <th style="text-align: center;">จัดการ</th>
                        </tr>
                    </thead>
                    <?php
                        $i = 1;
                        $result = mysqli_query($con, "SELECT * FROM tb_users WHERE lavel = 'admin'");
                        while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['lavel']; ?></td>
                        <th>
                            <a href="admin.php?action=del&id=<?= $row['id']; ?>" class="btn btn-danger col-12"
                                onclick="confirmdelete(event)">ลบ</a>
                        </th>
                    </tr>
                    <?php
                        }
                        ?>
                </table>
            </div>
        </div>
        <?php
            if (isset($_GET['action']) && $_GET['action'] == 'del') {
                $del = mysqli_query($con, "DELETE FROM tb_user WHERE id = '$_GET[id]' AND lavel = 'admin'");
                if ($del) {
                    $_SESSION['delete'] = "ลบข้อมูลเรียบร้อย";
                    echo "<script>window.location='admin.php'</script>";
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
    </div>
</div>
<?php require('function/footer.php'); ?>
<?php } ?>