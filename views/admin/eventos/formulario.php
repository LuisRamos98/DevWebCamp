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
        ></textarea>
    </div>
    
    <div class="formulario__campo">
        <label for="categoria_id" class="formulario__label">Categoria o Tipo de Evento</label>
        <select 
            class="formulario__select"
            name="categoria"
            id="categoria_id"
        >   
            <option value="" >- Seleccionar -</option>
            <?php foreach($categorias as $categoria):?>
                <option value="<?php echo $categoria->id;?>"><?php echo $categoria->nombre;?></option>
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
        </div>
    </div>

    <div id="horas" class="formulario__campo">
        <label class="formulario__label">Seleccionar Hora</label>

        <ul class="horas">
            <?php foreach($horas as $hora):?>
                <li class="horas__hora"><?php echo $hora->hora;?></li>
            <?php endforeach;?>
        </ul>
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
        >
    </div>
</fieldset>