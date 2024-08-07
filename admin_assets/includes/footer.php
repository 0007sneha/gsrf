    </section>

    </main><!-- End #main -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../admin_assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../admin_assets/vendor/chart.js/chart.min.js"></script>
    <script src="../admin_assets/vendor/echarts/echarts.min.js"></script>
    <script src="../admin_assets/vendor/quill/quill.min.js"></script>
    <script src="../admin_assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../admin_assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../admin_assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../admin_assets/js/main.js"></script>

    <!-- custom scripts -->
    <script src="../admin_assets/js/custom_script.js?<?php echo time() ?>"></script>
    <script src="../assets/js/custom-scripts.js?<?php echo time() ?>"></script>
    <script src="../assets/js/sweet_alert.js"></script>

    <script>
        let isAnalytics = '<?php echo isset($isAnalytics) ? $isAnalytics : ''; ?>';
        
        // block url for Form resubmission 
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        
        let getSelectedYear = '<?php echo isset($selectedYear) ? $selectedYear : '' ; ?>';

        $(function(){
            getFinancialYears();
        });
        
        function getFinancialYears() {
            // Set Default value for years
            $("#years").empty();
            let isCurrentYearSelected = '';
            let isDisabled = 'disabled';
            if (isAnalytics) {
                isDisabled = '';
            }
            $("#years").append('<option '+isDisabled+' value="">Select Financial Year </option>');

            for (let index = 2023; index <= getCurrentYear; index++) {
                isCurrentYearSelected = '';
                if ( index == getSelectedYear ) {
                    isCurrentYearSelected = 'selected';
                }
                $("#years").append('<option '+isCurrentYearSelected+' value="'+index+'">'+index+'</option>');
            }
        }

        function getYearlyData(navigateTo, value, url='') 
        {
            console.log('navigateTo---'+navigateTo, 'value---'+value, 'url---'+url);
            location.href=navigateTo+".php?yearlydata="+value+url;
        }
        
    </script>
</body>
</html>