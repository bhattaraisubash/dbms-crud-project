<?php
session_start();
if (!isset($_SESSION['status']) && !isset($_SESSION['username']) && !isset($_SESSION['token'])) {
    header('Location: ./login.php');
    exit;
} else {
    include('config/db.php');
    
    if (
        isset($_POST['update']) && isset($_POST['name']) && isset($_POST['roll']) &&
        isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['nation']) &&
        isset($_POST['state']) && isset($_POST['city']) && isset($_POST['street'])
    ) {

        include('functions.php');
        $name = validate($_POST['name']);
        $roll = validate($_POST['roll']);
        $email = validate($_POST['email']);
        $phone = validate($_POST['phone']);
        $nation = validate($_POST['nation']);
        $state = validate($_POST['state']);
        $city = validate($_POST['city']);
        $street = validate($_POST['street']);

        $id = validate($_POST['id']);
        $address_id = validate($_POST['address_id']);

        if (
            $name != null && $email != null && $phone != null && $nation != null &&
            $state != null && $city != null && $street != null
        ) {
            $query = "UPDATE address SET nation='$nation', city='$city', state='$state', street='$street' WHERE id='$address_id';";
            if (mysqli_query($conn, $query)) {
                $last_id = mysqli_insert_id($conn);
                $query = "UPDATE students SET name='$name', roll_no='$roll', email='$email', phone='$phone' WHERE id='$id';";
                if (mysqli_query($conn, $query)) {
                    $success = "Update Successful !";
                } else {
                    $error = "Oops! Something went wrong.";
                }
            } else {
                $error =
                    "Oops! Something went wrong.";
            }
            mysqli_close($conn);
        } else {
            $error = "Error: Some Values Are Empty !";
        }
    }
    $query = "SELECT S.*, A.nation, A.city, A.state, A.street
     FROM students as S INNER JOIN address as A 
     ON S.address_id = A.id WHERE S.id = " . $_GET['id'] . ";";
    $result = mysqli_query($conn, $query);
    $student = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $student = $row;
        }
    } else {
        header('Location: ./index.php');
        exit;
    }
    include('header.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6 mx-auto bg-light p-5">
                <p>New Entry Form</p>
                <?php if (isset($error) && !empty($error)) : ?>
                    <div class="error bg-danger">
                        <?= $error; ?>
                        <?php unset($error); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($success) && !empty($success)) : ?>
                    <div class="success bg-success">
                        <?= $success; ?>
                        <?php unset($success); ?>
                    </div>
                <?php endif; ?>
                <hr />
                <form class="content-justify-center" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <input type="hidden" name="id" value="<?= $student['id'] ?>">
                    <input type="hidden" name="address_id" value="<?= $student['address_id'] ?>">
                    <div class="mb-3">
                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" required autocomplete="off" placeholder="Full Name" value="<?= $student['name'] ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="roll" required autocomplete="off" placeholder="Roll Number" value="<?= $student['roll_no'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row col-md-12">
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email" required autocomplete="off" placeholder="Email Address" value="<?= $student['email'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone" required autocomplete="off" placeholder="Phone" value="<?= $student['phone'] ?>">
                            </div>
                            <div class=" col-md-6">
                                <input type="text" class="form-control" value="Nepal" name="nation" required autocomplete="off" placeholder="Nation" value="<?= $student['nation'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="state" required autocomplete="off" placeholder="State" min="1" max="7" value="<?= $student['state'] ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="city" required autocomplete="off" placeholder="City" value="<?= $student['city'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row col-md-12">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="street" required autocomplete="off" placeholder="Street Address" value="<?= $student['street'] ?>">
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" name="update" value="Update">
                </form>
            </div>
        </div>

    </div>
<?php include('footer.php');
}
?>