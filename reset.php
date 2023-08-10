<!DOCTYPE html>
<?php

    require 'function.php';
	if (isset($_GET["key"]) && isset($_GET["id"]) && isset($_GET["action"]) && ($_GET["action"]=="reset") && !isset($_POST["action"]))
	{
		$key = $_GET["key"];
		$id = $_GET["id"];
		
		$curDate = date("Y-m-d H:i:s");
		$query = "SELECT * FROM restart_token WHERE email='$id' AND token='$key'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_num_rows($result);
		
		if (!mysqli_fetch_assoc($result))
		{
			// goto html;
		}
        else
        {
?>
            <html lang="en">
                <head>
                    <meta charset="utf-8" />
                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                    <meta name="description" content="" />
                    <meta name="author" content="" />
                    <title>cosmetic modern</title>
                    <link href="css/styles.css" rel="stylesheet" />
                    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
                </head>
                <body class="bg-primary">
                    <div id="layoutAuthentication">
                        <div id="layoutAuthentication_content">
                            <main>
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Reset Password</h3></div>
                                                <div class="card-body">
                                                    <form method="POST">
                                                        <input type="hidden" class="form-control form-control-xl" name="email" value="<?=$id?>" readonly>
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <div class="form-floating mb-3 mb-md-0">
                                                                    <label for="new password">Password</label>
                                                                    <input class="form-control" id="new password" name="new_password" type="password" placeholder="Create a password" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating mb-3 mb-md-0">
                                                                    <label for="confirm password">Confirm Password</label>
                                                                    <input class="form-control" id="confirm password" name="confirm_password" type="password" placeholder="Confirm password" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-4 mb-0">
                                                            <div class="d-grid"><button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit" name="update">Submit</button></div>
                                                        </div>
                                                         <!-- Change Password -->
                                                        <?php
                                                            if(isset($_POST["update"]))
                                                            {
                                                                // cek apakah data berhasil di ubah atau tidak
                                                                if(change_password($_POST) > 0)
                                                                {
                                                                    echo "
                                                                        <script>
                                                                            alert('Password berhasil diubah!');
                                                                            document.location.href = 'login.php';
                                                                        </script>
                                                                    ";
                                                                }
                                                                else
                                                                {
                                                                    $error = true;
                                                                }
                                                            }
                                                        ?>
                                                        <!-- Change Password -->
                                                    </form>
                                                </div>
                                                <div class="card-footer text-center py-3">
                                                    <!-- <div class="small"><a href="login.html">Have an account? Go to login</a></div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>
                        <div id="layoutAuthentication_footer">
                            <footer class="py-4 bg-light mt-auto">
                                <div class="container-fluid px-4">
                                    <div class="d-flex align-items-center justify-content-between small">
                                        <div class="text-muted">Copyright &copy; Cosmetic Modern Website 2023</div>
                                        <div>
                                            <a href="#">Privacy Policy</a>
                                            &middot;
                                            <a href="#">Terms &amp; Conditions</a>
                                        </div>
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                    <script src="js/scripts.js"></script>
                </body>
            </html>
<?php
        }
    }
?>
