<?php require "layout/head.php"; ?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php";
include "data/statisticsData.php";
?>
<main id="main"> 
    <section class="breadcrumbs">
        <div class="container">
            <div class="row d-flex justify-content-md-center">
                <div class="col-md-12 col-lg-12 col-xl-10">
                    <div class="row">
                        <div class="col-12">
                            <ol>
                                <li><a href="index.php">Home</a></li>
                                <li>statistics</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Data must be displayed in Desc Order Newest First -->
    <?php 
        foreach ($statisticsDataArr as $key => $detail) {
    ?>
    
        <section class="inner-page readableContent pb-0">
            <div class="container">
                <div class="row d-flex justify-content-md-center">
                    <div class="col-md-12 col-lg-12 col-xl-10">
                        <h3 class="mb-4"><?php echo $detail['title']?></h3>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-10">
                        <div class="row d-flex justify-content-md-center mb-0">
                            <?php 
                                foreach ($detail['data'] as $key => $value) {
                                echo '<div class="col-md-12 col-xl-'.$value['size'].' mb-md-5 forms">
                                        <h3 class="mb-4">'.$value['title'].'</h3>
                                        <img src="'.$value['url'].'" alt="" class="img_full_width"> 
                                        <p>'.$value['desc'].'</p>
                                    </div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php 
        }
    ?>

</main>
<!-- End #main -->
<?php require "layout/footer.php"; ?>
<script type="text/javascript">
    $( document ).ready(function() {

        
    });
</script>
</body>
</html>