<?php include "header.php"; ?>
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">All News and Stories</p>

                <?php if (get("success")): ?>
                    <div class="custom-alert custom-alert-success">
                        <button class="custom-alert-close" onclick="closeCustomAlert(this)">X</button>
                        <span class="custom-alert-message"> Success</span>
                    </div>
                <?php endif; ?>

                <style>
                    .action-btn {
                        width: 100px; /* Adjust the width as needed */
                    }  

                    th {
                        padding: 40px; /* Adjust this value to change the padding */
                        text-align: left; /* Align text as needed */
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
                                    <td>
                                        <a href="../news_post.php?id=<?= $row['id'] ?>" target="_blank" class="btn btn-primary btn-sm action-btn">View</a>
                                        <a href="editnews.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm action-btn">Edit</a>
                                        <a href="deletenews.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm ml-1 action-btn" onclick="return confirmDelete()">Delete</a>
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
    });

    function confirmDelete() {
        return confirm("Are you sure you want to delete this post?");
    }

    function closeCustomAlert(button) {
        button.parentNode.style.display = "none";
    }
</script>
