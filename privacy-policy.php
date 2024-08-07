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
                                <li>Privacy</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-page readableContent">
        <div class="container">
            <div class="row d-flex justify-content-md-center">
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 forms">
                    <h3>Terms of Use</h3>
                    <p>
                        Goa State Research Foundation (GSRF) was established through Goa Act 8 of 2022 to promote Research at all levels. Hence, it provides various services, such as fellowships, workshops and training programmes, funding research proposals, etc., for the identified section of beneficiaries through various schemes and initiatives. It will also disseminate information on various schemes through this website.
                        Hence, users/applicants must provide accurate information in their applications. While GSRF is trying to provide information, users shall also be aware that rare technical glitches might not be considered a service deficiency.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="inner-page readableContent">
        <div class="container">
            <div class="row d-flex justify-content-md-center">
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 forms mb-5">
                    <h3>Privacy Policy</h3>
                    <p>
                        The GSRF collects personal as well as academic information of the users for the records as well as for the analysis of the data for providing better services and coming out with new schemes. Information is shared with the proposals as part of the reviewing process. The information is not shared with any private or commercial establishments.
                    </p>
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