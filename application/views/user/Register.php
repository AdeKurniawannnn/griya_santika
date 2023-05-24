<section>
    <div class="form-box">
        <div class="form-value">
            <form class="admin" method="post" action="<?= base_url('registrasi_user/insert'); ?>">
                <h2>REGISTER</h2>
                <div class="inputbox">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    <input type="text" id="nama" name="nama" value="<?= set_value('nama'); ?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    <label for="">Nama Lengkap</label>
                </div>
                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="text" id="email" name="email" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    <label for="">Email</label>
                </div>
                <div class="inputbox">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    <input type="text" id="nama" name="nama" value="<?= set_value('nama'); ?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    <label for="">No Telp</label>
                </div>
                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" id="password1" name="password1">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    <label for="">Password</label>
                </div>
                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" id="password2" name="password2">
                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                    <label for="">Comfirm Password</label>
                </div>
                <button name="submit">Register</button>
                <div class="register">
                    <p>have account <a href="<?php echo base_url('Login') ?>">Log in</a></p>
                </div>
            </form>
        </div>
    </div>
</section>