<?php include "connect.php";?>
<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
    <div class="widget mercado-widget categories-widget">
        <h2 class="widget-title">ประเภทสินค้า</h2>
        <div class="widget-content">
            <ul class="list-category">
                <?php
                $sql = "SELECT * FROM tb_category";
                $result = mysqli_query($con, $sql);
                foreach ($result as $data) {
                ?>
                <li class="category-item has-child-cate">
                    <a href="category_show.php?category_id=<?= $data['id']; ?>"
                        class="cate-link"><?= $data['category_name'] ?></a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>