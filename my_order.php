<?php
if (!isset($_SESSION)) {
    session_start();
}
include "swal.php";
if (!isset($_SESSION['login'])) {
    echo $use->Swal('warning','กรุณา login ก่อน','','login.php');
} else {
    include "function/connect.php";
    include "function/header.php";
?>
<div class="container mt-4">
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="index.php" class="link">หน้าหลัก</a></li>
            <li class="item-link"><span>ประวัติสั่งซื้อ</span></li>
        </ul>
    </div>
    <div class=" card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="text-align: center;">ที่อยู่</th>
                    <th style="text-align: center;">สินค้าที่สั่ง</th>
                    <th style="text-align: center;">สถานะ</th>
                </tr>
                <?php
                    $i = 1;
                    $user_id = $_SESSION['user_id'];
                    $sql = "SELECT * FROM `tb_user_delivery` WHERE user_id = $user_id";
                    $result = mysqli_query($con, $sql);
                    if (mysqli_num_rows($result) >= 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                <tr>
                    <td class="align-middle text-center">
                        <?= "ชื่อ : " . $row['name'] . "<br>" ?>
                        <?= "เบอร์โทร : " . $row['tel'] . "<br>" ?>
                        <?= "ทีอยู่ : " . $row['address'] . "<br>" ?>
                        <?= "สั่งซื้อ : " . $row['by_date'] . "<br>" ?>
                    </td>

                    <td width="20%">
                        <table class="table table-bordered">
                            <tr class="align-middle text-center">
                                <th>ชื่อสินค้า</th>
                                <th>ราคา</th>
                                <th>จำนวน</th>
                            </tr>
                            <?php
                                        $lave = "SELECT * FROM worktime WHERE profileId = '' AND warning = 'leave'";
                                        $order_query = "SELECT * FROM `tb_order` WHERE order_id = '$row[order_id]'";
                                        $order_result = mysqli_query($con, $order_query);
                                        while ($order_fetch = mysqli_fetch_assoc($order_result)) {
                                        ?>
                            <tr class="align-middle text-center">
                                <td><?= $order_fetch['product']; ?></td>
                                <td><?= $order_fetch['price']; ?></td>
                                <td><?= $order_fetch['qty']; ?></td>
                                <?php } ?>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <div class="text-center 
                            <?php if($row['status'] == '0'or $row['status'] == '3'){
                                echo "alert alert-warning";
                            }else{
                                echo "alert alert-success";
                            } ?>">
                            <?php if($row['status'] == '0' OR $row['status'] == '3'){
                                echo "รอดำเนินการ";
                            }else{
                                echo "ระหว่างจัดส่ง";
                            } ?>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="order_id" value="<?= $row['order_id']; ?>">
                            <button type="submit" name="cancel_order" class="btn btn-danger col-12" onclick="confirmdelorder(event)">ยกเลิก</button>
                        </form>
                        <?php } ?>
                    </td>
                </tr>
            </table>
            <?php
                        if (isset($_POST['cancel_order'])) {
                            $check_status = mysqli_query($con, "SELECT * FROM tb_user_delivery WHERE order_id = '$_POST[order_id]'");
                            $fetch_status = mysqli_fetch_array($check_status);
                            if ($fetch_status['status'] != 0) {
                                echo $use->Swal('warning','ยกเลิกไม่ใด้เนื่องจากกำลังจัดส่ง','','my_order.php');
                            } else {
                                $cancel_order = mysqli_query($con, "DELETE FROM tb_user_delivery WHERE order_id = '$_POST[order_id]'");
                                $del_order = mysqli_query($con, "DELETE FROM tb_order WHERE order_id = '$_POST[order_id]'");
                                echo $use->Swal('success','ยกเลิกออเดอร์เรียบร้อย','','my_order.php');
                            }
                        }
                ?>
            <?php } else { ?>
            <tr>
                <td colspan="5" class="text-center">ไม่มีออเดอร์</td>
            </tr>
            </table>
            <?php } ?>
        </div>
    </div>
</div>
<?php include "function/footer.php"; ?>
<?php } ?>