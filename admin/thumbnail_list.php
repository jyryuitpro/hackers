<table border="1">
    <tr>
        <th>파일 아이디</th>
        <th>원래 파일명</th>
        <th>저장된 파일명</th>
    </tr>

    <?php
    $db_conn = mysqli_connect("localhost", "root", "123456", "hackers");
    $query = "SELECT file_id, name_orig, name_save FROM upload_file ORDER BY reg_time DESC";
    $stmt = mysqli_prepare($db_conn, $query);
    $exec = mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?= $row['file_id'] ?></td>
            <td><a href="download_thumbnail.php?file_id=<?= $row['file_id'] ?>" target="_blank"><?= $row['name_orig'] ?></a></td>
            <td><?= $row['name_save'] ?></td>
        </tr>
        <?php
    }

    mysqli_free_result($result);
    mysqli_stmt_close($stmt);
    mysqli_close($db_conn);
    ?>
</table>