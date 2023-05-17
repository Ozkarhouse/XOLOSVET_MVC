<div class="barra">
    <p>Usuario: <?php echo $nombre; ?></p>
    <a class="boton" href="/public/logout">Cerrar Sesion</a>
</div>

<?php if(isset($_SESSION['admin'])) { ?>
    <div class="barra-servicios">
        <a class="boton" href="/public/admin">Ver Citas</a>
        <a class="boton" href="/public/servicios">Ver Servicios</a>
        <a class="boton" href="/public/servicios/crear">Nuevo Servicios</a>
    </div>
<?php } ?>