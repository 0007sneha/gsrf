<?php 
// include "data/eventsData.php";


$eventGalleryYearlyArr = [
    '2024',
    '2023',
];

// -------------------------------------------------------
// search id = (first 3 dummy letters) + key 
// 'isComplexContent' => true, 
        // then add images in event-details page template
// -------------------------------------------------------

// add key here to display event details template directly in event-details page
$eventKeyArrayList = array('jdiFgcm','j4efinComt','douFWfsYs','squSgcM','Yw9odslw','JHYfgcM3','v8QgOIngrt','er5BSW','djqfyspfuFDP');


// --------------------- Template start ---------------------
    // array(
        // 'status' => 'completed',
        // 'key' => '{add new key}',
    //     'date' => ' <sup>st</sup> ',
    //     'url' => 'events-detail.php?yr={year}&rsdtype={add new key}',
    //     'title' => '',
    //     'short_title' => '',
    //     'isComplexContent' => false,
    //     'cover_img' => 'assets/img/events/{foldername}/img (1).jpg',
    //     'images' => [
    //                 // 'assets/img/events/{foldername}/img (1).jpg',
    //             ],
    //     'short_content' => ' ...',
    //     'content' => '',
    // ),
// --------------------- Template end ---------------------

$eventGalleryArr = [
    // --------------------- Add New here ---------------------
    array(
        'id' => 2, 
        'year' => 2024,
        'data' => array(
            // array(
                //     'status' => 'completed',
                //     'key' => '{add new key}',
                //     'date' => ' <sup>st</sup> ',
                //     'url' => 'events-detail.php?yr=2024&rsdtype={add new key}',
                //     'title' => '',
                //     'short_title' => '',
                    // 'isComplexContent' => false,
                //     'cover_img' => 'assets/img/events/{foldername}/img (1).jpg',
                //     'images' => [
                //                 // 'assets/img/events/{foldername}/img (1).jpg',
                //             ],
                //     'short_content' => ' ...',
                //     'content' => '',
            // ),
            array(
                'status' => 'completed',
                'key' => 'djqfyspfuFDP',
                'date' => '24<sup>th</sup> April 2024',
                'url' => 'events-detail.php?yr=2024&rsdtype=djqfyspfuFDP',
                'title' => 'Follow-up FDP',
                'short_title' => 'Follow-up FDP',
                'isComplexContent' => false,
                'cover_img' => 'assets/img/events/fysp-fup/img (2).jpg',
                'images' => [
                            'assets/img/events/fysp-fup/img (1).jpg',
                            'assets/img/events/fysp-fup/img (2).jpg',
                            'assets/img/events/fysp-fup/img (3).jpg',
                            'assets/img/events/fysp-fup/img (4).jpg',
                        ],
                'short_content' => 'A Follow-up FDP on "Enhancing Final Year Student Projects" was organized by the Goa State Research Foundation (GSRF) in association with the Goa State...',
                'content' => 'A Follow-up FDP on "Enhancing Final Year Student Projects" was organized by the Goa State Research Foundation (GSRF) in association with the Goa State Higher Education Council (GSHEC) for faculty members (Batch 1) of colleges in Goa, in the GSRF Conference Room at Porvorim – Goa, on 24.04.2024.',
            ),
            array(
                'status' => 'completed',
                'key' => 'er5BSW',
                'date' => '18<sup>th</sup> April 2024',
                'url' => 'events-detail.php?yr=2024&rsdtype=er5BSW',
                'title' => 'Brain-storming Workshop',
                'short_title' => 'Brain-storming Workshop',
                'isComplexContent' => false,
                'cover_img' => 'assets/img/events/bsw/img (1).jpg',
                'images' => [
                            'assets/img/events/bsw/img (1).jpg',
                            'assets/img/events/bsw/img (2).jpg',
                            'assets/img/events/bsw/img (3).jpg',
                        ],
                'short_content' => 'A brain-storming workshop for University and College faculty members was organized by the Goa State Research Foundation (GSRF) on 18.04.2024...',
                'content' => 'A brain-storming workshop for University and College faculty members was organized by the Goa State Research Foundation (GSRF) on 18.04.2024 to work on a common POA for the conduct of series of workshops for school/higher secondary school students and teachers (academic year 2024-25) on the theme "Demystifying Research and taking Research to the Doorsteps of Schools". Over 30 faculty members actively participated.',
            ),
            array(
                'status' => 'completed',
                'key' => 'v8QgOIngrt',
                'date' => ' 11<sup>th</sup> March 2024 ',
                'url' => 'events-detail.php?yr=2024&rsdtype=v8QgOIngrt',
                'title' => 'New Office of Goa State Research Foundation',
                'short_title' => 'New Office of Goa State Research Foundation',
                'isComplexContent' => false,
                'cover_img' => 'assets/img/events/goif/GSRF Office Inauguration (5).jpg',
                'images' => [
                            'assets/img/events/goif/GSRF Office Inauguration (1).jpg',
                            'assets/img/events/goif/GSRF Office Inauguration (2).jpg',
                            'assets/img/events/goif/GSRF Office Inauguration (3).jpg',
                            'assets/img/events/goif/GSRF Office Inauguration (4).jpg',
                            'assets/img/events/goif/GSRF Office Inauguration (5).jpg',
                            'assets/img/events/goif/GSRF Office Inauguration (6).jpg',
                            'assets/img/events/goif/GSRF Office Inauguration (7).jpg',
                            'assets/img/events/goif/GSRF Office Inauguration (8).jpg',
                            'assets/img/events/goif/GSRF Office Inauguration (9).jpg',
                            'assets/img/events/goif/GSRF Office Inauguration (10).jpg',
                            'assets/img/events/goif/GSRF Office Inauguration (11).jpg',
                            'assets/img/events/goif/GSRF Office Inauguration (12).jpg',
                            'assets/img/events/goif/GSRF Office Inauguration (13).jpg',
                            'assets/img/events/goif/GSRF Office Inauguration (14).jpg',
                        ],
                'short_content' => 'New Office of Goa State Research Foundation (GSRF), located at Building ‘B’, 1st Floor, Market Complex...',
                'content' => 'New Office of Goa State Research Foundation (GSRF), located at Building ‘B’, 1st Floor, Market Complex (Porvorim - Goa) was inaugurated by Hon. Chief Minister of Goa, Dr. Pramod Sawant, in the distinguished presence of Shri Subhash Phal Dessai (Hon Minister of Social Welfare, Govt. of Goa), Shri Prasad Lolayekar, IAS (Secretary-Education, Govt. of Goa), Shri Bhushan Savoikar (Director of Higher Education, Govt. of Goa) and others.',
            ),
            array(
                'status' => 'completed',
                'key' => 'JHYfgcM3',
                'date' => ' 7<sup>th</sup> March 2024',
                'url' => 'events-detail.php?yr=2024&rsdtype=JHYfgcM3',
                'title' => 'III<sup>rd</sup> Meeting of the first Governing Council',
                'short_title' => 'III<sup>rd</sup> Meeting of the first Governing Council',
                'isComplexContent' => false,
                'cover_img' => 'assets/img/events/fgcm3/img (1).jpg',
                'images' => [
                            'assets/img/events/fgcm3/img (1).jpg',
                            'assets/img/events/fgcm3/img (2).jpg',
                            'assets/img/events/fgcm3/img (3).jpg',
                        ],
                'short_content' => 'The third meeting of the first Governing Council was held on 7th March 2024.',
                'content' => 'The third meeting of the first Governing Council was held on 7th March 2024.',
            ),
            array(
                'status' => 'completed',
                'key' => 'Yw9odslw',
                'date' => ' 23<sup>rd</sup> February 2024',
                'url' => 'events-detail.php?yr=2024&rsdtype=Yw9odslw',
                'title' => 'One Day State level Workshop',
                'short_title' => 'One Day State level Workshop',
                'isComplexContent' => false,
                'cover_img' => 'assets/img/events/odslw/img (3).jpg',
                'images' => [
                            'assets/img/events/odslw/img (1).jpg',
                            'assets/img/events/odslw/img (2).jpg',
                            'assets/img/events/odslw/img (3).jpg',
                            'assets/img/events/odslw/img (4).jpg',
                            'assets/img/events/odslw/img (5).jpg',
                        ],
                'short_content' => 'A one day state level workshop on the theme "Understanding Research Methods - MLA 9th Edition" was organised by the GSRF...',
                'content' => 'A one day state level workshop on the theme "Understanding Research Methods - MLA 9th Edition" was organised by the Goa State Research Foundation in association with Research and Development Cell of Vidhya Prabodhini College, Porvorim, Goa, at SCERT Building (Porvorim) on 23rd February 2024. The workshop was attended by 30 participants (faculty members and research scholars) from across Goa. The resource persons were Prof. K.A. Geetha (BITS Pilani, Goa) and Dr. Palia A. Pandit (Dhempe College, Panaji). The Workshop Coordinator and Asst. Coordinator were Asst. Prof. Dr. Varsha Ingalhalli and Asst. Prof. Klins Mendes respectively. Principal of Vidya Prabodhini College, Prof. Bhushan Bhave presided over the inaugural function',
            ),
        ), 
    ),
    array(
        'id' => 1, 
        'year' => 2023,
        'data' => array(
            array(
                'status' => 'completed',
                'key' => 'squSgcM',
                'date' => '18<sup>th</sup> December 2023',
                'url' => 'events-detail.php?yr=2023&rsdtype=squSgcM',
                'title' => 'II<sup>nd</sup> Meeting of the first Governing Council',
                'short_title' => 'II<sup>nd</sup> Meeting of the first Governing Council',
                'isComplexContent' => false,
                'cover_img' => 'assets/img/events/fgcm2/img (2).jpg',
                'images' => [
                            'assets/img/events/fgcm2/img (1).jpg',
                            'assets/img/events/fgcm2/img (2).jpg',
                            'assets/img/events/fgcm2/img (3).jpg',
                            'assets/img/events/fgcm2/img (4).jpg',
                        ],
                'short_content' => 'II<sup>nd</sup> Meeting of the first Governing Council held on 18th December...',
                'content' => 'II<sup>nd</sup> Meeting of the first Governing Council held on 18th December 2023 in the 
                                Meeting Room, G4, SCERT building, Porvorim',
            ),
            array(
                'status' => 'completed',
                'key' => 'douFWfsYs',
                'date' => '16<sup>th</sup> December 2023',
                'url' => 'events-detail.php?yr=2023&rsdtype=douFWfsYs',
                'title' => 'FIELD WORKSHOP FOR SY-BSc STUDENTS',
                'short_title' => 'FIELD WORKSHOP FOR SY-BSc STUDENTS',
                'isComplexContent' => false,
                'cover_img' => 'assets/img/events/fwfs/img (1).jpg',
                'images' => [
                            'assets/img/events/fwfs/img (1).jpg',
                            'assets/img/events/fwfs/img (2).jpg',
                            'assets/img/events/fwfs/img (3).jpg',
                            'assets/img/events/fwfs/img (4).jpg',
                        ],
                'short_content' => 'A field workshop was conducted by GSRF, in association with Government College, Quepem,...',
                'content' => 'A field workshop was conducted by GSRF, in association with Government College, Quepem, 
                                Goa, for interested second-year B.Sc. students with biology subjects on 16/12/2023 in 
                                Netravali Wildlife Sanctuary. The same was organised to help undergraduate students 
                                get incentivised to research through exposure to the Biodiversity Rich Western Ghats 
                                running through the State of Goa. Dr Pronoy Baidya, an Ecologist with extensive work 
                                on biodiversity, and Prof. M K Janarthanam (Chairperson, GSRF), a plant taxonomist, 
                                were the resource persons. Twenty-four students attended the workshop with a few teachers 
                                under the leadership of Prof. Mehtab Bukhari of Government College, Quepem.',
            ),
            array(
                'status' => 'completed',
                'key' => 'j4efinComt',
                'date' => '1<sup>st</sup> December 2023',
                'url' => 'events-detail.php?yr=2023&rsdtype=j4efinComt',
                'title' => 'First meeting of the Finance Committee of GSRF',
                'short_title' => 'First meeting of the Finance Committee of GSRF',
                'isComplexContent' => false,
                'cover_img' => 'assets/img/events/fincmt/img (1).jpg',
                'images' => [
                            'assets/img/events/fincmt/img (1).jpg',
                            'assets/img/events/fincmt/img (2).jpg',
                        ],
                'short_content' => 'The first meeting of the Finance Committee of GSRF was held on 1st December 2023...',
                'content' => 'The first meeting of the Finance Committee of GSRF was held on 1st December 2023 
                                in the Meeting Room (G4-SCERT Building) from 3.00 pm onwards. ',
            ),
            array(
                'status' => 'completed',
                'key' => 'f9ilogsrfWsl',
                'date' => '3<sup>rd</sup> October 2023',
                'url' => 'events-detail.php?yr=2023&rsdtype=f9ilogsrfWsl',
                'title' => 'Launch of Goa State Research Foundation Website (<a href="gsrf.org.in">gsrf.org.in</a>)',
                'short_title' => 'Launch of Goa State Research Foundation Website',
                'isComplexContent' => false,
                'cover_img' => 'assets/img/events/gsrfwsl/img (2).png',
                'images' => [
                            'assets/img/events/gsrfwsl/img (1).png',
                            'assets/img/events/gsrfwsl/img (2).png',
                            'assets/img/events/gsrfwsl/img (3).png',
                            'assets/img/events/gsrfwsl/img (4).jpg',
                            'assets/img/events/gsrfwsl/img (5).jpg',
                            'assets/img/events/gsrfwsl/img (6).jpg',
                            'assets/img/events/gsrfwsl/img (7).jpg',
                        ],
                'short_content' => 'GSRF inaugurated its website at the distinguished hands of Shri Prasad Lolayekar,...',
                'content' => 'GSRF inaugurated its website at the distinguished hands of Shri Prasad Lolayekar, 
                                IAS, Secretary of Education. Prof. M. K. Janarthanam, Chairman - GSRF, in his welcome 
                                address highlighted the progress of GSRF, which included visits to Colleges / Goa 
                                University for stakeholder discussions; conduct of College FDP on UG Third Year 
                                Project guiding; organization of Workshop for Faculty on Research Grant Writing; 
                                and visits to Government Departments.',
            ),
            array(
                'status' => 'completed',
                'key' => 'ydfrgww', 
                'date' => '5<sup>th</sup> - 12<sup>th</sup> Sept 2023',
                'url' => 'events-detail.php?yr=2023&rsdtype=ydfrgww',
                'title' => 'Six-Day Workshop on “Research Grant Writing” <br>
                            Empowers Goa\'s Faculty Members',
                'short_title' => 'Research Grant Writing Workshop',
                'isComplexContent' => false,
                'cover_img' => 'assets/img/events/rgww/college-img (1).jpg',
                'images' => [
                            'assets/img/events/rgww/img (1).jpg',
                        ],
                'short_content' => 'Six-Day Workshop on “Research Grant Writing” Empowers Goa\'s Faculty Members',
                'content' => 'Goa State Higher Education Council and Goa State Research Foundation, with the support 
                            of the Department of Higher Education, celebrated Teachers Day with a difference by starting
                            a “Research Grant Writing Workshop” for the faculty members of Goa University and its
                            affiliated colleges (including autonomous colleges). Every day, a new group of faculty 
                            members from different disciplines participated, and a new set of subject experts guided
                            the participants. For organisers, every moment was a satisfying moment. Faculty members 
                            were enthusiastic, and their positive feedback was encouraging.  Workshop concluded on 12th
                            Sept 2023. 213 faculty members attended the workshop.',
            ),
            array(
                'status' => 'completed',
                'key' => 'jdiFgcm',
                'date' => '21<sup>st</sup> July 2023',
                'url' => 'events-detail.php?yr=2023&rsdtype=jdiFgcm',
                'title' => 'The First Governing Council Meeting',
                'short_title' => 'The First Governing Council Meeting',
                'isComplexContent' => false,
                'cover_img' => 'assets/img/events/fgcm/college-img (1).jpg',
                'images' => [
                            'assets/img/events/fgcm/img (1).jpg',
                            'assets/img/events/fgcm/img (2).jpg',
                            'assets/img/events/fgcm/img (3).jpg',
                            'assets/img/events/fgcm/img (4).jpg',
                            'assets/img/events/fgcm/img (5).jpg',
                            'assets/img/events/fgcm/img (6).jpg',
                            'assets/img/events/fgcm/img (7).jpg',
                            'assets/img/events/fgcm/img (8).jpg',
                        ],
                'short_content' => 'The First Governing Council meeting was held on 21st July 2023 from 3:00 pm onwards.',
                'content' => 'The First Governing Council meeting was held on 21st July 2023 from 3:00 pm onwards. Six schemes have been approved for implementation.',
            ),
            array(
                'status' => 'completed',
                'key' => 'hrtfdp',
                'date' => ' 8<sup>th</sup> - 16<sup>th</sup> June 2023',
                'url' => 'events-detail.php?yr=2023&rsdtype=hrtfdp',
                'title' => '‘Enhancing Final Year Student Projects’ (UG Level): One-day Faculty Development Programme',
                'short_title' => '‘Enhancing Final Year Student Projects’ (UG Level)',
                'isComplexContent' => false,
                'cover_img' => 'assets/img/events/fysp/college-img (1).jpg',
                'images' => [
                            'assets/img/events/fysp/img (1).jpg',
                            'assets/img/events/fysp/img (2).jpg',
                            'assets/img/events/fysp/img (3).jpg',
                        ],
                'short_content' => 'FDP was held at Block-B Seminar Hall and BG-3 classroom, Goa University,...',
                'content' => 'FDP was held at Block-B Seminar Hall and BG-3 classroom, Goa University, Taleigao-Goa. 
                                The workshop aimed to provide participants with valuable knowledge and practical skills 
                                in enhancing final-year student projects. The Directorate of Higher Education organised 
                                the event in collaboration with Goa State Higher Education Council (GSHEC), Goa State Research 
                                Foundation (GSRF) and Goa University.  It attracted 433 participants from various disciplines & institutions. ',
            ),
            array(
                'status' => 'completed',
                'key' => 'm3tshmg',
                'date' => '1<sup>th</sup> February – 5<sup>th</sup> July 2023',
                'url' => 'events-detail.php?yr=2023&rsdtype=m3tshmg',
                'title' => 'Stakeholders Meeting with Higher Educational Institutes',
                'short_title' => 'Stakeholders Meetings',
                'isComplexContent' => true,
                'cover_img' => 'assets/img/events/smhe/college-img (1).jpg',
                'images' => [
                            'assets/img/events/smhe/img (1).jpg',
                            'assets/img/events/smhe/img (5).jpg',
                            'assets/img/events/smhe/img (2).jpg',
                            'assets/img/events/smhe/img (3).jpg',
                            // 'assets/img/events/smhe/img (4).jpg',
                            'assets/img/events/smhe/img (6).jpg',
                            'assets/img/events/smhe/img (7).jpg',
                        ],
                'short_content' => 'Higher Educational Institutes (HEIs) are one of the important ...',
                'content' => 'Higher Educational Institutes (HEIs) are one of the important stakeholders for 
                                implementing the objectives of the GSRF. Hence, right in January, immediately 
                                after the Chairperson joined the GSRF, emails were sent to various HEIs for 
                                their convenient date and time to meet the stakeholders. Several institutions 
                                have responded positively. The Chairperson of GSRF, along with colleagues 
                                (Prof. Vithal Tilvi, Prof. Niyan Marchon and Dr Mahesh Majik) of GSHEC, made 
                                30 visits to various HEIs, explained the objectives of the foundation, the 
                                necessity of doing research and interacting with Government departments and Industries.',
            ),
        ), 
    ),
];

?>