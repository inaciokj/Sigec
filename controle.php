<?php 

//utilização de namespaces 

namespace controle; 
//error_reporting(E_ALL ^ E_DEPRECATED);
include 'processaAcesso.php'; 
//include 'index.html'; 
//include 'cadastrar.php'; 
//include 'paginas/paginas1.html';
//include 'paginas/paginas2.html';
use processaAcesso as processaAcesso;   
$controle = new \processaAcesso\ProcessaAcesso; 



if (isset($_POST['entrar'])) { 
//if ($_POST['entrar']) { 
    echo 'Estou dentro, humm, acho que ... !!!';
    $id_acesso = $_POST['id_acesso']; 
    $senha = md5($_POST['senha']); 
    $usuario = $controle->verificaAcesso($id_acesso, $senha); 

//redirecionando para pagina conforme o tipo do usuário 
if ($usuario[0]['categoria'] == 1) { 
    header("Location:utilizador.html"); 
    
} else if ($usuario[0]['categoria'] == 2) { 
    header("Location:administrador.html"); 
    
} else if ($usuario[0]['categoria'] == 3) { 
    header("Location:gestor.html"); 
    
} else if ($usuario[0]['categoria'] == 4) { 
    header("Location:administrativo.html"); 
    
} else if ($usuario[0]['categoria'] == 5) { 
    header("Location:funcionario.html"); 
    
} else if ($usuario[0]['categoria'] == 6) { 
    header("Location:docente.html"); 
    
} else if ($usuario[0]['categoria'] == 7) { 
    header("Location:estudante.html"); 
}   
 

} else if (isset ($_POST['cadastrar'])) {
//} else if ($_POST['cadastrar']) {
    $numero_identificacao = base64_decode($_POST['inscricao']);
    $nome_completo =  base64_decode($_POST['nome']);     
    $data_nasc =  base64_decode($_POST['data_nasc']);
    $classe_frequencia =  base64_decode($_POST['frequencia']);
    $area_formacao =  base64_decode($_POST['formacao']);
    $endereco =  base64_decode($_POST['endereco']);
    $numero_tel =  base64_decode($_POST['telefone']);
    $numero_tel_alter =  base64_decode($_POST['telefalt']);
    $id_acesso = base64_decode($_POST['id_acesso']); 
    $senha = base64_decode(md5($_POST['senha']));   
    $categoria = base64_decode($_POST['categoria']);         
    //$foto = $_POST['foto']; 
    $arr = array('numero_identificacao' => $numero_identificacao, 'nome_completo' =>  $nome_completo,  'data_nasc' =>  $data_nasc, 'classe_frequencia' =>  $classe_frequencia, 'area_formacao' =>  $area_formacao, 'endereco' =>  $endereco, 'numero_tel' => $numero_tel, 'numero_tel_alter' => $numero_tel_alter, 'id_acesso' => $id_acesso, 'senha' => $senha, 'categoria' => $categoria); 
    
    if (!$controle->cadastraUsuario($arr)) { 
        echo 'Aconteceu algum erro Cadastrando este Utiliador !!!!!';    
        
    } else { 
        $tipo_acesso = $controle->verificaAcesso($id_acesso, $senha); 
        
        if ($tipo_acesso[0]['categoria'] == 1) { 
            header("Location:utilizador.html"); 
            
        } else if ($tipo_acesso[0]['categoria'] == 2) { 
            header("Location:administrador.html"); 
            
        } else if ($tipo_acesso[0]['categoria'] == 3) { 
            header("Location:gestor.html"); 
    
        } else if ($tipo_acesso[0]['categoria'] == 4) { 
            header("Location:administrativo.html");    
    
        } else if ($tipo_acesso[0]['categoria'] == 5) { 
            header("Location:funcionario.html"); 
    
        } else if ($tipo_acesso[0]['categoria'] == 6) { 
            header("Location:docente.html"); 
    
        } else if ($tipo_acesso[0]['categoria'] == 7) { 
            header("Location:estudante.html"); 
        }   
    }         
} 
?>