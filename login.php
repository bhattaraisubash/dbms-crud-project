<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['username']) && isset($_SESSION['token'])) {
    header('Location: ./index.php');
    exit;
} else {
    if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])) {
        include('functions.php');
        include('config/db.php');

        $username = validate($_POST['username']);
        $password = validate($_POST['password']);
        $query = "SELECT * FROM admins WHERE username LIKE '" . $username . "';";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if(password_verify($password, $row['password'])){
                    mysqli_close($conn);
                    //login successful
                    $_SESSION['status'] = 'logged in';
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['token'] = rand(1000, 99999999999999); //just random token
                    header('Location: ./index.php');
                }
            }
        } else {
            $error = "Invalid Credentials !";
        }
    }
}

include('header.php'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-4 mx-auto bg-light p-5">
            <p>Please Login To Continue !</p>
            <?php if (isset($error) && !empty($error)) : ?>
                <div class="error bg-danger">
                    <?=$error; ?>
                    <?php unset($error); ?>
                </div>
            <?php endif; ?>
            <hr />
            <form class="content-justify-center" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required autocomplete="off">
                </div>
                <input type="submit" class="btn btn-primary" name="login" value="Login">
            </form>
        </div>
    </div>
</div>

<?php
include('footer.php');

?>