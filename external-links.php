<?php require "layout/head.php"; ?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php";
include "data/externalLinkData.php";
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
                                <li>External Links</li>
                            </ol>
                            <h2>
                                Links to external funding agencies and other facilities
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
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10">
                    <div class="row">
                        <?php 
                            foreach ($externalLinksArr as $key => $value) {
                                if ($key==0) {
                                    
                                } else {
                                    echo '<div class="col-md-6 col-lg-4 mb-4">
                                            <div class="inner-card single">
                                                <a href="'.$value['url'].'" target="_blank " >
                                                    '. $value['name'].'
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                        <path d="M5 3C3.90694 3 3 3.90694 3 5V19C3 20.0931 3.90694 21 5 21H19C20.0931 21 21 20.0931 21 19V12H19V19H5V5H12V3H5ZM14 3V5H17.5859L8.29297 14.293L9.70703 15.707L19 6.41406V10H21V3H14Z" fill="#0A6EBD"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>';
                                }
                            }

                            echo '
                                <div class="col-md-12 mb-4">
                                    <div class="inner-card links">
                                        <h5>'. $externalLinksArr[0]['name'].'</h5>';
                                        foreach ($externalLinksArr[0]['data'] as $key => $link) {
                                            echo '
                                            <a href="'.$link['url'].'" target="_blank">
                                                <span>'.$link['name'].'</span>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                        <path d="M5 3C3.90694 3 3 3.90694 3 5V19C3 20.0931 3.90694 21 5 21H19C20.0931 21 21 20.0931 21 19V12H19V19H5V5H12V3H5ZM14 3V5H17.5859L8.29297 14.293L9.70703 15.707L19 6.41406V10H21V3H14Z" fill="#0A6EBD"/>
                                                    </svg>
                                                </span> 
                                            </a>';
                                            if (count($externalLinksArr[0]['data'])-$key == 1 ) {
                                            } else {
                                                echo '<hr>';
                                            }
                                        }
                                echo '</div>
                                </div>
                            ';

                        ?>
                    </div>
                
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