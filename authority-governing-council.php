<?php require "layout/head.php"; ?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php"; 
include "data/authorityData.php";
?>

<main id="main"> 
    <section class="breadcrumbs">
        <div class="container">
            <div class="row d-flex justify-content-md-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-12">
                            <ol>
                                <li><a href="index.php">Home</a></li>
                                <li>Governing Council</li>
                            </ol>
                            <h2>
                                <!-- Governing Council -->
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-page readableContent">
        <div class="container">
            <div class="row d-flex justify-content-md-center">
                <div class="col-md-10 px-5">
                    <h2>
                        The Governing council
                    </h2>
                </div>
                <div class="col-md-10 px-5 py-5 pt-4">
                    <ol type="1">
                        <?php
                            foreach ($members_list as $key => $value) {
                                echo "<li>";
                                    echo $value['name'];
                                    if ($value['name']) {
                                        echo ", ";
                                    }
                                    echo $value['position'];
                                echo "</li>";   
                            }
                        ?>
                    </ol>
                </div>    
            </div>
        </div>
    </section>

</main>
<!-- End #main -->
<?php require "layout/footer.php"; ?>
<script type="text/javascript">
    $( document ).ready(function() {

        
    });
</script>
</body>
</html>