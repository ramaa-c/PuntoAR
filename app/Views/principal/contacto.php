<?= view('layout/header', ['titulo' => 'Contacto - PuntoAR', 'estilos' => ['contacto.css']]) ?>
<?= view('layout/navbar') ?>
    <div class="contact-wrapper">
        
        <div class="contact-content">
            <h1>Contacto</h1>
            <div class="contact-grid">
                <div class="contact-info">
                    <p class="schedule">
                        Horario de atención de Lunes a Viernes de 10 a 19hs. Sábados, Domingos y feriados cerrado.
                    </p>
                    
                    <div class="contact-details">
                        <p><i class="fa-solid fa-phone"></i>  54 9112-2534520</p>
                        <p><i class="fa-brands fa-whatsapp"></i>  11 2253-4520 - Solo Whatsapp</p>
                        <p><i class="fa-solid fa-envelope"></i>  PuntoAR@gmail.com</p>
                        <p><i class="fa-solid fa-location-dot"></i>  La Punta, San Luis</p>
                    </div>
                </div>

                <form class="contact-form" action="<?= site_url('/contactar') ?>" method="POST">
                    
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" placeholder="ej: María Perez">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="ej: tuemail@email.com">
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" placeholder="ej: 1123445567">
                    </div>

                    <div class="form-group">
                        <label for="mensaje">Mensaje</label>
                        <textarea id="mensaje" name="mensaje" rows="6" placeholder="ej: Tu mensaje"></textarea>
                    </div>

                    <div class="h-captcha-container">
                        <div class="h-captcha" data-sitekey="YOUR_SITE_KEY"></div> 
                    </div>

                    <div class="form-msg-container">
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="form-msg msg-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('errors')):
                            $errors = session()->getFlashdata('errors');
                            if (is_array($errors)):
                                foreach($errors as $error): ?>
                                    <div class="form-msg msg-error">
                                        <?= esc($error) ?>
                                    </div>
                                <?php endforeach;
                            else: ?>
                                <div class="form-msg msg-error">
                                    <?= esc($errors) ?>
                                </div>
                            <?php endif;
                        endif; ?>
                    </div>

                    <button type="submit">Enviar</button>
                </form>
    
            </div>
        </div>
    </div>
<?= view('layout/footer') ?>
