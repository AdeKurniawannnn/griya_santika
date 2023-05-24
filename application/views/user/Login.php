<section>
    <div class="form-box">
        <div class="form-value">
            <form class="user" method="post" action="<?= base_url('Login/action'); ?>">
                <h2>LOGIN</h2>
                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="Email" value="<?= set_value('email'); ?>" id="email" name="email">
                    <?= form_error(
                        'email',
                        '<small class="text-danger pl-3">',
                        '</small>'
                    ); ?>
                    <label for="email">Email</label>
                </div>
                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" id="password" name="password1">
                    <?= form_error(
                        'password1',
                        '<small class="text-danger pl-3">',
                        '</small>'
                    ); ?>
                    <label for="password">Password</label>
                </div>
                <div class="forget">
                    <label for=""><input type="checkbox">Remember Me <a href="">Forget Password</a></label>

                </div>
                <button>Log in</button>
                <div class="register">
                    <p>Don't have account <a href="<?php echo base_url('registrasi_user') ?>">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</section>