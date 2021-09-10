<?php
if($clienteNivel == 'cliente'){?>
       <div id="content_menu">
         <ul>
           <li><a href="painel.php?exe=home/home">&raquo; Inicio</a></li>
           <li><a href="painel.php?exe=user/perfil">&raquo; Editar Perfil</a></li>
           <li class="titulo">Meus Anúncios:</li>
           <li><a href="painel.php?exe=imoveis-cliente/cadastro">&raquo; Criar anúncio</a></li>
           <li><a href="painel.php?exe=imoveis-nav/vender">&raquo; Alugar / Vender</a></li>
           <li><a href="painel.php?exe=imoveis-nav/ativos">&raquo; Anúncios ativos</a></li>
           <li><a href="painel.php?exe=imoveis-nav/pendentes">&raquo; Anúncios pendentes</a></li>
           <li><a href="painel.php?exe=imoveis-nav/aguardando">&raquo; Aguardando aprovação</a></li>
           <li><a href="painel.php?exe=imoveis-nav/finalizados">&raquo; Anúncios finalizados</a></li>
         </ul>
         <ul>
           <li class="titulo">Minhas mensagens:</li>
           <li><a href="painel.php?exe=cliente-mail/entrada">&raquo; Caixa de entrada</a></li>
           <li><a href="painel.php?exe=cliente-mail/completos">&raquo; Meus e-mails</a></li>
           <li><a href="painel.php?exe=tickets/cliente_cadastra">&raquo; Ajuda/Suporte</a></li>
         </ul>
      </div><!--menu-->
<?php
}elseif($clienteNivel == 'admin'){?>
       <div id="content_menu">
         <ul>
           <li><a href="painel.php?exe=home/home">&raquo; Inicio</a></li>
           <li class="titulo">Anunciantes:</li>
           <li><a href="painel.php?exe=admin-imoveis/pendentes">&raquo; Anúncios pendentes</a></li>
           <li><a href="painel.php?exe=admin-imoveis/ativos">&raquo; Edição de Ativos</a></li>
           <li><a href="painel.php?exe=admin-imoveis/finalizados">&raquo; Listar Finalizados</a></li>
           <li><a href="painel.php?exe=clientes/clientes">&raquo; Edição de Clientes</a></li>
           <li><a href="painel.php?exe=admin/perfil">&raquo; Alterar dados</a></li>
         </ul>
         <ul>
           <li class="titulo">Mensagens:</li>
           <li><a href="painel.php?exe=tickets/admin-tickets">&raquo; Suporte ao cliente</a></li>
           <li><a href="painel.php?exe=admin-inbox/inbox">&raquo; Mensagens do site</a></li>
           <li><a href="painel.php?exe=admin-inbox/completos">&raquo; E-mails respondidos</a></li>
         </ul>
      </div><!--menu-->
<?php }else{include"deslogar.php"; } ;?>
