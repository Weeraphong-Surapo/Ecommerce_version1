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
    include "function/navbar.php"; ?>
    <div class="container mt-5">
        <div class="card text-center shadow-lg">
            <div class="card-body">
                <h1>การติดต่อ & รายงาน</h1>
                <div class="table-responsive">
                    <table id="employee_data" class="table table-bordered table table-striped table-hover text-center">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th style="text-align: center;">ลำดับ</th>
                                <th style="text-align: center;">ชื่อ</th>
                                <th style="text-align: center;">อีเมลล์</th>
                                <th style="text-align: center;">เบอร์โทร</th>
                                <th style="text-align: center;">การติดต่อ</th>
                            </tr>
                        </thead>
                        <?php
                        $contact = mysqli_query($con, "SELECT * FROM tb_contact");
                        foreach ($contact as $row) {
                        ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['contact_name']; ?></td>
                                <td><?= $row['contact_email']; ?></td>
                                <td><?= $row['contact_phone']; ?></td>
                                <td>
                                    <a href="show_contact.php?id=<?= $row['id']; ?>" class='btn btn-primary mb-4'>ดูข้อมูลติดต่อ</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <div id="contianer_modals"></div>
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

                function loadAndShowModal_contact($id) {
                    var post = new Object();
                    post.id = $id;

                    $('#contianer_modals').load('modals_contact.php', post, function() {
                        $("#modal").modal('show');
                    });
                }
            </script>
            <?php require('function/footer.php'); ?>
        </div>
    </div>
<?php } ?>