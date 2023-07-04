<div>
  <h2>Administrasion de usuarios</h2>
  <p>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit eos nobis
    aut aspernatur cumque nam velit, sequi reiciendis hic quae beatae dolorem
    molestiae officiis? Accusantium, molestiae ducimus. Dolores, quas sequi.
    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi, facilis
    iusto tempore ipsam numquam exercitationem officiis architecto.
    Exercitationem dolor vitae, omnis dolorum libero odit sint amet. Nam ipsum
    unde asperiores! Lorem ipsum dolor sit amet consectetur adipisicing elit.
    Aperiam pariatur eveniet distinctio ut iusto corporis aliquam, dolor
    deserunt hic porro voluptates in officiis officia, quae nemo assumenda
    totam, unde reprehenderit
  </p>
  <p>
    <a href="http://localhost/php3c/?C=UserController&M=CallFormAdd">Agregar nuevo usuario</a>
  </p>
  <!--Aqui va una tabla con los usuarios-->
  <table border=1>
    <thead>
      <td>Nombre</td>
      <td>A Paterno</td>
      <td>A Materno</td>
      <td>Usuario</td>
      <td>Acciones</td>
    </thead>
    <tbody>
      <?php
      foreach($datos as $dato){
        echo "<tr>";
        echo "<td>" . $dato['Nombre'] . "</td>";
        echo "<td>" . $dato['ApPaterno'] . "</td>";
        echo "<td>" . $dato['ApMaterno'] . "</td>";
        echo "<td>" . $dato['Usuario'] . "</td>";
        echo "<td> <button onclick='editar(".$dato['IdUser'].")'>Editar</button><br>
        <button onclick='eliminar(".$dato['IdUser'].")'>Eliminar</button> </td>";
        echo "</tr>";
      }
      ?>
      
    </tbody>
  </table>
</div>
<script>
    //creamos la funcion para eliminar un usuario por medio de su id y confirmamos si se desea eliminar
    function eliminar(id){
      if(confirm("¿Desea eliminar el usuario?")){
        window.location.href="http://localhost/php3c/?C=UserController&M=Delete&id="+id;
        
      }
    }
    //creamos la funcion para editar un usuario por medio de su id
    function editar(id){
      window.location.href="http://localhost/php3c/?C=UserController&M=CallFormEdit&id="+id;
    }
  </script>
