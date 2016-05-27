<?
     $slider = $slideres['Slid'];

     $indicatorsHTML = "";
     $listboxHTML = "";
     $todayIs = date('Y-m-d');
     
     $counter = 0;
    foreach ($slider as $indice => $slid) {

      $precio_normalHTML = "";
      $precio_ofertaHTML = "";
      $linkHTML = "";

      if ($counter == 0) {
        $indicatorsHTML .=  "<li data-target='carousel-home' data-slide-to='" . $counter ."' class='active'></li>";
        $listboxHTML .=     "<div class='item active'>";
      }else{
        $indicatorsHTML .=  "<li data-target='carousel-home' data-slide-to='" . $counter ."'></li>";
        $listboxHTML .=     "<div class='item'>";
      }

      if (!empty($slid['precio_normal'])) {
        $precio_normalHTML .=   "<span class='precio-normal'><span class='fa fa-chevron-left'></span>";
        $precio_normalHTML .=   $this->Number->currency($slid['precio_normal'], '$ ', array('thousands' => '.', 'places' => '0'));
        $precio_normalHTML .=   "</span>"; 
      }

      if ( !empty($slid['precio_oferta']) && $todayIs <= $slid['fecha_vencimiento'] ) {
        $precio_ofertaHTML =   "<span class='precio-oferta'><label>Precio Oferta</label>";
        $precio_ofertaHTML .=   $this->Number->currency($slid['precio_oferta'], '$ ', array('thousands' => '.', 'places' => '0'));
        $precio_ofertaHTML .=   "</span>"; 
      }

      if (!empty($slid['link'])) {
        $linkHTML .=    "<a href='" . $slid['link'] . "'>";
        $linkHTML .=    "<button class='btn btn-solicitar'>Me interesa</button>";
        $linkHTML .=    "</a>";
      }

      $listboxHTML .=   $this->Html->image("Slid/" . $slid['id'] . "/" . "slider_" . $slid['ruta'], array('class' => 'responsive-img'));
      $listboxHTML .=   "<div class='carousel-caption'>";
      $listboxHTML .=   "<div class='box-background'>";
      $listboxHTML .=   "</div>"; //end box background
      $listboxHTML .=   "<div class='caption-box'>";
      $listboxHTML .=   "<h3>" . $slid['nombre'] . "</h3>";
      $listboxHTML .=   "<p>" . $slid['descripcion'] . "</p>";
      $listboxHTML .=   $precio_normalHTML;
      $listboxHTML .=   $precio_ofertaHTML;
      $listboxHTML .=   $linkHTML;
      $listboxHTML .=   "</div>";
      $listboxHTML .=   "</div>"; //end carousel caption
      $listboxHTML .=   "</div>"; //end item

      $counter++;
    }

?>

<div id="carousel-home" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?= $indicatorsHTML; ?>
  </ol>
  <div class="carousel-inner" role="listbox">
    <?= $listboxHTML; ?>
  </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-home" role="button" data-slide="prev">
      <span class="fa fa-chevron-left vertical-center"></span>
    </a>
    <a class="right carousel-control" href="#carousel-home" role="button" data-slide="next">
      <span class="fa fa-chevron-right vertical-center"></span>
    </a>
</div>