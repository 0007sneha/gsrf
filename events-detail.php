<?php require "layout/head.php"; ?>
<body class="t2">
<?php 
require "layout/top-bar.php"; 
require "layout/header-nav-bar.php";
include "data/eventsData.php";
include "data/eventsDetailData.php";

$eventKey = $_GET["rsdtype"];
$year = $_GET["yr"];
$resultImages = [];
$coverImages = '';
$title = '';
$date = '';
$content = '';
$isComplexContent = false;
 // Loop through the array to find the item with the matching key
foreach ($eventGalleryArr as $key => $dataYear) {
    if ($dataYear['year']==$year) {
        foreach ($dataYear['data'] as $key => $value) {
            if ($eventKey === $value['key']) {
                $title = $value['title'];
                $date = $value['date'];
                $resultImages = $value['images'];
                $coverImages = $value['cover_img'];
                $content = $value['content'];
                $isComplexContent = $value['isComplexContent'];
                break; // Break the loop once a match is found
            }
        }
    }
}
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
                                <li><a href="events-completed.php">Events Completed</a></li>
                                <li>Report</li>
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
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 forms mb-5">
                    <a href="<?php echo $coverImages ?>" data-lightbox="image-set" target="_blank" title="View Image">
                        <img src="<?php echo $coverImages ?>" alt="event report" class="img_full_width cover_image">
                    </a>
                    <h2 class="mt-5"> <?php echo $title ?> </h2>
                    <p> <?php echo $date ?> </p>
                    <h3 class="mt-4 mb-3">Introduction</h3>

                    <?php if ($eventKey=="") { ?>
                    <?php } else if (in_array($eventKey, $eventKeyArrayList)) { ?>
                        <p>
                            <?php echo $content; ?>
                        </p>
                    <!-- Template start -->
                    <!-- Content & images -->
                    <?php //} else if ($eventKey=="") { ?>
                    <!-- <p>
                            <?php // echo $content; ?>
                        </p>
                    -->
                    <!-- Template end -->
                    <?php } else if ($eventKey=="f9ilogsrfWsl") { ?>
                        <p>
                            GSRF inaugurated its website at the distinguished hands of Shri Prasad Lolayekar, 
                            IAS, Secretary of Education. Prof. M. K. Janarthanam, Chairman - GSRF, in his welcome 
                            address highlighted the progress of GSRF, which included visits to Colleges / Goa 
                            University for stakeholder discussions; conduct of College FDP on UG Third Year 
                            Project guiding; organization of Workshop for Faculty on Research Grant Writing; 
                            and visits to Government Departments. 
                        </p>
                        <p>
                            Chief Guest Shri Prasad Lolayekar, Secretary of Education, commended the GSRF for its significant 
                            growth and contribution in a short period since its establishment. He highlighted the importance 
                            of teamwork and collaboration as essential for success, as evidenced by the progress of GSRF. 
                            He affirmed the critical role that the Foundation could play in present times where rankings 
                            and ratings of educational institutions were increasingly gaining importance across the country. 
                        </p>
                        <p>
                            One of the main highlights of the website launch was the formal opening of 03 (out of the 06) 
                            notified schemes of GSRF for financial assistance, namely: 
                        </p>
                        <ol type="I">
                            <li> <p>Doctoral Research Fellowships, </p></li>
                            <li> <p>Start-up Grants, and </p></li>
                            <li> <p>Minor Research Projects. </p></li>
                        </ol>
                        <p>
                            Managing Director - GSRF, Prof. Savio P. Falleiro, proposed the Vote of Thanks; Assistant Prof. Jayada Parab compered the programme, which was livestreamed on YouTube. 
                        </p>

                    <?php } else if ($eventKey=="ydfrgww") { ?>
                        <p>
                            The <strong>Goa State Higher Education Council (GSHEC),</strong> in collaboration with the Goa State Research Foundation (GSRF) 
                            and the Directorate of Higher Education (DHE), recently concluded a highly successful six-day workshop on "Research Grant Writing." 
                            This workshop, held from <strong>September 5th to 12th, 2023</strong>, at the Directorate of Higher Education in Porvorim, Goa, aimed to equip faculty 
                            members from various HEIs in Goa (including Goa University, Engineering, Dental and Ayurveda Colleges), with the essential skills 
                            required to write compelling research grant proposals.
                        </p>
                        <p>
                            The workshop featured a meticulously planned agenda, with daily discipline-wise sessions catering to the diverse interests of the faculty members. A total of 
                            <strong>220 participants representing 45 subject specializations </strong> were actively engaged in the workshop. Notably, the highest participation came 
                            from the fields of dentistry and chemistry, with 29 faculty members from dentistry and 27 from chemistry.
                        </p>
                        <p>
                            The workshop was enriched by the presence of 15 experts from renowned institutions across India, including 
                        </p>
                        <ul>
                            <li><p>IITs, </p></li>
                            <li><p>BITS, </p></li>
                            <li><p>CSIR-NIO, </p></li>
                            <li><p>Agharkar Research Institute, </p></li>
                            <li><p>Goa Institute of Management, and </p></li>
                            <li><p>KLE Dental College. </p></li>
                        </ul> 
                        <p>
                            Prof. Shalini Upadhyay (Literature), Dr. Sabiha Hashami (Linguistic), Dr Arfat Ahmad Sofi (Economics), 
                            Dr. Solano Jose Savio Da Silva (Social Sciences), Prof Chinmay Behara (Commerce & Financial Services), 
                            Prof Anubhav Mishra (Marketing and Management), Prof Sujit Kumar Sahoo (Engineering and Mathematics), 
                            Dr Mahadev Gawas (Computer Sciences), Prof Amrita Chatterjee (Chemistry, Pharmacy, Physics), Prof Sumit Biswas (Microbiology and Biotechnology), 
                            Dr Rajeev Saraswat (Geology and Geography), Prof Surendra Ghaskadbi (Developmental Biologist), Dr Punnya Angadi Rao (Dentistry, 
                            Nursing and Ayurveda) served as resource person. 
                        </p>
                        <p>
                            Prof Vithal Tilvi, Prof M. K. Janarthanam and Dr Mahesh Majik from GSHEC co-ordinated this event and also conducted sessions on “Do and Don’ts in Grant Writing”.
                        </p>
                        <p>
                            This workshop not only provided invaluable knowledge but also fostered a sense of collaboration and 
                            inspiration among Goa's academic community. It is expected to result in a surge of high-quality research 
                            proposals that will contribute to the advancement of knowledge and the development of Goa's academic landscape.
                        </p>

                    
                    <?php } else if ($eventKey=="hrtfdp") { ?>
                        <p>
                            Goa State Research Foundation in collaboration with Goa State Higher Education
                            Council has conducted Stakeholders Meetings in several Higher Education Institutes in Goa. As a
                            feedback, faculty members without Ph.D. have requested for hands on training in Research methods
                            to guide TY projects effectively. Hence, One-Day Faculty Development Programme (FDP) on
                            “Enhancing Final Year Student Projects” for non-PhD Regular faculty of Higher Education Institutes in
                            Goa was conducted in several batches from 8th to 16th June, 2023.
                        </p>
                        <p>
                            FDP was held at Block-B Seminar Hall and BG-3 classroom, Goa University, Taleigao-Goa. The
                            workshop aimed to provide participants with valuable knowledge and practical skills in enhancing
                            final year student projects. The event was organized by the Directorate of Higher Education in
                            collaboration with Goa State Higher Education Council (GSHEC), Goa State Research Foundation
                            (GSRF) and Goa University. It attracted 430 participants from various disciplines & institutions. This
                            report provides a comprehensive overview of the workshop, including its objectives, agenda, key
                            highlights, and feedback.
                        </p>
                        <div class="row mb-0">
                            <!-- 
                                <h3 class="mt-4 mb-3">Objectives</h3>
                                <ul>
                                    <li> <p>To introduce participants, the fundamental concepts and principles of enhancing final year student’s projects.</p></li>
                                    <li> <p>To provide hands-on training and practical exercises to enhance participant’s skills in selecting research topics.</p></li>
                                    <li> <p>To facilitate networking and knowledge-sharing among participants.</p></li>
                                    <li> <p>To inspire participants to apply the acquired knowledge and skills in their respective fields.</p></li>
                                </ul>
                                <div class="col-md-12">
                                    <h3 class="mt-4 mb-3">Key Highlights</h3>
                                    <ul>
                                        <li>
                                            <strong>Engaging Presentations:</strong> 
                                            <p>
                                                The workshop sessions were delivered by knowledgeable and experienced
                                                facilitators who employed interactive techniques to engage the participants effectively.
                                            </p>
                                        </li>
                                        <li>
                                            <strong>Practical Exercises:</strong> 
                                            <p>
                                                The hands-on training and practical exercises enabled participants to apply their
                                                learning in a simulated environment, enhancing their understanding and skill development.
                                            </p>
                                        </li>
                                        <li>
                                            <strong>Expert Speaker:</strong> 
                                            <p>
                                                The keynote presentation by the guest speakers added significant value, offering
                                                participants unique insights and perspectives from seasoned professionals in the field.
                                            </p>
                                        </li>
                                        <li>
                                            <strong>Networking Opportunities:</strong> 
                                            <p>
                                                Participants had ample opportunities to network and interact with peers
                                                and experts fostering collaboration and knowledge-sharing.
                                            </p>
                                        </li>
                                        <li>
                                            <strong>Interactive Sessions:</strong> 
                                            <p>
                                                The interactive nature of the sessions kept participants engaged and facilitated
                                                active learning.
                                            </p>
                                        </li>
                                        <li>
                                            <strong>Practical Focus:</strong> 
                                            <p>
                                                Participants appreciated the emphasis on practical exercises.
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Day & Date</th>
                                                <th>Disciplines</th>
                                                <th>No. of Participants</th>
                                                <th>Resource Person</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th rowspan="3">
                                                    Day 1 <br>
                                                    8th June 2023
                                                </th>
                                                <td>Computer Science</td>
                                                <td>31</td>
                                                <td rowspan="3">
                                                    1. Prof. Vithal Tilvi <br>
                                                    2. Prof. Sharad Sinha <br>
                                                    3. Prof. Niyan Marchon
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mathematics</td>
                                                <td>28</td>
                                            </tr>
                                            <tr>
                                                <td>Electronics</td>
                                                <td>4</td>
                                            </tr>
                                            <tr>
                                                <th rowspan="7">
                                                    Day 2 <br>
                                                    9th June 2023
                                                </th>
                                                <td> English</td>
                                                <td>22</td>
                                                <td rowspan="7">
                                                    1. Prof. M.K Janarthanam <br>
                                                    2. Prof. K. A. Geetha <br>
                                                    3. Prof. Niyan Marchon <br>
                                                    4. Prof. Vithal Tilvi 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Fine Arts</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>Hindi</td>
                                                <td>8</td>
                                            </tr>
                                            <tr>
                                                <td>Konkani</td>
                                                <td>15</td>
                                            </tr>
                                            <tr>
                                                <td>Marathi</td>
                                                <td>5</td>
                                            </tr>
                                            <tr>
                                                <td>Music</td>
                                                <td>6</td>
                                            </tr>
                                            <tr>
                                                <td>Theatre Arts </td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <th rowspan="10">
                                                    Day 3 <br>
                                                    12th June 2023  <br>
                                                    (Two parallel sessions)
                                                </th>
                                                <td>Agriculture</td>
                                                <td>3</td>
                                                <td rowspan="10">
                                                    1. Prof. Vithal Tilvi  <br>
                                                    2. Dr. Mahesh Majik <br>
                                                    3. Prof. Niyan Marchon <br>
                                                    4. Dr. Avelyno H.D'Costa <br>
                                                    5. Prof. M K Janarthanam <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Botany</td>
                                                <td>9</td>
                                            </tr>
                                            <tr>
                                                <td>Environmental Science</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>Microbiology</td>
                                                <td>6</td>
                                            </tr>
                                            <tr>
                                                <td>Zoology</td>
                                                <td>19</td>
                                            </tr>
                                            <tr>
                                                <td>Chemistry</td>
                                                <td>19</td>
                                            </tr>
                                            <tr>
                                                <td>Geography </td>
                                                <td>16</td>
                                            </tr>
                                            <tr>
                                                <td>Geology</td>
                                                <td>9</td>
                                            </tr>
                                            <tr>
                                                <td>Home Science  </td>
                                                <td>6</td>
                                            </tr>
                                            <tr>
                                                <td>Physics </td>
                                                <td>7</td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Day 4 & 5 <br>
                                                    13th & 14th June 2023
                                                </th>
                                                <td>Commerce</td>
                                                <td>106</td>
                                                <td>
                                                    1. Prof. M.K Janarthanam <br>
                                                    2. Dr. Pooja Goel <br>
                                                    3. Dr. Narayan Parab
                                                </td>
                                            </tr>
                                            <tr>
                                                <th rowspan="5">
                                                    Day 6 <br>
                                                    15th June 2023
                                                </th>
                                                <td>Economics</td>
                                                <td>33</td>
                                                <td rowspan="5">
                                                    1. Prof. M.K Janarthanam <br>
                                                    2. Prof. Aswini Kumar Mishra <br>
                                                    3. Dr. Narayan Parab <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>History</td>
                                                <td>13</td>
                                            </tr>
                                            <tr>
                                                <td>Law</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td>Political Science</td>
                                                <td>8</td>
                                            </tr>
                                            <tr>
                                                <td>Sociology</td>
                                                <td>7</td>
                                            </tr>
                                            <tr>
                                                <th rowspan="5">
                                                    Day 7 <br>
                                                    16th June 2023
                                                </th>
                                                <td>Education</td>
                                                <td>23</td>
                                                <td rowspan="5">
                                                    1. Prof. M.K Janarthanam <br>
                                                    2. Prof Reena Cheruvalath <br>
                                                    3. Prof. Niyan Marchon  <br>
                                                    4. Dr Mahesh Majik
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Library Science </td>
                                                <td>7</td>
                                            </tr>
                                            <tr>
                                                <td>Philosophy</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>Psychology</td>
                                                <td>9</td>
                                            </tr>
                                            <tr>
                                                <td>Physical Education</td>
                                                <td>1</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p></p>
                                </div>
                                
                                <div class="col-md-6 mt-4 mb-3">
                                    <img src="assets/img/statistics/statistics (1).jpg" alt="" class="img_full_width"> 
                                    <p>Fig. 1: No. of people attended College wise</p>
                                </div>
                                <div class="col-md-6 mt-4 mb-3">
                                    <img src="assets/img/statistics/statistics (2).jpg" alt="" class="img_full_width"> 
                                    <p>Fig. 2: No. of people attended the workshop Disciplines wise</p>
                                </div>

                                <div id="testimonials" class="col-md-12 testimonials">
                                    <h3 class="mt-4 mb-3">Feedback</h3>
                                    <p>
                                        Feedback from participants was overwhelmingly positive. They found the workshop content highly 
                                        relevant and applicable to their professional roles.
                                    </p>
                                    <strong>Following are the few sample feedbacks from the participants:</strong>
                                    <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                                        <div class="swiper-wrapper">
                                            <?php
                                                foreach ($fdpReportFeedbackDataArr['data'] as $key => $value) {
                                                    echo '<div class="swiper-slide">
                                                        <div class="testimonial-item">
                                                            <p>
                                                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                                                '.$value['content'].'
                                                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                                            </p>
                                                            <h3> '.$value['name'].'</h3>
                                                            <h4>'.$value['designation'].'</h4>
                                                            <h4>'.$value['institute'].'</h4>
                                                        </div>
                                                    </div>';
                                                }
                                                        // <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                                            ?>
                                        </div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
            
                                <h3 class="mt-4 mb-3">Conclusion</h3>
                                <p>
                                    Participants lauded the initiative and recorded that they got exposure to the
                                    methodology along with hands on experience for the first time. The common errors the TY projects
                                    contain skipped their attention basically due to lack of awareness, and those errors are unlikely to be
                                    repeated in the future projects. A follow-up action needs to be worked out
                                </p>
                            -->
                        </div>

                    <?php } else if ($eventKey=="m3tshmg") { ?>
                        <p>
                            Higher Educational Institutes (HEIs) are one of the important stakeholders for 
                            implementing the objectives of the GSRF. Hence, right in January, immediately 
                            after the Chairperson joined the GSRF, emails were sent to various HEIs for 
                            their convenient date and time to meet the stakeholders. Several institutions 
                            have responded positively. The Chairperson of GSRF, along with colleagues 
                            (Prof. Vithal Tilvi, Prof. Niyan Marchon and Dr Mahesh Majik) of GSHEC, made 
                            30 visits to various HEIs, explained the objectives of the foundation, the 
                            necessity of doing research and interacting with Government departments and Industries.
                        </p>
                        <div class="row">
                            <div class="image-slider swiper" data-aos="fade-up" data-aos-delay="100">
                                <div class="swiper-wrapper">
                                    <?php
                                        foreach ($resultImages as $key => $img_url) {
                                            echo '
                                            <div class="swiper-slide">
                                                <a href="'.$img_url.'" data-lightbox="image-set" target="_blank" title="View Image">
                                                    <div class="testimonial-item">
                                                        <img src="'.$img_url.'" alt="" class="img_full_width img_fit testimonial-img mb-5">
                                                    </div>
                                                </a>
                                            </div>';
                                        }
                                    ?>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <h3>
                            Visits to various Higher Education institutes of Goa and the meeting dates:
                        </h3>
                        <table class="table edu_details strong_title mt-3">
                            <thead>
                                <tr class="table-light">
                                    <th>#</th>
                                    <th>Name of the Institution</th>
                                    <th class="text-nowrap">Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($smWithHEIDataArr as $key => $value) {
                                        echo '
                                            <tr>
                                                <td>'.++$key.'</td>
                                                <td>'.$value['name'].'</td>
                                                <td>'.$value['date'].'</td>
                                            </tr>
                                        ';
                                    }
                                ?>
                            </tbody>
                        </table>

                        <h2 class="mt-5">
                            Stakeholders meeting with Government Departments
                        </h2>
                        <p>
                            3<sup>rd</sup> May – 2<sup>nd</sup> June 2023
                        </p>
                        <h3 class="mt-4 mb-3">Introduction</h3>
                        <p>
                            Objectives of the Goa State Research Foundation include working with Government 
                            Departments and also bringing academia, industries, Government departments and 
                            Society together through Research. As the first step, meetings with a few Government 
                            Departments and Boards have been arranged. As of now, GSRF had consultations with 
                            five Government Departments. The Research, Development and Innovation cell of the 
                            Goa State Higher Education Council is part of the meetings and interactions.
                        </p>
                        <h3>
                            Details of the Departments visited: 
                        </h3>
                        <table class="table edu_details strong_title mt-3">
                            <thead>
                                <tr class="table-light">
                                    <th>#</th>
                                    <th>Department visited</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($smWithGovDepDataArr as $key => $value) {
                                        echo '
                                            <tr>
                                                <td>'.++$key.'</td>
                                                <td>'.$value['name'].'</td>
                                                <td class="text-center">'.$value['date'].'</td>
                                                <td class="text-center">'.$value['time'].'</td>
                                            </tr>
                                        ';
                                    }
                                ?>
                            </tbody>
                        </table>
                    <?php } 
                        if ($isComplexContent==false) {  
                            ?>
                            <div class="image-slider swiper" data-aos="fade-up" data-aos-delay="100">
                                <div class="swiper-wrapper">
                                    <?php
                                        foreach ($resultImages as $key => $img_url) {
                                            echo '
                                            <div class="swiper-slide">
                                                <a href="'.$img_url.'" data-lightbox="image-set" target="_blank" title="View Image">
                                                    <div class="testimonial-item">
                                                        <img src="'.$img_url.'" alt="" class="img_full_width img_fit testimonial-img mb-5">
                                                    </div>
                                                </a>
                                            </div>';
                                        }
                                    ?>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                            <?php 
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
    $( document ).ready(function() {

        
    });
</script>
</body>
</html>