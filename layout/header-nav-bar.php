<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">
        <a href="index.php" class="logo me-auto me-lg-0">
        </a>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li class=""><a href="index.php"><span>Home</span></a>
                <li class="dropdown"><a href="#"><span>About</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="about-background.php">Background</a></li>
                        <!-- <li><a href="about-vision-and-mission.php">Vision & Mission</a></li> -->
                        <li><a href="about-objectives.php">Objectives</a></li>
                        <li><a href="about-act.php">Act</a></li>
                        <!-- <li><a href="to-be-updated.php">Rules</a></li>
                        <li><a href="to-be-updated.php">Citizen's Charter</a></li>
                        <li><a href="to-be-updated.php">RTI</a></li> -->
                        <!-- <li><a href="to-be-updated.php">Minutes</a></li> -->
                        <li><a href="budget.php">Budget</a></li>
                        <li class="dropdown"><a href="#"><span>Gazette</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="assets/documents/about/2324-24-SII-OG-0.pdf" class="customLink"
                                        target="_blank"><i class="bi bi-download"></i> 2324-24-SII-OG-0</a></li>
                                <li><a href="assets/documents/about/2324-28-SII-OG-0.pdf" class="customLink"
                                        target="_blank"><i class="bi bi-download"></i> 2324-28-SII-OG-0</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#"><span>RTI</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="assets/documents/about/RTI.pdf" class="customLink" target="_blank"><i
                                            class="bi bi-download"></i> Download</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#"><span>Authority</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="authority-governing-council.php">The Governing Council of GSRF</a></li>
                        <li><a href="authority-finance-committee.php">Finance Committee</a></li>
                    </ul>
                </li>
                <li class=""><a href="people.php"><span>People</span></a>
                    <!-- class="dropdown" -->
                    <!-- <ul> -->
                    <!-- <li><a href="to-be-updated.php">Chairperson</a></li> -->
                    <!-- <li><a href="to-be-updated.php">MD</a></li>
                        <li><a href="to-be-updated.php">Administration</a></li>
                        <li><a href="to-be-updated.php">Finance</a></li> -->
                    <!-- </ul> -->
                </li>
                <li class="dropdown"><a href="#"><span>Schemes</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="schemes-doctoral-fellowship.php">Doctoral Fellowship</a></li>
                        <li><a href="schemes-post-doctoral-fellowship.php">Post-doc Fellowship</a></li>
                        <li><a href="schemes-research-start-up-grants.php">Startup Grants</a></li>
                        <li><a href="schemes-minor-grants.php">Minor Res. Project</a></li>
                        <li><a href="schemes-major-grants.php">Major Res. Project</a></li>
                        <li><a href="schemes-summer-school.php">Summer School Scheme</a></li>
                        <!-- // Test Template -->
                        <li><a href="scheme-iris.php">IRIS Scheme</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#"><span>Downloads</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="download-formats.php">Formats</a></li>
                        <li><a href="download-notifications.php">Notifications</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#"><span>Events</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="to-be-updated.php?vkflgf=ers">Forthcoming</a></li>
                        <li><a href="events-completed.php">Completed</a></li>
                        <!-- <li><a href="to-be-updated.php">Schedule of Schemes</a></li> -->
                    </ul>
                </li>
                <li class=""><a href="statistics.php"><span>Statistics</span></a></li>
                <li class="dropdown"><a href="#"><span>External Links</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="external-links.php">Links to Funding Agencies</a></li>
                    </ul>
                </li>
                <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">Drop Down 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li> -->
                <?php if (isset($_SESSION['userUID'])) { ?>
                    <li class=" d-flex d-lg-none"><a href="api/logoutApi.php"><span>Log Out</span></a></li>
                <?php } else { ?>
                    <li class=" d-flex d-lg-none"><a href="registration-form.php"><span>Register</span></a></li>
                    <li class=" d-flex d-lg-none"><a href="login.php"><span>Login</span></a></li>
                <?php } ?>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <div class="d-lg-flex align-items-center">
            <!-- <label class="toggle-switch" style="margin-left: 10px;">
                <span class="left-text">ENG</span>
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <span class="slider"></span>
                <span class="right-text">KON</span>
            </label> -->
            <?php
            if (isset($_SESSION['userUID'])) { ?>
                <div class="navbar d-none d-lg-flex">
                    <ul>
                        <li class="dropdown"><a href="#">
                                <span>Hello <?php echo $_SESSION['userData']['first_name'] ?> </span>
                                <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li>
                                    <a href="api/logoutApi.php" class="p-2 justify-content-start">
                                        <i class="bi bi-power"></i> &nbsp;&nbsp; Log Out
                                    </a>
                                </li>
                                <!-- <li><a href="#">Drop Down 2</a></li> -->
                            </ul>
                        </li>
                    </ul>
                </div>

            <?php } else { ?>
                <a href="registration-form.php" class="register d-none d-lg-flex">Register</a>
                <a href="login.php" class="register d-none d-lg-flex">Login</a>
            <?php } ?>
        </div>
    </div>
</header>
<!-- End Header -->