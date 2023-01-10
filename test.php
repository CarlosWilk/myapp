<?php


?>

<div class="card-body">
        <div class="form-row">
            <div class="col-2">
                <h5 class="card-title"><b>Área de Atendimento</b></h5>

                <select class="form-control" name="ATEND_AREA" onchange="preencheCampo(this);">
                    <option value=" "> </option>

                    <option value="usuarioteste">T.I. Infraestrutura</option> //selecionada

                    <option value="anderson.mendes">T.I. Sistema</option>

                    <option value="gabrielbarbuto">Fluig</option>
                </select>
            </div>
        </div>

//opção selecionada no campo select escreve no campo text 

        <div class="form-row">
            <div class="col-2">
                <h5 class="card-title"><b>Usuário</b></h5>
                <input class="form-control" name="ATEND_USU" type="text"> //escreve: "usuarioteste"
            </div>
        </div>
    </div>

    <script>
function preencheCampo(el){
    console.log("test");
    let value = $(el).val();

    $('input[name="ATEND_USU"]').val(value);
}

    </script>