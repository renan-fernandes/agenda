<?php

require_once("config.php");

if(isset($_POST["function"]) && !is_null($_POST["function"]) && $_POST["function"] == "salvar")
{
	salvar($_POST["data"], $_POST["hora"], $_POST["conteudo"]);	
}
elseif(isset($_POST["function"]) && !is_null($_POST["function"]) && $_POST["function"] == "editar")
{
	editar($_POST["id"], $_POST["data"], $_POST["hora"], $_POST["conteudo"]);	
}
elseif(isset($_POST["function"]) && !is_null($_POST["function"]) && $_POST["function"] == "excluir")
{
	excluir($_POST["id"]);	
}
elseif(isset($_POST["function"]) && !is_null($_POST["function"] == "data_e_hora"))
{
	loadByDataAndHora($_POST["data"], $_POST["hora"]);
} 
else
{
	if(isset($_POST["data"]) && !is_null($_POST["data"]))
	{
		loadByData($_POST["data"]);
	}
}

function loadByData($data)
{
	$sql = new Sql();
	$results = $sql->select("SELECT * FROM tb_compromissos WHERE data = :DATA", array(
		":DATA" => $data
	));
	
	if(count($results) > 0)
	{
		$x = 0;
		foreach($results as $res)
		{
			foreach($res as $key => $value)
			{
				$res[$key] = utf8_encode($value);
			}  
			$results[$x] = $res;
			$x++;
		}
		$dados = setData($results);
		echo $dados;
	}
}

function loadByDataAndHora($data, $hora)
{
	$sql = new Sql();
	$resultados = $sql->select("SELECT * FROM tb_compromissos WHERE data = :DATA and horario = :HORA", array(
		":DATA" => $data,
		":HORA" => $hora
	));
	
	if(count($resultados) > 0)
	{
		$x = 0;
		foreach($resultados as $res)
		{
			foreach($res as $key => $value)
			{
				$res[$key] = utf8_encode($value);
			}  
			$resultados[$x] = $res;
			$x++;
		}
		$dados = setData($resultados);
		echo($dados);
	} 
} 

function salvar($data, $hora, $conteudo)
{
	$sql = new Sql();
	$sql->query("INSERT into tb_compromissos(data, horario, conteudo) VALUES (:DATA, :HORARIO, :CONTEUDO)", array(
		":DATA" => utf8_encode($data),
		":HORARIO" => utf8_encode($hora),
		":CONTEUDO" => utf8_decode($conteudo)
	));	
}

function excluir($id)
{
	$sql = new Sql();
	$sql->query("DELETE from tb_compromissos WHERE id = :ID", array(
		":ID" => $id
	));		
}

function editar($id, $data, $hora, $conteudo)
{
	$sql = new Sql();
	$sql->query("UPDATE tb_compromissos SET data = :DATA, horario = :HORARIO, conteudo = :CONTEUDO WHERE id = :ID", array(
		":DATA" => $data,
		":HORARIO" => $hora,
		":CONTEUDO" => utf8_decode($conteudo),
		":ID" => $id
	));	
}

function setData($data)
{
	return json_encode($data);
}

?>