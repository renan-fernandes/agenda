$(document).ready(function() {
	var data = new Date();
	var dia     = data.getDate();
	var dia     = ("0" + dia).slice(-2);
	var mes     = data.getMonth()+1;
	var mes     = ("0" + mes).slice(-2);
	var ano     = data.getFullYear();
	$("#diaSelecionado").html(dia+"/"+mes+"/"+ano);
	edicao(dia+"/"+mes+"/"+ano);
});

$(function() {
	$("#calendario").datepicker({
		onSelect: function(value, date) { 
			edicao(value);
		},
		
		autoSize: true,
		
		changeMonth: true,
		changeYear: true,
		
		dateFormat: 'dd/mm/yy',
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'] 
	});
});

function edicao(value)
{
	$("#diaSelecionado").html(value);
	$("#textoConteudo").val("");
	$("#idTarefa").val("");
	
	$("#bt-add").css("display", "none");
	$("#bt-alt").css("display", "none");
	$("#bt-exc").css("display", "none");	
	
	$.ajax({
		type: "post",
		url: "ajax.php",
		data: "data="+value,
		success: function(result)
		{
			if(result == 0)
			{
				$(".horario").removeClass( "btn" );
				$(".horario").removeClass( "btn-warning" );
				$(".horario").addClass( "btn btn-light" );
			}
			else
			{
				var obj = JSON.parse(result);	
				
				$.each(obj, function(index, value) {					
					$(".horario").removeClass( "btn" );
					$(".horario").removeClass( "btn-warning" );
					$(".horario").addClass( "btn btn-light" ); 
				});
				
				$.each(obj, function(index, value) {					
					$("#"+value.horario).removeClass( "btn" );
					$("#"+value.horario).removeClass( "btn-light" );
					$("#"+value.horario).addClass( "btn btn-warning" ); 
				});
			}
		},
		error: function($result)
		{
			alert("error");
		}		
	});
}

function carregaCompromisso(value, salvo = null)
{	
	$("#alertaVazio").css("display", "none");	
	$("#alertaId").css("display", "none");
	
	var hora = value;
	var data = $("#diaSelecionado").text();
	
	$.ajax({
		type: "post",
		url: "ajax.php",
		data: "data="+data+"&hora="+hora+"&function=data_e_hora",
		success: function(resultado){
			if(resultado == 0)
			{
				$("#textoConteudo").val("");
				$("#bt-add").css("display", "inline");
				$("#bt-alt").css("display", "none");
				$("#bt-exc").css("display", "none");
				
				$("#idTarefa").val("");
			}
			else
			{					
				$("#"+hora).removeClass( "btn" );
				$("#"+hora).removeClass( "btn-light" );
				$("#"+hora).addClass( "btn btn-warning" );			
				
				if(salvo == 1)
				{
					$("#bt-add").css("display", "none");
					$("#bt-alt").css("display", "none");
					$("#bt-exc").css("display", "none");
				
					$("#idTarefa").val("");
				}
				else
				{					
					$("#bt-add").css("display", "none");
					$("#bt-alt").css("display", "inline");
					$("#bt-exc").css("display", "inline");
				}
				
				var ob = JSON.parse(resultado);
				$("#textoConteudo").val("");
				$("#textoConteudo").val(ob[0].conteudo);
				
				$("#idTarefa").val(ob[0].id);
			}			
		},
		error: function(){
			alert(resultado);		
		}
	});	 
}

function guardaHora(value)
{
	$("#horaSelec").val(value);
}

function salvarTarefa()
{
	if($("#textoConteudo").val() == "")
	{
		$("#alertaVazio").css("display", "inline");
	}
	else
	{
		$("#alertaVazio").css("display", "none");
		var hora = $("#horaSelec").val();
		var data = $("#diaSelecionado").text();
		var conteudo = $("#textoConteudo").val();
		$.ajax({
			type: "post",
			url: "ajax.php",
			data: "hora="+hora+"&data="+data+"&conteudo="+conteudo+"&function=salvar",
			success: function(resposta) {
				var salvo = 1;
				carregaCompromisso(hora, salvo);
			},
			error: function(resposta) {
				alert(resposta);
			}		
		}); 
	}
}

function excluirTarefa()
{
	$("#alertaVazio").css("display", "none");	
	$("#alertaId").css("display", "none");
	
	var id = $("#idTarefa").val();
	$.ajax({
		type: "post",
		url: "ajax.php",
		data: "id="+id+"&function=excluir",
		success: function(retorno){
			$("#bt-add").css("display", "none");
			$("#bt-alt").css("display", "none");
			$("#bt-exc").css("display", "none");
			
			edicao($("#diaSelecionado").text());		
		},
		error: function(retorno){
			alert(retorno);
		}	
	});	 
}

function editarTarefa()
{
	var id = $("#idTarefa").val();
	if(id == "")
	{
		$("#alertaId").css("display", "inline");	
	}
	else 
	{
		$("#alertaId").css("display", "none");
		if($("#textoConteudo").val() == "")
		{
			$("#alertaVazio").css("display", "inline");
		}
		else
		{
			$("#alertaVazio").css("display", "none");			
			var hora = $("#horaSelec").val();
			var data = $("#diaSelecionado").text();
			var conteudo = $("#textoConteudo").val();

			$.ajax({
				type: "post",
				url: "ajax.php",
				data: "id="+id+"&hora="+hora+"&data="+data+"&conteudo="+conteudo+"&function=editar",
				success: function(response){
					$("#bt-add").css("display", "none");
					$("#bt-alt").css("display", "none");
					$("#bt-exc").css("display", "none");
					$("#textoConteudo").val("");
				},
				error: function(response)
				{
					alert(response);
				}		
			});
		}
	}
}

