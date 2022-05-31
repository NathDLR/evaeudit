<?php $this->setT('Page de connexion'); ?>
<script>
    history.replaceState('', '', '<?= URL ?>' + 'login');
</script>
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">

                    <!-- Nested Row within Card Body -->
                    <div>
                        <?php if(!empty($info)){ ?>
                            <div class="alert alert-danger" role="alert" style="margin-bottom: 0px !important; border-bottom-left-radius: 0px !important; border-bottom-right-radius: 0px !important;">
                                <?=  $info ?>
                            </div> <?php }
                        ?>
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="row justify-content-end" style="margin-right: 10px">
                                <a href="<?= URL ?>fr" ><img src="<?= URL ?>public/img/fr.svg" width="20px"></a>
                                <a href="<?= URL ?>en" style="margin-left: 5px"><img src="<?= URL ?>public/img/en.svg" width="20px"></a>
                            </div>
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><?= lang['Welcome'] ?></h1>
                                </div>
                                <p><?= lang['Online Audit'] ?></p>
                                <form action="<?= URL ?>auth/log" class="user" method="POST">
                                    <div class="form-group">
                                        <input type="username" name="username" class="form-control form-control-user"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="<?= lang['Enter username'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                               id="exampleInputPassword" placeholder="<?= lang['Enter password'] ?>" required>
                                    </div>
                                    <!--<div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck" >
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>-->
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="<?= lang['Login'] ?>">
                                </form>
                                <hr>
<!--                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>-->
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>