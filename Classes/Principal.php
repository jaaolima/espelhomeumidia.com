<?php
    require_once("conexao.php");
    class Principal{
        public function gravarCliente()
		{

			$ds_nome	    = $_POST['ds_nome'];
			$ds_empresa	    = $_POST['ds_empresa'];
			$nu_telefone	= $_POST['nu_telefone'];

			
			try{
				$con = Conecta::criarConexao();
				$insert = "INSERT into tb_cliente (ds_nome, ds_empresa, nu_telefone)
							VALUES (:ds_nome, :ds_empresa, :nu_telefone)";
				
				$stmt = $con->prepare($insert);
				
				$params = array(':ds_nome' => $ds_nome,
								':ds_empresa' => $ds_empresa,
								':nu_telefone' => $nu_telefone);
                                
				$stmt->execute($params);
				
				echo "Dados gravados com sucesso!"; 
				
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			} 
        }
		public function gravarPonto()
		{

			$ds_localidade	    = $_POST['ds_localidade'];
			$nu_localidade	    = $_POST['nu_localidade'];
			$id_cliente			= $_POST['id_cliente'];

			
			try{
				$con = Conecta::criarConexao();
				$insert = "INSERT into tb_ponto (ds_localidade, nu_localidade, id_cliente)
							VALUES (:ds_localidade, :nu_localidade, :id_cliente)";
				
				$stmt = $con->prepare($insert);
				
				$params = array(':ds_localidade' => $ds_localidade,
								':nu_localidade' => $nu_localidade,
								':id_cliente' => $id_cliente);
                                
				$stmt->execute($params);
				
				echo "Dados gravados com sucesso!"; 
				
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			} 
        }
		public function listarOptionsCliente()
		{
			try{
				$con = Conecta::criarConexao();

				
				$select = "SELECT id_cliente, ds_nome
							FROM tb_cliente";
				
				$stmt = $con->prepare($select);
				$stmt->execute();

				$options = "<option value=''>Selecione..</option>";

				while($dados = $stmt->fetch())
				{
					$options.= "<option value='".$dados['id_cliente']."'>".$dados['ds_nome']."</option>";
				}
				return $options;

			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print $e->getMessage();
			}
		}
		public function listarPonto(array $dados)
		{
			try{
				$con = Conecta::criarConexao();
				
				$select = "SELECT p.id_ponto, ds_localidade, nu_localidade
							FROM tb_ponto p";
				
				$stmt = $con->prepare($select); 
				
				
				$stmt->execute();

				return $stmt;
				
					
			}
			catch(exception $e)
			{
				header('HTTP/1.1 500 Internal Server Error');
    			print "ERRO:".$e->getMessage();		
			}
		}
        
    }



?>