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
    $sql = "SELECT * FROM tb_user_delivery";
    $query = mysqli_query($con, $sql);
?>
<br /><br />
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h3 align="center">ออเดอร์ที่จัดส่งแล้ว</h3>
            <br />
            <div class="table-responsive">
                <?= isset($_SESSION['success']) ? "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>" : "";
                    unset($_SESSION["success"]); ?>
                <table id="employee_data" class="table table-bordered table table-striped table-hover text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th style="text-align: center;">ลำดับ</th>
                            <th style="text-align: center;">ชื่อผู้สั่ง</th>
                            <th style="text-align: center;">ที่อยู่</th>
                            <th style="text-align: center;">เบอร์โทร</th>
                            <th style="text-align: center;">สินค้าที่สั่ง</th>
                            <th style="text-align: center;">สถานะ</th>
                        </tr>
                    </thead>
                    <?php
                        $i = 1;
                        $num_row = mysqli_num_rows($query);
                        if ($num_row > 0) {
                            foreach ($query as $row) {
                                if ($row['status'] == "1") {
                        ?>
                    <tr>
                        <td width="15%"><?= $i++; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['address']; ?></td>
                        <td><?= $row['tel']; ?></td>
                        <td>
                            <a class='btn btn-info' href="show_delivery.php?id=<?= $row['order_id']; ?>">ดูออเดอร์</a>
                        </td>
                        <td>
                            <button class="btn btn-success"><?= $row['status'] == "1" ? "จัดส่งแล้ว" : ''; ?></button>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <div id="contianer_modals"></div>
                </table>

                <?php } else { ?>
                <tr>
                    <td colspan="6">ไม่มีประวติการส่ง</td>
                </tr>
                </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

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

function loadAndShowModal($id) {
    var post = new Object();
    post.id = $id;

    $('#contianer_modals').load('modals.php', post, function() {
        $("#modal").modal('show');
    });
}
</script>
<?php require('function/footer.php'); ?>
<?php } ?>