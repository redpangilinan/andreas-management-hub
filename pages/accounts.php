<?php
session_start();
include "../assets/php/login_validation.php";
include "../assets/php/logout.php";
validateSession();
privateAccess();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Accounts</title>
</head>

<body>
    <?php include "../assets/php/extensions/sidebar.php" ?>
    <main>
        <!-- Main Content -->
        <div class="main-content">
            <div class="container-fluid">
                <!-- Header -->
                <header>
                    <h1>Accounts</h1>
                    <hr>
                </header>
            </div>
            <div class="container">
                <!-- Data Table w/ Search -->
                <div class="d-flex">
                    <div class="search-container w-100">
                        <input type="text" class="form-control" id="search_records" placeholder="Search">
                        <button type="submit" class="add-data btn btn-success text-nowrap" data-bs-toggle="modal" data-bs-target="#addModal">Add Account</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                                <th>Creation Date</th>
                                <th>Account</th>
                                <th>Modify</th>
                            </tr>
                        </thead>
                        <tbody id="search_results">
                            <!-- Initialize Skeleton Loader for Data Table -->
                            <?php
                            include '../assets/php/connection.php';
                            $sql = "SELECT * FROM tb_accounts";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            for ($i = 0; $i < $count; $i++) {
                                echo "
                                <tr>
                                    <td>
                                        <div class='skeleton skeleton-text w-50'></div>
                                    </td>
                                    <td>
                                        <div class='skeleton skeleton-text w-100'></div>
                                    </td>
                                    <td>
                                        <div class='skeleton skeleton-text w-100'></div>
                                    </td>
                                    <td>
                                        <div class='skeleton skeleton-text w-100'></div>
                                    </td>
                                    <td>
                                        <div class='skeleton skeleton-text w-100'></div>
                                    </td>
                                    <td>
                                        <div class='skeleton skeleton-text w-100'></div>
                                    </td>
                                    <td>
                                        <div class='skeleton skeleton-text w-50'></div>
                                    </td>
                                </tr>
                                ";
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <!-- Add Account Modal -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Add an Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Add Account Form -->
                <form id="form_add">
                    <div class="modal-body" id="add-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="add-confirm btn btn-primary">Create account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <!-- Edit Modal -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Edit Form -->
                <form id="form_edit">
                    <div class="modal-body" id="edit-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="edit-confirm btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/alerts.js"></script>
    <script src="../assets/js/ajax/accounts_data.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>