<?php
    require 'connection.php';

    $selectSite = "SELECT id, nimiurl, teemakuva, sisalto_id FROM sivut";
    $result = mysqli_query($conn, $selectSite);
    $contentImages = array();
    if (mysqli_num_rows($result) > 0) {
        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
            if ($_REQUEST['site'] == $row['nimiurl']) {
                $deleteSite = "DELETE FROM sivut WHERE id=$row[id]";
                $deleteContent = "DELETE FROM sisalto WHERE id in (''";
                $getContent = "SELECT id, kuva FROM sisalto";
                $resultContent = mysqli_query($conn, $getContent);
                $IDs = explode(";", $row['sisalto_id']);
                for ($j = 0; $j < mysqli_num_rows($resultContent); $j++) {
                    $contentRow = mysqli_fetch_assoc($resultContent);
                    for ($k = 0; $k < count($IDs); $k++) {
                        if ($IDs[$k] == $contentRow['id']) {
                            $deleteContent .= ",'".$contentRow['id']."'";
                            array_push($contentImages, $contentRow['kuva']);
                        }
                    }
                }
                $deleteContent .= ")";
                if (mysqli_query($conn, $deleteSite)
                    && mysqli_query($conn, $deleteContent) 
                    && unlink($row['teemakuva'])
                    && unlink($row['nimiurl'])) {
                    for ($j = 0; $j < count($contentImages); $j++) {
                        unlink($contentImages[$j]);
                    }
                    echo "<script>
                            alert('Sivu poistettu.');
                            window.location.href = 'user-page.php';
                        </script>";
                } else {
                    echo "Error deleting record: " . mysqli_error($conn);
                }
            }
        }
    }
?>