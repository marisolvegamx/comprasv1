 <div class="form-group col-md-6">
     <label>MES :</label>
     <select name="clames" class="form-control">
        <option value="1" <?php if($catalogo["num_mes_asig"]==1) echo "selected" ?>>ENERO</option>
        <option value="2" <?php if($catalogo["num_mes_asig"]==2) echo "selected" ?>>FEBRERO</option>
        <option value="3" <?php if($catalogo["num_mes_asig"]==3) echo "selected" ?>>MARZO</option>
        <option value="4" <?php if($catalogo["num_mes_asig"]==4) echo "selected" ?>>ABRIL</option>
        <option value="5" <?php if($catalogo["num_mes_asig"]==5) echo "selected" ?>>MAYO</option>
        <option value="6" <?php if($catalogo["num_mes_asig"]==6) echo "selected" ?>>JUNIO</option>
        <option value="7" <?php if($catalogo["num_mes_asig"]==7) echo "selected" ?>>JULIO</option>
        <option value="8" <?php if($catalogo["num_mes_asig"]==8) echo "selected" ?>>AGOSTO</option>
        <option value="9" <?php if($catalogo["num_mes_asig"]==9) echo "selected" ?>>SEPTIEMBRE</option>
        <option value="10" <?php if($catalogo["num_mes_asig"]==10) echo "selected" ?>>OCTUBRE</option>
        <option value="11" <?php if($catalogo["num_mes_asig"]==11) echo "selected" ?>>NOVIEMBRE</option>
        <option value="12" <?php if($catalogo["num_mes_asig"]==12) echo "selected" ?>>DICIEMBRE</option>
       </select>
    </div>
	 <div class="form-group col-md-6">
      <label>PERIODO :</label>
     <select name="claper" class="form-control">
        <option value="2021" <?php if($catalogo["num_per_asig"]==2021) echo "selected" ?>>2021</option>
        <option value="2022" <?php if($catalogo["num_per_asig"]==2022) echo "selected" ?>>2022</option>
        <option value="2023" <?php if($catalogo["num_per_asig"]==2023) echo "selected" ?>>2023</option>
        <option value="2024" <?php if($catalogo["num_per_asig"]==2024) echo "selected" ?>>2024</option>
        <option value="2025" <?php if($catalogo["num_per_asig"]==2021) echo "selected" ?>>2025</option>
        <option value="2026" <?php if($catalogo["num_per_asig"]==2022) echo "selected" ?>>2026</option>
        <option value="2027" <?php if($catalogo["num_per_asig"]==2023) echo "selected" ?>>2027</option>
        <option value="2028" <?php if($catalogo["num_per_asig"]==2024) echo "selected" ?>>2028</option>

       </select>
    </div>