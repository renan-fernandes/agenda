<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="col-md-11" style="text-align:center;background-color:#262626;color:#FFF;">
	<h1>Agendador de Tarefas</h1>
</div>

<div class="row">
	<div style="padding-left:25px;">
		<div id="calendario"></div>
	</div>
	<div class="col-md-8">
		<div class="form-row" style="background-color:#e1e3ef;">	
			
			<div class="col-md-12" style="text-align:center;margin-top:10px;"><label for="textoConteudo" id="titulo">Compromissos do dia <span id="diaSelecionado"></span></label><hr></div>
		
			<div class="col-md-12" id="divCabecalho" style="text-align:left;margin-top:5px;">
				<label id="cabecalhoDia">Horários:</label>
			</div>
			<div class="form-group col-md-12">
				<br>
				<button type="button" class="btn btn-light horario" id="6" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="6">06:00</button>
				<button type="button" class="btn btn-light horario" id="7" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="7">07:00</button>
				<button type="button" class="btn btn-light horario" id="8" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="8">08:00</button>
				<button type="button" class="btn btn-light horario" id="9" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="9">09:00</button>
				<button type="button" class="btn btn-light horario" id="10" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="10">10:00</button>
				<button type="button" class="btn btn-light horario" id="11" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="11">11:00</button>
				<button type="button" class="btn btn-light horario" id="12" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="12">12:00</button>
				<button type="button" class="btn btn-light horario" id="13" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="13">13:00</button>
				<button type="button" class="btn btn-light horario" id="14" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="14">14:00</button>
				<button type="button" class="btn btn-light horario" id="15" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="15">15:00</button>
				<button type="button" class="btn btn-light horario" id="16" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="16">16:00</button>
				<button type="button" class="btn btn-light horario" id="17" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="17">17:00</button>
				<button type="button" class="btn btn-light horario" id="18" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="18">18:00</button>
				<button type="button" class="btn btn-light horario" id="19" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="19">19:00</button>
				<button type="button" class="btn btn-light horario" id="20" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="20">20:00</button>
				<button type="button" class="btn btn-light horario" id="21" onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="21">21:00</button>
				<button type="button" class="btn btn-light horario" id="22"onclick="carregaCompromisso(this.value);guardaHora(this.value);" value="22">22:00</button><br>
				Primeiro, clique em algum dos horários para então visualizar, criar, editar ou excluir alguma tarefa.
			</div>
			
			<div class="form-group col-md-11" style="margin-left:10px;">
				<input type="hidden" id="horaSelec"></input>
				<input type="hidden" id="idTarefa"></input>
				<textarea class="form-control" id="textoConteudo" rows="10"></textarea>
				
				<button type="button" class="btn btn-outline-success" id="bt-add" style="display:none;" onclick="salvarTarefa();">Salvar Tarefa</button>
				<button type="button" class="btn btn-outline-primary" id="bt-alt" style="display:none;" onclick="editarTarefa();">Salvar Alterações</button>
				<button type="button" class="btn btn-outline-danger" id="bt-exc" style="display:none;" onclick="excluirTarefa();">Excluir Tarefa</button>
				<div class="alert alert-danger " id="alertaVazio" role="alert" style="display:none;height:10px!important;">
					A tarefa precisar ser preenchida!
				</div>
				<div class="alert alert-danger " id="alertaId" role="alert" style="display:none;height:10px!important;">
					Selecione alguma tarefa para edição!
				</div>
			</div>
		
		</div>
  	</div>
</div>

</body>
