

<!-- sweet alert js & css -->
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">


<?php

class Libarys{

    function Swal($type, $title, $text, $link){
        ?>
            <script>
                setTimeout(function() {
                    swal({
                        type: "<?= $type ?>",
                        title: "<?= $title ?>", 
                        text: "<?= $text ?>", 
                        timer: 2000,
                        showConfirmButton: true 
                    }, function() {
                        window.location.href = "<?= $link ?>";
                    });
                });
            </script>
        <?php
    }


}

$use = new Libarys();
?>