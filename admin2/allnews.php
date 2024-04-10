<?php
session_start();
if(!isset($_SESSION['SESS_USERNAME'])){
    header("location: sign-in.php");
}

include "header.php";
?>

<?php if (get("success")): ?>
    <div class="custom-alert custom-alert-success">
        <button class="custom-alert-close" onclick="closeCustomAlert(this)">X</button>
        <span class="custom-alert-message">Success</span>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-12 stretch-card mb-3">
        <div class="card">
            <div class="card-body">
                <p class="card-title">All News and Stories</p>

                <style>
                    .table-sm th,
                    .table-sm thead th,
                    .table-sm tbody td {
                        font-size: 12px; /* Adjust the font size as needed */
                    }

                    .custom-alert {
                        padding: 10px;
                        margin-bottom: 10px;
                        border-radius: 5px;
                        display: flex;
                        align-items: center;
                    }

                    .custom-alert-success {
                        background-color: #d4edda;
                        color: #155724;
                        border: 1px solid #c3e6cb;
                    }

                    .custom-alert-message {
                        margin-right: 10px;
                        margin-left: 15px;
                    }

                    .custom-alert-close {
                        background-color: #f8d7da;
                        border: 1px solid #f5c6cb;
                        color: #721c24;
                        padding: 3px 8px;
                        cursor: pointer;
                    }

                    .custom-alert-close:hover {
                        background-color: #f5c6cb;
                        border: 1px solid #f1b0b7;
                        color: #721c24;
                    }
                </style>

                <div class="table-responsive">
                    <table id="recent-listing" class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Date Posted</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tbl_name = "news";

                            // Get news in descending order by date
                            $get_posts_tbl = ORM::for_table("$tbl_name")->order_by_desc('id')->find_array();

                            foreach ($get_posts_tbl as $i => $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $i + 1 ?></th>
                                    <td><?= $row['news_title']; ?></td>
                                    <td><?= $row['date']; ?></td>
                                    <td><?= $row['start_date']; ?></td>
                                    <td><?= $row['end_date']; ?></td>
                                    <td>
                                        <div class="mb-1">
                                            <a href="../news_post.php?id=<?= $row['id'] ?>" target="_blank" class="btn btn-primary btn-sm action-btn">View</a>
                                        </div>
                                        <div class="mb-1">
                                            <a href="editnews.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm action-btn">Edit</a>
                                        </div>
                                        <div class="mb-1">
                                            <a href="deletenews.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm ml-1 action-btn" onclick="return confirmDelete()">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 stretch-card mb-3">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Active News</p>
                <div class="table-responsive">
                    <table id="active-news-listing" class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Date Posted</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tbl_name = "news";
                            // Get active news with status 1
                            $active_posts = ORM::for_table("$tbl_name")->where('status', 1)->order_by_desc('id')->find_array();

                            foreach ($active_posts as $i => $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $i + 1 ?></th>
                                    <td><?= $row['news_title']; ?></td>
                                    <td><?= $row['date']; ?></td>
                                    <td><?= $row['start_date']; ?></td>
                                    <td><?= $row['end_date']; ?></td>
                                    <td>
                                        <div class="mb-1">
                                            <a href="../news_post.php?id=<?= $row['id'] ?>" target="_blank" class="btn btn-primary btn-sm action-btn">View</a>
                                        </div>
                                        <div class="mb-1">
                                            <a href="editnews.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm action-btn">Edit</a>
                                        </div>
                                        <div class="mb-1">
                                            <a href="deletenews.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm ml-1 action-btn" onclick="return confirmDelete()">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 stretch-card mb-3">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Archive News</p>
                <div class="table-responsive">
                    <table id="archive-news-listing" class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Date Posted</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tbl_name = "news";
                            // Get archived news with status 2
                            $archive_posts = ORM::for_table("$tbl_name")->where('status', 2)->order_by_desc('id')->find_array();

                            foreach ($archive_posts as $i => $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $i + 1 ?></th>
                                    <td><?= $row['news_title']; ?></td>
                                    <td><?= $row['date']; ?></td>
                                    <td><?= $row['start_date']; ?></td>
                                    <td><?= $row['end_date']; ?></td>
                                    <td>
                                        <div class="mb-1">
                                            <a href="../news_post.php?id=<?= $row['id'] ?>" target="_blank" class="btn btn-primary btn-sm action-btn">View</a>
                                        </div>
                                        <div class="mb-1">
                                            <a href="editnews.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm action-btn">Edit</a>
                                        </div>
                                        <div class="mb-1">
                                            <a href="deletenews.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm ml-1 action-btn" onclick="return confirmDelete()">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#recent-listing').DataTable();
        $('#active-news-listing').DataTable();
        $('#archive-news-listing').DataTable(); // Initialize DataTable for archive news
    });

    function confirmDelete() {
        return confirm("Are you sure you want to delete this post?");
    }

    function closeCustomAlert(button) {
        button.parentNode.style.display = "none";
    }
</script>
