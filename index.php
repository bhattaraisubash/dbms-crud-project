<?php
session_start();
if (!isset($_SESSION['status']) || !isset($_SESSION['username']) || !isset($_SESSION['token'])) {
    header('Location: ./login.php');
    exit;
}
include('header.php');
include('config/db.php');

$query = "SELECT S.*, A.nation, A.city, A.state, A.street FROM students as S INNER JOIN address as A ON S.address_id = A.id ORDER BY S.id DESC;";
$result = mysqli_query($conn, $query);
$students = array();
while ($arr = mysqli_fetch_assoc($result)) {
    $students[] = $arr;
}
mysqli_close($conn);
?>

<div class="container mt-4">

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Roll No.</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($students as $student) { ?>
                <tr>
                    <th scope="row"><?= $student['name']; ?></th>
                    <td><?= $student['roll_no']; ?></td>
                    <td><?= $student['email']; ?></td>
                    <td><?= $student['phone']; ?></td>
                    <td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view<?= $student['id'] ?>">
                            View
                        </button>
                        <div class="modal fade" id="view<?= $student['id'] ?>" tabindex="-1" aria-labelledby="viewmodal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewmodal"><?= $student['name'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Name: <?= $student['name'] ?></li>
                                            <li class="list-group-item">Roll No: <?= $student['roll_no'] ?></li>
                                            <li class="list-group-item">Phone: <?= $student['phone'] ?></li>
                                            <li class="list-group-item">Email: <?= $student['email'] ?></li>
                                            <li class="list-group-item">Address: <?= $student['street'] . ', ' . $student['city'] . ', State-' . $student['state'] . ', ' . $student['nation'] ?></li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="edit.php?id=<?= $student['id'] ?>" class="btn btn-primary">Edit</a>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $student['id'] ?>">
                            Delete
                        </button>
                        <div class="modal fade" id="delete<?= $student['id'] ?>" tabindex="-1" aria-labelledby="deletemodal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deletemodal">Are you sure ?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Once confirmed, it can not be undone.
                                        <form class="d-none" id="delete-form-<?= $student['id'] ?>" action="delete.php" method="POST">
                                            <input type="hidden" value="<?= $student['id'] ?>" name="id" />
                                            <input type="hidden" value="<?= $student['address_id'] ?>" name="address_id" />
                                            <input type="hidden" value="<?= $_SESSION['token'] ?>" name="delete" />
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" onclick="(function(){
                                            document.getElementById('delete-form-<?= $student['id'] ?>').submit();
                                        })(); return false;">
                                            Confirm
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>



</div>

<?php
include('footer.php');
?>