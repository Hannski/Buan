<?php ?>

<div class="container">
    <div class="row p-3">
        <div class="card col-12 p-0">
            <div class="card-header">
                <h5><?php echo $langArray[$opt]['pwForgot']; ?></h5>
            </div>
            <form action="" method="post">
                <div class="card-body">

                    <div class="form-row">
                        <!--   Infobox-->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
                            <p class="p-3">
                               <?php echo $langArray[$opt]['howToRec']; ?>
                            </p>
                        </div>
<!--                        Eingabe Username-->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <label for="username"><?php echo $langArray[$opt]['username']; ?></label>
                            <input type="text" id="username" name="username" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <button type="submit" class="btn btn-outline-secondary" name="forgotPw">
                            <?php echo $langArray[$opt]['requestNew']; ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
