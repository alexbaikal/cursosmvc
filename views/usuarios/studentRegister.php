<title>Registrar estudiante</title>

<style>
    body {
        font: 14px sans-serif;
    }

    .wrapper {
        width: 360px;
        padding: 20px;
    }
</style>

<link rel="stylesheet" href="./views/usuarios/componentes/styles/studentLogin.css">

<div class="wrapper">
    <h2>Registrar alumno</h2>
    <p>Rellene los campos para registrarse.</p>
    <form action="index.php?controller=Usuario&action=studentRegister" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>DNI</label>
            <input placeholder="DNI" title="DNI" type="text" name="DNI" class="form-control <?php echo (!empty($DNI_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $DNI; ?>">
            <span class="invalid-feedback"><?php echo $DNI_err; ?></span>
        </div>
        <div class="form-group">
            <label>Nombre</label>
            <input placeholder="Nombre" title="Nombre" type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
            <span class="invalid-feedback"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group">
            <label>Apellidos</label>
            <input placeholder="Apellidos" title="Apellidos" type="text" name="surname" class="form-control <?php echo (!empty($surname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $surname; ?>">
            <span class="invalid-feedback"><?php echo $surname_err; ?></span>
        </div>
        <div class="form-group">
            <label>Edad</label>
            <select class="form-control" name="age" id="age">
                <option value="">
                    <p>-- Escoger una edad --</p>
                </option>
                <?php for ($i = 1; $i <= 99; $i++) { ?>
                    <option value="<?php echo "$i"; ?>" <?php echo $age == $i ? 'selected' : ''; ?>><?php echo "$i"; ?></option>
                        <p><?php echo "$i"; ?></p>
                <?php }
                echo $age;
                echo "suka";
                ?>
                <span class="invalid-feedback"><?php echo $age_err; ?></span>
            </select>
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input placeholder="contraseña" title="contraseña" type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <label>Confirmar contraseña</label>
            <input placeholder="confirmar contraseña" title="confirmar contraseña" type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
        <p>Foto de perfil</p>
        <input style="margin-bottom: 20px;" type="file" name="uploadfile" <?php echo (!empty($upload_image_err)) ? 'is-invalid' : ''; ?>>
        <div class="form-group buttons">
            <br />
            <input type="submit" name="subbtn" class="btn btn-primary" value="Registrar">
            <input type="reset" class="btn btn-secondary ml-2" value="Borrar campos">
        </div>
        <p>¿Ya tienes una cuenta de estudiante? <a href="./index.php?controller=Usuario&action=studentLoginStart">Inicia sesión</a>.</p>
    </form>
</div>