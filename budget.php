<?php require "layout/head.php"; ?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php";
include "data/budgetData.php";
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
                                <li>Budget</li>
                            </ol>
                            <h2>
                                Budgets
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        foreach ($budgetArr as $key => $yearlyData) {
    ?>
        <section class="inner-page readableContent">
            <div class="container">
                <div class="row d-flex justify-content-md-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 forms mb-5">
                        <h3><?php echo $yearlyData['title'] ?></h3>
                        <table class="table table-border text-center mt-5">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Budget Head</th>
                                    <th>Amount (Rs. in Lakhs)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($yearlyData['data'] as $key => $value) {
                                        $style = "";
                                        if ($key==2) {
                                            $style = "fw6";
                                        }
                                        echo '<tr>
                                            <td>';
                                                if ($key<2) {
                                                    echo ++$key;
                                                }
                                            echo '</td>
                                            <td class="text_left '.$style.'">'.$value['name'].'</td>
                                            <td class="'.$style.'">'.$value['amount'].'</td>
                                        </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

</main>
<!-- End #main -->
<?php require "layout/footer.php"; ?>
<script type="text/javascript">
</script>
</body>
</html>