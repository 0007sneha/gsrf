<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
$isStatusCount = true;
// include('../admin_assets/api/schemeStatusCountApiData.php'); api
include_once('includes/header.php');

// require '../admin_assets/dashboard.php'; fe page

// -----------  New Page --------------------------------------------------------------------------------------------------------------
include('../admin_assets/includes/custom_functions.php');
include "../data/generalData.php";
include "../config/be_function.php";

$today = new DateTime(); // Get the current date and time
$year = $today->format('Y'); // Get the current year
$selectedYear = isset($_GET['yearlydata']) ? $_GET['yearlydata'] : '';
$isAnalytics = true;
$selectedFilterTime = isset($_GET['isT']) ? $_GET['isT'] : 0;
$selectedFilterTimeTitle = 'All';
$colors = ['success','danger','primary','secondary','info','warning','muted','light','dark'];

//Get DB instance. function is defined in config.php
$db = getDbInstance();
$db->orderBy('id', 'DESC');
if ($selectedFilterTime==1) {
    $db->where('DATE(created_at)', date('Y-m-d')); 
    $selectedFilterTimeTitle = 'Today';
} else if ($selectedFilterTime==2) {
    $db->where('MONTH(created_at)', date('m')); 
    $db->where('YEAR(created_at)', $year);
    $selectedFilterTimeTitle = 'This Month';
} else if ($selectedFilterTime==3) {
    $db->where('YEAR(created_at)', $year);
    $selectedFilterTimeTitle = 'This Year';
} else {
    // $db->where('YEAR(created_at)', $selectedYear);
    $selectedFilterTimeTitle = 'All';
}
$recent_logs_data = $db->get('communication_log', 9, 'title,created_at');


// Current year candidates
$db = getDbInstance();
if ($selectedFilterTime==1) {
    $db->where('DATE(created_at)', date('Y-m-d')); 
} else if ($selectedFilterTime==2) {
    $db->where('MONTH(created_at)', date('m')); 
    $db->where('YEAR(created_at)', $year);
} else if ($selectedFilterTime==3) {
    $db->where('YEAR(created_at)', $year);
} else if ($selectedYear) {
    $db->where('YEAR(created_at)', $selectedYear);
}
$db->groupBy('status');
$scheme_users_count_data = $db->get("users", NULL, "status, COUNT(*) AS total");
$scheme_active_users_count = $scheme_in_active_users_count = 0;
if ($scheme_users_count_data) {
    foreach ($scheme_users_count_data as $key => $user_count_data) {
        if ($user_count_data['status']==1) {
            $scheme_active_users_count = $user_count_data['total'] ?? 0;
        } else {
            $scheme_in_active_users_count = $user_count_data['total'] ?? 0;
        }
    }
}
$scheme_users_count = $scheme_active_users_count + $scheme_in_active_users_count;

// previous year candidates
$scheme_users_count_prev = 0;
$scheme_users_count_prev_upon = 1;
if ($selectedYear) {
    $db = getDbInstance();
    $prevYear = (int)$selectedYear-1;
    $db->where('YEAR(created_at)', $prevYear);
    $db->where('status',1);
    $scheme_users_count_prev_data = $db->get("users", NULL, "COUNT(*) AS total");
    if ($scheme_users_count_prev_data) {
        $scheme_users_count_prev = $scheme_users_count_prev_data[0]['total'];
        $scheme_users_count_prev_upon = $scheme_users_count_prev;
    }
}
if ($scheme_users_count_prev==0) {
    $scheme_users_count_prev_upon = 1;
}
$percentage_change = (($scheme_users_count - $scheme_users_count_prev)/$scheme_users_count_prev_upon) * 100;



$caste_wise_user = [];
$caste_wise_user_label = [];
$caste_wise_user_count = [];
$db = getDbInstance();
if ($selectedYear) {
    $db->where('YEAR(created_at)', $selectedYear);
}
$db->where('status',1);
$db->groupBy('category');
$users = $db->get("users", NULL, "category as category_id, COUNT(*) as total_users_in_category");
if ($users) {
    foreach ($users as $key => $user) {
        $category = findObjectById($categoriesArr, $user['category_id']);
        if ($category) {
            $caste_wise_user[] = $user;
            
            $caste_wise_user_label[] = $category['name'];
            $caste_wise_user_count[] = $user['total_users_in_category'];
        }
    }
    $caste_wise_user = [
        'label' => $caste_wise_user_label,
        'count' => $caste_wise_user_count,
    ];
}

// applications count
$applications_count_arr = [];
$db = getDbInstance();
$scheme_types = $db->get('scheme_types', null, 'app_code, name, scheme_table_name');
foreach ($scheme_types as $key => $value) {
    $scheme_table_name = $value['scheme_table_name'];
    $data_arr = [
        'code' => $value['app_code'],
        'scheme_name' => $value['name'],
    ];
    $db = getDbInstance();
    if ($selectedFilterTime==1) {
        $db->where('DATE(created_at)', date('Y-m-d')); 
    } else if ($selectedFilterTime==2) {
        $db->where('MONTH(created_at)', date('m')); 
        $db->where('YEAR(created_at)', $year);
    } else if ($selectedFilterTime==3) {
        $db->where('YEAR(created_at)', $year);
    } else if ($selectedYear) {
        $db->where('YEAR(created_at)', $selectedYear);
    }
    $db->where('status', 1);
    $db->groupBy('form_status');
    $scheme_data = $db->get("$scheme_table_name", NULL, "form_status, created_at, COUNT(*) as total_applications");
    foreach ($scheme_data as $key => $schemes) {
        if ($schemes['form_status'] == 0) {
            $data_arr['app_in_process'] = $schemes['total_applications'];
        } 
        if ($schemes['form_status'] == 1) {
            $data_arr['app_received'] = $schemes['total_applications'];
        }
    }
    array_push($applications_count_arr, $data_arr);
}
// CDFS($applications_count_arr);

$scheme_wise_applications = 0;
$scheme_wise_user_data = [];
$scheme_names = [];
$user_male_in_scheme = [];
$user_female_in_scheme = [];
$user_others_in_scheme = [];
$db = getDbInstance();
$scheme_types = $db->get("scheme_types", NULL, "id, code, name, scheme_table_name");
if ($scheme_types) {
    foreach ($scheme_types as $key => $value) {
        $scheme_table_name = $value['scheme_table_name'];
        $scheme_names[] = $value['code'];

        $db = getDbInstance();
        if ($selectedFilterTime==1) {
            $db->where('DATE(created_at)', date('Y-m-d')); 
        } else if ($selectedFilterTime==2) {
            $db->where('MONTH(created_at)', date('m')); 
            $db->where('YEAR(created_at)', $year);
        } else if ($selectedFilterTime==3) {
            $db->where('YEAR(created_at)', $year);
        } else if ($selectedYear) {
            $db->where('YEAR(created_at)', $selectedYear);
        }
        $scheme_wise_applications_data = $db->get("$scheme_table_name", NULL, "COUNT(*) as total_app");
        $scheme_wise_applications += (int)$scheme_wise_applications_data[0]['total_app'];

        $db = getDbInstance();
        $db->join('users usr', 's.user_id = usr.id', 'LEFT');
        if ($selectedFilterTime==1) {
            $db->where('DATE(s.created_at)', date('Y-m-d')); 
        } else if ($selectedFilterTime==2) {
            $db->where('MONTH(s.created_at)', date('m')); 
            $db->where('YEAR(s.created_at)', $year);
        } else if ($selectedFilterTime==3) {
            $db->where('YEAR(s.created_at)', $year);
        } else if ($selectedYear) {
            $db->where('YEAR(s.created_at)', $selectedYear);
        }
        $db->where('s.status', 1);
        $db->where('s.form_status', 1);
        $db->groupBy('usr.gender');
        $scheme_users = $db->get("$scheme_table_name s", NULL, "usr.gender as user_gender, COUNT(*) as total_users");

        if (isset($scheme_users)) {
            $user_male_in_scheme[] = isset($scheme_users[0]) ? $scheme_users[0]['total_users'] : 0;
            $user_female_in_scheme[] = isset($scheme_users[1]) ? $scheme_users[1]['total_users'] : 0;
            $user_others_in_scheme[] = isset($scheme_users[2]) ? $scheme_users[2]['total_users'] : 0;
        } else {
            $user_male_in_scheme[] = 0;
            $user_female_in_scheme[] = 0;
            $user_others_in_scheme[] = 0;
        }
        $value['users_to_scheme'] = $scheme_users;
        $scheme_wise_user_data[] = $value;
    }
    $scheme_wise_user = [
        'scheme_names' => $scheme_names,
        'title' => 'No of Applicants',
        'males' => $user_male_in_scheme,
        'females' => $user_female_in_scheme,
        'others' => $user_others_in_scheme,
    ];
}

$db = getDbInstance();
$condition = '';
if ($selectedYear) {
    $condition = ' AND YEAR(created_at) = ?';
}
$ageGroupQuery = "SELECT 
                    age_group, COUNT(*) AS user_count
                FROM (
                    SELECT 
                        CASE 
                            WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN 20 AND 25 THEN '20-25'
                            WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN 26 AND 30 THEN '26-30'
                            WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN 31 AND 35 THEN '31-35'
                            WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN 36 AND 40 THEN '36-40'
                            WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN 41 AND 45 THEN '41-45'
                            WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) BETWEEN 46 AND 50 THEN '46-50'
                            ELSE 'Above 50'
                        END AS age_group
                    FROM users
                    WHERE status = 1
                    $condition
                ) AS age_groups
                GROUP BY age_group
                ORDER BY age_group
            ";
if ($selectedYear) {
    $age_group_wise_user_data = $db->rawQuery($ageGroupQuery, [$selectedYear]);
} else {
    $age_group_wise_user_data = $db->rawQuery($ageGroupQuery);
}

// Graphical representation of personal data for analytics purpose  
// e.g. Gender, Age, (Scheme wise filters)
?>


    <div class="pagetitle">
        <div class="d-md-flex align-items-center justify-content-between">
            <h1>Dashboard</h1>
            <div class="col-md-auto">
                <div class="row">
                    <div class="col-md-auto">
                        <div class="card customers-card mb-0">
                            <div class="">
                                <a class="icon" href="#" data-bs-toggle="dropdown" style="padding: 3px 10px 0px;">
                                    <i class="bi bi-filter" style="font-size: x-large;"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start"><h6>Filter</h6></li>
                                    <li><a class="dropdown-item" href="#" onclick="getYearlyData('analytics', <?php echo $selectedYear ?>, '<?php echo '&isT=0'; ?>' )">All</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="getYearlyData('analytics', <?php echo $year ?>, '<?php echo '&isT=1'; ?>' )">Today</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="getYearlyData('analytics', <?php echo $year ?>, '<?php echo '&isT=2'; ?>' )">This Month</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="getYearlyData('analytics', <?php echo $year ?>, '<?php echo '&isT=3'; ?>' )">This Year</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <select id="years" onchange="getYearlyData('analytics', this.value, '&isC=0&isT=0' )" class="form-control">
                            <option disabled value="">Select Financial Year </option>
                            <option value="2022">2022</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo 'index.php?yearlydata='.$selectedYear; ?>">Home</a></li>
                <li class="breadcrumb-item active">Analytics</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Sales Card -->
                    <!-- <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Sales <span>| Today</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>
                                        <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  -->
                    <!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <!-- <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Revenue <span>| This Month</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                    <h6>$3,264</h6>
                                    <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6 col-xxxl-3">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Candidates <span>| <?php echo $selectedFilterTimeTitle ?></span></h5>
                                <div class="d-flex align-items-center justify-content-around">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <span class="text-success small pt-1 fw-bold">Verified</span>
                                        <h6><?php echo $scheme_active_users_count ?></h6>
                                        <!-- <span class="text-danger small pt-1 fw-bold"> 1%</span> <span class="text-muted small pt-2 ps-1">decrease</span> -->
                                    </div>
                                    <div class="ps-3">
                                        <span class="text-warning small pt-1 fw-bold">Pending</span>
                                        <h6><?php echo $scheme_in_active_users_count ?></h6>
                                        <!-- <span class="text-danger small pt-1 fw-bold"> 1%</span> <span class="text-muted small pt-2 ps-1">decrease</span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Customers Card -->
                </div>
            </div><!-- Left side columns -->
            
            <!-- Left side columns -->
            <div class="col-lg-12">
                <h5 class="card-title pt-0">Scheme Application Count</h5>
                <div class="row">
                    <?php
                        foreach ($applications_count_arr as $key => $applications_value) {
                            $app_received = isset($applications_value['app_received']) ? $applications_value['app_received'] : 0;
                            $app_in_process = isset($applications_value['app_in_process']) ? $applications_value['app_in_process'] : 0;
                            echo '
                                <div class="col-12 col-md-6 col-lg-4 col-xl-4 col-xxxl-3">
                                    <div class="card info-card sales-card">
                                        <div class="card-body">
                                            <h5 class="card-title">'.$applications_value['scheme_name'].' <span>| '.$selectedFilterTimeTitle.'</span></h5>
                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-journal-check"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>'.$app_received.' <span class="text-muted small pt-2 ps-1" style="small !important">Received</span></h6>
                                                    <span class="text-warning small pt-1 fw-bold"> <i class="bi bi-stopwatch"></i> '.$app_in_process.'</span> 
                                                    <span class="text-muted small pt-2 ps-1">Forms in Process</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            ';
                        }
                    ?>
                </div>
            </div><!-- Left side columns -->
            
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Scheme wise Applicants</h5>
                        <!-- Column Chart -->
                        <div id="columnChart"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                var scheme_wise_user = <?php echo json_encode($scheme_wise_user) ?>;
                                new ApexCharts(document.querySelector("#columnChart"), {
                                    series: [
                                        {
                                            name: 'Male',
                                            data: scheme_wise_user.males
                                        }, 
                                        {
                                            name: 'Fe-male',
                                            data: scheme_wise_user.females
                                        }, 
                                        {
                                            name: 'Others',
                                            data: scheme_wise_user.others
                                        }
                                    ],
                                    chart: {
                                        type: 'bar',
                                        height: 350
                                    },
                                    plotOptions: {
                                        bar: {
                                            horizontal: false,
                                            columnWidth: '55%',
                                            endingShape: 'rounded'
                                        },
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    stroke: {
                                        show: true,
                                        width: 2,
                                        colors: ['transparent']
                                    },
                                    xaxis: {
                                        categories: scheme_wise_user.scheme_names,
                                    },
                                    yaxis: {
                                        title: {
                                            text: scheme_wise_user.title
                                        }
                                    },
                                    fill: {
                                        opacity: 1
                                    },
                                    tooltip: {
                                        y: {
                                            formatter: function(val) {
                                                let user_title = " Candidate"; 
                                                if (val>1) user_title += "s"; 
                                            return "" + val + user_title;
                                            }
                                        }
                                    }
                                }).render();
                            });
                        </script>
                    <!-- End Column Chart -->
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Candidates Caste Ratio</h5>
                        <!-- Pie Chart -->
                        <div id="pieChart"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                var caste_wise_user = <?php echo json_encode($caste_wise_user) ?>;
                                new ApexCharts(document.querySelector("#pieChart"), {
                                    series: caste_wise_user.count,
                                    chart: {
                                        height: 350,
                                        type: 'pie',
                                        toolbar: {
                                            show: true
                                        }
                                    },
                                    labels: caste_wise_user.label
                                }).render();
                            });
                        </script>
                    <!-- End Pie Chart -->

                    </div>
                </div>
            </div>

        
            <div class="col-lg-6 d-none">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Vertical Bar Chart</h5>
                        <!-- Vertical Bar Chart -->
                        <div id="verticalBarChart" style="min-height: 400px;" class="echart"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                var age_group_wise_user_data = <?php echo json_encode($age_group_wise_user_data) ?>;
                                // console.log(age_group_wise_user_data);

                                echarts.init(document.querySelector("#verticalBarChart")).setOption({
                                    title: {
                                        text: 'World Population'
                                    },
                                    tooltip: {
                                        trigger: 'axis',
                                        axisPointer: {
                                            type: 'shadow'
                                        }
                                    },
                                    legend: {},
                                    grid: {
                                        left: '3%',
                                        right: '4%',
                                        bottom: '3%',
                                        containLabel: true
                                    },
                                        xAxis: {
                                        type: 'value',
                                        boundaryGap: [0, 0.01]
                                    },
                                        yAxis: {
                                        type: 'category',
                                        data: ['Brazil', 'Indonesia', 'USA', 'India', 'China', 'World']
                                    },
                                    series: [{
                                            name: '2011',
                                            type: 'bar',
                                            data: [18203, 23489, 29034, 104970, 131744, 630230]
                                        },
                                        {
                                            name: '2012',
                                            type: 'bar',
                                            data: [19325, 23438, 31000, 121594, 134141, 681807]
                                        }
                                    ]
                                });
                            });
                        </script>
                        <!-- End Vertical Bar Chart -->
                    </div>
                </div>
            </div>


            <!-- Recent Activity -->
            <div class="col-lg-6">
                <div class="card">
                    <!-- <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start"><h6>Filter</h6></li>
                            <li><a class="dropdown-item" href="#" onclick="getYearlyData('analytics', <?php echo $selectedYear ?>, '<?php echo '&isC='.$selectedFilterTime.'&isT=0'; ?>')">All</a></li>
                            <li><a class="dropdown-item" href="#" onclick="getYearlyData('analytics', <?php echo $selectedYear ?>, '<?php echo '&isC='.$selectedFilterTime.'&isT=1'; ?>')">Today</a></li>
                            <li><a class="dropdown-item" href="#" onclick="getYearlyData('analytics', <?php echo $selectedYear ?>, '<?php echo '&isC='.$selectedFilterTime.'&isT=2'; ?>')">This Month</a></li>
                            <li><a class="dropdown-item" href="#" onclick="getYearlyData('analytics', <?php echo $selectedYear ?>, '<?php echo '&isC='.$selectedFilterTime.'&isT=3'; ?>')">This Year</a></li>
                        </ul>
                    </div> -->

                    <div class="card-body">
                        <h5 class="card-title">Recent Activity <span>| <?php echo $selectedFilterTimeTitle; ?></span></h5>
                        <div class="activity">
                            <?php 
                                if ($recent_logs_data) {
                                    foreach ($recent_logs_data as $key => $value) {
                                        $timestamp = strtotime($value['created_at']); // Replace with your timestamp
                                        $time_recorded = timeElapsed($timestamp);
                                        echo '
                                                <div class="activity-item d-flex">
                                                    <div class="activite-label">'.$time_recorded.'</div>
                                                    <i class="bi bi-circle-fill activity-badge text-'.$colors[$key].' align-self-start"></i>
                                                    <div class="activity-content">'.$value['title'].'</div>
                                                </div>
                                            ';
                                    }
                                } else {
                                    echo '
                                            <div class="activity-item d-flex">
                                                <div class="activite-label">--</div>
                                                <i class="bi bi-circle-fill activity-badge text-dark align-self-start"></i>
                                                <div class="activity-content">No logs found</div>
                                            </div>
                                        ';
                                }
                            
                                
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Recent Activity -->


        </div>
    </section>


<?php
include_once('includes/footer.php'); ?>

<!-- // -----------  New Page -------------------------------------------------------------------------------------------------------------- -->