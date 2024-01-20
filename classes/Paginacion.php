<?php 
namespace Classes;

class Paginacion {
    public $pagina_actual;
    public $registros_por_pagina;
    public $total_registros;

    public function __construct($pagina_actual = 1,
                                $registros_por_pagina = 10, 
                                $total_registros = 0) {

        $this->pagina_actual = (int) $pagina_actual; //if str => int
        $this->registros_por_pagina = (int) $registros_por_pagina;
        $this->total_registros = (int) $total_registros;
    }

    public function offset() {
        return $this->registros_por_pagina * ($this->pagina_actual - 1);
    }

    public function total_paginas() {
        
        if($this->total_registros === 0) {
            return 1;
        }
        
        //ceil: redondea hacia el límite superior
        return ceil($this->total_registros / $this->registros_por_pagina);
    }

    public function calcular_pagina_anterior() {
        return $this->pagina_actual - 1;
    }

    public function calcular_pagina_siguiente() {
        return $this->pagina_actual + 1;
    }

    public function mostrar_enlace_anterior() {
        $html = '';
        
        $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page={$this->calcular_pagina_anterior()}\">&laquo; Anterior</a>";

        return $html;
    }

    public function mostrar_enlace_siguiente() {
        $html = '';

        $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page={$this->calcular_pagina_siguiente()}\">Siguiente &raquo;</a>";

        return $html;
    }

    public function numeros_paginas() {
        $html = '';

        for($i = 1; $i <= $this->total_paginas(); $i++){

            if( $i === $this->pagina_actual) {
                $html .= "<span class=\"paginacion__enlace paginacion__enlace--actual\">$i</span>";
            } else {
                $html .= "<a class=\"paginacion__enlace paginacion__enlace--numero\" href=\"?page=$i\">$i</a>";
            }
        }

        return $html;
    }

    public function paginacion() {
        $html = '';
        if($this->total_registros > 1) {
            $html .= '<div class="paginacion">';
            $html .= $this->mostrar_enlace_anterior();
            $html .= $this->numeros_paginas();
            $html .= $this->mostrar_enlace_siguiente();
            $html .= '</div>';
        }
        return $html; 
    }
}