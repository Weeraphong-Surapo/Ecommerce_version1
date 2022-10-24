<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['username'] != 'admin') {
    echo '<script>window.location="../index.php"</script>';
}
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [ // lowercase letters only in font key
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ],
    'default_font' => 'sarabun'
]);

include "../function/connect.php";
include "swal.php";
include('function/head.php');
include "function/slide.php";
include "function/navbar.php";
$show_order = mysqli_query($con, "SELECT * FROM tb_order WHERE order_id = '$_GET[id]'");
$result = mysqli_query($con, "SELECT * FROM tb_user_delivery WHERE order_id = '$_GET[id]'");
$fetch = mysqli_fetch_array($result);

?>

<?php ob_start(); ?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">ออเดอร์ที่ต้องส่ง</h3>
            <div class="table-responsive table-hover" >
                <table class="text-center table " id="customers" style="width: 100%;" >
                    <tr class="bg-primary text-white">
                        <th style="border: 1px solid #ddd; padding: 8px; padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #04AA6D; color: white; font-size:20;">ชื่อสินค้า</th>
                        <th style="border: 1px solid #ddd; padding: 8px; padding-bottom: 12px; text-align: left; text-align: center; background-color: #04AA6D; color: white; font-size:20;">ราคา</th>
                        <th style="border: 1px solid #ddd; padding: 8px; padding-bottom: 12px; text-align: left; text-align: center; background-color: #04AA6D; color: white; font-size:20;">จำนวน</th>
                        <th style="border: 1px solid #ddd; padding: 8px; padding-bottom: 12px; text-align: left; text-align: center; background-color: #04AA6D; color: white; font-size:20;">ค่าจัดส่ง</th>
                    </tr>
                    <?php
                    $total = 0;
                    $delivery = 0;
                    foreach ($show_order as $row) {
                        $delivery += $row['delivery'];
                        $total += ($row['price'] * $row['qty']);
                    ?>
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center; font-size:18;"><?= $row['product']; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center; font-size:18;"><?= number_format($row['price']); ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center; font-size:18;"><?= $row['qty']; ?></td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center; font-size:18;"><?= $row['delivery']; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4" style="font-size:18; text-align:center">ค่าส่งรวม <?= $delivery; ?></td>
                    </tr>
                    <tr>
                        <?php $total_all = $total + $delivery; ?>
                        <td colspan="4" style="text-align:center;">
                            <h1 >ราคารวม <?= number_format($total_all); ?> บาท</h1>
                        </td>
                    </tr>
                </table>
            </div>
            <?php
            $html = ob_get_contents();
            $mpdf->WriteHTML($html);
            $mpdf->Output("MyReport.pdf");
            ob_end_flush();
            ?>
            <a href="order.php" class="btn btn-primary col-12 mb-2">กลับหน้าออเดอร์</a>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $fetch['order_id']; ?>">
                <input type="hidden" name="status" value="1">
                <input name="order_success" type="submit" class="<?= $fetch['status'] == "0" ? 'btn btn-warning col-12' : ''; ?>" value="<?php echo $fetch['status'] == "0" ? 'จัดส่งสินค้า' : ''; ?>" onclick="confirmdelivery(event)">
            </form>
            <a href="MyReport.pdf" target="_blank" class="btn btn-success col-12 mt-2">ออกใบเสร็จ</a>
        </div>
    </div>
</div>
<?php
if (isset($_POST['order_success'])) {
    $status = $_POST['status'];
    $id = $_POST['id'];
    $sql = "UPDATE tb_user_delivery SET status = $status WHERE order_id = $id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $_SESSION['success'] = "จัดส่งสินค้าเรียบร้อย";
        echo $use->Swal('success', 'จัดส่งเรียบร้อย', '', 'delivery.php');
    } else {
        echo "error";
    }
}
?>
<?php include('function/footer.php'); ?>