<?php ?>

<div class="container">
    <div class="row p-3">
        <div class="card col-12 p-0">
            <div class="card-header">
                <h5>Passowrt vergessen</h5>
            </div>
            <form action="" method="post">
                <div class="card-body">

                    <div class="form-row">
                        <!--   Infobox-->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
                            <p class="p-3">
                                geben Sie hier iHren usernamen ien, wir informaieren sie per email.
                                !achtung ihr altes passwort ist damit nihctmehr gueltig!
                            </p>
                        </div>
<!--                        Eingabe Username-->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <label for="username"><?php echo $langArray[$opt]['username']; ?></label>
                            <input type="text" id="username" name="username" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <button type="submit" class="btn btn-outline-secondary" name="forgotPw">neues Passwort beantragen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
