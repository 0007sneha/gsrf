<?php require "layout/head.php"; ?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php";
include "data/eventsData.php";
?>
<main id="main" style="color: black"> 
    <section class="breadcrumbs">
        <div class="container">
            <div class="row d-flex justify-content-md-center">
                <div class="col-md-12 col-lg-12 col-xl-10">
                    <div class="row">
                        <div class="col-12">
                            <ol>
                                <li><a href="index.php">Home</a></li>
                                <li>Events Completed</li>
                            </ol>
                            <h2>
                                List of Completed Events
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        foreach ($eventGalleryArr as $key => $yearlyData) {
            foreach ($yearlyData['data'] as $key => $value) {
    ?>
                <section class="inner-page readableContent">
                    <div class="container">
                        <div class="row d-flex justify-content-md-center">
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 forms">
                                <?php 
                                    echo '
                                        <h2 class="mb-4">'.$value['short_title'].'</h2>
                                        <p class="mt-4">'.$value['date'].'</p>
                                        <hr >
                                        <p class="mt-4">'.$value['content'].'</p>
                                    ';
                                ?>
                                <a href="<?php echo $value['url'] ?>" class="btn">View more</a>
                            </div>
                        </div>
                    </div>
                </section>
    <?php 
            }
        }
    ?>
<!-- code removed 
<div class="row mb-4">
    <?php
        // foreach ($value['images'] as $key => $img_url) {
        //     echo '
        //         <div class="col-md-4">
        //             <img src="'.$img_url.'" alt="" class="img_full_width img_fit">
        //         </div>'
        //     ;
        //     if ($key>1) {
        //         break;
        //     }
        // }
    ?>
</div> -->

</main>
<!-- End #main -->
<?php require "layout/footer.php"; ?>
<script type="text/javascript">
    $( document ).ready(function() {

        
    });
</script>
</body>
</html>