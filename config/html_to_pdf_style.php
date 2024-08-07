<?php
$pdf_head_start = '
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@406&family=Noto+Serif+Devanagari:wght@100..900&display=swap" rel="stylesheet">
';
// title
$pdf_style = '
            <style>
                *,
                *::before,
                *::after {
                    box-sizing: border-box;
                }
                body {
                    font-family: "Noto Serif Devanagari", serif;
                    font-optical-sizing: auto;
                    font-weight: 400;
                    font-style: normal;
                    font-variation-settings:
                        "wdth" 100;
                }
                .container {
                    width: 650px !important;
                    padding: 0px 30px;
                    overflow-wrap: anywhere;
                }
                .col-3, .col-4, .col-6, .col-12 {
                    float: left;
                    padding: 10px;
                }
                .col-4 {
                    width: 40%;
                }
                .col-6 {
                    width: 60%;
                }
                .col-3{
                    width: 30%;
                }
                .col-12{
                    width: 100%;
                }
                
                /* Clear floats after the columns */
                .row:after {
                    content: "";
                    display: table;
                    clear: both;
                }
                hr {
                    margin: 1rem 0;
                    color: black !important;
                    border-top: 2px solid black;
                    opacity: 1.25;
                }
                
                table {
                    border-collapse: collapse;
                    width: 100%;
                    padding:0px;
                }
                th, td {
                    font-size: 12px;
                    font-weight: 400;
                    width: 50% !important;
                    color: black;
                    padding:6px 5px;
                }
                table>thead>th {
                    background: #f8f9fa !important;
                    padding:8px 4px;
                }
                .border th, 
                .border td {
                    border: 1px solid #e2e2e2 !important;
                }
                .th-width,
                .td-width {
                    width: 25% !important;
                }

                .mt-3 {
                    margin-top: 1rem !important;
                }
                .mt-5 {
                    margin-top: 3rem !important;
                }
                .mb-5 {
                    margin-bottom: 3rem !important;
                }
                .mb-3 {
                    margin-bottom: 1rem !important;
                }

                .p-10 {
                    padding: 10px 5px; 
                }
                .pt-1 {
                    padding-top: 1rem; 
                }
                .pt-2 {
                    padding-top: 2rem; 
                }
                .pb-0 {
                    padding-bottom: 0rem; 
                }
                .pb-1 {
                    padding-bottom: 1rem; 
                }
                .pb-2 {
                    padding-bottom: 2rem; 
                }
                .p-d5 {
                    padding: 1rem 5px 0; 
                }

                .fw-5 {
                    font-weight: 500;
                }
                .fs-12 {
                    font-size: 12px;
                    font-weight: 500;
                }
                label,
                .fs-12 {
                    font-size: 14px;
                    font-weight: 400;
                }
                .text-center {
                    text-align: center;
                }
                h6{
                    padding:0px;
                }

                .center{
                    margin-left:auto;
                    margin-right:auto;
                    display:block;
                }

                a {
                    text-decoration: none;
                }
                .image_container {
                    margin: 40px 0 ;
                }
                .image_container img {
                    display: block;
                    height: 177px;
                    width: 138px;
                    padding: 4px;
                }
                img.img-fluid {
                    display: block;
                    height: 70px;
                    width: 70px;
                    padding: 4px;
                }

                .pdf-container {
                    text-align: center; /* Center the content horizontally */
                    margin-top: 20px;   /* Add some top margin for spacing */
                }
                /* Style the embedded PDF */
                .pdf-embed {
                    width: 100%; /* Make the embedded PDF occupy the full width of the container */
                    height: 600px; /* Set the desired height for the embedded PDF */
                }

                /* Ensure that tables and other elements can break across pages */
                td {
                    page-break-inside: auto;
                }
                /* Prevent certain elements from breaking across pages */
                .no-page-break {
                    page-break-inside: avoid;
                }
                /* Add page breaks before or after specific elements if necessary */
                .page-break {
                    page-break-before: always;
                }
                /* Define a class to force a page break before an element */
                .page-break_after {
                    page-break-after: always;
                }
            </style>
';
$pdf_head_end = '
        </head>
';
// body
$pdf_html_end = '
    </html>
';
?>