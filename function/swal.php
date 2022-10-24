
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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