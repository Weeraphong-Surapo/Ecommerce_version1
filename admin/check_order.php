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
    $sql = "SELECT * FROM tb_user_delivery";
    $query = mysqli_query($con, $sql);
?>
    <br /><br />
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h3 align="center">ตรวจสอบการชำระเงิน</h3>
                <br />
                <div class="table-responsive">
                    <table id="employee_data" class="table table-bordered table table-striped table-hover text-center">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th style="text-align: center;">ลำดับ</th>
                                <th style="text-align: center;">ชื่อผู้สั่ง</th>
                                <th style="text-align: center;">ที่อยู่</th>
                                <th style="text-align: center;">เบอร์โทร</th>
                                <th style="text-align: center;">ตรวจสอบชำระเงิน</th>
                                <th style="text-align: center;">สถานนะ</th>
                            </tr>
                        </thead>
                        <?php
                        $i = 1;
                        $num_row = mysqli_num_rows($query);
                        if ($num_row > 0) {
                            foreach ($query as $row) {
                                if ($row['status'] == "3") {
                        ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['address']; ?></td>
                                        <td><?= $row['tel']; ?></td>
                                        <td>
                                            <a class='btn btn-primary' href="show_check.php?id=<?= $row['order_id']; ?>">ดูการชำระเงิน</a>
                                        </td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="order_id" value="<?= $row['order_id']; ?>">
                                                <input name="cancel_order" type="submit" value="ยกเลิก" class="btn btn-danger" onclick="confirmdelivery(event)">
                                            </form>
                                        <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <div id="contianer_modals"></div>
                    </table>
                <?php } else { ?>
                    <tr>
                        <td colspan="6">ไม่มีออเดอร์</td>
                    </tr>
                    </table>
                <?php } ?>
                </div>
                <?php
                if (isset($_POST['cancel_order'])) {
                    $cancel_order = mysqli_query($con, "DELETE FROM tb_user_delivery WHERE order_id = '$_POST[order_id]'");
                    $del_order = mysqli_query($con, "DELETE FROM tb_order WHERE order_id = '$_POST[order_id]'");
                    echo $use->Swal('success', 'ลบเรียบร้อย', '', 'order.php');
                }
                ?>
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

        function loadAndShoworder($id) {
            var post = new Object();
            post.id = $id;

            $('#contianer_modals').load('modals_order.php', post, function() {
                $("#modal").modal('show');
            });
        }
    </script>
    <?php require('function/footer.php'); ?>
<?php } ?>