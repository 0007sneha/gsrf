<?php require "layout/head.php"; ?>
<body>
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php"; 
include "data/landingPageData.php";
include "data/eventsData.php";
include "data/notificationData.php";

$currentYear = date("Y");
$getCurYear = '2023';

function getArrayByYear($dataArray, $targetYear) {
    foreach ($dataArray as $item) {
        if ($item['year'] == $targetYear) {
            return $item; // Return the array if the year matches
        }
    }
    return null; // Return null if no matching year is found
} 
?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="events d-flex align-items-center">
    <div class="events-slider swiper" data-aos="fade-up" data-aos-delay="100" style="height: -webkit-fill-available;">
        <div class="swiper-wrapper">
            <?php 
                foreach ($carousel as $key => $value) {
                    echo '<div class="swiper-slide">
                            <div class="event-item">
                                <img src="'.$value['url'].'" class="img-fluid" loading="lazy" alt="Slide '.++$key.'">
                            </div>
                            <p>'.$value['title'].'</p>
                        </div>';
                }
            ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<main id="main"> 
    <section class="cards">
        <div class="container">
            <div class="row">
                <div class="col-md-3 border_right">
                    <a href="fellowship.php">
                        <div class="box">
                            <img class="" src="assets/img/icons/handshake.png" alt="">
                            <h4>Fellowship</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 border_right">
                    <a href="schemes.php">
                        <div class="box">
                            <img class="" src="assets/img/icons/list_alt.png" alt="">
                            <h4>Schemes</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 border_right">
                    <a href="to-be-updated.php">
                        <div class="box">
                            <img class="" src="assets/img/icons/military_tech.png" alt="">
                            <h4>Awards</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="grants.php">
                        <div class="box">
                            <img class="" src="assets/img/icons/volunteer_activism.png" alt="">
                            <h4>Grants</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="announcement">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="marquee">
                        <div class="marquee-content">
                            <?php 
                                foreach ($announcementRibbonArr as $key => $value) {
                                    echo "<h5>$value</h5>";
                                    if (count($announcementRibbonArr)-$key!=1)
                                        echo "&nbsp;&nbsp;&nbsp; || &nbsp;&nbsp;&nbsp; ";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        
    <section class="message">
        <div class="container">
            <div class="section-header">
                <h4 class="title">Chief Minister's Message</h4>          
            </div>
            <div class="row section-body box">
                <div class="col-md-12 col-lg-6 profile">
                    <div>
                        <img src="assets/img/cm.png" alt="CM">
                    </div>
                    <div class="img-card">
                        <p>Honourable Chief Minister and Education Minister</p>
                        <h5>Dr. Pramod Sawant</h5>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 content">
                    <p>
                        The Foundation shall function to inculcate, facilitate and promote a research culture in the State of Goa, and establish a state-of-the-art research infrastructure. 
                    </p>
                    <p>
                        This will help produce world-class researchers to achieve sustainable economic growth, enhance national security, promote well-being and societal progress, and elevate Goa’s position as a global leader in frontier areas of science, technology, humanities, social sciences, etc.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="faq">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h4 class="title">News and Announcements</h4>
            </div>
            <div class="row section-body justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12">
                    <div class="tab">
                        <button class="tablinks active" onclick="openNews(event, 'news')">News</button>
                        <button class="tablinks" onclick="openNews(event, 'circulars')">Circulars</button>
                        <button class="tablinks" onclick="openNews(event, 'notices')">Notices</button>
                        <button class="tablinks" onclick="openNews(event, 'tenders')">Tenders</button>
                    </div>

                    <div id="news" class="tabcontent">
                        <ul class="faq-list">
                            <?php
                            foreach ($newsDataArr as $key => $news) {
                                $sr_no = $key + 1;
                            ?>
                                <li>
                                    <span><?php echo $news['date'] ?></span>
                                    <div data-bs-toggle="collapse" href="#news_faq_<?php echo $sr_no; ?>" class="collapsed question">
                                        <?php echo $news['title'] ?>
                                        <i class="bi bi-plus icon-show"></i>
                                        <i class="bi bi-dash icon-close"></i>
                                    </div>
                                    <div id="news_faq_<?php echo $sr_no; ?>" class="collapse" data-bs-parent=".faq-list">
                                        <br>
                                        <?php if ($news['data_type'] == 'downloadable') {  ?>
                                            <table class="table">
                                                <tbody>
                                                    <?php
                                                    foreach ($news['data'] as $key2 => $value) {
                                                        echo '<tr>
                                                            <td width="10">'.++$key2.'</td>
                                                            <td>'.$value['name'].'</td>
                                                            <td width="120px"><a href="'.$value['url_type_1'].'" class="customLink" target="_blank"><i class="bi bi-download" style="font-size: large"></i> '.$value['fileName'].'</a></td>
                                                        </tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php } else if ($news['data_type'] == 'list') {  
                                                foreach ($news['data'] as $key3 => $value) {
                                                    echo '<p>'.$value['name'].'</p>';
                                                }
                                            } ?>
                                    </div>
                                </li>
                            <?php 
                            }
                            ?>
                        </ul>
                    </div>
                    <div id="circulars" class="tabcontent">
                        <ul class="faq-list">
                            <?php
                            foreach ($circularsDataArr as $key => $circulars) {
                                $sr_no = $key + 1;
                            ?>
                                <li>
                                    <span><?php echo $circulars['date'] ?></span>
                                    <div data-bs-toggle="collapse" href="#circulars_faq_<?php echo $sr_no; ?>" class="collapsed question">
                                        <?php echo $circulars['title'] ?>
                                        <i class="bi bi-plus icon-show"></i>
                                        <i class="bi bi-dash icon-close"></i>
                                    </div>
                                    <div id="circulars_faq_<?php echo $sr_no; ?>" class="collapse" data-bs-parent=".faq-list">
                                        <br>
                                        <?php if ($circulars['data_type'] == 'downloadable') {  ?>
                                            <table class="table">
                                                <tbody>
                                                    <?php
                                                    foreach ($circulars['data'] as $key2 => $value) {
                                                        echo '<tr>
                                                            <td width="10">'.++$key2.'</td>
                                                            <td>'.$value['name'].'</td>
                                                            <td width="120px"><a href="'.$value['url_type_1'].'" class="customLink" target="_blank"><i class="bi bi-download" style="font-size: large"></i> '.$value['fileName'].'</a></td>
                                                        </tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php } else if ($circulars['data_type'] == 'list') {  
                                                foreach ($circulars['data'] as $key3 => $value) {
                                                    echo '<p>'.$value['name'].'</p>';
                                                }
                                            } ?>
                                    </div>
                                </li>
                            <?php 
                            }
                            ?>
                        </ul>
                    </div>
                    <div id="notices" class="tabcontent">
                        <ul class="faq-list">
                            <?php
                            foreach ($noticeDataArr as $key => $notice) {
                            $sr_no = $key + 1;
                            ?>
                                <li>
                                    <span><?php echo $notice['date'] ?></span>
                                    <div data-bs-toggle="collapse" href="#notices_faq_<?php echo $sr_no; ?>" class="collapsed question">
                                        <?php echo $notice['title'] ?>
                                        <i class="bi bi-plus icon-show"></i>
                                        <i class="bi bi-dash icon-close"></i>
                                    </div>
                                    <div id="notices_faq_<?php echo $sr_no; ?>" class="collapse" data-bs-parent=".faq-list">
                                        <br>
                                        <table class="table">
                                            <tbody>
                                                <?php
                                                foreach ($notice['data'] as $key2 => $value) {
                                                    echo '<tr>
                                                        <td width="10">'.++$key2.'</td>
                                                        <td>'.$value['name'].'</td>
                                                        <td width="120px"><a href="'.$value['url_type_1'].'" class="customLink" target="_blank"><i class="bi bi-download" style="font-size: large"></i> '.$value['fileName'].'</a></td>
                                                    </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            <?php 
                            }
                            ?>
                        </ul>
                    </div>
                    <div id="tenders" class="tabcontent">
                        <ul class="faq-list">
                            <?php
                            foreach ($tendersDataArr as $key => $tenders) {
                                $sr_no = $key + 1;
                            ?>
                                <li>
                                    <span><?php echo $tenders['date'] ?></span>
                                    <div data-bs-toggle="collapse" href="#tenders_faq_<?php echo $sr_no; ?>" class="collapsed question">
                                        <?php echo $tenders['title'] ?>
                                        <i class="bi bi-plus icon-show"></i>
                                        <i class="bi bi-dash icon-close"></i>
                                    </div>
                                    <div id="tenders_faq_<?php echo $sr_no; ?>" class="collapse" data-bs-parent=".faq-list">
                                        <br>
                                        <?php if ($tenders['data_type'] == 'downloadable') {  ?>
                                            <table class="table">
                                                <tbody>
                                                    <?php
                                                    foreach ($tenders['data'] as $key2 => $value) {
                                                        echo '<tr>
                                                            <td width="10">'.++$key2.'</td>
                                                            <td>'.$value['name'].'</td>
                                                            <td width="120px"><a href="'.$value['url_type_1'].'" class="customLink" target="_blank"><i class="bi bi-download" style="font-size: large"></i> '.$value['fileName'].'</a></td>
                                                        </tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php } else if ($tenders['data_type'] == 'list') {  
                                                foreach ($tenders['data'] as $key3 => $value) {
                                                    echo '<p>'.$value['name'].'</p>';
                                                }
                                            } ?>
                                    </div>
                                </li>
                            <?php 
                            }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="gallery">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h4 class="title">Event Gallery</h4>
            </div>
            <div class="row section-body justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12">
                    <div class="tab">
                        <?php foreach ($eventGalleryYearlyArr as $key => $value) { 
                                $isClassActive = '';
                                if ($value == $currentYear) {
                                    $isClassActive = 'active';
                                    $getCurYear = $value;
                                }
                        ?>
                                    <button class="tablinksGallery <?php echo $isClassActive ?>" onclick="openGallery(event, '<?php echo $value ?>')"><?php echo $value ?></button>
                        <?php } ?>
                    </div>
                    
                    <?php 
                        foreach ($eventGalleryYearlyArr as $key => $getDataForTheYear) { 
                    ?>
                            <div id="<?php echo $getDataForTheYear ?>" class="tabcontentGallery">
                                <div class="gallery-slider swiper" data-aos="fade-up" data-aos-delay="100">
                                    <div class="swiper-wrapper">
                                        <?php
                                            $foundArray = getArrayByYear($eventGalleryArr, $getDataForTheYear);

                                            if ($foundArray !== null) {
                                                foreach ($foundArray['data'] as $key => $value) {
                                                    echo '<div class="swiper-slide">
                                                        <div class="item_card testimonial-item">
                                                            <img src="'.$value['cover_img'].'" class="card-img-top" alt="...">
                                                            <div class="card_body">
                                                                <h5 class="card-title">'.$value['short_title'].'</h5>
                                                                <p class="card-text">'.$value['short_content'].'</p>
                                                                <a href="'.$value['url'].'" class="btn">View more</a>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                }
                                            } else {
                                                // echo "No array found with year $getDataForTheYear";
                                            }
                                        ?>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                    <?php 
                        } 
                    ?>
                </div>
            </div>
            <img class="bgImg left" src="assets/img/bg/group3.png" alt="">
            <img class="bgImg right" src="assets/img/bg/group4.png" alt="">
        </div>
    </section>
</main>
<!-- End #main -->
<?php require "layout/footer.php"; ?>
<script>
    $(document).ready(function() {
        document.getElementById('news').style.display = "block";
        $("#news.tabcontent").addClass(" active");
        
        let getCurYear = '<?php echo $getCurYear?>';
        document.getElementById(getCurYear).style.display = "block";
        $("#"+getCurYear+".tabcontentGallery").addClass(" active");
    });

    function openNews(evt, tabId) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabId).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function openGallery(evt, tabId) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontentGallery");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinksGallery");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabId).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
</body>
</html>