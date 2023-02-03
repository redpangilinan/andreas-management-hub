<?php
// Displays the data table with enabled search functionality
if(isset($_POST['input'])) {
    include '../connection.php';
    $input = $_POST['input'];
    $sql =
        "SELECT record_id, record, details, creation_date
    FROM tb_records
    WHERE record_id LIKE '{$input}%'
    OR record LIKE '{$input}%'
    OR details LIKE '{$input}%'
    OR creation_date LIKE '{$input}%'
    ORDER BY record_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        ?>
        <tr>
            <td><?php echo $row["record_id"] ?></td>
            <td><?php echo $row["record"] ?></td>
            <td><?php echo $row["details"] ?></td>
            <td><?php echo $row["creation_date"] ?></td>
            <td>
                <button data-id="<?php echo $row["record_id"] ?>" class="edit-data btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
                <button data-id="<?php echo $row["record_id"] ?>" class="delete-data btn btn-danger"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
        <?php
    }
    if (($count) == 0) {
        ?>
        <tr>
            <td colspan='7'>There are no records.</td>
        </tr>
        <?php
    }
    mysqli_close($conn);
}

// Inserts a new data
if (isset($_POST['record'])
&& isset($_POST['details'])) {
    include '../connection.php';
    // mysqli_real_escape_string() escapes the special characters that the users will input that will otherwise become an error
    $record = mysqli_real_escape_string($conn, $_POST['record']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $sql = "INSERT INTO tb_records VALUES (null, '$record', '$details', CURDATE())";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
    mysqli_close($conn);
}

// Updates an existing data
if (isset($_POST['primary_id'])
&& isset($_POST['edit_record'])
&& isset($_POST['edit_details'])) {
    include '../connection.php';
    $primary_id = $_POST['primary_id'];
    // mysqli_real_escape_string() escapes the special characters that the users will input that will otherwise become an error
    $edit_record = mysqli_real_escape_string($conn, $_POST['edit_record']);
    $edit_details = mysqli_real_escape_string($conn, $_POST['edit_details']);
    $sql = "UPDATE tb_records SET record='$edit_record', details='$edit_details' WHERE record_id='$primary_id'";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
    mysqli_close($conn);
}

// Deletes an existing data
if (isset($_POST['delete_id'])) {
    include '../connection.php';
    $primary_id = $_POST['delete_id'];
    $sql = "DELETE FROM tb_records WHERE record_id = $primary_id";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
    mysqli_close($conn);
}
?>