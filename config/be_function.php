<?php    
    // require '../config/be_function.php';

    // get or fetch records
    // $query = "SELECT id FROM TABLE WHERE id ='".$id."' ";
    // $data = fetchRows($query);               // all rows
    // $data = fetchRows($query, false);        // single row

    // Create or Update
    // $query="INSERT INTO drivers (name, country_code, driver_phone ) VALUES (:name, :country_code, :driver_phone)";
    // $data = array(
    //     ':name' => $get_driver_name,
    //     ':country_code' => $get_country_code,
    //     ':driver_phone' => $get_driver_phone,
    // );
    // $result = insertRow($query, $data);

    function fetchRows($query, $all=true) 
    {
        require 'connect.php';

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
		if($stmt->rowCount()>0){
            if ($all) {
                return $stmt->fetchAll();
            } else {
                return $stmt->fetch();
            }
        } else {
			return NULL;
		}
    }

    // $data = fetchRowsWithColCheck($query, $data, false); 
    function fetchRowsWithColCheck($query, $data, $all=true) 
    {
        require 'connect.php';

        $stmt = $conn->prepare($query);
        $stmt->execute($data);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
		if($stmt->rowCount()>0){
            if ($all) {
                return $stmt->fetchAll();
            } else {
                return $stmt->fetch();
            }
        } else {
			return NULL;
		}
    }

    function countRows($query, $all=true) 
    {
        require 'connect.php';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
		if($count>0){
            return $count; 
        } else {
			return NULL;
		}
    }

    // Create or Update
    function insertRow($query, $data) 
    {
        require 'connect.php';

        $stmt = $conn->prepare($query);
        $result = $stmt->execute($data);
        return $result;
    }
    function deleteRow($query) 
    {
        require 'connect.php';

        $stmt = $conn->prepare($query);
        $result = $stmt->execute();
        return $result;
    }

    function deleteTable($query, $data) 
    {
        require 'connect.php';

        // $query = "DELETE FROM coupons WHERE usged = :used AND date_active < :date";
        // $data = [ 'date' => $date, 'used' => $used,];
        
        $stmt= $pdo->prepare($query);
        $result = $stmt->execute($data);
        return $result;
    }


	function returnToPage($msg, $isMsg=false)
	{
		echo '<script> ';
            if ($msg) {
                    if ($isMsg==true) {
                        echo 'alert("Please '.$msg.' first!")';
                } else {
                    echo 'alert("'.$msg.'")';
                }
            }
        echo '
                history.back();
			</script>';
	}

    function DFA($data) {
        echo '<pre>';
        print_r($data);
        exit();
    }
    
    function DFS($data) {
        echo '<pre>';
        print_r($data);
    }

    function findObjectById($dataArr, $id) 
    {
        foreach ( $dataArr as $element ) {
            if ( $id == $element['id'] ) {
                return $element;
            }
        }
        return false;
    }

    function trimString($url, $len=22) 
    {
        $tempStrExt = '';
        $tempTrimStr = substr($url, $len);
        return $tempTrimStr;
    }

    

    function getHtmlContentFromString($value){
        $wordCountThreshold = 650;
        $string_to_html = '';
        if (!empty($value)) {
            $pages = breakContent(nl2br(htmlspecialchars($value)), $wordCountThreshold);
            // Output pages
            foreach ($pages as $index => $page) {
                $string_to_html .= '<tr><td class="pb-2"style="page-break-after: always;">' . $page . ' </td></tr>';
            }
        } else {
            $string_to_html .= '<tr><td class="pb-2"> </td></tr>';
        }
        return $string_to_html;
    }
    
    // example 1
    // $pages = breakContent(nl2br(htmlspecialchars($data["proposal_summary"])), $wordCountThreshold);
    // // Output pages
    // foreach ($pages as $index => $page) {
    //     $html .= '<tr><td class="pb-2"style="page-break-after: always;">' . $page . ' </td></tr>';
    // }
    function breakContent($content, $wordCountThreshold) {
        $wordCount = str_word_count($content);

        if ($wordCount <= $wordCountThreshold) {
            // Content fits on a single page
            return [$content];
        }

        // Split content into sentences
        $sentences = preg_split('/(?<=[.?!])\s+/', $content, -1, PREG_SPLIT_NO_EMPTY);

        $currentPage = 0;
        $currentWordCount = 0;
        $pages = [];

        foreach ($sentences as $sentence) {
            $sentenceWordCount = str_word_count($sentence);

            if (($currentWordCount + $sentenceWordCount) <= $wordCountThreshold) {
                // Add sentence to current page
                $pages[$currentPage] .= ' ' . $sentence;
                $currentWordCount += $sentenceWordCount;
            } else {
                // Start a new page
                $currentPage++;
                $currentWordCount = $sentenceWordCount;
                $pages[$currentPage] = $sentence;
            }
        }
        // foreach ($sentences as $sentence) {
        //     $sentenceWordCount = str_word_count($sentence);

        //     // Check if the sentence exceeds the word count threshold for the current page
        //     if (($currentWordCount + $sentenceWordCount) > $wordCountThreshold) {
        //         // Move to the next page
        //         $currentPage++;
        //         $currentWordCount = 0;
        //         $pages[$currentPage] = ''; // Initialize a new page
        //     }

        //     // Add the sentence to the current page
        //     $pages[$currentPage] .= ' ' . $sentence;
        //     $currentWordCount += $sentenceWordCount;
        // }
        
        return $pages;
    }


    function contentFromHtmlBody($content) {
        // fetch receiver message
        $doc = new DOMDocument(); // Create a DOMDocument
        $doc->loadHTML($content); // Load HTML into the DOMDocument
        $containerContent = '';
        $containerNodeList = $doc->getElementsByTagName('div');
        foreach ($containerNodeList as $containerNode) {
            if ($containerNode->getAttribute('class') === 'container') {
                // Get the child nodes of the container div
                $children = $containerNode->childNodes;
                // Build the content by iterating through child nodes
                foreach ($children as $child) {
                    $containerContent .= $doc->saveHTML($child);  // Output the body content
                }
                break; // fetch the content of the first matching div
            }
        }
        return $containerContent;
    }

    function isDateBeforeCurrentDate($selectedDateValue) {

        $currentDate = new DateTime();  // Current date and time
        $selectedDateObj = DateTime::createFromFormat('Y-m-d', $selectedDateValue);

        if ($selectedDateObj === false) {
            return "Invalid Date";  // Check if the selected date is not in the correct format
        }

        if ($selectedDateObj < $currentDate) {
            return 'less';
        } else if ($selectedDateObj > $currentDate) {
            return 'greater';
        } else {
            return 'equal';
        }
    }
        
    function timeElapsed($timestamp) {
        $currentTime = time(); // Get current time
        $timeDifference = $currentTime - $timestamp; // Calculate the time difference

        if ($timeDifference < 60) {
            return $timeDifference . ' seconds ago';
        } elseif ($timeDifference < 3600) {
            $minutes = floor($timeDifference / 60);
            return $minutes . ($minutes == 1 ? ' minute ago' : ' minutes ago');
        } elseif ($timeDifference < 86400) {
            $hours = floor($timeDifference / 3600);
            return $hours . ($hours == 1 ? ' hour ago' : ' hours ago');
        } elseif ($timeDifference < 604800) {
            $days = floor($timeDifference / 86400);
            return $days . ($days == 1 ? ' day ago' : ' days ago');
        } elseif ($timeDifference < 2629743) {
            $weeks = floor($timeDifference / 604800);
            return $weeks . ($weeks == 1 ? ' week ago' : ' weeks ago');
        } elseif ($timeDifference < 31556926) {
            $months = floor($timeDifference / 2629743);
            return $months . ($months == 1 ? ' month ago' : ' months ago');
        } else {
            $years = floor($timeDifference / 31556926);
            return $years . ($years == 1 ? ' year ago' : ' years ago');
        }
    }

?>