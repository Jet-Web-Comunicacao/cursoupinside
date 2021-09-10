<?php include_once("sistema/restrito_all.php");?>
<?php include_once("sistema/validar_user.php");?>
<?php include_once("header.php");?>
<div id="local">
   <div class="caminho">Onde Estou: UpImóveis &raquo; Painel de Controle & Cadastrar Imóvel</div><!--caminho-->
   <div class="welcome">Olá <?php echo $clienteNome;?>| Hoje <?php echo date('d/m/Y H:i').'h';?> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
   
<div id="content">

<?php include_once("menu.php");?>     

   <div id="content_conteudo">
   
<?php include_once("sistema/carregando.php");?>
<span style="font:16px 'Trebuchet MS', Arial, Helvetica, sans-serif; color:#069;"><strong>1: Informações</strong> | 2: Endereços | 3: Imagens</span>
   
      <form name="cadastraImovelCliente-1" id="cadastraImovelCliente-1" action="painel.php?exe=imoveis-cliente/cadastro-2" method="post" enctype="multipart/form-data">
      
        <label>
          <span>Titulo do anúncio:</span>
          <input type="text" name="titulo" size="80" />
        </label>      
      
      
        <label>
          <span>Imagem de exibição do Imóvel: (<strong style="color:#900;">OBRIGATÓRIO, deve ser .jpg</strong>)</span>
          <input type="file" name="img[]" size="60" />
        </label>
        
        <label>
          <span>Negócio:</span>
        </label>
          <input type="radio" name="negocio" value="alugar" /> Alugar
          <input type="radio" name="negocio" value="vender" /> Vender
      
        
        <label>
          <span>Tipo:</span>
        </label>
          <input type="radio" name="tipo" value="Casa" /> Casa &nbsp;
          <input type="radio" name="tipo" value="Apartamento" /> Apartamento &nbsp;
          <input type="radio" name="tipo" value="Duplex" /> Duplex &nbsp;
          <input type="radio" name="tipo" value="Condomínio" /> Condomínio &nbsp;
          <input type="radio" name="tipo" value="sala" /> Sala Comercial &nbsp;
          <input type="radio" name="tipo" value="pavilhão" /> Pavilhão &nbsp;
        
        
        <label>
          <span>Valor: (Para R$150,00 informe 150,00)</span>
          <input type="text" name="valor" size="40" />
        </label>
               
        <label>
          <span>Descrição:</span>
          <textarea rows="3" cols="60" name="descricao"></textarea>
        </label>
        
        <label>
          <span>Comodos: (informe quantos quartos tem o imóvels)</span>
          <input type="text" name="comodos" />
        </label>
        
        <label>
          <span>Suites: (Se não tiver suites deixe o campo em branco!)</span>
          <input type="text" name="suites" />
        </label>
        
        <label>
          <span>Banheiros: (quantos banheiros tem o imóvel)</span>
          <input type="text" name="banheiros" />
        </label>
        
        <label>
          <span>Salas: (quantas salas tem o imóvel)</span>
          <input type="text" name="salas" />
        </label>
        
        <label>
          <span>Outros: (Selecione os existentes no imóvel)</span>
        </label>
        <input type="checkbox" name="churrasqueira" value="sim" /> Churrasqueira &nbsp;
        <input type="checkbox" name="garagem" value="sim" /> Garagem &nbsp;
        <input type="checkbox" name="servico" value="sim" /> Área de Serviço &nbsp;
        <input type="checkbox" name="piscina" value="sim" /> Piscina &nbsp;
        
      
        <label>
          <span>Facilidades: (Mercado, Farmácia, Padaria e estabelecimentos próximos!)</span>
          <input type="text" name="facilidades" size="120" />
        </label>
        
        <input type="submit" name="executar" id="executar" value="Próximo Passo" />
      
      
      </form>
       
      
      
   </div><!--conteudo-->

</div><!--contet-->
     
<?php include_once("footer.php");?>