<?php
$type = isset($_GET['vkflgf']) ? $_GET['vkflgf'] : '';
require "layout/head.php"; 
?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php"; 
?>

<main id="main">
    <?php if ($type=="broken"){ 
            $padding = "padding:160px 0 90px !important";
        } else {
            $padding = "padding:320px 0 230px!important";
        } 
    ?>
    <section class="inner-page" style="<?php echo $padding ?>">
        <div class="container">
            <div class="row d-flex justify-content-md-center">
                <div class="col-md-10 text-center">
                    <?php
                        if ($type=="broken") {
                            echo '<img style="height: 600px; width: fit-content;" src="assets/img/bg/image2.png" alt="">';
                        } else if ($type=="scm") {
                            echo '<h1>Schemes to be announced soon !!</h1>';
                        } else if ($type=="ers") {
                            echo '<h1>Events will be announced soon !!</h1>';
                        } else {
                            echo '<h1>To be announced soon !!</h1>';
                        }
                    ?>
                </div>    
            </div>
        </div>
    </section>

</main>
<!-- End #main -->
<?php require "layout/footer.php"; ?>
<script type="text/javascript">
</script>
</body>
</html>