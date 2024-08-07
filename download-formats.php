<?php require "layout/head.php"; ?>

<body class="t2">
    <?php
    require "layout/top-bar.php";
    require "layout/header-nav-bar.php";
    include "data/schemesData.php";
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
                                    <li>Formats</li>
                                </ol>
                                <h2>
                                    List of scheme document formats
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
                                echo '<tr><td colspan="4"><h5>' . $doctoralFellowshipRequiredDocs['name'] . '</h5></td></tr>';
                                foreach ($doctoralFellowshipRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>' . ++$key . '</td>
                                        <td>' . $value['name'] . '</td>
                                        <td><a href="' . $value['url_type_1'] . '" class="customLink" target="_blank"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $doctoralFellowshipRequiredDocs['file_format_1'] . '</a></td>
                                        <td>';
                                    if ($value['url_type_2']) {
                                        echo '<a href="' . $value['url_type_2'] . '" class="customLink"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $doctoralFellowshipRequiredDocs['file_format_2'] . '</a></td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 forms mb-5">
                        <table class="table table-borderless">
                            <tbody>
                                <?php
                                echo '<tr><td colspan="4"><h5>' . $postDoctoralFellowshipRequiredDocs['name'] . '</h5></td></tr>';
                                foreach ($postDoctoralFellowshipRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>' . ++$key . '</td>
                                        <td>' . $value['name'] . '</td>
                                        <td><a href="' . $value['url_type_1'] . '" class="customLink" target="_blank"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $postDoctoralFellowshipRequiredDocs['file_format_1'] . '</a></td>
                                        <td>';
                                    if ($value['url_type_2']) {
                                        echo '<a href="' . $value['url_type_2'] . '" class="customLink"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $postDoctoralFellowshipRequiredDocs['file_format_2'] . '</a></td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 forms mb-5">
                        <table class="table table-borderless">
                            <tbody>
                                <?php
                                echo '<tr><td colspan="4"><h5>' . $researchStartUpGrantsRequiredDocs['name'] . '</h5></td></tr>';
                                foreach ($researchStartUpGrantsRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>' . ++$key . '</td>
                                        <td>' . $value['name'] . '</td>
                                        <td><a href="' . $value['url_type_1'] . '" class="customLink" target="_blank"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $researchStartUpGrantsRequiredDocs['file_format_1'] . '</a></td>
                                        <td>';
                                    if ($value['url_type_2']) {
                                        echo '<a href="' . $value['url_type_2'] . '" class="customLink"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $researchStartUpGrantsRequiredDocs['file_format_2'] . '</a></td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 forms mb-5">
                        <table class="table table-borderless">
                            <tbody>
                                <?php
                                echo '<tr><td colspan="4"><h5>' . $minorGrantsRequiredDocs['name'] . '</h5></td></tr>';
                                foreach ($minorGrantsRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>' . ++$key . '</td>
                                        <td>' . $value['name'] . '</td>
                                        <td><a href="' . $value['url_type_1'] . '" class="customLink" target="_blank"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $minorGrantsRequiredDocs['file_format_1'] . '</a></td>
                                        <td>';
                                    if ($value['url_type_2']) {
                                        echo '<a href="' . $value['url_type_2'] . '" class="customLink"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $minorGrantsRequiredDocs['file_format_2'] . '</a></td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 forms mb-5">
                        <table class="table table-borderless">
                            <tbody>
                                <?php

                                echo '<tr><td colspan="4"><h5>' . $majorGrantsRequiredDocs['name'] . '</h5></td></tr>';
                                foreach ($majorGrantsRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>' . ++$key . '</td>
                                        <td>' . $value['name'] . '</td>
                                        <td><a href="' . $value['url_type_1'] . '" class="customLink" target="_blank"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $majorGrantsRequiredDocs['file_format_1'] . '</a></td>
                                        <td>';
                                    if ($value['url_type_2']) {
                                        echo '<a href="' . $value['url_type_2'] . '" class="customLink"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $majorGrantsRequiredDocs['file_format_2'] . '</a></td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 forms mb-5">
                        <table class="table table-borderless">
                            <tbody>
                                <?php

                                echo '<tr><td colspan="4"><h5>' . $summerSchoolRequiredDocs['name'] . '</h5></td></tr>';
                                foreach ($summerSchoolRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>' . ++$key . '</td>
                                        <td>' . $value['name'] . '</td>
                                        <td><a href="' . $value['url_type_1'] . '" class="customLink" target="_blank"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $summerSchoolRequiredDocs['file_format_1'] . '</a></td>
                                        <td>';
                                    if ($value['url_type_2']) {
                                        echo '<a href="' . $value['url_type_2'] . '" class="customLink"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $summerSchoolRequiredDocs['file_format_2'] . '</a></td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>

                    <!-- IRIS SCHEME -->

                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-10 forms mb-5">
                        <table class="table table-borderless">
                            <tbody>
                                <?php

                                echo '<tr><td colspan="4"><h5>' . $irisSchemeRequiredDocs['name'] . '</h5></td></tr>';
                                foreach ($irisSchemeRequiredDocs['data'] as $key => $value) {
                                    echo '<tr>
                                        <td>' . ++$key . '</td>
                                        <td>' . $value['name'] . '</td>
                                        <td><a href="' . $value['url_type_1'] . '" class="customLink" target="_blank"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $irisSchemeRequiredDocs['file_format_1'] . '</a></td>
                                        <td>';
                                    if ($value['url_type_2']) {
                                        echo '<a href="' . $value['url_type_2'] . '" class="customLink"><i class="bi bi-download"></i> ' . $value['fileName'] . '' . $irisSchemeRequiredDocs['file_format_2'] . '</a></td>';
                                    }
                                    echo '</tr>';
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
        $(document).ready(function () {


        });
    </script>
</body>

</html>