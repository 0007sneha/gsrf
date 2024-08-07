<?php require "layout/head.php"; ?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php";
include "data/notificationData.php";
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
                                <li>Downloads</li>
                                <li>Notification</li>
                            </ol>
                            <h2>
                                Schemes
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
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 forms mb-5">
                    <table class="table table-borderless">
                        <tbody>
                            <?php
                                foreach ($newsDataArr as $key1 => $news_data) {
                                    if ($news_data['show_in_downloads_page'] == true) {
                                        echo '<tr><td colspan="4"><h5>'.$news_data['name'].'</h5></td></tr>';

                                        foreach ($news_data['data'] as $key2 => $value) {
                                            if ($news_data['data_type'] == 'downloadable') {
                                                echo '<tr>
                                                    <td>'.++$key2.'</td>
                                                    <td>'.$value['name'].'</td>
                                                    <td><a href="'.$value['url_type_1'].'" class="customLink" target="_blank"><i class="bi bi-download"></i> '.$value['fileName'].''.$news_data['file_format_1'].'</a></td>
                                                </tr>';
                                            } else if ($news_data['data_type'] == 'list') {  
                                                echo '<tr><td colspan="3">'.$value['name'].'</td></tr>';
                                            }
                                        }
                                        if (COUNT($newsDataArr)>$key1+1) {
                                            echo '<tr><td colspan="3"></td></tr><tr><td colspan="3"></td></tr><tr><td colspan="3"></td></tr>';
                                        }
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
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