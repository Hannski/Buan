
</div>
<!--ende main-->
</div>
<div class="footer">
<!--    abfrage wer was sehen darf -->
    <?php

    if( array_key_exists('admin',$_SESSION) || array_key_exists('super',$_SESSION)) {

    }else
    {
        ?>

        <button class="btn btn-outline-success my-2 my-sm-0">
            <a class="" href="admin-login">
                <?php echo $langArray[$opt]['redirectAdminLogin'] ?>
            </a>
        </button>
        <?php
    }
    ?>
</div>
<!-- Ende Wrapper -->
</body>
</html>