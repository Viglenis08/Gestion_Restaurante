<div class="modal fade" id="bebidas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar a las Mesas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <?php  
                            $consul = $conexion->conectar()->prepare("SELECT * FROM usuarios");
                            $consul->execute();
                            foreach ($consul as $key): ?>
                                <input type="hidden" name="usuario" value="<?php echo $key['idusuario'] ?>">
                            <?php endforeach ?>

                            <!-- Selección de categoría 1 -->
                            <?php             
                            $consul = $conexion->conectar()->prepare("SELECT * FROM productos pro JOIN categorias cat ON pro.idcategoria = cat.idcategoria   order by nombreproducto asc");
                            $consul->execute();
                            ?>
                            <select class="form-control chosen-select" id="categoria" name="producto[]">
                                <option value="" disabled selected>SELECCIONA UNA CATEGORÍA 1</option>
                                <?php
                                $consul = $conexion->conectar()->prepare("SELECT * FROM categorias");
                                $consul->execute();
                                foreach ($consul as $fila) {
                                    echo '<option value="' . $fila['idproducto'] . '-' . $fila['precio'] . '">' . ucwords($fila['nombrecategoria']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Selección de categoría 2 -->
                        <div class="col-md-6">
                            <?php             
                            $consul = $conexion->conectar()->prepare("SELECT
                            pro.idproducto,
                            pro.nombreproducto,
                            cat.nombrecategoria AS nombrecategoria_producto,
                            pro.precio,
                            pro.idusuario
                        FROM
                            productos pro
                        JOIN
                            categorias cat
                        ON
                            pro.idcategoria = cat.idcategoria
                        ORDER BY
                            pro.nombreproducto ASC;
                        ");
                            $consul->execute();
                            ?>
                            <select class="form-control chosen-select" id="categoria" name="producto[]">
                                <option value="" disabled selected>SELECCIONA UN PRODUCTO</option>
                                <?php
                                foreach ($consul as $fila) {
                                    echo '<option value="' . $fila['idproducto'] . '-' . $fila['precio'] . '">' . ucwords($fila['nombreproducto']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        
                        <!-- Botón de envío del formulario -->
                        <input type="hidden" name="fecha" value="<?php echo date('d-m-Y') ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="agregarBebidas" id="agregarBebidas" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
