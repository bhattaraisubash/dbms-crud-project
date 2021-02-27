<?php
session_start();
if (!isset($_SESSION['status']) && !isset($_SESSION['username']) && !isset($_SESSION['token'])) {
    header('Location: ./login.php');
    exit;
} else {
    if (
        isset($_POST['new_entry']) && isset($_POST['name']) && isset($_POST['roll']) &&
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

        if (
            $name != null && $email != null && $phone != null && $nation != null &&
            $state != null && $city != null && $street != null
        ) {
            include('config/db.php');
            $query = "INSERT INTO address(nation,state,city,street) VALUES('$nation', '$state', '$city', '$street');";
            if (mysqli_query($conn, $query)) {
                $last_id = mysqli_insert_id($conn);
                $query = "INSERT INTO students(name,roll_no, email,phone,address_id) 
                            VALUES('$name', '$roll', '$email','$phone','$last_id');";
                if (mysqli_query($conn, $query)) {
                    $success = "New Entry Successful !";
                }else{
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
                    <div class="mb-3">
                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" required autocomplete="off" placeholder="Full Name">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="roll" required autocomplete="off" placeholder="Roll Number">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row col-md-12">
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email" required autocomplete="off" placeholder="Email Address">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone" required autocomplete="off" placeholder="Phone">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="Nepal" name="nation" required autocomplete="off" placeholder="Nation">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="state" required autocomplete="off" placeholder="State" min="1" max="7">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="city" required autocomplete="off" placeholder="City">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row col-md-12">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="street" required autocomplete="off" placeholder="Street Address">
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" name="new_entry" value="Submit">
                </form>
            </div>
        </div>

    </div>
<?php include('footer.php');
}
?>