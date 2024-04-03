<?php include "header.php"; ?>

<div class="row">
    <div class="col-md-12 stretch-card mb-4">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Upcoming Events</p>
                <?php if (get("success")): ?>
                    <div class="custom-alert custom-alert-success">
                        <button class="custom-alert-close" onclick="closeCustomAlert(this)">X</button>
                        <span class="custom-alert-message">Success</span>
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
                    <table id="upcoming-events" class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Venue</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tbl_name = "events";

                            // Get upcoming events (events with dates on or after the current date)
                            $get_upcoming_events_tbl = ORM::for_table("$tbl_name")->where_gte('date', date('Y-m-d'))->order_by_desc('id')->find_array();

                            foreach ($get_upcoming_events_tbl as $i => $row) {
                                // Convert time to 12-hour format
                                $time_12hr = date("h:i A", strtotime($row['time']));
                            ?>

                            <tr>
                                <th scope="row"><?= $i + 1 ?></th>
                                <td><?= $row['title']; ?></td>
                                <td><?= $row['date']; ?></td>
                                <td><?= $time_12hr; ?></td> <!-- Display time in 12-hour format -->
                                <td><?= $row['venue']; ?></td>
                                <td>
                                    <a href="../event-detail.php?id=<?= $row['id'] ?>" target="_blank" class="btn btn-primary action-btn">View</a>
                                    <a href="edit-event.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm action-btn">Edit</a>
                                    <a href="deleteevent.php?id=<?= $row['id'] ?>" class="btn btn-danger action-btn" onclick="return confirmDelete()">Delete</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Past Events</p>
                <div class="table-responsive">
                    <table id="past-events" class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Venue</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Get past events (events with dates before the current date)
                            $get_past_events_tbl = ORM::for_table("$tbl_name")->where_lt('date', date('Y-m-d'))->order_by_desc('id')->find_array();

                            foreach ($get_past_events_tbl as $i => $row) {
                                // Convert time to 12-hour format
                                $time_12hr = date("h:i A", strtotime($row['time']));
                            ?>

                            <tr>
                                <th scope="row"><?= $i + 1 ?></th>
                                <td><?= $row['title']; ?></td>
                                <td><?= $row['date']; ?></td>
                                <td><?= $time_12hr; ?></td> <!-- Display time in 12-hour format -->
                                <td><?= $row['venue']; ?></td>
                                <td>
                                    <a href="../event-detail.php?id=<?= $row['id'] ?>" target="_blank" class="btn btn-primary action-btn">View</a>
                                    <a href="edit-event.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm action-btn">Edit</a>
                                    <a href="deleteevent.php?id=<?= $row['id'] ?>" class="btn btn-danger action-btn" onclick="return confirmDelete()">Delete</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#upcoming-events').DataTable();
        $('#past-events').DataTable();
    });

    function confirmDelete() {
        return confirm("Are you sure you want to delete this event?");
    }

    function closeCustomAlert(button) {
        button.parentNode.style.display = "none";
    }
</script>
