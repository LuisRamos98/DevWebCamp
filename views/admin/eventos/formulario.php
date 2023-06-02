<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Evento</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre Evento</label>
        <input 
            class="formulario__input"
            type="text"
            name="nombre"
            id="nombre"
            placeholder="Nombre Evento"
            value="<?php echo $evento->nombre; ?>"
        >
    </div>
    
    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripcion Evento</label>
        <textarea 
            class="formulario__input"
            name="descripcion"
            id="descripcion"
            placeholder="Descripcion Evento"
            rows="8"
        ><?php echo $evento->descripcion;?></textarea>
    </div>
    
    <div class="formulario__campo">
        <label for="categoria_id" class="formulario__label">Categoria o Tipo de Evento</label>
        <select 
            class="formulario__select"
            name="categoria_id"
            id="categoria_id"
        >   
            <option value="" >- Seleccionar -</option>
            <?php foreach($categorias as $categoria):?>
                <option <?php echo ($evento->categoria_id == $categoria->id) ? 'selected' : ''; ?> value="<?php echo $categoria->id;?>"><?php echo $categoria->nombre;?></option>
            <?php endforeach;?>
        </select>
    </div>
        
    <div class="formulario__campo">
        <label class="formulario__label">Selecciona el día</label>

        <div class="formulario__radio">
            <?php foreach($dias as $dia):?>
                <div>
                    <label for="<?php echo strtolower($dia->nombre);?>">
                        <?php echo $dia->nombre?>
                    </label>
                    <input
                        type="radio"
                        name="dia"
                        id="<?php echo strtolower($dia->nombre);?>"
                        value="<?php echo $dia->id;?>"
                    >
                </div>
            <?php endforeach;?>

            <input type="hidden" value='' name="dia_id" >
        </div>
    </div>

    <div id="horas" class="formulario__campo">
        <label class="formulario__label">Seleccionar Hora</label>

        <ul id="horas" class="horas">
            <?php foreach($horas as $hora):?>
                <li data-hora-id='<?php echo $hora->id;?>' class="horas__hora horas__hora--deshabilitado"><?php echo $hora->hora;?></li>
            <?php endforeach;?>
        </ul>

        <input type="hidden" value='' name="hora_id" >
    </div>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>

    <div class="formulario__campo">
        <label for="ponentes" class="formulario__label">Ponente</label>
        <input 
            class="formulario__input"
            type="text"
            id="ponentes"
            placeholder="Buscar Ponente"
        >
        <ul class="listado-ponentes" id="listado-ponentes"></ul>

        <input type="hidden" name='ponente_id' value="">
    </div>

    <div class="formulario__campo">
        <label for="disponibles" class="formulario__label">Lugares Disponibles</label>
        <input 
            class="formulario__input"
            type="number"
            min='1'
            id="disponibles"
            name="disponibles"
            placeholder="Ej. 20"
            value='<?php echo $evento->disponibles;?>'
        >
    </div>
</fieldset>