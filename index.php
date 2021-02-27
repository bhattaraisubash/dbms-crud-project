<?php
include('header.php'); ?>

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
            $students = array(
                array(),
                array(),
                array(),
                array(),
                array()
            );
            $index = 0;
            foreach ($students as $student) { ?>
                <tr>
                    <th scope="row">Test Name</th>
                    <td>PUR074BCT044</td>
                    <td>523453252</td>
                    <td>test@gmail.com</td>
                    <td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view<?= $index ?>">
                            View
                        </button>
                        <div class="modal fade" id="view<?= $index ?>" tabindex="-1" aria-labelledby="viewmodal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewmodal">Test Name</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Name: Test Name</li>
                                            <li class="list-group-item">Roll No: HJLFDHALJ</li>
                                            <li class="list-group-item">Phone: 0y80707089</li>
                                            <li class="list-group-item">Email: fdlaksh@fdah.com</li>
                                            <li class="list-group-item">Address: Nepal, State 2, City, Street Address</li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="edit.php?id=1" class="btn btn-primary">Edit</a>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $index ?>">
                            Delete
                        </button>
                        <div class="modal fade" id="delete<?= $index ?>" tabindex="-1" aria-labelledby="deletemodal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deletemodal">Are you sure ?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Once confirmed, it can not be undone.
                                        <form class="d-none" id="delete-form-<?= $index ?>" action="delete.php" method="POST">
                                            <input type="hidden" value="1" name="id" />
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" onclick="(function(){
                                            document.getElementById('delete-form-<?= $index ?>').submit();
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
                $index++;
            }
            ?>
        </tbody>
    </table>



</div>

<?php
include('footer.php');
?>