<div id="single">
<script language="JavaScript">
function abrir(URL) {

  var width = 595;
  var height = 842;

  var left = 50;
  var top = 50;

  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=no, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');

}
</script>
<?php include"single_func.php";?>
 
   <h1><?php get_postsTitulo();?></h1>
   
   <div class="navegar">
     <ul>
     <?php get_clienteDados();?>
     <li><img src="images/print.png" alt="" /><a href="javascript:abrir('nav/print.php?imovel=<?php get_imovelId();?>')"> Imprimir anúncio</a></li>
     <?php get_postsVisitas();?>
     </ul>   
   </div>
   
<div class="single_left">
   
   <?php get_postThumb();?>
   
     <ul class="carosel">
       <?php get_postGallery();?>
     </ul>
     
   

     <form name="interesse_site" id="interesse_site" method="post" action="" enctype="multipart/form-data">
       
       <span class="legend"><img src="images/contact.png" alt="Contate o cliente" class="icon" />Mostrar Interesse:</span> 
        
        <label>
          <span>Nome:</span>
          <input type="text" name="nome" />
        </label>
        
        <label>
          <span>E-mail:</span>
          <input type="text" name="email" />
        </label>
        
       
        <label>
          <span>Telefone:</span>
          <input type="text" name="telefone" />
        </label>
        
        <label>
          <span>Mensagem:</span>
          <textarea name="msg" rows="3"></textarea>
        </label>
        
        <input type="hidden" name="idDoCliente" value="<?php get_ClienteId();?>" />
        
           
          <input type="submit" name="contato_site" value="Fale conosco" class="btn" />
<?php if(isset($_POST['contato_site'])){
include"Connections/config.php";

$clienteId = $_POST['idDoCliente'];
$emailNome = strip_tags(trim($_POST['nome']));
$emailMail = strip_tags(trim($_POST['email']));
$emailFone = strip_tags(trim($_POST['telefone']));
$emailMsg = strip_tags(trim($_POST['msg']));
$emailData = date('Y-m-d H:m:s');
$emailStatus = 'pendente';

$enteresse  = 'INSERT INTO up_mailcliente (clienteId, emailNome, emailMail, emailFone, emailMsg, emailData, emailStatus) ';
$enteresse .= 'VALUES (:clienteId, :emailNome, :emailMail, :emailFone, :emailMsg, :emailData, :emailStatus)'; 
try{
	$queryEnteresse = $conecta->prepare($enteresse);
	$queryEnteresse->bindValue(':clienteId',$clienteId,PDO::PARAM_STR);
	$queryEnteresse->bindValue(':emailNome',$emailNome,PDO::PARAM_STR);
	$queryEnteresse->bindValue(':emailMail',$emailMail,PDO::PARAM_STR);
	$queryEnteresse->bindValue(':emailFone',$emailFone,PDO::PARAM_STR);
	$queryEnteresse->bindValue(':emailMsg',$emailMsg,PDO::PARAM_STR);
	$queryEnteresse->bindValue(':emailData',$emailData,PDO::PARAM_STR);
	$queryEnteresse->bindValue(':emailStatus',$emailStatus,PDO::PARAM_STR);
	$queryEnteresse->execute();
	
	echo '<strong>Recebemos sua mensagem!</strong>'; 
	
	}catch(PDOexception $errorEnteresse){
	  echo 'Erro ao cadastrar enteresse';	
	}
}
?>      
           
     </form>
     
     
</div><!--fecha class single_left-->     
     
   <div class="single_right">
   
     <div class="info">
     <?php get_postDetalhes();?>
     </div><!--info-->

     <div class="descricao">
     <strong>Descrição:</strong> <?php get_postDesc();?>
     </div><!--descricao-->
     
     <div class="itens">
       <ul>   
         <?php get_postItens();?>
       </ul>
     </div><!--itens-->
     
     <div class="facilidades">
     <strong>Facilidades do Imóvel:</strong><br />
     <?php get_postFacil();?>
     </div><!--facilidades-->
     
     
     <div class="endereco">
       <?php get_postEnd();?>
     </div><!--endereco-->
     
     <h4>Publicidade</h4>
     <div class="google">
       <script type="text/javascript"><!--
       google_ad_client = "pub-6252101946778080";
       /* UpImoveis na Single */
       google_ad_slot = "8974505803";
       google_ad_width = 336;
       google_ad_height = 280;
       //-->
       </script>
       <script type="text/javascript"
       src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
       </script>
     </div><!--fecha anuncio do google-->
     
     
   </div><!--div single_right-->

</div><!--fecha single-->    
     
