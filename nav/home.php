     <div id="imoveis_home">
       
       <h1>Imóveis</h1>
       
         <form name="busca_comum" action="index.php?pg=search" method="post">
           <label>
             <span>Busca Comum: </span>
             <input type="text" name="p" />
             
             <input type="submit" name="Buscar" value="" class="btn" />
             
           </label>
         
         </form>
         
           <ul class="lista_um">
             <?php up_homePosts();?>
           </ul>
           
           <ul class="lista_dois">
             <?php up_homePostsListaDois();?>
           </ul>
           
             <div class="anuncie">
               <a href="index.php?pg=anuncie"><img src="images/cadastre_se.jpg" alt="" title="" border="0" /></a>
             </div><!--classe anuncie-->
     
     </div><!--fecha imoves home-->
     
     
