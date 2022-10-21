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
    $query = "SELECT * FROM tb_users WHERE lavel = 'user'";
    $result = mysqli_query($con, $query);
?>
<br /><br />
<div class="container">
    <div class="card p-4 shadow-lg mt-5">
        <h1 align="center">สมาชิกที่อยู่ในระบบ</h1>
        <br />
        <?= isset($_SESSION['success']) ? '<div class="alert alert-success">' . $_SESSION['success'] . '</div>' : '';
            unset($_SESSION['success']); ?>
        <div class="table-responsive">
            <table id="employee_data" class="table table-bordered table table-striped table-hover text-center">
                <thead class="bg-primary text-white">
                    <tr>
                        <th style="text-align: center;">ลำดับ</th>
                        <th style="text-align: center;">ชื่อผู้ใช้</th>
                        <th style="text-align: center;">อีเมลล์</th>
                    </tr>
                </thead>
                <?php
                    $i = 1;
                    while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                </tr>
                <?php
                    }
                    ?>
            </table>
        </div>
    </div>
</div>

</body>

</html>
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
<?php require('function/footer.php'); ?>
<?php } ?>